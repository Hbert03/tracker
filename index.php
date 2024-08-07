<?php include('header.php'); ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="nav-link" data-widget="navbar-logout" role="button"  onclick="confirmLogout()">
        <i class="fas fa-sign-out-alt"></i>
          </a>
          <form id="logoutForm" action="logout.php" method="post" style="display: none;">
           <input type="hidden" name="confirm_logout" value="1">
          </form>
      </li>
    </ul>
</nav>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HOME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/profile.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> Hi, <?php echo $_SESSION['firstname']; ?></a>
        </div>
      </div>

 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <i class="fab fa-wpforms"></i>
              <p>
                Travel Order/Authority     
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="index2.php" class="nav-link">
            <i class="fab fa-wpforms"></i>
              <p>
                Pass Slip
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="index3.php" class="nav-link ">
            <i class="fab fa-wpforms"></i>
              <p>
                Locator Slip
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="list.php" class="nav-link ">
            <i class="fas fa-history"></i>
              <p>
              Request Form
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
            <h1 class="m-0">Travel Order/Authority</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="card">
        <div class="card-header">
            <h4>Fill-up Form</h4>
        </div>
        <div class="card-body">
            <form id="myForm">
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] . ' ' . $_SESSION['middlename'] . '. ' . $_SESSION['lastname'] : ''; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="position" id="position" value="<?php echo isset($_SESSION['position']) ? $_SESSION['position'] : ''; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="permanent_station" id="permanent_station" placeholder="Permanent Station" required>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="purpose_of_travel" id="purpose_of_travel" placeholder="Purpose of Travel" required>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="host_of_activity" id="host_of_activity" placeholder="Host of Activity" required>
                    </div>
                    <div class="col-md-6 mb-1 d-flex align-items-center">
                        <label class="mr-2">From:</label>
                        <input class="form-control mr-2" style="width: 45%;" type="date" name="start_date" id="start_date" required>
                        <label class="mr-2">To:</label>
                        <input class="form-control" style="width: 45%;" type="date" name="end_date" id="end_date" required>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="destination" id="destination" placeholder="Destination" required>
                    </div>
                    <div class="col-md-6 mb-1">
                        <input class="form-control" type="text" name="fund_source" id="fund_source" placeholder="Fund Source" required>
                    </div>
                    <div class="col-md-6 mb-1">
                       <select class="form-control employee" multiple="multiple" name="employee[]"></select>
                    </div>
                </div>
                
                 <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary btn1" name="save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
  </div>

  
  <!-- /.content-wrapper -->

  <?php include('footer.php');?>