<?php
        session_start();
        include ('config/config.php');
        //include ('session.php');

        if(isset($_SESSION['login_user'])){
            
            if($role == "Admin"){
                header("location: admin/profile.php");
            }else{
                header("location: profile.php");
            }
        }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


if(isset ($_POST['submit'])){
    $user = $_POST['user'];
    $username = test_input($user);
   
    $pass = $_POST['pass'];
    $password = test_input($pass);
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $dbh->query($sql);
    $resultArray = $result->fetch(PDO::FETCH_ASSOC);
    
    $usernameQuery = $resultArray['username'];
    $passwordQuery = $resultArray['password'];
    $role = $resultArray['role'];
    
    if($resultArray==null){
        $error="Username/Password Invalid.";
    }
    else{
        if(password_verify($password, $passwordQuery)){
            
            
            $date = date('d-m-Y');
            $time = date('h:i a');
            $sql ="INSERT INTO users_stats(username, date_logged_in, time_logged_in) VALUES('$usernameQuery','$date','$time')";
            
               if($dbh->query($sql)){
                    $side_sql = "SELECT * FROM users_stats ORDER BY id desc";
                    $side_result = $dbh->query($side_sql);
                    $user_stat_array = $side_result->fetch(PDO::FETCH_ASSOC);

                    $user_logged_id = $user_stat_array['id'];

                    $_SESSION['login_user'] = $usernameQuery;
                    $_SESSION['login_user_id'] = $user_logged_id;
                   
                   if($role == "Admin"){
                    header('location:admin/profile.php');
                    }
                    else{
                        header('location:profile.php');
                    }
                }
                else{
                      $error="Please try again";
                }
        }
        else{
            $error="Username/Password Invalid.";
        }//closes check for same username and password
        
    }//closes else after check for valid username
    
    $dbh=null;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Access Panel - Login</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/material-design-iconic-font.min.css?1421434286" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed">
        
		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
            
			<div class="spacer"></div>
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                
                <?php if( isset($error) ): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                <?php endif; ?>
                
			     <div class="card">
                    <div class="card-head style-primary">
                        <header>User Log in</header>
                    </div>
                    <div class="card-body">
                        <form class="form" action="" accept-charset="utf-8" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" required autocomplete="off" id="user" name="user">
                                <label for="user">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" required autocomplete="off" id="password" name="pass">
                                <label for="password">Password</label>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6 text-right">
                                    <button name="submit" value="submit" class="btn btn-primary btn-loading-state btn-flat ink-reaction" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Hold on...">Login</button>
                                </div><!--end .col -->
                            </div><!--end .row -->
                        </form>
                    </div><!--end .card-body -->
                </div><!--end .card -->
            </div>
            <div class="col-sm-3"></div>
        </section>
				<!-- END LOGIN SECTION -->

				<!-- BEGIN JAVASCRIPT -->
				<script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
				<script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
				<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
				<script src="../assets/js/libs/spin.js/spin.min.js"></script>
				<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
				<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
				<script src="../assets/js/core/source/App.js"></script>
				<script src="../assets/js/core/source/AppNavigation.js"></script>
				<script src="../assets/js/core/source/AppOffcanvas.js"></script>
				<script src="../assets/js/core/source/AppCard.js"></script>
				<script src="../assets/js/core/source/AppForm.js"></script>
				<script src="../assets/js/core/source/AppNavSearch.js"></script>
				<script src="../assets/js/core/source/AppVendor.js"></script>
				<script src="../assets/js/core/demo/Demo.js"></script>
				<!-- END JAVASCRIPT -->
                
			</body>
		</html>
