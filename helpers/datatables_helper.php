<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($edit,$del,$id)
{
    
    
    
                                
                                
    $ci= & get_instance();
    
    $html ='<a  href="'. base_url($edit.$id).'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> </a>';
    $html .='<a href="'.  base_url($del.$id).'" id="delete_box" class="btn btn-danger btn-xs"><i class="fa  fa-trash-o"></i></a>';
   
    
    return $html;
}
function callback_test($id){
    $CI = & get_instance();
    $CI->load->model('FincMod');
    return $CI->FincMod->callback_test($id);
}
