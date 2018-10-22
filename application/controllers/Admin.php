<?php 
class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('action');
	}

	public function index(){
		if(!$this->session->userdata('admin_id'))
			redirect('admin/sign_in');
		$this->view('body');
	}

	public function view($pages = ''){
		$raw_pages = array('sign_in','sign_up');
		if(!file_exists( APPPATH.'views/admin/'.$pages.'.php'))
			error('Page not found','admin');
		
		if(!in_array($pages, $raw_pages)){
			if(!$this->session->userdata('admin_id'))
				return error('you are not logged in','admin');
			$data['admin'] = $this->action->get('admin',['admin_id' => $this->session->userdata('admin_id')])->row();
			$data['user'] = $this->action->get('user')->result();
			$data['seller'] = $this->action->get('seller')->result();
			$this->load->view('admin/header',$data);
			$this->load->view('admin/nav');
			$this->load->view('admin/'.$pages);
			$this->load->view('admin/footer');
		}
		else{
			if($this->session->userdata('admin_id'))
				return redirect('admin');
			return $this->load->view('admin/'.$pages);

		}
	}

	public function sign_out(){
		$this->session->sess_destroy('admin_id');
		msg('log out successfull','admin/sign_in');
	}

	public function edit_profile($id){
		$data['result'] = $this->action->edit('admin','admin',"admin_id = $id",['admin_id !=' => $id]);
		if($data['result'] === true)
			return msg('successfully updated','admin/profile');
		$admin = $this->input->post('admin');
		$this->session->set_flashdata('email',$admin['email']);
		$this->session->set_flashdata('error',$data['result']);
		redirect('admin/profile');
	}

	public function sign_in_action(){
		$data['result'] = $this->action->sign_in_validation('admin','admin','admin_id');
		if($data['result'] === true){
			redirect('admin');
		}
		$admin = $this->input->post('admin');
		$this->session->set_flashdata('email',$admin['email']);
		$this->session->set_flashdata('result',$data['result']);
		redirect('admin/sign_in');
	}

	public function sign_up_action(){
		$data['result'] = $this->action->sign_up_validation('admin','admin');
		if(!$data['result']){
			$data['validate'] = false;
			$admin = $this->input->post('admin');
			$this->session->set_flashdata('name',$admin['name']);
			$this->session->set_flashdata('email',$admin['email']);
			$this->session->set_flashdata('contact_no',$admin['contact_no']);
			return $this->load->view('admin/sign_up',$data);
		}
		return	msg('Sign up successfull','admin');
	}


	public function edit($table){
		$data[$table] = $this->action->get($table, [$table.'_id' => $this->input->post('id')])->row();
		$this->load->view('admin/edit',$data);
	}

	public function edit_action($table, $id){
		$data['result'] = $this->action->update($table, $table, $table."_id = $id");
		if(!$data['result'])
			return error('Cannot edit information some error occurred','admin');
		return msg('update success full','admin');
	}

	public function delete($table, $id){
		$data['result'] = $this->action->delete($table,[$table.'_id' => $id]);
		if(!$data['result'])
			return error('Cannot delete, some error occurred.','admin');
		if($table == 'seller')
			return $this->seller_table();
		return $this->user_table();
	}
	
	public function update_status($table,$id){
		$data['result'] = $this->action->update_status($table, [$table.'_id' => $id]);
		if(!$data['result'])
			return error('Cannot change status, some error occurred.','admin');
		if($table == 'seller')
			return $this->seller_table();
		return $this->user_table();
	}

	public function search($table, $like = ''){
		$data[$table] = $this->action->search_like($table, $like);
		if($table == 'seller')
			return $this->load->view('admin/seller_table',$data);
		return $this->load->view('admin/user_table',$data);
	}

	public function user_table(){
		$data['user'] = $this->action->get('user')->result();
		$this->load->view('admin/user_table',$data);
	}

	public function seller_table(){
		$data['seller'] = $this->action->get('seller')->result();
		$this->load->view('admin/seller_table',$data);
	}

}

?>