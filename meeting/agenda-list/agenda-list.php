
<?php include '../../database_connection.php';?>



<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];



        $meeting_id  = mysqli_real_escape_string($connect, $_POST['meeting_id']);

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



  require "htmltopdf/vendor/autoload.php";


  // Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

$imageLink = "http://ezy-meeting.com/demo/assets/img/logo-white.png";

$output='';

 $meetingQuery    = mysqli_query($connect,"SELECT title,meeting_date,meeting_time,location FROM meetings where id='$meeting_id'");

    $meetingData     = mysqli_fetch_array($meetingQuery);
    $meetingTitle    = $meetingData['title'];
    $meetinglocation = strtoupper($meetingData['location']);
    $meetingDate     = date('jS M, Y', strtotime($meetingData['meeting_date']));
    $meeting_time    = date('h:i a', strtotime($meetingData['meeting_time']));


     $meetingAgendaSql = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl ASC";
        $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);

        $sl=0;
        $output='';

        while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
            $sl++;
           $agenda_sl = $meetingAgendaData['agenda_prefix'].$meetingAgendaData['agenda_sl'];
           $title = $meetingAgendaData['title'];


           if (strlen($title) != strlen(utf8_decode($title))) {
                   $font = "title";

                  }else {
                     $font = "title2";
                  }


            $output .="<tr>

            <td style='text-align:center;font-family:sans-serif;width:10%;'>$sl</td>
            <td style='text-align:center;width:25%;'>$agenda_sl</td>
        
            <td class='$font' style='text-align:center;width:65%; '> $title </td>
        
         </tr>";


        }

   


$date = date('d-M-Y');

$var="<!DOCTYPE html>
<html>
<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

<style>



.logo{
  
  display: flex;


  align-items: center;


  justify-content: center;
  text-align:center;
}

.date{
    float:left;
}

.generate{
    text-align:center;
}

table, th, td {
    width:100%;
  border: 1px solid black;
  border-collapse: collapse;
  padding-top:10px;
}

@font-face {
      font-family: 'SutonnyMJ';
      font-style: normal;
      font-weight: normal;
      src: url('SutonnyMJ.ttf') format('truetype');
}

@font-face {
      font-family: 'SolaimanLipi';
      font-style: normal;
      font-weight: normal;
      src: url('SolaimanLipi.ttf') format('truetype');
}



.title{
  font-family:'SutonnyMJ','SolaimanLipi';
}



.title2{
  font-family:'sans-serif';
}


</style>


</head>
<body>

{$date}

    <div class='logo'>
      
        <img src='htmltopdf/logo-collapse.png' alt='Not found' height='50px' width='50px'>
       
        
    </div>

  <h3 style='text-align:center;'><b> {$meetinglocation} </b></h3>
  <h4 style='text-align:center;'>COMPANY SECRETARIES</h4>


  <h4 style='text-align:center;'>Agenda List Of {$meetingTitle} Held On {$meetingDate} at
   {$meeting_time} </h4>


<table id='customers'>
  <tr>

      <th style='width:10%;' >SL</th>
      <th style='width:25%;'>Agenda No</th>
      <th style='width:65%;'>Subject Of Agenda</th>
     
      
  </tr>

    
    {$output}

    
  
    
  </table>
  


<br>

  <div class='end' style='font-family:sans-serif'>
    <h4>{$settingUserName}</h4>
    <p>{$settingUserDesignation}</p>

    <h4>{$company_name}</h4>
  </div>
 
</body>
</html>";

// Load HTML content 
$dompdf->loadHtml($var); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'potrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("codexworld", array("Attachment" => 0));      
