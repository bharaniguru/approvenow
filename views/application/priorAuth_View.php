
	<div id="content" class="content">
	    <!-- begin breadcrumb -->
	    <ol class="breadcrumb pull-right">
		<li><a href="javascript:;"></a></li>
		<li class="active"></li>		    
	    </ol>
	    <!-- end breadcrumb -->
	    <!-- begin page-header -->
	    <h1 class="page-header">View  Master<!--<small> </small>--></h1>
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
			    <h4 class="panel-title"> Master</h4>
			</div>
			<div class="panel-body" id="form_validation">
			    
				<div class="alert alert-success outer"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a></div>
				
			   <div id="alert"></div>
			    <p  id="addbutton">
				<a class="btn btn-primary btn-sm" href="<?php echo site_url('approveRegister/priorAuth/empty');?>"><i class="fa fa-plus fa-1x"></i> <span class="f-s-14 f-w-500">Add</span></a>
			    </p>
			    <table class="table table-striped table-bordered nowrap" width="100%" id="dataRespTable">
				<thead>
				    <tr>
					<th>Diganois Code</th>
                                        <th>Paitent ID</th>
					<th>Paitent Name</th>
                                        <th>Paitent Address</th>
					<th>Pharmacy Name</th>
					<th>Pharmacy city</th>
					<th>Speciality</th>
					<th>Prescriber Name</th>
					<th>Insurance Name</th>
					<th>Prior Auth Name</th>
					<th>Action</th>
				    </tr>
				</thead>
				<tbody></tbody>
			    </table>
			</div>
		    </div> 
	    <!-- end panel -->
		</div>
	    </div>
	</div>
	<!-- end #content -->
	
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    
<script>
$(document).ready(function() {
    $(".outer").delay(2000).fadeOut("slow");
});
$(document).ready(function() {	  
	$(".outer").delay(20000).fadeOut("slow");
	var table = $("#dataRespTable").dataTable({
	    "sDom": "<'row'<'col-md-4 no 'f><'col-md-6 trcalign' TRC><'col-md-2 yes'l>r><t><'row'<'col-md-6'i><'col-md-6'p>>",
	    "bServerSide": true,
	    "bProcessing": true,
	    "sAjaxSource": '<?php echo site_url('approveRegister/priorAuthMasterTable'); ?>',
	    'responsive': true,
	    
	    //"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
	    "lengthMenu": [
	    [10, 20, 50, 100],
	    [10, 20, 50, 100] // change per page values here
	    ],
	    // "pageLength": 10,
	    "language": {
		"sLengthMenu": "_MENU_",
		"lengthMenu": " _MENU_ records",
		"processing": "<span class='loading'></span>"
	    },
	    columns:[
		{ data: "prior_authorizaion_id", className : 'none'},
		{ data: "patient_id"},
		{ data: "patient_first_name"},
		{ data: "patient_address"},
		{ data: "pharmacy_name"},
		{ data: "pharmacy_city"},
		{ data: "Prescriber_name"},
		{ data: "speciality"},
		{ data: "insurance_name"},
		{ data: "prior_auth_name"},
		
		{
		    data: null, className: "all","orderable": false, 
		    render: function( data, type, row) {
			return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editLocation('+data['']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteLocation('+data['']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
		    }
		},
		
	    ],
	    
	    tableTools: {
	    sSwfPath: "../../assets/plugins/DataTables/swf/copy_csv_xls_pdf.swf"
	    },		
	    'fnServerData': function(sSource, aoData, fnCallback)
	    {
		$.ajax
		({
		  'dataType': 'json',
		  'type'    : 'POST',
		  'url'     : sSource,
		   'data'    : aoData,
		  'success' : fnCallback
		});
	    },
	});
	//------------- Start for Processing Icon image------------------------------------//		
	$('#dataRespTable')
	.on( 'processing.dt', function ( e, settings, processing ) {
	    $('#processingIndicator').css( 'display', processing ? loadLoader() : unLoader());
	} )
	.dataTable();		
	//------------- End of Processing Icon image------------------------------------//			
	//---- for Append after Search button-----------
	$( "#addbutton") .appendTo( ".no " );
	//----------------------------------------------
	function loadLoader() {
	    $('body').addClass('loading').loader('show', { overlay: true });
	}
	function unLoader() {
	    $('body').removeClass('loading').loader('hide');
	}	
} );

//  $(document).ready(function() {
//    
//    var table = $("#dataRespTable").DataTable({
//	"sDom": "<'row'<'col-md-10 no 'f><'col-md-2 yes'l>r><t><'row'<'col-md-6'i><'col-md-6'p>>",
//	"bServerSide": true,
//	"bProcessing": false,
//	"sAjaxSource": '<?php echo site_url('approveRegister/priorAuthMasterTable'); ?>',
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
//	    "processing": loadLoader()
//	    //"processing": '<div class="loader overlay"><div class="loader-load"></div><div class="loader-overlay"></div></div>'
//	},
//	columns:[
//	    { data: "prior_authorizaion_id", className : 'none'},
//	    { data: "patient_id"},
//            { data: "patient_first_name"},
//            { data: "patient_address"},
//            { data: "pharmacy_name"},
//            { data: "pharmacy_city"},
//            { data: "Prescriber_name"},
//	    { data: "speciality"},
//            { data: "insurance_name"},
//            { data: "prior_auth_name"},
//            { data: "account_id",className : 'none'},
//	    {
//		data: null, className: "all","orderable": false, 
//		render: function( data, type, row) {
//		    return '<div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editLocation('+data['']+')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteLocation('+data['']+')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td></tr>'
//		}
//	    },
//		{
//		    data: null, className: "all","orderable": false, 
//		    render: function( data, type, row) {
//			return '<a class="btn btn-info btn-sm" data-toggle="modal" onclick="ajaxLocations('+data['']+')" data-target="#myModal">View PG</a>'
//		    }
//		},
//	],
//	//"order": [[ 11, "desc" ]],
//	//tableTools: {
//	//    sSwfPath: "../assets/plugins/DataTables/swf/copy_csv_xls_pdf.swf"
//	//},
//	'fnServerData': function(sSource, aoData, fnCallback){
//	    $.ajax({
//		'dataType': 'json',
//		'type'    : 'POST',
//		'url'     : sSource,
//		'data'    : aoData,
//		'success' : fnCallback
//	    });
//	},
//    });
//    ////------------- Start for Processing Icon image------------------------------------//
//    $('#dataRespTable').on( 'processing.dt', function ( e, settings, processing ) {
//        $('#processingIndicator').css( 'display', processing ? loadLoader() : unLoader());
//    }).dataTable();
//    ////------------- End of Processing Icon image------------------------------------//
//    //---- for Append after Search button-----------
//    $( "#addbutton") .appendTo( ".no " );
//    ////----------------------------------------------
//    //
//    function loadLoader() {
//    $('body').addClass('loading').loader('show', { overlay: true });
//}
//function unLoader() {
//    $('body').removeClass('loading').loader('hide');
//}
//});  


//$('#form_validation').on('click', '#delete_box', function(e) {
// e.preventDefault();
//    var link = $(this).attr('href');
//    var code = $(this).attr('code');
//    var lang = $(this).attr('lan');
//    var userId = $(this).attr('userId');
//    bootbox.confirm("Are you sure you want to delete ?", function(confirmed) {   
//	if (confirmed) {
//	    $.ajax({ 
//		type:'POST',
//		url:link,
//		data:{'code':code,'lang':lang,'userId':userId},
//		success:function(response){
//		if(response==1){
//		$('#alert').append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> A Record is Deleted Successfully.</div>');
//		}else{
//		$('#alert').append('<div class="alert alert-danger "><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>'+response+'</div>');
//		}
//		$('#dataRespTable').dataTable().fnDraw();
//		setTimeout(function(){ $('#alert').empty(); }, 8000);
//		}
//	    });
//	}    
//    });
//});
</script>