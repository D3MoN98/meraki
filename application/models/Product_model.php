<?php 
class Product_model extends CI_Model
{
	public function add_items($img,$id){
		$product = $this->input->post('product');
		$product['seller_id'] = $id;
		if(isset($product['size']))
			$product['size'] = implode(',', $product['size']);
		$product['slug'] = strtolower(str_replace(' ', '-', $product['name']));
		$product['img'] = $img;
		$query = $this->db->insert('product',$product);
		if(!isset($query))
			return false;
		return true;
	}

	public function add_imgs($img,$id){
		$product['imgs'] = $img;
		$product['product_id'] = $id;
		$query = $this->db->insert('product_images',$product);
		if(!isset($query))
			return false;
		return true;
	}
	
	public function update_items($img, $where){
		$product = $this->input->post('product');
		if(isset($product['size']))
			$product['size'] = implode(',', $product['size']);
		$product['slug'] = strtolower(str_replace(' ', '-', $product['name']));
		$product['img'] = $img;
		$query = $this->db->update('product', $product, $where);
		if(!isset($query))
			return false;
		return true;
	}
	
	public function add_to_cart($table,$data){
		$query = $this->db->insert($table,$data);
		if(!isset($query))
			return false;
		return true;
	}

	public function order($product_id = '' , $buynow = false ,$size = ''){
		$order = $this->input->post('order');
		$size = $this->input->post('size');

		$location = $this->db->get_where('location',['location_id' => $order['location']])->row();
		$state = $this->action->join ('state_name', 'location', 'state', 'location.state_id = state.state_id',['location_id' => $order['location']])->row()->state_name;
		$order['location'] = $location->address.', '.$location->city.' - '.$location->pincode.', '.$state;
		$order['user_id'] = $this->session->userdata('user_id');
		$this->db->insert('order',$order);
		$order_id = $this->db->insert_id();
		if($buynow == true)
			$result = $this->order_details($order_id,$product_id,true, $size);
		else
			$result = $this->order_details($order_id,$product_id);
		if(!isset($result))
			return false;
		return $order_id;
	}

	private function order_details($order_id, $product_id = '', $buynow = false , $size = ''){
		$order_details['order_id'] =  $order_id;
		$cart = $this->action->get('cart' , ['user_id' => $this->session->userdata('user_id')])->result();
		if($product_id != '' && $size == '')
			$cart = $this->action->get('cart' , ['user_id' => $this->session->userdata('user_id'),'product_id' => $product_id])->result();
		else if($product_id != '' && $size != '')
			$cart = $this->action->get('cart' , ['user_id' => $this->session->userdata('user_id'),'product_id' => $product_id,'size' => $size])->result();
		foreach ($cart as $key) {
			$order_details['product_id'] = $key->product_id;
			$order_details['seller_id'] = $this->db->get_where('product',['product_id' => $key->product_id])->row()->seller_id;
			$order_details['size'] = $key->size;
			if($buynow == true)
				$order_details['qty'] = 1;
			else
				$order_details['qty'] = $key->qty;
			$order_details['price'] = $this->action->join('price', 'product', 'cart', 'product.product_id = cart.product_id',['user_id' => $this->session->userdata('user_id'), 'product.product_id' => $key->product_id])->row()->price;
			$result = $this->db->insert('order_details',$order_details);
			if($buynow == true)
				$qty = $this->action->get('product',['product_id' => $key->product_id])->row()->qty - 1;
			else
				$qty = $this->action->get('product',['product_id' => $key->product_id])->row()->qty - $key->qty;
			$this->db->update('product',['qty' => $qty], ['product_id' => $key->product_id]);
			if($buynow != true)
				$this->db->delete('cart',['cart_id' => $key->cart_id]);
			if(!$result)
				return false;
		}
		return true;
	}


	public function insert_review($id){
		$review = $this->input->post('review');
		$review['user_id'] = $this->session->userdata('user_id');
		$review['product_id'] = $id;
		$query = $this->db->insert('review',$review);
		if(!isset($query))
			return false;
		return true;
	}

	public function search_product(){
		$key = $this->input->get('keyword');
		$this->session->set_flashdata('keyword',$key);
		$this->db->get('product');
		$this->db->or_like(['name' => $key,'tags' => $key]);
		return $this->action->get('product',['is_delete' => 0]);
	}
}

 ?>