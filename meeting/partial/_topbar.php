<nav class="navbar">
    <div class="container-fluid px-0 align-items-stretch">
        <!-- Logo Area -->
        <div class="navbar-header">
            <a href="<?php echo $addDot; ?>dashboard.php" class="navbar-brand">
                <img class="logo-expand" alt="" src="<?php echo $addDot; ?>assets/img/logo-white.png">
                <img class="logo-collapse" alt="" src="<?php echo $addDot; ?>assets/img/logo-collapse.png">
            </a>
        </div>
        <!-- /.navbar-header -->
        <!-- Left Menu & Sidebar Toggle -->
        <ul class="nav navbar-nav">
            <li class="sidebar-toggle dropdown"><a href="javascript:void(0)" class="ripple"><span><i class="list-icon lnr lnr-menu"></i></span></a>
            </li>
        </ul>
        <!-- /.navbar-left -->
        <!-- Search Form -->
        <form class="navbar-search d-none d-sm-block" style="width: 500px;" role="search">
            <i class="list-icon fa fa-user"></i>
            <input type="search" disabled class="search-query" placeholder="<?php echo $_SESSION['name'] ?? '' ;?> ( <?php echo roleName($_SESSION['role_id']); ?> )"> 
        </form>
        <!-- /.navbar-search -->
        <div class="spacer"></div>
        <!-- Right Menu -->
        <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><i class="list-icon lnr lnr-alarm"></i> <span class="button-pulse bg-danger"></span> </span>Messages</a>

            </li>
        </ul>
        <!-- /.navbar-right -->
        <!-- User Image with Dropdown -->
        <ul class="nav navbar-nav">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-user ripple" data-toggle="dropdown"><span class="avatar thumb-xs">
                <?php
                     if($_SESSION['avatar'] == '' || $_SESSION['avatar'] == NULL){
                         $avatarPath = "assets/demo/users/6.jpg";
                     }else{
                         $avatarPath = $addDot.$_SESSION['avatar'];
                     }
                ?>
                <img src="<?php echo $avatarPath; ?>" class="rounded-circle" alt=""> <i class="list-icon lnr lnr-chevron-down"></i></span></a>
                <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                    <div class="card">
                        <ul class="list-unstyled card-body">
                            </li>
                            <li><a href="<?php echo $addDot; ?>password/password-change.php"><span><span class="align-middle">Change Password</span></span></a>
                            <li><a href="<?php echo $addDot; ?>logout.php"><span><span class="align-middle">Sign Out</span></span></a>
                           
                            </li>
                        </ul>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.dropdown-card-profile -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-nav -->
    </div>
    <!-- /.container -->
</nav>