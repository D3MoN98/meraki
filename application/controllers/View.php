<?php 
class View extends CI_Controller
{	
	public function __construct(){
		parent::__construct();
		$this->load->model('action');
		$this->load->model('product_model');
	}

	public function index(){
		$this->view('body');
	}

	public function view($pages = '', $id = ''){

		$raw_pages = array('sign_in','sign_up','change_password','forget_password');
		$static_pages = array('contact_us','about_us','terms_and_conditions','dmca_notice','campaign_directory','interest_based_ads');
		$not_session_pages = array('body','product','privacy_policy');
		if(!file_exists( APPPATH.'views/'.$pages.'.php') && !in_array($pages, $static_pages))
			return error('Page not found');

		if($this->session->userdata('user_id') && in_array($pages, $raw_pages))
			return redirect();

		if(in_array($pages, $static_pages)){
			$data['header'] = ucwords(strtolower(str_replace('_', ' ', $pages)));
			$this->load->view('header',$data);
			$this->load->view('static');
			$this->load->view('footer');
		}

		else if(!in_array($pages, $raw_pages) && !in_array($pages, $static_pages)){
			if(!$this->session->userdata('user_id') && !in_array($pages, $not_session_pages))
				return redirect();

			$user_id = $this->session->userdata('user_id');
			$data['products'] = $this->action->get('product',['is_delete' => 0], 9)->result();
			$data['product'] = $this->action->get('product',['product_id' => $id])->row();
			if($id != '')
			$data['product_sold'] = $this->db->query("SELECT SUM(qty) as qty FROM order_details WHERE product_id = $id AND status = 1")->row()->qty;
			if($id != ''){
				$tags = $data['product']->tags;
				$array = explode(',',$tags);
				for ($i=0 ; $i < count($array); $i++) { 
					$like =  $array[$i];
					$count = $this->db->query("SELECT * FROM `product` WHERE `product_id` != '$id' AND `tags` LIKE '%$like%'  ORDER BY RAND() LIMIT 5")->num_rows();
					$array2[$count] = "SELECT * FROM `product` WHERE `product_id` != '$id' AND `tags` LIKE '%$like%'  ORDER BY RAND() LIMIT 5" ;
				}
				$max_count = max(array_keys($array2));
				$data['extra_product'] = $this->db->query($array2[$max_count])->result();
			}
			$data['product_imgs'] = $this->action->get('product_images',['product_id' => $id])->result();
			$data['sub_catagory_clothes'] = $this->action->get('sub_catagory',['catagory_id' => 1])->result();
			$data['sub_catagory_accessories'] = $this->action->get('sub_catagory',['catagory_id' => 2])->result();
			$data['cart'] = $this->action->join('*', 'product', 'cart', 'product.product_id = cart.product_id', ['user_id' => $user_id]);
			if($this->session->userdata('user_id'))
				$data['order'] = $this->db->query("SELECT * FROM `order` WHERE `user_id` = $user_id ORDER BY `order_id` desc")->result();
			$data['review'] = $this->action->get('review',['product_id' => $id])->result();
			if($id != '')
				$data['rating'] = $this->action->get_rating($id);
			$data['location'] = $this->action->get('location' , ['user_id' => $user_id]);
			$data['user'] = $this->action->get('user',['user_id' => $user_id])->row();
			$this->load->view('header',$data);
			$this->load->view($pages);
			$this->load->view('footer');
		}
		else
			return $this->load->view('/'.$pages);
	}

	public function products(){
		$data['sub_catagory_clothes'] = $this->action->get('sub_catagory',['catagory_id' => 1])->result();
		$data['sub_catagory_accessories'] = $this->action->get('sub_catagory',['catagory_id' => 2])->result();
		$data['products'] = $this->product_model->search_product('product')->result();
		$this->load->view('header',$data);
		$this->load->view('products');
		$this->load->view('footer');
	}

	// public function privacy_policy(){

	// }


}

 ?>