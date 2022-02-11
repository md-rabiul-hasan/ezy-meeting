<?php include '../../database_connection.php';?>
<?php include_once('../../assets/plugin/docx-merge/tbszip.php'); ?>

<?php
    $zip = new clsTbsZip();
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    $meeting_id = $_POST['meeting_id'];

    // folder create  start 
    if (!file_exists("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/generated-minute-file")) {
        mkdir("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/generated-minute-file", 0777, true);
    }
    // folder create end

    $minute_file_location = sprintf("../../storage/company/%d/meeting/%d/generated-minute-file/",$company_id,$meeting_id);
    $finalMergeFileName = $minute_file_location.'meeting-minute'.$meeting_id.rand(111,9988).".docx";

    // meeting agenda list
    $agendaListSql = "SELECT agendas.minute_file,agendas.title,agendas.agenda_sl from agendas
    INNER JOIN meetings on agendas.meeting_id=meetings.id
    WHERE meetings.id='$meeting_id' and agendas.minute_file != '' order by agendas.agenda_sl DESC";



    $agendaListQuery = mysqli_query($connect,$agendaListSql);
    $agendaMinuteFileArray = [];
    while($agendaListData = mysqli_fetch_array($agendaListQuery)){
        $singleFileInfo = [
            "agenda" => $agendaListData['title'],
            "file_name" => $agendaListData['minute_file']
        ];
        array_push($agendaMinuteFileArray,$singleFileInfo);

    }

    $totalAgendaMinuteFile = count($agendaMinuteFileArray);
    $fileLocation = sprintf("../../storage/company/%d/meeting/%d/agenda/",$company_id,$meeting_id);
    
    for($i=1; $i < $totalAgendaMinuteFile; $i++){
        if($i == 1){
            firstTwoDocxFileMerge( $addDot.$agendaMinuteFileArray[0]['file_name'], $addDot.$agendaMinuteFileArray[1]['file_name'] );
        }else{
            anotherDocxFileMerge($finalMergeFileName,$addDot.$agendaMinuteFileArray[$i]['file_name'] );
        }
    }


    // first time file merge 
    function firstTwoDocxFileMerge($firstDocx,$secondDocx){
        global $zip;
        global $finalMergeFileName;
        global $agendaMinuteFileArray;

        $zip->Open($firstDocx);
        $content1 = $zip->FileRead('word/document.xml');
        $zip->Close();

        $p = strpos($content1, '<w:body');
        if ($p===false) exit("Tag <w:body> not found in document 1.");
        $p = strpos($content1, '>', $p);
        $content1 = substr($content1, $p+1);
        $p = strpos($content1, '</w:body>');
        if ($p===false) exit("Tag </w:body> not found in document 1.");
        $content1 = substr($content1, 0, $p);

        // Insert into the second document
        $zip->Open($secondDocx);
        $content2 = $zip->FileRead('word/document.xml');
        $p = strpos($content2, '</w:body>');
        if ($p===false) exit("Tag </w:body> not found in document 2.");
        $content2 = substr_replace($content2, $content1, $p, 0);
        $zip->FileReplace('word/document.xml', $content2, TBSZIP_STRING);

        // Save the merge into a third file
        $zip->Flush(TBSZIP_FILE, $finalMergeFileName);
    }

     // first time file merge 
     function anotherDocxFileMerge($firstDocx,$secondDocx){
        global $zip;
        global $finalMergeFileName;
        global $agendaMinuteFileArray;

        $zip->Open($firstDocx);
        $content1 = $zip->FileRead('word/document.xml');
        $zip->Close();

        $p = strpos($content1, '<w:body');
        if ($p===false) exit("Tag <w:body> not found in document 1.");
        $p = strpos($content1, '>', $p);
        $content1 = substr($content1, $p+1);
        $p = strpos($content1, '</w:body>');
        if ($p===false) exit("Tag </w:body> not found in document 1.");
        $content1 = substr($content1, 0, $p);

        // Insert into the second document
        $zip->Open($secondDocx);
        $content2 = $zip->FileRead('word/document.xml');
        $p = strpos($content2, '</w:body>');
        if ($p===false) exit("Tag </w:body> not found in document 2.");
        $content2 = substr_replace($content2, $content1, $p, 0);
        $zip->FileReplace('word/document.xml', $content2, TBSZIP_STRING);

        // Save the merge into a third file
        $zip->Flush(TBSZIP_FILE, $finalMergeFileName);
    }

    echo "<a href='minute-generate/{$finalMergeFileName}' download>Download Link</a>";
