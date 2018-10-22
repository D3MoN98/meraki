<?php 
class Product extends CI_Controller
{	

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model');
	}

	public function cart($id = '', $size = ''){
		if($this->session->userdata('user_id')){
			if($id != '' && $size != ''){
				$cart = $this->action->get('cart',['user_id' => $this->session->userdata('user_id'),
					'product_id' => $id,'size' => $size]);

				$product = $this->action->get('product',['product_id' => $id])->row();
				if($cart->num_rows() == 1)
					if($product->qty > $cart->row()->qty)
						$this->action->replace('cart',['qty' => 1+(int)$cart->row()->qty],['cart_id' => $cart->row()->cart_id]);
					else
						$this->action->replace('cart',['qty' => $cart->row()->qty],['cart_id' => $cart->row()->cart_id]);
				else
					$this->product_model->add_to_cart('cart',['user_id' => $this->session->userdata('user_id'),'product_id' => $id, 'size' => $size]);
			}
			$data['product'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
			return $this->load->view('cart',$data);
		}
		echo 'Your are not signed in';
	}

	public function buynow($id = '', $size = ''){
		if(!$this->session->userdata('user_id'))
			return msg('You are not signed in');
		if($id != '' && $size != ''){
			$cart = $this->action->get('cart',['user_id' => $this->session->userdata('user_id'),
				'product_id' => $id,'size' => $size]);
			// $product = $this->action->get('product',['product_id' => $id])->row();
			if($cart->num_rows() != 1){
				$this->product_model->add_to_cart('cart',['user_id' => $this->session->userdata('user_id'),'product_id' => $id, 'size' => $size]);
			}
		}
		$data['buynow'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id'),'cart.product_id' => $id, 'cart.size' => $size]);
		$data['location'] = $this->action->get('location' , ['user_id' => $this->session->userdata('user_id')]);

		$this->load->view('header',$data);
		$this->load->view('buynow');
		$this->load->view('footer');
		// $data['product'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
	}

	public function plus_cart($id){
		$cart = $this->action->get('cart',['cart_id' => $id])->row();
		$product = $this->action->get('product',['product_id' => $cart->product_id])->row();
		if($product->qty > $cart->qty)
			$this->action->replace('cart',['qty' => 1+(int)$cart->qty],['cart_id' => $id]);
		$data['product'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('cart',$data);
	}

	public function minus_cart($id){
		$cart = $this->action->get('cart',['cart_id' => $id])->row();
		$this->action->replace('cart',['qty' => (int)$cart->qty - 1],['cart_id' => $id]);
		$data['product'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('cart',$data);
	}
	
	public function remove_cart($id){
		$this->action->delete('cart',['cart_id' => $id]);
		$data['product'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('cart',$data);
	}

	public function checkout_plus_cart($id){
		$cart = $this->action->get('cart',['cart_id' => $id])->row();
		$product = $this->action->get('product',['product_id' => $cart->product_id])->row();
		if($product->qty > $cart->qty)
			$this->action->replace('cart',['qty' => 1+(int)$cart->qty],['cart_id' => $id]);
		$data['cart'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		$data['location'] = $this->action->get('location' , ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('checkout',$data);
	}

	public function checkout_minus_cart($id){
		$num = $this->action->get('cart',['cart_id' => $id]);
		$this->action->replace('cart',['qty' => (int)$num->row()->qty - 1],['cart_id' => $id]);
		$data['cart'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		$data['location'] = $this->action->get('location' , ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('checkout',$data);
	}
	
	public function checkout_remove_cart($id){
		$this->action->delete('cart',['cart_id' => $id]);
		$data['cart'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $this->session->userdata('user_id')]);
		$data['location'] = $this->action->get('location' , ['user_id' => $this->session->userdata('user_id')]);
		return $this->load->view('checkout',$data);
	}

	public function get_product($id = ''){
		if($id != '')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'sub_catagory' =>$id], 9);
		if($id == 'clothes')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'catagory' => '1'], 9);
		if($id == 'accessories')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'catagory' => '2'], 9);
		if($id == 'all')
			$data['products'] = $this->action->get('product',['is_delete' => 0], 9);


		if($data['products']->num_rows() != 0){
			foreach ($data['products']->result() as $key) {
		       echo "<figure class='products'>
		       	            <a href=". base_url('product/').$key->product_id ."><img src=". base_url('upload/').$key->img .">
		       	            <figcaption>
		       	                <p class='product-title'>". $key->name ."</p>
		       	                <p class='product-price'>". '$'.$key->price ."</p>
	       	            </figcaption></a>";
	       	       if($key->qty == 0)
		                echo   "<div class='loader_container'>
			                        <span class='out_of_stock'>Out of stock</span>
			                    </div>";
		       	echo       "</figure>";
			 }
			if($data['products']->num_rows() >= 9)
				echo "<div>
			            <button id='load_more' value='".$id."'>MORE RESULTS <i class='fas fa-angle-double-right'></i></button>
			        </div>";
		}
		else
			echo '<p>No result found</p>';
	}
	public function load_more($id = '', $offset){
		if($id != '')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'sub_catagory' =>$id], 9, $offset);
		if($id == 'clothes')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'catagory' => '1'], 9, $offset);
		if($id == 'accessories')
			$data['products'] = $this->action->get('product',['is_delete' => 0,'catagory' => '2'], 9, $offset);
		if($id == 'all')
			$data['products'] = $this->action->get('product',['is_delete' => 0], 9, $offset);

		if($data['products']->num_rows() != 0){
			foreach ($data['products']->result() as $key) {
		       echo "<figure class='products'>
		       	            <a href=". base_url('product/').$key->product_id ."><img src=". base_url('upload/').$key->img .">
		       	            <figcaption>
		       	                <p class='product-title'>". $key->name ."</p>
		       	                <p class='product-price'>". '$'.$key->price ."</p>
		       	            </figcaption></a>";
		       	if($key->qty == 0)
	                echo   "<div class='loader_container'>
	                        <span class='out_of_stock'>Out of stock</span>
	                    </div>";
		       	echo       "</figure>";
		    }
		}
	}

	public function get_imgs($id){
		$product = $this->action->get('product_images',['pr_imgs_id' => $id])->row();
		echo base_url('upload/').$product->imgs;
	}


}



 ?>