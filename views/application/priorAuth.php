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
			<h4 class="panel-title">Prior Authorization</h4>
		    </div>
		    
		    <div class="panel-body">
			
			<div class="">
			    
			    <form id="priorAuthForm" method="POST" enctype="multipart/form-data" action="<?php echo site_url('approveRegister/priorAuth/'); ?>" class="">
			    <div class="well">
				 <label>Submission Date: 07/23/2015</label>
				    <label class=" form-group pull-right">Status: Rejected</label>
			    </div>
			    <?php if($empty=="empty"){
				?>
				<input type="hidden" name="sampleData" value="empty">
				<?php
				}else { ?>
				<input type="hidden" name="sampleData" value="data">
				<?php
				}?>
			    <div class="col-md-6">
				<div class="row well">
				<section class="col-sm-6 form-group">
				    <label class="control-label"></label>
			       </section>
				<section class="col-sm-6 form-group">
				    <label class="control-label"></label>
			       </section>
				<section class="col-sm-10 form-group">
				    <label class="page-header">Paitent Details</label>
				</section>
				<section class="col-sm-6 form-group">
				  <label class="control-label">Paitent First Name</label>
				  <input type="text" name="patient_first_name" id="patient_first_name"  class="form-control input-sm"  placeholder="First Name" />
				</section>
				<section class="col-sm-6 form-group">
				  <label class="control-label">Paitent Last Name</label>
				  <input type="text" name="patient_last_name" id="patient_last_name"  class="form-control input-sm"  placeholder="Last Name" />
				</section>
                        
    
			    <section class="col-sm-6 form-group">
			     <label class="control-label">Date Of Birth</label>
			     <span class='input-group date'>
				 <input type="text"  name="patient_dob" id="patient_dob" class="input-sm form-control input-group datepicker"  placeholder="DOB" />
				     <span class="input-group-addon" >
					 <span class="glyphicon glyphicon-calendar"></span>
				     </span>
			     </span>
			    </section>
                            
	    
                            <section class="col-sm-6 form-group">
				<label class="control-label">Address</label>
				<input type="text" name="patient_address" id="patient_address"  class="form-control input-sm"  placeholder="Address" />
			    </section>
			    <section class="col-sm-6 form-group">
				<label class="control-label">City</label>
				<input type="text" name="patient_city" id="patient_city"  class="form-control input-sm"  placeholder="Address" />
			    </section>
			    <section class="col-sm-6 form-group">
				<label class="control-label">State</label>
				<select name="patient_state" id="patient_state" class="form-control input-sm">
					 <option selected  disabled="">select</option>
						<?php if (count($state) > 0 )
						    {
							foreach ($state as $row)
							    {
							    ?>
						<option value="<?php echo $row['state_code']; ?>"><?php echo $row['state_name']; ?></option>
						<?php } }?>   
				</select>
			    </section>
			     <section class="col-sm-6 form-group">
				<label class="control-label">Zip</label>
				<input type="text" name="patient_zip" id="patient_zip"  class="form-control input-sm"  placeholder="Address" />
			    </section>
                           
                             <section class="col-sm-6 form-group">
				<label class="control-label">Phone</label>
				<input type="text" name="patient_contact_number" id="patient_contact_number"  class="form-control input-sm"  placeholder="Phone" />
			     </section>
                             
                            <section class="col-sm-6 form-group">
				    <label class="control-label">Gender : </label>
				    <label><input type="radio" name="patient_gender"> Male</label>
				    <label class="control-label"></label>
                                    <label><input type="radio" name="patient_gender"> Female</label>
			    </section>
                           
                            <section class="col-sm-6 form-group">
				<label class="control-label">Weight</label>
				<input type="text" name="weight" id="weight"  class="form-control input-sm"  placeholder="Weight" />
			    </section>
                           <section class="col-sm-6 form-group">
				    <label class="control-label">Unit Of Measure for Weight : </label>
				    <label><input type="radio" name="uom_weight"> Pounds (lbs)</label>
				    <label class="control-label"></label>
				    <label><input type="radio" name="uom_weight"> Kilograms (kg)</label>
			   </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Height</label>
				<input type="text" name="height" id="height"  class="form-control input-sm"  placeholder="Height" />
			    </section>
                            <section class="col-sm-6 form-group">
				    <label class="control-label">Unit Of Measure for Height : </label>
				    <label><input type="radio" name="uom_height"> Inches (in)</label>
				    <label class="control-label"></label>
				    <label><input type="radio" name="uom_height"> Centimeters (cm)</label>
			    </section>
			   <section class="col-sm-6 form-group">
				<label class="control-label">Allergies</label>
				<input type="text" name="allergies" id="allergies"  class="form-control input-sm"  placeholder="Allergies" />
			   </section>
                           <section class="col-sm-6 form-group">
				<label class="control-label">Authorized Repsentative (if applicable)</label>
				<input type="text" name="auth_rep" id="auth_rep"  class="form-control input-sm"  placeholder="Auth Rep" />
			   </section>
			   
                           <section class="col-sm-6 form-group">
				<label class="control-label">Authorized Repsentative Phone Number</label>
				<input type="text" name="auth_rep_phone" id="auth_rep_phone"  class="form-control input-sm"  placeholder="Auth Rep Phone Number" />
			   </section>
			   
			  
                           <section class="col-sm-6 form-group">
			    <label class="control-label">Your identifier  (optional)</label>
			    <p><strong>Eg: medical record# or Billing#or RX# or your 3 intials</strong></p>
				<input type="text" name="patient_id" id="patient_id"  class="form-control input-sm"  placeholder="Your Id" />
			   </section>
                           
			    <section class="col-sm-6 form-group">
			     <label class="control-label">&nbsp;&nbsp;</label>
			    </section>
			    <section class="col-sm-6 form-group">
			     <label class="control-label">&nbsp;&nbsp;</label>
			    </section>
                           <section class="col-sm-10 form-group">
                                <label class="page-header">Pharmacy Details</label>
			    </section>
			   <section class="col-sm-10 form-group">
                                <p><strong>Note: * For Pharmacy use Only</strong></p>
			    </section>
                          
                            <section class="col-sm-6 form-group">
                                <label class="control-label">Pharmacy Name</label>
                                <input type="text" name="pharmacy_name" id="pharmacy_name" value="" class="form-control input-sm"  placeholder="Pharmacy Name" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">NPI</label>
				<input type="text" name="doctor_NPI" id="doctor_NPI" value="" class="form-control input-sm"  placeholder="NPI" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Phone</label>
				<input type="text" name="pharmacy_contact_number" id="pharmacy_contact_number" value="" class="form-control input-sm"  placeholder="Phone" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Pharamacy City</label>
				<input type="text" name="pharmacy_city" id="pharmacy_city" value="" class="form-control input-sm"  placeholder="Fax" />
			    </section>
			</div>
			</div>
			    <div class="col-sm-6">
				<div class="row well">
				    <section class="col-sm-6 form-group">
					 <label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				   
				    <section class="col-sm-10 form-group">
					 <label class="page-header">General Info</label>
				     </section>
				    
                                  <section class="col-sm-6 form-group">
					<label class="control-label">Prescriber's Name</label>
					<input type="text" name="pharmacist_first_name" id="pharmacist_first_name" value=""  class="form-control input-sm"  placeholder="Prescribers Name" />
				  </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Speciality</label>
					<input type="text" name="speciality" id="speciality" value=" "  class="form-control input-sm"  placeholder="Speciality" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">NPI</label>
					<input type="text" name="doctor_NPI" id="doctor_NPI" value="" class="form-control input-sm"  placeholder="NPI" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">DEA Number(if Required)</label>
					<input type="text" name="DEA_number" id="DEA_number" value="" class="form-control input-sm"  placeholder="DEA Number" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Address</label>
					<input type="text" name="prescriber_address" id="prescriber_address" value="  " class="form-control input-sm"  placeholder="Address" />
				    </section>
				     <section class="col-sm-6 form-group">
					<label class="control-label">City</label>
					<input type="text" name="prescriber_city" id="prescriber_city" value="" class="form-control input-sm"  placeholder="City" />
				    </section>
				    <section class="col-sm-6 form-group">
					<label class="control-label">State</label>
					<select class="form-control input-sm" name="prescriber_state">
					    <option selected  disabled="">select</option>
						<?php if (count($state) > 0 )
						    {
							foreach ($state as $row)
							    {
							    ?>
						<option value="<?php echo $row['state_code']; ?>"><?php echo $row['state_name']; ?></option>
						<?php } }?>   
					</select>
				    </section>
				    <section class="col-sm-6 form-group">
				       <label class="control-label">Zip</label>
				       <input type="text" name="prescriber_zip" id="prescriber_zip"  class="form-control input-sm"  placeholder="Zip Code" />
				   </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Phone</label>
					<input type="text" name="prescriber_phone" value="" id="prescriber_phone"  class="form-control input-sm"  placeholder="Phone" />
				    </section>
                                   <section class="col-sm-6 form-group">
				    <label class="control-label">Fax Number( HIPPA  Area)</label>
				    <input type="text" name="prescriber_fax" id="prescriber_fax" value="" class="form-control input-sm"  placeholder="Fax Number" />
				   </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Email Address</label>
					<input type="text" name="prescriber_email" id="prescriber_email"  class="form-control input-sm"  placeholder="Email Address" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Office Contact Person</label>
					<input type="text" name="office_contact_person" id="office_contact_person"  class="form-control input-sm"  placeholder="Office Contact Person" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Requestor (If Different from Prescriber)</label>
					<input type="text" name="requestor" id="requestor"  class="form-control input-sm"  placeholder="Requister" />
				    </section>
                               
				    <section class="col-sm-10 form-group">
					<label class="page-header">Insurance Details</label>
				    </section>
				    
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Primary Insurance Name</label>
					<input type="text" name="primary_insurance_name" id="primary_insurance_name" value="" class="form-control input-sm"  placeholder="Primary Insurance Name" />
				    </section>
                                     <section class="col-sm-6 form-group">
					<label class="control-label">Primary Patient ID Number</label>
					<input type="text" name="primary_paitent_id" id="primary_paitent_id" value="" class="form-control input-sm"  placeholder="Primary Patient ID Number" />
				     </section>
				    <section class="col-sm-6 form-group">
					 <label class="control-label">Secondary Insurance Name</label>
					 <input type="text" name="secondary_insurance_name" id="secondary_insurance_name"  class="form-control input-sm"  placeholder="Secondary Insurance Name" />
				    </section>
				    <section class="col-sm-12 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-12 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-12 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-8 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-8 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-6 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-6 form-group">
					<label class="control-label"></label>
					
				    </section>
				   <section class="col-sm-6 form-group">
					<label class="control-label"></label>
					
				    </section>
				</div>
			    </div>
			    <section class="form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
			    </section>
			<div class="col-md-6">
			    <div class="row well">
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label"></label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label"></label>
                                    </section>
                                    <section class="col-sm-10 form-group">
                                        <label class="page-header">Medication /Medical and Dispensing information</label>
                                    </section>
                                    <section class="col-sm-8 form-group">
                                        <label class="control-label">Theraphy Type : </label>
                                        <br><label><input type="radio" name="theraphy_type"> New Theraphy</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="theraphy_type"> Renewal</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Date Theraphy Initiated</label>
                                        <span class='input-group date'>
                                            <input type="text"  name="date_theraphy" id="date_theraphy" class="input-sm form-control input-group datepicker"  placeholder="Date Theraphy Initiated" />
                                                <span class="input-group-addon" >
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </span>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Duration of Theraphy</label>
                                        <span class='input-group date'>
                                            <input type="text"  name="duration_theraphy" id="duration_theraphy" class="input-sm form-control input-group datepicker"  placeholder="Duration of Theraphy" />
                                                <span class="input-group-addon" >
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </span>
                                    </section>
				
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="text" name="quantity" id="quantity"  class="form-control input-sm"  placeholder="Quantity" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Frequency</label>
                                        <input type="text" name="frequency" id="frequency"  class="form-control input-sm"  placeholder="Frequency" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Length of Theraphy</label>
                                        <input type="text" name="length_theraphy" id="length_theraphy"  class="form-control input-sm"  placeholder="Length of Theraphy" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Number of Refills</label>
                                        <input type="text" name="num_refills" id="num_refills"  class="form-control input-sm"  placeholder="Number of Refills" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Admin Type : </label>
                                        <br><label><input type="radio" name="admin_type"> Oral/SL</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="admin_type"> Topical </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="admin_type"> Injection</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="admin_type"> IV </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="admin_type"> Other </label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Admin Location : </label>
                                        <label><input type="radio" name="admin_location"> Physician's Office</label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="admin_location"> Ambulatory Infusion Center </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="admin_location"> Paitent's Home</label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="admin_location"> Home Care Agency </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="admin_location"> Outpaitent Hospital Care </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="admin_location"> Long Term Care </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="admin_location"> Other </label>
                                    </section>
                                    <section class="col-sm-8 form-group">
                                            <label class="control-label">How Did the Paitents Receive the Medication  : </label>
                                            <br><label><input type="radio" name="paitents_receive"> Paid Under Insurance </label>
                                            <label class="control-label"></label>
                                            <br><label><input type="radio" name="paitents_receive"> Other</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Insurance Name</label>
                                        <input type="text" name="insurance_name" id="insurance_name" value="" class="form-control input-sm"  placeholder="Insurance Name" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Prior Auth Name(if known)</label>
                                        <input type="text" name="prior_auth_name" id="prior_auth_name"  class="form-control input-sm"  placeholder="Auth Number" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Exclusion Citeria</label>
                                       
                                    </section>
                                </div>
			    <section class="form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
			    </section>
			      <div class="row well">
                                    <section class="col-sm-10 form-group">
                                        <label class="page-header">Rationale</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Other Citeria</label>
				    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Explanations</label>
                                        <textarea class="form-control" rows="8" id="comment" name="explanations"></textarea>
				    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Paitent Drug History</label>
                                       
                                    </section>
				</div>
			      <section class="form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
			    </section>
			      <div class="row well">
				<section class="col-sm-12 form-group">
                                        <label class="page-header">Upload Addtional Documentation</label>
                                </section>
				<section class="col-sm-12 form-group">
                                        <label class="control-label">Upload Attachement</label>
					<p>Upload Test results or other medical information that you would like attached to your requested</p>
					
				<a href="" id="upload_link">Upload or manage Attachments</a>
				<input id="upload" type="file"/>

				</section>
			      </div>
			      <section class="form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
			    </section>
			</div><!--col-md-6 end-->
			<div class="col-md-6">
			    <div class="row well">
				 <section class="col-sm-6 form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
				   </section>
				    <section class="col-sm-6 form-group">
					 <label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				    <section class="col-sm-10 form-group">
					 <label class="page-header">Clinical Details</label>
				     </section>
				    
				    <section class="col-sm-6 form-group">
					  <label class="control-label">Diagonis</label>
					  <input type="text" name="diagnosis_code" id="diagnosis_code"  class="form-control input-sm"  placeholder="Diagonis Name" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Please Enter Additional Diagonis</label>
					<input type="text" name="add_diagonis" id="add_diagonis"  class="form-control input-sm"  placeholder="Addtional Diagonis" />
				    </section>
                                    <section class="col-sm-10 form-group" id="moreinfo>
                                            <label class="control-label">Has The Paitent's Try any other Medications for this condition : </label>
                                            <br><label><input type="radio" value="Y" id="radioYes"  name="already_y"> Yes </label>
                                            <label class="control-label"></label>
                                            <br><label><input type="radio" value="N" id="radioYes"  name="already_Y"> No</label>
                                    </section>
				    <div id="showDiv">
                                        <section class="col-sm-10 form-group">
                                            <p><strong>Please Enter all Medications previously tried for this conditions:</strong></p>
                                        </section>
                                        
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Medications/Therapy</label>
                                            <input type="text" name="other_medications" id="other_medications"  class="form-control input-sm"  placeholder="Medications" />
                                        </section>
                                       
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Duration Of Therapy</label>
                                            <span class='input-group date'>
                                                <input type="text"  name="DOB" id="DOB" class="input-sm form-control input-group datepicker"  placeholder="Duration Of Therapy" />
                                                    <span class="input-group-addon" >
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </span>
                                        </section>
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Response/Failure/Allergy</label>
                                            <input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Address" />
                                        </section>
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Medications/Therapy</label>
                                            <input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Medications" />
                                        </section>
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Duration Of Therapy</label>
                                            <span class='input-group date'>
                                                <input type="text"  name="DOB" id="DOB" class="input-sm form-control input-group datepicker"  placeholder="Duration Of Therapy" />
                                                    <span class="input-group-addon" >
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </span>
                                        </section>
                                        <section class="col-sm-6 form-group">
                                            <label class="control-label">Resaon for Failure/Allergy</label>
                                            <input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Resaon for Failure" />
                                        </section>
                                    </div>
				    <section class="col-sm-10 form-group">
                                        <p><strong>Please Provide Symptoms, lab Result with dates and/or Justification for inital or ongoing Therapy or increased dose and in paitent has any contraindications for the health plan/ Insurer preferred drug (Lab result with date must be provided if needed to establish the diagonis,or Evalute response):</strong></p>
                                    </section>
				     <section class="col-sm-6 form-group">
					<label class="control-label"></label>
					<input type="text" name="address" id="address" value=""  class="form-control input-sm"  placeholder="CONTINUED THERAPHY" />
				    </section>
				    <section class="col-sm-10 form-group">
                                        <p><strong>Please Provide any additional clinical information or comment perteniment to this request for coverage</strong></p>
                                    </section>
				    <section class="col-sm-6 form-group">
				       <label class="control-label"></label>
				       <input type="text" name="address" id="address" value="" class="form-control input-sm"  placeholder="CONTINUED THERAPHY" />
				   </section>
                                    
                                   <section class="col-sm-6 form-group">
                                            <label class="control-label">Will you be providing any attachement with this form ? </label>
                                            <label><input type="radio" name="attachment_yn"> Yes </label>
                                            <label class="control-label"></label>
                                            <label><input type="radio" name="attachment_yn"> No</label>
                                    </section>
			    <div class="col-md-12 table-responsive">
				<table id="" class="table table-striped table-bordered nowrap" width="100%">
				    <thead>
					<tr>
					    <th>PA Reject Reason </th>
					    <th>Reject Reason Col</th>
					    <th>Notes</th>
					    <th>Checkit</th>
					</tr>
				    </thead>
				    <tbody id="">
					<tr>
					 <?php
					     if($empty!='empty'){
					 foreach ($rejectReference as $row){?>
					 
					<td><?php echo $row['PA_reject_reason']; ?></td>
					<td><?php echo $row['PA_reject_reasoncol']; ?></td>
					<td><?php echo $row['Notes']; ?></td>
					<td><input type="checkbox" name="rejectReason" id="rejectReason"></td>
					</tr>
				    </tbody>
				    <?php }} ?>
				</table>
			    </div>
			    <div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Update history</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="5" id="comment"></textarea>
					</div>
				</div>
			    </div>
			</div>
			    <section class="col-sm-10 form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				  
				   
			   <div class=" col-md-6 col-md-offset-4">
				<div class="form-group">
				    <label class="col col-4"></label>
				    <a href="<?=site_url('approveRegister/dashboard')?>" onclick="operationClose()"; class="btn btn-sm btn-danger">cancel</a>
				    <button class="btn btn-sm btn-warning" type="button" onclick="window.history.back();">Back</button>
				    <button class="btn btn-sm btn-info" type="reset" onclick="form_reset();" >Reset</button>
				     <?php
					if($empty=='empty'){?>
				    <input type="submit" name="proceed"  class="btn btn-sm btn-success"  value="save">
				    <?php } else { ?>
					<input type="submit" name="proceed"  class="btn btn-sm btn-success"  value="Update PA">
				    <?php }  ?>
				    <input type="submit"  name="Save" id="resubmit"  class="btn btn-sm btn-primary"  value="Resubmit PA">
				</div>
			    </div>
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
  
    
<script type="text/javascript">
$(function () {
    $('.datepicker').datetimepicker({
	format: 'DD-MMM-YYYY'
	});
});
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
	  var number=0;
	  $('#resubmit').prop('disabled', true);
	  $('*#rejectReason').click(function(){
	    $(this).attr("checked", "true");
	    var total_count   =$('[name="rejectReason"]').length;
	    var checked_count=0;
	    $('[name="rejectReason"]').each(function(){
		    
	    if($(this).is(":checked"))
	    {
		    checked_count++;
	    }
	    });
	    if (total_count==checked_count) {
	    
	    $('#resubmit').removeAttr('disabled');				
	    }
	    
	    });
	
    </script>

<script type="text/javascript">
    
function operationOpen() {
    $('#viewPanel').addClass('hide');
    $('#operationPanel').removeClass('hide');
    $('#operationPanel').find('.panel-title').text('Add');
    $('#operationPanel').find('[name="proceed"]').val('Add');
    $('#operationPanel').find('[name="save"]').text('Save');
    $('#priorAuthForm')[0].reset();
}
function operationClose() {
    $('#viewPanel').removeClass('hide');
    $('#operationPanel').addClass('hide');
}
$("#priorAuthForm").submit(function(e) {
    loadLoader();
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/PriorAuthDetailsOperation');?>',
	mimeType:"multipart/form-data",
	data:formData,
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
function editPriorAuth(prior_authorizaion_id) {
    loadLoader();
    operationOpen();
    
    $('#operationPanel').find('.panel-title').text('Edit');
    $('#operationPanel').find('[name="proceed"]').val('Edit');
    $('#operationPanel').find('[name="save"]').text('Update');
    $.ajax({
	type:'POST',
	url:'<?=site_url('approveRegister/getPriorAuthDetails');?>',
	data:{prior_authorizaion_id:prior_authorizaion_id},
	dataType: 'json',
	success:function(json){
	  console.log(json);
	    $('#priorAuthForm').find('[name="patient_first_name"]').val(json[0].patient_first_name);
	    $('#priorAuthForm').find('[name="patient_last_name"]').val(json[0].patient_last_name);
	    $('#priorAuthForm').find('[name="patient_dob"]').val(json[0].patient_dob);
	    $('#priorAuthForm').find('[name="patient_address"]').val(json[0].patient_address);
	    $('#priorAuthForm').find('[name="patient_city"]').val(json[0].patient_city);
	    $('#priorAuthForm').find('[name="patient_state"]').val(json[0].patient_state);
	    $('#priorAuthForm').find('[name="patient_zip"]').val(json[0].patient_zip);
	    $('#priorAuthForm').find('[name="patient_contact_type"]').val(json[0].patient_contact_type);
	    $('#priorAuthForm').find('[name="patient_gender"]').val(json[0].patient_gender);
	    $('#priorAuthForm').find('[name="weight"]').val(json[0].weight);
	    $('#priorAuthForm').find('[name="height"]').val(json[0].height);
	    $('#priorAuthForm').find('[name="uom_weight"]').val(json[0].uom_weight);
	    $('#priorAuthForm').find('[name="uom_height"]').val(json[0].uom_height);
	    $('#priorAuthForm').find('[name="allergies"]').val(json[0].allergies);
	    
	    $('#priorAuthForm').find('[name="auth_rep"]').val(json[0].auth_rep);
	    $('#priorAuthForm').find('[name="patient_last_name"]').val(json[0].patient_last_name);
	    $('#priorAuthForm').find('[name="patient_id"]').val(json[0].patient_id);
	    $('#priorAuthForm').find('[name="pharmacy_name"]').val(json[0].pharmacy_name);
	    $('#priorAuthForm').find('[name="doctor_NPI"]').val(json[0].doctor_NPI);
	    $('#priorAuthForm').find('[name="pharmacy_contact_number"]').val(json[0].pharmacy_contact_number);
	    $('#priorAuthForm').find('[name="pharmacy_city"]').val(json[0].pharmacy_city);
	    $('#priorAuthForm').find('[name="Prescriber_name"]').val(json[0].Prescriber_name);
	    $('#priorAuthForm').find('[name="doctor_NPI"]').val(json[0].doctor_NPI);
	    $('#priorAuthForm').find('[name="DEA_number"]').val(json[0].DEA_number);
	    $('#priorAuthForm').find('[name="prescriber_address"]').val(json[0].prescriber_address);
	    $('#priorAuthForm').find('[name="prescriber_city"]').val(json[0].prescriber_city);
	    $('#priorAuthForm').find('[name="prescriber_state"]').val(json[0].prescriber_state);
	    $('#priorAuthForm').find('[name="prescriber_zip"]').val(json[0].prescriber_zip);
	    
	    $('#priorAuthForm').find('[name="prescriber_phone"]').val(json[0].prescriber_phone);
	    $('#priorAuthForm').find('[name="prescriber_fax"]').val(json[0].prescriber_fax);
	    $('#priorAuthForm').find('[name="prescriber_email"]').val(json[0].prescriber_email);
	    $('#priorAuthForm').find('[name="office_contact_person"]').val(json[0].office_contact_person);
	    $('#priorAuthForm').find('[name="requestor"]').val(json[0].requestor);
	    $('#priorAuthForm').find('[name="primary_insurance_name"]').val(json[0].primary_insurance_name);
	    $('#priorAuthForm').find('[name="secondary_insurance_name"]').val(json[0].secondary_insurance_name);
	    $('#priorAuthForm').find('[name="primary_paitent_id"]').val(json[0].primary_paitent_id);
	    $('#priorAuthForm').find('[name="theraphy_type"]').val(json[0].theraphy_type);
	    $('#priorAuthForm').find('[name="date_theraphy"]').val(json[0].date_theraphy);
	    $('#priorAuthForm').find('[name="duration_theraphy"]').val(json[0].duration_theraphy);
	    $('#priorAuthForm').find('[name="quantity"]').val(json[0].quantity);
	    $('#priorAuthForm').find('[name="frequency"]').val(json[0].frequency);
	    $('#priorAuthForm').find('[name="length_theraphy"]').val(json[0].length_theraphy);
	    
	    $('#priorAuthForm').find('[name="num_refills"]').val(json[0].num_refills);
	    $('#priorAuthForm').find('[name="admin_type"]').val(json[0].admin_type);
	    $('#priorAuthForm').find('[name="admin_location"]').val(json[0].admin_location);
	    $('#priorAuthForm').find('[name="paitents_receive"]').val(json[0].paitents_receive);
	    $('#priorAuthForm').find('[name="insurance_name"]').val(json[0].insurance_name);
	    $('#priorAuthForm').find('[name="prior_auth_name"]').val(json[0].prior_auth_name);
	    $('#priorAuthForm').find('[name="diagonis"]').val(json[0].diagonis);
	    $('#priorAuthForm').find('[name="add_diagonis"]').val(json[0].add_diagonis);
	    $('#priorAuthForm').find('[name="other_medications"]').val(json[0].other_medications);
	    $('#priorAuthForm').find('[name="date_theraphy"]').val(json[0].date_theraphy);
	    $('#priorAuthForm').find('[name="duration_theraphy"]').val(json[0].duration_theraphy);
	    $('#priorAuthForm').find('[name="explanations"]').val(json[0].explanations);
	   
	    unLoader();
	}
    });
}
function deleteLocation(prior_authorizaion_id) {
    bootbox.confirm("Are you sure you want to delete?", function(confirmed) {
	if (confirmed) {
	    $.ajax({
		type:'POST',
		url:'<?php echo  site_url('approveRegister/deleteLocation');?>',
		data:{prior_authorizaion_id:prior_authorizaion_id},
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
//VIEW TABLE STARTS
//VIEW TABLE ENDS
//FILEUPLOAD SCRIPT START
$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});
//FILE UPLOAD SCRIPTY END
</script>