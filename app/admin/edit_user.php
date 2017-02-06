<?php

    session_start();
    include ('../config/config.php');

    $uname = $_SESSION['edit_this_user'];

    $sql = "SELECT * FROM users WHERE username='$uname'";
    $result = $dbh->query($sql);
    $u_array = $result->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] = 'POST'){
        
		try{
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
            
        if(isset($_POST['submit'])){//This is for when the submit button is clicked
            
            //declaring the variables from html input
            if($_POST['location'] ==""){
                $location = $u_array['location'];
            }else{
                $location =$_POST['location'];
            }
                $gender=$_POST['gender'];
                $role=$_POST['role'];
            
        if($gender=="" || $role ==""){
            $error="You have to put in values in all the fields";
        }
         else {
            $sql ="UPDATE users SET location='$location', gender='$gender', role='$role' WHERE username = '$uname'";
             
            if($dbh->query($sql)){
                $success = "User data successfully updated";
            }else{
                $error = "Failed to update user data";
            }
        } 
        
         
        }//closes if for submit
		$dbh = null;
		}//closes try
		catch(PDOException $e)
		{echo $e->getMessage();}
		}//closes server method


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Access Panel - Edit <?php echo $u_array['firstname']." ".$u_array['lastname']." | ".$u_array['role']; ?></title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/material-design-iconic-font.min.css?1421434286" />
		<!-- END STYLESHEETS -->
        
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

        <!-- BEGIN LOGIN SECTION -->
        <section class="section-account">
            <div class="card contain-lg style-transparent">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">

                            <?php if( isset($error) ): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error; ?>
                                    </div>
                            <?php endif; ?>
                            <?php if( isset($success) ): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $success; ?>
                                        <a href="profile.php" class="btn btn-default-dark ink-reaction pull-right">Go Back</a>
                                    </div>
                            <?php endif; ?>

                            <form id="create_user" class="form form-validate" action="edit_user.php"  method="post" novalidate="novalidate">
                                    <div class="card">
                                        <div class="card-head style-primary">
                                            <header>
                                                <a class="btn btn-flat" href="profile.php">
                                                    <i class="md md-arrow-back"></i>
                                                </a>
                                                Edit User
                                            </header>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <label class="radio-inline radio-styled">
                                                    <input type="radio" required name="role" value="Admin" 
                                                           <?php 
                                                                if($u_array['role'] == "Admin"){
                                                                    echo "checked";
                                                                }
                                                           ?> 
                                                           ><span>Admin</span>
                                                </label>
                                                <label class="radio-inline radio-styled">
                                                    <input type="radio" required  name="role" value="User"
                                                           <?php 
                                                                if($u_array['role'] == "User"){
                                                                    echo "checked";
                                                                }
                                                           ?> 
                                                           ><span>User</span>
                                                </label>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" name="fname" readonly required data-rule-minlength="2" class="form-control" id="Firstname2" value="<?php echo $u_array['firstname']; ?>">
                                                        <label for="Firstname2">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" name="lname" readonly required data-rule-minlength="2" class="form-control" id="Lastname2" value="<?php echo $u_array['lastname']; ?>">
                                                        <label for="Lastname2">Last Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="radio-inline radio-styled">
                                                    <input type="radio" required name="gender" value="Male"
                                                           <?php 
                                                                if($u_array['gender'] == "Male"){
                                                                    echo "checked";
                                                                }
                                                           ?> ><span>Male</span>
                                                </label>
                                                <label class="radio-inline radio-styled">
                                                    <input type="radio" required  name="gender" value="Female"
                                                           <?php 
                                                                if($u_array['gender'] == "Female"){ 
                                                                    echo "checked";
                                                                }
                                                           ?> ><span>Female</span>
                                                </label>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <input type="text" name="uname" required readonly class="form-control" id="Username2" value="<?php echo $u_array['username']; ?>">
                                                <label for="Username2">Username</label>
                                            </div>
                                            <div class="form-group">
                                                <select name="location" id="location" class="form-control">
                                                    <option>&nbsp;</option>
                                                    <option>Abuja FCT</option>
                                                    <option>Abia</option>
                                                    <option>Adamawa</option>
                                                    <option>Akwa Ibom</option>
                                                    <option>Anambra</option>
                                                    <option>Bauchi</option>
                                                    <option>Bayelsa</option>
                                                    <option>Benue</option>
                                                    <option>Borno</option>
                                                    <option>Cross River</option>
                                                    <option>Delta</option>
                                                    <option>Ebonyi</option>
                                                    <option>Edo</option>
                                                    <option>Ekiti</option>
                                                    <option>Enugu</option>
                                                    <option>Gombe</option>
                                                    <option>Imo</option>
                                                    <option>Jigawa</option>
                                                    <option>Kaduna</option>
                                                    <option>Kano</option>
                                                    <option>Katsina</option>
                                                    <option>Kebbi</option>
                                                    <option>Kogi</option>
                                                    <option>Kwara</option>
                                                    <option>Lagos</option>
                                                    <option>Nassarawa</option>
                                                    <option>Niger</option>
                                                    <option>Ogun</option>
                                                    <option>Ondo</option>
                                                    <option>Osun</option>
                                                    <option>Oyo</option>
                                                    <option>Plateau</option>
                                                    <option>Rivers</option>
                                                    <option>Sokoto</option>
                                                    <option>Taraba</option>
                                                    <option>Yobe</option>
                                                    <option>Zamfara</option>

                                                </select>
                                                <label for="Location">Location</label>
                                                <p class="help-block">Currently Selected: <?php echo $u_array['location']; ?></p>
                                            </div>
                                        </div><!--end .card-body -->
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <button name="submit" type="submit" value="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Hold on..." class="btn btn-flat btn-primary ink-reaction btn-loading-state">Update</button>
                                            </div>
                                        </div>
                                    </div><!--end .card -->
                                </form>
                        </div><!--end .col -->
                        <div class="col-sm-3"></div>
                    </div><!--end .row -->
                </div><!--end .card-body -->
            </div><!--end .card -->
        </section>
                <!-- END LOGIN SECTION -->

                <!-- BEGIN JAVASCRIPT -->
                <script src="../../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
                <script src="../../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
                <script src="../../assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
                <script src="../../assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
                <script src="../../assets/js/libs/bootstrap/bootstrap.min.js"></script>
                <script src="../../assets/js/libs/spin.js/spin.min.js"></script>
                <script src="../../assets/js/libs/autosize/jquery.autosize.min.js"></script>
                <script src="../../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
                <script src="../../assets/js/core/source/App.js"></script>
                <script src="../../assets/js/core/source/AppNavigation.js"></script>
                <script src="../../assets/js/core/source/AppOffcanvas.js"></script>
                <script src="../../assets/js/core/source/AppCard.js"></script>
                <script src="../../assets/js/core/source/AppForm.js"></script>
                <script src="../../assets/js/core/source/AppNavSearch.js"></script>
                <script src="../../assets/js/core/source/AppVendor.js"></script>
                <script src="../../assets/js/core/demo/Demo.js"></script>
                <script src="../../assets/js/core/custom.js"></script>
                <!-- END JAVASCRIPT -->


            </body>
        </html>
