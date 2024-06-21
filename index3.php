<?php include('header.php'); ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
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
    <a href="index3.html" class="brand-link">
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
            <a href="index.php" class="nav-link">
            <i class="fab fa-wpforms"></i>
              <p>
                Travel Order     
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
            <a href="#" class="nav-link active">
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
            <h1 class="m-0">Locator Slip</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     <div class="card">
        <div class="card-header">
            <h4>Fill-up Form</h4>
        </div>
        <div class="card-body">
            <form id="myForm3" >
    <div class="row">
        <div class="col-md-6 mb-1">
            <input class="form-control" type="text" name="name" id="name" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] . ' ' . $_SESSION['middlename'] . '. ' . $_SESSION['lastname'] : ''; ?>" readonly>
        </div>
        <div class="col-md-6 mb-1">
            <input class="form-control" type="text" name="position" id="position"  value="<?php echo isset($_SESSION['position']) ? $_SESSION['position'] : ''; ?>" readonly>
        </div>
        <div class="col-md-6 mb-1">
            <input class="form-control" type="text" name="permanent_station"  id="permanent_station" placeholder="Permanent Station" required>
        </div>
        <div class="col-md-6 mb-1">
            <input class="form-control" type="text" name="purpose_of_travel" id="purpose_of_travel" placeholder="Purpose of Travel" required>
        </div>
        <div class="col-md-6 mb-1">
            <input class="form-control" type="datetime-local" name="datetime" id="datetime"  >
        </div>
   
        <div class="col-md-6 mb-1">
            <input class="form-control" type="text" name="destination" id="destination" placeholder="Destination" required>
        </div>
    </div>
        <div class="col-md-12 mb-1 d-flex ">
        <div class="card w-50" style="margin-left:-.5em; width:22px">
        <div class="form-check">
         <label style="font-weight:normal">Official Business</label>
        <input class="form-check-input" style="margin-left:1em; width:20px; height:20px" type="radio" name="official" id="flexRadioDefault1" value="Official Business" checked>
        <label style="margin-left:3em; font-weight:normal">Official Time</label>
        <input class="form-check-input" style="margin-left:1em; width:20px; height:20px" type="radio" name="official" id="flexRadioDefault2" value="Official Time">
      </div>
      </div>
      </div>
    <div class="card-footer text-center">
        <button type="button" class="btn btn-primary btn3" name="save3">Submit</button>
    </div>
    </form>
    </div>
    </section>

      
  </div>
  <!-- /.content-wrapper -->

  <?php include('footer.php');?>