<style>
    body{
        font-family: sans-serif;
        font-size: 12px;
    }
    .checkk{
        margin-right: 2px !important;
    }
    .main{
        width: 100%;
        margin: 0 auto;
    }
    .header{
        margin-bottom: 8px;
    }
    .header h2{
        text-align: center;
    }
    .table-clr{
        border: 1px solid #6B6B6B;
    }
    .align-table{
        border: 1px solid #6B6B6B;
    }
    td{
        border: 1px solid #6B6B6B;
        /*height: 50px;*/
        padding: 8px;
    }
    th{
        padding: 3px;
        text-align: center;
        background-color: #C5D9F0;
    }
    .border-hide td{
        border:  none !important;
        height: auto !important;
        padding: 4px !important;
    }
    .head-table td{
        border:  none !important;
        height: 10px !important;
        padding: 2px !important;
        width: 50%;
    }
    
    /*second-page css*/
    .instruction{
        width: 95%;
        padding: 12px;
        line-height: 20px;
        margin: 0 auto;
    }
    
    .change{
        border: 1px solid #6B6B6B;
        width: 100%;
    }
    .change p{
        text-align: left;
        padding: 5px;
    }
    .table-1 td{
        padding-bottom: 80px;
        border: 1px solid #6B6B6B;
    }
    .table-1 th{
        text-align: left;
    }
    .table-2 td{
        padding-bottom: 80px;
        border: 1px solid #6B6B6B;        
    }
    .content-attention{
        border: 2px solid #6B6B6B;
        margin-top: 20px;
        padding: 6px;
    }
    .content-notice{
        border: 2px solid #6B6B6B;
        padding: 6px;
    }
    .content-footer{
        border: 2px solid #6B6B6B;
        padding: 6px;
    }
    .brd-hidden td{
        border:  none !important;
    }
    
    
</style>

<div class="main">
    <div class="header">
        <h2>PRESCRIPTION DRUG PRIOR AUTHORIZATION REQUEST FORM</h2>
        <table style="width: 100%;" class="head-table">
        <tr>
            <td><b>Plan/Medical Group Name:</b>____________________________</td>
            <td><b>Plan/Medical Group Phone#: (__ __ _)________________</b></td>
        </tr>
        <tr>
            <td>
            <td><b>Plan/Medical Group Fax#: (__ __ _)___________________</b></td>
        </tr>
        </table>
        
    </div>
<div class="table-clr">
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td colspan="10"><b>Instructions:</b> Please fill out all applicable sections on both pages completely and legibly. Attach any additional documentation that is important for the review, e.g. chart notes or lab data, to support the prior authorization request.</td>
        </tr>
        <tr>
            <th colspan="12">Patient Information: This must be filled out completely to ensure HIPAA compliance</th>
        </tr>
        <tr>
            <td colspan="3">First Name:<?php echo $pdfValue[0]['patient_first_name'];?></td>
            <td colspan="2">Last Name:<?php echo $pdfValue[0]['patient_last_name'];?></td>
            <td colspan="1">MI: </td>
            <td colspan="2">Phone Number:<?php echo $pdfValue[0]['patient_contact_number'];?></td>
        </tr>
    </table>
    
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td style="width: 40%;">Address:<?php echo $pdfValue[0]['patient_address'];?></td>
            <td style="width: 20%;">City:<?php echo $pdfValue[0]['patient_city'];?></td>
            <td style="width: 20%;">State:<?php echo $pdfValue[0]['patient_state'];?></td>
            <td style="width: 20%;">Zip Code:<?php echo $pdfValue[0]['patient_zip'];?></td>
        </tr>
    </table>

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td style="width: 30%;">Date Of Birth:<?php echo $pdfValue[0]['patient_dob'];?></td>
            <td style="width: 20%;">Male <input type="checkbox" <?php if($pdfValue[0]['patient_gender']=='male') echo "checked";?>><br> Female <input type="checkbox" value="female" <?php if($pdfValue[0]['patient_gender']=='female') echo "checked"?>> <br></td>
            <td style="width: 30%;">Circle unit of measure<br>Height(in/CM):<u><?php echo $pdfValue[0]['patient_height'];?></u>  Weight(lb/Kg):<u><?php echo $pdfValue[0]['patient_weight'];?></u></td>
            <td style="width: 25%;">Allergies:<?php echo $pdfValue[0]['allergies'];?></td>
        </tr>
    </table>
    
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td style="width: 50%;">Patient's Authorized Representative (if applicable):<?php echo $pdfValue[0]['auth_rep'];?></td>
            <td style="width: 50%;">Authorized Representative Phone Number:<?php echo $pdfValue[0]['auth_rep_phone'];?></td>
        </tr>
    </table>
    
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <th colspan="12">Insurance Information</th>
        </tr>
        <tr>
            <td colspan="6">Primary Insurance Name:<?php echo $pdfValue[0]['primary_insurance_name'];?></td>
            <td colspan="6">Patient ID Number:<?php echo $pdfValue[0]['primary_paitent_id'];?></td>
        </tr>
        <tr>
            <td colspan="6">Secondary Insurance Name:<?php echo $pdfValue[0]['secondary_insurance_name'];?></td>
            <td colspan="6">Patient ID Number:<?php echo $pdfValue[0]['primary_paitent_id'];?></td>
        </tr>
        <tr>
            <th colspan="12">Prescriber Information</th>
        </tr>
        
        <tr>
            <td colspan="4">First Name:<?php echo $pdfValue[0]['prescriber_first_name'];?></td>
            <td colspan="4">Last Name:<?php echo $pdfValue[0]['prescriber_last_name'];?></td>
            <td colspan="6">Specialty:<?php echo $pdfValue[0]['speciality'];?></td>
        </tr>
        <tr>
            <td colspan="5">Address:<?php echo $pdfValue[0]['prescriber_address'];?></td>
            <td colspan="2">City:<?php echo $pdfValue[0]['prescriber_city'];?></td>
            <td colspan="2">State:<?php echo $pdfValue[0]['prescriber_state'];?></td>
            <td colspan="1">Zip Code:<?php echo $pdfValue[0]['prescriber_zip'];?> </td>
        </tr>
        <tr>
            <td colspan="6">Requestor (if different than prescriber):<?php echo $pdfValue[0]['requestor'];?></td>
            <td colspan="6">Office Contact Person:<?php echo $pdfValue[0]['office_contact_person'];?></td>
        </tr>
        <tr>
            <td colspan="6">NPI Number(individual):<?php echo $pdfValue[0]['doctor_NPI'];?></td>
            <td colspan="6">Phone Number:<?php echo $pdfValue[0]['prescriber_phone'];?></td>
        </tr>
        <tr>
            <td colspan="6">DEA Number (if required):<?php echo $pdfValue[0]['DEA_number'];?></td>
            <td colspan="6">Fax Number (in HIPAA compliant area):<?php echo $pdfValue[0]['prescriber_fax'];?></td>
        </tr>
        <tr>
            <td colspan="12">Email Address:<?php echo $pdfValue[0]['prescriber_email'];?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <th colspan="12">Medication / Medical and Dispensing Information</th>
        </tr>
        <tr>
            <td colspan="12">Medication Name:</td>
        </tr>
    </table>
    <div class="align-table">
        <table class="border-hide" style="width: 100%;" cellspacing="0">
            <tr>
                <td colspan="12">New Therapy <input type="checkbox" value="new_theraphy" <?php if($pdfValue[0]['theraphy_type']=='new_theraphy') echo "checked"?>> Renewal <input type="checkbox" <?php if($pdfValue[0]['theraphy_type']=='renewal') echo "checked"?>> </td>
                </td>
            </tr>
            <tr>
                <td>&nbsp; If Renewal:&nbsp;&nbsp; Date Therapy Initiated:<?php echo $pdfValue[0]['date_theraphy'];?> </td>
                <td> Duration of Therapy (specific dates):<?php echo $pdfValue[0]['duration_theraphy'];?></td>
            </tr>
            <tr>
                
            </tr>        
        </table>
    </div>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td colspan="12">How did the patient receive the medication?</td>
         </tr>
        <tr class="brd-hidden>
            <td>Paid under Insurance <input type="checkbox" value="paid_insurance" <?php if($pdfValue[0]['paitents_receive']=='paid_insurance') echo "checked"?>></td>
            <td>Name:<u><?php echo $pdfValue[0]['insurance_name'];?></u></td>
            <td>Prior Auth Number (if known):<u><?php echo $pdfValue[0]['prior_auth_name'];?></u></td>
            <td>Other <input type="checkbox" value="paitent_other" <?php if($pdfValue[0]['paitents_receive']=='paitent_other') echo "checked"?>></td>
        </tr>    
        <tr>
            <td colspan="3">Dose/Strength:</td>
            <td colspan="3">Frequency: <?php echo $pdfValue[0]['frequency'];?></td>
            <td colspan="2">Length of Therapy/#Refills: <?php echo $pdfValue[0]['length_theraphy'];?></td>
            <td colspan="3">Quantity: <?php echo $pdfValue[0]['quantity'];?></td>
        </tr>
        <tr class="brd-hidden">
            <td colspan="12">Administration:</td>
        </tr>
        <tr class="brd-hidden">
            <td>Oral/SL <input type="checkbox" value="oral_sql" <?php if($pdfValue[0]['admin_type']=='oral_sql') echo "checked";?>></td>
            <td>Topical <input type="checkbox" value="topical" <?php if($pdfValue[0]['admin_type']=='topical') echo "checked";?>></td>
            <td>Injection <input type="checkbox" value="injection" <?php if($pdfValue[0]['admin_type']=='injection') echo "checked";?>></td>
            <td>IV <input type="checkbox" value="iv" <?php if($pdfValue[0]['admin_type']=='iv') echo "checked";?>></td>
            <td>Other: <input type="checkbox" value="Other" <?php if($pdfValue[0]['admin_type']=='Other') echo "checked";?>></td>
        </tr>  
    </table>
    
    <div class="align-table">
        <table class="border-hide" style="width: 100%;" cellspacing="0">
            <tr>
                <td style="width: 25%;">Administration Location:  </td>
                <td style="width: 30%;"> Patient's Home <input type="checkbox" value="paitent_home" <?php if($pdfValue[0]['admin_location']=='paitent_home') echo "checked";?>></td>
                <td style="width: 35%;"> Long Term Care <input type="checkbox" value="long_term_care" <?php if($pdfValue[0]['admin_location']=='long_term_care') echo "checked";?>></td>
            </tr>
        </table>
        
        <table class="border-hide" style="width: 100%;" cellspacing="0">
            <tr>
                <td style="width: 25%;"> Physician's Office <input type="checkbox" value="physican_office" <?php if($pdfValue[0]['admin_location']=='physican_office') echo "checked";?>></td>
                <td style="width: 30%;"> Home Care Agency <input type="checkbox" value="home_care_agency" <?php if($pdfValue[0]['admin_location']=='home_care_agency') echo "checked";?>></td>
                <td style="width: 35%;"> Other <input type="checkbox" value="Other" <?php if($pdfValue[0]['admin_location']=='Other') echo "checked";?>> (explain):_______________________</td>
            </tr>
        </table>
        
        <table class="border-hide" style="width: 100%;" cellspacing="0">
            <tr>
                <td style="width: 25%;"> Ambulatory Infusion Center <input type="checkbox" value="ambulatory_infusing" <?php if($pdfValue[0]['admin_location']=='ambulatory_infusing') echo "checked";?>></td>
                <td style="width: 65%;"> Outpatient Hospital Care <input type="checkbox" value="outpaitent_hospital_care" <?php if($pdfValue[0]['admin_location']=='outpaitent_hospital_care') echo "checked";?>> &nbsp;&nbsp; _________________________________________</td>        
            </tr>
        </table>
        </div>
    
</div>
</div>



<div class="main">
    <div class="header">
        <h2>PRESCRIPTION DRUG PRIOR AUTHORIZATION REQUEST FORM</h2>
    </div>
    <div class="table-clr">
        <table class="header-table" style="width: 100%;" cellspacing="0">
            <tr>
                <td>Patient Name:<?php echo $pdfValue[0]['patient_first_name'] , $pdfValue[0]['patient_last_name'];?></td>
                <td>ID#:<?php echo $pdfValue[0]['primary_paitent_id'];?></td>
            </tr>
        </table>
    </div>
    <div class="instruction">
        <b>Instructions:</b> Please fill out all applicable sections on both pages completely and legibly.  Attach any additional documentation that is important for the review, e.g. chart notes or lab data, to support the prior authorization request.
    </div>
    <div class="change">
        <table class="table-1" style="width: 100%;" cellspacing="0">
            <tr>
                <th colspan="12">1. Has the patient tried any other medications for this condition? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="Y" <?php //if($pdfValue[0]['already_y']=='Y') echo "checked";?>> YES (if yes, Complete below)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="N" <?php //if($pdfValue[0]['already_y']=='N') echo "checked";?>> NO</th>
            </tr>
            <tr>
                <td><b>Medication/Therapy</b><br><?php //echo $pdfValue[0]['other_medications'];?></td>
                <td><b>Medication/Therapy</b><br><?php //echo $pdfValue[0]['durationOfTherapy'];?></td>
                <td><b>Response/Reason for Failure/Allergy</b><br><?php //echo $pdfValue[0]['response'];?></td>
            </tr>
        </table>
    </div>
    <div class="change">
        <table class="table-2" style="width: 100%;" cellspacing="0">
            <tr>
                <th>2. List Diagnoses:</th>
                <th>ICD-9/ICD-10:</th>
            </tr>
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <th colspan="10">3. <u>Required clinical information </u> - Please provide all relevant clinical information to support a prior authorization review</th>                
            </tr>
            <tr>
            <td colspan="10">
                <p>Please provide symptoms, lab results with dates and/or justification for initial or ongoing therapy or increased dose and if patient has any contraindications for the health plan/insurer preferred drug. Lab results with dates must be provided if needed to establish diagnosis, or evaluate response.Please provide any additional clinical information or comments pertinent to this request for coverage(e.g. formulary tier exceptions) or required under state and federal laws. <br><br><input type="checkbox"> Attachements</p><br><br><p></p><p></p>                
            </td>
            </tr>
        </table>
    </div>
    <div class="content-attention">
        <b>Attestation:</b> I  attest the information provided is true and accurate to the best of my knowledge. I understand that the Health Plan, insurer, Medical Group or its designees may perform a routine audit and request the medical information necessary to verify the accuracy of the information reported on this form.<p></p>
        <b>Prescriber Signature:______________________________________  &nbsp;Date: _________________________________________</b><p></p>        
    </div>
    <div class="content-notice">
        <b>Confidentiality Notice:</b>The documents accompanying this transmission contain confidential health information that is legally privileged. If you are not the intended recipient, you are hereby notified that any disclosure, copying, distribution, or action taken in reliance on the contents of these documents is strictly prohibited. If you have received this information in error, please notify the sender imediately (via return FAX) and arrange for the return or destruction of these documents.<p></p>
    </div>
    <div class="content-footer">
        <span style="margin-right: 115px;"><b>plan use only:</b></span>Date of Decision: ___________________________________</span>
        <p><input type="checkbox"> Approved  &nbsp;&nbsp; <input type="checkbox"> Approved &nbsp;&nbsp;&nbsp;&nbsp; Comments/Information Requested: ______________________________________________________</p>
        <hr>
    </div>    
</div>

