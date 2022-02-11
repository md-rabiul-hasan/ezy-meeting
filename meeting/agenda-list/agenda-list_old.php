
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['meeting_id']) && isset($_POST['agenda_list_notice_reference_number']) && isset($_POST['agenda_list_notice_date'])) {

        $meeting_id                          = mysqli_real_escape_string($connect, $_POST['meeting_id']);
        $agenda_list_notice_reference_number = mysqli_real_escape_string($connect, $_POST['agenda_list_notice_reference_number']);
        $agenda_list_notice_date             = mysqli_real_escape_string($connect, $_POST['agenda_list_notice_date']);


        // finding company image 
        $companyImageSql = "SELECT image,name FROM companies where id='$company_id'";
        $companyImageQuery = mysqli_query($connect,$companyImageSql);
        $companyImageData = mysqli_fetch_array($companyImageQuery);
        $company_image_url = $companyImageData['image'];
        $company_name = $companyImageData['name'];

        // pdf work start
        include '../../assets/plugin/pdf/fpdf.php'; // connection pdf

        class PDF extends FPDF {
            // Page header
            function Header() {
                         
              
            }

            // Page footer
            function Footer() {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial', 'I', 8);
                // Page number
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }
        }

        $pdf = new PDF();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->AliasNbPages();
        $pdf->AddPage('P');
        $pdf->Ln(20);
        $cell_width       = 30;
        $small_cell_width = 20;
        $big_cell_width   = 40;
        $cell_border      = 1;

        $pdf->SetDisplayMode('fullpage');

        $cureentDate = date('jS M,Y');

        // Logo
        $pdf->Cell(0, -30, ''.$cureentDate.'', 0, 0, 'L');
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Ln(7);

        //$imageLink = "../../storage/company/".$company_id."/company-image/".$company_image_url;
        $imageLink = "http://ezy-meeting.com/demo/assets/img/logo-white.png";

        // Logo
        //$pdf->Image('../../storage/company/'.$company_id.'/company-image/'.$company_image_url.'',75,10,60);
        $pdf->Image($imageLink,75,10,60);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);

        // meeting info
        $meetingQuery    = mysqli_query($connect,"SELECT title,meeting_date,meeting_time,location FROM meetings where id='$meeting_id'");
        $meetingData     = mysqli_fetch_array($meetingQuery);
        $meetingTitle    = $meetingData['title'];
        $meetinglocation = strtoupper($meetingData['location']);
        $meetingDate     = date('jS M, Y', strtotime($meetingData['meeting_date']));
        $meeting_time    = date('h:i a', strtotime($meetingData['meeting_time']));

        // Line break
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, ''.$meetinglocation.'', 0, 0, 'C');
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "COMPANY SECRETARIES", 0, 0, 'C');
        $pdf->Ln(15);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, 'Agenda & Disition Of '.$meetingTitle.' Held On '.$meetingDate.' at '.$meeting_time.'', 0, 0, 'C');
        $pdf->Ln(20);



    
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(12, 8, 'SL', $cell_border, 0, 'C');
        $pdf->Cell(30, 8, 'Agenda No', $cell_border, 0, 'C');
        $pdf->Cell(120, 8, 'Subject Of Agenda', $cell_border, 0, 'C');
        $pdf->Cell(30, 8, 'Dicision/Remarks', $cell_border, 0, 'C');
        $pdf->ln();

        // agenda info query start
        $meetingAgendaSql = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl ASC";
        $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);
        $sl = 1;
        $pdf->SetFont('Arial', '', 9);
        while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
            $pdf->Cell(12, 8, $sl++, $cell_border, 0, 'C');
            $pdf->Cell(30, 8, $meetingAgendaData['agenda_prefix'].$meetingAgendaData['agenda_sl'], $cell_border, 0, 'C');
            $pdf->Cell(120, 8, $meetingAgendaData['title'], $cell_border, 0, 'C');
            $pdf->Cell(30, 8, ' ' , $cell_border, 0, 'C');
            $pdf->ln();
        }

        // find out agend 
        $settingInfoSql = "SELECT * FROM settings WHERE company_id='$company_id'";
        $settingInfoQuery = mysqli_query($connect,$settingInfoSql);
        $settingInfoData = mysqli_fetch_array($settingInfoQuery);

        $settingUserName = strtoupper($settingInfoData['meeting_signatory_name']);
        $settingUserDesignation = $settingInfoData['meeting_signatory_designation'];

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->ln(20);
        $pdf->Cell(0, 10,$settingUserName , 0, 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 10,$settingUserDesignation , 0, 0, 'L');

        $pdf->ln(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10,$company_name , 0, 0, 'L');

        $filename = 'Meeting Notice.pdf';
        $pdf->Output($filename, 'I');

        // pdf work end

    } else {
        echo "Please select required filed";
    }

?>
