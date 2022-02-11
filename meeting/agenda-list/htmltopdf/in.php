<?php
require "vendor/autoload.php";

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
ini_set('memory_limit', '-1');
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

$output = '';
for($i = 0; $i <= 2000; $i++){
    $output .= "<tr>
        <td>123456789011223455</td>
        <td>Maria Anders</td>
        <td>D</td>
        <td>50,00,000.00</td>
        <td>BDT</td>
        <td>202</td>
        <td>RSP Payment 200045455454566 Abdul Halim Hasan</td>
    </tr>";
  }

$var="<!DOCTYPE html>
<html>
<head>
<style>
*{
    font-size:10px;
}
#customers {
  font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 5px;
}



#customers th {
  padding-top: 5px;
  padding-bottom: 5px;
  text-align: left;
 
}
#top_text{
    margin-top:50px;
    margin-bottom:20px;
}
.halim{
    
    margin-left: 200px;
    top: 350px;
}
#top_text td {
    font-size:12px;
    text-align:center;   
}
#top_text td span b{
    font-size:12px;
}
.col-6{
    margin-top:50px;   
    float:left;
}
.col-6 td{
    padding-left:80px;
}
.col-6 h4{
  
    margin-left:80px;
    padding-left:10px;
    margin-bottom:50px;
   
}

.signature{
    padding-top:200px;
    
}
.maker{
    margin-left:50px;
    float:left;
    border-top: 1px solid black;
   
}
.checker{
    margin-left:350px;
    float:left;
    border-top: 1px solid black;
   
}
.logo{
    text-align: center;
    margin-top: 50px;
    margin-bottom: 50px;
}
.halim-ubs{
    margin-top:-15px;
}
.last{
    padding-left : 210px;
    padding-right:150px;

}
</style>
</head>
<body>

<div class='logo'>
        <img src='logo.png' alt='Not found' height='50px' width='200px'>
    </div>
<table id='top_text'>
  <tr>
    <td> <span><b>Remittance</b></span></td>
    <td class='last'> <span><b>Transaction Mode :</b> </span> EFTN</td>
    <td> <span><b>Date : </b> </span> 26 August,2020</td>
  </tr>
  
</table>

<table id='customers'>
  <tr>
  <th>Account</th>
  <th>A/C Title</th>
  <th>DR CR</th>
  <th>Amount</th>
  <th>Currency</th>
  <th>HomeBrn</th>
  <th>Narration</th>
  </tr>

  {$output}
  </table>


<div class='row2'>
    <div class='col-6'>
        <table>
            <tr>
                <td>Total Debit Transaction</td>
                <td>6</td>
            </tr>
            <tr>
                <td>Total Credit Transaction</td>
                <td>4</td>
            </tr>

            <tr>
                <td>Total Debit Transaction</td>
                <td>42331200</td>
            </tr>
            <tr>
                <td>Total Credit Transaction</td>
                <td>42331200</td>
            </tr>
        </table>
    </div>
    <div class='halim' >
        <h4 >UBS Batch No</h4>
        <h4 class='halim-ubs'>EFT Batch No</h4>
    </div>

</div>

<div class='signature'>
    <div class='maker'>
        <span>Maker Signature</span>
    </div>

    <div class='checker'>
        <span>Checker Signature</span>
    </div>
</div>

</body>
</html>

";

// Load HTML content 
$dompdf->loadHtml($var); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'potrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("codexworld", array("Attachment" => 0));


