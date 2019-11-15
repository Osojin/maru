<!DOCTYPE html>
<html lang="ko">

<head>
<?php
	$conn = mysqli_connect("localhost", "root", "123456", "maru", "3307");
?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sentiment_Soccer</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
	$conn = mysqli_connect("localhost", "root", "123456", "maru", "3307");
?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="far fa-futbol"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sentiment</br>Soccer</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Full View</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- 머리말 dashbord -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Full View</h1>
          </div>

          <!-- 선수 팀 감독 -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">athlete</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
					  <?php
							$query= mysqli_query($conn, "SELECT blog_dictionary.txt as txt
FROM blog_comm join blog_dictionary where blog_dictionary.id=blog_comm.name_id and blog_dictionary.classification=0 GROUP BY name_id order by COUNT(*) desc limit 1;");
							while($row=mysqli_fetch_array($query)){
								echo $row[txt];
							}
						?>
					  </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">coach</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php
							$query= mysqli_query($conn, "SELECT blog_dictionary.txt as txt
FROM blog_comm join blog_dictionary where blog_dictionary.id=blog_comm.name_id and blog_dictionary.classification=2 GROUP BY name_id order by COUNT(*) desc limit 1;");
							while($row=mysqli_fetch_array($query)){
								echo $row[txt];
							}
						?>
					</div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">team</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
						  <?php
							$query= mysqli_query($conn, "SELECT blog_dictionary.txt as txt
FROM blog_comm join blog_dictionary where blog_dictionary.id=blog_comm.name_id and blog_dictionary.classification=1 GROUP BY name_id order by COUNT(*) desc limit 1;");
							while($row=mysqli_fetch_array($query)){
								echo $row[txt];
							}
						?>
						  </div>
                        </div>
                        <div class="col">
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- 빈도수 -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">언급량 변화량</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- 긍정 부정 -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">긍정 부정 비율</h6>
                  
                </div>
                <!-- Card Body -->

                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart" ></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> positive
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> negative
                    </span>
                  </div>
                </div>
              </div>

              </div>
            </div>


          <!-- Content Row -->

          <div class="row">
              <div class="col-xl-12 col-lg-5">
              <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Positive</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="2dataTable" width="100%" cellspacing="0">
                  <thead>
					<tr>
                      <th>name</th>
                      <th>Comment</th>
                      <th>Date</th>
                    </tr>
                  </thead>
				  <tbody>
				 <?php
				 $query= mysqli_query($conn, "select blog_dictionary.txt as txt, blog_comm.content as content, date_format(blog_comm.date, '%Y-%m-%d') as date from blog_comm join
blog_dictionary on blog_comm.name_id=blog_dictionary.id where blog_comm.sentiment=1");
				 while($row=mysqli_fetch_array($query)){
					echo "<tr>";
					echo "<th>".$row[txt]."</th>";
					echo "<th>".$row[content]."</th>";
					echo "<th>".$row[date]."</th>";
					echo "</tr>";
				 }
				 ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
          </div>

          <div class="row">
              <div class="col-xl-12 col-lg-5">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Negative</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                      <thead>
					<tr>
                      <th>name</th>
                      <th>Comment</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                 <tbody>
				 <?php
				 $conn = mysqli_connect("localhost", "root", "123456", "maru", "3307");
				 $query= mysqli_query($conn, "select blog_dictionary.txt as txt, blog_comm.content as content, date_format(blog_comm.date, '%Y-%m-%d') as date from blog_comm join
blog_dictionary on blog_comm.name_id=blog_dictionary.id where blog_comm.sentiment=-1");
				 while($row=mysqli_fetch_array($query)){
					echo "<tr>";
					echo "<th>".$row[txt]."</th>";
					echo "<th>".$row[content]."</th>";
					echo "<th>".$row[date]."</th>";
					echo "</tr>";
				 }
				 ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
          </div>
          </div>
		  
		  
          </div>


        </div>
        <!-- /.container-fluid -->
      </div>


      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.php"></script>
  <script src="js/demo/chart-pie-demo.php"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
