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
				<th>Company Name</th>
				<th>Phone Area Code</th>
				<th>Phone Number</th>
				<th>Phone Ext</th>
				<th>Fax Area Code</th>
				<th>Fax Number</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
				<th>Zip Four</th>
				<th>Email Address</th>
				<th>Web Address</th>
				<th>Product Name</th>
				<th>Product Version</th>
				<th>Product Build</th>
				<th>Build Date</th>
				<th>NPI</th>
				<th>Account Number</th>
				<th>Action</th>
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
				<label  class="control-label">Company Name</label>
				<input type="text" class="form-control" name="companyName" placeholder="Company Name" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Area Code</label>
				<input type="text" class="form-control" name="phoneAreaCode" placeholder="Phone Area Code" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Number</label>
				<input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Phone Extension</label>
				<input type="text" class="form-control" name="phoneExtension" placeholder="Phone Extension" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Fax Area Code</label>
				<input type="text" class="form-control" name="faxAreaCode" placeholder="Fax Area Code" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Fax Number</label>
				<input type="text" class="form-control" name="faxNumber" placeholder="Fax Number" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Address</label>
				<input type="text" class="form-control" name="address" placeholder="Address" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">City</label>
				<input type="text" class="form-control" name="city" placeholder="City" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">State</label>
				<input type="text" class="form-control" name="state" placeholder="State" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Zip Code</label>
				<input type="text" class="form-control" name="zipCode" placeholder="Zip Code" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Zip Four</label>
				<input type="text" class="form-control" name="zipFour" placeholder="Zip Four" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Email Address</label>
				<input type="text" class="form-control" name="emailAddress" placeholder="Email Address" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Web Address</label>
				<input type="text" class="form-control" name="webAddress" placeholder="Web Address" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Product Name</label>
				<input type="text" class="form-control" name="productName" placeholder="Product Name" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Product Version</label>
				<input type="text" class="form-control" name="productVersion" placeholder="Product Version" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Product Build</label>
				<input type="text" class="form-control" name="prodBuild" placeholder="Product Build" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Build Date</label>
				<input type="text" class="form-control" name="prodBuildDate" placeholder="Build Date" />
			    </section>
			    <section class="col-sm-3 form-group">
				<label  class="control-label">NPI</label>
				<input type="text" class="form-control" name="NPI" placeholder="NPI" />
			    </section>
			</div>
			<div class="row">
			    <section class="col-sm-3 form-group">
				<label  class="control-label">Account Number</label>
				<input type="text" class="form-control" name="accountNum" placeholder="Account Number" />
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
    loadLoader();
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/locationDetailsOperation');?>',
	mimeType:"multipart/form-data",
	data:formData,
	dataType:'json',
	processData: false,
	contentType: false,
	success:function(json){
	    //console.log(json);
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
	    $('#locationForm').find('[name="companyName"]').val(json[0].company_name);
	    $('#locationForm').find('[name="locationId"]').val(json[0].location_id);
	    $('#locationForm').find('[name="phoneAreaCode"]').val(json[0].phone_area_code);
	    $('#locationForm').find('[name="phoneNumber"]').val(json[0].phone_number);
	    $('#locationForm').find('[name="phoneExtension"]').val(json[0].phone_ext);
	    $('#locationForm').find('[name="faxAreaCode"]').val(json[0].fax_area_code);
	    $('#locationForm').find('[name="faxNumber"]').val(json[0].fax_number);
	    $('#locationForm').find('[name="address"]').val(json[0].address);
	    $('#locationForm').find('[name="city"]').val(json[0].city);
	    $('#locationForm').find('[name="state"]').val(json[0].state);
	    $('#locationForm').find('[name="zipCode"]').val(json[0].zip);
	    $('#locationForm').find('[name="zipFour"]').val(json[0].zip_four);
	    $('#locationForm').find('[name="emailAddress"]').val(json[0].email_address);
	    $('#locationForm').find('[name="webAddress"]').val(json[0].web_address);
	    $('#locationForm').find('[name="productName"]').val(json[0].product_name);
	    $('#locationForm').find('[name="productVersion"]').val(json[0].product_version);
	    $('#locationForm').find('[name="prodBuild"]').val(json[0].product_build);
	    $('#locationForm').find('[name="prodBuildDate"]').val(json[0].product_build_date);
	    $('#locationForm').find('[name="NPI"]').val(json[0].NPI);
	    $('#locationForm').find('[name="accountNum"]').val(json[0].account_num);
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
	"sDom": "<'row'<'col-md-4 no 'f><'col-md-6 trcalign' TRC><'col-md-2 yes'l>r><t><'row'<'col-md-6'i><'col-md-6'p>>",
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
		{ data: 'company_name', className: "all"},
		{ data: "phone_area_code"},
		{ data: "phone_number"},
		{ data: "phone_ext"},
		{ data: "fax_area_code"},
		{ data: "fax_number"},
		{ data: 'address'},
		{ data: "city"},
		{ data: "state"},
		{ data: "zip"},
		{ data: 'zip_four'},
		{ data: 'email_address'},
		{ data: "web_address"},
		{ data: "product_name"},
		{ data: "product_version"},
		{ data: "product_build"},
		{ data: "product_build_date"},
		{ data: 'NPI'},
		{ data: "account_num"},
		{
		    data: null, className: "all","orderable": false, 
		    render: function( data, type, row) {
			return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="" onclick="editLocation('+data['location_id']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class=""  id="delete_box" data-toggle="modal"  onclick="deleteLocation('+data['location_id']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
		    }
		},
		],
	"order": [[ 8, "desc" ]],
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
<script>
//$('#form_validation').on('click', '#delete_box', function(e) {
//    e.preventDefault();
//    //var link = $(this).attr('href');
//    var a = $(this).attr('val');
//    bootbox.confirm("Are you sure you want to delete?", function(confirmed) {
//	if (confirmed) {
//	    $.ajax({
//		type:'POST',
//		url:'<?php echo  site_url('AppsCtr/City_Delete');?>',
//		data:{'id':a},
//		success:function(response){
//		if(response==1){
//		$('#alert').append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> A Record is Deleted Successfully.</div>');
//		}else{
//		$('#alert').append('<div class="alert alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a><strong>Failure!</strong> A Record is Unable To Delete</div>');
//		}
//		$('#dataRespTable').dataTable().fnDraw();
//		setTimeout(function(){ $('#alert').empty(); }, 8000);
//		}
//	    });
//	}
//    });
//});
</script>