<?php 
class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('action');
		$this->load->model('product_model');
	}

	public function sign_up_action(){
		$data['result'] = $this->action->sign_up_validation('user','user');
		if($data['result'])
			msg('Registration Successful','sign_in');
		else{
			$data['validate'] = false;
			$user = $this->input->post('user');
			$this->session->set_flashdata('name',$user['name']);
			$this->session->set_flashdata('email',$user['email']);
			$this->session->set_flashdata('contact_no',$user['contact_no']);
			$this->load->view('sign_up',$data);
		}
	}

	public function sign_in_action(){
		$user = $this->input->post('user');
		if($this->input->post('remember')){
			set_cookie('email', $user['email'], 3600);
			set_cookie('password', $user['password'], 3600);
		}
		$data['result'] = $this->action->sign_in_validation('user','user','user_id');
		if($data['result'] === true){
			redirect();
		}
		$user = $this->input->post('user');
		$this->session->set_flashdata('email',$user['email']);
		$this->session->set_flashdata('result',$data['result']);
		redirect('sign_in');
	}

	public function sign_out(){
        $this->facebook->destroy_session();
		$this->session->sess_destroy('user_id');
		msg('Sign Out Successful','');
	}

	//google login
	public function google_sign_in(){
		redirect($this->google->google_login_url());
	}

	public function google_callback(){
		$gClient = $this->google->get_gClient();
		if(isset($_SESSION['access_token']))
	    {
	        $gClient->setAccessToken($_SESSION['access_token']);
	    }
	    else if(isset($_GET['code']))
	    {
	        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	        $_SESSION['access_token'] = $token;
	    }
	    else
	    {
	        redirect('sign_in');
	        exit();
	    }
	    $oAuth = new Google_Service_Oauth2($gClient);
	    $userdata = $oAuth->userinfo_v2_me->get();
		$data['result'] = $this->action->api_sign($userdata);
		if($data['result'] !== true)
			error();
		redirect();
	}

	public function facebook_sign_in(){
		redirect($this->facebook->login_url());
	}
	
	public function facebook_callback(){
		$userdata = array();
        
        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,name,email,link,gender,locale,cover,picture');

            // Preparing data for database insertion
            $userdata['oauth_provider'] = 'facebook';
            $userdata['oauth_uid'] = $fbUserProfile['id'];
            $userdata['name'] = $fbUserProfile['name'];
            $userdata['email'] = $fbUserProfile['email'];
            $userdata['picture'] = $fbUserProfile['picture']['data']['url'];
        }
        $data['result'] = $this->action->api_sign($userdata);
		if($data['result'] !== true)
			error();
		redirect();
	}

	public function forget_password(){
		$user = $this->input->post('user');
		$data['result'] = $this->action->forget_password();
		if($data['result'] !== true){
			$this->session->set_flashdata('email',$user['email']);
			$this->session->set_flashdata('contact_no',$user['contact_no']);
			$this->session->set_flashdata('result',$data['result']);
			return $this->load->view('forget_password');
		}
		$data['user_id'] = $this->action->get('user',$user)->row()->user_id;
		return $this->load->view('change_password',$data);
	}


	public function forget_change_password(){
		$data['result'] = $this->action->change_password();
		if($data['result'] !== true)
			error();
		return $this->load->view('sign_in');
	}

	public function profile_nav($page, $msg = []){
		$data['user'] = $this->action->get('user',['user_id' => $this->session->userdata('user_id')])->row();
		if(!empty($msg)){
			foreach ($msg as $key => $value) {
				$data[$key] = $value;
			}
		}
		if($page == 'address'){
			$data['state'] = $this->action->order_by('state_name asc')->get('state')->result();
			$data['location'] = $this->action->get('location',['user_id' => $this->session->userdata('user_id')])->result();
			$data['address'] = true;
			$this->load->view('profile_nav',$data);
		}
		else if($page == 'profile'){
			$data['profile'] = true;
			$this->load->view('profile_nav',$data);
		}
		else if($page == 'security'){
			$data['security'] = true;
			$this->load->view('profile_nav',$data);
		}
		else if($page == 'order'){
			$data['order'] = true;
			$this->load->view('profile_nav',$data);
		}
	}

	public function edit_profile($id){
		$data['result'] = $this->action->edit('user','user',"user_id = $id",['user_id !=' => $id]);
		if($data['result'] === true)
			return msg('successfully updated','user/profile');
		$user = $this->input->post('user');
		$this->session->set_flashdata('email',$user['email']);
		$this->session->set_flashdata('error',$data['result']);
		redirect('user/profile');
	}

	public function update_profile_pic(){

		//new img update
        if($_FILES['user_img']['name'] != ''){
        	$this->load->library('upload', $this->set_upload_options());
	        $_FILES['user_img']['name']= time()."-".$_FILES['user_img']['name'];
	        if ( ! $this->upload->do_upload('user_img')){
	            $data['error'] = $this->upload->display_errors();
	           	return error($data['error'],'user/profile');
	        }
	        else{
	        	$data = $this->upload->data();
	            $data['result'] = $this->action->replace('user', ['profile_pic' => base_url('upload/').$data['file_name']], ['user_id' => $this->session->userdata('user_id')]);
	            if(!$data['result'])
	            	return error('File upload unsuccessful','user/profile');
	            return msg('Profile update successful','user/profile');

	        }
        }

        //Same img update
        return msg('One user added','user/profile/');

	}

	public function location($id){
		$data['result'] = $this->action->insert_location('location', 'location' ,$id);
		if($data['result'] === false)
			error('Something went wrong, Please try again', 'user/profile');
		return $this->profile_nav('address');
	}

	public function update_location($id){
		$data['result'] = $this->action->update('location', 'location' ,['location_id' => $id]);
		if($data['result'] === false)
			error('Something went wrong, Please try again', 'user/profile');
		return $this->profile_nav('address',['addr_msg' => 'Location successfully updated']);
	}

	public function delete_location($id){
		$data['result'] = $this->action->delete('location', ['location_id' => $id]);
		if($data['result'] === false)
			error('Something went wrong, Please try again', 'user/profile');
		return $this->profile_nav('address');
	}

	public function change_password($id){
		$old_pw = $this->action->get('user',['user_id' => $id])->row()->password;
		$pw = $this->input->post('password');

		if(md5($pw['old']) != $old_pw && $old_pw != '')
			return $this->profile_nav('security', ['pw_error' => 'password not matched']);
		else if($pw['new'] != $pw['con'])
			return $this->profile_nav('security', ['pw_con_error' => 'password not matched']);

		$data['result'] = $this->action->replace('user', ['password' => md5($pw['new'])],['user_id'=>$id]);
		if($data['result'] === false)
			error('Something went wrong, Please try again', 'user/profile');
		return $this->profile_nav('security', ['pw_change' => 'password successfully updated']);
	}

	public function place_order(){
		$data['location'] = $this->action->get('location' , ['user_id' => $this->session->userdata('user_id')]);
		$this->load->view('order',$data);
	}

	public function order($id = '', $buynow = ''){
		$user = $this->action->get('user',['user_id' => $this->session->userdata('user_id')])->row();
		if($buynow != '')
			$data['result'] = $this->product_model->order($id, true);
		else
			$data['result'] = $this->product_model->order($id);
		if($data['result'] === false)
			return error('your order is not placed','checkout');
		$msg = "<h3>Hello $user->name,</h3>
				<p>Thank you for your order. We’ll send a confirmation when your order ships. For more information about your order details <a href='".base_url('order_details/').$data['result']."'>click here</a></p>";
		$this->email_send($user->email,'Order Details',$msg);
		return msg('your order is placed','user/order_details/'.$data['result']);
	}

	public function order_details($id){
		if(!$this->session->userdata('user_id'))
			return redirect();

		$data['user'] = $this->action->get('user',['user_id' => $this->session->userdata('user_id')])->row();
		$data['order'] = $this->action->get('order',['order_id' => $id])->row();
		$data['order_details'] = $this->action->get('order_details',['order_id' => $id])->result();
		$data['total_price'] = 0;
		foreach ($data['order_details'] as $key) {
			$data['total_price'] += $key->qty*$key->price;
		}
		$this->load->view('header',$data);
		$this->load->view('order_details');
		$this->load->view('footer');
		
	}

	public function cancel_order($id){
		if(!$this->session->userdata('user_id'))
			return redirect();

		$data['result'] = $this->action->replace('order',['is_cancel' => 1],['order_id' => $id]);
		if($data['result'] === false)
			return error('Something went wrong','order_history');
		else{
			$order_details = $this->action->get('order_details',['order_id' => $id])->result();
			foreach ($order_details as $key) {
				$product = $this->action->get('product',['product_id' => $key->product_id])->row();
				$this->action->replace('product',['qty' => $product->qty + $key->qty], ['product_id' => $key->product_id]);

			//email send for order cancellation
			$user = $this->action->get('user',['user_id' => $this->session->userdata('user_id')])->row();
			$msg = "<h3>Hello $user->name,</h3>
					<p>Your order has been successfully canceled. For more information about your order details <a href='".base_url('order_details/').$id."'>click here</a></p>";
			}
			$this->email_send($user->email,'Order Cancellation',$msg);
			return msg('your order is canceled','user/order_details/'.$id);
		}
	}

	public function invoice($id){
		if(!$this->session->userdata('user_id'))
			return redirect();
		$data['order'] = $this->action->get('order',['order_id' => $id])->row();
		$data['order_details'] = $this->action->get('order_details',['order_id' => $id])->result();
		$data['sub_total'] = number_format((float)$this->db->query("SELECT SUM(price*qty) as price FROM order_details WHERE order_id = $id")->row()->price,2);
		$data['name'] = $this->action->get('user',['user_id' => $data['order']->user_id])->row()->name;
		$this->load->view('invoice',$data);
        $html = $this->output->get_output();
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("invoice".$data['order']->order_id, array("Attachment" => false));
		exit(0);

	}

	public function review($id){
		$order_count= $this->action->join('*', 'order', 'order_details', 'order.order_id = order_details.order_id', ['user_id' => $this->session->userdata('user_id'), 'product_id' => $id, 'order_details.status' => 1])->num_rows();
		$review_count = $this->action->get('review',['product_id' => $id,'user_id' => $this->session->userdata('user_id')])->num_rows();
		if($order_count == 0)
			return error('You are not allowed to review this product','product/'.$id);
		if($review_count == 1)
			return error('You already review this product','product/'.$id);
		$data['result'] = $this->product_model->insert_review($id);
		if(!$data['result'])
			return error('Something went wrong, Please try again', 'product/'.$id);
		return msg('review added successfully','product/'.$id);

	}

	public function review_like($id , $reverse = ''){
		$review = $this->action->get('review',['review_id' => $id])->row();
		if($reverse == '')
			$data['result'] = $this->action->replace('review',['like' => $review->like + 1],['review_id' => $id]);
		else
			$data['result'] = $this->action->replace('review',['like' => $review->like - 1],['review_id' => $id]);

		if(!$data['result'])
			return error('Something went wrong, Please try again', 'product/'.$id);
		echo  $this->action->get('review',['review_id' => $id])->row()->like;
	}

	private function email_send($to, $sub = 'Email Test', $msg = 'This is just a test'){
		$config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'meraki.dev.18@gmail.com', // change it to yours
            'smtp_pass' => 'sudipta123', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('meraki.dev.18@gmail.com', 'meraki');
        $this->email->to((string)$to);
        $this->email->subject($sub);
        $this->email->message($msg);
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());exit;
        }
	}

	private function set_upload_options()
	{   
	    $config = array();
	    $config['upload_path'] = FCPATH.'upload/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['max_size']      = '2048';
	    $config['overwrite']     = FALSE;
	    return $config;
	}


}

?>
