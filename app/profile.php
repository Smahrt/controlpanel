<?php
     session_start();
    include('session.php');

    $sqle = "SELECT * FROM aggregators";
    $resulte = $dbh->query($sqle);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Access Panel - <?php echo $user_log['firstname']; ?> | User</title>

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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-5/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
 
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
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
                                <a href="logout.php" data-toggle="tooltip" data-placement="bottom" data-original-title="Logout" style="text-shadow: none;" class="btn ink-reaction btn-icon-toggle btn-lg btn-loading-state btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-fw fa-power-off"></i></a>
                            </div>
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
				<!-- END PROFILE HEADER  -->

				<section>
					<div class="section-body no-margin">
						<div class="row">
                            <div class="col-md-3"></div>
							<!-- BEGIN PROFILE MENUBAR -->
							<div class="col-md-6">
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
											</li>
                                            <?php } ?>
										</ul>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END PROFILE MENUBAR -->
                            <div class="col-md-3"></div>
						</div><!--end .row -->
                        
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
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">
                
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->


		<!-- BEGIN JAVASCRIPT -->
		
		<script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../assets/js/libs/spin.js/spin.min.js"></script>
        <script src="../assets/js/core/mylib/jquery.validate.min.js"></script>
		<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="../assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="../assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
		<script src="../assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="../assets/js/core/custom.js"></script>
        
        <!-- END JAVASCRIPT -->

	</body>
</html>
