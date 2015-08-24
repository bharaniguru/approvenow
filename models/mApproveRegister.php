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
	
	//print_r($data);
	//exit;
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
    function getReasonRef($id)
    {
	
	$sql="SELECT * FROM PA_reject_reason WHERE prior_authorizaion_id='$id'";
	return $this->db->query($sql)->result_array();
	
    }
    //PRIOR AUTH ENDS
    
    
    
    //***********************************************END**********************************************************
    function min_menu_code(){
	$sql="SELECT MIN(MENU_CODE) as MIN_CODE FROM APPS_MENU";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function get_menu($menu_code){
	$com_code=$this->session->userdata('USER_COMP_CODE');
	$user_id=$this->session->userdata('USER_ID');
	//$sql="SELECT * from APPS_MENU where MENU_PARENT_CODE='$menu_code'";
	$sql="SELECT * FROM APPS_MENU, APPS_RESP_LINES, APPS_RESP_HEAD, APPS_USER_RESP, APPS_USER WHERE MENU_CODE = RSPL_MENU_CODE  AND RSPH_CODE = RSPL_RSPH_CODE AND USRS_COMP_CODE = USER_COMP_CODE  AND USRS_RESP_CODE = RSPH_CODE AND USRS_ID = USER_ID AND USER_COMP_CODE = '$com_code' AND USER_ID='$user_id' AND MENU_PARENT_CODE='$menu_code' ORDER BY 1";
	$return = $this->db->query($sql, $return_object = FALSE)->result_array();
	if($return){
	    return $return;
	}
	//echo "<pre>";
	//print_r($return);
	//echo "<pre>";
	//exit;
    }
    
    function GetResponseForUser($menu_code){
	$com_code=$this->session->userdata('USER_COMP_CODE');
	$user_id=$this->session->userdata('USER_ID');
	//$sql="SELECT * from APPS_MENU where MENU_PARENT_CODE='$menu_code'";
	$sql="SELECT * FROM APPS_MENU, APPS_RESP_LINES, APPS_RESP_HEAD, APPS_USER_RESP, APPS_USER WHERE MENU_CODE = RSPL_MENU_CODE  AND RSPH_CODE = RSPL_RSPH_CODE AND USRS_COMP_CODE = USER_COMP_CODE  AND USRS_RESP_CODE = RSPH_CODE AND USRS_ID = USER_ID AND USER_COMP_CODE = '$com_code' AND USER_ID='$user_id' AND MENU_CODE='$menu_code' ORDER BY 1";
	
	return $this->db->query($sql, $return_object = TRUE)->result_array();
	
	
	//echo "<pre>";
	//print_r($return);
	//echo "<pre>";
	//exit;
    }
    function get_child($menu_id){
	$fetch_code=$this->get_menu($menu_id);
	$sub_count=count($fetch_code);
	for($i=0;$i<$sub_count;$i++){
	    $menu_type=$fetch_code[$i]['MENU_TYPE'];
	    if($menu_type=='P'){
	    ?>
	    <li  id="<?=$fetch_code[$i]['MENU_CODE']?>" ><a href="<?php echo site_url($fetch_code[$i]['MENU_DEFINITION']); ?>"><span><?=$fetch_code[$i]['MENU_DESC']?></span></a></li>
	    <?php
	    }
	    elseif($menu_type=='M'){
	    ?>
	    <li class="has-sub"  id="<?=$fetch_code[$i]['MENU_CODE']?>">
		<a href="javascript:;">
		    <b class="caret pull-right"></b>
		    <?php if($fetch_code[$i]['MENU_CODE']=='107-00000001') {
			    //finace
			    echo '<i class="fa fa-dollar text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='108-00000001'){
			    //francese
			    echo '<i class="fa fa-flag-checkered text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='109-00000001'){
			    //HR
			    echo '<i class="fa fa-user text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='101-00000001'){
			    //Application
			    echo '<i class="fa fa-align-left text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='102-00000001'){
			    //Procrument
			    echo '<i class="fa fa-suitcase text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='103-00000001'){
			    //inventory
			    echo '<i class="fa fa-tasks text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='104-00000001'){
			    //sales
			    echo '<i class="fa fa-signal text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='106-00000001'){
			    //logestic
			    echo '<i class="fa fa-truck text-warning"></i>';
			}elseif($fetch_code[$i]['MENU_CODE']=='105-00000001'){
			    //manufacturing
			    echo '<i class="fa fa-building text-warning"></i>';
			}
			
			?>
		    
		    
		    <span><?=$fetch_code[$i]['MENU_DESC']?></span></a>
		<ul class="sub-menu">
		<?php
		    $this->get_child($fetch_code[$i]['MENU_CODE']);
		?>
		</ul>
	    </li>
	    <?php
	    }
	}
    }
    function Get_Menu_Code($href){
	$sql="SELECT * from APPS_MENU where MENU_DEFINITION LIKE '%$href%'";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function active_menu_tree($menu_code){
	$sql="SELECT * from APPS_MENU where MENU_CODE='$menu_code'";
	$result=$this->db->query($sql, $return_object = TRUE)->result_array();
	if(count($result)>0){
	    $parent_code=$result[0]['MENU_PARENT_CODE'];
	?>
	<script>
	    $('#<?=$parent_code?>').addClass("active");
	    
	</script>
	    <?php
	    
	    $this->active_menu_tree($parent_code);    
	}
	
	
    }
//    function GetResponseForUser($menu_code){
//	$select="SELECT * FROM APPS_RESP_LINES WHERE RSPL_MENU_CODE='$menu_code' AND RSPL_RSPH_CODE = '$rsph_code' ";
//	return $this->db->query($select)->result_array();
//    }
    function Menu_Txn_Description($txn_code){
	$select="SELECT TXN_DESC FROM APPS_TXN_SETUP WHERE TXN_CODE='$txn_code'";
	$data= $this->db->query($select)->result_array();
	return $data[0]["TXN_DESC"];
    }
    function GetCompDetails($comp_code){
	$select="SELECT * FROM APPS_COMPANY WHERE COMP_CODE='$comp_code'";
	return $this->db->query($select)->result_array();
	
    }
    function GetCompDetailsCode($compcode){
	$select="SELECT * FROM APPS_COMPANY WHERE COMP_CODE='$compcode'";
	return $this->db->query($select)->result_array();
	
    }

    function Fetch_Menu(){
	$sql="SELECT MENU_DESC FROM APPS_MENU";
	$query = $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function GetCompDetailsFranchise(){
	$sql="SELECT * FROM APPS_COMPANY";
	return $this->db->query($sql, $return_object = TRUE)->result_array(); 
    }
    //End menu in header

    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  COUNTRY MASTER START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    
    //Country Model Start
    public function addCountry()
    {
	$cn_longitude= str_replace('Â', '',$this->input->post('cn_longitude'));
	$cn_latitude= str_replace('Â', '',$this->input->post('cn_latitude'));
	
	$ACTIVE=$this->input->post('cn_active_yn');
	if($ACTIVE!="Y")
	{
	    $ACTIVE="N";
	}
	$data = array(
	   'CN_CODE' => $this->security->xss_clean($this->input->post('cn_code')),
	   'CN_DESC' => $this->security->xss_clean($this->input->post('cn_desc')),
	   'CN_LATITUDE' =>$this->security->xss_clean($cn_latitude),
	   'CN_LONGITUDE' => $this->security->xss_clean($cn_longitude),
	   'CN_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	   'CN_CR_UID' => $this->session->userdata('USER_ID'),
	   'CN_CR_DT' => '01-OCT-14',
	   'CN_ACTIVE_YN' => $this->security->xss_clean($ACTIVE),
	);
	$params = array(
	     array('name'=>':p_cn_code', 'value'=>$data['CN_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	     array('name'=>':p_cn_desc', 'value'=>$data['CN_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	     array('name'=>':p_cn_latitude', 'value'=>$data['CN_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
	     array('name'=>':p_cn_longitude', 'value'=>$data['CN_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
	     array('name'=>':p_cn_active_yn', 'value'=>$data['CN_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	     array('name'=>':p_cn_lang_code', 'value'=>$data['CN_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_user_id', 'value'=>$data['CN_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_COUNTRY', $params);
	return  $result = array("return_status"=>$return_status,"error_message"=>$error_message );
	 
    }
    
    public function ViewCountry()
    {
	
	$sql="SELECT * FROM APPS_COUNTRY ORDER BY CN_DESC ASC";
	return $query = $this->db->query($sql, $return_object = TRUE)->result_array();
	
    }
    
    public function update_country()
    {
	
	$cn_latitude= str_replace('Â', '',$this->input->post('cn_latitude'));
	$cn_longitude= str_replace('Â', '',$this->input->post('cn_longitude'));
	$ACTIVE=$this->input->post('cn_active_yn');
	if($ACTIVE!="Y")
	{
	    $ACTIVE="N";
	}
	$data = array
	(
	    'CN_CODE' => $this->security->xss_clean($this->input->post('cn_code')),
	    'CN_DESC' => $this->security->xss_clean($this->input->post('cn_desc')),
	    'CN_LATITUDE' => $this->security->xss_clean($cn_latitude),
	    'CN_LONGITUDE' => $this->security->xss_clean($cn_longitude),
	    'CN_ACTIVE_YN' => $this->security->xss_clean($ACTIVE),
	    'CN_LANG_CODE'  => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'CN_CR_UID'=>  $this->session->userdata('USER_ID'),
	    'CN_CR_DT'=> '10-MAR-15'
	);
	
	$params = array(
	     array('name'=>':p_cn_code', 'value'=>$data['CN_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	     array('name'=>':p_cn_desc', 'value'=>$data['CN_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	     array('name'=>':p_cn_latitude', 'value'=>$data['CN_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
	     array('name'=>':p_cn_longitude', 'value'=>$data['CN_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
	     array('name'=>':p_cn_active_yn', 'value'=>$data['CN_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	     array('name'=>':p_cn_lang_code', 'value'=>$data['CN_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_user_id', 'value'=>$data['CN_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	     array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_COUNTRY', $params);
	return  $result = array("return_status"=>$return_status,"error_message"=>$error_message );
    }
	
    public function DeleteCountry($id)
    {
	$params = array(
	    array('name'=>':p_cn_code', 'value'=>$id,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
	    );
	    
	$this->db->stored_procedure('SPINE_APPS','DALETE_APPS_COUNTRY', $params);
	return $result = array("return_status"=>$return_status
				  ,"error_message"=>$error_message );
    }
    
    public function fetchCountry($id)
    {
	$sql="SELECT * FROM APPS_COUNTRY where CN_CODE='$id' ";
      
	   return $query = $this->db->query($sql, $return_object = TRUE)->result_array();
	
    }	
    //Country Model End
    
 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  COUNTRY MASTER END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  STATE MASTER START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%       
    //State Model Start
    //Author: Vinod
    //modified By: gobi .C
    //Created on: 04/03/15
    //Modified on: 16/03/15
	
    function ViewState()
    {
	return $this->db->get('APPS_STATE')->result_array();
    }
	
    function GetCountry()
    {
	$sql="SELECT * FROM APPS_COUNTRY where CN_ACTIVE_YN ='Y' ORDER BY CN_DESC ASC ";
	return $query = $this->db->query($sql, $return_object = TRUE)->result_array();
    
    }
    function AddState()
    {
	$st_longitude= str_replace('Â', '',$this->input->post('st_longitude'));
	$st_latitude= str_replace('Â', '',$this->input->post('st_latitude'));
	
	$ACTIVE=$this->input->post('st_active_yn');
	if($ACTIVE!="Y")
	{
	    $ACTIVE="N";
	}
	$data= array
	    (
	       'ST_CODE' => $this->security->xss_clean($this->input->post('st_code')),
	       'ST_DESC' => $this->security->xss_clean($this->input->post('st_desc')),
	       'ST_LATITUDE' => $this->security->xss_clean($st_latitude),
	       'ST_LONGITUDE' => $this->security->xss_clean($st_longitude),
	       'ST_CN_CODE' => $this->security->xss_clean($this->input->post('st_cn_code')),
	       'ST_ACTIVE_YN'=>$this->security->xss_clean($ACTIVE),
	       'ST_LANG_CODE'  => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	       'ST_CR_UID'=> $this->session->userdata('USER_ID'),
	       
	    );
	$params = array(
	      array('name'=>':P_ST_CODE', 'value'=>$data['ST_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	      array('name'=>':P_ST_DESC', 'value'=>$data['ST_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	      array('name'=>':P_ST_LATITUDE', 'value'=>$data['ST_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
	      array('name'=>':P_ST_LONGITUDE', 'value'=>$data['ST_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
	      array('name'=>':P_ST_CN_CODE', 'value'=>$data['ST_CN_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	      array('name'=>':P_ST_ACTIVE_YN', 'value'=>$data['ST_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	      array('name'=>':P_ST_LANG_CODE', 'value'=>$data['ST_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	      array('name'=>':P_USER_ID', 'value'=>$data['ST_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	      array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	      array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_STATE', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
    }
   
    
    public function EditState($id)
    {
	$sql="SELECT * FROM APPS_STATE where ST_CODE='$id' ";
	return $query = $this->db->query($sql)->result_array();
    }
    public function UpdateState($st_code)
    {
	$st_longitude= str_replace('Â', '',$this->input->post('st_longitude'));
	$st_latitude= str_replace('Â', '',$this->input->post('st_latitude'));
	//$this->db->where('ST_CODE', $st_code);
	$ACTIVE=$this->input->post('st_active_yn');
	if($ACTIVE!="Y")
	{
	    $ACTIVE="N";
	}
	    $data= array
	    (
		'ST_CODE'=>$this->input->post('st_code'),
		'ST_DESC'=> $this->input->post('st_desc'),
		'ST_LATITUDE'=>$st_latitude,
		'ST_LONGITUDE'=>$st_longitude,
		'ST_CN_CODE'=> $this->input->post('st_cn_code_old'),
		'ST_ACTIVE_YN'=>$ACTIVE,
		'ST_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'ST_CR_UID'=>$this->session->userdata('USER_ID'),
		'ST_CR_DT'=>'10-MAR-15',
		'ST_UPD_UID'=>null,
		'ST_UPD_DT'=>null
            );
	     
	   $params = array(
                 array('name'=>':P_ST_CODE', 'value'=>$data['ST_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
                 array('name'=>':P_ST_DESC', 'value'=>$data['ST_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
                 array('name'=>':P_ST_LATITUDE', 'value'=>$data['ST_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
            	 array('name'=>':P_ST_LONGITUDE', 'value'=>$data['ST_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
		 array('name'=>':P_ST_CN_CODE', 'value'=>$data['ST_CN_CODE'],'type'=>SQLT_CHR, 'length'=>300),
                 array('name'=>':P_ST_ACTIVE_YN', 'value'=>$data['ST_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
                 array('name'=>':P_ST_LANG_CODE', 'value'=>$data['ST_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		 array('name'=>':P_USER_ID', 'value'=>$data['ST_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		 array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		 array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	   $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_STATE', $params);
	   return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    
    
    function DeleteState($id)
    {
	$params = array(
                 array('name'=>':P_ST_CODE', 'value'=>$id,'type'=>SQLT_CHR, 'length'=>300 ),
		 array('name'=>':P_USER_ID', 'value'=> $this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		 array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		 array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_STATE ', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message );
    }
    //State Model End
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  STATE MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
     //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CITY MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    //Author: Gobi
    //Functionality By: gobi .C
    //Created on: 04/03/15
    //Modified on: 16/03/15
    //City model Start
	    
    public function ViewCity()
    {
	$sql="SELECT * FROM APPS_CITY  ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetCity($code)
    {
	$sql="SELECT * FROM APPS_CITY where CT_CODE='$code' ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetCityArea($code)
    {
	$sql="SELECT * FROM APPS_CITY_AREA where AR_CT_CODE='$code' ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function addCity()
    {
	$ct_longitude= str_replace('Â', '',$this->input->post('ct_longitude'));
	$ct_latitude= str_replace('Â', '',$this->input->post('ct_latitude'));
	if($this->input->post('ct_active_yn')=="")
	{
	    $CT_ACTIVE_YN="N";
	}
	else
	{
	    $CT_ACTIVE_YN="Y";	    
	}
	$data = array(
	    'CT_CODE' => $this->input->post('ct_code'),
	    'CT_DESC' => $this->input->post('ct_desc'),
	    'CT_LATITUDE' =>$ct_latitude,
	    'CT_LONGITUDE' => $ct_longitude,
	    'CT_CN_CODE' => $this->input->post('ct_cn_code'),
	    'CT_ST_CODE' => $this->input->post('ct_st_code'),
	    'CT_ACTIVE_YN' => $CT_ACTIVE_YN,
	    'CT_LANG_CODE' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'CT_CR_UID' => $this->session->userdata('USER_ID'),
	    'CT_CR_DT' => '01-OCT-14'
	);
	$params = array(
	    array('name'=>':P_CT_CODE', 'value'=>$data['CT_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_DESC', 'value'=>$data['CT_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_CT_LATITUDE', 'value'=>$data['CT_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_CT_LONGITUDE', 'value'=>$data['CT_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_CN_CODE', 'value'=>$data['CT_CN_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_ST_CODE', 'value'=>$data['CT_ST_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_CT_ACTIVE_YN', 'value'=>$data['CT_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_CT_LANG_CODE', 'value'=>$data['CT_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID', 'value'=>$data['CT_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_CITY', $params);
	 $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    
    //Apps_city inserted end

    //Apps_city_area satart
	
	$fval=count($this->input->post('APPS_CITY_AREA'));
       
	for($i=0;$i<$fval;$i++)
	{
	    $ct_longitude= str_replace('Â', '',$_POST['AR_LONGITUDE'][$i]);
	    $ct_latitude= str_replace('Â', '',$_POST['AR_LATITUDE'][$i]);
	    $data_cityarea = array(
		'AR_CODE' => $_POST['APPS_CITY_AREA'][$i],
		'AR_DESC' => $_POST['AR_DESC'][$i],
		'AR_LATITUDE' => $ct_latitude,
		'AR_LONGITUDE' =>$ct_longitude,
		'AR_CT_CODE' => $this->input->post('ct_code'),
		'AR_ACTIVE_YN' => $_POST['AR_ACTIVE_YN1'][$i],
		'AR_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'AR_CR_UID' => $this->session->userdata('USER_ID')
		);
	    
	   $params1 = array(
		array('name'=>':P_AR_CODE', 'value'=>$data_cityarea['AR_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_AR_DESC', 'value'=>$data_cityarea['AR_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_AR_LATITUDE', 'value'=>$data_cityarea['AR_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
		array('name'=>':P_AR_LONGITUDE', 'value'=>$data_cityarea['AR_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_CT_CODE', 'value'=>$data_cityarea['AR_CT_CODE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_ACTIVE_YN', 'value'=>$data_cityarea['AR_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_AR_LANG_CODE', 'value'=>$data_cityarea['AR_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USER_ID', 'value'=>$data_cityarea['AR_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_CITY_AREA', $params1);
	    $result = array("return_status"=>$return_status
		 ,"error_message"=>$error_message );
	}
    }							
    public function UpdateCity()
    {
	//update City Start
	$ct_longitude= str_replace('Â', '',$this->input->post('ct_longitude'));
	$ct_latitude= str_replace('Â', '',$this->input->post('ct_latitude'));
	if($this->input->post('ct_active_yn')=="")
	{
	    $CT_ACTIVE_YN="N";
	}
	else
	{
	    $CT_ACTIVE_YN="Y";
	}
	$data = array(
	     'CT_CODE' => $this->input->post('ct_code'),
	     'CT_DESC' => $this->input->post('ct_desc'),
	     'CT_LATITUDE' =>$ct_latitude,
	     'CT_LONGITUDE' => $ct_longitude,
	     'CT_CN_CODE' => $this->input->post('ct_cn_code_old'),
	     'CT_ST_CODE' => $this->input->post('ct_st_code_old'),
	     'CT_ACTIVE_YN' => $CT_ACTIVE_YN,
	     'CT_LANG_CODE' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	     'CT_CR_UID' =>  $this->session->userdata('USER_ID'),
	     'CT_CR_DT' => '01-OCT-14'
	);
	 
	$params = array(
	    array('name'=>':P_CT_CODE', 'value'=>$data['CT_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_DESC', 'value'=>$data['CT_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_CT_LATITUDE', 'value'=>$data['CT_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_CT_LONGITUDE', 'value'=>$data['CT_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_CN_CODE', 'value'=>$data['CT_CN_CODE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_CT_ST_CODE', 'value'=>$data['CT_ST_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_CT_ACTIVE_YN', 'value'=>$data['CT_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_CT_LANG_CODE', 'value'=>$data['CT_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID', 'value'=>$data['CT_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_CITY', $params);
	 //update City End   
	    
	//Update City Line Start
	$fval=$this->input->post('total_value');
       
       
	for($i=0;$i<$fval;$i++)
	{
	    $ct_longitude= str_replace('Â', '',$_POST['AR_LONGITUDE'][$i]);
	    $ct_latitude= str_replace('Â', '',$_POST['AR_LATITUDE'][$i]);
	    $data_cityarea = array(
		'AR_CODE' => $_POST['APPS_CITY_AREA'][$i],
		'AR_DESC' => $_POST['AR_DESC'][$i],
		'AR_LATITUDE' =>$ct_latitude,
		'AR_LONGITUDE' =>$ct_longitude,
		'AR_CT_CODE' => $this->input->post('ct_code'),
		'AR_ACTIVE_YN' => $_POST['AR_ACTIVE_YN1'][$i],
		'AR_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'AR_CR_UID' => $this->session->userdata('USER_ID')
		);
	    
	   $params1 = array(
		array('name'=>':P_AR_CODE', 'value'=>$data_cityarea['AR_CODE12'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_AR_DESC', 'value'=>$data_cityarea['AR_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_AR_LATITUDE', 'value'=>$data_cityarea['AR_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
		array('name'=>':P_AR_LONGITUDE', 'value'=>$data_cityarea['AR_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_CT_CODE', 'value'=>$data_cityarea['AR_CT_CODE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_ACTIVE_YN', 'value'=>$data_cityarea['AR_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_AR_LANG_CODE', 'value'=>$data_cityarea['AR_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USER_ID', 'value'=>$data_cityarea['AR_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_CITY_AREA', $params1);
	        $result = array("return_status"=>$return_status,"error_message"=>$error_message );
		//echo "<pre>";
		//print_r($params1);
		//echo "</pre>";
	}   
	
	 //insert New City Lines start
	$fval=count($this->input->post('APPS_CITY_AREA1'));
      
	for($i=0;$i<$fval-1;$i++)
	{
	    
	    $data_cityarea = array(
		'AR_CODE' => $_POST['APPS_CITY_AREA1'][$i],
		'AR_DESC' => $_POST['AR_DESC1'][$i],
		'AR_LATITUDE' => $_POST['AR_LATITUDE1'][$i],
		'AR_LONGITUDE' => $_POST['AR_LONGITUDE1'][$i],
		'AR_CT_CODE' => $this->input->post('ct_code'),
		'AR_ACTIVE_YN' => $_POST['AR_ACTIVE_YN2'][$i],
		'AR_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'AR_CR_UID' => $this->session->userdata('USER_ID')
		);
	    
	   $paramsNew = array(
		array('name'=>':P_AR_CODE', 'value'=>$data_cityarea['AR_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_AR_DESC', 'value'=>$data_cityarea['AR_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_AR_LATITUDE', 'value'=>$data_cityarea['AR_LATITUDE'],'type'=>SQLT_CHR, 'length'=>300),      
		array('name'=>':P_AR_LONGITUDE', 'value'=>$data_cityarea['AR_LONGITUDE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_CT_CODE', 'value'=>$data_cityarea['AR_CT_CODE'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_AR_ACTIVE_YN', 'value'=>$data_cityarea['AR_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_AR_LANG_CODE', 'value'=>$data_cityarea['AR_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USER_ID', 'value'=>$data_cityarea['AR_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_num', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':p_err_msg', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_CITY_AREA', $paramsNew);
	    $result = array("return_status"=>$return_status
		 ,"error_message"=>$error_message );
	}
	return $result;
	// insert New City Lines End
	//exit;
    }
    public function DeleteCity($id)
    {
       $sql="SELECT * FROM APPS_CITY_AREA where AR_CT_CODE='$id' ";
       $result= $this->db->query($sql)->result_array();
    
       foreach($result as $acaid)
       {
	   $params1 = array(
		array('name'=>':P_AR_CODE', 'value'=>$acaid['AR_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	   $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_CITY_AREA', $params1);
	   $result = array("return_status"=>$return_status
				    ,"error_message"=>$error_message );
       
       }
       $params = array(
	    array('name'=>':P_CT_CODE', 'value'=>$id,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
	    );
       
	 $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_CITY', $params);
	   return $result = array("return_status"=>$return_status
				,"error_message"=>$error_message );
    }
    function CityLines_Delete($id1)
    {
	$params = array(
	    array('name'=>':P_AR_CODE', 'value'=>$id1,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
	    );
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_CITY_AREA', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message );
    }  
    //CIty model End
	    
 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CITY MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 
 
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  REGION MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
	    
    //Region Master Start
	
    public function ViewRegionMaster()
    {
	$sql="SELECT * FROM APPS_REGION_HEAD  ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetRegionHead($code)
    {
	$sql="SELECT * FROM APPS_REGION_HEAD where RGH_CODE='$code'  ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetRegionHeadLine($code)
    {
	$sql="SELECT * FROM APPS_REGION_LINES where RGL_RGH_CODE='$code' ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetGeoType()
    {
	 $sql="SELECT * FROM APPS_VALUE_SET_LINES where VSL_VSH_CODE='APPS_REGION' ORDER BY VSL_DESC ASC ";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    public function GetAddress($cnt)
    {   //ORDER BY CN_DESC ASC
	if($cnt=='Country')
	{
	    $sql="SELECT * FROM APPS_COUNTRY  ORDER BY CN_DESC ASC  ";
	    return $query = $this->db->query($sql)->result_array();
	}
	else  if($cnt=='State')
	{
	    $sql="SELECT * FROM APPS_STATE  ORDER BY ST_DESC ASC  ";
	    return$query = $this->db->query($sql)->result_array();
	}
	else
	{
	    $sql="SELECT * FROM APPS_CITY  ORDER BY CT_DESC ASC  ";
	    return    $query = $this->db->query($sql)->result_array();
	     
	}
    }
    
    public function RegionSave()
    {
	$active=$this->input->post('rgh_active_yn');
	if($active!="Y")
	{
	    $active="N";
	}
	$data = array
	(
	    'RGH_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
	    'RGH_CODE'=>$this->input->post('rgh_code'),
	    'RGH_DESC'=>$this->input->post('rgh_desc'),			
	    'RGH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'RGH_ACTIVE_YN'=>$active,
	    'RGH_GEO_TYPE'=>$this->input->post('rgh_geo_type'),			
	    'RGH_CR_UID'=>$this->session->userdata('USER_ID'),
	);
	$params = array(
	    array('name'=>':P_RGH_COMP_CODE','value'=>$data['RGH_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RGH_CODE','value'=>$data['RGH_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_RGH_DESC','value'=>$data['RGH_DESC'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_RGH_GEO_TYPE','value'=>$data['RGH_GEO_TYPE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RGH_ACTIVE_YN','value'=>$data['RGH_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RGH_LANG_CODE','value'=>$data['RGH_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data['RGH_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_REGION_HEAD', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//echo "<pre>";
	//print_r($params);
	//echo "</pre>";
	
	$add=count($this->input->post('RegionMenu'));
	for($i=0;$i<$add;$i++)
	{
	    $m=0;$n=1;
	    $RegionMenu[]=explode(",",$_POST['RegionMenu'][$i]);
		
		$data2= array
		(
		    'RGL_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		    'RGL_RGH_CODE'=>$this->input->post('rgh_code'),
		    'RGL_CODE'=>$RegionMenu[$i][$m],
		    'RGL_DESC'=>$RegionMenu[$i][$n],
		    'RGL_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		    'RGL_ACTIVE_YN'=>$_POST['RGL_ACTIVE_YN1'][$i],
		    'RGL_CR_UID'=>$this->session->userdata('USER_ID'),
		    'RGL_CR_DT'=>'12-MAR-15' ,
		    'RGL_UPD_UID'=>'12' ,
		    'RGL_UPD_DT'=>'12-MAR-19', 
		);
	     
		$params1 = array(
		    array('name'=>':P_RGL_COMP_CODE','value'=>$data2['RGL_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_RGL_RGH_CODE','value'=>$data2['RGL_RGH_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
		    array('name'=>':P_RGL_CODE','value'=>$data2['RGL_CODE'],'type'=>SQLT_CHR, 'length'=>300),      
		    array('name'=>':P_RGL_DESC','value'=>$data2['RGL_DESC'],'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_RGL_ACTIVE_YN','value'=>$data2['RGL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_RGL_LANG_CODE','value'=>$data2['RGL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_USER_ID','value'=>$data2['RGL_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
		
		$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_REGION_LINES', $params1);
		$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    //echo "<pre>";
	    //echo $add;
	    //print_r($params1);
	    //echo "</pre>"; 
		    
	}
	//exit;
       return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
       
	    
    }
    
    function UpdateRegion($code)
    {
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$rgh_comp_code=$this->input->post('rgh_comp_code');
	$active=$this->input->post('rgh_active_yn');
	if($active!="Y")
	{
	    $active="N";
	}
	$data = array
	(
	    'RGH_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
	    'RGH_CODE'=>$this->input->post('rgh_code'),
	    'RGH_DESC'=>$this->input->post('rgh_desc'),			
	    'RGH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'RGH_ACTIVE_YN'=>$active,
	    'RGH_GEO_TYPE'=>$this->input->post('rgh_geo_type_old'),			
	    'RGH_CR_UID'=>$this->session->userdata('USER_ID'),
	    'RGH_UPD_UID'=>$this->session->userdata('USER_ID'),
	    
	);
	$params = array(
	    array('name'=>':P_RGH_COMP_CODE','value'=>$data['RGH_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RGH_CODE','value'=>$data['RGH_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_RGH_DESC','value'=>$data['RGH_DESC'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_RGH_GEO_TYPE','value'=>$data['RGH_GEO_TYPE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RGH_ACTIVE_YN','value'=>$data['RGH_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RGH_LANG_CODE','value'=>$data['RGH_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data['RGH_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_REGION_HEAD', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//echo '<pre>';
	//print_r($params);
	//echo '</pre>';
	//echo $error_message;
	      
	      //Update Region Head...
	      
	$count=$this->input->post('count');
	//echo $count;
	//exit;
	if($count > 0)
	{
	    $add=count($this->input->post('RGL_ACTIVE_YN2'));
	    echo $add."old";
	   
	    for($i=0;$i<$add;$i++)
	    {
		$m=0;$n=1;
		$RegionMenu[]=explode(",",$_POST['RegionMenu1'][$i]);
		    
		    $data2= array
		    (
			'RGL_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
			'RGL_RGH_CODE'=>$this->input->post('rgh_code'),
			'RGL_CODE'=>$RegionMenu[$i][$m],
			'RGL_DESC'=>$RegionMenu[$i][$n],
			'RGL_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
			'RGL_ACTIVE_YN'=>$_POST['RGL_ACTIVE_YN2'][$i],
			'RGL_CR_UID'=>$this->session->userdata('USER_ID'),
			'RGL_CR_DT'=>'12-MAR-15' ,
			'RGL_UPD_UID'=>'12' ,
			'RGL_UPD_DT'=>'12-MAR-19', 
		    );
		 
		    $params1 = array(
			array('name'=>':P_RGL_COMP_CODE','value'=>$data2['RGL_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
			array('name'=>':P_RGL_RGH_CODE','value'=>$data2['RGL_RGH_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
			array('name'=>':P_RGL_CODE','value'=>$data2['RGL_CODE'],'type'=>SQLT_CHR, 'length'=>300),      
			array('name'=>':P_RGL_DESC','value'=>$data2['RGL_DESC'],'type'=>SQLT_CHR, 'length'=>300),
			array('name'=>':P_RGL_ACTIVE_YN','value'=>$data2['RGL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
			array('name'=>':P_RGL_LANG_CODE','value'=>$data2['RGL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
			array('name'=>':P_USER_ID','value'=>$data2['RGL_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
			array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
			array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
		    
		    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_REGION_LINES', $params1);
		    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
		    //
		    //echo "<pre>";
		    //print_r($params1);
		    //print_r($RegionMenu);
		    //echo "</pre>";
	    }
	}
	$add1=count($this->input->post('RGL_ACTIVE_YN4'));
	
	//echo $add1."additional";
	
	for($i=0;$i<$add1-1;$i++)
	{
	    $m=0;$n=1;
	    $RegionMenu1[]=explode(",",$_POST['RegionMenu'][$i]);
		
		$data3= array
		(
		    'RGL_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		    'RGL_RGH_CODE'=>$this->input->post('rgh_code'),
		    'RGL_CODE'=>$RegionMenu1[$i][$m],
		    'RGL_DESC'=>$RegionMenu1[$i][$n],
		    'RGL_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		    'RGL_ACTIVE_YN'=>$_POST['RGL_ACTIVE_YN4'][$i],
		    'RGL_CR_UID'=>$this->session->userdata('USER_ID'),
		    'RGL_CR_DT'=>'12-MAR-15' ,
		    'RGL_UPD_UID'=>'12' ,
		    'RGL_UPD_DT'=>'12-MAR-19', 
		);
	     
		$params2 = array(
		    array('name'=>':P_RGL_COMP_CODE','value'=>$data3['RGL_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_RGL_RGH_CODE','value'=>$data3['RGL_RGH_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
		    array('name'=>':P_RGL_CODE','value'=>$data3['RGL_CODE'],'type'=>SQLT_CHR, 'length'=>300),      
		    array('name'=>':P_RGL_DESC','value'=>$data3['RGL_DESC'],'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_RGL_ACTIVE_YN','value'=>$data3['RGL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_RGL_LANG_CODE','value'=>$data3['RGL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_USER_ID','value'=>$data3['RGL_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
		
		$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_REGION_LINES', $params2);
		$result = array("return_status"=>$return_status,"error_message"=>$error_message);
		
		//echo "<pre>";
		//echo "Additional add";
		//print_r($params2);
		//print_r($RegionMenu1);
		//echo count($_POST['RegionMenu']);
		//echo "</pre>";
	}
	//exit;
	return array("return_status"=>$return_status,"error_message"=>$error_message);
    }
	
    function getRegion()
    {
	$sql="SELECT * FROM APPS_REGION_HEAD";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function DeleteRegionMaster($id)
    {
	$c_code=$this->session->userdata('USER_COMP_CODE');
	$sql="SELECT * FROM APPS_REGION_LINES WHERE RGL_RGH_CODE='$id' AND RGL_COMP_CODE='$c_code'" ;
	$res= $this->db->query($sql)->result_array();
	
	foreach($res as $rglcode)
	{
	    $params1 = array(
		array('name'=>':P_RGL_COMP_CODE', 'value'=>$this->session->userdata('USER_COMP_CODE'),'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_RGL_RGH_CODE', 'value'=> $id , 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_RGL_CODE', 'value'=>$rglcode['RGL_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID', 'value'=>$c_code, 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	    
	    $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_REGION_LINES', $params1);
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	}
      
      
	$params = array(
	    array('name'=>':P_RGH_COMP_CODE', 'value'=> $this->session->userdata('USER_COMP_CODE'),'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RGH_CODE', 'value'=>$id, 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
	    );
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_REGION_HEAD', $params);
	return $result1 = array("return_status"=>$return_status,"error_message"=>$error_message );
    }
    
    public function DeleteRegionLine($id1,$id2)
    {
	$params1 = array(
	    array('name'=>':P_RGL_COMP_CODE', 'value'=>$this->session->userdata('USER_COMP_CODE'),'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RGL_RGH_CODE', 'value'=> $id2 , 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RGL_CODE', 'value'=>$id1,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
	  );
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_REGION_LINES', $params1);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
	    
    //Region Master End
    
   //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  REGION MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  USER DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     
    
    //userdefinition
    
    private function set_upload_options()
    {   
	//upload an image options
	$config = array();
	$config['upload_path'] = 'upload/Apps/UserDefinition';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;
	return $config;
    }
    
    public function FetchUserDefinition()
    {
	 $sql="SELECT * FROM APPS_USER ORDER BY USER_DESC ASC";
	    return $this->db->query($sql, $return_object = TRUE)->result_array();
	return $this->db->get('APPS_USER')->result_array();
    }
    
    public function getResponsibility()
    {
	 $sql="SELECT * FROM APPS_RESP_HEAD ORDER BY RSPH_DESC ASC";
	    return $this->db->query($sql, $return_object = TRUE)->result_array();
	 //return $this->db->get('APPS_RESP_HEAD')->result_array();
    
    }
    
    public function AddUserDefinition()
    {
	
	$url=$config['upload_path'] ='upload/Apps/UserDefinition';
	$config['allowed_types'] = 'gif|jpg|png';
	$this->load->library('upload', $config);
	$this->upload->do_upload('image');
	$data =  $this->upload->data();
	$path=site_url($url.$data['file_name']);
	
	
	//
	//$cryptKey  = 'gRoONaMarOgokunda';
	//$password=$this->security->xss_clean($this->input->post('user_password'));
	//$qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ),$password, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	//
	
	if($this->input->post('user_active')=="Y")
	$user_active='Y';
	else
	$user_active='N';
	
	$data=array(
	    'USER_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
	    'USER_ID'=>$this->security->xss_clean($this->input->post('user_id')),
	    'USER_DESC'=>$this->security->xss_clean($this->input->post('user_desc')),
	    'USER_PERS_CODE'=>$this->security->xss_clean($this->input->post('user_pers_code')),
	    'USER_PASSWD'=>md5($this->input->post('user_password')),
	    'USER_PW_CHANGE_YN'=>$this->security->xss_clean($this->input->post('change_password')),
	    'USER_EMAIL'=>$this->security->xss_clean($this->input->post('user_email')),
	    'USER_OFFICE_PHONE'=>$this->security->xss_clean($this->input->post('user_office_phone')),
	    'USER_HOME_PHONE'=>$this->security->xss_clean($this->input->post('user_home_phone')),
	    'USER_CELL_PHONE'=>$this->security->xss_clean($this->input->post('user_cell_phone')),
	    //'USER_IMAGE_BLOB'=>$path,
	    'USER_IMAGE_FILE'=>$data['file_name'],
	    'USER_FROM_DT'=>$this->security->xss_clean($this->input->post('from_data')),
	    'USER_UPTO_DT'=>$this->security->xss_clean($this->input->post('user_upto_dt')),
	    'USER_LOGIN_FROM'=>$this->security->xss_clean($this->input->post('login_from_dt')),
	    'USER_LOGIN_UPTO'=>$this->security->xss_clean($this->input->post('user_upto_dt')),
	    'USER_ACTIVE_YN'=>$this->security->xss_clean($user_active),
	    'USER_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'USER_CR_UID'=>$this->session->userdata('USER_ID'),
	    'USER_LOCN_CODE'=>$this->session->userdata('COMP_CN_CODE'),
	    'USER_CR_DT'=>'11-MAR-15',
	    'USER_UPD_UID'=>'USER1',
	    'USER_UPD_DT'=>'11-MAR-15'
		    
		    );
	
	$params = array(
	    array('name'=>':P_USER_COMP_CODE','value'=>$data['USER_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$data['USER_ID'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_USER_DESC','value'=>$data['USER_DESC'],'type'=>SQLT_CHR, 'length'=>300), 
	    array('name'=>':P_USER_PERS_CODE','value'=>$data['USER_PERS_CODE'], 'type'=>SQLT_CHR,'length'=>300),     
	    array('name'=>':P_USER_PASSWD','value'=>$data['USER_PASSWD'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_PW_CHANGE_YN','value'=>$data['USER_PW_CHANGE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_EMAIL','value'=>$data['USER_EMAIL'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_OFFICE_PHONE','value'=>$data['USER_OFFICE_PHONE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_HOME_PHONE','value'=>$data['USER_HOME_PHONE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_USER_CELL_PHONE','value'=>$data['USER_CELL_PHONE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_IMAGE_FILE','value'=>$data['USER_IMAGE_FILE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_FROM_DT','value'=>$data['USER_FROM_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_UPTO_DT','value'=>$data['USER_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ACTIVE_YN','value'=>$data['USER_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_LANG_CODE','value'=>$data['USER_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID_UI','value'=>$data['USER_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_LOCN_CODE','value'=>$data['USER_LOCN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_USER',$params );
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
	
	$count=count($this->input->post('responsibility'));
	for($i=0;$i<$count;$i++)
	{
	    $data2=array(
		'USRS_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		'USRS_ID'=>$this->security->xss_clean($this->input->post('user_id')),
		'USRS_RESP_CODE'=>$_POST['responsibility'][$i],
		'USRS_DESC'=>$_POST['Description'][$i],
		'USRS_FROM_DT'=>$_POST['from_date_res'][$i],
		'USRS_UPTO_DT'=> $_POST['upto_date_res'][$i],
		'USRS_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'USRS_ACTIVE_YN'=> $_POST['user_active_status1'][$i],
		'USRS_CR_UID'=>$this->session->userdata('USER_ID'),
		'USRS_CR_DT'=>'12-mar-15',
		'USRS_UPD_UID'=>'user1',
		'USRS_UPD_DT'=>'12-mar-15',
		);

	    $params2 = array(
		array('name'=>':P_USRS_COMP_CODE','value'=>$data2['USRS_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$data2['USRS_ID'], 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_USRS_RESP_CODE','value'=>$data2['USRS_RESP_CODE'],'type'=>SQLT_CHR, 'length'=>300), 
		array('name'=>':P_USRS_DESC','value'=>$data2['USRS_DESC'], 'type'=>SQLT_CHR,'length'=>300),     
		array('name'=>':P_USRS_FROM_DT','value'=>$data2['USRS_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_UPTO_DT','value'=>$data2['USRS_UPTO_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_LANG_CODE','value'=>$data2['USRS_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USRS_ACTIVE_YN','value'=>$data2['USRS_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID_UI','value'=>$data2['USRS_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_USER_RESP',$params2 );
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	}
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
    }
    
    public function EditUser($id)
    {
	$sql="SELECT * FROM APPS_USER WHERE USER_ID='$id' " ;
	return $this->db->query($sql)->result_array();
    
    }
    public function EditUserResp($id)
    {
	$sql="SELECT * FROM APPS_USER_RESP WHERE USRS_ID='$id'" ;
	return $this->db->query($sql)->result_array();
    }
    public function UpdateUserData($id)
    {
	if($_FILES['image']['name']=="")
    	{
    	    $path=$this->input->post('getimage');
	}	
	else
	{
	    $url=$config['upload_path'] ='upload/Apps/UserDefinition';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $this->load->library('upload', $config);
	    $r=$this->upload->do_upload('image');
	    $data =  $this->upload->data();
	    $path=$data['file_name'];
	}
	
	$pass=$this->input->post('user_password');
	$passNew=$this->input->post('user_password1');
	$passOLd=$this->input->post('oldUSerPassword');
	if($pass==$passNew)
	{
	    $currentPass=$passOLd;
	}
	else
	{
	    $currentPass=md5($pass);
	}
	
	if($this->input->post('user_active')=="Y")
	$user_active='Y';
	else
	$user_active='N';
	
	$data=array(
	    'USER_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
	    'USER_ID'=>$this->security->xss_clean($this->input->post('user_id')),
	    'USER_DESC'=>$this->security->xss_clean($this->input->post('user_desc')),
	    'USER_PERS_CODE'=>$this->security->xss_clean($this->input->post('user_pers_code')),
	    'USER_PASSWD'=>$currentPass,
	    'USER_PW_CHANGE_YN'=>$this->security->xss_clean($this->input->post('change_password')),
	    'USER_EMAIL'=>$this->security->xss_clean($this->input->post('user_email')),
	    'USER_OFFICE_PHONE'=>$this->security->xss_clean($this->input->post('user_office_phone')),
	    'USER_HOME_PHONE'=>$this->security->xss_clean($this->input->post('user_home_phone')),
	    'USER_CELL_PHONE'=>$this->security->xss_clean($this->input->post('user_cell_phone')),
	    'USER_IMAGE_FILE'=>$path,
	    'USER_FROM_DT'=>$this->security->xss_clean($this->input->post('user_from_dt')),
	    'USER_UPTO_DT'=>$this->security->xss_clean($this->input->post('user_upto_dt')),
	    'USER_LOGIN_FROM'=>$this->security->xss_clean($this->input->post('login_from_dt')),
	    'USER_LOGIN_UPTO'=>$this->security->xss_clean($this->input->post('login_upto_dt')),
	    'USER_ACTIVE_YN'=>$this->security->xss_clean($user_active),
	    'USER_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'USER_CR_UID'=>$this->session->userdata('USER_ID'),
	    'USER_LOCN_CODE'=>'145',
	    'USER_CR_DT'=>'11-MAR-15',
	    'USER_UPD_UID'=>'USER1',
	    'USER_UPD_DT'=>'11-MAR-15'
	    );
	//if($this->security->xss_clean($this->input->post('user_password'))!="")
	//{
	//    $password=md5($this->security->xss_clean($this->input->post('user_password')));
	//}
	//else
	//{
	//    $password=$this->security->xss_clean($this->input->post('user_password1'));
	//}
	$params = array(
	    array('name'=>':P_USER_COMP_CODE','value'=>$data['USER_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$data['USER_ID'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_USER_DESC','value'=>$data['USER_DESC'],'type'=>SQLT_CHR, 'length'=>300), 
	    array('name'=>':P_USER_PERS_CODE','value'=>$data['USER_PERS_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_PASSWD','value'=>$currentPass,'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_PW_CHANGE_YN','value'=>$data['USER_PW_CHANGE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_EMAIL','value'=>$data['USER_EMAIL'], 'type'=>SQLT_CHR,'length'=>300),
	    
	    array('name'=>':P_USER_OFFICE_PHONE','value'=>$data['USER_OFFICE_PHONE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_HOME_PHONE','value'=>$data['USER_HOME_PHONE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_USER_CELL_PHONE','value'=>$data['USER_CELL_PHONE'],'type'=>SQLT_CHR, 'length'=>300),      
	    
	    array('name'=>':P_USER_IMAGE_FILE','value'=>$data['USER_IMAGE_FILE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_FROM_DT','value'=>$data['USER_FROM_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_UPTO_DT','value'=>$data['USER_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ACTIVE_YN','value'=>$data['USER_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_LANG_CODE','value'=>$data['USER_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID_UI','value'=>$data['USER_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_LOCN_CODE','value'=>$data['USER_LOCN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	   
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_USER',$params );
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//echo "<pre>";
	//print_r($params);
	//echo "<pre>";
	//echo $error_message;
		
	//if($this->input->post('user_active_status1')!="")
	//{
	//    print_r($this->input->post('user_active_status1'));
	//    $count=count($this->input->post('user_active_status1'));
	//}
	//else
	//{
	//    $count=0;
	//}
	if($this->input->post('userRespCount')>0)
	{
	    $count=$this->input->post('userRespCount');
	}
	else{
	    $count=0;
	}
	for($i=0;$i<$count;$i++)
	{
	    $data2=array(
		'USRS_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		'USRS_ID'=>$this->security->xss_clean($this->input->post('user_id')),
		'USRS_RESP_CODE_OLD'=>$_POST['old_responsibility'][$i],
		'USRS_RESP_CODE'=>$_POST['responsibility'][$i],
		'USRS_DESC'=>$_POST['Description'][$i],
		'USRS_FROM_DT'=>$_POST['from_date_res'][$i],
		'USRS_UPTO_DT'=> $_POST['upto_date_res'][$i],
		'USRS_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'USRS_ACTIVE_YN'=>$_POST['user_active_status1'][$i],
		'USRS_CR_UID'=>$this->session->userdata('USER_ID'),
		);
	    
	    $params2 = array(
		array('name'=>':P_USRS_COMP_CODE','value'=>$data2['USRS_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$data2['USRS_ID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USRS_RESP_CODE_OLD','value'=>$data2['USRS_RESP_CODE_OLD'],'type'=>SQLT_CHR, 'length'=>300), 
		array('name'=>':P_USRS_RESP_CODE_NEW','value'=>$data2['USRS_RESP_CODE'],'type'=>SQLT_CHR, 'length'=>300), 
		array('name'=>':P_USRS_DESC','value'=>$data2['USRS_DESC'], 'type'=>SQLT_CHR,'length'=>300),     
		array('name'=>':P_USRS_FROM_DT','value'=>$data2['USRS_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_UPTO_DT','value'=>$data2['USRS_UPTO_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_LANG_CODE','value'=>$data2['USRS_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USRS_ACTIVE_YN','value'=>$data2['USRS_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID_UI','value'=>$data2['USRS_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_USER_RESP',$params2 );
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    //echo"<pre>";
	    //echo $count;
	    //print_r($params2);
	    //echo"</pre>";
	    //echo "<br><br><br>";
	    //echo "<br><br><br> END";
	}
	
	
	$count1=count($this->input->post('user_active_status2'));
	//echo  $count;
	//echo  $count1;
	for($i=0;$i<$count1-1;$i++)
	{
	    $data3=array(
		'USRS_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		'USRS_ID'=>$this->security->xss_clean($this->input->post('user_id')),
		'USRS_RESP_CODE'=>$_POST['responsibility'][$count+$i],
		'USRS_DESC'=>$_POST['Description'][$count+$i],
		'USRS_FROM_DT'=>$_POST['from_date_res'][$count+$i],
		'USRS_UPTO_DT'=> $_POST['upto_date_res'][$count+$i],
		'USRS_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'USRS_ACTIVE_YN'=>$_POST['user_active_status2'][$i],
		'USRS_CR_UID'=>$this->session->userdata('USER_ID'),
		);
	    $params3 = array(
		array('name'=>':P_USRS_COMP_CODE','value'=>$data3['USRS_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$data3['USRS_ID'], 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_USRS_RESP_CODE','value'=>$data3['USRS_RESP_CODE'],'type'=>SQLT_CHR, 'length'=>300), 
		array('name'=>':P_USRS_DESC','value'=>$data3['USRS_DESC'], 'type'=>SQLT_CHR,'length'=>300),     
		array('name'=>':P_USRS_FROM_DT','value'=>$data3['USRS_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_UPTO_DT','value'=>$data3['USRS_UPTO_DT'],'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USRS_LANG_CODE','value'=>$data3['USRS_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_USRS_ACTIVE_YN','value'=>$data3['USRS_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID_UI','value'=>$data3['USRS_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_USER_RESP',$params3 );
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    //echo"<pre>";
	    //print_r($params3);
	    //echo"</pre>";
	}
	
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//print_r($result);
	//exit;
    }
    
    public function DeleteUserDef($id1, $id2)
    {
	$sql="SELECT * FROM APPS_USER_RESP WHERE USRS_ID='$id1' AND USRS_COMP_CODE='$id2'  ";
	$result= $this->db->query($sql)->result_array();
	foreach($result as $acaid)
	{
	    $params2 = array(
		array('name'=>':P_USRS_COMP_CODE','value'=>$id2,'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$id1, 'type'=>SQLT_CHR,'length'=>300), 
		array('name'=>':P_USRS_RESP_CODE','value'=>$acaid['USRS_RESP_CODE'],'type'=>SQLT_CHR, 'length'=>300), 
		array('name'=>':P_USER_ID_UI','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_USER_RESP',$params2 );
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	}
	$params21 = array(
	    array('name'=>':P_USRS_COMP_CODE','value'=>$id2,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$id1, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID_UI','value'=>$data2['USRS_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_USER',$params21 );
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    public function DeleteUserResp($id1,$id2,$id3)
    {
	$params2 = array(
	    array('name'=>':P_USRS_COMP_CODE','value'=>$id1,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$id2, 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_USRS_RESP_CODE','value'=>$id3,'type'=>SQLT_CHR, 'length'=>300), 
	    array('name'=>':P_USER_ID_UI','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_USER_RESP',$params2 );
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    //end
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  USER DEFINITION  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      
      
      
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  RESPONSIBILITY DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
   
   
    
    
//  ResponsibilityDefinition start
           
    public function ViewResponsibilityDefinition()
    {
	$sql="SELECT * FROM APPS_RESP_HEAD";
	return $this->db->query($sql)->result_array();
    }
    
    public function GetMenuDiscription()
    {
	$sql="SELECT * FROM APPS_MENU ORDER BY MENU_DESC ASC  ";
	return $this->db->query($sql)->result_array();
    }
    
    public function AddResponsibilityDefinition()
    {
	
	if($this->input->post('active')=="Y")
	$active='Y';
	else
	$active='N';
	
	$data1 = array(
	    'RSPH_CODE' => $this->security->xss_clean($this->input->post('rsph_code')),
	    'RSPH_DESC' => $this->security->xss_clean($this->input->post('rsph_desc')),
	    'RSPH_FROM_DT' => $this->security->xss_clean($this->input->post('rsph_from_date')),
	    'RSPH_UPTO_DT' => $this->security->xss_clean($this->input->post('rsph_to_date')),
	    'RSPH_ACTIVE_YN' => $this->security->xss_clean($active),
	    'RSPH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'RSPH_CR_UID'=>$this->session->userdata('USER_ID'),
	    'RSPH_CR_DT'=>'',
	    'RSPH_UPD_UID'=>'',
	    'RSPH_UPD_DT'=>'',
			
		    );
	$params = array(
	    array('name'=>':P_RSPH_CODE','value'=>$data1['RSPH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RSPH_DESC','value'=>$data1['RSPH_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_RSPH_FROM_DT','value'=>$data1['RSPH_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_RSPH_UPTO_DT','value'=>$data1['RSPH_UPTO_DT'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RSPH_ACTIVE_YN','value'=>$data1['RSPH_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RSPH_LANG_CODE','value'=>$data1['RSPH_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data1['RSPH_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_RESP_HEAD', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
       //Responsibility lines adding
       
	$add=count($this->input->post('menu'));
	echo $add."total";
	for($i=0;$i<$add;$i++)
	{
	    $approve= $this->security->xss_clean($this->input->post('approve'));
	   
	    if($approve!='Y')
	    {
	       $approve='N';
	    }
	    
	    $data2=array (
		'RSPL_RSPH_CODE' => $this->security->xss_clean($this->input->post('rsph_code')),
		'RSPL_MENU_CODE' => $_POST['menu'][$i],
		'RSPL_INSERT_YN' => $_POST['insert1'][$i],
		'RSPL_UPDATE_YN' =>$_POST['update1'][$i],
		'RSPL_DELETE_YN' => $_POST['delete1'][$i],
		'RSPL_PRINT_YN ' => $_POST['print1'][$i],
		'RSPL_EXPORT_YN' => $_POST['export1'][$i],
		'RSPL_FROM_DT' =>$_POST['from_date'][$i],
		'RSPL_UPTO_DT' => $_POST['to_date'][$i],
		'RSPL_ACTIVE_YN' => $_POST['active_line1'][$i],
		'RSPL_APPROVE_YN'=>$approve,
		'RSPL_APR_VAL_FROM' => $_POST['approve_from_date'][$i],
		'RSPL_APR_VAL_UPTO' => $_POST['approve_to_date'][$i],
		'RSPL_AMEND_YN' =>$_POST['amend1'][$i],
		'RSPL_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'RSPL_CR_UID' => $this->session->userdata('USER_ID'),
		'RSPL_CR_DT' => '',
		'RSPL_UPD_UID' => '',
		'RSPL_UPD_DT' => ''
		);
	    $params1 = array(
		array('name'=>':P_RSPL_RSPH_CODE','value'=>$data2['RSPL_RSPH_CODE'],'type'=>SQLT_CHR, 'length'=>3000 ),
		array('name'=>':P_RSPL_MENU_CODE','value'=>$data2['RSPL_MENU_CODE'], 'type'=>SQLT_CHR,'length'=>3000), 
		array('name'=>':P_RSPL_INSERT_YN','value'=>$data2['RSPL_INSERT_YN'],'type'=>SQLT_CHR, 'length'=>3000),      
		array('name'=>':P_RSPL_UPDATE_YN','value'=>$data2['RSPL_UPDATE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_DELETE_YN','value'=>$data2['RSPL_DELETE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_PRINT_YN','value'=> $_POST['print1'][$i], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_EXPORT_YN','value'=>$data2['RSPL_EXPORT_YN'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_APPROVE_YN','value'=>$data2['RSPL_APPROVE_YN'],'type'=>SQLT_CHR, 'length'=>3000 ),
		array('name'=>':P_RSPL_APR_VAL_FROM','value'=>$data2['RSPL_APR_VAL_FROM'], 'type'=>SQLT_CHR,'length'=>3000), 
		array('name'=>':P_RSPL_APR_VAL_UPTO','value'=>$data2['RSPL_APR_VAL_UPTO'],'type'=>SQLT_CHR, 'length'=>3000),      
		array('name'=>':P_RSPL_AMEND_YN','value'=>$data2['RSPL_AMEND_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_FROM_DT','value'=>$data2['RSPL_FROM_DT'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_UPTO_DT','value'=>$data2['RSPL_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_ACTIVE_YN','value'=>$data2['RSPL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPH_LANG_CODE','value'=>$data2['RSPL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_USER_ID','value'=>$data2['RSPL_CR_UID'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>3000));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_RESP_LINES', $params1);
	     
	    
	}
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    public function EditResponsibilityDefinition($id)
    {
	
	$sql="SELECT * FROM APPS_RESP_HEAD where RSPH_CODE='$id' ";
	return $this->db->query($sql)->result_array();
    }
    
    public function GetAppsRespLines($id){
	
	 
	$sql="SELECT * FROM APPS_RESP_LINES where RSPL_RSPH_CODE='$id' ";
	return $this->db->query($sql)->result_array();
    }
    
    public function UpdateResponsibilityDefinition($id)
    {
	if($this->input->post('active')=="Y")
	$active='Y';
	else
	$active='N';
	
	
	$data1 = array(
	    'RSPH_CODE' => $this->security->xss_clean($this->input->post('rsph_code')),
	    'RSPH_DESC' => $this->security->xss_clean($this->input->post('rsph_desc')),
	    'RSPH_FROM_DT' => $this->security->xss_clean($this->input->post('rsph_from_date')),
	    'RSPH_UPTO_DT' => $this->security->xss_clean($this->input->post('rsph_to_date')),
	    'RSPH_ACTIVE_YN' => $this->security->xss_clean($active),
	    'RSPH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'RSPH_CR_UID'=>$this->session->userdata('USER_ID'),
	    );

	
	$params = array(
	    array('name'=>':P_RSPH_CODE','value'=>$data1['RSPH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RSPH_DESC','value'=>$data1['RSPH_DESC'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_RSPH_FROM_DT','value'=>$data1['RSPH_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),      
	    array('name'=>':P_RSPH_UPTO_DT','value'=>$data1['RSPH_UPTO_DT'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RSPH_ACTIVE_YN','value'=>$data1['RSPH_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_RSPH_LANG_CODE','value'=>$data1['RSPH_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data1['RSPH_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_RESP_HEAD', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//update Apps Responsibiluity Head
	
	$add=count($this->input->post('from_date'));
	
	if($this->input->post('userRespCount')>0)
	{
	    $add=$this->input->post('userRespCount');
	}
	else{
	    $add=0;
	}
	
	//echo $add;
	//exit;
	for($i=0;$i<$add;$i++)
	{
	    $approve= $this->security->xss_clean($this->input->post('approve'));
	   
	    if($approve!='Y')
	    {
	       $approve='N';
	    }
	    
	    $data2=array (
		'RSPL_RSPH_CODE' => $this->security->xss_clean($this->input->post('rsph_code')),
		'RSPL_MENU_CODE' => $_POST['menu_old'][$i],
		'RSPL_INSERT_YN' => $_POST['insert1'][$i],
		'RSPL_UPDATE_YN' =>$_POST['update1'][$i],
		'RSPL_DELETE_YN' => $_POST['delete1'][$i],
		'RSPL_PRINT_YN ' => $_POST['print1'][$i],
		'RSPL_EXPORT_YN' => $_POST['export1'][$i],
		'RSPL_FROM_DT' =>$_POST['from_date'][$i],
		'RSPL_UPTO_DT' => $_POST['to_date'][$i],
		'RSPL_ACTIVE_YN' => $_POST['active_line1'][$i],
		'RSPL_APPROVE_YN'=>$approve,
		'RSPL_APR_VAL_FROM' => $_POST['approve_from_date'][$i],
		'RSPL_APR_VAL_UPTO' => $_POST['approve_to_date'][$i],
		'RSPL_AMEND_YN' =>$_POST['amend1'][$i],
		'RSPL_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		'RSPL_CR_UID' => $this->session->userdata('USER_ID'),
		'RSPL_CR_DT' => '',
		'RSPL_UPD_UID' => '',
		'RSPL_UPD_DT' => ''
		);
	    $params1 = array(
		array('name'=>':P_RSPL_RSPH_CODE','value'=>$data2['RSPL_RSPH_CODE'],'type'=>SQLT_CHR, 'length'=>3000 ),
		array('name'=>':P_RSPL_MENU_CODE','value'=>$data2['RSPL_MENU_CODE'], 'type'=>SQLT_CHR,'length'=>3000), 
		array('name'=>':P_RSPL_INSERT_YN','value'=>$data2['RSPL_INSERT_YN'],'type'=>SQLT_CHR, 'length'=>3000),      
		array('name'=>':P_RSPL_UPDATE_YN','value'=>$data2['RSPL_UPDATE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_DELETE_YN','value'=>$data2['RSPL_DELETE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_PRINT_YN','value'=> $_POST['print1'][$i], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_EXPORT_YN','value'=>$data2['RSPL_EXPORT_YN'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_APPROVE_YN','value'=>$data2['RSPL_APPROVE_YN'],'type'=>SQLT_CHR, 'length'=>3000 ),
		array('name'=>':P_RSPL_APR_VAL_FROM','value'=>$data2['RSPL_APR_VAL_FROM'], 'type'=>SQLT_CHR,'length'=>3000), 
		array('name'=>':P_RSPL_APR_VAL_UPTO','value'=>$data2['RSPL_APR_VAL_UPTO'],'type'=>SQLT_CHR, 'length'=>3000),      
		array('name'=>':P_RSPL_AMEND_YN','value'=>$data2['RSPL_AMEND_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_FROM_DT','value'=>$data2['RSPL_FROM_DT'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPL_UPTO_DT','value'=>$data2['RSPL_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_RSPL_ACTIVE_YN','value'=>$data2['RSPL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		array('name'=>':P_RSPH_LANG_CODE','value'=>$data2['RSPL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_USER_ID','value'=>$data2['RSPL_CR_UID'], 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>3000),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>3000));
	    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_RESP_LINES', $params1);
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    //echo"<pre>";
	    //echo $add;
	    //print_r($params1);
	    //echo"</pre>";
	    
	}
	
	//$val=$this->input->post('from_date1');
	//if($val==1)
	//{
	    $add1=count($this->input->post('active_line2'));
	    //echo $add;
	    //echo $add1;
	    for($i=0;$i<$add1-1;$i++)
	    {
		$approve= $this->security->xss_clean($this->input->post('approve'));
	       
		if($approve!='Y')
		{
		   $approve='N';
		}
		
		$data3=array (
		    'RSPL_RSPH_CODE' => $this->security->xss_clean($this->input->post('rsph_code')),
		    'RSPL_MENU_CODE' => $_POST['menu'][$i],
		    'RSPL_INSERT_YN' => $_POST['insert2'][$i],
		    'RSPL_UPDATE_YN' =>$_POST['update2'][$i],
		    'RSPL_DELETE_YN' => $_POST['delete2'][$i],
		    'RSPL_PRINT_YN ' => $_POST['print2'][$i],
		    'RSPL_EXPORT_YN' => $_POST['export2'][$i],
		    'RSPL_FROM_DT' =>$_POST['from_date'][$add+$i],
		    'RSPL_UPTO_DT' => $_POST['to_date'][$add+$i],
		    'RSPL_ACTIVE_YN' => $_POST['active_line2'][$i],
		    'RSPL_APPROVE_YN'=>$approve,
		    'RSPL_APR_VAL_FROM' => $_POST['approve_from_date'][$add+$i],
		    'RSPL_APR_VAL_UPTO' => $_POST['approve_to_date'][$add+$i],
		    'RSPL_AMEND_YN' =>$_POST['amend2'][$i],
		    'RSPL_LANG_CODE' =>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
		    'RSPL_CR_UID' => $this->session->userdata('USER_ID'),
		    'RSPL_CR_DT' => '',
		    'RSPL_UPD_UID' => '',
		    'RSPL_UPD_DT' => ''
		    );
		$params2 = array(
		    array('name'=>':P_RSPL_RSPH_CODE','value'=>$data3['RSPL_RSPH_CODE'],'type'=>SQLT_CHR, 'length'=>3000 ),
		    array('name'=>':P_RSPL_MENU_CODE','value'=>$data3['RSPL_MENU_CODE'], 'type'=>SQLT_CHR,'length'=>3000), 
		    array('name'=>':P_RSPL_INSERT_YN','value'=>$data3['RSPL_INSERT_YN'],'type'=>SQLT_CHR, 'length'=>3000),      
		    array('name'=>':P_RSPL_UPDATE_YN','value'=>$data3['RSPL_UPDATE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		    array('name'=>':P_RSPL_DELETE_YN','value'=>$data3['RSPL_DELETE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		    array('name'=>':P_RSPL_PRINT_YN','value'=> $_POST['print2'][$i], 'type'=>SQLT_CHR,'length'=>3000),
		    array('name'=>':P_RSPL_EXPORT_YN','value'=>$data3['RSPL_EXPORT_YN'], 'type'=>SQLT_CHR,'length'=>3000),
		    array('name'=>':P_RSPL_APPROVE_YN','value'=>$data3['RSPL_APPROVE_YN'],'type'=>SQLT_CHR, 'length'=>3000 ),
		    array('name'=>':P_RSPL_APR_VAL_FROM','value'=>$data3['RSPL_APR_VAL_FROM'], 'type'=>SQLT_CHR,'length'=>3000), 
		    array('name'=>':P_RSPL_APR_VAL_UPTO','value'=>$data3['RSPL_APR_VAL_UPTO'],'type'=>SQLT_CHR, 'length'=>3000),      
		    array('name'=>':P_RSPL_AMEND_YN','value'=>$data3['RSPL_AMEND_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		    array('name'=>':P_RSPL_FROM_DT','value'=>$data3['RSPL_FROM_DT'],'type'=>SQLT_CHR, 'length'=>3000),
		    array('name'=>':P_RSPL_UPTO_DT','value'=>$data3['RSPL_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>3000),
		    array('name'=>':P_RSPL_ACTIVE_YN','value'=>$data3['RSPL_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>3000),
		    array('name'=>':P_RSPH_LANG_CODE','value'=>$data3['RSPL_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>3000),
		    array('name'=>':P_USER_ID','value'=>$data3['RSPL_CR_UID'], 'type'=>SQLT_CHR,'length'=>3000),
		    
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>3000),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>3000));
	
		    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_RESP_LINES', $params2);
		    $result = array("return_status"=>$return_status
				,"error_message"=>$error_message);
		//echo"<pre>";
		//echo $add1;
		//print_r($params2);
		//echo"</pre>"; 
		    
	    }
	    return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//}
	//exit;
    } 
    
    public function DeleteResponsibilityDefinition($id)
    {
	
	$sql="SELECT * FROM APPS_RESP_LINES where RSPL_RSPH_CODE='$id' ";
	$result= $this->db->query($sql)->result_array();
 
	foreach($result as $acaid)
	{
	    $params1 = array(
		    array('name'=>':P_RSPL_RSPH_CODE','value'=>$id,'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_RSPL_MENU_CODE','value'=>$acaid['RSPL_MENU_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_RESP_LINES', $params1);
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	}
	$params12 = array(
	    array('name'=>':P_RSPH_CODE','value'=>$id,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_RESP_HEAD', $params12);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    public function DeleteRepsLine($id1,$id2)
    {
	$params1 = array(
	    array('name'=>':P_RSPL_RSPH_CODE','value'=>$id1,'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_RSPL_MENU_CODE','value'=>$id2, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_RESP_LINES', $params1);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    //ResponsibilityDefinition end
	    
    	
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  RESPONSIBILITY DEFINITION  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  MENU DEFINITION  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
  
    
    
    
    
    
    
    // Menu Defination Start------>
    //AUTOR - Rafeeq 
    //CREATED DATE-04-03-2015
    //MODIFIED DATE-18-03-2015
    public function ViewMenu()
    {
	$query=$this->db->get('APPS_MENU');
	return $query->result();
    }
    function get_menu_module(){
	$sql="SELECT * FROM APPS_VALUE_SET_LINES where VSL_VSH_CODE='APPS_MODULE' ORDER BY VSL_DESC ASC";
	return $this->db->query($sql, $return_object = TRUE)->result_array();
    }
    function get_parent_menu(){
	$sql1="SELECT * FROM APPS_MENU ";
	return $this->db->query($sql1, $return_object = TRUE)->result();
    }
    function get_type_menu(){
	$sql="SELECT *  FROM APPS_VALUE_SET_LINES where VSL_VSH_CODE='APPS_MENU'";
	return $this->db->query($sql, $return_object = TRUE)->result();
    }
    public function AddMenu()
    {
	$allow_multi=$this->input->post('MENU_MULTI_INST_YN');
	$active=$this->input->post('MENU_ACTIVE_YN');
	if($active=='on'){
	    $active='Y';
	}
	else{
	    $active='N';
	}
	if($allow_multi=='on'){
	    $allow_multi='Y';
	}
	else{
	    $allow_multi='N';
	}
	$data = array(
	    'MENU_MODULE' =>$this->input->post('MENU_MODULE'),
	    'MENU_CODE' => $this->input->post('MENU_CODE'),
	    'MENU_DESC' => $this->input->post('MENU_DESC'),
	    'MENU_PARENT_CODE' => $this->input->post('MENU_PARENT_CODE'),
	    'MENU_TYPE' => $this->input->post('MENU_TYPE'),
	    'MENU_DISP_SEQ' => $this->input->post('MENU_DISP_SEQ'),
	    'MENU_DEFINITION' =>$this->input->post('MENU_DEFINITION'),
	    'MENU_MULTI_INST_YN' =>$allow_multi,
	    'MENU_TXN_CODE' => $this->input->post('MENU_TXN_CODE'),
	    'MENU_PARA_01' => $this->input->post('MENU_PARA_01'),
	    'MENU_PARA_02' => $this->input->post('MENU_PARA_02'),
	    'MENU_PARA_03' => $this->input->post('MENU_PARA_03'),
	    'MENU_PARA_04' => $this->input->post('MENU_PARA_04'),
	    'MENU_PARA_05' => $this->input->post('MENU_PARA_05'),
	    'MENU_PARA_06' => $this->input->post('MENU_PARA_06'),
	    'MENU_PARA_07' => $this->input->post('MENU_PARA_07'),
	    'MENU_PARA_08' => $this->input->post('MENU_PARA_08'),
	    'MENU_PARA_09' => $this->input->post('MENU_PARA_09'),
	    'MENU_PARA_10' => $this->input->post('MENU_PARA_10'),
	    'MENU_PARA_11' => $this->input->post('MENU_PARA_11'),
	    'MENU_PARA_12' => $this->input->post('MENU_PARA_12'),
	    'MENU_PARA_13' => $this->input->post('MENU_PARA_13'),
	    'MENU_PARA_14' => $this->input->post('MENU_PARA_14'),
	    'MENU_PARA_15' => $this->input->post('MENU_PARA_15'),
	    'MENU_PARA_16' => $this->input->post('MENU_PARA_16'),
	    'MENU_PARA_17' => $this->input->post('MENU_PARA_17'),
	    'MENU_PARA_18' => $this->input->post('MENU_PARA_18'),
	    'MENU_PARA_19' => $this->input->post('MENU_PARA_19'),
	    'MENU_PARA_20' => $this->input->post('MENU_PARA_20'),
	    'MENU_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'MENU_ACTIVE_YN'=>$active,
	    'MENU_FROM_DT'=>$this->input->post('MENU_FROM_DT'),
	    'MENU_UPTO_DT'=>$this->input->post('MENU_UPTO_DT'),
	    'MENU_CR_UID'=>$this->session->userdata('USER_ID'),
	);
	

	
	$params = array(
	    array('name'=>':P_MENU_MODULE','value'=>$data['MENU_MODULE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_MENU_CODE','value'=>$data['MENU_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_MENU_DESC','value'=>$data['MENU_DESC'],'type'=>SQLT_CHR, 'length'=>300), 
	    array('name'=>':P_MENU_PARENT_CODE','value'=>$data['MENU_PARENT_CODE'], 'type'=>SQLT_CHR,'length'=>300),     
	    array('name'=>':P_MENU_TYPE','value'=>$data['MENU_TYPE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_DISP_SEQ','value'=>$data['MENU_DISP_SEQ'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_DEFINITION','value'=>$data['MENU_DEFINITION'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_MENU_MULTI_INST_YN','value'=>$data['MENU_MULTI_INST_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_MENU_TXN_CODE','value'=>$data['MENU_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_MENU_PARA_01','value'=>$data['MENU_PARA_01'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_02','value'=>$data['MENU_PARA_02'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_03','value'=>$data['MENU_PARA_03'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_04','value'=>$data['MENU_PARA_04'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_05','value'=>$data['MENU_PARA_05'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_06','value'=>$data['MENU_PARA_06'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_07','value'=>$data['MENU_PARA_07'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_08','value'=>$data['MENU_PARA_08'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_09','value'=>$data['MENU_PARA_09'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_10','value'=>$data['MENU_PARA_10'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_11','value'=>$data['MENU_PARA_11'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_12','value'=>$data['MENU_PARA_12'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_13','value'=>$data['MENU_PARA_13'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_14','value'=>$data['MENU_PARA_14'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_15','value'=>$data['MENU_PARA_15'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_16','value'=>$data['MENU_PARA_16'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_17','value'=>$data['MENU_PARA_17'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_18','value'=>$data['MENU_PARA_18'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_19','value'=>$data['MENU_PARA_19'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_20','value'=>$data['MENU_PARA_20'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_ACTIVE_YN','value'=>$data['MENU_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_FROM_DT','value'=>$data['MENU_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_UPTO_DT','value'=>$data['MENU_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_LANG_CODE','value'=>$data['MENU_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data['MENU_CR_UID'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_MENU',$params );
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    function EditMenu($menu_code)
    {
	$sql="SELECT *  FROM APPS_MENU where MENU_CODE='$menu_code'";
	return $this->db->query($sql, $return_object = TRUE)->result();
    }
    
    function getParentcode($code)
    {
	$menu_code=explode("-",$code);
	$sql1="SELECT * FROM APPS_MENU where MENU_MODULE='$menu_code[0]' ";
	return $this->db->query($sql1, $return_object = TRUE)->result();
    }
    
    public function UpdateMenu($menu_code)
    {
	
	
	$allow_multi=$this->input->post('MENU_MULTI_INST_YN');
	$active=$this->input->post('MENU_ACTIVE_YN');
	if($active=='on'){
	    $active='Y';
	}
	else{
	    $active='N';
	}
	if($allow_multi=='on'){
	    $allow_multi='Y';
	}
	else
	{
	    $allow_multi='N';
	}
	$data = array(
		      'MENU_MODULE' =>$this->input->post('MENU_MODULE'),
	    'MENU_CODE' => $this->input->post('MENU_CODE'),
	    'MENU_DESC' => $this->input->post('MENU_DESC'),
	    'MENU_PARENT_CODE' => $this->input->post('MENU_PARENT_CODE'),
	    'MENU_TYPE' => $this->input->post('MENU_TYPE'),
	    'MENU_DISP_SEQ' => $this->input->post('MENU_DISP_SEQ'),
	    'MENU_DEFINITION' =>$this->input->post('MENU_DEFINITION'),
	    'MENU_MULTI_INST_YN' =>$allow_multi,
	    'MENU_TXN_CODE' => $this->input->post('MENU_TXN_CODE'),
	    'MENU_PARA_01' => $this->input->post('MENU_PARA_01'),
	    'MENU_PARA_02' => $this->input->post('MENU_PARA_02'),
	    'MENU_PARA_03' => $this->input->post('MENU_PARA_03'),
	    'MENU_PARA_04' => $this->input->post('MENU_PARA_04'),
	    'MENU_PARA_05' => $this->input->post('MENU_PARA_05'),
	    'MENU_PARA_06' => $this->input->post('MENU_PARA_06'),
	    'MENU_PARA_07' => $this->input->post('MENU_PARA_07'),
	    'MENU_PARA_08' => $this->input->post('MENU_PARA_08'),
	    'MENU_PARA_09' => $this->input->post('MENU_PARA_09'),
	    'MENU_PARA_10' => $this->input->post('MENU_PARA_10'),
	    'MENU_PARA_11' => $this->input->post('MENU_PARA_11'),
	    'MENU_PARA_12' => $this->input->post('MENU_PARA_12'),
	    'MENU_PARA_13' => $this->input->post('MENU_PARA_13'),
	    'MENU_PARA_14' => $this->input->post('MENU_PARA_14'),
	    'MENU_PARA_15' => $this->input->post('MENU_PARA_15'),
	    'MENU_PARA_16' => $this->input->post('MENU_PARA_16'),
	    'MENU_PARA_17' => $this->input->post('MENU_PARA_17'),
	    'MENU_PARA_18' => $this->input->post('MENU_PARA_18'),
	    'MENU_PARA_19' => $this->input->post('MENU_PARA_19'),
	    'MENU_PARA_20' => $this->input->post('MENU_PARA_20'),
	    'MENU_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'MENU_ACTIVE_YN'=>$active,
	    'MENU_FROM_DT'=>$this->input->post('MENU_FROM_DT'),
	    'MENU_UPTO_DT'=>$this->input->post('MENU_UPTO_DT'),
	    'MENU_CR_UID'=>$this->session->userdata('USER_ID'),
	);
	
	$params = array(
	    array('name'=>':P_MENU_MODULE','value'=>$data['MENU_MODULE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_MENU_CODE','value'=>$data['MENU_CODE'], 'type'=>SQLT_CHR,'length'=>300), 
	    array('name'=>':P_MENU_DESC','value'=>$data['MENU_DESC'],'type'=>SQLT_CHR, 'length'=>300), 
	    array('name'=>':P_MENU_PARENT_CODE','value'=>$data['MENU_PARENT_CODE'], 'type'=>SQLT_CHR,'length'=>300),     
	    array('name'=>':P_MENU_TYPE','value'=>$data['MENU_TYPE'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_DISP_SEQ','value'=>$data['MENU_DISP_SEQ'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_DEFINITION','value'=>$data['MENU_DEFINITION'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_MENU_MULTI_INST_YN','value'=>$data['MENU_MULTI_INST_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_MENU_TXN_CODE','value'=>$data['MENU_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_MENU_PARA_01','value'=>$data['MENU_PARA_01'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_02','value'=>$data['MENU_PARA_02'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_03','value'=>$data['MENU_PARA_03'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_04','value'=>$data['MENU_PARA_04'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_05','value'=>$data['MENU_PARA_05'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_06','value'=>$data['MENU_PARA_06'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_07','value'=>$data['MENU_PARA_07'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_08','value'=>$data['MENU_PARA_08'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_09','value'=>$data['MENU_PARA_09'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_10','value'=>$data['MENU_PARA_10'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_11','value'=>$data['MENU_PARA_11'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_12','value'=>$data['MENU_PARA_12'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_13','value'=>$data['MENU_PARA_13'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_14','value'=>$data['MENU_PARA_14'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_15','value'=>$data['MENU_PARA_15'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_16','value'=>$data['MENU_PARA_16'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_17','value'=>$data['MENU_PARA_17'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_18','value'=>$data['MENU_PARA_18'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_19','value'=>$data['MENU_PARA_19'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_PARA_20','value'=>$data['MENU_PARA_20'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_ACTIVE_YN','value'=>$data['MENU_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_FROM_DT','value'=>$data['MENU_FROM_DT'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_MENU_UPTO_DT','value'=>$data['MENU_UPTO_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_LANG_CODE','value'=>$data['MENU_LANG_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$data['MENU_CR_UID'],'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_MENU',$params );
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    public function DeleteMenu($menu_code)
    {
	$params = array(
	    array('name'=>':P_MENU_CODE','value'=>$menu_code,'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_LANG_CODE','value'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'),'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_MENU',$params );
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
    }
    //Menu definition ended------->
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  MENU DEFINITION  END%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION HEAD MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
	
   
	    
//Transaction Head Master Start
    
    function GetMaxFlowSequence()
    {
	$sql="SELECT MAX(TXH_FLOW_SEQ) FROM APPS_TXN_HEAD";
	return $this->db->query($sql)->result_array();
    }
    function AddTranHead()
    {
	if($this->input->post('checkbox')=="Y")
	$active='Y';
	else
	$active='N';
	
	$data= array(
	    'TXH_CODE'=>$this->input->post('txn_code'),
	    'TXH_DESC'=>$this->input->post('txn_desc'),
	    'TXH_FLOW_SEQ'=>$this->input->post('flow_seq'),
	    'TXH_ACTIVE_YN'=>$active,
	    'TXH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    );
	$params = array(
	    array('name'=>':P_TXH_CODE','value'=>$data['TXH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXH_DESC','value'=>$data['TXH_DESC'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXH_FLOW_SEQ','value'=>$data['TXH_FLOW_SEQ'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXH_ACTIVE_YN','value'=>$data['TXH_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXH_LANG_CODE','value'=>$data['TXH_LANG_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_HEAD', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    
    function EditGetTable()
    {
	$query=$this->db->get('APPS_TXN_HEAD');
	return $query->result();
    }
    
    function EditTrans($id)
    {
	$sql="SELECT * FROM APPS_TXN_HEAD where TXH_CODE='$id' ";
	return $this->db->query($sql)->result_array();
    }
    
    function updateHeadMaster($id)
    {
	if($this->input->post('checkbox')=="Y")
	$active='Y';
	else
	$active='N';
	
	$data= array(
	    'TXH_CODE'=>$this->input->post('txn_code'),
	    'TXH_DESC'=>$this->input->post('txn_desc'),
	    'TXH_FLOW_SEQ'=>$this->input->post('flow_seq'),
	    'TXH_ACTIVE_YN'=>$active,
	    'TXH_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    );
	$params = array(
	    array('name'=>':P_TXH_CODE','value'=>$data['TXH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXH_DESC','value'=>$data['TXH_DESC'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXH_FLOW_SEQ','value'=>$data['TXH_FLOW_SEQ'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXH_ACTIVE_YN','value'=>$data['TXH_ACTIVE_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXH_LANG_CODE','value'=>$data['TXH_LANG_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_TXN_HEAD', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
    function DeleteHeadMasterTable($id)
    {
	$params = array(
	    array('name'=>':P_TXH_CODE','value'=>$id,'type'=>SQLT_CHR, 'length'=>300),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_HEAD', $params);
	return $result = array("return_status"=>$return_status,"error_message"=>$error_message);
    }
            
	//Transaction Head Master End
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION HEAD MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION SETUP MASTER  START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    //Transaction Setup Master start
            
            
    function getTransHeadMaster()
    {
	$sql="SELECT * FROM APPS_TXN_HEAD ORDER BY TXH_DESC ASC  ";
	return $this->db->query($sql)->result_array();
    }
    
    function GetAppsValueSet()
    {
	$sql="SELECT * FROM APPS_VALUE_SET_LINES where VSL_VSH_CODE='DOC_GEN_TYPE' ";
	return $this->db->query($sql)->result_array();
    }
    
    function GetGenPad()
    {
	$sql="SELECT * FROM APPS_VALUE_SET_LINES where VSL_VSH_CODE='DOC_GEN_PADD' ";
	return $this->db->query($sql)->result_array();
    }
    
    function GetFlowSeq()
    {
	$this->db->select_max('TXN_FLOW_SEQ');
	return $this->db->get('APPS_TXN_SETUP')->result_array();
    }
    function getAppsUsers()
    {
	$sql="SELECT * FROM APPS_USER WHERE USER_ACTIVE_YN='Y'";
	return $this->db->query($sql)->result_array();
    }
    function AddTransMaster()
    {
	if($this->input->post('txn_active')=="Y")
	$active='Y';
	else
	$active='N';
	
	if($this->input->post('TXN_FUTURE_PERIOD_YN')=="Y")
	$TXN_FUTURE_PERIOD_YN='Y';
	else
	$TXN_FUTURE_PERIOD_YN='N';
	
	if($this->input->post('TXN_BACK_PERIOD_YN')=="Y")
	$TXN_BACK_PERIOD_YN='Y';
	else
	$TXN_BACK_PERIOD_YN='N';
	
	if($this->input->post('txn_audit')=="Y")
	$txn_audit='Y';
	else
	$txn_audit='N';
	
	$data= array(
	    'TXN_CODE'=>$this->input->post('txh_code'),    //primary key
	    'TXN_DESC'=>$this->input->post('txh_desc'),
	    'TXN_ACTIVE_YN'=>$active,
	    'TXN_TXH_CODE'=>$this->input->post('txn_head'),
	    'TXN_FLOW_SEQ'=>$this->input->post('seq_flow'),
	    'TXN_DOC_GEN_TYPE'=>$this->input->post('txn_num_gen_type'),
	    'TXN_DOC_PADDING'=>$this->input->post('txn_num_pad'),
	    'TXN_AUDIT_YN'=>$txn_audit,
	    'TXN_FUTURE_PERIOD_YN'=>$TXN_FUTURE_PERIOD_YN,
	    'TXN_FUTURE_DAYS'=>$this->input->post('txn_future_days'),
	    'TXN_BACK_PERIOD_YN'=>$TXN_BACK_PERIOD_YN,
	    'TXN_BACK_DAYS'=>$this->input->post('txn_back_days'),
	    'TXN_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
	    'TXN_CR_UID'=>$this->session->userdata('USER_ID'),
	    'TXN_CR_DT'=>'18-mar-15',
	    'TXN_UPD_UID'=>null,
	    'TXN_UPD_DT'=>null
	    );
	$params = array(
	    array('name'=>':P_TXN_CODE','value'=>$data['TXN_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_DESC','value'=>$data['TXN_DESC'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXN_ACTIVE_YN','value'=>$data['TXN_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_TXH_CODE','value'=>$data['TXN_TXH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_FLOW_SEQ','value'=>$data['TXN_FLOW_SEQ'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_DOC_GEN_TYPE','value'=>$data['TXN_DOC_GEN_TYPE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXN_DOC_PADDING','value'=>$data['TXN_DOC_PADDING'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_AUDIT_YN','value'=>$data['TXN_AUDIT_YN'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXN_FUTURE_PERIOD_YN','value'=>$data['TXN_FUTURE_PERIOD_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_FUTURE_DAYS','value'=>$data['TXN_FUTURE_DAYS'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXN_BACK_PERIOD_YN','value'=>$data['TXN_BACK_PERIOD_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXN_BACK_DAYS','value'=>$data['TXN_BACK_DAYS'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_LANG_CODE','value'=>$data['TXN_LANG_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$data['TXN_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_SETUP', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	//echo "<pre>";
	//print_r($params);
	//echo $error_message;
	//echo "</pre>";
	//echo "TXDR start";
	$count=count($this->input->post('txdr_company'));
	for($i=0;$i<$count;$i++)
	{
	    $data1= array(
		'TXDR_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		'TXDR_TXN_CODE'=>$this->input->post('txh_code'),
		'TXDR_ACNT_YR'=>$_POST['txdr_year'][$i],
		'TXDR_PRD_NO'=>$_POST['txdr_period'][$i],
		'TXDR_PRD_FM_DT'=>$_POST['txdr_from_date'][$i],
		'TXDR_PRD_TO_DT'=>$_POST['txdr_upto_date'][$i],
		'TXDR_DOC_FM_NO'=>$_POST['txdr_doc_no_from'][$i],
		'TXDR_DOC_TO_NO'=>$_POST['txdr_doc_no_upto'][$i],
		'TXDR_DOC_CURR_NO'=>$_POST['txdr_curr_do_no'][$i],
	       );
	
	
	
	$params = array(
	    array('name'=>':P_TXDR_COMP_CODE','value'=>$data1['TXDR_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXDR_TXN_CODE','value'=>$data1['TXDR_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXDR_ACNT_YR','value'=>$data1['TXDR_ACNT_YR'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXDR_PRD_NO','value'=>$data1['TXDR_PRD_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXDR_PRD_FM_DT','value'=>$data1['TXDR_PRD_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXDR_PRD_TO_DT','value'=>$data1['TXDR_PRD_TO_DT'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXDR_DOC_FM_NO','value'=>$data1['TXDR_DOC_FM_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_TXDR_DOC_TO_NO','value'=>$data1['TXDR_DOC_TO_NO'], 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_TXDR_DOC_CURR_NO','value'=>$data1['TXDR_DOC_CURR_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
	    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
	    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_DOC_RANGE', $params);
	$result = array("return_status"=>$return_status,"error_message"=>$error_message);

	    //echo "<pre>";
	    //echo $count." txdr count";
	    //print_r($params);
	    //
	    //echo "</pre>";
	    //
	   

	//$this->db->insert('APPS_TXN_DOC_RANGE',$data1[$i]);
	}
	// echo "TXDR end <br><br>";
	 //echo "TXa start<br>";
	$count1=count($this->input->post('txa_company'));
	for($j=0;$j<$count1;$j++)
	{
	    $data2= array(
		'TXA_COMP_CODE'=>$this->session->userdata('USER_COMP_CODE'),
		'TXA_TXN_CODE'=>$this->input->post('txh_code'),
		'TXA_USER_ID'=>$_POST['txa_auth_user_id'][$j],
		'TXA_USER_FM_DT'=>$_POST['txa_date_from'][$j],
		'TXA_USER_TO_DT'=>$_POST['txa_date_upto'][$j],
		'TXA_USER_FM_VALUE'=>$_POST['txa_val_from'][$j],
		'TXA_USER_TO_VALUE'=>$_POST['txa_val_upto'][$j],
		);
	    $params = array(
		array('name'=>':P_TXA_COMP_CODE','value'=>$data2['TXA_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_TXN_CODE','value'=>$data2['TXA_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXA_USER_ID','value'=>$data2['TXA_USER_ID'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_FM_DT','value'=>$data2['TXA_USER_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_TO_DT','value'=>$data2['TXA_USER_TO_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_FM_VALUE','value'=>$data2['TXA_USER_FM_VALUE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXA_USER_TO_VALUE','value'=>$data2['TXA_USER_TO_VALUE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_AUTH', $params);
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    //echo "<pre>";
	    //echo $count1 ." txa count";
	    //print_r($params);
	    //echo "</pre>";
	}
	 //echo "txa end";
	 // echo "TXa start";
	 //exit;
	return   $result = array("return_status"=>$return_status,"error_message"=>$error_message);
		
    }
    
    function GetTransactionSetTable(){
	//	$sql="SELECT * FROM APPS_TXN_SETUP  ";
	//return $this->db->query($sql)->result_array();
		
		$query= $this->db->get('APPS_TXN_SETUP');
		return $query->result();
    }
    
    function EditFirstSetupMaster($id){
		
		$sql="SELECT * FROM APPS_TXN_SETUP WHERE TXN_CODE='$id' ";
	return $this->db->query($sql)->result_array();
    
		//$this->db->where('TXN_CODE',$id);
		//return $this->db->get('APPS_TXN_SETUP')->result_array();
	
    }
    
    function EditSecondSetupMaster($id){
		$sql="SELECT * FROM APPS_TXN_DOC_RANGE  WHERE TXDR_TXN_CODE='$id'";
	return $this->db->query($sql)->result_array();
		
		//$this->db->where('TXDR_TXN_CODE',$id);
		//return $this->db->get('APPS_TXN_DOC_RANGE')->result_array();
		
    }
    
    function EditThirdSetupMaster($id){
		$sql="SELECT * FROM APPS_TXN_AUTH WHERE TXA_TXN_CODE='$id' ";
	return $this->db->query($sql)->result_array();
		
		//$this->db->where('TXA_TXN_CODE',$id);
		//return $this->db->get('APPS_TXN_AUTH')->result_array();
		 
    }
    function updateSetup($id)
    {
	if($this->input->post('txn_active')=="Y")
	$active='Y';
	else
	$active='N';
	
	if($this->input->post('TXN_FUTURE_PERIOD_YN')=="Y")
	$TXN_FUTURE_PERIOD_YN='Y';
	else
	$TXN_FUTURE_PERIOD_YN='N';
	
	if($this->input->post('TXN_BACK_PERIOD_YN')=="Y")
	$TXN_BACK_PERIOD_YN='Y';
	else
	$TXN_BACK_PERIOD_YN='N';
	
	if($this->input->post('txn_audit')=="Y")
	$txn_audit='Y';
	else
	$txn_audit='N';
	
	    $data= array(
			 'TXN_CODE'=>$this->input->post('txh_code'),    //primary key
			 'TXN_DESC'=>$this->input->post('txh_desc'),
			 'TXN_ACTIVE_YN'=>$active,
			 'TXN_TXH_CODE'=>$this->input->post('txn_head'),
			 'TXN_FLOW_SEQ'=>$this->input->post('seq_flow'),
			 'TXN_DOC_GEN_TYPE'=>$this->input->post('txn_num_gen_type_val'),
			 'TXN_DOC_PADDING'=>$this->input->post('txn_num_pad'),
			 'TXN_AUDIT_YN'=>$txn_audit,
			 'TXN_FUTURE_PERIOD_YN'=>$TXN_FUTURE_PERIOD_YN,
			 'TXN_FUTURE_DAYS'=>$this->input->post('txn_future_days'),
			 'TXN_BACK_PERIOD_YN'=>$TXN_BACK_PERIOD_YN,
			 'TXN_BACK_DAYS'=>$this->input->post('txn_back_days'),
			 'TXN_LANG_CODE'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
			 'TXN_CR_UID'=>$this->session->userdata('USER_ID'),
			 'TXN_CR_DT'=>'18-mar-15',
			 'TXN_UPD_UID'=>null,
			 'TXN_UPD_DT'=>null
	    );
	    $params = array(
		array('name'=>':P_TXN_CODE','value'=>$data['TXN_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_DESC','value'=>$data['TXN_DESC'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXN_ACTIVE_YN','value'=>$data['TXN_ACTIVE_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_TXH_CODE','value'=>$data['TXN_TXH_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_FLOW_SEQ','value'=>$data['TXN_FLOW_SEQ'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_DOC_GEN_TYPE','value'=>$data['TXN_DOC_GEN_TYPE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXN_DOC_PADDING','value'=>$data['TXN_DOC_PADDING'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_AUDIT_YN','value'=>$data['TXN_AUDIT_YN'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXN_FUTURE_PERIOD_YN','value'=>$data['TXN_FUTURE_PERIOD_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_FUTURE_DAYS','value'=>$data['TXN_FUTURE_DAYS'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXN_BACK_PERIOD_YN','value'=>$data['TXN_BACK_PERIOD_YN'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXN_BACK_DAYS','value'=>$data['TXN_BACK_DAYS'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_LANG_CODE','value'=>$data['TXN_LANG_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID','value'=>$data['TXN_CR_UID'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_TXN_SETUP', $params);
	    $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	    
	    //echo "<pre>";
	    //print_r($params);
	    //echo $error_message;
	    //echo "</pre>";  
		
		
	    //$this->db->insert('APPS_TXN_SETUP',$data);
	    if($this->input->post('userRespCount2')>0)
	    {
		$count_1=$this->input->post('userRespCount2');
	    }
	    else{
		$count_1=0;
	    }
	
	    //$count_1=$this->input->post('rowcount');
	    //echo $count_1." TXDR OLD COUNT";
	    //echo $count;
	    for($i=0;$i<$count_1;$i++)
	    {
		$data1= array(
		    'TXDR_COMP_CODE'=>$this->input->post('txdr_company_old'),
		    'TXDR_TXN_CODE'=>$this->input->post('txh_code'),
		    'TXDR_ACNT_YR'=>$_POST['txdr_year'][$i],
		    'TXDR_PRD_NO'=>$_POST['txdr_period'][$i],
		    'TXDR_PRD_FM_DT'=>$_POST['txdr_from_date'][$i],
		    'TXDR_PRD_TO_DT'=>$_POST['txdr_upto_date'][$i],
		    'TXDR_DOC_FM_NO'=>$_POST['txdr_doc_no_from'][$i],
		    'TXDR_DOC_TO_NO'=>$_POST['txdr_doc_no_upto'][$i],
		    'TXDR_DOC_CURR_NO'=>$_POST['txdr_curr_do_no'][$i],
		    );
		if($data['TXN_DOC_GEN_TYPE']=="P")
		{
		    $params1 = array(
		       array('name'=>':P_TXDR_COMP_CODE','value'=>$data1['TXDR_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_TXDR_TXN_CODE','value'=>$data1['TXDR_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		       array('name'=>':P_TXDR_ACNT_YR','value'=>$data1['TXDR_ACNT_YR'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_TXDR_PRD_NO','value'=>$data1['TXDR_PRD_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_TXDR_PRD_FM_DT','value'=>$data1['TXDR_PRD_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_TXDR_PRD_TO_DT','value'=>$data1['TXDR_PRD_TO_DT'], 'type'=>SQLT_CHR,'length'=>300),
		       array('name'=>':P_TXDR_DOC_FM_NO','value'=>$data1['TXDR_DOC_FM_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_TXDR_DOC_TO_NO','value'=>$data1['TXDR_DOC_TO_NO'], 'type'=>SQLT_CHR,'length'=>300),
		       array('name'=>':P_TXDR_DOC_CURR_NO','value'=>$data1['TXDR_DOC_CURR_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		       array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		       array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		       array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	   
		       $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_TXN_DOC_RANGE', $params1);
		       $result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
	       
		}
		else
		{
		    $params1 = array(
		    array('name'=>':P_TXDR_COMP_CODE','value'=>$data1['TXDR_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_TXN_CODE','value'=>$data1['TXDR_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_ACNT_YR','value'=>$data1['TXDR_ACNT_YR'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_NO','value'=>"",'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_FM_DT','value'=>"",'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_TO_DT','value'=>"", 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_DOC_FM_NO','value'=>$data1['TXDR_DOC_FM_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_DOC_TO_NO','value'=>$data1['TXDR_DOC_TO_NO'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_DOC_CURR_NO','value'=>$data1['TXDR_DOC_CURR_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		    
		    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		    
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	
		    $this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_TXN_DOC_RANGE', $params1);
		    $result = array("return_status"=>$return_status
				,"error_message"=>$error_message);
	
		//echo "<pre>";
		//print_r($params1);
		//
		//echo "</pre>";
			    
		}
	
	    //$this->db->insert('APPS_TXN_DOC_RANGE',$data1[$i]);
	    }
	    
	    //$count_2=$this->input->post('rowcount1');
	    if($this->input->post('userRespCount1')>0)
	    {
		$count_2=$this->input->post('userRespCount1');
	    }
	    else{
		$count_2=0;
	    }
	    
	    //echo $count_2." TXA OLD COUNT";
	    for($j=0;$j<$count_2;$j++)
	    {
		$data2= array(
		    'TXA_COMP_CODE'=>$this->input->post('txa_company_old'),
		    'TXA_TXN_CODE'=>$this->input->post('txh_code'),
		    'TXA_USER_ID'=>$_POST['txa_auth_user_id_old'][$j],
		    'TXA_USER_FM_DT'=>$_POST['txa_date_from'][$j],
		    'TXA_USER_TO_DT'=>$_POST['txa_date_upto'][$j],
		    'TXA_USER_FM_VALUE'=>$_POST['txa_val_from'][$j],
		    'TXA_USER_TO_VALUE'=>$_POST['txa_val_upto'][$j],
		);
		$params2 = array(
		array('name'=>':P_TXA_COMP_CODE','value'=>$data2['TXA_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_TXN_CODE','value'=>$data2['TXA_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXA_USER_ID','value'=>$data2['TXA_USER_ID'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_FM_DT','value'=>$data2['TXA_USER_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_TO_DT','value'=>$data2['TXA_USER_TO_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXA_USER_FM_VALUE','value'=>$data2['TXA_USER_FM_VALUE'], 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_TXA_USER_TO_VALUE','value'=>$data2['TXA_USER_TO_VALUE'],'type'=>SQLT_CHR, 'length'=>300 ),
		
		array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		
		array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	
		$this->db->stored_procedure('SPINE_APPS','UPDATE_APPS_TXN_AUTH', $params2);
		$result = array("return_status"=>$return_status
			    ,"error_message"=>$error_message);
	
	    //echo "<pre>";
	    //print_r($params2);
	    //echo $error_message;
	    //echo "</pre>";
	
	
	    //$this->db->insert('APPS_TXN_AUTH',$data2[$j]);
	    }
	    //$condition1 =$this->input->post('rowcount');
	    //$condition2 = count($this->input->post('txdr_year'));
	    //if($condition1!=$condition2)
	    //{
		
		$count_3=count($this->input->post('inserTxdr'));
		//echo $count." TXDR NEW COUNT";
		for($i=0;$i<$count_3-1;$i++)
		{
		    $data1= array(
			'TXDR_COMP_CODE'=>$this->input->post('txdr_company'),
			'TXDR_TXN_CODE'=>$this->input->post('txh_code'),
			'TXDR_ACNT_YR'=>$_POST['txdr_year'][$count_1+$i],
			'TXDR_PRD_NO'=>$_POST['txdr_period'][$count_1+$i],
			'TXDR_PRD_FM_DT'=>$_POST['txdr_from_date'][$count_1+$i],
			'TXDR_PRD_TO_DT'=>$_POST['txdr_upto_date'][$count_1+$i],
			'TXDR_DOC_FM_NO'=>$_POST['txdr_doc_no_from'][$count_1+$i],
			'TXDR_DOC_TO_NO'=>$_POST['txdr_doc_no_upto'][$count_1+$i],
			'TXDR_DOC_CURR_NO'=>$_POST['txdr_curr_do_no'][$count_1+$i],
		    );
		
		
		
		$params3 = array(
		    array('name'=>':P_TXDR_COMP_CODE','value'=>$data1['TXDR_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_TXN_CODE','value'=>$data1['TXDR_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_ACNT_YR','value'=>$data1['TXDR_ACNT_YR'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_NO','value'=>$data1['TXDR_PRD_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_FM_DT','value'=>$data1['TXDR_PRD_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_PRD_TO_DT','value'=>$data1['TXDR_PRD_TO_DT'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_DOC_FM_NO','value'=>$data1['TXDR_DOC_FM_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXDR_DOC_TO_NO','value'=>$data1['TXDR_DOC_TO_NO'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXDR_DOC_CURR_NO','value'=>$data1['TXDR_DOC_CURR_NO'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
		$this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_DOC_RANGE', $params3);
		$result = array("return_status"=>$return_status,"error_message"=>$error_message);
	
		    //echo "<pre>";
		    //echo $count_3."<br>";
		    //print_r($params3);
		    //echo "</pre>";
	
		//$this->db->insert('APPS_TXN_DOC_RANGE',$data1[$i]);
		}
	    //}
	    //echo $count_1."<br>";
	    //echo $condition2;
	    //$condition3 =$this->input->post('rowcount1');
	    //$condition4 = count($this->input->post('txa_auth_user_id'));
	    //if($condition3=$condition4)
	    //{
	    
		$count_4=count($this->input->post('inserTxa'));
		 //echo $count_4." TXA NEW COUNT";
		for($j=0;$j<$count_4-1;$j++)
		{
		    $data2= array(
			'TXA_COMP_CODE'=>$this->input->post('txa_company'),
			'TXA_TXN_CODE'=>$this->input->post('txh_code'),
			'TXA_USER_ID'=>$_POST['txa_auth_user_id'][$j],
			'TXA_USER_FM_DT'=>$_POST['txa_date_from'][$count_2+$j],
			'TXA_USER_TO_DT'=>$_POST['txa_date_upto'][$count_2+$j],
			'TXA_USER_FM_VALUE'=>$_POST['txa_val_from'][$count_2+$j],
			'TXA_USER_TO_VALUE'=>$_POST['txa_val_upto'][$count_2+$j],			     
		    );
		
	
	
						
		    $params_new = array(
		    array('name'=>':P_TXA_COMP_CODE','value'=>$data2['TXA_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXA_TXN_CODE','value'=>$data2['TXA_TXN_CODE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXA_USER_ID','value'=>$data2['TXA_USER_ID'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXA_USER_FM_DT','value'=>$data2['TXA_USER_FM_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXA_USER_TO_DT','value'=>$data2['TXA_USER_TO_DT'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXA_USER_FM_VALUE','value'=>$data2['TXA_USER_FM_VALUE'], 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_TXA_USER_TO_VALUE','value'=>$data2['TXA_USER_TO_VALUE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    
		    array('name'=>':P_USER_ID','value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR,'length'=>300),
		    
		    array('name'=>':P_ERR_NUM','value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG','value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300));
	
		    $this->db->stored_procedure('SPINE_APPS','INSERT_APPS_TXN_AUTH', $params_new);
		    $result = array("return_status"=>$return_status
				,"error_message"=>$error_message);
		    
		    //echo "<pre>";
		    //echo $count_4."<br>";
		    //print_r($params_new);
		    //echo "</pre>";
	
	
		//$this->db->insert('APPS_TXN_AUTH',$data2[$j]);
		}
	    //}
	    //echo $condition3;
	    //exit;
	    return array("return_status"=>$return_status,"error_message"=>$error_message);
	
    }
    function Delete_txn_SETUP($id)
    {
	$this->db->where('TXN_CODE', $id);
	$this->db->delete('APPS_TXN_SETUP');
    }
    function Delete_txn_doc($id)
    {
	$this->db->where('TXDR_TXN_CODE', $id);
	$this->db->delete('APPS_TXN_DOC_RANGE');
    }
    function Delete_txn_auth($id)
    {
	$this->db->where('TXA_TXN_CODE', $id);
	$this->db->delete('APPS_TXN_AUTH');
    }
    
    
    
    public function DeleteTransactionSet($id)
    {
	//Txdr_Txn_Code
	
	$sql="SELECT * FROM APPS_TXN_AUTH  WHERE TXA_TXN_CODE='$id'";
	      $val1= $this->db->query($sql)->result_array();
	    foreach($val1 as $val12)
	    {
		$params1 = array(
		    array('name'=>':P_TXA_COMP_CODE', 'value'=> $val12['TXA_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		    array('name'=>':P_TXA_TXN_CODE', 'value'=>$id,'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_USER_ID', 'value'=>$val12['TXA_USER_ID'], 'type'=>SQLT_CHR, 'length'=>300),
		    array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		    array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		    );
		$this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_AUTH', $params1);
		$result1 = array("return_status"=>$return_status,"error_message"=>$error_message );
	    }
       //doc Range
	$sql="SELECT * FROM APPS_TXN_DOC_RANGE  WHERE TXDR_TXN_CODE='$id'";
	$val3=$this->db->query($sql)->result_array();
	
	foreach($val3 as $val4)
	{
	    $params2 = array(
		array('name'=>':P_TXDR_COMP_CODE', 'value'=> $val4['TXDR_COMP_CODE'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_TXDR_TXN_CODE', 'value'=>$id, 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_TXDR_ACNT_YR', 'value'=> $val4['TXDR_ACNT_YR'],'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	    $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_DOC_RANGE', $params2);
	    $result1 = array("return_status"=>$return_status,"error_message"=>$error_message );
	}
	     
	//setup delete
	$params3 = array(
		array('name'=>':P_TXN_CODE', 'value'=> $id,'type'=>SQLT_CHR, 'length'=>300 ),
		array('name'=>':P_LANG_CODE', 'value'=>substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),  'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	    $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_SETUP', $params3);
	    return $result1 = array("return_status"=>$return_status,"error_message"=>$error_message );
    }
    function DeleteTranscationSetupDoc($id1,$id2,$id3)
    {
		//
		//if($id4=="NULL")
		//{
		//    $id4="";
		//}
			    $params2 = array(
		array('name'=>':P_TXDR_COMP_CODE', 'value'=> $id1,'type'=>SQLT_CHR, 'length'=>300 ),
	       array('name'=>':P_TXDR_TXN_CODE', 'value'=>$id3, 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_TXDR_ACNT_YR', 'value'=> $id2,'type'=>SQLT_CHR, 'length'=>300 ),
	       
	       array('name'=>':P_USER_ID', 'value'=>$this->session->userdata('USER_ID'), 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	  
	  
	  $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_DOC_RANGE', $params2);
	  return array("return_status"=>$return_status,"error_message"=>$error_message );
	   
	   //echo "<pre>";
	   //    print_r($params2);
	   //    echo $error_message;
	   //    echo "</pre>";
	   //    
	   //    exit();
	
    }
    
    function DeleteTranscationSetupAuth($id1,$id2,$id3)
    {
	 $params1 = array(
		array('name'=>':P_TXA_COMP_CODE', 'value'=> $id1,'type'=>SQLT_CHR, 'length'=>300 ),
	       array('name'=>':P_TXA_TXN_CODE', 'value'=>$id2,'type'=>SQLT_CHR, 'length'=>300),
	       array('name'=>':P_USER_ID', 'value'=>$id3, 'type'=>SQLT_CHR, 'length'=>300),
		array('name'=>':P_ERR_NUM', 'value'=>&$return_status, 'type'=>SQLT_CHR,'length'=>300),
		array('name'=>':P_ERR_MSG', 'value'=>&$error_message, 'type'=>SQLT_CHR,'length'=>300)
		);
	  
	  
	  $this->db->stored_procedure('SPINE_APPS','DELETE_APPS_TXN_AUTH', $params1);
	  return $result1 = array("return_status"=>$return_status
				      ,"error_message"=>$error_message );
	
    }
    function DeleteTableSetMaster($id)
    {
		$this->db->where('TXN_CODE',$id);
		$this->db->delete('APPS_TXN_SETUP');
		
		$this->db->where('TXN_TXH_CODE',$id);
		$this->db->delete('APPS_TXN_DOC_RANGE');
		
		$this->db->where('TXDR_TXN_CODE',$id);
		$this->db->delete('APPS_TXN_AUTH');
    }
    
    
    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  TRANACTION SETUP MASTER  END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    
    
    
    
    
    
    
    function loginAuthentication(){
	//$company_code = $this->input->post('company_code');
	$user_id = $this->input->post('user_id');
	$password=md5($this->security->xss_clean($this->input->post('password')));
	$date = date('d-M-y');
	$sql="SELECT * FROM APPS_USER where USER_ID='$user_id' AND USER_PASSWD='$password' and USER_ACTIVE_YN='Y' and ( TRUNC(USER_FROM_DT) <='$date' and TRUNC(USER_UPTO_DT)>='$date')";
    
	$query = $this->db->query($sql, $return_object = TRUE);
	
	if($query->num_rows > 0){
	    return $query->result_array();
	}
	else
	{
	    return false;
	}
    }
	    

}

		