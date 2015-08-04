<!DOCTYPE html>

<!--test-->
<!--testing4--><!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!--guru-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>ApproveNow | Welcome User</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/theme/default-spine.css" rel="stylesheet" id="theme" />
	<link href="<?php echo base_url(); ?>assets/css/style-spine.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/style-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-validation/css/bootstrapValidator.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/formValidation/css/formValidation.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	
	<!-- ================== BEGIN PAGE LEVEL STYLE  wizard================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<!-- apps lable css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/appslable.css" />
	<!-- end-->
	
	<!-- ================== START SELECT PICKER GO================== -->
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/selectpicker/css/bootstrap-select_table.css">
	<!--loader-->
	<link href="<?php echo base_url(); ?>assets/css/jquery.loader.css" rel="stylesheet" />
	<!--end loader-->
	<!-- ================== END SELECT PICKER GO================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE Data tables================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE Form plugin================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker2/css/bootstrap-datetimepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE show or hide column================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
  	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== Browse button custom and switchery================== -->
	<link href="<?php echo base_url(); ?>assets/plugins/browse-button/filecss.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	
	<!-- ================== START PAGE LEVEL STYLE ================== -->
	
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        
	<style>
	    .table_input{
		width: auto;
	    }
	    
	.dataTables_scroll{
		margin-bottom: 10px;
	}
	.btn-group{
	    margin-bottom: 0;
	}
	
	.btn-new {
	-moz-user-select: none;
	background-image: none;
	border: 1px solid transparent;
	border-radius: 4px;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 400;
	line-height: 1.42857;
	margin-bottom: 0;
	padding: 6px 12px;
	text-align:center;
	vertical-align: middle;
	white-space: nowrap;
	width: 85%;
	}
	
	.statusWidth{
	width: 100px;
	}
	
	.btn-new.btn-new-inverse {
	background: #2d353c none repeat scroll 0 0;
	border-color: #2d353c;
	color: #fff;
	}
	a:focus, a:hover {
        text-decoration: none;
	}
	.textRight{
	    text-align:right;
	}

	
	.dataTables_filter{  float: left !important;  margin-right: 10px; }
	.dataTables_length{  float: right !important; }
	.dataTables_filter input{margin-left: 0px;}
	.trcalign{float:left;}
	/*---------for responsive table line tab alignment------------*/
	
	/*for line alignment*/
	
	.forResponsiveLine{
		min-height:250px !important;
	}
	
	.bootstrap-select.btn-group .dropdown-menu{
		z-index: 1000 !important;
	}
	
	/*for line alignment*/
	</style>
	<style>
	    .modal.modal-loading .modal-body{
		position:relative;
		z-index:0
	    }
	    .modal.modal-loading.modal-expand .modal-body{
		position:absolute
	    }
	    .modal.modal-loading .modal-body .modal-loader{
		position:absolute;
		left:0;
		right:0;
		top:0;
		bottom:0;
		background:#fff;
		opacity:.9;
		filter:alpha(opacity=90);
		animation:fadeIn .2s;
		-webkit-animation:fadeIn .2s;
		z-index:1020;
		-webkit-border-radius:0 0 4px 4px;
		-moz-border-radius:0 0 4px 4px;
		border-radius:0 0 4px 4px
	    }
	    @keyframes fadeIn{
		from{
		    opacity:0
		}
		to{
		    opacity:1
		}
	    }
	    @-webkit-keyframes fadeIn{
		from{
		    opacity:0
		}
		to{
		    opacity:1
		}
	    }
	</style>
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
	    <div class="container-fluid">
		
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="" class="navbar-brand"><span class="">
		    <h4> ApproveNow </h4>
		    <!--<img src="<?php echo base_url(); ?>assets/img/mantis_logo.jpg" data-id="login-cover-image" alt="" />-->
		    </span> </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->
                    
                <!-- begin header navigation right -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form full-width">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter keyword" />
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <!--<img src="<?php echo base_url(); ?>upload/Apps/UserDefinition/<?php echo $this->session->userdata('USER_IMAGE_FILE'); ?>" alt="" /> -->
                            <span class="hidden-xs"><?php echo $this->session->userdata('accUsername'); ?></span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft">
                            <li class="arrow"></li>
                            <li><a href="<?php echo base_url('AppsCtr/UserDefinition_Edit/'.$this->session->userdata('USER_ID')); ?>">Edit Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('approveRegister/Logout'); ?>"> <i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- end header navigation right -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->
        
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="<?php echo base_url('upload/Apps/UserDefinition/'. $this->session->userdata('USER_IMAGE_FILE')); ?>" alt="" /></a>
                        </div>
                        <div class="info">
                            <?php echo $this->session->userdata('accUsername'); ?>
                            <!--<small>Front end developer</small>-->
                        </div>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
		    <li><a href="<?=site_url('approveRegister/dashboard');?>"><i class="fa fa-dashboard text-warning"></i> <span>Dashboard</span></a></li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-align-left text-warning"></i> 
                            <span>Application</span>
                        </a>
                        <ul class="sub-menu">
			    <li><a href="<?=site_url('approveRegister/locationMaster');?>"><i class="fa fa-suitcase text-warning"></i> <span>Location</span></a></li>
			    <li><a href="<?=site_url('approveRegister/dashboard');?>"><i class="fa fa-tasks text-warning"></i> <span>Provider</span></a></li>
			</ul>
                    </li>
		    
                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
	<!-- end #sidebar -->
