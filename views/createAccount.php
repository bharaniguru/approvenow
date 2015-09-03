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
	<link href="<?php echo base_url(); ?>assets/plugins/formValidation/css/formValidation.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<style>
	    .has-feedback .form-control-feedback {
		top: 25px;
		right: 0;
	    }
	    .has-feedback .form-control-feedback {
		top: 0;
		right: 15px;
	    }
	</style>
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
                    <small>Enter Your Details To Register </small>
                </div>
                <div class="icon">
                    <i class="fa fa-share-square-o"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
		<form id="form_validation" action="<?=site_url();?>approveRegister/createAccount" method="POST" class="margin-bottom-0">
		   <div class="col-md-offset-2">
		    <div class="col-md-10">
			
			<div class="col-sm-6 form-group">
			    <label  class="control-label"> Username</label>
			    <input type="text" class="form-control" name="accUsername" placeholder="Username" />
			</div>
			<div class="col-sm-6 form-group">
			    <label  class="control-label"> Password</label>
			    <input type="password" class="form-control" name="accPassword" placeholder="Password" />
			</div>
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Title Id</label>-->
			<!--    <input type="text" class="form-control" name="titleId" placeholder="Title Id" />-->
			<!--</div>-->
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Membership Level Number</label>-->
			<!--    <input type="text" class="form-control" name="memLevelNo" placeholder="Membership Level Number" />-->
			<!--</div>-->
		    </div>
		    <div class="col-md-10">
			<div class="col-sm-6 form-group">
			    <label  class="control-label">First Name</label>
			    <input type="text" class="form-control" name="accFirstName" placeholder="First Name" />
			</div>
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Middle Name</label>-->
			<!--    <input type="text" class="form-control" name="accMidName" placeholder="Middle Name" />-->
			<!--</div>-->
			<div class="col-sm-6 form-group">
			    <label  class="control-label">Last Name</label>
			    <input type="text" class="form-control" name="accLastName" placeholder="Last Name" />
			</div>
		    </div>
		    <div class="col-md-10">
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Genral Status Code</label>-->
			<!--    <input type="text" class="form-control" name="genStatusCode" placeholder="Genral Status Code" />-->
			<!--</div>-->
			<div class="col-sm-6 form-group">
			    <label  class="control-label">Email Address</label>
			    <input type="text" class="form-control" name="accEmail" placeholder="Email Address" />
			</div>
			<div class="col-sm-6 form-group">
			    <label  class="control-label">Organization Name</label>
			    <input type="text" class="form-control" name="accOrgName" placeholder="Organization Name" />
			</div>
		    </div>
		    <div class="row">
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Web Address</label>-->
			<!--    <input type="text" class="form-control" name="webAddress" placeholder="Web Address" />-->
			<!--</div>-->
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">External Link</label>-->
			<!--    <input type="text" class="form-control" name="externalLink" placeholder="External Link" />-->
			<!--</div>-->
			
		    </div>
		    <div class="col-md-10">
			<div class="col-sm-6 form-group">
			    <label  class="control-label">Account Type</label>
			    <select name="accType" id="accType" class="form-control">
				<option value="">Select Account Type</option>
				<?php foreach ($accountType as $accountType){ ?>
				<option value="<?=$accountType['ref_account_type_id']; ?>"><?=$accountType['description']; ?></option>
				<?php } ?>
			    </select>
			</div>
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Account Id</label>-->
			<!--    <input type="text" class="form-control" name="accId" placeholder="Account Id" />-->
			<!--</div>-->
			<div class="col-sm-6 form-group">
			    <label  class="control-label">Account Number / NPI Number</label>
			    <input type="text" class="form-control" name="accountNumber" placeholder="Account Number / NPI Number" />
			</div>
		    </div>
		    <div class="row">
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Company Id</label>-->
			<!--    <input type="text" class="form-control" name="companyId" placeholder="Company Id" />-->
			<!--</div>-->
			<!--<div class="col-sm-4 form-group">-->
			<!--    <label  class="control-label">Account Name</label>-->
			<!--    <input type="text" class="form-control" name="accName" placeholder="Account Name" />-->
			<!--</div>-->
		    </div>
		    <div class="col-md-5">
			<div class="col-sm-offset-10 col-sm-4 form-group">
			    <input type="hidden" name="proceed" value="Yes" />
			    <button type="submit" class="btn btn-success btn-block">Sign me Up</button>
			</div>
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
	<script src="<?php echo base_url(); ?>assets/plugins/formValidation/js/formValidation.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/formValidation/js/framework/bootstrap.min.js"></script>
	<script src="<?=site_url();?>assets/js/login-v2.demo.min.js"></script>
	<script src="<?=site_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script>
	    $(document).ready(function() {
		$('#form_validation').formValidation({
		    //framework: 'bootstrap',
		    container: 'tooltip',
		    message: 'This value is not valid',
		    //excluded:[':disabled',':hidden'],
		    feedbackIcons: {
			valid: 'fa fa-check',
			invalid: 'fa fa-times',
			validating: 'fa fa-refresh'
		    },
		    fields: {
			accUsername: {
			    validators: {
				notEmpty: {
				    message: 'Username cannot be empty.'
				}
			    }
			},
			accPassword: {
			    validators: {
				notEmpty: {
				    message: 'Password cannot be empty.'
				}
			    }
			},
			accFirstName: {
			    validators: {
				notEmpty: {
				    message: 'First name cannot be empty.'
				}
			    }
			},
			accLastName: {
			    validators: {
				notEmpty: {
				    message: 'Last name cannot be empty.'
				}
			    }
			},
			accEmail: {
			    validators: {
				notEmpty: {
				    message: 'Email cannot be empty.'
				}
			    }
			},
			accOrgName: {
			    validators: {
				notEmpty: {
				    message: 'Organization name cannot be empty.'
				}
			    }
			},
			accType: {
			    validators: {
				notEmpty: {
				    message: 'Account type cannot be empty.'
				}
			    }
			},
			accountNumber: {
			    validators: {
				notEmpty: {
				    message: 'Account number cannot be empty.'
				}
			    }
			},

		    }
		});
	    });
	</script>
    </body>
</html>