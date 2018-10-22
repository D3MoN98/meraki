<?php 
class Action extends CI_Model{

	public function get($table,$where = [], $limit = null, $offset = null){
		if(!empty($where))
			return $this->db->get_where($table, $where, $limit, $offset);
		return $this->db->get($table, $limit, $offset);
	}

	public function insert($table,$data){
		$user = input_san($this->input->post($data));
		$user['profile_pic'] = base_url('default.jpg');
		$query = $this->db->insert($table,$user);
		if(!isset($query))
			return false;
		return true;
	}

	public function update($table, $data = '', $where = []){
		$user = input_san($this->input->post($data));
		$query = $this->db->update($table, $user, $where);
		if(!isset($query))
			return false;
		return true;
	}
	
	public function edit($table, $data, $id, $where = []){
		$user = input_san($this->input->post($data));
		if(!empty($where)){
			$where['email'] = $user['email'];
			$check = $this->db->get_where($table, $where);
			if($check->num_rows() == 0){
				$query = $this->db->update($table, $user, $id);
				if(!isset($query))
					return false;
				return true;
			}
			return 'Acount already exist';
		}
	}

	public function replace($table, $set, $where){
		$query = $this->db->update($table,$set,$where);
		if(!isset($query))
			return false;
		return true;
	}

	public function update_status($table, $where){
		if( $this->get($table,$where)->row()->status == 0)
			return $this->replace($table,['status'=>1],$where);
		return $this->replace($table,['status' => 0],$where);
	}

	public function delete($table, $where){
		$query = $this->db->delete($table, $where);
		if(!isset($query))
			return false;
		return true;
	}

	public function join ($get, $from, $join, $on, $where = []){
		$this->db->select($get);
		$this->db->from($from);
		$this->db->join($join, $on);
		$this->db->where($where);
		return $query = $this->db->get();
	}

	public function search_like($table, $like){
		$this->db->get($table);
		$this->db->or_like(array('name' => $like, 'email' => $like, 'contact_no' => $like));
		return $this->get($table)->result();
	}

	public function order_by($column){
		return $this->db->order_by($column);
	}
	
	public function sign_up_validation($table, $data){
		$user = $this->input->post($data);
		$query = $this->db->get_where($table,['email' => $user['email']]);
		if($query->num_rows() != 0)
			return false;
		return $this->insert($table,$data);
	}

	public function sign_in_validation($data, $table, $sess){
		$user = input_san($this->input->post($data));
		$query = $this->db->get_where($table, ['email' => $user['email']]);
		if($query->num_rows() != 0){
			if($user['password'] == $query->row()->password){
				if($this->db->field_exists('status', $table)){
					if($query->row()->status == 0)
						return "You can't sign in. Wait for request from admin";
				}
				$this->session->set_userdata($sess,$query->row($sess));
				return true;
			}
			return "Password not matched";
		}
		return "This acount doesn't exist";
	}

	public function api_sign($userdata){
		$query = $this->action->get('user',['email' => $userdata['email']]);
		$user['name'] = $userdata['name'];
		$user['email'] = $userdata['email'];
		$user['profile_pic'] = $userdata['picture'];
		if($query->num_rows() == 1){
			$this->session->set_userdata('user_id',$query->row('user_id'));			
		}
		else{
			$this->db->insert('user',$user);
			$user_id = $this->db->insert_id();
			$this->session->set_userdata('user_id',$user_id);			
		}
		return true;
	}
	
	public function insert_location	($table, $data, $id){
		$location = $this->input->post($data);
		$location['user_id'] = $id;
		$query = $this->db->insert($table,$location);
		if(!isset($query))
			return false;
		return true;
	}

	public function forget_password(){
		$user = $this->input->post('user');
		$count = $this->get('user',$user)->num_rows();
		if($count != 1)
			return 'Enter valid credentials';
		return true;
	}

	public function change_password(){
		$user = $this->input->post('user');
		$user['password'] = md5($user['password']);
		$query = $this->replace('user',['password' => $user['password']],['user_id' => $user['user_id']]);
		if(!isset($query))
			return false;
		return true;
	}

	public function get_rating($id){
		$count = $this->get('review',['product_id' => $id])->num_rows();
		return $rating = (int) ($this->db->query("SELECT SUM(rate)/$count AS rating FROM review WHERE product_id = $id")->row()->rating);
	}

}

 ?>