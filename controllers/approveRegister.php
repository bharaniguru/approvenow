<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class approveRegister extends CI_Controller {
    function approveRegister(){
	parent::__construct();
	$this->load->model('mApproveRegister');
	$this->load->library('session');
	$this->load->library('table');
	$this->load->library('Datatables');
	$this->load->helper('datatables_helper');
    }
    
    //Authentication Controllers Begin
    function index(){
	$sessionData = $this->session->userdata('accUsername');
	if($sessionData!=""){
	    redirect(site_url("approveRegister/dashboard"));
	}
	$data['errorMsg'] = '';
	if ($this->input->post('proceed')=='Yes'){
	    $result = $this->mApproveRegister->checkForAuthentication();
	    if($result){
		$this->session->set_userdata('accUsername',$result[0]['account_username']);
		redirect(site_url("approveRegister/dashboard"));
	    }else{
		$data['errorMsg'] = 'Invalid User Id and Password Please check it';
	    }
	}
	$this -> load -> view('index',$data);
	
    }
    
    function createAccount(){
	if ($this->input->post('proceed')=='Yes'){
	    $this->mApproveRegister->createAccount();
	}
	$this -> load -> view('createAccount');
    }
    
    public function Logout(){
	$this->session->unset_userdata('accUsername');
	unset($this->session->userdata);
	redirect(site_url(),'refresh');
    }
    
    function dashboard(){
	$sessionData = $this->session->userdata('accUsername');
	if($sessionData!=""){
	    $this -> load -> view('header');
	    $this -> load -> view('application/dashboard');
	    $this -> load -> view('footer');
	}else{
	    redirect(site_url());
	}
    }
    function locationMaster(){
	$sessionData = $this->session->userdata('accUsername');
	if($sessionData!=""){
	    $this -> load -> view('header');
	    $this -> load -> view('application/locationMaster');
	    $this -> load -> view('footer');
	}
	else{
	    redirect(site_url());
	}
    }
    function locationMasterTable(){
        $this->datatables->select('location_id,company_name,phone_area_code,phone_number,phone_ext,fax_area_code,fax_number,address,city,state,zip,zip_four,email_address,web_address,product_name,product_version,product_build,product_build_date,NPI,account_num')
	->from('locations');
	echo $this->datatables->generate();
    }
    function getLocationDetails(){
	header('Content-Type: application/json');
	$locationId = $_POST['locationId'];
	$result = $this->mApproveRegister->getLocationDetails($locationId);
	echo json_encode($result);
    }
    function locationDetailsOperation(){
	if($this->input->post('proceed')=='Add'){
	    $this->mApproveRegister->addLocation();
	    $query['status']="Success";
	    echo json_encode($query);
	    
	}elseif($this->input->post('proceed')=='Edit'){
	    $this->mApproveRegister->updateLocation();
	    $query['status']="Success";
	    echo json_encode($query);
	}
    }
    function deleteLocation(){
	header('Content-Type: application/json');
	$locationId = $_POST['locationId'];
	$this->mApproveRegister->deleteLocation($locationId);
	$query['status']="Success";
	echo json_encode($query);
    }
    //2.GENERAL PROVIDER STARTS
    function generalProvider(){
	$sessionData = $this->session->userdata('accUsername');
	
	if($sessionData!=""){
	    $data['locationDetails']= $this->mApproveRegister->getLocationID();
	    $this -> load -> view('header');
	    $this -> load -> view('application/generalProvider',$data);
	    $this -> load -> view('footer');
	}
	else{
	    redirect(site_url());
	}
    }
   
    function generalProviderTable(){
        $this->datatables->select('provider_id,first_name,last_name,provider_type_id,phone,NPI,DEA_num,location_id')
	->from('provider_general');
	echo $this->datatables->generate();
    }
      function getProviderDetails(){
	header('Content-Type: application/json');
	$providerId = $_POST['provider_id'];
	$result = $this->mApproveRegister->getProviderDetails($providerId);
	echo json_encode($result);
    }
    function generalProviderOperation(){
	if($this->input->post('proceed')=='Add'){
	    $this->mApproveRegister->addProvider();
	    $query['status']="Success";
	    echo json_encode($query);
	    
	}elseif($this->input->post('proceed')=='Edit'){
	    
	    $this->mApproveRegister->updateprovider();
	    $query['status']="Success";
	    echo json_encode($query);
	}
    }
    function deleteProvider(){
	header('Content-Type: application/json');
	$locationId = $_POST['provider_id'];
	$this->mApproveRegister->deleteprovider($providerId);
	$query['status']="Success";
	echo json_encode($query);
    }
    
    
    
    
    
    
    
    
    
    
    
    
 //********************************************************END************************************************************************   
    public function CheckingData(){
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');
	$user_id=$this->input->post('user_id');
	$date = date('d-M-y');
	$sql="SELECT COUNT(USER_ID) FROM APPS_USER where USER_ID='$user_id' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(USER_ID)']>0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    public function CheckingUser(){
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');
	$user_id=$this->input->post('user_id');
	$password=md5($this->security->xss_clean($this->input->post('password')));
	$date = date('d-M-y');
	$sql="SELECT COUNT(USER_ID) FROM APPS_USER where USER_ID='$user_id' AND USER_PASSWD='$password' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(USER_ID)']==1){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    public function CheckingUserMail(){
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');
	$email=$this->input->post('forgetUIdEmail');
	$date = date('d-M-y');
	$sql="SELECT COUNT(USER_ID) FROM APPS_USER where USER_EMAIL='$email' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(USER_ID)']>0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    public function forgotUserId()
    {
	$email=$this->input->post('forgetUIdEmail');
	$date = date('d-M-y');
	$sql="SELECT USER_ID FROM APPS_USER where USER_EMAIL='$email' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
	$query = $this->db->query($sql)->result_array();
	
	if(count($query[0]['USER_ID'])==1)
	{
	    $branName=$query[0]['USER_ID'];
	    $url= base_url();
	    
	    $body="<html><head><title></title>
		    </head>
		    <body>
			<center>
			    <h2 style='text-align:center'>Welcome to Spine</h2>
			    <b><img  style='text-align:center' data-id='login-cover-image' src='http://www.sedarspine.com/assets/img/mantis_logo.jpg'></b>
			
			<h4>Your Account Id is:</h4>
			<p>ID:".$branName."</p>
			<h4>Click thhis link for Login.</h4>
			<p>".$url."</p>
			</center>
		    </body>
		</html>";
	    $subject="Your Spine Account";
	}else
	{
	  $body="<html>
		    <head>
			<title>Welcome to Spine</title>
		    </head>
		    <body>
			<center>
			    <h2 style='text-align:center'>Welcome to Spine</h2>
			    <b><img  style='text-align:center' data-id='login-cover-image' src='http://www.sedarspine.com/assets/img/mantis_logo.jpg'></b>
			</center>
			<h4>Sorry Your Spine Account is Expired:</h4>
		    </body>
		</html>";
	    $subject="Your Spine Account was Expired";
	}
	
	
	
	$this->email->set_newline("\r\n");
	$this->email->from('ppkk036@gmail.com'); // change it to yours
	$this->email->to($email);// change it to yours
	$this->email->subject($subject);
	$this->email->message($body);
	if($this->email->send()){
	//echo 'Email Sent.';
	}else{
	//echo 'Email Not Sent.';
	}
	
	redirect(site_url(),'refresh');
    }
    
    public function forgotPassword()
    {
	$email=$this->input->post('forgetPassEmail');
	$date = date('d-M-y');
	$sql="SELECT USER_ID FROM APPS_USER where USER_EMAIL='$email' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
	$query = $this->db->query($sql)->result_array();
	
	if(count($query[0]['USER_ID'])==1)
	{
	    $branName=$query[0]['USER_ID'];
	    $url= base_url();
	    
	    $body="<html><head><title></title>
		    </head>
		    <body>
			<center>
			    <h2 style='text-align:center'>Welcome to Spine</h2>
			    <b><img  style='text-align:center' data-id='login-cover-image' src='http://www.sedarspine.com/assets/img/mantis_logo.jpg'></b>
			
			<h4>Your Account Id is:</h4>
			<p>ID:".$branName."</p>
			<h4>Click thhis link for Login.</h4>
			<p>".$url."</p>
			</center>
		    </body>
		</html>";
	    $subject="Your Spine Account";
	}else
	{
	  $body="<html>
		    <head>
			<title>Welcome to Spine</title>
		    </head>
		    <body>
			<center>
			    <h2 style='text-align:center'>Welcome to Spine</h2>
			    <b><img  style='text-align:center' data-id='login-cover-image' src='http://www.sedarspine.com/assets/img/mantis_logo.jpg'></b>
			</center>
			<h4>Sorry Your Spine Account is Expired:</h4>
		    </body>
		</html>";
	    $subject="Your Spine Account was Expired";
	}
	
	
	
	$this->email->set_newline("\r\n");
	$this->email->from('ppkk036@gmail.com'); // change it to yours
	$this->email->to($email);// change it to yours
	$this->email->subject($subject);
	$this->email->message($body);
	if($this->email->send()){
	//echo 'Email Sent.';
	}else{
	//echo 'Email Not Sent.';
	}
	
	redirect(site_url(),'refresh');
    }
    
    
    function Country_View()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!=""){
	   
	    $this -> load -> view('header');
	    $this -> load -> view('apps/Country_View');
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    function countryTable()
    {
        $this->datatables->select('CN_CODE,CN_DESC,CN_LATITUDE,CN_LONGITUDE,CN_ACTIVE_YN,CN_CR_UID,CN_CR_DT,CN_UPD_UID,CN_UPD_DT')
        
        ->from('APPS_COUNTRY');
		
		
        
        echo $this->datatables->generate();
    }
    
    function AjaxCheckCountryCode()
    {
	header('Content-Type: application/json');
	$cn_code=$this->input->post('cn_code');
	$sql="SELECT COUNT(CN_CODE) FROM APPS_COUNTRY WHERE CN_CODE='$cn_code' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(CN_CODE)']==0)
	{
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
	
    }
    
    
    function Country_Add()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if ($this->input->post('proceed')=='Save')
	    {
		$result= $this->AppsMod->addCountry();
		if($result['return_status']==0){
		    $this->session->set_flashdata('status','A  New Record is Added Successfully');
		    redirect("AppsCtr/Country_View");
		}else{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $data['result']= $this->AppsMod->ViewCountry();
	    $this -> load -> view('header');
	    $this -> load -> view('apps/Country_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function Country_Edit($id)
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if ($this->input->post('save')=='Update')
	    {
		$result= $this->AppsMod->update_country();
		if($result['return_status']==0){
		    $this->session->set_flashdata('status','A Record is Updated Successfully');
		    redirect("AppsCtr/Country_View");
		}else{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $data['country']=$this->AppsMod->fetchCountry($id);
	    $this -> load -> view('header');
	    $this -> load -> view('apps/Country_Edit',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
	
    }
    function Country_Delete()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	$id=$_POST['id'];
	//echo $id; exit();
	
	    $result = $this->AppsMod->DeleteCountry($id);
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
	
    }
    //Country Controllers End
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  COUNTRY MASTER END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  STATE MASTER START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%       

    
    //State Controllers Begin
    //Author: Vinod
    //functionality By: Gobi. C
    //Created on: 04/03/15
    //Modified on: 26/03/15
    function State_View()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!=""){
	    $this -> load -> view('header');
	    //$ViewState['result']= $this->AppsMod->ViewState();
	    $this -> load -> view('apps/State_View');
	}
	else{
	     redirect(site_url('AppsCtr'));
	}
    }
    function stateTable()
    {
        $this->datatables->select('ST_CODE,ST_DESC,ST_LATITUDE,ST_LONGITUDE,CN_DESC,ST_ACTIVE_YN,ST_CR_UID,ST_CR_DT,ST_UPD_UID,ST_UPD_DT')
        
        ->from('APPS_STATE')
	->join('APPS_COUNTRY','APPS_STATE.ST_CN_CODE = APPS_COUNTRY.CN_CODE','left');
	echo $this->datatables->generate();
    }
    function AjaxCheckStateCode()
    {
	header('Content-Type: application/json');
	$st_code=$this->input->post('st_code');
	$sql="SELECT COUNT(ST_CODE) FROM APPS_STATE WHERE ST_CODE='$st_code' ";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(ST_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
	
    }
    function State_Add()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if ($this->input->post('proceed')=='Save')
	    {
		$result= $this->AppsMod->AddState();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A  New Record is Added Successfully');
		    redirect("AppsCtr/State_View");
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $data['Country']= $this->AppsMod->GetCountry();
	    $this -> load -> view('header');
	    $this -> load -> view('apps/State_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
    }
    function State_Edit($id)
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if ($this->input->post('Update')=='Update')
	    {
	       $result = $this->AppsMod->UpdateState($id);
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A   Record is Updated Successfully');
		    redirect("AppsCtr/State_View");
		}else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $data['State']=$this->AppsMod->EditState($id);
	    $data['Country']= $this->AppsMod->GetCountry();
	    $this -> load -> view('header');
	    $this -> load -> view('apps/State_Edit',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    function State_Delete()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $id=$_POST['id'];
	    //echo $id; exit();
	    $result=$this->AppsMod->DeleteState($id);
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    //State Controllers END
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  STATE MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CITY MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
    //Author: Gobi .C
    //Functionality By: Gobi. C
    //Created on: 04/03/15
    //Modified on: 24/03/15
    //City Controller Start
    
    function City_View()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    //$result=$this->AppsMod->ViewCity();
	    //$data['city']=$result;
	    
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/City_View');
	}
	else
	{
	    redirect(site_url('Apps'));
	}
    
    }
    
    function cityTable()
    {
        $this->datatables->select('CT_CODE,CT_DESC,CT_LATITUDE,CT_LONGITUDE,CN_DESC,CT_ST_CODE,CT_ACTIVE_YN,CT_CR_UID,CT_CR_DT,CT_UPD_UID,CT_UPD_DT')
        
        ->from('APPS_CITY')
	->join('APPS_COUNTRY','APPS_CITY.CT_CN_CODE = APPS_COUNTRY.CN_CODE','left');
	
	echo $this->datatables->generate();
    }
    
    
    function AjaxCheckCityCode()
    {
	header('Content-Type: application/json');
	$ct_code=$this->input->post('ct_code');
	$sql="SELECT COUNT(CT_CODE) FROM APPS_CITY WHERE CT_CODE='$ct_code'   ";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(CT_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    
    function City_Add()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    if ($this->input->post('add')=='Save')
	    {
		
		$result= $this->AppsMod->addCity();
		
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A  New Record is Added Successfully');
		    redirect(site_url("AppsCtr/City_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $result= $this->AppsMod->GetCountry();
	    $data['country']=$result;
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/City_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    public function ajaxcity()
    {
	$country_code=mysql_real_escape_string($_POST["cn_code"]);
	$sql="SELECT * FROM APPS_STATE where ST_CN_CODE='$country_code' and ST_ACTIVE_YN='Y' ORDER BY ST_DESC ASC ";
	$query = $this->db->query($sql, $return_object = TRUE)->result_array();
	?>
	<select  name="ct_st_code" id="ct_st_code" class="form-control selectpicker"  data-live-search="true" data-style="btn-white">
	<option selected disabled value="0" > Select</option>
	<?php
	foreach($query as $row)
	{
	    ?>
	    <option value="<?php echo $row['ST_CODE'] ?>"><?php echo $row['ST_DESC']?></option>
	
	    <?php
	}
	?>
	</select>
	<?php 
    }
    
    public function ajaxcitySelected()
    {
	$country_code=mysql_real_escape_string($_POST["cn_code"]);
	$city_code=mysql_real_escape_string($_POST["ct_code"]);
	
	$sql="SELECT * FROM APPS_CITY where CT_CODE='$city_code' ";
	$data= $this->db->query($sql, $return_object = TRUE)->result_array();
	
	$sql="SELECT * FROM APPS_STATE where ST_CN_CODE='$country_code' and ST_ACTIVE_YN='Y' ORDER BY ST_DESC ASC ";
	$query = $this->db->query($sql, $return_object = TRUE)->result_array();
	?>
	<option selected disabled > Select</option>
	<?php
	foreach($query as $row)
	{
	    ?>
	    <option value="<?php echo $row['ST_CODE'] ?>" <?php if($data[0]['CT_ST_CODE']==$row['ST_CODE'])echo "selected"?>><?php echo $row['ST_DESC']?></option> 
	    <?php
	}
    }
	
    function City_Edit($code)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $result_city= $this->AppsMod->GetCity($code);
	    $data['city']=$result_city;
	    $result_city_area= $this->AppsMod->GetCityArea($code);
	    $data['cityarea']=$result_city_area;
	    $result= $this->AppsMod->ViewCountry();
	    $data['country']=$result;
	    $result_state= $this->AppsMod->ViewState();
	    $data['state']=$result_state;
	   
	    if ($this->input->post('proceed')=='Update')
	    {
		$result= $this->AppsMod->UpdateCity();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A Record is Updated Successfully');
		    redirect(site_url("AppsCtr/City_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/City_Edit',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function City_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $id=$_POST['id'];
	    $result=$this->AppsMod->DeleteCity($id);
	   
	    //echo $id; exit();
	   
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    
    function CityLines_Delete($id1,$id2)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $result=$this->AppsMod->CityLines_Delete($id1);
	    echo json_encode($result);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    //City Controller END

    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CITY MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 
 
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  REGION MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   

     
    //Author: Gobi.C
    //Functionality By: Gobi. C
    //Created Date:11-03-2015
    //Modified Date: 17-03-2015
    //Region Master Start
    
    function AjaxCheckRegionCode()
    {
	header('Content-Type: application/json');
	$RGH_CODE=$this->input->post('rgh_code');
	$sql="SELECT COUNT(RGH_CODE) FROM APPS_REGION_HEAD WHERE RGH_CODE='$RGH_CODE' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(RGH_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    
    function geo_type()
    {
	$geo_type=mysql_real_escape_string($_POST["geo_type"]);
	if($geo_type=="City")
	{
	    $sql="SELECT * FROM APPS_CITY  ORDER BY CT_DESC ASC  ";
	    $query = $this->db->query($sql)->result_array();
	     ?>
	    <!--<select name="RegionMenu[]" id="RegionMenu[]" class="form-control table_input selectpicker"  data-live-search="true" data-style="btn-white">-->
	    <option selected disabled > Select</option>
	    <?php foreach($query as $row)
	    { ?>
	    <option value="<?php echo $row['CT_CODE'].",". $row['CT_DESC'] ?>"><?php echo $row['CT_DESC']?></option>
	    <?php } ?>
	     <!--</select>-->
	    <?php
	}
	else if($geo_type=="Country")
	{
	    //$query=$this->db->get('APPS_COUNTRY')->result_array();
	     $sql="SELECT * FROM APPS_COUNTRY  ORDER BY CN_DESC ASC  ";
	    $query = $this->db->query($sql)->result_array();?>
	    <!--<select   name="RegionMenu[]" id="RegionMenu[]" class="form-control table_input selectpicker"  data-live-search="true" data-style="btn-white">-->
	    <option selected disabled > Select</option>
	    <?php foreach($query as $row)
	    { ?>
	    <option value="<?php echo $row['CN_CODE'].",". $row['CN_DESC'] ?>"><?php echo $row['CN_DESC']?></option>
	    <?php } ?>
	    <!--</select>-->
	    <?php
	}
	else if($geo_type=="State")
	{
	    //$query=$this->db->get('APPS_STATE')->result_array();
	     $sql="SELECT * FROM APPS_STATE  ORDER BY ST_DESC ASC  ";
	    $query = $this->db->query($sql)->result_array();
	    ?>
	    <!--<select name="RegionMenu[]" id="RegionMenu[]" class="form-control table_input selectpicker"  data-live-search="true" data-style="btn-white">-->
	    <option selected disabled > Select</option>
	    <?php foreach($query as $row)
	    { ?>
	    <option value="<?php echo $row['ST_CODE'].",". $row['ST_DESC'] ?>"><?php echo $row['ST_DESC']?></option>
	    <?php } ?>
	    <!--</select>-->
	    <?php
	}
    }
    
    function RegionMaster_View()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    //$date['query']=$this->AppsMod->ViewRegionMaster();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/RegionMaster_View');
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	
    }
    function regionTable()
    {
        $this->datatables->select('RGH_CODE,RGH_DESC,RGH_GEO_TYPE,RGH_ACTIVE_YN,RGH_CR_UID,RGH_CR_DT,RGH_UPD_UID,RGH_UPD_DT')
        
        ->from('APPS_REGION_HEAD');
		
		
        
        echo $this->datatables->generate();
    }
    
    function RegionMaster_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if($this->input->post('Proceed')=='Save')
	    {
		
		$result=$this->AppsMod->RegionSave();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/RegionMaster_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $this -> load -> view('header');
	    $data['GetGeoType']=$this->AppsMod->GetGeoType();
	    $this -> load -> view('Apps/RegionMaster_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function RegionMaster_Edit($code)
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if($this->input->post('Update')=='Update')
	    {
		
		$result=$this->AppsMod->UpdateRegion($code);
    
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A  Record Updated Successfully');
		    redirect(site_url("AppsCtr/RegionMaster_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $row= $this->AppsMod->GetRegionHead($code);
	    $data['region'] =$row;
	    $row1 = $this->AppsMod->GetRegionHeadLine($code);     		
	    $data['region2'] =$row1;
	    foreach($row as $getgeo)
	    {}
	    $cnt=$getgeo['RGH_GEO_TYPE'];
	    
	    $row3=$this->AppsMod->GetAddress($cnt);
	    $data['region3']=$row3;
	    $data['GetGeoType']=$this->AppsMod->GetGeoType();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/RegionMaster_Edit',$data);   
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	
	
	
    }
    
    
    function RegionMaster_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    $id=$_POST['id'];
	    $result=$this->AppsMod->DeleteRegionMaster($id);
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function  RegionLine_Delete($id1,$id2)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $result=$this->AppsMod->DeleteRegionLine($id1,$id2);
	    echo json_encode($result);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	    
    }
    
    //Region master End
     //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  REGION MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
     //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  USER DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     
     
    //User definination Start
    /*Author: Pravin Kumar.P
     Functionality By: Gobi. C
    Created on: 04/03/15
    Modified on: 16/03/15*/
    function UserDefinition_View()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!=""){
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/UserDefinition_View');
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    function userTable()
    {
        $this->datatables->select('USER_COMP_CODE,USER_ID,USER_DESC,USER_PERS_CODE,USER_CELL_PHONE,USER_EMAIL,USER_OFFICE_PHONE,USER_HOME_PHONE,USER_FROM_DT,USER_UPTO_DT,USER_LOGIN_FROM,USER_LOGIN_UPTO,USER_CR_UID,USER_CR_DT,USER_UPD_UID,USER_UPD_DT,USER_LOCN_CODE,USER_ACTIVE_YN')
        
        ->from('APPS_USER');
	echo $this->datatables->generate();
    }
    
    function AjaxCheckUserId()
    {
	header('Content-Type: application/json');
	$user_id=$this->input->post('user_id');
	$sql="SELECT COUNT(USER_ID) FROM APPS_USER WHERE USER_ID='$user_id' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(USER_ID)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    function UserDefinition_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if (isset($_POST['save']))
	    {
	       $result= $this->AppsMod->AddUserDefinition();
	       
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/UserDefinition_View"));
		}
		else
		{
		    $responsibility['error_message']=$result['error_message'];
		}
	    }
	    $this -> load -> view('header');
	    $responsibility['result']=$this->AppsMod->getResponsibility();
	    $this -> load -> view('Apps/UserDefinition_Add',$responsibility);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
	
    }

    function UserDefinition_Edit($id)
    {
	$userId= urldecode($id);
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if (isset($_POST['update']))
	    {
	   $result= $this->AppsMod->UpdateUserData($userId);
	    
	    if($result['return_status']==0)
		    {
			$this->session->set_flashdata('status','A Record Updated Successfully');
			redirect(site_url("AppsCtr/UserDefinition_View"));
		    }
		    else
		    {
			$editresult['error_message']=$result['error_message'];
		    }
	    }
	    $editresult['result_head']=$this->AppsMod->getResponsibility();
	    $editresult['result']=$this->AppsMod->EditUser($userId);
	    $editresult['result_res']=$this->AppsMod->EditUserResp($userId);
		
		//echo "<pre>";
		//echo "<br>";
		//print_r($editresult['result']);
		//echo "</pre>";
		//exit();
	    
	    $this->load->view('header');
	    $this->load->view('Apps/UserDefinition_Edit',$editresult);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	    
    }
    function UserDefinition_Delete()
    {
	//$userId= urldecode($id1);
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    $id1=$_POST['id1'];
	    $id2=$_POST['id2'];
	    $result= $this->AppsMod->DeleteUserDef($id1,$id2);
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
	    }else{
		echo"2"; 
		exit();
	    }
	    
	   
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
	   
	    
    }
    
    function UserDefinitionResp_Delete($id1,$id2,$id3)
    {
	$userId= urldecode($id2);
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    header('Content-Type: application/json');
	    $result=$this->AppsMod->DeleteUserResp($id1,$userId,$id3);
	    echo json_encode($result);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
	    
	    
    }
    //User definination Start
    
      //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  USER DEFINITION  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      
      
      
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  RESPONSIBILITY DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    //Author: Gobi.C
    //Functionality By: Gobi. C
    //Created Date:11-03-2015
    //Modified Date: 16-03-2015
    
    //Responsibility Definition Start...........
    
    
	
       
    
    
    
    function ResponsibilityDefinition_View()
    {
       $session_data = $this->session->userdata('USER_ID');
	if($session_data!=""){
	    //$result['data']= $this->AppsMod->ViewResponsibilityDefinition();  
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/ResponsibilityDefinition_View');
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
       
    }
    
    function responsibilityTable()
    {
        $this->datatables->select('RSPH_CODE,RSPH_DESC,RSPH_FROM_DT,RSPH_UPTO_DT,RSPH_ACTIVE_YN,RSPH_CR_UID,RSPH_CR_DT,RSPH_UPD_UID,RSPH_UPD_DT')
        
        ->from('APPS_RESP_HEAD');
		
		
        
        echo $this->datatables->generate();
    }
    
    
    function AjaxCheckRespId()
    {
	header('Content-Type: application/json');
	$rsph_code=$this->input->post('rsph_code');
	$sql="SELECT COUNT(RSPH_CODE) FROM APPS_RESP_HEAD WHERE RSPH_CODE='$rsph_code' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(RSPH_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    function AjaxCheckRespDesc()
    {
	header('Content-Type: application/json');
	$rsph_desc=$this->input->post('rsph_desc');
	$sql="SELECT COUNT(RSPH_DESC) FROM APPS_RESP_HEAD WHERE RSPH_DESC='$rsph_desc' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(RSPH_DESC)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    function ResponsibilityDefinition_Add()
    {
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	  
	    if ($this->input->post('proceed')=='Save')
	    {
		$result= $this->AppsMod->AddResponsibilityDefinition();
		//redirect('Apps/ResponsibilityDefinition_View');
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/ResponsibilityDefinition_View"));
		}
		else
		{
		    $num['error_message']=$result['error_message'];
		}
	    }
		//$sql="select APPS_M_SEQ.nextval FROM DUAL";
		//$sys_id=$this->db->query($sql, $return_object = TRUE)->result_array();
		//echo $sys_id= $sys_id[0]["NEXTVAL"];
		//exit;
	    $num['result']=$this->AppsMod->GetMenuDiscription();
	    $num['menu']=$this->AppsMod->get_menu_module();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/ResponsibilityDefinition_Add',$num);/**/
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	
	
	
    }

    function ResponsibilityDefinition_Edit($id)
    {
	
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    //$idd=$this->session->userdata('ResponsibilityId');
	    //echo  "session Value".$idd;
	    //exit();
	    $res['data']= $this->AppsMod->EditResponsibilityDefinition($id);    
	    $res['result']=$this->AppsMod->GetMenuDiscription();
	    $res['menu']=$this->AppsMod->get_menu_module();
	    $res['get']=$this->AppsMod->GetAppsRespLines($id);
	    if ($this->input->post('Update')=='Update')
	    {
		    $result= $this->AppsMod->UpdateResponsibilityDefinition($id);
		    if($result['return_status']==0)
		    {
			$this->session->set_flashdata('status','A Record Updated Successfully');
			redirect(site_url("AppsCtr/ResponsibilityDefinition_View"));
		    }
		    else
		    {
			$res['error_message']=$result['error_message'];
		    }
	    
	    }
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/ResponsibilityDefinition_Edit',$res);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
	
		
	
	
    
    }
    
    function ResponsibilityDefinition_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    $id=$_POST['id'];
	    $result=$this->AppsMod->DeleteResponsibilityDefinition($id);
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function ResponsibilityDefinitionLines_Delete($id1,$res_id)
    {
	header('Content-Type: application/json');
	$result = $this->AppsMod->DeleteRepsLine($res_id,$id1);
	echo json_encode($result);
    }
	
	
	//Responsibility Definition End...........
	
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  RESPONSIBILITY DEFINITION  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  MENU DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    
    // Menu Defination Start------>
    //AUTOR - Rafeeq
    //Functionality By: Gobi. C
    //CREATED DATE-04-03-2015
    //MODIFIED DATE-18-03-2015
    function MenuDefinition_View(){
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/MenuDefinition_View');
	}
	else{
	     redirect(site_url('AppsCtr'));
	}
    }
    
    function menuTable()
    {
        $this->datatables->select('MENU_MODULE,MENU_CODE,MENU_DESC,MENU_PARENT_CODE,MENU_TYPE,MENU_DISP_SEQ,MENU_DEFINITION,MENU_MULTI_INST_YN,MENU_TXN_CODE,MENU_ACTIVE_YN,MENU_FROM_DT,MENU_UPTO_DT,MENU_CR_UID,MENU_CR_DT,MENU_UPD_UID,MENU_UPD_DT')
        
        ->from('APPS_MENU');
		
		
        
        echo $this->datatables->generate();
    }
    
    function Get_menu_code()
    {
	$data =$this->input->post('menu_module');
	$sql="SELECT MAX(MENU_CODE) FROM APPS_MENU where MENU_MODULE='$data'";
	$menu_code=$this->db->query($sql)->result_array();
	$menu_code_1 = $menu_code[0]['MAX(MENU_CODE)'];
	echo '{"menu_code":"'.$menu_code_1.'"}';
    }
    
    function Get_Parant_Menu()
    {
	$data1 =$this->input->post('menu_module');
	$menu_code=explode("-",$data1);
	
	$sql1="SELECT * FROM APPS_MENU where MENU_MODULE='$menu_code[0]' ";
	$data=$this->db->query($sql1, $return_object = TRUE)->result();
	?>
	<select class="form-control selectpicker" data-live-search="true" data-style="btn-white" name="MENU_PARENT_CODE"  required id="MENU_PARENT_CODE">
	<option selected="" disabled="">Select</option>
	<?php
	foreach($data as $key =>$value)
	{ ?>
	    <option value="<?php echo $data[$key]->MENU_CODE ;?>" > <?php echo $data[$key]->MENU_DESC?> </option>
	<?php }
	?>
	</select>
	<?php
    }
    
    function MenuDefinition_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if ($this->input->post('Save')=='Save')
	    {
		$result= $this->AppsMod->AddMenu();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/MenuDefinition_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	       
	    }
	    $data['menu'] = $this->AppsMod->get_menu_module();
	    //$data['parent'] = $this->AppsMod->get_parent_menu();
	    $data['type'] = $this->AppsMod->get_type_menu();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/MenuDefinition_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
    
   
    
    function MenuDefinition_Edit($menu_code)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if($this->input->post('Update')=='Update')
	    {
		$result= $this->AppsMod->UpdateMenu($menu_code);
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A Record Updated Successfully');
		    redirect(site_url("AppsCtr/MenuDefinition_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
		
	    }
	    $data['menu_get'] = $this->AppsMod->get_menu_module();
	    //$data['parent'] = $this->AppsMod->get_parent_menu();
	    $data['type'] = $this->AppsMod->get_type_menu();
	    $data['menu'] = $this->AppsMod->EditMenu($menu_code);
	    
	    $data['parent'] = $this->AppsMod->getParentcode($menu_code);
	    //echo "<pre>";
	    //print_r($data['menu']);
	    //echo "</pre>";
	    //exit();
	    
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/MenuDefinition_Edit',$data);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    //function UpdateMenuDefinition($menu_code){
    //
    //}
    
    function MenuDefinition_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $id=$_POST['id'];
	    $result= $this->AppsMod->DeleteMenu($id);
	    
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
		//$this->session->set_flashdata('status','A Record is Deleted Successfully');
		//redirect("AppsCtr/Country_View");
	    }else{
		echo"2"; 
		exit();
		// $this->session->set_flashdata('status','A Record is Unable To Delete');
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}

    }
    //Menu definition ended------->
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  MENU DEFINITION  END%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  FRANCHISE START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    function Franchise_View(){
	
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $data['query']=$this->AppsMod->GetCompDetailsFranchise();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/Franchise_View',$data);
	}
	else{
	     redirect(site_url('AppsCtr'));
	}
    }
    function Franchise_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	//    if ($this->input->post('Save')=='Save')
	//    {
	//	$result= $this->AppsMod->AddMenu();
	//	if($result['return_status']==0)
	//	{
	//	    $this->session->set_flashdata('status','A New Record Added Successfully');
	//	    redirect(site_url("AppsCtr/Franchise_View"));
	//	}
	//	else
	//	{
	//	    $data['error_message']=$result['error_message'];
	//	}
	//       
	//    }
	    $data['city']=$this->AppsMod->ViewCity();
	    $data['state']= $this->AppsMod->ViewState();
	    $data['Country']= $this->AppsMod->GetCountry();
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/Franchise_Add',$data);
	}
	else{
	    redirect(site_url('AppsCtr'));
	}
    }
        function Franchise_Edit($comp_code)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	//    if($this->input->post('Update')=='Update')
	//    {
	//	$result= $this->AppsMod->UpdateMenu($menu_code);
	//	if($result['return_status']==0)
	//	{
	//	    $this->session->set_flashdata('status','A Record Updated Successfully');
	//	    redirect(site_url("AppsCtr/Franchise_View"));
	//	}
	//	else
	//	{
	//	    $data['error_message']=$result['error_message'];
	//	}
	//	
	//    }
	    $data['city']=$this->AppsMod->ViewCity();
	    $data['state']= $this->AppsMod->ViewState();
	    $data['country']= $this->AppsMod->GetCountry();
	    $data['compDetails']=$this->AppsMod->GetCompDetailsCode($comp_code);
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/Franchise_Edit',$data);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
//    function Franchise_Delete()
//    {
//	
//	//$result= $this->AppsMod->DeleteMenu($menu_code);
//	if($result['return_status']==0)
//	{
//	    $this->session->set_flashdata('status','A Record Deleted Successfully');
//	    redirect(site_url("AppsCtr/Franchise_View"));
//	}
//	else
//	{
//	    $data['error_message']=$result['error_message'];
//	}
//    }
     
     
     
     //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  FRANCHISE END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION HEAD MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
	
    //Author :selva
    //Functionality By: Gobi. C   
    //created Date:16/03/2015
    //Modified Date:

    function TransactionHeadMaster_View()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $this -> load -> view('header');
	    $this -> load -> view('Apps/TransactionHeadMaster_View');
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
     function transactionHeadMasterTable()
    {
         $this->datatables->select('TXH_CODE,TXH_DESC,TXH_FLOW_SEQ,TXH_ACTIVE_YN,TXH_CR_UID,TXH_CR_DT,TXH_UPD_UID,TXH_UPD_DT')
        
        ->from('APPS_TXN_HEAD');
	echo $this->datatables->generate();
    }
    
    function AjaxCheckTxnHeadCode()
    {
	header('Content-Type: application/json');
	$txn_code=$this->input->post('txn_code');
	$sql="SELECT COUNT(TXH_CODE) FROM APPS_TXN_HEAD WHERE TXH_CODE='$txn_code' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(TXH_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }

    function TransactionHeadMaster_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if (isset($_POST['add']))
	    {
		$result=$this->AppsMod->AddTranHead();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/TransactionHeadMaster_View"));
		}
		else
		{
		    $result['error_message']=$result['error_message'];
		}
		
	    }
	    else
	    {
		$result['data']=$this->AppsMod->GetMaxFlowSequence();
		$this -> load -> view('header');
		$this->load->view('Apps/TransactionHeadMaster_Add',$result);    
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }

    function TransactionHeadMaster_Edit($id)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    if (isset($_POST['save']))
	    {
		$result=$this->AppsMod->updateHeadMaster($id);
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A Record Updated Successfully');
		    redirect(site_url("AppsCtr/TransactionHeadMaster_View"));
		}
		else
		{
		    $query['error_message']=$result['error_message'];
    		}
		
	    }
	    $this->load->view('header');
	    $query['row']=$this->AppsMod->EditTrans($id);
	    $this -> load -> view('Apps/TransactionHeadMaster_Edit',$query);
	   
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
		

    }
    
    function TransactionHeadMaster_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $id=$_POST['id'];
	  $result = $this->AppsMod->DeleteHeadMasterTable($id);
	    
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
	    }else{
		echo"2"; 
		exit();
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }	
	
	
	// Transaction Head Master End
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION HEAD MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
	
	
	
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION SETUP MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    
    
    //Author :selva
    //Functionality By: Gobi. C
    //created Date:16/03/2015
    //Modified Date:
    //Transaction Set up Master Controllers START
    
    
    function TransactionSetupMaster_View()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $this->load->view('header');
	    $result['data']=$this->AppsMod->GetTransactionSetTable();
	    $this->load->view('Apps/TransactionSetupMaster_View',$result);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    function transactionSetupMasterTable()
    {
        $this->datatables->select('TXN_CODE,TXN_DESC,TXN_TXH_CODE,TXN_DOC_GEN_TYPE,TXN_DOC_PADDING,TXN_ACTIVE_YN,TXN_FLOW_SEQ,TXN_AUDIT_YN,TXN_FUTURE_PERIOD_YN,TXN_FUTURE_DAYS,TXN_BACK_PERIOD_YN,TXN_BACK_DAYS,TXN_CR_UID,TXN_CR_DT,TXN_UPD_UID,TXN_UPD_DT')
        
        ->from('APPS_TXN_SETUP');
	echo $this->datatables->generate();
    }
    
    function AjaxCheckTxnCode()
    {
	header('Content-Type: application/json');
	$txn_code=$this->input->post('txh_code');
	$sql="SELECT COUNT(TXN_CODE) FROM APPS_TXN_SETUP WHERE TXN_CODE='$txn_code' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(TXN_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    function AjaxCheckDocCode()
    {
	header('Content-Type: application/json');
	if($this->input->post('txdr_company'))
	{
	    $txn_code=$_POST['txdr_company'][0];
	}
	else
	{
	    $txn_code=$_POST['txdr_company1'][0];
	}
	
	
	$sql="SELECT COUNT(TXDR_COMP_CODE) FROM APPS_TXN_DOC_RANGE WHERE TXDR_COMP_CODE='$txn_code' ";
	$query = $this->db->query($sql)->result_array();
	if($query[0]['COUNT(TXDR_COMP_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    
    
    
    function AjaxCheckAttachmentCode()
    {
	header('Content-Type: application/json');
	if($this->input->post('txa_company'))
	{
	    $txn_code=$_POST['txa_company'][0];
	     
	}
	else
	{
	    $txn_code=$_POST['txa_company1'][0];
	}
	
	
	
	$sql="SELECT COUNT(TXA_COMP_CODE) FROM APPS_TXN_AUTH WHERE TXA_COMP_CODE='$txn_code'";
	$query = $this->db->query($sql)->result_array();
	
	if($query[0]['COUNT(TXA_COMP_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
	
	
    }
    
    function AjaxCheckUptoNo()
    {
	
	print_r($_POST);
	header('Content-Type: application/json');
	if($this->input->post('txa_company'))
	{
	    $txn_code=$_POST['txa_company'][0];
	     
	}
	else
	{
	    $txn_code=$_POST['txa_company1'][0];
	}
	
	
	
	$sql="SELECT COUNT(TXA_COMP_CODE) FROM APPS_TXN_AUTH WHERE TXA_COMP_CODE='$txn_code'";
	$query = $this->db->query($sql)->result_array();
	
	if($query[0]['COUNT(TXA_COMP_CODE)']==0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    function TransactionSetupMaster_Add()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    if (isset($_POST['save']))
	    {
		$result=$this->AppsMod->AddTransMaster();
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A New Record Added Successfully');
		    redirect(site_url("AppsCtr/TransactionSetupMaster_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
		
	    }
	    else
	    {
		$data['thm']=$this->AppsMod->getTransHeadMaster();
		$data['users']=$this->AppsMod->getAppsUsers();
		$data['avsl']=$this->AppsMod->GetAppsValueSet();
		$data['txnpad']=$this->AppsMod->GetGenPad();
		$data['txnmax']=$this->AppsMod->GetFlowSeq();
		$this -> load -> view('header');
		$this->load->view('Apps/TransactionSetupMaster_Add',$data);
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    function TransactionSetupMaster_Edit($id)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    
	    if (isset($_POST['update']))
	    {
		$result= $this->AppsMod->updateSetup($id);
		//$this->AppsMod->doc_range($id);
		if($result['return_status']==0)
		{
		    $this->session->set_flashdata('status','A Record Updated Successfully');
		    redirect(site_url("AppsCtr/TransactionSetupMaster_View"));
		}
		else
		{
		    $data['error_message']=$result['error_message'];
		}
	    }
	    $this -> load -> view('header');
	    $data['thm']=$this->AppsMod->getTransHeadMaster();
	    $data['avsl']=$this->AppsMod->GetAppsValueSet();
	    $data['txnpad']=$this->AppsMod->GetGenPad();
	    $data['txnmax']=$this->AppsMod->GetFlowSeq();
	    $data['first']= $this->AppsMod->EditFirstSetupMaster($id);
	    $data['second']= $this->AppsMod->EditSecondSetupMaster($id);
	    $data['third']= $this->AppsMod->EditThirdSetupMaster($id);
	    $data['users']=$this->AppsMod->getAppsUsers();
	    $this->load->view('Apps/TransactionSetupMaster_Edit',$data);
	
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
    }
    
    function TransactionSet_Delete()
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $id=$_POST['id'];
	   $result= $this->AppsMod->DeleteTransactionSet($id);
	    
	    if($result['return_status']==0)
	    {
		echo"1"; 
		exit();
	    }else{
		echo"2"; 
		exit();
	    }
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	
    }
    
    function TranscationSetupDoc_Delete($id1,$id2,$id3)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $result=$this->AppsMod->DeleteTranscationSetupDoc($id1,$id2,$id3);
	    echo json_encode($result);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	//if($result['return_status']==0)
	//    {
	//	$this->session->set_flashdata('status','A  Document Line Record Deleted Successfully');
	//	redirect(site_url("AppsCtr/TransactionSetupMaster_Edit/".$id3));
	//    }
	//    else
	//    {
	//	$data['error_message']=$result['error_message'];
	//    }
    }
    
    function TranscationSetupAuth_Delete($id1,$id2,$id3)
    {
	$session_data = $this->session->userdata('USER_ID');
	if($session_data!="")
	{
	    $result=$this->AppsMod->DeleteTranscationSetupAuth($id1,$id2,$id3);
	    echo json_encode($result);
	}
	else
	{
	    redirect(site_url('AppsCtr'));
	}
	
	//if($result['return_status']==0)
	//    {
	//	$this->session->set_flashdata('status','A Authorization line Record Deleted Successfully');
	//	redirect(site_url("AppsCtr/TransactionSetupMaster_Edit/".$id2));
	//    }
	//    else
	//    {
	//	$data['error_message']=$result['error_message'];
	//    }
	
	
    }
    
         //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION SETUP MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
}