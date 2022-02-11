<?php
require "vendor/autoload.php";

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

$output='';
for($i=1; $i<=30; $i++){
	$output .="<tr>
        <td style='text-align:center;font-family:sans-serif;'>$i</td>
        <td style='font-family:SolaimanLipi;'>আমাদের দেশের নাম বাংলাদেশ</td>
    
        <td style='text-align:center;'>BDwb‡KvW †_‡K weRh়A_©nxb †jLv hvi gv‡S Av‡Q A‡bK wKQy| n¨vu, GB †jLvi gv‡SB Av‡Q A‡bK wKQy| hw` Zywg g‡b K‡iv, GUv †Zvgvi Kv‡R jvM‡e, Zvn‡j Zv jvM‡e Kv‡R| wb‡Ri fvlvq †jLv †`L‡Z Af¨¯— nI| g‡b ivL‡e †jLv A_©nxb nq, hLb Zywg Zv‡K A_©nxb g‡b K‡iv; Avi †jLv A_©‡evaKZv ‰Zwi K‡i, hLb Zywg Zv‡Z A_© Xv‡jv| †h‡Kv‡bv †jLvB †Zvgvi Kv‡Q A_©‡evaKZv ‰Zwi Ki‡Z cv‡i, hw` Zywg †mLv‡b A_©‡`¨vZbv †`L‡Z cvI| …wQ`«v‡š^lY? bv, Zv n‡e †Kb?   </td>
        <td></td>
    
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

body{
  font-family:'SutonnyMJ','SolaimanLipi';
}


</style>


</head>
<body>

{$date}

	<div class='logo'>
      
        <img src='logo-collapse.png' alt='Not found' height='50px' width='50px'>
       
        
    </div>

  <h3 style='text-align:center;'><b> HEAD OFFICE </b></h3>
  <h4 style='text-align:center;'>COMPANY SECRETARIES</h4>


  <h4 style='text-align:center;'>Agenda & Disition Of First Committee 1st Meeting Held On 1st Nov, 2020 at 06:30 am</h4>


<table id='customers'>
  <tr>

	  <th>SL</th>
	  <th>Agenda No</th>
	  <th>Subject Of Agenda</th>
	  <th>Dicision/Remarks</th>
	  
  </tr>

    
  	{$output}

    
  
    
  </table>
  


<br>

  <div class='end'>
  	<h4>MD.RABIUL HASAN</h4>
    <p>JRD</p>

    <h4>Venture Solution Ltd</h4>
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


