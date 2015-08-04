<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>ApproveNow | Create Account Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="<?=site_url();?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=site_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="<?=site_url();?>assets/img/login-bg/bg-6.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated flipInX">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    ApproveNow
                    <small>Register Now</small>
                </div>
                <div class="icon">
                    <i class="fa fa-share-square-o"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
		<form action="<?=site_url();?>approveRegister/createAccount" method="POST" class="margin-bottom-0">
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Number</label>
			    <input type="text" class="form-control" name="accountNumber" placeholder="Account Number" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Title Id</label>
			    <input type="text" class="form-control" name="titleId" placeholder="Title Id" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Membership Level Number</label>
			    <input type="text" class="form-control" name="memLevelNo" placeholder="Membership Level Number" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">First Name</label>
			    <input type="text" class="form-control" name="accFirstName" placeholder="First Name" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Middle Name</label>
			    <input type="text" class="form-control" name="accMidName" placeholder="Middle Name" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Last Name</label>
			    <input type="text" class="form-control" name="accLastName" placeholder="Last Name" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Genral Status Code</label>
			    <input type="text" class="form-control" name="genStatusCode" placeholder="Genral Status Code" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Email Address</label>
			    <input type="text" class="form-control" name="accEmail" placeholder="Email Address" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Organization Name</label>
			    <input type="text" class="form-control" name="accOrgName" placeholder="Organization Name" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Web Address</label>
			    <input type="text" class="form-control" name="webAddress" placeholder="Web Address" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">External Link</label>
			    <input type="text" class="form-control" name="externalLink" placeholder="External Link" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Password</label>
			    <input type="text" class="form-control" name="accPassword" placeholder="Account Password" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Type</label>
			    <input type="text" class="form-control" name="accType" placeholder="Account Type" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Id</label>
			    <input type="text" class="form-control" name="accId" placeholder="Account Id" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Username</label>
			    <input type="text" class="form-control" name="accUsername" placeholder="Account Username" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Company Id</label>
			    <input type="text" class="form-control" name="companyId" placeholder="Company Id" />
			</div>
			<div class="col-sm-4 form-group">
			    <label  class="control-label">Account Name</label>
			    <input type="text" class="form-control" name="accName" placeholder="Account Name" />
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-offset-4 col-sm-4 form-group">
			    <input type="hidden" name="proceed" value="Yes" />
			    <button type="submit" class="btn btn-success btn-block">Sign me Up</button>
			</div>
		    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=site_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?=site_url();?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?=site_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?=site_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?=site_url();?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?=site_url();?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?=site_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=site_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=site_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=site_url();?>assets/js/login-v2.demo.min.js"></script>
	<script src="<?=site_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
    </body>
</html>