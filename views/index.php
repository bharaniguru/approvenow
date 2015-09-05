<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>ApproveNow | Login Page</title>
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
	    <div class="login-cover-image"><img src="<?=site_url();?>assets/img/login-bg/bg3.jpeg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" style="width: 445px" data-pageload-addclass="animated flipInX">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    ApproveNow
                    <small>Login Now</small>
                </div>
                <div class="icon">
                    <i class="fa fa-user-md"></i>
		</div>
            </div>
            <!-- end brand -->
            <div class="login-content" style="width: 445px">
		<?php if($errorMsg) { ?>
		<div class="alert alert-danger errorMsgDiv"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><?php echo $errorMsg; ?></div>
		<?php } ?>
                <form action="<?=site_url();?>approveRegister" method="POST" id="form_validation" class="margin-bottom-0">
		    <div class="form-group m-b-20">
			<input type="text" class="form-control" name="accUsername" placeholder="Username" />
		    </div>
		    <div class="form-group m-b-20">
			<input type="password" class="form-control" name="accPassword" placeholder="Password" />
		    </div>
		    <div class="login-buttons">
			<input type="hidden" name="proceed" value="Yes" />
			<button type="submit" class="btn btn-success btn-block">Sign me in</button>
		    </div>
		    <div class="m-t-20">
			Not a member yet? Click <a href="<?=site_url();?>approveRegister/createAccount">here</a> to register.
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
	<!--	Bootstrap validation-->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-validation/css/bootstrapValidator.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-validation/js/bootstrapValidator.js"></script>
       <!-- Bootstrap validation end -->
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script>
	    $(".errorMsgDiv").delay(10000).fadeOut("slow");
	</script>
    </body>
</html>
<script>
	 $('#form_validation').bootstrapValidator({
        message: 'This value is not valid',
	container: 'tooltip',
	//+excluded:[':disabled'],
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh fa-spin' 
        },
        fields: {
            accUsername: {
		message: 'The City Code is not valid',
                validators:{
		    
                    notEmpty: {
                        message: 'Please Enter Valid User Id'
                    },
		    remote:{
			message: 'Please Enter Valid User Id',
			url: '<?php  echo site_url('approveRegister/CheckingData'); ?>',
			type: 'POST'
		    }
                }
            },
	    accPassword: {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Correct Password'
                    },
		    remote:{
			message: 'Please Enter Correct Password',
			data:  function(validator) {
				return {
				    accUsername: validator.getFieldElements('accUsername').val(),
				};
                        },
			url: '<?php  echo site_url('approveRegister/CheckingUser')?>',
			type: 'POST'
		    }
                }
            },
	    
	}
    })
</script>