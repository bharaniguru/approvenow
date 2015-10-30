<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class approveRegister extends CI_Controller {
    function approveRegister(){
	parent::__construct();
	$this->load->model('mApproveRegister');
	$this->load->library('session');
	$this->load->helper('dompdf_helper');
	$this->load->library('table');
	$this->load->library('Datatables');
	$this->load->helper('datatables_helper');
	$this->load->library('encrypt');
	error_reporting(0);	
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
		if($result[0]['account_status']=="Y"){
		    $this->session->set_userdata('accUsername',$result[0]['account_username']);
		    $this->session->set_userdata('account_id',$result[0]['account_id']);
		    redirect(site_url("approveRegister/dashboard"));
		}elseif($result[0]['account_status']=="N"){
		    $data['errorMsg'] = 'Please active your account from your email.';
		}
	    }else{
		
	    }
	}
	$this -> load -> view('index',$data);
    }
    function createAccount(){
	if ($this->input->post('proceed')=='Yes'){
	    $accountId = $this->mApproveRegister->createAccount();
	    //$accountId=23;
	    $this->load->library('ApproveNowEmail');
	    $receiptEmailId = $this->input->post('accEmail');
	    $subject='Email Verification';
	    $body='Hi '.$this->input->post('accFirstName').' '.$this->input->post('accLastName').', your account is created succefully..
	    Please click the link below to verify your account....
	    '.site_url().'approveRegister/accountVerification/'.$accountId.'';
	    $this->approvenowemail->EmailSend($receiptEmailId,$subject,$body);
	    redirect(site_url("approveRegister/accountSubmitted"));
	}
	$data['accountType']=$this->mApproveRegister->getUserDetails();
	$this -> load -> view('createAccount',$data);
	
    }
    function accountVerification($verificationCode){
	$result = $this->mApproveRegister->checkVerified($verificationCode);
	if($result){
	    if($result[0]['account_status']=='N'){
		$this->mApproveRegister->updateAccountStatus($verificationCode);
		redirect(site_url('approveRegister/verifiedSuccess'));
	    }elseif($result[0]['account_status']=='Y'){
		redirect(site_url('approveRegister/existingAccount'));
	    }
	}else{
	    redirect(site_url('approveRegister/error404'));
	}
    }
    function error404(){
	$this ->load->view('404_error');
    }
    function existingAccount(){
	$this ->load->view('existingAccount');
    }
    function verifiedSuccess(){
	$this ->load->view('verifiedSuccess');
    }
    function accountSubmitted(){
	$this ->load->view('accountSubmitted');
    }
    public function Logout(){
	$this->session->unset_userdata('accUsername');
	unset($this->session->userdata);
	redirect(site_url(),'refresh');
    }
    
    //Checking Login User Valdation Starts
    public function CheckingData(){
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');
	$accUsername=$this->input->post('accUsername');
	
	$sql="SELECT COUNT(account_username) FROM accounts_general where account_username='$accUsername'";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(account_username)']>0){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    public function CheckingUser(){
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');
	$accUsername=$this->input->post('accUsername');
	$password=$this->security->xss_clean($this->input->post('accPassword'));
	
	$sql="SELECT COUNT(account_username) FROM accounts_general where account_username='$accUsername' AND account_pwd='$password'";
	$query = $this->db->query($sql)->result_array();
	 if($query[0]['COUNT(account_username)']==1){
	    echo json_encode(array('valid'=>'true'));
	}else{
	    echo json_encode(array('valid'=>'false'));
	}
    }
    //Checkng Login User Valdation Ends
    //User Name Already Exits Starts
    public function alreadyExits()
	{
	    header('Content-Type: application/json');
	    $alreadyExits=$this->input->post('accUsername');
	    $viewresult=$this->mApproveRegister->alreadyExits($alreadyExits);
	    //print_r($viewresult[0]);
	    //exit;
	    if($viewresult[0]['COUNT(account_username)']>0)
	    {
		echo json_encode(array('valid'=>'false'));
	    }
	    else
	    {
	       echo json_encode(array('valid'=>'true'));
	    }
	}
    //User Name Already Exits Ends
    function dashboard()
    {
	$sessionData = $this->session->userdata('accUsername');
	$accountId = $this->session->userdata('account_id');
	$result['details']=$this->mApproveRegister->dashboard();
	$result['tableDetails']=$this->mApproveRegister->getTableDetails($accountId);
	$result['statusDesc']=$this->mApproveRegister->statusDesc();
	
	//$result['providerDetails']=$this->mApproveRegister->getProviderTableDetails();
	//print_r($result['details']);
	//exit;
	if($sessionData!=""){
	    $this -> load -> view('header');
	    $this -> load -> view('application/dashboard',$result);
	    $this -> load -> view('footer');
	}else{
	    redirect(site_url());
	}
    }
   public function paitentDetailsAjax()
	{
	    //$data= $this->mApproveRegister->getReasonRef($reasonRef);
	   
	    $result=$this->mApproveRegister->getRejectDetails();
	    $data =$this->mApproveRegister->paitentDetailsAjax();
	    //echo "pre";
	    //print_r($data);
	    //exit;
	    foreach($data as $row) {
	    ?>
	    <div class="col-md-6 well" id="showDiv">
			<div class="" >
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Drug Name: <?php echo $row['written_drug_form_desc']; ?></label>
					</div>
					<div class="form-group">
						<label class="control-label">Diagnosis Code:  <?php echo $row['diagnosis_code']; ?></label>
					</div>
					<div class="form-group">
						<label class="control-label">Provider Name: <?php echo $row['pharmacy_name']; ?></label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Reject Issues</label>
					</div>
					
					<div class="form-group">
						<textarea class="form-control" rows="5" id="comment" readonly=""><?php echo $result[0]['PA_reject_reason']; ?></textarea>
					</div>
				</div>
				<a href="<?php echo site_url('approveRegister/priorAuth/'.$row['prior_authorizaion_id']); ?>" class="btn btn-success pull-right">Fix PA</a>
				
			</div>
		</div>
		<?php }
	}
    function locationMaster(){
	$sessionData = $this->session->userdata('accUsername');
	 $data['locationDetails']= $this->mApproveRegister->getLocationID();
	if($sessionData!=""){
	    $this -> load -> view('header');
	    $this -> load -> view('application/locationMaster',$data);
	    $this -> load -> view('footer');
	}
	else{
	    redirect(site_url());
	}
    }
    function locationMasterTable(){
	$sessionData = $this->session->userdata('account_id');
        $this->datatables->select('location_id,location_name,phone_number,phone_ext,fax_number,address,city,state,zip,zip_four,email_address,web_address,NPI,account_id')
	->from('locations')
	->where('account_id',$sessionData);
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
//    function generalProvider(){
//	$sessionData = $this->session->userdata('accUsername');
//	
//	if($sessionData!=""){
//	   
//	    
//	    $this -> load -> view('header');
//	    $this -> load -> view('application/generalProvider',$data);
//	    $this -> load -> view('footer');
//	}
//	else{
//	    redirect(site_url());
//	}
//    }
   
    function generalProviderTable(){
        $loaction_id = $_POST['loaction_id'];
	$this->datatables->select('provider_id,first_name,last_name,provider_type_id,phone,NPI,DEA_num,location_id')
	->from('provider_general')
	->where('location_id',$loaction_id);
	
	echo $this->datatables->generate();
    }
      function getProviderDetails(){
	header('Content-Type: application/json');
	$providerId = $_POST['providerId'];
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
	$providerId = $_POST['providerId'];
	$this->mApproveRegister->deleteprovider($providerId);
	$query['status']="Success";
	echo json_encode($query);
    }
    public function ajaxLocations()
    {
	$location_id = $this->input->post('loaction_id');
	$data = $this->mApproveRegister->getAjaxLocations($location_id);
	foreach($data as $row) {
	    ?>
	<tr>
	    <td><?php echo $row['first_name'];?></td>
	    <td><?php echo $row['last_name']; ?></td>
	    <td><?php echo $row['provider_type_id']; ?></td>
	    <td><?php echo $row['phone']; ?></td>
	    <td><?php echo $row['NPI']; ?></td>
	    <td><?php echo $row['DEA_num']; ?></td>
	    <td><?php echo $row['location_id']; ?></td>
	    <td><div class="btn-group m-r-5 m-b-5 pull-right"><a class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a><ul class="dropdown-menu"><li><a  class="btn btn-sm" onclick="editProvider('<?php echo $row['provider_id'];?>')" >  <i class="fa  fa-edit" > </i> Edit</a></li><li><a class="btn btn-sm"  id="delete_box" data-toggle="modal"  onclick="deleteProvider('<?php echo $row['provider_id'];?>')" >  <i class="fa  fa-trash-o" >  </i> Delete </a></li></ul></div></td>
	</tr>
    <?php }
    }
    //3. ADD PRIOR AUTHORZATION STARTS
    public function priorAuth_View()
    {
	$sessionData = $this->session->userdata('accUsername');
	if($sessionData!=""){
	$this -> load -> view('header');
        $this -> load -> view('application/priorAuth_View');
	 $this -> load -> view('footer');
	}
	else
	{
	    redirect(site_url());
	}	
    }
    function priorAuthMasterTable(){
	//$sessionData = $this->session->userdata('account_id');
	$this->datatables->select('prior_authorizaion_id,patient_id,patient_first_name,patient_address,pharmacy_name,pharmacy_city,Prescriber_name,speciality,insurance_name,prior_auth_name')
	->from('prior_authorizaion');
	//->where('account_id',$sessionData);
	echo $this->datatables->generate();
    }
    function getPriorAuthDetails(){
	header('Content-Type: application/json');
	$prior_authorizaion_id = $_POST['prior_authorizaion_id'];
	$result = $this->mApproveRegister->getPriorAuthDetails($prior_authorizaion_id);
	echo json_encode($result);
    }
    function priorAuth($id){
	$sessionData = $this->session->userdata('accUsername');
	if($sessionData!=""){
	    if($id!='empty')
	    {
		$data['state']= $this->mApproveRegister->getStateDetails();
		$data['insuranceCompDetails']= $this->mApproveRegister->getInsuranceCompDetails();
		$data['priorAuthDetails']= $this->mApproveRegister->getPriorAuthDetails($id);
		$data['rejectReasonDetails']= $this->mApproveRegister->getRejectReason($id);
		$data['empty']="data";
		$data['editId']=$id;
		$this -> load -> view('header');
		$this -> load -> view('application/priorAuth',$data);
		$this -> load -> view('footer');
	    }
	    else{
		$data['empty']="empty";
		$data['editId']='noId';
		$data['insuranceCompDetails']= $this->mApproveRegister->getInsuranceCompDetails();
		$data['state']= $this->mApproveRegister->getStateDetails();
		$this -> load -> view('header');
		$this -> load -> view('application/priorAuth',$data);
		$this -> load -> view('footer');
	    }
	}
    }
    function PriorAuthDetailsOperation(){
	$this->mApproveRegister->addPriorAuth();
	$query['status']="Success";
	echo json_encode($query);	
    }
    function pdfConvert(){
	if (isset($_POST["sendToFax"])) {
	    if($_POST["sendToFax"]=='Fax PA'){
		$priorAuthStatus = 'Submited';
		$lastInsertedId = $this->mApproveRegister->addPriorAuth($priorAuthStatus);
		redirect(site_url('approveRegister/priorAuthFaxPreview/'.$lastInsertedId));
	    }elseif($_POST["sendToFax"]=='Re-Fax PA'){
		$priorAuthId = $_POST['priorAuthId'];
		$priorAuthStatus = 'Submited';
		$this->mApproveRegister->UpdatePriorAuth($priorAuthId,$priorAuthStatus);
		redirect(site_url('approveRegister/priorAuthFaxPreview/'.$priorAuthId));
	    }
	    
	}elseif(isset($_POST["proceed"])){
	    if($_POST["proceed"]=='Save'){
		$priorAuthStatus = $this->input->post('prior_auth_status');
		$this->mApproveRegister->addPriorAuth($priorAuthStatus);
		redirect(site_url('approveRegister'));
	    }elseif($_POST["proceed"]=='Update PA'){
		$priorAuthId = $_POST['priorAuthId'];
		$priorAuthStatus = $this->input->post('prior_auth_status');
		$this->mApproveRegister->UpdatePriorAuth($priorAuthId,$priorAuthStatus);
		redirect(site_url('approveRegister'));
	    }
	}
    }
    function priorAuthFaxPreview($lastInsertedId){
	$data['lastInsertedId'] = $lastInsertedId;
	$this -> load -> view('header');
	$this -> load -> view('application/priorAuthFaxPreview',$data);
	$this -> load -> view('footer');
    }
    function sendPAFax($lastInsertedId){
	$this->load->helper('interfax_helper');
	$val="";
	$data['pdfValue']=$this->mApproveRegister->getPriorAuthDetails($lastInsertedId);
        $faxNumber=$data['pdfValue'][0]['primary_insurance_fax'] ;
	$html = $this->load->view('application/pdf/prescription',$data,true);
	$pdfPath = pdf_create1($html,'Customer',$stream=TRUE,$val);
	$transactionId = sendFaxWithPdf($faxNumber, $pdfPath);
	
	if($data['pdfValue'][0]['attachments']){
	    sendFaxWithPdf($faxNumber, $data['pdfValue'][0]['attachments']);
	}
	redirect(site_url('approveRegister'));
    }
    function sentFaxSuccess(){
	$this -> load -> view('header');
	$this -> load -> view('application/sentFaxSuccess');
	$this -> load -> view('footer');
    }
    function generatePAPdf($lastInsertedId){
	$data['pdfValue']=$this->mApproveRegister->getPriorAuthDetails($lastInsertedId);
	$html = $this->load->view('application/pdf/prescription',$data,true);
	pdf_create($html,'Customer',$stream=TRUE);
    }
    function pdfConvert1(){
	$this->load->helper('interfax_helper');
	$faxNumber= '+18772200199';
	$val="";
	$data['pdfValue']=$this->mApproveRegister->pdfPriorAuthorizaion();
        $html = $this->load->view('application/pdf/prescription',$data,true);
	$pdfPath = pdf_create1($html,'Customer',$stream=TRUE,$val);
	$transactionId = sendFaxWithPdf($faxNumber, $pdfPath);
	//$transactionId = sendFaxWithHtml($faxNumber,$html);
	echo 'Your Prior authentication is sent to '.$transactionId;	
    }
    //ADD PRIOR AUTHRZATION ENDS    
 //********************************************************END************************************************************************
 }