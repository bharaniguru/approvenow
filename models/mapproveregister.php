<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mApproveRegister extends CI_Model {
    //Start menu in header
    function getUserDetails(){
	$sql="SELECT * FROM ref_account_type";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function createAccount(){
	$data = array(
		      //'account_num' => $this->input->post('accountNumber') ,
		      //'title_id' => $this->input->post('titleId') ,
		      //'membership_level_num' => $this->input->post('memLevelNo') ,
		      'account_first_name' => $this->input->post('accFirstName') ,
		      //'account_middle_name' => $this->input->post('accMidName') ,
		      'account_last_name' => $this->input->post('accLastName') ,
		      //'general_status_code' => $this->input->post('genStatusCode') ,
		      'account_email_address' => $this->input->post('accEmail') ,
		      'account_organization_name' => $this->input->post('accOrgName') ,
		      //'account_web_address' => $this->input->post('webAddress') ,
		      //'external_link' => $this->input->post('externalLink') ,
		      'account_pwd' => $this->input->post('accPassword') ,
		      'account_type' => $this->input->post('accType') ,
		      //'account_id' => $this->input->post('accId') ,
		      'account_username' => $this->input->post('accUsername')
		      //'company_id' => $this->input->post('companyId') ,
		      //'account_name' => $this->input->post('accName')
		      );
	$this->db->insert('accounts_general', $data);
	return $this->db->insert_id();
    }
    function checkVerified($verificationCode){
	$sql="SELECT * FROM accounts_general where account_id='$verificationCode'";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function updateAccountStatus($verificationCode){
	$data = array(
		      'account_status' => 'Y'
		    );
	$this->db->where('account_id', $verificationCode);
	$this->db->update('accounts_general', $data);
    }
    function checkForAuthentication(){
	$accUsername = $this->input->post('accUsername');
	$accPassword = $this->input->post('accPassword');
	$sql="SELECT * FROM accounts_general where account_username='$accUsername' AND account_pwd='$accPassword'";
	//print_r($sql);
	//exit;
	return $this->db->query($sql, $return_object = TRUE)->result_array();
	///print_r($return);
	//exit;
    }
    //Dashboard Start
    // Dashboard join table start
   
    
    //Dashboard join table end
    //Already Exits Val Starts
    function alreadyExits($alreadyExits)
    {
	$sql="SELECT COUNT(account_username) FROM accounts_general where account_username='$alreadyExits'";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    //Already Exits Val Ends
    public function dashboard()
    {
	$accUsername=$this->session->userdata('accUsername');
	$accountId=$this->session->userdata('account_id');
	//echo $accountId;
	//$sql="SELECT * FROM prior_authorizaion b, provider_general p WHERE b.doctor_npi='1' AND p.NPI='1'";
	    $sql= "SELECT p.* FROM accounts_general a  JOIN locations l ON a.account_id=l.account_id join provider_general g  on l.location_id= g.location_id  join prior_authorizaion p on g.NPI=p.doctor_NPI where a.account_id='$accountId'";
	    $mainData= $this->db->query($sql)->result_array();
	    
	    $result['table'] =$mainData;
	    //print_r($mainData);
	    //exit;
	    
	     $sql="SELECT * from ref_reason_code";
	     $return = $this->db->query($sql)->result_array();
	
    
    
	    $sql="select * from prior_authorizaion where doctor_NPI in (select NPI from provider_general where location_id in (select location_id from locations where account_id in (select account_id from accounts_general where account_id='$accountId')))";
	    $mainData= $this->db->query($sql, $return_object = TRUE)->result_array();
	    
	 
	    
	    $sql= "SELECT rr.* FROM accounts_general a  JOIN locations l ON a.account_id=l.account_id join provider_general g  on l.location_id= g.location_id  join prior_authorizaion p on g.NPI=p.doctor_NPI join ref_reason_code rr on p.status_id=rr.reason_code_id where a.account_id='$accountId' and rr.description='Approved' ";
	    $result = $this->db->query($sql)->result_array();
	    $result["approved"]=count($result);
	    
	    $sql= "SELECT rr.* FROM accounts_general a  JOIN locations l ON a.account_id=l.account_id join provider_general g  on l.location_id= g.location_id  join prior_authorizaion p on g.NPI=p.doctor_NPI join ref_reason_code rr on p.status_id=rr.reason_code_id where a.account_id='$accountId' and rr.description='Rejected' ";
	    $result1 = $this->db->query($sql)->result_array();
	    $result["rejected"]=count($result1);
	    
	    $sql= "SELECT rr.* FROM accounts_general a  JOIN locations l ON a.account_id=l.account_id join provider_general g  on l.location_id= g.location_id  join prior_authorizaion p on g.NPI=p.doctor_NPI join ref_reason_code rr on p.status_id=rr.reason_code_id where a.account_id='$accountId' and rr.description='In Progress' ";
	    $result2 = $this->db->query($sql)->result_array();
	    $result["pending"]=count($result2);
	    //  print_r(count($result2));
	    //exit;
	    
	   
	  
	
        
	//print_r($query);
	//exit;
	//$query['old']= $query['old1'][0]['count(prior_authorizaion_id)']+ $query['old2'][0]['count(prior_authorizaion_id)']  ;
	
	return $result;
}
     function getTableDetails($accountId)
    {
	//print_r($this->session->all_userdata());
	//exit;
	//$sql="SELECT p.* FROM accounts_general a  JOIN locations l ON a.account_id=l.account_id join provider_general g  on l.location_id= g.location_id  join prior_authorizaion p on g.NPI=p.doctor_NPI where a.account_id='$accountId'";
	$sql="select * from prior_authorizaion where doctor_NPI in (select NPI from provider_general where location_id in (select location_id from locations where account_id in (select account_id from accounts_general where account_id='$accountId')))";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
     function getProviderTableDetails()
    {
	$sql="SELECT * FROM provider_general";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
     function getRejectDetails()
    {
	 $sql="SELECT * FROM PA_reject_reason";
	
	return $this->db->query($sql)->result_array();
    }
     function statusDesc()
    {
	 $sql="SELECT * from ref_reason_code";
	
	return $this->db->query($sql)->result_array();
	
    }
    
   public function paitentDetailsAjax()
	{
	    $priorId=$_POST["prior_authorizaion_id"];
	    $sql="SELECT * FROM  prior_authorizaion where prior_authorizaion_id='$priorId'";
	    return $this->db->query($sql, $return_object = TRUE)->result_array();
	}
    //Dashboard End
    function addLocation(){
	//$sessionData = $this->session->userdata('account_id');
	$data = array(
		      'location_name' => $this->input->post('location_name') ,
		      //'phone_area_code' => $this->input->post('phoneAreaCode') ,
		      'phone_number' => $this->input->post('phoneNumber') ,
		      'phone_ext' => $this->input->post('phoneExtension') ,
		      //'fax_area_code' => $this->input->post('faxAreaCode') ,
		      'fax_number' => $this->input->post('faxNumber') ,
		      'address' => $this->input->post('address') ,
		      'city' => $this->input->post('city') ,
		      'state' => $this->input->post('state') ,
		      'zip' => $this->input->post('zipCode') ,
		      'zip_four' => $this->input->post('zipFour') ,
		      'email_address' => $this->input->post('emailAddress') ,
		      'web_address' => $this->input->post('webAddress') ,
		      //'product_name' => $this->input->post('productName') ,
		      //'product_version' => $this->input->post('productVersion'),
		      //'product_build' => $this->input->post('prodBuild') ,
		      //'product_build_date' => $this->input->post('prodBuildDate') ,
		      'NPI' => $this->input->post('NPI') ,
		      'account_id' => $this->session->userdata('account_id')
		    );
	$this->db->insert('locations', $data);
	
    }
    function updateLocation(){
	$data = array(
		     'location_name' => $this->input->post('location_name') ,
		      'phone_number' => $this->input->post('phoneNumber') ,
		      'phone_ext' => $this->input->post('phoneExtension') ,
		      //'fax_area_code' => $this->input->post('faxAreaCode') ,
		      'fax_number' => $this->input->post('faxNumber') ,
		      'address' => $this->input->post('address') ,
		      'city' => $this->input->post('city') ,
		      'state' => $this->input->post('state') ,
		      'zip' => $this->input->post('zipCode') ,
		      'zip_four' => $this->input->post('zipFour') ,
		      'email_address' => $this->input->post('emailAddress') ,
		      'web_address' => $this->input->post('webAddress') ,
		      //'product_name' => $this->input->post('productName') ,
		      //'product_version' => $this->input->post('productVersion'),
		      //'product_build' => $this->input->post('prodBuild') ,
		      //'product_build_date' => $this->input->post('prodBuildDate') ,
		      'NPI' => $this->input->post('NPI'),
		      'account_id' => $this->session->userdata('account_id')
		    );
	$this->db->where('location_id', $this->input->post('locationId'));
	$this->db->update('locations', $data);
    }
    function getLocationDetails($locationId){
	$sql="SELECT * FROM locations where location_id='$locationId'";
	
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function deleteLocation($locationId){
	
	$this->db->delete('locations', array('location_id' => $locationId));
	
        
    }
    //2. GENERAL PROVIDER STARTS
    //DROP DOWN STARTS
    function getLocationID(){
	$sql="SELECT * FROM locations";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    //DROP DOWN ENDS
     function getProviderDetails($providerId){
	$sql="SELECT * FROM provider_general where provider_id='$providerId'";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function addProvider(){
	$data = array(
		      'first_name' => $this->input->post('firstName') ,
		      'last_name' => $this->input->post('lastName') ,
		      'phone' => $this->input->post('phoneNumber') ,
		      'provider_type_id' => $this->input->post('provider_type_id') ,
		      'NPI' => $this->input->post('NPI') ,
		      'DEA_num' => $this->input->post('deaNumber') ,
		      'location_id' => $this->input->post('locationID') 
		      
		    );
	$this->db->insert('provider_general', $data);
	
    }
    function updateprovider(){
	$data = array(
		      'first_name' => $this->input->post('firstName') ,
		      'last_name' => $this->input->post('lastName') ,
		      'phone' => $this->input->post('phoneNumber') ,
		      'provider_type_id' => $this->input->post('provider_type_id') ,
		      'NPI' => $this->input->post('NPI') ,
		      'DEA_num' => $this->input->post('deaNumber') ,
		      'location_id' => $this->input->post('locationID') 
		    );
	$this->db->where('provider_id', $this->input->post('providerId'));
	$this->db->update('provider_general', $data);
	//print_r($data);
	//exit;
    }
    function deleteProvider($providerId){
	$this->db->delete('provider_general', array('provider_id' => $providerId));
    }
    
//    public function getajaxLocations()
//    {
//	$priorId=$_POST["location_id"];
//	$sql="SELECT * FROM  locations where location_id='$locationId'";
//	return $this->db->query($sql, $return_object = TRUE)->result_array();
//    }
//    
    function getAjaxLocations($location_id)
    {
	$query=$this->db->query("SELECT * FROM provider_general WHERE location_id='$location_id'");
	return $query->result_array();
    }
    //3.PRIOR AUTH STARTS
    function getPriorAuthDetails($prior_authorizaion_id){
	$sql="SELECT * FROM prior_authorizaion where prior_authorizaion_id='$prior_authorizaion_id'";
	
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function getReasonRef($id)
    {
	$sql="SELECT * FROM PA_reject_reason WHERE prior_authorizaion_id='$id'";
	return $this->db->query($sql)->result_array();
    }
    function getRejectReason($prior_authorizaion_id){
	$sql="SELECT * FROM PA_reject_reason where prior_authorizaion_id='$prior_authorizaion_id'";
	return $this->db->query($sql)->result_array();
    }
    function addPriorAuthReason(){
	$data = array(
		      'PA_reject_reason' => $this->input->post('PA_reject_reason'),
		      'Notes' => $this->input->post('Notes'),
		      'status' => 'Pending',
		      'prior_authorizaion_id' => $this->input->post('priorAuthIdForReason')
		    );
	return $this->db->insert('PA_reject_reason', $data);
    }
    function updatePriorAuthReasonStatus(){
	if($_POST['action']=="pending"){
	    for($i=0;$i<count($_POST['rejectReasonId']);$i++){
		$data = array(
			      'status' =>'Pending'
			    );
		$this->db->where('PA_reject_reason_id', $_POST['rejectReasonId'][$i]);
		$this->db->update('PA_reject_reason', $data);
	    }
	}elseif($_POST['action']=="completed"){
	    for($i=0;$i<count($_POST['rejectReasonId']);$i++){
		$data = array(
			      'status' =>'Completed'
			    );
		$this->db->where('PA_reject_reason_id', $_POST['rejectReasonId'][$i]);
		$this->db->update('PA_reject_reason', $data);
	    }
	}elseif($_POST['action']=="delete"){
	    for($i=0;$i<count($_POST['rejectReasonId']);$i++){
		$this->db->delete('PA_reject_reason', array('PA_reject_reason_id' => $_POST['rejectReasonId'][$i])); 
	    }
	}
    }
    //State Details From States Table Starts
    public function getStateDetails()
    {
	return $this->db->get('states')->result_array();
    }
    function getInsuranceCompDetails()
    {
	return $this->db->get('insurance_company')->result_array();
    }
    
    //State Details From States Table Ends 
    function addPriorAuth($priorAuthStatus){
	$sessionData = $this->session->userdata('account_id');
	$config['upload_path'] = 'uploads/attachment/';
	$config['allowed_types'] = 'gif|jpg|png|html|doc|txt|docx|pdf';
	$config['max_size']  = '100000';
	$config['max_width'] = '10240';
	$config['max_height'] = '7680';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	$this->upload->do_upload('attachments');
	$file_data=$this->upload->data();
	$file_name=$file_data['file_name'];
	$file_size=$file_data['file_size'];
	//$file_size=$file_size/1024;//for KB
	$attachmentPath =base_url().$config['upload_path'] . $file_name;
	$data = array(
		      'patient_first_name' => $this->input->post('patient_first_name'),
		      'patient_last_name' => $this->input->post('patient_last_name'),
		      'patient_dob' => $this->input->post('patient_dob'),
		      'patient_address' => $this->input->post('patient_address') ,
		      'patient_city' => $this->input->post('patient_city') ,
		      'patient_state' => $this->input->post('patient_state') ,
		      'patient_zip' => $this->input->post('patient_zip'),
		      'patient_contact_no' => $this->input->post('patient_contact_number') ,
		      'patient_gender' => $this->input->post('patient_gender'),
		      'patient_weight' => $this->input->post('weight'),
		      'patient_height' => $this->input->post('height'),
		      'uom_weight' => $this->input->post('uom_weight'),
		      'uom_height' => $this->input->post('uom_height'),
		      'allergies' => $this->input->post('allergies'),
		      'auth_rep' => $this->input->post('auth_rep') ,	
		      'auth_rep_phone' =>$this->input->post('auth_rep_phone'),
		      'patient_id' =>$this->input->post('patient_id'),
		      'pharmacy_name' =>$this->input->post('pharmacy_name'),
		      'pharmacy_NPI' => $this->input->post('pharamacy_NPI'),
		      'pharmacy_contact_number' => $this->input->post('pharmacy_contact_number'),
		      'pharmacy_city' => $this->input->post('pharmacy_city'),
		      'pharmacy_state' => $this->input->post('pharmacy_state'),
		      'pharmacy_zip' => $this->input->post('pharmacy_zip'),
		      'theraphy_type' =>$this->input->post('theraphy_type'),
		      'date_theraphy' => $this->input->post('date_theraphy'),
		      'duration_theraphy' => $this->input->post('duration_theraphy'),
		      'quantity' => $this->input->post('quantity'),
		      'frequency' => $this->input->post('frequency'),
		      'length_theraphy' => $this->input->post('length_theraphy'),
		      'num_refills' => $this->input->post('num_refills'),
		      'admin_type' => $this->input->post('admin_type'),
		      'admin_location' => $this->input->post('admin_location'),
		      'paitents_receive' => $this->input->post('paitents_receive'),
		      'insurance_name' =>$this->input->post('insurance_name'),
		      'prior_auth_name' => $this->input->post('prior_auth_name'),
		      'explanations' => $this->input->post('explanations'),
		      'attachments' => $attachmentPath,
		      'prescriber_first_name' => $this->input->post('prescriber_first_name'),
		      'prescriber_last_name' => $this->input->post('prescriber_last_name'),
		      'speciality' => $this->input->post('speciality'),
		      'prescriber_NPI' => $this->input->post('prescriber_NPI'),
		      'DEA_number' =>$this->input->post('DEA_number'),
		      'prescriber_address' =>$this->input->post('prescriber_address'),
		      'prescriber_city' => $this->input->post('prescriber_city'),
		      'prescriber_state' => $this->input->post('prescriber_state'),
		      'prescriber_zip' => $this->input->post('prescriber_zip') ,
		      'prescriber_phone' =>$this->input->post('prescriber_phone'),
		      'prescriber_fax' =>$this->input->post('prescriber_fax'),
		      'prescriber_email' => $this->input->post('prescriber_email'),
		      'office_contact_person' => $this->input->post('office_contact_person'),
		      'requestor' => $this->input->post('requestor'),
		      'primary_insurance_name' => $this->input->post('primary_insurance_name'),
		      'primary_insurance_fax' => $this->input->post('primary_insurance_fax'),
		      'primary_paitent_id' => $this->input->post('primary_paitent_id'),
		      'secondary_insurance_name' => $this->input->post('secondary_insurance_name'),
		      'secondary_paitent_id' => $this->input->post('secondary_paitent_id'),
		      'diagnosis_code' => $this->input->post('diagnosis_code'),
		      'add_diagonis' => $this->input->post('add_diagonis'),
		      'other_medications_yn' => $this->input->post('other_medications_yn'),
		      'other_medications_name' => $this->input->post('other_medications_name'),
		      'other_medications_duration' => $this->input->post('other_medications_duration'),
		      'other_medications_reason' => $this->input->post('other_medications_reason'),
		      'diagonis_current_drugs' => $this->input->post('diagonis_current_drugs'),
		      'diagonis_current_clinical_info' => $this->input->post('diagonis_current_clinical_info'),
		      'attachment_yn' =>$this->input->post('attachment_yn'),
		      'prior_auth_status' => $priorAuthStatus
		      );
	//echo "<pre>";
	//print_r($data);
	//echo "</pre>";
	//exit;
	$this->db->insert('prior_authorizaion', $data);
	return $this->db->insert_id();
	//$table=$this->db->get('prior_authorizaion')->result_array();
    }
    function UpdatePriorAuth($priorAuthId,$priorAuthStatus){
	$sessionData = $this->session->userdata('account_id');
	$config['upload_path'] = 'uploads/attachment/';
	$config['allowed_types'] = 'gif|jpg|png|html|doc|txt|docx|pdf';
	$config['max_size']  = '100000';
	$config['max_width'] = '10240';
	$config['max_height'] = '7680';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	if($_FILES['attachments']['name']){
	    $this->upload->do_upload('attachments');
	    $file_data=$this->upload->data();
	    $file_name=$file_data['file_name'];
	    $file_size=$file_data['file_size'];
	    //$file_size=$file_size/1024;//for KB
	    $attachmentPath =base_url().$config['upload_path'] . $file_name;
	}else{
	    $attachmentPath= $this->input->post('existing_attachments');
	}
	$data = array(
		      'patient_first_name' => $this->input->post('patient_first_name'),
		      'patient_last_name' => $this->input->post('patient_last_name'),
		      'patient_dob' => $this->input->post('patient_dob'),
		      'patient_address' => $this->input->post('patient_address') ,
		      'patient_city' => $this->input->post('patient_city') ,
		      'patient_state' => $this->input->post('patient_state') ,
		      'patient_zip' => $this->input->post('patient_zip'),
		      'patient_contact_no' => $this->input->post('patient_contact_number') ,
		      'patient_gender' => $this->input->post('patient_gender'),
		      'patient_weight' => $this->input->post('weight'),
		      'patient_height' => $this->input->post('height'),
		      'uom_weight' => $this->input->post('uom_weight'),
		      'uom_height' => $this->input->post('uom_height'),
		      'allergies' => $this->input->post('allergies'),
		      'auth_rep' => $this->input->post('auth_rep') ,	
		      'auth_rep_phone' =>$this->input->post('auth_rep_phone'),
		      'patient_id' =>$this->input->post('patient_id'),
		      'pharmacy_name' =>$this->input->post('pharmacy_name'),
		      'pharmacy_NPI' => $this->input->post('pharamacy_NPI'),
		      'pharmacy_contact_number' => $this->input->post('pharmacy_contact_number'),
		      'pharmacy_city' => $this->input->post('pharmacy_city'),
		      'pharmacy_state' => $this->input->post('pharmacy_state'),
		      'pharmacy_zip' => $this->input->post('pharmacy_zip'),
		      'theraphy_type' =>$this->input->post('theraphy_type'),
		      'date_theraphy' => $this->input->post('date_theraphy'),
		      'duration_theraphy' => $this->input->post('duration_theraphy'),
		      'quantity' => $this->input->post('quantity'),
		      'frequency' => $this->input->post('frequency'),
		      'length_theraphy' => $this->input->post('length_theraphy'),
		      'num_refills' => $this->input->post('num_refills'),
		      'admin_type' => $this->input->post('admin_type'),
		      'admin_location' => $this->input->post('admin_location'),
		      'paitents_receive' => $this->input->post('paitents_receive'),
		      'insurance_name' =>$this->input->post('insurance_name'),
		      'prior_auth_name' => $this->input->post('prior_auth_name'),
		      'explanations' => $this->input->post('explanations'),
		      'attachments' => $attachmentPath,
		      'prescriber_first_name' => $this->input->post('prescriber_first_name'),
		      'prescriber_last_name' => $this->input->post('prescriber_last_name'),
		      'speciality' => $this->input->post('speciality'),
		      'prescriber_NPI' => $this->input->post('prescriber_NPI'),
		      'DEA_number' =>$this->input->post('DEA_number'),
		      'prescriber_address' =>$this->input->post('prescriber_address'),
		      'prescriber_city' => $this->input->post('prescriber_city'),
		      'prescriber_state' => $this->input->post('prescriber_state'),
		      'prescriber_zip' => $this->input->post('prescriber_zip') ,
		      'prescriber_phone' =>$this->input->post('prescriber_phone'),
		      'prescriber_fax' =>$this->input->post('prescriber_fax'),
		      'prescriber_email' => $this->input->post('prescriber_email'),
		      'office_contact_person' => $this->input->post('office_contact_person'),
		      'requestor' => $this->input->post('requestor'),
		      'primary_insurance_name' => $this->input->post('primary_insurance_name'),
		      'primary_insurance_fax' => $this->input->post('primary_insurance_fax'),
		      'primary_paitent_id' => $this->input->post('primary_paitent_id'),
		      'secondary_insurance_name' => $this->input->post('secondary_insurance_name'),
		      'secondary_paitent_id' => $this->input->post('secondary_paitent_id'),
		      'diagnosis_code' => $this->input->post('diagnosis_code'),
		      'add_diagonis' => $this->input->post('add_diagonis'),
		      'other_medications_yn' => $this->input->post('other_medications_yn'),
		      'other_medications_name' => $this->input->post('other_medications_name'),
		      'other_medications_duration' => $this->input->post('other_medications_duration'),
		      'other_medications_reason' => $this->input->post('other_medications_reason'),
		      'diagonis_current_drugs' => $this->input->post('diagonis_current_drugs'),
		      'diagonis_current_clinical_info' => $this->input->post('diagonis_current_clinical_info'),
		      'attachment_yn' =>$this->input->post('attachment_yn'),
		      'prior_auth_status' => $priorAuthStatus
		      );
	$this->db->where('prior_authorizaion_id', $priorAuthId);
	$this->db->update('prior_authorizaion', $data);
	//$table=$this->db->get('prior_authorizaion')->result_array();
    }
    
    //PRIOR AUTH ENDS
    
    
   
	    

}

		