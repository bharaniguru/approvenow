
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
			    
			    <form id="form_validation" method="POST" enctype="multipart/form-data" action="<?php echo site_url('approveRegister/priorAuth'); ?>" class="">
			    <div class="well">
				 <label>Submission Date: 07/23/2015</label>
				    <label class=" form-group pull-right">Status: Rejected</label>
			    </div>
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
				  <input type="text" name="paitentName" id="paitentName"  class="form-control input-sm"  placeholder="First Name" />
				</section>
				<section class="col-sm-6 form-group">
				  <label class="control-label">Paitent Last Name</label>
				  <input type="text" name="paitentName" id="paitentName"  class="form-control input-sm"  placeholder="Last Name" />
				</section>
                        
    
			    <section class="col-sm-6 form-group">
			     <label class="control-label">Date Of Birth</label>
			     <span class='input-group date'>
				 <input type="text"  name="DOB" id="DOB" class="input-sm form-control input-group datepicker"  placeholder="DOB" />
				     <span class="input-group-addon" >
					 <span class="glyphicon glyphicon-calendar"></span>
				     </span>
			     </span>
			    </section>
                            
	    
                            <section class="col-sm-6 form-group">
				<label class="control-label">Address</label>
				<input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Address" />
			    </section>
			    <section class="col-sm-6 form-group">
				<label class="control-label">City</label>
				<input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Address" />
			    </section>
			    <section class="col-sm-6 form-group">
				<label class="control-label">State</label>
				<select class="form-control input-sm">
				    <option value='0' disabled="">Select</option>
				    <option>California</option>
				</select>
			    </section>
			     <section class="col-sm-6 form-group">
				<label class="control-label">Zip</label>
				<input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Address" />
			    </section>
                           
                             <section class="col-sm-6 form-group">
				<label class="control-label">Phone</label>
				<input type="text" name="phone" id="phone"  class="form-control input-sm"  placeholder="Phone" />
			     </section>
                             
                            <section class="col-sm-6 form-group">
				    <label class="control-label">Gender : </label>
				    <label><input type="radio" name="male"> Male</label>
				    <label class="control-label"></label>
                                    <label><input type="radio" name="female"> Female</label>
			    </section>
                           
                            <section class="col-sm-6 form-group">
				<label class="control-label">Weight</label>
				<input type="text" name="weight" id="weight"  class="form-control input-sm"  placeholder="Weight" />
			    </section>
                           <section class="col-sm-6 form-group">
				    <label class="control-label">Unit Of Measure for Weight : </label>
				    <label><input type="radio" name="pounds"> Pounds (lbs)</label>
				    <label class="control-label"></label>
				    <label><input type="radio" name="kilograms"> Kilograms (kg)</label>
			   </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Height</label>
				<input type="text" name="height" id="height"  class="form-control input-sm"  placeholder="Height" />
			    </section>
                            <section class="col-sm-6 form-group">
				    <label class="control-label">Unit Of Measure for Height : </label>
				    <label><input type="radio" name="inches"> Inches (in)</label>
				    <label class="control-label"></label>
				    <label><input type="radio" name="centimeters"> Centimeters (cm)</label>
			    </section>
			   <section class="col-sm-6 form-group">
				<label class="control-label">Allergies</label>
				<input type="text" name="allergies" id="allergies"  class="form-control input-sm"  placeholder="Allergies" />
			   </section>
                           <section class="col-sm-6 form-group">
				<label class="control-label">Authorized Repsentative (if applicable)</label>
				<input type="text" name="authRep" id="authRep"  class="form-control input-sm"  placeholder="Auth Rep" />
			   </section>
			   
                           <section class="col-sm-6 form-group">
				<label class="control-label">Authorized Repsentative Phone Number</label>
				<input type="text" name="authRepPhone" id="authRepPhone"  class="form-control input-sm"  placeholder="Auth Rep Phone Number" />
			   </section>
			   
			  
                           <section class="col-sm-6 form-group">
			    <label class="control-label">Your identifier  (optional)</label>
			    <p><strong>Eg: medical record# or Billing#or RX# or your 3 intials</strong></p>
				<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Your Id" />
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
                                <input type="text" name="yourId" id="yourId" value="GUARDIAN PHARMACY" class="form-control input-sm"  placeholder="Pharmacy Name" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">NPI</label>
				<input type="text" name="yourId" id="yourId" value="1154433076" class="form-control input-sm"  placeholder="NPI" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Phone</label>
				<input type="text" name="yourId" id="yourId" value="(909) 570-2339" class="form-control input-sm"  placeholder="Phone" />
			    </section>
                            <section class="col-sm-6 form-group">
				<label class="control-label">Fax</label>
				<input type="text" name="yourId" id="yourId" value="(877) 220-0199" class="form-control input-sm"  placeholder="Fax" />
			    </section>
			</div>
			</div>
			    <div class="col-sm-6">
				<div class="row well">
				     <a href="" class="btn btn-sm btn-success pull-right" value="">Resubmit PA</a> 
				   
				    <section class="col-sm-6 form-group">
					 <label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				   
				    <section class="col-sm-10 form-group">
					 <label class="page-header">General Info</label>
				     </section>
				    
                                  <section class="col-sm-6 form-group">
					<label class="control-label">Prescriber's Name</label>
					<input type="text" name="yourId" id="yourId" value="BRIANNA"  class="form-control input-sm"  placeholder="Prescribers Name" />
				  </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Speciality</label>
					<input type="text" name="yourId" id="yourId" value="PAIN MANAGEMENT"  class="form-control input-sm"  placeholder="Speciality" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">NPI</label>
					<input type="text" name="yourId" id="yourId" value="120526619" class="form-control input-sm"  placeholder="NPI" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">DEA Number(if Required)</label>
					<input type="text" name="yourId" id="yourId" value="MC3089833" class="form-control input-sm"  placeholder="DEA Number" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Address</label>
					<input type="text" name="yourId" id="yourId" value="1850 E.WASHINGTON STREET" class="form-control input-sm"  placeholder="Address" />
				    </section>
				     <section class="col-sm-6 form-group">
					<label class="control-label">City</label>
					<input type="text" name="address" id="address" value="COLTON" class="form-control input-sm"  placeholder="City" />
				    </section>
				    <section class="col-sm-6 form-group">
					<label class="control-label">State</label>
					<select class="form-control input-sm">
					    <option value='0' disabled="">Select</option>
					    <option>California</option>
					</select>
				    </section>
				    <section class="col-sm-6 form-group">
				       <label class="control-label">Zip</label>
				       <input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Zip Code" />
				   </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Phone</label>
					<input type="text" name="yourId" value="909-887-2991" id="yourId"  class="form-control input-sm"  placeholder="Phone" />
				    </section>
                                   <section class="col-sm-6 form-group">
				    <label class="control-label">Fax Number( HIPPA  Area)</label>
				    <input type="text" name="yourId" id="yourId" value="909-887-5694" class="form-control input-sm"  placeholder="Fax Number" />
				   </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Email Address</label>
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Email Address" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Office Contact Person</label>
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Office Contact Person" />
				    </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Requestor (If Different from Prescriber)</label>
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Requister" />
				    </section>
                                    <!--<section class="col-sm-10 form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				    <section class="col-sm-10 form-group">
					 <label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				    <section class="col-sm-10 form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
				    </section>
				    <section class="col-sm-10 form-group">
					<label class="control-label">&nbsp;&nbsp;</label>
				    </section>-->
				   
				    <section class="col-sm-10 form-group">
					<label class="page-header">Insurance Details</label>
				    </section>
				    
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Primary Insurance Name</label>
					<input type="text" name="yourId" id="yourId" value="IEHP" class="form-control input-sm"  placeholder="Primary Insurance Name" />
				    </section>
                                     <section class="col-sm-6 form-group">
					<label class="control-label">Primary Patient ID Number</label>
					<input type="text" name="yourId" id="yourId" value="20140501534501" class="form-control input-sm"  placeholder="Primary Patient ID Number" />
				     </section>
				    <section class="col-sm-6 form-group">
					 <label class="control-label">Secondary Insurance Name</label>
					 <input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Secondary Insurance Name" />
				    </section>
				    <section class="col-sm-6 form-group">
					<label class="control-label">Secondary patient ID Number</label>
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Secondary patient ID Number" />
				    </section>
				     <div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Reject Issues</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="5" id="comment"></textarea>
					</div>
				</div>
			    <div class="col-md-6">
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
				    <button class="btn btn-sm btn-danger" type="button" onclick="window.history.back();">cancel</button>
				    <button class="btn btn-sm btn-info" type="reset" onclick="form_reset();" >Reset</button>
				    <!--<input type="submit" name="Save"  class="btn btn-sm btn-success"  value="Save">-->
				    <a href="<?=site_url('approveRegister/priorAuth2')?>" class="btn btn-sm btn-success" > Next </a>
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