<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Google
{
	private $gClient;

	public function __construct(){
		require_once "GoogleApi/vendor/autoload.php";
		$this->gClient = new Google_Client();
		$this->gClient->setClientId("964646674771-62inkrbiv4qm5tmscgub2dfms91ic4ld.apps.googleusercontent.com");
		$this->gClient->setClientSecret("Tpx-MfxMX18nZTHDtL372Ycm");
		$this->gClient->setApplicationName("meraki");
		$this->gClient->setRedirectUri("https://localhost/meraki/user/google_callback");
		$this->gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");
	}

	public function google_login_url(){
		return $this->gClient->createAuthUrl();
	}

	public function get_gClient(){
		return $this->gClient;
	}
}



 ?>