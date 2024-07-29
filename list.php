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
              Travel Order/Authority    
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="index2.php" class="nav-link ">
            <i class="fab fa-wpforms"></i>
              <p>
                Pass Slip
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="index3.php" class="nav-link">
            <i class="fab fa-wpforms"></i>
              <p>
                Locator Slip
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
          <h1 class="m-0">Request Form</h1>
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

 <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card mt-2">
          <div style="font-size:18px" class="card-header bg-dark">
            <h3 class="card-title" style="color:white;">Your Request Form</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab1"><b>TRAVEL ORDER</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab2"><b>PASS SLIP</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab3"><b>LOCATOR SLIP</b></a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div id="tab1" class="tab-pane active"><br>
                <div class="table-responsive">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Purpose Of Travel</th>
                        <th>Destination</th>
                        <th>From:</th>
                        <th>To:</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
              <div id="tab2" class="tab-pane fade"><br>
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Position</th>
                        <th>Time Of Leave</th>
                        <th>Time of Return</th>
                        <th>Purpose</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
              <div id="tab3" class="tab-pane fade"><br>
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Permanent Station</th>
                        <th>Purpose of Travel</th>
                        <th>Date & Time</th>
                        <th>Official</th>
                        <th>Destination</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


<div class="personnel-form1" id="personnelForm1" style="display:none;">
    <img id="img2" class="img2" src="img/header1.JPG">
    <p class="line">_____________________________________________________________</p>
    <p class="title">PASS SLIP</p>
    <div class="custom-card" style="border:1px solid gray; margin-right: 2em; margin-left:2em">
        <div class="px-2 d-flex mt-1">
            <div class="flex-grow-1"></div>
            <label>Date:</label>
            <input class="form-control w-25 mb-5 date">
        </div>
        <div class="px-2 d-flex">
            <label>Name:</label>
            <input class="form-control w-100 mb-3 name">
        </div>
        <div class="px-2 d-flex">
            <label>Section:</label>
            <input class="form-control w-100 mb-3 section">
        </div>
        <div class="px-2 d-flex">
            <label>Position:</label>
            <input class="form-control w-100 mb-3 position">
        </div>
        <div class="d-flex justify-content-between mb-1">
            <div class="px-2 d-flex align-items-center">
                <label class="">Time (Leave):</label>
                <input class="form-control w-100 time_leave">
            </div>
            <div class="px-2 d-flex align-items-center">
                <label class="">Time (Return):</label>
                <input class="form-control w-100 time_return">
            </div>
        </div>
        <div class="px-2 d-flex">
            <label>Purpose:</label>
            <input class="ms-2 form-control w-100 mb-3 purpose">
        </div>
        <div>
            <p style="margin-right:4em; text-align:right">_________________</p>
            <label style="margin-top:-1em; margin-right:7em; text-align:right">Signature</label>
        </div>
        <div>
            <p style="text-align:left" class="px-2 mb-4">Administrative Office:</p>
        </div>
        <div style="text-align:center;" class="mb-5">
            <p><b>ARMANDO B. PASOK</b></p>
            <p style="margin-top: -1.3em">Signature Over Printed Name</p>
        </div>
    </div>
    <img style="margin-top: 20em" class="img1" src="img/footer.jpg">
</div>




  
    <div class="personnel-form2" id="personnelForm2" style="display:none;">
        <p  style="margin-left:4em; margin-top:2em; font-family:'Bookman Old Style', Georgia, serif">REVISED ANNEX E</p>
       <img class="img" id="img2" src="img/header1.JPG">
       <p class="line">_____________________________________________________________</p>
       <p class="title">Locator Slip</p>
       <div class="table">
        <table id="printTable2">
            <tr>
                <th style="border-top:1px solid black">Name</th>
                <td style="width:500px; border-top:1px solid black"></td>
            </tr>
            <tr>
                <th style="width:10px">Position/Designation</th>
                <td></td>
            </tr>
            <tr>
                <th style="width:10px">Permanent Station</th>
                <td></td>
            </tr>
            <tr>
                <th style="width:10px">Purpose of Travel</th>
                <td></td>
            </tr>
            <tr>
                <th style="width:10px">Official Type</th>
                <td></td>
            </tr>
            <tr>
                <th style="width:10px">Date and Time</th>
                <td></td>
            </tr>
            <tr>
                <th style="width:10px">Destination</th>
                <td></td>
            </tr>
            <table id="printTable2">
               <tr>
                <th style="width:360px;"> 
                    <div class="signature2 text-center mt-5">
                        <p>______________________________</p>
                        <p style="font-weight:normal; margin-top:-1em">Signature of Requesting Employee</p>
                    </div>
                </th>
                <td style="width:330px;">
                    <div class="signature2 text-center mt-5">
                        <p style="font-weight:bold">______________________________</p>
                        <p style="font-weight:normal; margin-top:-1em">Signature of Head Office</p>
                    </div>
                </td>
            </tr>
            </table>
        </table>
        <table id="printTable2" class="mt-5">
          <tr>
            <th style="border-top:1px solid black">
              <div>
                <p style="text-align:center;">CERTIFICATION</p>
                 <p stye="font-weight:normal;">To the concerned:</p>
                 <p style="font-weight:normal; margin-left:2em" class="ms-5 ">This is to certify that the above-name DepEd official/personnel has visited or appeared <span><p style="font-weight:normal;margin-top:-1em; margin-bottom:2.5em">in this Office/place for the purpose and during the date and time stated above.</p></span></p>
                 <p style="font-weight:normal; margin-top:-1em; text-align:right; margin-right:6em">Name and Signature:__________________</p>
                 <p style="font-weight:normal; margin-top:-1em; text-align:right; margin-right:6em">Position Designation:__________________</p>
                 <p style="font-weight:normal; margin-top:-1em; text-align:right; margin-right:6em">Office:___________________</p>
              </div>
            </th>
          </tr>
        </table>
        <img style="margin-top:2em" class="img1" src="img/footer.jpg">
       </div>
    </div>



    <div class="personnel-form" id="personnelForm" style="display:none">
    <img class="img" src="img/header.JPG">
    <p class="line">_____________________________________________________________</p>
    <p style="font-size:15px" class="title">TRAVEL AUTHORITY FOR OFFICIAL TRAVEL</p>
    <div class="table">
      <table id="printTable" class="printTable">
        <tr>
          <th style="width:100px">Name</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Position/Designation</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Permanent Station</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Purpose of Travel<br><span><p style="font-size: 12px">(must be supported by attachment)</p></span></th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Host of Activity</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Inclusive Dates</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Destination</th>
          <td></td>
        </tr>
        <tr>
          <th style="width:100px">Fund Source</th>
          <td></td>
        </tr>
        <tr>
          <th colspan="2">
            <p class="text">I hereby attest that the information on this form and in the supporting documents attached hereto are true and correct:</p>
            <div class="signature">
         
            </div>
          </th>
        </tr>
        <tr>
          <th colspan="2">
            <h6 style="margin-bottom:1em; font-weight:bold; margin-top:-.8em">RECOMMENDING APPROVAL:</h6>
            <p class="text">This is to certify that the trip of the requesting employee satisfies all the minimum conditions for authorized official travel and that alternatives to travel are insufficient for purpose stated herein.</p>
            <div class="signature3 mt-4">
              <div>
                <p class="name-signature3">JAYVY C. VEGAFRIA</p>
                <p>Date: ____________________</p>
              </div>
              <p class="signature3">OIC Assistant Schools Division Superintendent</p>
            </div>
          </th>
        </tr>
        <tr>
          <th colspan="2">
            <h6 style="margin-bottom:1em; font-weight:bold; margin-top:-.8em">APPROVED:</h6>
            <div class="signature4 mt-4">
              <div>
                <p class="name-signature4">EDWIN R. MARIBOJOC, CESO V</p>
                <p>Date: ____________________</p>
              </div>
              <p class="signature4">Schools Division Superintendent</p>
            </div>
          </th>
        </tr>
      </table>
      <img class="img1" style="margin-top:1em" src="img/footer.jpg">
    </div>
</div>

    
  <?php include('footer.php');?>