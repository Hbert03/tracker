<?php 
include('header.php'); 
include('class.php');

$count1 = new Employee();
$count_travelOrder = $count1->getValue("count");

$count2 = new Employee1();
$count_locator_slip = $count2->getValue("count1");

$count3 = new Employee2();
$count_pass_slip = $count3->getValue("count2");
?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="nav-link" data-widget="navbar-logout" role="button"  onclick="confirmLogout1()">
        <i class="fas fa-sign-out-alt"></i>
          </a>
          <form id="logoutForm1" action="logout.php" method="post" style="display: none;">
           <input type="hidden" name="confirm_logout1" value="1">
          </form>
      </li>
    </ul>
</nav>


    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/profile.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hi, <?php echo $_SESSION['office_name']; ?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard    
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
      <a href="pending.php" class="nav-link" id="pending-approval-link">
        <i class="fas fa-list"></i>
        <p>
          Pending Approval
          <span id="pending-count" class="badge badge-danger"></span>
        </p>
      </a>
    </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $count_travelOrder; ?> <span><p>Travel Order</p></span></h3>

                <p>Office Of The SDS</p>
              </div>
              <div class="icon">
              <i class="fas fa-users"></i>
              </div>
              <a href="travel_order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $count_locator_slip; ?> <span><p>Locator Slip</p></span> </h3>

                <p>Office of the CID & SGOD</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-friends"></i>
              </div>
              <a href="locator_slip.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $count_pass_slip; ?><span><p>Pass Slip</p></span></h3>

                <p>All Division Employee</p>
              </div>
              <div class="icon">
              <i class="fas fa-users"></i>
              </div>
              <a href="pass_slip.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        <!-- Main row -->
</section>
  </div>
  <!-- /.content-wrapper -->
 
  <?php include('footer.php');?>