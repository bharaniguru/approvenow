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
	<li><a href="javascript:;">General Provider</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">General Provider<small></small></h1>
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
		    <form id="providerForm" data-fv-trigger="blur change keyup"   enctype="multipart/form-data" role="form">
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
                                <select name="locationID" id="locationID" class="form-control input-sm">
                                    <option >Select</option>
                                            <?php if (count($locationDetails) > 0 )
                                            {
                                                foreach ($locationDetails as $row)
                                                {
                                                            ?>
                                    <option value="<?php echo $row['location_id']; ?>"><?php echo $row['company_name']; ?></option>
                                                <?php } }?>
                                </select>
                            </section>
			</div>
                        
                        <div class="row">
			    <section class="col-sm-offset-5 col-sm-3 form-group">
				<input type="hidden" name="proceed" value="Add" />
				<input type="hidden" name="providerId" value="" />
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
    $('#providerForm')[0].reset();
}
function operationClose() {
    $('#viewPanel').removeClass('hide');
    $('#operationPanel').addClass('hide');
}
$("#providerForm").submit(function(e) {
    loadLoader();
    e.preventDefault();
    var formData = new FormData($(this)[0]);
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
	    operationClose();
	    $('#dataRespTable').dataTable().fnDraw();
	    unLoader();
	}
    });
});
function editProvider(providerId) {
    loadLoader();
    operationOpen();
    $('#operationPanel').find('.panel-title').text('Edit');
    $('#operationPanel').find('[name="proceed"]').val('Edit');
    $('#operationPanel').find('[name="save"]').text('Update');
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
	    unLoader();
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
	"sAjaxSource": '<?php echo site_url('approveRegister/generalProviderTable'); ?>',
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
		{ data: "first_name", className: "all"},
		{ data: "last_name"},
		{ data: "provider_type_id"},
		{ data: "phone"},
		{ data: "NPI"},
		{ data: "DEA_num"},
                { data: "location_id"},
		{
		    data: null, className: "all","orderable": false, 
		    render: function( data, type, row) {
			return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editProvider('+data['provider_id']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteProvider('+data['provider_id']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
		    }
		}
		],
	"order": [[ 0, "desc" ]],
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
    $( "#addbutton") .appendTo( ".no" );
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