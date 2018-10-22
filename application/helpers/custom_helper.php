<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('msg')){

  function msg($msg = 'Action successfull.', $url = '', $output = false){
  	$msg = ucfirst($msg);
    $CI = &get_instance();
    return $CI->load->view('msg',['msg' => $msg, 'url' => $url],$output);
  }

}
if(!function_exists('error')){

	function error($error = 'An error has occured while creating an error report.', $url = '', $output = false){
	  	$error = ucfirst(strtolower($error));
	    $CI = &get_instance();
	    return $CI->load->view('error',['error' => $error, 'url' => $url],$output);
	  }
}

if(!function_exists('redrct')){
	function redrct($url = 'http://localhost/meraki/'){
		echo "<script>window.location.href = ('$url'); </script>";
}

}
if(!function_exists('input_san')){

	function input_san($input,$output = false){
		if(array_key_exists('name', $input)){
			$input['name'] = ucwords(strtolower(filter_var($input['name'], FILTER_SANITIZE_STRING)));
		}
		if(array_key_exists('first_name', $input)){
			$input['first_name'] = ucwords(strtolower(filter_var($input['first_name'], FILTER_SANITIZE_STRING)));
		}
		if(array_key_exists('last_name', $input)){
			$input['last_name'] = ucwords(strtolower(filter_var($input['last_name'], FILTER_SANITIZE_STRING)));
		}
		if(array_key_exists('address', $input)){
			$input['address'] = filter_var($input['address'], FILTER_SANITIZE_STRING);
		}
		if(array_key_exists('city', $input)){
			$input['city'] = filter_var($input['city'], FILTER_SANITIZE_STRING);
		}
		if(array_key_exists('contact_no', $input)){
			$input['contact_no'] =  preg_replace('/\s+/', '', filter_var($input['contact_no'], FILTER_SANITIZE_STRING));
		}
		if(array_key_exists('email', $input)){
			$input['email'] = preg_replace('/\s+/', '', filter_var($input['email'], FILTER_SANITIZE_STRING));
		}
		if(array_key_exists('password', $input)){
			$input['password'] = md5(filter_var($input['password'], FILTER_SANITIZE_STRING));
		}
		if(array_key_exists('pincode', $input)){
			$input['pincode'] = preg_replace('/\s+/', '', filter_var($input['pincode'], FILTER_SANITIZE_STRING));
		}
		if(array_key_exists('landmark', $input)){
			$input['landmark'] = filter_var($input['landmark'], FILTER_SANITIZE_STRING);
		}
		if(array_key_exists('state_id', $input)){
			$input['state_id'] = preg_replace('/\s+/', '', filter_var($input['state_id'], FILTER_SANITIZE_STRING));
		}
		
	   	return $input;
	  }
}
 ?>