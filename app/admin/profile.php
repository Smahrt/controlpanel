<?php
    session_start();
    include('../config/config.php');
    include('../session.php');

   	    $sql = "SELECT firstname, lastname, gender, location, date_logged_in, time_logged_in, aggregator, access_time
        FROM users INNER JOIN users_stats 
        ON users.username = users_stats.username";
        $result = $dbh->query($sql);
        $user_data_array = $result->fetch(PDO::FETCH_ASSOC);
        
        $sqli = "SELECT * FROM users";
        $resulti = $dbh->query($sqli);
        
        $sqle = "SELECT * FROM aggregators";
        $resulte = $dbh->query($sqle);

       $myFile = "userstats"; //JSON file
       $userdata = array(); // create empty array

      try{          
          while ($user_data_array = $result->fetch(PDO::FETCH_ASSOC)) {
                   $userdata[] = $user_data_array;
          }
           
           $jsondata = json_encode($userdata, JSON_PRETTY_PRINT);

           //write json data into data.json file
           if(file_put_contents($myFile, $jsondata)) {
                $success = "Successfully populated User Stats table";
            }
           else 
                echo "Error populating User Stats Table";

       }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
       }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Access Panel - <?php echo $user_log['firstname']; ?> | Admin</title>

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
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="../../assets/css/theme-5/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />

		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="../app/">
									<span class="text-lg text-bold text-primary">ACCESS PANEL</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->

			<!-- BEGIN CONTENT-->
			<div id="content">

				<!-- BEGIN PROFILE HEADER -->
				<section class="full-bleed">
					<div class="section-body style-default-dark force-padding text-shadow">
						<div class="overlay overlay-shade-top stick-top-left height-3"></div>
						<div class="row">
							<div class="col-md-3 col-xs-5">
								<h3>Welcome, <?php echo $user_log['firstname']; ?><br/><small><?php echo $user_log['role']; ?></small></h3>
							</div><!--end .col -->
                            <div class="col-md-9">
                                <a href="../logout.php" data-toggle="tooltip" data-placement="bottom" data-original-title="Logout" style="text-shadow: none;" class="btn ink-reaction btn-icon-toggle btn-lg btn-loading-state btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-fw fa-power-off"></i></a>
                            </div>
						</div><!--end .row -->
                        <div class="row">
								<div class="width-3 text-center pull-right">
									<button type="button" class="btn btn-default ink-reaction" data-toggle="modal" data-target="#textModal">View Users</button>
								</div>
								<div class="width-5 text-center pull-right">
									<a href="signup.php" style="text-shadow: none;" class="btn btn-default ink-reaction">Create New User</a>
								</div>
                        </div>
					</div><!--end .section-body -->
				</section>
				<!-- END PROFILE HEADER  -->

				<section>
					<div class="section-body no-margin">
						<div class="row">
							<div class="col-md-9">
								<h2>User Stats</h2>
							</div><!--end .col -->
							<div class="col-md-9">
								<div class="table-responsive">
									<table id="usertable" class="table table-striped table-hover">
										<thead>
											<tr>
												<th class="sort-alpha">First Name</th>
												<th class="sort-alpha">Last Name</th>
												<th class="sort-alpha">Gender</th>
												<th class="sort-alpha">Location</th>
												<th class="sort-num">Date Logged in</th>
												<th>Time Logged in</th>
												<th>Aggregator Accessed</th>
												<th>Time of Access</th>
											</tr>
										</thead>
                                        
										<tfoot>
											<tr>
												<th class="sort-alpha">First Name</th>
												<th class="sort-alpha">Last Name</th>
												<th class="sort-alpha">Gender</th>
												<th class="sort-alpha">Location</th>
												<th class="sort-num">Date Logged in</th>
												<th>Time Logged in</th>
												<th>Aggregator Accessed</th>
												<th>Time of Access</th>
											</tr>
										</tfoot>
										
									</table>
								</div><!--end .table-responsive -->
							</div><!--end .col -->
							<!-- END MESSAGE ACTIVITY -->

							<!-- BEGIN PROFILE MENUBAR -->
							<div class="col-md-3">
								<div class="card card-underline style-default-dark">
									<div class="card-head">
										<header class="opacity-75"><small>Aggregators</small></header>
									</div><!--end .card-head -->
									<div class="card-body no-padding">
										<ul class="list">
                                            <?php while($link_array = $resulte->fetch(PDO::FETCH_ASSOC)){ ?>
                                            <li class="tile">
												<a class="tile-content ink-reaction spook-confirm" href="#" id="<?php echo $link_array['id']; ?>" data-toggle="modal" data-target="#confirmLinkModal">
                                                    <?php echo $link_array['link_title']; ?>
                                                </a>
                                                <a id="<?php echo $link_array['id']; ?>" class="btn btn-flat end-link-confirm ink-reaction btn-default" data-toggle="modal" data-target="#confirmDeleteModal">
													<i class="fa fa-trash"></i>
												</a>
											</li>
                                            <?php } ?>
										</ul>
                                        
									</div><!--end .card-body -->
                                    
								</div><!--end .card -->
                                <div class="pull-right">
                                    <button type="button" id="add-new-link" class="btn btn-default-dark ink-reaction" data-toggle="modal" data-target="#addLinkModal">Add New Link</button>
                                </div>
							</div><!--end .col -->
							<!-- END PROFILE MENUBAR -->

						</div><!--end .row -->
                        
                        <div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="textModalLabel">View Users</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="viewusertable" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="sort-num">#</th>
                                                    <th class="sorting_asc"></th>
                                                    <th class="sort-alpha">First Name</th>
                                                    <th class="sort-alpha">Last Name</th>
                                                    <th class="sort-alpha">Gender</th>
                                                    <th class="sort-alpha">Location</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 1; ?>
                                                <?php while($user_array = $resulti->fetch(PDO::FETCH_ASSOC)){ ?>
                                                <?php 
                                                    if ($user_array['role'] == "Admin"){
                                                        $badge = "<span class='badge style-accent'>Admin</span>";
                                                    }else{
                                                        $badge = "<span class='badge style-primary-light'>User</span>";
                                                    }
                                                ?>
                                                <tr>
                                                    <?php echo '<td>'.$id.'</id>' ?>
                                                    <?php echo '<td>'.$badge.'</id>' ?>
                                                    <?php echo '<td>'.$user_array['firstname'].'</td>' ?>
                                                    <?php echo '<td>'.$user_array['lastname'].'</td>' ?>
                                                    <?php echo '<td>'.$user_array['gender'].'</td>' ?>
                                                    <?php echo '<td>'.$user_array['location'].'</td>' ?>
                                                    <td class="text-right">
                                                        <button type="button" id="<?php echo $user_array['username']; ?>" class="btn btn-icon-toggle edit_user" data-toggle="tooltip" data-placement="top" data-original-title="Edit User"><i class="fa fa-pencil"></i></button>
                                                        <button type="button" id="<?php echo $user_array['username']; ?>" class="btn btn-icon-toggle confirm-kill-user" data-toggle="modal" data-target="#killUserModal" data-placement="top"><i class="fa fa-trash-o"></i></button>
                                                    </td>
                                                </tr>
                                                <?php $id++; ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="sort-num">#</th>
                                                    <th></th>
                                                    <th class="sort-alpha">First Name</th>
                                                    <th class="sort-alpha">Last Name</th>
                                                    <th class="sort-alpha">Gender</th>
                                                    <th class="sort-alpha">Location</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>

                                        </table>
								    </div><!--end .table-responsive -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- END view users modal -->
                        
                        <div class="modal fade" id="addLinkModal" tabindex="-1" role="dialog" aria-labelledby="addLinkModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="addLinkModalLabel">Add New Link</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form form-validate">
                                        <div class="form-group">
                                            <input type="text" id="link-name" class="form-control" >
                                            <label for="Link Name">Link Name</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ip-address" maxlength="15" class="form-control">
                                            <label for="ip-address">IP Address</label>
                                        </div>
                                        
                                        <button type="button" id="add-link" class="btn btn-primary ink-reaction">Add Link</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- END add link modal -->
                        
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="confirmDeleteModalLabel">Confirm Link Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to remove this link?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary end-link">Remove Link</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /. end remove link modal-dialog -->
                        </div>
                        
                        <div class="modal fade" id="confirmLinkModal" tabindex="-1" role="dialog" aria-labelledby="confirmLinkModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="confirmLinkModalLabel">Proceed</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to proceed?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary spook">Proceed</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        
                        <div class="modal fade" id="killUserModal" tabindex="-1" role="dialog" aria-labelledby="killUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="killUserModalLabel">Confirm User Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this user?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary kill-user">Delete User</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">
                
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->


		<!-- BEGIN JAVASCRIPT -->
		
		<script src="../../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../../assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../../assets/js/libs/spin.js/spin.min.js"></script>
        <script src="../../assets/js/core/mylib/jquery.validate.min.js"></script>
		<script src="../../assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../../assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="../../assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="../../assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../../assets/js/core/source/App.js"></script>
		<script src="../../assets/js/core/source/AppNavigation.js"></script>
		<script src="../../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../../assets/js/core/source/AppCard.js"></script>
		<script src="../../assets/js/core/source/AppForm.js"></script>
		<script src="../../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../../assets/js/core/source/AppVendor.js"></script>
		<script src="../../assets/js/core/demo/Demo.js"></script>
		<script src="../../assets/js/core/demo/DemoTableDynamic.js"></script>
        <script src="../../assets/js/core/custom.js"></script>
        
        <!-- END JAVASCRIPT -->

	</body>
</html>