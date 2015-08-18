		
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
			<div class="row">
			    <!-- begin col-3 -->
			  
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			      
			    <!-- end col-3 -->
			
			
			<!-- end row -->
			</div>
		
		
		
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
		
				    <table id="" class="table table-striped table-bordered nowrap responsive" width="100%">
		      <thead>
			    <tr>
				<th data-class="expand"><input type="checkbox" checked   value='Y' name="checkbox"></th>
				<th data-hide="phone,tablet">Date</th>
				<th data-hide="phone,tablet">Paitent Last Name</th>
		                <th data-hide="phone,tablet">DOB</th>
				<th data-hide="phone,tablet">Drugname</th>
				<th data-hide="phone,tablet">Provider</th>
				<th data-hide="phone,tablet">Status</th>
				
			        
			    </tr>
			</thead>
			<tbody>
			    <?php 
				 foreach($tableDetails as $row){
				 
				?>
			   
			    <tr class="">
				<td><input type="checkbox" id="checkYes" value='Y' name="checkbox">
				</td>
				<td><?php echo $row['dispensed_date']; ?></td>					    
				<td><?php echo $row['patient_last_name']; ?></td>
				<td><?php echo $row['patient_dob']; ?></td>
				<td><?php echo $row['written_drug_form_desc']; ?></td>				    
				<td><?php echo $row['pharmacy_name']; ?></td>
				<td><?php echo $row['status_id']; ?></td>
			    </tr>
			  
			<?php }?>
			</tbody>
		    </table>
				    
		<div class="col-md-6">
			<div class="col-md-8">
				<div class="widget widget-stats bg-green">
				    <div class="stats-icon stats-icon-lg"><i class="fa  fa-users fa-fw"></i></div>
				    <div class="stats-title">TOTAL PROGRESS</div>
				    <div class="stats-number"><?php echo $details['user'];?> PA's in Queues</div>
				    <div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				    </div>
				    
				    <div class="stats-desc"><?php echo $details['pending'];?> Pending</div>
				    <div class="stats-desc"><?php echo $details['rejected'];?> Rejected</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 well" id="moreinfo">
			<div class="" >
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Drug Name: <?php echo $row['written_drug_form_desc']; ?></label>
					</div>
					<div class="form-group">
						<label class="control-label">Diagnosis Code:  <?php echo $row['diagnosis_code']; ?></label>
					</div>
					<div class="form-group">
						<label class="control-label">Provider Name: <?php echo $row['pharmacy_name']; ?></label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Reject Issues</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="5" id="comment"></textarea>
					</div>
				</div>
				<a href="<?php echo site_url('approveRegister/priorAuth'); ?>" class="btn btn-success pull-right">Fix PA</a>
			</div>
		</div>	
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
	
	$("*#moreinfo").hide();
         });
          $("#checkYes").click(function(){
           
	    if ($(this).val()=="Y"){
		$("#moreinfo").show();
		$('#checkYes').val('N');
	    }else if($(this).val()=="N"){
		$("#moreinfo").hide();
		$('#checkYes').val('Y');
	    }
	    
	    });
	  
	 
    </script>
	