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
			<h4 class="panel-title">Prior Authorization Preview Fax</h4>
		    </div>		    
		    <div class="panel-body" id="Prior">
			<form id="priorAuthForm" method="POST" enctype="multipart/form-data" action="<?php echo site_url().'approveRegister/sendPAFax/'.$lastInsertedId; ?>" class="" autocomplete="on">
			<iframe class="responsiveiframe" src="<?php echo site_url().'approveRegister/generatePAPdf/'.$lastInsertedId; ?>" width="872px" id="previewiframe" height="700px"></iframe>
			<button class="btn btn-sm btn-warning" type="button" onclick="window.history.back();">Back</button>
			<input type="submit" name="proceed" class="btn btn-sm btn-success"  value="Fax PA">
			</form>
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
    
 
    
