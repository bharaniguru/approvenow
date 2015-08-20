<!-- begin #content -->
    <div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
	    <li><a href="javascript:;">Prior Authorization page2</a></li>
	    <li class="active">Prior Authorization page2</li>
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
			<h4 class="panel-title">Authrization 2</h4>
		    </div>
		    <div class="panel-body">
			<div class="">
			    <form id="form_validation" method="POST" enctype="multipart/form-data" action="<?php echo site_url('approveRegister/priorAuth2'); ?>" class="">
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
                                        <br><label><input type="radio" name="male"> New Theraphy</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="female"> Renewal</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Date Theraphy Initiated</label>
                                        <span class='input-group date'>
                                            <input type="text"  name="DOB" id="DOB" class="input-sm form-control input-group datepicker"  placeholder="Date Theraphy Initiated" />
                                                <span class="input-group-addon" >
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </span>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Duration of Theraphy</label>
                                        <span class='input-group date'>
                                            <input type="text"  name="DOB" id="DOB" class="input-sm form-control input-group datepicker"  placeholder="Duration of Theraphy" />
                                                <span class="input-group-addon" >
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </span>
                                    </section>
				
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="text" name="paitentName" id="paitentName"  class="form-control input-sm"  placeholder="Quantity" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Frequency</label>
                                        <input type="text" name="paitentName" id="paitentName"  class="form-control input-sm"  placeholder="Frequency" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Length of Theraphy</label>
                                        <input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Length of Theraphy" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Number of Refills</label>
                                        <input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Number of Refills" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Admin Type : </label>
                                        <br><label><input type="radio" name="pounds"> Oral/SL</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="kilograms"> Topical </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="kilograms"> Injection</label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="kilograms"> IV </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="kilograms"> Other </label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Admin Location : </label>
                                        <label><input type="radio" name="pounds"> Physician's Office</label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="kilograms"> Ambulatory Infusion Center </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="kilograms"> Paitent's Home</label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="kilograms"> Home Care Agency </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="kilograms"> Outpaitent Hospital Care </label>
                                        <label class="control-label"></label>
                                        <label><input type="radio" name="kilograms"> Long Term Care </label>
                                        <label class="control-label"></label>
                                        <br><label><input type="radio" name="kilograms"> Other </label>
                                    </section>
                                    <section class="col-sm-8 form-group">
                                            <label class="control-label">How Did the Paitents Receive the Medication  : </label>
                                            <br><label><input type="radio" name="male"> Paid Under Insurance </label>
                                            <label class="control-label"></label>
                                            <br><label><input type="radio" name="female"> Other</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Insurance Name</label>
                                        <input type="text" name="address" id="address" value="IEHP" class="form-control input-sm"  placeholder="Insurance Name" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Prior Auth Name(if known)</label>
                                        <input type="text" name="address" id="address"  class="form-control input-sm"  placeholder="Auth Number" />
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Exclusion Citeria</label>
                                        <!--<input type="text" name="phone" id="phone"  class="form-control input-sm"  placeholder="Phone" />-->
                                    </section>
                                </div>
                                <div class="row well">
                                    <section class="col-sm-10 form-group">
                                        <label class="page-header">Rationale</label>
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Other Citeria</label>
                                        <!--<input type="text" name="phone" id="phone"  class="form-control input-sm"  placeholder="Phone" />-->
                                    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Explanations</label>
                                        <textarea class="form-control" rows="8" id="comment"></textarea>
				    </section>
                                    <section class="col-sm-6 form-group">
                                        <label class="control-label">Paitent Drug History</label>
                                        <!--<input type="text" name="phone" id="phone"  class="form-control input-sm"  placeholder="Phone" />-->
                                    </section>
				</div>
                                </div>
                            </div>
			    <div class="col-sm-6">
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
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Diagonis Name" />
				  </section>
                                    <section class="col-sm-6 form-group">
					<label class="control-label">Please Enter Additional Diagonis</label>
					<input type="text" name="yourId" id="yourId"  class="form-control input-sm"  placeholder="Addtional Diagonis" />
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
					<input type="text" name="address" id="address" value="CONTINUED THERAPY"  class="form-control input-sm"  placeholder="City" />
				    </section>
				    <section class="col-sm-10 form-group">
                                        <p><strong>Please Provide any additional clinical information or comment perteniment to this request for coverage</strong></p>
                                    </section>
				    <section class="col-sm-6 form-group">
				       <label class="control-label"></label>
				       <input type="text" name="address" id="address" value="CONTINUED THERAPY" class="form-control input-sm"  placeholder="Zip Code" />
				   </section>
                                    
                                   <section class="col-sm-6 form-group">
                                            <label class="control-label">Will you be providing any attachement with this form ? </label>
                                            <label><input type="radio" name="male"> Yes </label>
                                            <label class="control-label"></label>
                                            <label><input type="radio" name="female"> No</label>
                                    </section>
				   <div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Reject Issues</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="5" id="comment"></textarea>
					</div>
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
				    <a href="<?=site_url('approveRegister/dashboard')?>" class="btn btn-sm btn-danger">cancel</a>
				    <button class="btn btn-sm btn-danger" type="button" onclick="window.history.back();">Back</button>
				    <button class="btn btn-sm btn-info" type="reset" onclick="form_reset();" >Reset</button>
				    <input type="submit" name="Save"  class="btn btn-sm btn-success"  value="Update PA">
				    <input type="submit" disabled="" name="Save"  class="btn btn-sm btn-primary"  value="Resubmit PA">
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
    
    </script>