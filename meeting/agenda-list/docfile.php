<?php include '../../database_connection.php';?>



<?php

 if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];



        $meeting_id  = mysqli_real_escape_string($connect, $_GET['meeting_id']);
      

        $agenda_list_notice_reference_number = mysqli_real_escape_string($connect, $_POST['agenda_list_notice_reference_number']);

        $agenda_list_notice_date = mysqli_real_escape_string($connect, $_POST['agenda_list_notice_date']);


        $companyImageSql = "SELECT image,name FROM companies where id='$company_id'";
        $companyImageQuery = mysqli_query($connect,$companyImageSql);
        $companyImageData = mysqli_fetch_array($companyImageQuery);
        $company_image_url = $companyImageData['image'];
        $company_name = $companyImageData['name'];



         // find out agend 
        $settingInfoSql = "SELECT * FROM settings WHERE company_id='$company_id'";
        $settingInfoQuery = mysqli_query($connect,$settingInfoSql);
        $settingInfoData = mysqli_fetch_array($settingInfoQuery);

        $settingUserName = strtoupper($settingInfoData['meeting_signatory_name']);
        $settingUserDesignation = $settingInfoData['meeting_signatory_designation'];



         $meetingQuery    = mysqli_query($connect,"SELECT title,meeting_date,meeting_time,location FROM meetings where id='$meeting_id'");

    $meetingData     = mysqli_fetch_array($meetingQuery);
    $meetingTitle    = $meetingData['title'];
    $meetinglocation = strtoupper($meetingData['location']);
    $meetingDate     = date('jS M, Y', strtotime($meetingData['meeting_date']));
    $meeting_time    = date('h:i a', strtotime($meetingData['meeting_time']));




//header part

header("Content-type: application/vinod.ms-word");

header("Content-Disposition: attachment;Filename=agenda_lists.doc");

//starting html tag

echo "<html>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";

echo"<style>";

echo"@font-face {
      font-family: 'SutonnyMJ';
      font-style: normal;
      font-weight: normal;
      src: url('htmltopdf/SutonnyMJ.ttf') format('truetype');
}";

echo "@font-face {
      font-family: 'SolaimanLipi';
      font-style: normal;
      font-weight: normal;
      src: url('htmltopdf/SolaimanLipi.ttf') format('truetype');
}";

echo "table, th, td {
    width:100%;
  border: 1px solid black;
  border-collapse: collapse;
  padding-top:10px;
}";

echo ".title{
  font-family:'SutonnyMJ','SolaimanLipi';
}";

echo ".title2{
  font-family:'SolaimanLipi';
}";

echo ".logo{
  
  display: flex;


  align-items: center;


  justify-content: center;
  text-align:center;
  margin-right:70px;
}";


echo"</style>";



echo "<meta http-equiv=\'Content-Type\' content=\'text/html; charset=Windows-1252\'>";

//body part start here

echo "<body>";

echo date('d-M-Y');

   echo" <div class='logo'>
      
        <img src='http://ezy-meeting.com/demo/assets/img/logo-white.png' alt='Not found' height='100px' width='100px'>
       
        
    </div>";

  echo"<h3 style='text-align:center;'><b> $meetinglocation </b></h3>";
  echo "<h4 style='text-align:center;'>COMPANY SECRETARIES</h4>";


  echo "<h4 style='text-align:center;'>Agenda List Of $meetingTitle Held On $meetingDate at
   $meeting_time </h4>";




 $meetingAgendaSql = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl ASC";
        $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);

        $sl=0;
      

         echo "<table id='customers'>
                          <tr>

                              <th style='width:10%;' >SL</th>
                              <th style='width:25%;'>Agenda No</th>
                              <th style='width:65%;'>Subject Of Agenda</th>
                             
                              
                          </tr>";


        while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
          
            $sl++;
           $agenda_sl = $meetingAgendaData['agenda_prefix'].$meetingAgendaData['agenda_sl'];
         
           $title = $meetingAgendaData['title'];
          
           if (strlen($title) != strlen(utf8_decode($title))) {
                   $font = "title";

                  }else {
                     $font = "title2";
                  }


            
                 echo "<tr>

                  <td style='text-align:center;font-family:sans-serif;width:10%;'>$sl</td>
                  <td style='text-align:center;width:25%;'>$agenda_sl</td>
              
                  <td class='$font' style='text-align:center;width:65%; '> $title </td>
              
               </tr>";
                            
                         

           
        }

        echo  "</table>";   


       echo "<br>"; 

  echo "<div class='end' style='font-family:sans-serif'>
    <h4>$settingUserName</h4>
    <p>$settingUserDesignation</p>

    <h4>$company_name</h4>
  </div>";
   



echo "</body>";

//end html tag

echo "</html>";

?>