		
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Dashboard</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard  <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			<!-- begin row -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
		    <div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
		    </div>
		   
		    <h4 class="panel-title">Prior Authorization</h4>
		</div>
		<div class="panel-body" id="form_validation">
			<p>
		<a href="<?php echo site_url('approveRegister/priorAuth/empty'); ?>" onclick="operationOpen();" class="btn btn-primary"><i class="fa fa-plus fa-1x"></i> <span class="f-s-14 f-w-500">Add PA</span></a>
			</p>
		<table id="dataRespTable" class="table table-striped table-bordered nowrap responsive" width="100%">
		      <thead>
			    <tr>
				<th data-class="expand"><input type="radio" id="" checked name="already_y"></th>
				<th data-hide="phone,tablet">Date</th>
				<th data-hide="phone,tablet">Paitent Last Name</th>
		                <th data-hide="phone,tablet">DOB</th>
				<th data-hide="phone,tablet">Drugname</th>
				<th data-hide="phone,tablet">Provider</th>
				<th data-hide="phone,tablet">Status</th>
				
			        
			    </tr>
			</thead>
			<tbody>
				
			    <?php foreach($tableDetails as $row){?>
			   
			    <tr class="">
				<td><input type="radio" value="Y" id="radioYes" onclick="patientDetails('<?php echo $row['prior_authorizaion_id']?>')" name="already_y">
				<input type="hidden" name="already_y">
				</td>
				<td><?php echo $row['dispensed_date']; ?></td>					    
				<td><?php echo $row['patient_last_name']; ?></td>
				<td><?php echo $row['patient_dob']; ?></td>
				<td><?php echo $row['written_drug_form_desc']; ?></td>				    
				<td><?php echo $row['pharmacy_name']; ?></td>
				<td><?php  foreach($statusDesc as $status){ if($status['reason_code_id']== $row['status_id'])echo $status['description']; } ?></td>
			    </tr>
			  
			<?php }?>
			</tbody>
		</table>
		
			<div class="col-md-12" style="padding: 10px;"></div>    
			<div class="col-md-6">
				<div class="col-md-8">
					<div class="widget widget-stats bg-black">
					    <div class="stats-icon stats-icon-lg"><i class="fa  fa-users fa-fw"></i></div>
					    <div class="stats-title">TOTAL PROGRESS</div>
					    <div class="stats-number"><?php echo $details['approved'];?> PA's in Queues</div>
					    <div class="stats-progress progress">
						<div class="progress-bar" style="width: 70.1%;"></div>
					    </div>
					    
					    <div class="stats-desc"><?php echo $details['pending'];?> Pending</div>
					    <div class="stats-desc"><?php echo $details['rejected'];?> Rejected</div>
					</div>
				</div>
			</div>
			
			<div class="RemoveResponsive"></div>
		<div class="col-md-12">
			
		</div>	
		</div>
		
	</div>
</div>
<script>
	
function patientDetails($id)
	{
		loadLoader();
		$.ajax({
			url: '<?php  echo site_url('approveRegister/paitentDetailsAjax')?>',
			type: 'POST',
			data: {prior_authorizaion_id:$id},
			success: function (response)
			
			{
				$(".RemoveResponsive").html(response);
				unLoader();
			}
		});
	}
</script>





<script type="text/javascript">
    $(document).ready(function(){
	
	
	$("*#showDiv").hide();
         });
          $("*#radioYes").click(function(){
           
	    if ($(this).val()=="Y")
	    {
		$("#showDiv").show();
	    }
            if ($(this).val()=="N")
	    {
		$("#showDiv").hide();
	    }
	    
	    });
    
    </script>
<script>
	//Loader
	
function loadLoader() {
 $('body').addClass('loading').loader('show', { overlay: true });
    }
function unLoader(args) {
 $('body').removeClass('loading').loader('hide');
    }
    
function loadTxn() {
    $('body').addClass('loading').loader('show', { overlay: true });
}
function unloadTxn() {
    $('body').removeClass('loading').loader('hide');
}
	//Loader
</script>
<script>
	$(document).ready(function() {
    $("#dataRespTable").DataTable();
     });
	
</script>
	