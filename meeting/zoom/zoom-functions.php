<?php
    include '../../database_connection.php';
    require_once 'config.php';

    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

function create_meeting($company_id,$meeting_id,$title,$dateTime,$duration,$password) {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $db          = new DB();
    $arr_token   = $db->get_access_token($company_id,$meeting_id);
    $accessToken = $arr_token->access_token;

    try {
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken",
            ],
            'json'    => [
                "topic"      => $title,
                "type"       => 2,
                "start_time" => $dateTime,
                "duration"   => $duration, // 30 mins
                "password"   => $password,
            ],
        ]);

        $data = json_decode($response->getBody(),true);
       // $db->meetingHistory($data->uuid, $data->id, $data->host_id, $data->topic, $data->type, $data->status, $data->start_time, $data->duration, $data->timezone, $data->start_url, $data->join_url, $data->password, $data->encrypted_password);

        return $data;

    } catch (Exception $e) {
        if (401 == $e->getCode()) {
            $refresh_token = $db->get_refersh_token($company_id,$meeting_id);

            $client   = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers"     => [
                    "Authorization" => "Basic " . base64_encode(CLIENT_ID . ':' . CLIENT_SECRET),
                ],
                'form_params' => [
                    "grant_type"    => "refresh_token",
                    "refresh_token" => $refresh_token,
                ],
            ]);
            $db->update_access_token($response->getBody(),$company_id,$meeting_id, $_SESSION['id']);

            create_meeting($company_id,$meeting_id,$title,$dateTime,$duration,$password);
        } else {
            echo $e->getMessage();
        }
    }
}