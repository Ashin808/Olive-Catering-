<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../Asset/Templates/Admin/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Asset/Templates/Admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Asset/Templates/Admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../Asset/Templates/Admin/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../Asset/Templates/Admin/assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="adminhomepage.php" class="logo">
              <img
                src="../Asset/Templates/Admin/assets/img/kaiadmin/logo.png"
                alt="navbar brand"
                class="navbar-brand"
                style="width: 100px; height:100px" 
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="adminhomepage.php"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <!-- <span class="caret"></span> -->
                </a>
                <!-- <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="../demo1/index.html">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div> -->
              </li>
              <!-- <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li> -->
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Package</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <!-- <li> 
                      <a href="components/avatars.html">
                        <span class="sub-item">Avatars</span>
                      </a>
                    </li> -->
                    <li>
                      <a href="type.php">
                        <span class="sub-item">Add package type</span>
                      </a>
                    </li>
                    <li>
                      <a href="package.php">
                        <span class="sub-item">Create Package</span>
                      </a>
                    </li>
                    <li>
                      <a href="foodcategory.php">
                        <span class="sub-item">Create Food Category</span>
                      </a>
                    </li>
                    <li>
                      <a href="food.php">
                        <span class="sub-item">Add Food</span>
                      </a>
                    </li>
                    <!-- <li>
                      <a href="components/notifications.html">
                        <span class="sub-item">Notifications</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/sweetalert.html">
                        <span class="sub-item">Sweet Alert</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/font-awesome-icons.html">
                        <span class="sub-item">Font Awesome Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/simple-line-icons.html">
                        <span class="sub-item">Simple Line Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/typography.html">
                        <span class="sub-item">Typography</span>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>Sidebar Layouts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="sidebar-style-2.html">
                        <span class="sub-item">Sidebar Style 2</span>
                      </a>
                    </li>
                    <li>
                      <a href="icon-menu.html">
                        <span class="sub-item">Icon Menu</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Forms</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="forms/forms.html">
                        <span class="sub-item">Basic Form</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#tables">
                  <i class="fas fa-table"></i>
                  <p>Tables</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="tables">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="tables/tables.html">
                        <span class="sub-item">Basic Table</span>
                      </a>
                    </li>
                    <li>
                      <a href="tables/datatables.html">
                        <span class="sub-item">Datatables</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-map-marker-alt"></i>
                  <p>Add Place</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="district.php">
                        <span class="sub-item">District</span>
                      </a>
                    </li>
                    <li>
                      <a href="place.php">
                        <span class="sub-item">Place</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Charts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="charts/charts.html">
                        <span class="sub-item">Chart Js</span>
                      </a>
                    </li>
                    <li>
                      <a href="charts/sparkline.html">
                        <span class="sub-item">Sparkline</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
              <?php
// Include your database connection file
include('../Asset/Connection/Connection.php');

// Query to count complaints
$complaintQuery = "SELECT COUNT(*) AS complaint_count FROM tbl_complaint where complaint_reply='' ";
$complaintResult = $con->query($complaintQuery);
$complaintData = $complaintResult->fetch_assoc();
$complaintCount = $complaintData['complaint_count'];


?>

<!-- Your existing template menu -->
<ul class="nav">
    <li class="nav-item">
        <a href="viewallcomplaints.php">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Complaints</p>
            <span class="badge badge-success"><?php echo $complaintCount; ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="viewallfeedback.php">
            <i class="fas fa-file"></i>
            <p>Feedbacks</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
    <!-- Other menu items can go here -->
</ul>

              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars"></i>
                  <p>Menu Levels</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav1">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav2">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="../Asset/Templates/Admin/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                
                  
                  
                
                
                
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="../Asset/Templates/Admin/assets/img/adminlogo.jpeg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Admin</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      
                      <li>
                        
                        
                        <a class="dropdown-item" href="../Logout.php">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
              <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
              <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div> -->
          </div>
          <div class="row">
          <?php
include('../Asset/Connection/Connection.php');

// Query to count pending booking requests
$bookingQuery = "SELECT COUNT(*) AS booking_count FROM tbl_booking WHERE booking_status = 0";
$bookingResult = $con->query($bookingQuery);
$bookingCount = 0; // Default count

if ($bookingResult) {
    $bookingData = $bookingResult->fetch_assoc();
    $bookingCount = $bookingData['booking_count'];
}
?>

<div class="col-sm-6 col-md-3">
    <a href="viewbookingreq.php" class="card card-stats card-round" style="text-decoration: none;">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="viewbookingreq">Order Requests</p>
                        <?php if ($bookingCount > 0): ?>
                            <span class="badge badge-danger"><?php echo $bookingCount; ?> New</span>
                        <?php else: ?>
                            <!-- <span class="badge badge-secondary">No New</span> -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
            <div class="col-sm-6 col-md-3">
              <a href="Acceptedbooking.php" class="card card-stats card-round" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fas fa-check-circle"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="Acceptedbooking">Accepted Orders</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3">
              <a href="Rejectedbooking.php" class="card card-stats card-round" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-ban"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="Rejectedbooking">Rejected Orders</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <?php






$search = isset($_GET['search']) ? $_GET['search'] : '';

// Initial query with sorting
$query = "
    SELECT 
        *
    FROM tbl_user u
    INNER JOIN tbl_place p ON u.place_id = p.place_id
    INNER JOIN tbl_district d ON p.district_id = d.district_id
";

// Add search condition if search input is present
if (!empty($search)) {
    $search = $con->real_escape_string($search); // Escape special characters
    $query .= " WHERE 
        u.user_name LIKE '%$search%' OR 
        u.user_date LIKE '%$search%' OR 
        u.user_email LIKE '%$search%' OR 
        u.user_phone LIKE '%$search%' OR 
        d.district_name LIKE '%$search%' OR 
        p.place_name LIKE '%$search%'";

}

// Order by created_at in descending order
$query .= " ORDER BY user_date DESC"; // Ensure to replace 'created_at' with your actual timestamp column name

$result = $con->query($query);

// Handle verification and rejection as you have already done...

?>
<style>
    .profile-picture {
        width: 50px; 
        height: 50px; 
        border-radius: 50%; 
        object-fit: cover; 
    }
    .custom-search-btn {
    background-color: #007bff; /* Change this to your desired color */
    color: white; /* Text color */
    border: none; /* Remove border */
    border-radius: 20px; /* Rounded corners */
    padding: 8px 20px; /* Adjust size */
    font-size: 14px; /* Adjust font size */
    transition: background-color 0.3s ease; /* Smooth hover effect */
    } 
    .btn {
    padding: .65rem 1.4rem;
    font-size: 1rem;
    font-weight: 500;
    opacity: 1;
    border-radius: 22px;
    }
    .form-control {
    font-size: 1rem;
    border-color: #ebedf2;
    padding: .6rem 1rem;
    height: inherit !important;
    border-width: 4px;
}

</style>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">User Information</h4>
                <div class="d-flex">
                    <form method="GET" action="" class="form-inline">
                        <input type="text" name="search" placeholder="Search" class="form-control mr-2" value="<?php echo htmlspecialchars($search); ?>" required style="width: 300px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="adminhomepage.php" class="btn btn-secondary ml-2">Reset</a> <!-- Change 'your_page.php' to the actual page name -->
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table id="user-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>District</th>
                            <th>Place</th>
                            <th>Proof</th>
                            <th>Account Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['user_name']}</td>";
                            echo "<td><a href='../Asset/Files/user/Photo/{$row['user_photo']}'><img class='profile-picture' src='../Asset/Files/user/photo/{$row['user_photo']}' alt='User Photo' width='50'></a></td>";
                            echo "<td>{$row['user_email']}</td>";
                            echo "<td>{$row['user_phone']}</td>";
                            echo "<td>{$row['district_name']}</td>";
                            echo "<td>{$row['place_name']}</td>";
                            echo "<td><a href='../Asset/Files/user/proof/{$row['user_proof']}'><img src='../Asset/Files/user/proof/{$row['user_proof']}' alt='User Proof' width='50'></a></td>";
                            echo "<td>{$row['user_date']}</td>";
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

        <footer class="footer">
          <!-- <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="http://www.themekita.com">
                    ThemeKita
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Licenses </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
          </div> -->
        </footer>
      </div>

      <!-- Custom template | don't include it in your project! -->
      <!-- <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                <br />
                <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button type="button" class="changeTopBarColor" data-color="dark"></button>
                <button type="button" class="changeTopBarColor" data-color="blue"></button>
                <button type="button" class="changeTopBarColor" data-color="purple"></button>
                <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                <button type="button" class="changeTopBarColor" data-color="green"></button>
                <button type="button" class="changeTopBarColor" data-color="orange"></button>
                <button type="button" class="changeTopBarColor" data-color="red"></button>
                <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                <br />
                <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                <button type="button" class="changeTopBarColor" data-color="green2"></button>
                <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                <button type="button" class="changeTopBarColor" data-color="red2"></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button type="button" class="changeSideBarColor" data-color="white"></button>
                <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                <button type="button" class="changeSideBarColor" data-color="dark2"></button>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div> -->
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="../Asset/Templates/Admin/assets/js/core/popper.min.js"></script>
    <script src="../Asset/Templates/Admin/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../Asset/Templates/Admin/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../Asset/Templates/Admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../Asset/Templates/Admin/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../Asset/Templates/Admin/assets/js/setting-demo.js"></script>
    <script src="../Asset/Templates/Admin/assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
</body>

</html>