<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

////added this for to get the current page menu details and the responsibility auth and transaction desc
//	//Added by: BharaniGuru R
//	//Added date: 25/05/2015
//	$viewcountry['getMenuDetails']= getMenuDetails();
//	$getMenuDetails= getMenuDetails();
//	$menu_code=$getMenuDetails[0]['MENU_CODE'];
//	$menu_txn_code=$getMenuDetails[0]['MENU_TXN_CODE'];
//	if($menu_txn_code){
//	    $viewcountry['getTransDesc']= getTransDesc($menu_txn_code);
//	}
//	$viewcountry['getResponseForUser'] = getResponseForUser($menu_code) ;
//	
//	// end of resp and txn dec details
//        
//        
function getMenuDetails() 
{
    $CI = get_instance();
    $CI->load->model('AppsMod');
    $actual_url= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $base_url=base_url();
    $array=explode("$base_url",$actual_url);
    $href=$array[1];
    $href=explode("_",$href);
    $href = $href[0];
    $result=$CI->AppsMod->Get_Menu_Code($href);
    return $result; 
    
}
function getTransDesc($menu_txn_code) 
{
    $CI = get_instance();
    $CI->load->model('AppsMod');
    $TXN_DESC = $CI->AppsMod->Menu_Txn_Description($menu_txn_code);
    return $TXN_DESC;
}
function getResponseForUser($menu_code) 
{
    $CI = get_instance();
    $CI->load->model('AppsMod');
    $respresult=$CI->AppsMod->GetResponseForUser($menu_code);
    return $respresult;
}
?>