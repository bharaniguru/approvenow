<? error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<? $CI =& get_instance();?>
<?php
$status = $this->session->flashdata('status');
?>
<!-- begin #content -->
    <div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
	    <li><a href="javascript:;">Prior Authorization</a></li>
	    <li class="active">Prior Authorization</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header"><small></small></h1>
	<!-- end page-header -->
	<!-- begin row -->
	<div class="row">
	    <!-- begin col-10 -->
	    <div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
		    <div class="panel-heading">
			<div class="panel-heading-btn">
			    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			
			</div>
			<h4 class="panel-title">Sucessfully Sent Fax...!</h4>
		    </div>		    
		    <div class="panel-body">
			<div class="row">
			    <section class="col-sm-12">
				<a href="<?=site_url('approveRegister/dashboard')?>" class="btn btn-success">Back to Dashboard</a>
			    </section>
			</div>
			<h3 class="m-t-10"> Hi..!, Fax is sent you Pharmacy Fax machine.</h3>
			<p> Priot Authentication is sent to the fax machine, if it is Off Please ON the Fax machine, if attachment is there with this PA, it also sent to fax machine.
			<br><br>
			Note: Image attachment will not faxed. </p>
		    </div>
			<!-- end panel -->
		    </div>
		    <!-- end col-10 -->
		</div>
		<!-- end row -->
	    </div>
	    <!-- end #content -->
	    <!-- begin scroll to top btn -->
	    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	    <!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	</body>
    </html>
    
 
    
