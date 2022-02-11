<?php
// database connctioin
include '../../database_connection.php';
/* [START PHPWORD] */
require "../../assets/plugin/html-docx/vendor/autoload.php";
// authentication check
if (!isset($_SESSION['id'])) {
    header("location:../../login/login.php");
    exit;
}

$deleteFiles = getcwd() . DIRECTORY_SEPARATOR;
$files = glob($deleteFiles . "/*.docx");
foreach ($files as $file) { // iterate files
    if (is_file($file)) {
        unlink($file); // delete docx file 
    }
}

$filename = "minute-generate-".uniqid(1, 1000).".docx";

$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];
if (isset($_POST['meeting_id']) && !empty($_POST['meeting_id'])) {
    $meeting_id = filter_input(INPUT_POST, 'meeting_id', FILTER_SANITIZE_STRING);
    $pw  = new \PhpOffice\PhpWord\PhpWord();
    $sql = "SELECT agendas.resolved_description from agendas
    INNER JOIN meetings on agendas.meeting_id=meetings.id
    WHERE meetings.id='$meeting_id' and agendas.minute_file != '' order by agendas.agenda_sl DESC";

    $query = mysqli_query($connect, $sql);
    $htmlContent = '';
    while($data = mysqli_fetch_assoc($query)){
        $htmlContent .= $data['resolved_description'];
    }

    $section = $pw->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent, false, false);

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($pw, 'Word2007');
    $objWriter->save($filename);

    // download link
    echo "<a href='minute-generate/{$filename}' download>Download Link</a>";

} else {
    echo false;
}
