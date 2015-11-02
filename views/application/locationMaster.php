<? error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<? $CI =& get_instance();?>
<?php
$status = $this->session->flashdata('status');
?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
	<li><a href="javascript:;">Application</a></li>
	<li><a href="javascript:;">Location Master</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Location Master<small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
	<!-- begin col-10 -->
	<div class="col-md-12">
	    <!-- begin view panel -->
	    <div class="panel panel-inverse"  data-pageload-addclass="animated slideInDown" id="viewPanel">
		<div class="panel-heading">
		    <div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
		    </div>
		    <h4 class="panel-title">View</h4>
		</div>
		<div class="panel-body" id="form_validation">
		    <div id="alert"></div>
		    <p id="addbutton">
			<a class="btn btn-primary btn-sm " onclick="operationOpen();"><i class="fa fa-plus fa-1x"></i> <span class="f-s-14 f-w-500">Add</span></a>
		    </p>
		    <?php if($status)
			{?>
			<div class="alert alert-success outer"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><?php echo $status; ?></div>
		    <?php
		    }?> 
		    <table id="dataRespTable" class="table table-striped table-bordered nowrap" width="100%">
			<thead>
			    <tr>
				<th>Location Name</th>
				<th>Phone Number</th>
				<th>Phone Ext</th>
				<th>Fax Number</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
				<th>Zip Four</th>
				<th>Email Address</th>
				<th>Web Address</th>
				<th>NPI</th>
				<th>Account Id</th>
				<th>Action</th>
				<th>Provider General</th>
			    </tr>
			</thead>
			<tbody>
			    
			</tbody>
		    </table>
		</div>
	    </div>
	    <!-- end view panel -->
	    <!-- begin add/edit panel -->
	    <div class="panel panel-inverse hide" data-pageload-addclass="animated slideInDown" id="operationPanel">
		<div class="panel-heading">
		    <div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			<a class="btn btn-xs btn-icon btn-circle btn-danger" onclick="operationClose();"><i class="fa fa-times"></i></a>
		    </div>
		    <h4 class="panel-title">Add</h4>
		</div>
		<div class="panel-body" id="form_validation">
		    <?php if(isset($error_message)) { ?>
		    <div class="alert alert-danger errorMsgDiv"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><?php echo $error_message; ?></div>
		    <?php } ?>
		    <form id="locationForm" data-fv-trigger="blur change keyup"   enctype="multipart/form-data" role="form">
			
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Location Name</label>
				<input type="text" class="form-control" name="location_name" placeholder="Location Name" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Number</label>
				<input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Extension</label>
				<input type="text" class="form-control" name="phoneExtension" placeholder="Phone Extension" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Fax Number</label>
				<input type="text" class="form-control" name="faxNumber" placeholder="Fax Number" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Address</label>
				<input type="text" class="form-control" name="address" placeholder="Address" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">City</label>
				<input type="text" class="form-control" name="city" placeholder="City" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">State</label>
				<input type="text" class="form-control" name="state" placeholder="State" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Zip Code</label>
				<input type="text" class="form-control" name="zipCode" placeholder="Zip Code" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Zip Four</label>
				<input type="text" class="form-control" name="zipFour" placeholder="Zip Four" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Email Address</label>
				<input type="email" class="form-control" name="emailAddress" placeholder="Email Address" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Web Address</label>
				<input type="text" class="form-control" name="webAddress" placeholder="Web Address" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">NPI</label>
				<input type="text" class="form-control" name="NPI" placeholder="NPI" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-offset-5 col-sm-3 form-group">
				<input type="hidden" name="proceed" value="Add" />
				<input type="hidden" name="locationId" value="" />
				
				<button class="btn btn-sm btn-primary m-r-5" name="save" type="submit">Save</button>
				<button class="btn btn-sm btn-default" onclick="operationClose();" type="button">Cancel</button>
			    </section>
			</div>
		    </form>
		</div>
	    </div>
	    <!-- end add/edit panel -->
	</div>
	<!-- end col-10 -->
    </div>
    <!-- end row -->
   
</div>
<!-- end #content -->
<script type="text/javascript">
    
function operationOpen() {
    $('#viewPanel').addClass('hide');
    $('#operationPanel').removeClass('hide');
    $('#operationPanel').find('.panel-title').text('Add');
    $('#operationPanel').find('[name="proceed"]').val('Add');
    $('#operationPanel').find('[name="save"]').text('Save');
    $('#locationForm')[0].reset();
}
function operationClose() {
    $('#viewPanel').removeClass('hide');
    $('#operationPanel').addClass('hide');
}
$("#locationForm").submit(function(e) {
    //loadLoader();
    e.preventDefault();
    console.log('testtest');
    var formData = new FormData($(this)[0]);
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/locationDetailsOperation');?>',
	mimeType:"multipart/form-data",
	//data:formData,
	dataType:'json',
	processData: false,
	contentType: false,
	success:function(json){
	    operationClose();
	    $('#dataRespTable').dataTable().fnDraw();
	    
	    unLoader();
	}
    });
});
function editLocation(locationId) {
    loadLoader();
    operationOpen();
    
    $('#operationPanel').find('.panel-title').text('Edit');
    $('#operationPanel').find('[name="proceed"]').val('Edit');
    $('#operationPanel').find('[name="save"]').text('Update');
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/getLocationDetails');?>',
	data:{locationId:locationId},
	dataType: 'json',
	success:function(json){
	  console.log(json);
	    $('#locationForm').find('[name="location_name"]').val(json[0].location_name);
	    $('#locationForm').find('[name="locationId"]').val(json[0].location_id);
	    $('#locationForm').find('[name="phoneNumber"]').val(json[0].phone_number);
	    $('#locationForm').find('[name="phoneExtension"]').val(json[0].phone_ext);
	    $('#locationForm').find('[name="faxNumber"]').val(json[0].fax_number);
	    $('#locationForm').find('[name="address"]').val(json[0].address);
	    $('#locationForm').find('[name="city"]').val(json[0].city);
	    $('#locationForm').find('[name="state"]').val(json[0].state);
	    $('#locationForm').find('[name="zipCode"]').val(json[0].zip);
	    $('#locationForm').find('[name="zipFour"]').val(json[0].zip_four);
	    $('#locationForm').find('[name="emailAddress"]').val(json[0].email_address);
	    $('#locationForm').find('[name="webAddress"]').val(json[0].web_address);
	    $('#locationForm').find('[name="NPI"]').val(json[0].NPI);
	    $('#locationForm').find('[name="account_id"]').val(json[0].account_id);
	    unLoader();
	}
    });
}
function deleteLocation(locationId) {
    bootbox.confirm("Are you sure you want to delete?", function(confirmed) {
	if (confirmed) {
	    $.ajax({
		type:'POST',
		url:'<?php echo  site_url('approveRegister/deleteLocation');?>',
		data:{locationId:locationId},
		dataType: 'json',
		success:function(json){
		    //if(response==1){
		    //$('#alert').append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> A Record is Deleted Successfully.</div>');
		    //}else{
		    //$('#alert').append('<div class="alert alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><strong>Failure!</strong> A Record is Unable To Delete</div>');
		    //}
		    $('#dataRespTable').dataTable().fnDraw();
		    //setTimeout(function(){ $('#alert').empty(); }, 8000);
		}
	    });
	}
    });
}
function loadLoader() {
    $('body').addClass('loading').loader('show', { overlay: true });
}
function unLoader() {
    $('body').removeClass('loading').loader('hide');
}

$(document).ready(function() {
    var table = $("#dataRespTable").DataTable({
	"sDom": "<'row'<'col-md-10 no 'f><'col-md-2 yes'l>r><t><'row'<'col-md-6'i><'col-md-6'p>>",
	"bServerSide": true,
	"bProcessing": false,
	"sAjaxSource": '<?php echo site_url('approveRegister/locationMasterTable'); ?>',
	'responsive': true,
	'scrollX':true,
        //"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
	"lengthMenu": [
		       [10, 20, 50, -1],
		       [10, 20, 50, "All"] // change per page values here
		       ],
	// "pageLength": 10,
	"language": {
	    "sLengthMenu": "_MENU_",
	    "lengthMenu": " _MENU_ records",
	    "processing": loadLoader()
	    //"processing": '<div class="loader overlay"><div class="loader-load"></div><div class="loader-overlay"></div></div>'
	},
	columns:[
		{ data: 'location_name', className: "all"},
		{ data: "phone_number"},
		{ data: "phone_ext"},
		{ data: "fax_number"},
		{ data: 'address'},
		{ data: "city"},
		{ data: "state"},
		{ data: "zip"},
		{ data: 'zip_four'},
		{ data: 'email_address'},
		{ data: "web_address"},
		{ data: 'NPI'},
		{ data: "account_id"},
		{
		    data: null, className: "all","orderable": false, 
		    render: function( data, type, row) {
			return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editLocation('+data['location_id']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteLocation('+data['location_id']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
		    }
		},
		{
		    data: null, className: "all","orderable": false, 
		    render: function( data, type, row) {
			return '<a class="btn btn-info btn-sm" data-toggle="modal" onclick="ajaxLocations('+data['location_id']+')" data-target="#myModal">View PG</a>'
		    }
		},
		],
	"order": [[ 11, "desc" ]],
	tableTools: {
	    sSwfPath: "../assets/plugins/DataTables/swf/copy_csv_xls_pdf.swf"
	},
	'fnServerData': function(sSource, aoData, fnCallback){
	    $.ajax({
		'dataType': 'json',
		'type'    : 'POST',
		'url'     : sSource,
		'data'    : aoData,
		'success' : fnCallback
	    });
	},
    });
    //------------- Start for Processing Icon image------------------------------------//
    $('#dataRespTable').on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? loadLoader() : unLoader());
    }).dataTable();
    //------------- End of Processing Icon image------------------------------------//
    //---- for Append after Search button-----------
    $( "#addbutton") .appendTo( ".no " );
    //----------------------------------------------
    
});
</script>
 <!--Modal Start-->
     <div class="modal fade bs-example-modal-lg"  id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Provider General</h4>
        </div>
        <div class="modal-body col-lg-12">
          	<div class="col-md-12">
	    <!-- begin view panel -->
	    <div class="panel panel-inverse"  data-pageload-addclass="animated slideInDown" id="viewPanel1">
		<div class="">
		    
		    <h4 class="panel-title">Provider General View</h4>
		</div>
		<div class="panel-body" id="form_validation">
		    <div id="alert"></div>
		    <p id="addbutton1">
			<a class="btn btn-primary btn-sm " onclick="operationOpen1();"><i class="fa fa-plus fa-1x"></i> <span class="f-s-14 f-w-500">Add</span></a>
		    </p>
		    <?php if($status)
			{?>
			<div class="alert alert-success outer"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><?php echo $status; ?></div>
		    <?php
		    }?>
		    <div class="table-responsive">
		    <table id="dataRespTable1" class="table table-striped table-bordered nowrap" width="100%">
			<thead>
			    <tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Provider Type ID</th>
				<th>Phone Number</th>
				<th>NPI</th>
				<th>DEA Number</th>
				<th>Location ID</th>
                                <th>Action</th>
                            </tr>
			</thead>
			<tbody id="provideTable">
			    
			</tbody>
		    </table>
		    </div>
		</div>
	    </div>
	    <!-- end view panel -->
	    <!-- begin add/edit panel -->
	    <div class="panel panel-inverse hide" data-pageload-addclass="animated slideInDown" id="operationPanel1">
		<div class="">
		    
		    <h4 class="panel-title">Provider General Add</h4>
		</div>
		<div class="panel-body" id="form_validation">
		    <?php if(isset($error_message)) { ?>
		    <div class="alert alert-danger errorMsgDiv"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><?php echo $error_message; ?></div>
		    <?php } ?>
		    <form id="providerForm" data-fv-trigger="blur change keyup"   enctype="multipart/form-data" role="form">
			<input type="hidden" id='locationIdOld' name="locationIdOld" value="" />
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">First Name</label>
				<input type="text" class="form-control" name="firstName" placeholder="First Name" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Last Name</label>
				<input type="text" class="form-control" name="lastName" placeholder="Last Name" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Provider Type Id</label>
				<input type="text" class="form-control" name="provider_type_id" placeholder="provider Type ID" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Number</label>
				<input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number" />
			    </section>
			</div>
			<div class="row">
                            <section class="col-sm-3 form-group">
				<label  class="control-label">NPI</label>
				<input type="text" class="form-control" name="NPI" placeholder="NPI" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">DEA Number</label>
				<input type="text" class="form-control" name="deaNumber" placeholder="DEA Number" />
			    </section>
			   
                            <section class="col-sm-3 form-group">
                                <label class=" control-label">Location ID</label>
				    <?php foreach ($locationDetails as $row){?>
				    <?php }?>
				    <input type="text" name="locationID" id="locationID" class="form-control input-sm" readonly="">
			    </section>
			</div>
                        
                        <div class="row">
			    <section class="col-sm-offset-5 col-sm-3 form-group">
				<input type="hidden" name="proceed" value="Add" />
				<input type="hidden" name="providerId" value="" />
				<button class="btn btn-sm btn-primary m-r-5" name="save" type="submit">Save</button>
				<button class="btn btn-sm btn-default" onclick="operationClose1();" type="button">Cancel</button>
			    </section>
			</div>
		    </form>
		</div>
	    </div>
	    <!-- end add/edit panel -->
	</div>
<script type="text/javascript">
    
function operationOpen1() {
    $('#viewPanel1').addClass('hide');
    $('#operationPanel1').removeClass('hide');
    $('#operationPanel1').find('.panel-title').text('Add');
    $('#operationPanel1').find('[name="proceed"]').val('Add');
    $('#operationPanel1').find('[name="save"]').text('Save');
    $('#providerForm')[0].reset();
}
function operationClose1() {
    $('#viewPanel1').removeClass('hide');
    $('#operationPanel1').addClass('hide');
}
$("#providerForm").submit(function(e) {
   
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    loadLoader1();
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/generalProviderOperation');?>',
	mimeType:"multipart/form-data",
	data:formData,
	dataType:'json',
	processData: false,
	contentType: false,
	success:function(json){
	    //console.log(json);
	  
	    unLoader1();
	    
	
	    $('#dataRespTable1').dataTable().fnDraw();
	    operationClose1();
		    
	    
	}
    });
});

function editProvider(providerId) {
    loadLoader1();
    operationOpen1();
    $('#operationPanel1').find('.panel-title').text('Edit');
    $('#operationPanel1').find('[name="proceed"]').val('Edit');
    $('#operationPanel1').find('[name="save"]').text('Update');
    $.ajax({
	type:'POST',
	
	url:'<?=site_url('approveRegister/getProviderDetails');?>',
	data:{providerId:providerId},
	dataType: 'json',
	success:function(json){
	    $('#providerForm').find('[name="firstName"]').val(json[0].first_name);
	    $('#providerForm').find('[name="providerId"]').val(json[0].provider_id);
	    $('#providerForm').find('[name="lastName"]').val(json[0].last_name);
	    $('#providerForm').find('[name="provider_type_id"]').val(json[0].provider_type_id);
	    $('#providerForm').find('[name="phoneNumber"]').val(json[0].phone);
	    $('#providerForm').find('[name="NPI"]').val(json[0].NPI);
	    $('#providerForm').find('[name="deaNumber"]').val(json[0].DEA_num);
	    $('#providerForm').find('[name="locationID"]').val(json[0].location_id);
	    unLoader1();
	}
    });   
}
function deleteProvider(providerId) {
    bootbox.confirm("Are you sure you want to delete?", function(confirmed) {
	if (confirmed) {
	    $.ajax({
		type:'POST',
		url:'<?php echo  site_url('approveRegister/deleteProvider');?>',
		data:{providerId:providerId},
		dataType: 'json',
		success:function(json){
		    //if(response==1){
		    //$('#alert').append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> A Record is Deleted Successfully.</div>');
		    //}else{
		    //$('#alert').append('<div class="alert alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><strong>Failure!</strong> A Record is Unable To Delete</div>');
		    //}
		    $('#dataRespTable1').dataTable().fnDraw();
		    
		    //setTimeout(function(){ $('#alert').empty(); }, 8000);
		}
	    });
	}
    });
}
function loadLoader1() {
    $('body').addClass('loading').loader('show', { overlay: true });
}
function unLoader1() {
    $('body').removeClass('loading').loader('hide');
}

$(document).ready(function() {
    $("#dataRespTable1").DataTable();
//	"sDom": "<'row'<'col-md-10 no1 'f><'col-md-2 yes'l>r><t><'row'<'col-md-6'i><'col-md-6'p>>",
//	"bServerSide": true,
//	"bProcessing": false,
//	"sAjaxSource": '<?php echo site_url('approveRegister/generalProviderTable'); ?>',
//	'responsive': true,
//	'scrollX':true,
//        //"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//	"lengthMenu": [
//		       [10, 20, 50, -1],
//		       [10, 20, 50, "All"] // change per page values here
//		       ],
//	// "pageLength": 10,
//	"language": {
//	    "sLengthMenu": "_MENU_",
//	    "lengthMenu": " _MENU_ records",
//	    "processing": loadLoader1()
//	    //"processing": '<div class="loader overlay"><div class="loader-load"></div><div class="loader-overlay"></div></div>'
//	},
//	columns:[
//		{ data: "first_name", className: "all"},
//		{ data: "last_name"},
//		{ data: "provider_type_id"},
//		{ data: "phone"},
//		{ data: "NPI"},
//		{ data: "DEA_num"},
//                { data: "location_id"},
//		{
//		    data: null, className: "all","orderable": false, 
//		    render: function( data, type, row) {
//			return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editProvider('+data['provider_id']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteProvider('+data['provider_id']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
//		    }
//		}
//		],
//	"order": [[ 0, "desc" ]],
//	tableTools: {
//	    sSwfPath: "../assets/plugins/DataTables/swf/copy_csv_xls_pdf.swf"
//	},
//	'fnServerData': function(sSource, aoData, fnCallback){
//	    $.ajax({
//		'dataType': 'json',
//		'type'    : 'POST',
//		'url'     : sSource,
//		'data'    : aoData,
//		'success' : fnCallback
//	    });
//	},
  });
    //------------- Start for Processing Icon image------------------------------------//
    $('#dataRespTable1').on( 'processing.dt1', function ( e, settings, processing ) {
        $('#processingIndicator1').css( 'display', processing ? loadLoader1() : unLoader1());
    }).dataTable();
    //------------- End of Processing Icon image------------------------------------//
    //---- for Append after Search button-----------
    $( "#addbutton1") .appendTo( ".no" );
    //----------------------------------------------
    

</script>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
      
    </div>
  </div>
    <!--Modal End-->
<script>
   function ajaxLocations(id)
{
	//loadLoader();
	
	$.ajax({
		url: '<?php  echo site_url('approveRegister/ajaxLocations')?>',
		type: 'POST',
		data: {loaction_id:id},
		success: function (response)
		{
			$("#provideTable").html(response);
			 $("#locationIdOld option[value='"+id+"']").prop('selected', true);
			//$("#locationIdOld").val($id);
			$("#locationID").attr('value',id);
			//$("#locationID").each(function() {
			//    if($(this).val() == $id) {
			//      $(this).attr('selected', 'selected');            
			//    }                        
			//  });
			//unLoader();
		}
	});
}


</script>
 <script>
 $(document).ready(function() {
    $('#locationFormee').formValidation({
	//container: 'tooltip',
	message: 'This value is not valid',
	feedbackIcons: {
	    valid: 'fa fa-check',
	    invalid: 'fa fa-times',
	    validating: 'fa fa-refresh'
	    },
        fields: {
	   
	     location_name: {
		validators: {
		   notEmpty: {
                        message: 'Location Name is required'
                    }
                   
                }
            },
	     phoneNumber: {
		validators: {
		   notEmpty: {
                        message: 'Phone Number is required'
                    }
                   
                }
            },
	     phoneExtension: {
		validators: {
		   notEmpty: {
                        message: 'Phone Extension is required'
                    }
                   
                }
            },
	    faxNumber: {
		validators: {
		   notEmpty: {
                        message: 'Fax Number is required'
                    }
                   
                }
            },
	    address: {
		validators: {
		   notEmpty: {
                        message: 'Address is required'
                    }
                   
                }
            },
	     city: {
		validators: {
		   notEmpty: {
                        message: 'City is required'
                    }
                   
                }
            },
	    state: {
		validators: {
		   notEmpty: {
                        message: 'State Code is required'
                    }
                   
                }
            },
	     zipCode: {
		validators: {
		   notEmpty: {
                        message: 'Zip Code is required'
                    }
                   
                }
            },
	    zipFour: {
		validators: {
		   notEmpty: {
                        message: 'Zip Four  is required'
                    }
                   
                }
            },
	    emailAddress: {
		validators: {
		   notEmpty: {
                        message: 'Email Address  is required'
                    }
                   
                }
            },
	     webAddress: {
		validators: {
		   notEmpty: {
                        message: 'Web Address is required'
                    }
                   
                }
            },
	    NPI: {
		validators: {
		   notEmpty: {
                        message: 'NPI Field is required'
                    }
                   
                }
            },
	    
	    
	    }
    });
});
 </script>
  <script>
 $(document).ready(function() {
    $('#providerFormee').formValidation({
	//container: 'tooltip',
	message: 'This value is not valid',
	feedbackIcons: {
	    valid: 'fa fa-check',
	    invalid: 'fa fa-times',
	    validating: 'fa fa-refresh'
	    },
        fields: {
	   
	     firstName: {
		validators: {
		   notEmpty: {
                        message: 'First Name is required'
                    }
                   
                }
            },
	     lastName: {
		validators: {
		   notEmpty: {
                        message: ' Last Name is required'
                    }
                   
                }
            },
	     provider_type_id: {
		validators: {
		   notEmpty: {
                        message: 'Provider Type ID is required'
                    }
                   
                }
            },
	    phoneNumber: {
		validators: {
		   notEmpty: {
                        message: 'Phone Number is required'
                    }
                   
                }
            },
	    NPI: {
		validators: {
		   notEmpty: {
                        message: 'NPI  is required'
                    }
                   
                }
            },
	     deaNumber: {
		validators: {
		   notEmpty: {
                        message: 'DEA Number is required'
                    }
                   
                }
            },
	    locationID: {
		validators: {
		   notEmpty: {
                        message: 'Location ID is required'
                    }
                   
                }
            },
	    }
	    });
    });
 </script>