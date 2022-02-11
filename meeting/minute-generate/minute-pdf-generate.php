<?php
namespace Dompdf;
require_once '../../assets/plugin/dompdf/autoload.inc.php';
include '../../database_connection.php';

if (!isset($_SESSION['id'])) {
    header("location:../../login/login.php");
    exit;
}

$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];

$meeting_unique_id = $_GET['meeting_id'];
$pdf_template_id   = $_GET['template_id'];

// template data query
$templateDataSql   = "SELECT * FROM minute_pdf_template WHERE id='$pdf_template_id' and company_id='$company_id'";
$templateDataQuery = mysqli_query($connect, $templateDataSql);
$templateData      = mysqli_fetch_array($templateDataQuery);

$headerStyle  = $templateData['header_style'] ?? 'style="text-align:left"';
$contentStyle = $templateData['content_style'] ?? 'style="text-align:left"';
$footerStyle  = $templateData['footer_style'] ?? 'style="text-align:left"';
// end template data query

// html - to pdf plugin integration

$dompdf = new Dompdf();

$style = "
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    </style>";

// PDF Data Query  Start
$pdfHeaderDataSql   = "SELECT title,location,meeting_date,meeting_time from meetings WHERE meeting_unique_id='$meeting_unique_id'";
$pdfHeaderDataQuery = mysqli_query($connect, $pdfHeaderDataSql);
$pdfHeaderData      = mysqli_fetch_array($pdfHeaderDataQuery);
$heding             = sprintf("<p %s>The meetings of %s was held on %s %s at . The following members </p>", $headerStyle, $pdfHeaderData['title'], date('jS F,Y', strtotime($pdfHeaderData['meeting_date'])), date('h:i a', strtotime($pdfHeaderData['meeting_time'])));

// pdf body text
$agendaDataSql = "SELECT agendas.agenda_prefix,agendas.agenda_sl,agendas.title as agenda_title,agendas.explanatory_template_id,agendas.explanatory_description,vote_options.name as vote,agenda_templates.name as explanatory_name FROM `meetings`
    INNER JOIN agendas on agendas.meeting_id=meetings.id
    INNER JOIN agenda_templates on agendas.explanatory_template_id=agenda_templates.id
    LEFT JOIN agenda_results on agendas.id=agenda_results.agenda_id
    LEFT JOIN vote_options on agenda_results.max_vote_option=vote_options.id
    WHERE meetings.meeting_unique_id='$meeting_unique_id'";

$agendaDataQuery = mysqli_query($connect, $agendaDataSql);
$agendaBoydText  = '';
while ($agendaData = mysqli_fetch_array($agendaDataQuery)) {
    $agendaBoydText .= '<div class="row">
        <div class="col-md-12" '.$contentStyle.'>
            <table>
                <thead>
                    <tr style="background:#fff;">
                        <th style="text-align: center;">' . $agendaData['agenda_prefix'] . $agendaData['agenda_sl'] . '</th>
                        <th style="text-align: center;">' . $agendaData['agenda_title'] . '</th>
                    </tr>
                </thead>
            </table>
            <p>' . $agendaData['agenda_prefix'] . $agendaData['agenda_sl'] . ' (' . $agendaData['explanatory_name'] . ') explanatory</p>
            <p>' . $agendaData['explanatory_description'] . '</p>
            <p>Resolved</p>
            <p>' . $agendaData['vote'] . '</p>
        </div>
    </div>
    </div>';
}

// PDF Data Query End

$dompdf->loadHtml(''.$style.'.


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
    <div class="container">
<div class="row">
    <div class="col-md-12">
        <h5 '.$headerStyle.'>Minutes of the Meeting held on 31.12.2019.</h5>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p>' . $heding . '</p>
    </div>
</div>

<br>
' . $agendaBoydText . '
');    
    '</body>
    </html>';



// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream("", array("Attachment" => false));
exit(0);