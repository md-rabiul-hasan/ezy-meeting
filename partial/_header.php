<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $addDot; ?>assets/img/favicon.png">
      <link rel="stylesheet" href="<?php echo $addDot; ?>assets/css/pace.css">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Ezy Meeting</title>
      <!-- CSS -->
       <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/vendors/feather-icons/feather.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/vendors/linear-icons/style.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/3.9.0_fullcalendar.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/jquery.nestable.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/vendors/switchery/switchery.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/style.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/daterangepicker.min.css" rel="stylesheet" type="text/css">
       <link href="<?php echo $addDot; ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

       <link href="<?php echo $addDot; ?>assets/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css">
       <!-- Head Libs -->
       <script src="<?php echo $addDot; ?>assets/js/modernizr.min.js"></script>
<!--       <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="--><?php //echo $addDot; ?><!--assets/js/pace.min.js"></script>-->
   </head>
   <body class="  pace-done" data-sidebar-skin="dark" data-header-skin="light" data-navbar-brand-skin="dark" data-sidebar-state="expand">
      <div id="wrapper" class="wrapper">
      <!-- HEADER & TOP NAVIGATION -->
      <?php include $addDot."partial/_topbar.php"; ?>
      <!-- /.navbar -->
      <div class="content-wrapper">
    
      <?php include $addDot."partial/_sidebar.php"; ?>


      <!-- Documentation Work Start -->
      <?php
      $slashCount = explode('/', $_SERVER['REQUEST_URI']);
       //print_r($slashCount);
       $shortUri2=$slashCount[2];


       if ($shortUri2=="dashboard.php") {
            $shortUri3='';
           $slashCount[3]='';
           $slashCount[4]='';
          // return 0;
       }

       elseif ($slashCount[2].'/'.$slashCount[3]!="settings/committee" && $slashCount[2].'/'.$slashCount[3]!="settings/divisions" && $slashCount[2].'/'.$slashCount[3]!="settings/memos" && $slashCount[2].'/'.$slashCount[3]!="settings/settings") {
           $shortUri4='';
           $slashCount[4]='';
       }
     
       if($slashCount[2].'/'.$slashCount[3].'/'.$slashCount[4]){
         $shortUri4=$slashCount[2].'/'.$slashCount[3].'/'.$slashCount[4];
       }
       
        

       //echo $shortUri;die;
       if($shortUri2=="dashboard.php"){

        $docsql="SELECT * FROM `documentation` WHERE `heading1`='Dashboard' ";
        $docquery=mysqli_query($connect, $docsql);
        $docfetch=mysqli_fetch_array($docquery);

        // echo "<pre>";
        // print_r($docfetch);
        // die;
            // echo "dashboard page";

            ?>


        

      
    <div class="right-modal"><a href="#" data-toggle="modal" data-target=".bs-modal-md-info" title="User manual"><i class="fa fa-info-circle"></i></a></div>
                <div class="modal modal-info fade bs-modal-md-info" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading1']; ?>:</h5>
                            </div>
                            <div class="modal-body">
                                <h5>
                                <?php echo 
                                $docfetch['heading2']; ?></h5>
                                <ul class="list-group documentation">
                                  <?php echo $docfetch['content']; ?>
                                </ul>
                                
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

             <?php
                }

               if ($shortUri4=="settings/committee/all-committee.php") {
                        $docsql="SELECT * FROM `documentation` WHERE `heading2`='Committee List' ";
                        $docquery=mysqli_query($connect, $docsql);
                        $docfetch=mysqli_fetch_array($docquery);

                    ?>
                   <div class="right-modal"><a href="#" data-toggle="modal" data-target=".bs-modal-md-info" title="User manual"><i class="fa fa-info-circle"></i></a></div>
                <div class="modal modal-info fade bs-modal-md-info" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading1']; ?> :</h5>
                            </div>
                            <div class="modal-body">
                                <h5>
                                <?php echo $docfetch['heading2']; ?></h5>
                                <ul class="list-group documentation">
                                 <?php echo $docfetch['content']; ?>
                                </ul>
                                
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php

                }

                if($shortUri4=="settings/divisions/all-division.php"){

                         $docsql="SELECT * FROM `documentation` WHERE `heading2`='Company Division' ";
                        $docquery=mysqli_query($connect, $docsql);
                        $docfetch=mysqli_fetch_array($docquery);
                    ?>

                      <div class="right-modal"><a href="#" data-toggle="modal" data-target=".bs-modal-md-info" title="User manual"><i class="fa fa-info-circle"></i></a></div>
                <div class="modal modal-info fade bs-modal-md-info" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                 <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading1']; ?> :</h5>
                                
                            </div>
                            <div class="modal-body">
                                 <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading2']; ?> </h5> 

                                <ul class="list-group documentation">
                                  <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['content']; ?> </h5>

                                 
                                </ul>
                                
                                <hr>

                                <h5><?php echo $docfetch['description_title']; ?> :</h5>

                                <p><?php echo $docfetch['description']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php

                }

                if ($shortUri4=="settings/memos/all-memo.php") {
                     $docsql="SELECT * FROM `documentation` WHERE `heading2`='Memo' ";
                        $docquery=mysqli_query($connect, $docsql);
                        $docfetch=mysqli_fetch_array($docquery);

                    ?>
                      <div class="right-modal"><a href="#" data-toggle="modal" data-target=".bs-modal-md-info" title="User manual"><i class="fa fa-info-circle"></i></a></div>
                <div class="modal modal-info fade bs-modal-md-info" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading1']; ?> :</h5>
                            </div>
                            <div class="modal-body">
                                <h5><?php echo 
                                $docfetch['heading2']; ?> :</h5>
            
                                
                                <hr>

                                <h5> <?php echo 
                                $docfetch['description_title']; ?> : </h5>
                                <p> <?php echo 
                                $docfetch['description']; ?> </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php
                 }

                 if ($shortUri4=="settings/settings/all-setting.php") {
                        $docsql="SELECT * FROM `documentation` WHERE `heading2`='Company Settings' ";
                        $docquery=mysqli_query($connect, $docsql);
                        $docfetch=mysqli_fetch_array($docquery);

                    ?>
                    <div class="right-modal"><a href="#" data-toggle="modal" data-target=".bs-modal-md-info" title="User manual"><i class="fa fa-info-circle"></i></a></div>
                <div class="modal modal-info fade bs-modal-md-info" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h5 class="modal-title" id="myMediumModalLabel2"><?php echo 
                                $docfetch['heading1']; ?> :</h5>
                            </div>
                            <div class="modal-body">
                                <h5><?php echo $docfetch['heading2']; ?> :</h5>
            
                                
                                <hr>

                                <h5> <?php echo $docfetch['description_title']; ?> :</h5>

                                <p> <?php echo 
                                $docfetch['description']; ?> </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

                <?php
                  } 

             ?>   
     



            <style>
                .documentation{
                    list-style: none;
                }
               .documentation li{
                    line-height: 40px;
                    font-size: 18px;
                }

                /*  start another code */
                .right-modal{
                    position: fixed;
                    right: 0;
                    bottom: 50px;
                    z-index: 1000;
                    background:  #49c8f5;
                    padding: 0px 9px;
                    font-size: 20px;
                    border-radius: 4px;
                }
                .right-modal a{
                    color: #fff;
                }
            </style>
      <!-- Documentation Work End -->
      