<?php 
class Seller extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('action');
		$this->load->model('product_model');
	}

	public function index(){
		if(!$this->session->userdata('seller_id'))
			redirect('seller/sign_in');
		$this->view('body');
	}

	public function view($pages = '', $id = ''){
		$raw_pages = array('sign_in','sign_up');
		if(!file_exists( APPPATH.'views/seller/'.$pages.'.php'))
			error('Page not found','seller');
		
		if(!in_array($pages, $raw_pages)){
			if(!$this->session->userdata('seller_id'))
				return error('you are not logged in','seller');
			$data['seller'] = $this->action->get('seller',['seller_id' => $this->session->userdata('seller_id')])->row();
			$data['products'] = $this->action->get('product',['is_delete' => 0,'seller_id' =>$this->session->userdata('seller_id')])->result();
			$data['product'] = $this->action->get('product',['product_id' => $id])->row();
			$data['product_imgs'] = $this->action->get('product_images',['product_id' => $id])->result();
			$data['catagory'] = $this->action->get('catagory')->result();
			$data['sub_catagory'] = $this->action->get('sub_catagory')->result();
			$this->load->view('seller/header',$data);
			$this->load->view('seller/nav');
			$this->load->view('seller/'.$pages);
			$this->load->view('seller/footer');
		}
		else{
			if($this->session->userdata('seller_id'))
				return redirect('seller');
			return $this->load->view('seller/'.$pages);

		}
	}

	public function sign_in_action(){
		$data['result'] = $this->action->sign_in_validation('seller','seller','seller_id');
		if($data['result'] === true){
			redirect('seller');
		}
		$seller = $this->input->post('seller');
		$this->session->set_flashdata('email',$seller['email']);
		$this->session->set_flashdata('result',$data['result']);
		redirect('seller/sign_in');
	}

	public function sign_up_action(){
		$data['result'] = $this->action->sign_up_validation('seller','seller');
		if(!$data['result']){
			$data['validate'] = false;
			$seller = $this->input->post('seller');
			$this->session->set_flashdata('name',$seller['name']);
			$this->session->set_flashdata('email',$seller['email']);
			$this->session->set_flashdata('contact_no',$seller['contact_no']);
			return $this->load->view('seller/sign_up',$data);
		}
		return	msg('Sign up successful','seller');
	}

	public function sign_out(){
		$this->session->sess_destroy('seller_id');
		msg('log out successful','seller/sign_in');
	}

	public function edit_profile($id){
		$data['result'] = $this->action->edit('seller','seller',"seller_id = $id",['seller_id !=' => $id]);
		if($data['result'] === true)
			return msg('successfully updated','seller/profile');
		$seller = $this->input->post('seller');
		$this->session->set_flashdata('email',$seller['email']);
		$this->session->set_flashdata('error',$data['result']);
		redirect('seller/profile');
	}


	//Category change
	public function catagory($id){
		$data['result'] = $this->action->get('sub_catagory',['catagory_id' => $id])->result();
		echo "<option>Select</option>";
		foreach ($data['result'] as $key) {
			echo "<option value='$key->sub_catagory_id'>$key->name</option>";
		}
	}

	
    //Add product details with with product_img
	public function add_items_action(){
        $this->load->library('upload', $this->set_upload_options());
        $_FILES['product_img']['name']= time()."-".$_FILES['product_img']['name'];
        if ( ! $this->upload->do_upload('product_img')){
            $data['error'] = $this->upload->display_errors();
           	return error($data['error'],'seller/add_items');
        }
        else{
            $data = $this->upload->data();
            $data['result'] = $this->product_model->add_items($data['file_name'],$this->session->userdata('seller_id'));
            if(!$data['result'])
            	return error('File upload unsuccessful','seller/add_items');
            return msg('One product added','seller/add_items');

        }

	}

	//Add product details with with product_img
	public function update_items_action($id){

		//New img update
        if($_FILES['product_img']['name'] != ''){
        	$this->load->library('upload', $this->set_upload_options());
	        $_FILES['product_img']['name']= time()."-".$_FILES['product_img']['name'];
	        if ( ! $this->upload->do_upload('product_img')){
	            $data['error'] = $this->upload->display_errors();
	           	return error($data['error'],'seller/edit_items/'.$id);
	        }
	        else{
	        	$data = $this->upload->data();
	            $data['result'] = $this->product_model->update_items($data['file_name'], ['product_id' => $id]);
	            if(!$data['result'])
	            	return error('File upload unsuccessful','seller/edit_items/'.$id);
	            return msg('One product added','seller/edit_items/'.$id);
	        }
        }

        //Same img update
        else{
        	$data['result'] = $this->product_model->update_items($this->input->post('old_img'), ['product_id' => $id]);
	            if(!$data['result'])
	            	return error('File upload unsuccessful','seller/edit_items'.$id);
	            return msg('One product added','seller/edit_items/'.$id);
        }

	}

	public function multiple_img($id){
		$this->load->library('upload');
		$config = $this->set_upload_options();
		$count = count($_FILES['multiple_img']['name']);
		for($i = 0; $i<$count; $i++){

	        $_FILES['userfile']['name'] = rand(0,1000000)."-".time()."-".$_FILES['multiple_img']['name'][$i];
			$_FILES['userfile']['type']     = $_FILES['multiple_img']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $_FILES['multiple_img']['tmp_name'][$i];
			$_FILES['userfile']['error']    = $_FILES['multiple_img']['error'][$i];
			$_FILES['userfile']['size']     = $_FILES['multiple_img']['size'][$i];
			$this->upload->initialize($config);

		    if ( ! $this->upload->do_upload('userfile')){
	            $data['error'] = $this->upload->display_errors();
	           	return error($data['error'],'seller/edit_items/'.$id);
	        }
	        else{
	        	$data = $this->upload->data();
	        	$data['result'] = $this->product_model->add_imgs($data['file_name'], $id);
	            if(!$data['result'])
	            	return error('File upload unsuccessful','seller/edit_items/'.$id);
	        }
		}
	    return msg($count.' image added','seller/edit_items/'.$id);
	}

	//delete item
	public function delete_items($id){
		$data['result'] = $this->action->replace('product',['is_delete' => '1'],['product_id' => $id]);
		if(!$data['result'])
        	return error('some error occurred','seller');
        return $this->product_table();
	}

	//Product table
	public function product_table(){
		$data['products'] = $this->action->get('product',['is_delete' => 0,'seller_id' => $this->session->userdata('seller_id')])->result();
		$data['catagory'] = $this->action->get('catagory')->result();
		$data['sub_catagory'] = $this->action->get('sub_catagory')->result();
		$this->load->view('seller/product_table',$data);
	}

	public function order_table(){
		$data['order_details'] = $this->action->get('order_details',['seller_id' => $this->session->userdata('seller_id')])->result();
		$this->load->view('seller/order_table',$data);
	}

    //upload an image options
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