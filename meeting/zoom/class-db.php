<?php
class DB {
    private $dbHost;
    private $dbUsername;
    private $dbPassword;
    private $dbName;

    public function __construct() {
        // Local Server
        // $this->dbHost     = "localhost";
        // $this->dbUsername = "root";
        // $this->dbPassword = "";
        // $this->dbName     = "ezymeeting";        

        // Liver Server
        $this->dbHost     = "localhost";
        $this->dbUsername = "ezy_demo";
        $this->dbPassword = "d~[xumJC4w]9";
        $this->dbName     = "ezy_demo";

        if (!isset($this->db)) {
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    public function is_table_empty($company_id, $meeting_id) {
        $result = $this->db->query("SELECT id FROM zoom_meeting_token where company_id='$company_id' and meeting_id='$meeting_id' ");
        if ($result->num_rows > 0) {
            return "update";
        }
        return "insert";
    }

    public function get_access_token($company_id, $meeting_id) {
        $sql    = $this->db->query("SELECT token FROM zoom_meeting_token where company_id='$company_id' and meeting_id='$meeting_id' ");
        $result = $sql->fetch_assoc();
        return json_decode($result['token']);
    }

    public function getZoomApiCridential($company_id) {
        $sql    = $this->db->query("SELECT * FROM zoom_credential where company_id='{$company_id}' ");
        $result = $sql->fetch_assoc();
        return $result;
    }

    public function get_refersh_token($company_id, $meeting_id) {
        $result = $this->get_access_token($company_id, $meeting_id);
        return $result->refresh_token;
    }

    public function update_access_token($token, $company_id, $meeting_id, $entry_user_id) {
        if ($this->is_table_empty($company_id, $meeting_id) == "insert") {
            $this->db->query("INSERT INTO zoom_meeting_token (`company_id`, `meeting_id`, `token`, `entry_user_id`)  VALUES ('$company_id','$meeting_id','$token',$entry_user_id)");
        } else {
            $this->db->query("UPDATE zoom_meeting_token SET token = '$token' WHERE company_id='$company_id' and meeting_id='$meeting_id'");
        }
    }

    public function meetingHistory($uuid, $meeting_id, $host_id, $topic, $type, $status, $start_time, $duration, $timezone, $start_url, $join_url, $password, $encrypted_password) {
        $this->db->query("INSERT INTO `meeting_info`(`uuid`, `meeting_id`, `host_id`, `topic`, `type`, `status`, `start_time`, `duration`, `timezone`, `start_url`, `join_url`, `password`, `encrypted_password`)
        VALUES ('$uuid','$meeting_id','$host_id','$topic','$type','$status','$start_time','$duration','$timezone','$start_url','$join_url','$password','$encrypted_password')");
    }
}
