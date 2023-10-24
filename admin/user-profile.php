<?php
include('authentication.php');
include('includes/conn.php');
include('includes/header.php');
include('includes/sidebar.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="images/user.png" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['user_details']["Fname"]." ".$_SESSION['user_details']["Lname"];?></h2>
              <h3><?php echo $_SESSION['user_details']["course"];?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <?php
                        include('includes/conn.php');
                        $id = $_SESSION['user_details']['id'];
                        $query = "SELECT * FROM `client` WHERE `id` = '$id'";
                        $query_run = mysqli_query($conn, $query);
                        $row = mysqli_num_rows($query_run);
                        foreach ($query_run as $row) {
                    ?>
                  <h5 class="card-title">Profile Details</h5>
                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['schoolID'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['lastname'].", ".$row['firstname']." ".$row['middlename'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Course</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['course'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Year</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['yearlevel'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Section</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['section'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['email'];?></div>
                  </div>
                
                       
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="process.php">

                    <div class="row mb-3">
                      <label for="schoolID" class="col-md-4 col-lg-3 col-form-label">School ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="schoolID" type="text" class="form-control" id="schoolID" value="<?php echo $row['schoolID'];?>">
                        <input name="id" type="hidden" class="form-control" id="id" value="<?php echo $row['id'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="FirstName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FirstName" type="text" class="form-control" id="FirstName" value="<?php echo $row['firstname'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="MiddleName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="MiddleName" type="text" class="form-control" id="MiddleName" value="<?php echo $row['middlename'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="LastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="LastName" type="text" class="form-control" id="LastName" value="<?php echo $row['lastname'];?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="course" class="col-md-4 col-lg-3 col-form-label">Course</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="course" type="text" class="form-control" id="course" value="<?php echo $row['course'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="yearlvl" class="col-md-4 col-lg-3 col-form-label">Year</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="yearlvl" type="text" class="form-control" id="yearlvl" value="<?php echo $row['yearlevel'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="section" class="col-md-4 col-lg-3 col-form-label">Section</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="section" type="text" class="form-control" id="section" value="<?php echo $row['section'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo $row['email'];?>">
                      </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="SaveChanges">Save Changes</button>
                    </div>

                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="process.php">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                        <input name="id" type="hidden" class="form-control" id="id" value="<?php echo $_SESSION['user_details']["id"];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                        <div class="" id="newPassword-label">

                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                        <div class="" id="renewPassword-label">

                      </div>
                      </div>
                    </div>

                    <div class="form-check mb-2 mt-1">
                        <input class="form-check-input showPassword" type="checkbox">
                        <label class="form-check-label">
                        Show Password
                        </label>
                    </div>
                    <!-- Checkbox for showing inputed password -->
                    <script>
                        var toggle = document.querySelector('.showPassword');
                        var currentPassword = document.querySelector('#currentPassword');
                        var newPassword = document.querySelector('#newPassword');
                        var renewPassword = document.querySelector('#renewPassword');

                        toggle.addEventListener("click", handleToggleClick, false);

                        function handleToggleClick(event) {
                        if (this.checked) {
                            console.warn("Change input 'type' to: text")
                            currentPassword.type = 'text';
                            newPassword.type = 'text';
                            renewPassword.type = 'text';
                        }else{
                            console.warn("Change input 'type' to: password")
                            currentPassword.type = 'password';
                            newPassword.type = 'password';
                            renewPassword.type = 'password';
                        }
                        }
                    </script>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- SweetAlert Notification Prompt Code -->
  <script src="js/sweetalert.min.js"></script>
        <?php
            if (isset($_SESSION['status'])){
        ?>
            <script>
                swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "<?php echo $_SESSION['status_text']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "<?php echo $_SESSION['status_btn']; ?>",
            });
            </script>
            
            <?php
            unset($_SESSION['status']);
            }
        ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

  <!-- Password Validator for Change Password-->
  <script type="text/javascript">
    $(document).ready(function(){
        $("#newPassword").keyup(function(){
            var password = $(this).val();
            var passwordBox = document.getElementById("newPassword");
            var label = document.getElementById("newPassword-label");

            // Validations
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&_-]"); //Special Character.

            var passed = 0;

            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                passed++;
                }
            }
            //Password Length.
            if (password.length >= 8 && passed == 4) {
                var passed = 5;
            }

            //Progress Bar
            switch (passed) {
                case 0:
                    
                case 1:
                    
                case 2:
                        passwordBox.classList = "form-control border border-danger"
                        label.classList = "form-label fs-6 text-danger";
                        label.innerHTML = "Strenght: Weak";
                    break;
                case 3:
                        passwordBox.classList = "form-control border border-warning"
                        label.classList ="form-label fs-6 text-warning";
                        label.innerHTML = "Strenght: Medium";
                    break;
                case 4:
                        passwordBox.classList = "form-control border border-primary"
                        label.classList ="form-label fs-6 text-primary";
                        label.innerHTML = "Strenght: Strong";
                    break;
                case 5:
                        passwordBox.classList = "form-control is-valid"
                        label.classList ="form-label fs-6 text-success";
                        label.innerHTML = "Strenght: Very Strong";
                    break;
                default:
                    break;
            }
            
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#renewPassword").keyup(function(){
            var cPassword = $(this).val();
            var password = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("renewPassword");
            var label = document.getElementById("renewPassword-label");

            if (cPassword == null || cPassword == "") {
                
            }
            else if (cPassword == password) {
               confirmPassword.classList="form-control is-valid";
                label.innerHTML = "Password matched!";
                label.classList = "form-label fs-6 text-success";
                document.getElementById("changePassword").type = "submit";


            }else{
                confirmPassword.classList="form-control is-invalid";
                label.innerHTML = "Password Do not matched!";
                label.classList = "form-label fs-6 text-danger";
                document.getElementById("changePassword").type = "button";
            }
        });
    });
</script>

</body>

</html>