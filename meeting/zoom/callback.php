<?php
    //include '../../database_connection.php';
    session_start();
    include '../../functions.php';
    require_once 'config.php';

    $company_id    = $_SESSION['company_id'];
    $entry_user_id = $_SESSION['id'];
    //$entry_user_id = $_SESSION['meeting_id'];
    $meeting_id    = $_SESSION['session_meeting_id'];

    try {
        $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);

        $response = $client->request('POST', '/oauth/token', [
            "headers"     => [
                "Authorization" => "Basic " . base64_encode(CLIENT_ID . ':' . CLIENT_SECRET),
            ],
            'form_params' => [
                "grant_type"   => "authorization_code",
                "code"         => $_GET['code'],
                "redirect_uri" => REDIRECT_URI,
            ],
        ]);

        // $request = $provider->getAuthenticatedRequest(
        //     'GET',
        //     'https://api.zoom.us/v2/users/email?email=meuemail@gmail.com',
        //     $accessToken
        // );




        $token = json_decode($response->getBody()->getContents(), true);

        $db = new DB();

        if ($db->is_table_empty($company_id, $meeting_id)) {
            $db->update_access_token(json_encode($token), $company_id, $meeting_id, $entry_user_id);
            $redirectTokenInfo = sprintf("meeting-call.php?company_id=%s&meeting_id=%s", $company_id, $meeting_id);
            $_SESSION['session_meeting_id'] = '';
            header("location:{$redirectTokenInfo}");

        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

?>