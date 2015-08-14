		
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
				<th data-class="expand"><input type="checkbox" id=""  value='Y' name="checkbox"></th>
				<th data-hide="phone,tablet">Date</th>
				<th data-hide="phone,tablet">Paitent Last Name</th>
		                <th data-hide="phone,tablet">DOB</th>
				<th data-hide="phone,tablet">Drugname</th>
				<th data-hide="phone,tablet">Provider</th>
				<th data-hide="phone,tablet">Status</th>
				
			        
			    </tr>
			</thead>
			<tbody>
			   
			   
			    <tr class="">
				<td><input type="checkbox" id=""  value='Y' name="checkbox"></td>
				<td>7/15/15</td>					    
				<td>Jones</td>
				<td>2/8/88</td>
				<td>zanathon</td>				    
				<td>jenkins</td>
				<td>Approved</td>
			    </tr>
			    <tr class="">
				<td><input type="checkbox" id=""  value='Y' name="checkbox"></td>
				<td>7/15/15</td>					    
				<td>Simon</td>
				<td>6/18/88</td>
				<td>zanathon</td>				    
				<td>jenkins</td>
				<td>Rejected</td>
			    </tr>
			
			</tbody>
		    </table>
				    
		<div class="col-md-6">
			<div class="col-md-6">
				<div class="widget widget-stats bg-green">
				    <div class="stats-icon stats-icon-lg"><i class="fa  fa-users fa-fw"></i></div>
				    <div class="stats-title">TOTAL PROGRESS</div>
				    <div class="stats-number"><?//php echo $details['user'][0]['count(id)'];?></div>
				    <div class="stats-progress progress">
					<div class="progress-bar" style="width: 70.1%;"></div>
				    </div>
				    <div class="stats-desc">23 PAs in Queue</div>
				    <div class="stats-desc">7 in Progress</div>
				    <div class="stats-desc">4 in Rejected</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 well">
			<div class="">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Drug Name:fatisans</label>
					</div>
					<div class="form-group">
						<label class="control-label">Diagnosis:250.1</label>
					</div>
					<div class="form-group">
						<label class="control-label">Provider Name:Jerome Butler</label>
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
				<a href="<?=site_url('approveRegister/priorAuth')?>" class="btn btn-success pull-right">Fix PA</a>
			</div>
		</div>	
		</div>
	</div>
	
		

	
	
		

			
	</div>

	