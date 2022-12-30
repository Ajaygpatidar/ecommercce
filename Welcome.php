<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	// change this
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->helper('cookie');
        $this->load->library('form_validation');
		$this->load->helper('string');
        $this->load->Model('model');
        $this->load->database();
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->library('cart');
	}
	public function index()
	{	
		$data =$this->session->flashdata('c');
		if($this->session->flashdata('c'))
		{
			session_destroy(); 
		}
		$data['k']=$this->model->category();
		$data['key']=$this->model->getproductdetail();
		$data['type']=$this->model->producttype();
		$data['brand']=$this->model->productbrand();
		$data['color']=$this->model->color();
		$data['size']=$this->model->size_filter();
		$data['price']=$this->model->price_filter();
		$this->load->view('header',$data);
		$this->load->view('index');

		if(array_key_exists('recentviewed',$_COOKIE))
		{
			// already set
			$cookie_get=get_cookie('recentviewed');
			$cookieres=unserialize($cookie_get);
			$productids=implode("','", $cookieres);
			///get product details
			$picd="pid IN ('$productids')";
			$data['k']=$this->model->getproductlist($picd);
			$this->load->view('recent',$data);
		}		
		$this->load->view('footer');
	}
	//detail.php function
	public function detail($product_id,$pt)
	{	 
		$data['k']=$this->model->category();
		$data['s']=$this->model->sizeget();
		$data['c']=$this->model->colorget();
		$data['key']=$this->model->get_detail($product_id);
		$this->load->view('header',$data);
		if(array_key_exists('recentviewed',$_COOKIE))
		{
			// already set
			$cookie_get=get_cookie('recentviewed');
			$cookieres=unserialize($cookie_get);
			if(!in_array($product_id, $cookieres))
			{
				$cookieres[]=$product_id;
			}
			delete_cookie('recentviewed');
			// again  set cookie
				$cookievalue=serialize($cookieres);
				$this->input->set_cookie(array("name"=>'recentviewed', 'value'=>$cookievalue, 'expire'=>8));    	
		}
		else
		{
			// cookie set
			$cookie_data[] = $product_id;
			$cookievalue=serialize($cookie_data);
			$this->input->set_cookie(array("name"=>'recentviewed', 'value'=>$cookievalue, 'expire'=>7200));
		 }
		
		$data['Rp']=$this->model->relatedproduct($pt);
		$this->load->view('detail',$data);
	}
	// to view contact
	public function cont()
	{	 
		$this->load->view('contact');
	}
	// cart function
	// public function checkout()
	// {
	// 	$this->load->view('checkout');
	// }
	//cart add to cart page is here
	public function cart()
	{
		$this->load->view('cart');
	}
	// load signup
	public function signin()
	{
		$data['k']=$this->model->category();
		$this->load->view('signup',$data);
	}
	// signin form
	public function registraction()
	{ 
		$this->form_validation->set_rules('name', 'User Name','required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
		$this->form_validation->set_rules('role', 'role','trim|required');
		if ($this->form_validation->run() == FALSE)
        { 
			$this->load->view('signup');
        }
        else
		{
			$res=$this->model->reg();	
			if($res=='4')
			{ 	
				$this->session->set_flashdata('error','These E-mail is already exit');
				redirect('welcome/signin/');
			}
			else
			{	
				redirect('welcome/signin/');
			}
		}
	}
	// load login page
	public function log()
	{
		$data['k']=$this->model->category();
		$this->load->view('login',$data);
	}
	public function login()
	{
		$res=$this->model->logindata();
		
		if($res=='0')
		{
			$this->session->set_flashdata('error','You  Enter Wrong Email');
			redirect('welcome/log');
		}
		if($res=='1')
		{
			$this->session->set_flashdata('error','You  Enter Wrong password');
			redirect('welcome/log');
		}
		if($res=='2')
		{
			$this->session->set_flashdata('error','You are not verified by admin');
			redirect('welcome/log');
		}
		if($res==true)
		{ 
			foreach($res as $row)
			
				$uid = $row->uid;
				$role = $row->role;
				$_SESSION['role']=$role;
				$_SESSION['uid']=$uid;
		
			redirect('Welcome/profile');
		}
	}
	public function profile()
	{
		$uid=$_SESSION['uid'];	
		$role=$_SESSION['role'];
		$data['result']=$this->model->get_data($uid);
		if($role=='admin')
		{
			$this->load->view('adminheader',$data);
			$this->load->view('profile');
		}
		elseif($role=='vender')
		{
			$this->load->view('venderheader',$data);
			$this->load->view('profile');
		}
		elseif($role=='user')
		{
			$this->load->view('userheader',$data);
			$this->load->view('profile');
		}
		elseif($role=='Shipper')
		{
			$this->load->view('shipperheader',$data);
			$this->load->view('profile');
		}
	}  
	// image upload 
	public function upload()
	{
		$uid=$_SESSION['uid'];
		$y = $this->model->imageupload($uid);
		if($y=='8')
		{
			redirect('Welcome/profile');
		} 
	}
	//update detail 
	public function update()
	{
		$uid=$_SESSION['uid'];
		$this->model->editdetail($uid);
		redirect('welcome/profile');
	}
	public function password()
	{
		$uid=$_SESSION['uid'];
		$res=$this->model->changepassword($uid);
		if($res=='0')
		{   	
			$this->session->set_flashdata('error','You  Enter Wrong Old password');
			redirect('welcome/profile');
		}
		elseif($res=='1')
		{ 
			$this->session->set_flashdata('error','match your password');
			redirect('welcome/profile');
		}
		if($res=='2')
		{ 
			$this->session->set_flashdata('sucess','Your password is successfully changed');
			redirect('welcome/profile');
		}
	}
	// logout vender
	public function logout()
	{
		session_destroy();
		$data['id']='log';
		redirect('welcome/index');
	}
	public function newproduct()
	{
		$res['cat']=$this->model->selectcat();
		$res['col']=$this->model->selectcolor();
		$res['size']=$this->model->selectsize();
		$res['slot']=$this->model->priceslot();
		$this->load->view('addproduct',$res);
	}
	public function get_subcat()
	{ 
		$cid=$this->input->post('category_id');
		$cat=$this->model->get_subdata($cid);
		$output="<option selected disabled> After select category</option>";
		foreach($cat as $row)
		{
			$output.="<option value='{$row->subc_id}'>{$row->category_name}</option>";
		}
		echo $output;
	}

	// profile view when session is not destry
	public function vprofile()
	{
		redirect('welcome/profile');
	}
	// get product type id
	public function get_producttype()
	{ 
		$pid=$this->input->post('subid');
		$cat=$this->model->get_productdata($pid);
		$output="<option selected disabled> After select sub category</option>";
		foreach($cat as $row)
		{
			$output.="<option value='{$row->p_id}'>{$row->type_name}</option>";
		}
		echo $output;
	}
	//product 
	public function get_product()
	{
		$mid=$this->input->post('product_id');
		$res=$this->model->get_model($mid);
		$output="<option selected disabled> After category</option>";
		foreach($res as $row)
		{
			$output.="<option value='{$row->mid}'>{$row->product}</option>";
		}
		echo $output;
	}
	public function get_productbrand()
	{
		$bid=$this->input->post('model');
		$res=$this->model->get_brand($bid);
		$output="<option selected disabled> After brand</option>";
		foreach($res as $row)
		{
			$output.="<option value='{$row->bid}'>{$row->pname}</option>";
		}
		echo $output.="<option value='addnewbrand'>add product brand </option>";
	}
	// product upload 
	public function product_upload()
	{	
		$res=$this->model->product_upload();
		if($res==true)
		{
			$this->session->set_flashdata('item','Product Added succesful');
			redirect('welcome/newproduct');
		}
		else{
			$this->session->set_flashdata('item','Product Not added Succesful');
			redirect('welcome/newproduct');
		}
	
	}
	//  non- verify view product at admin panel
	public function nonverifiedvproduct()
	{
		$res['key']=$this->model->nonverifiedvproduct();	
		$this->load->view('viewproduct',$res);
	}
	//  verified product at admin
	public function verifyviewproduct()
	{
		$res['key']=$this->model->verifyviewproduct();	
		$this->load->view('verifyviewproduct',$res);
	}
	// delete non-verified product at admin
	public function deletenonverifyproduct($x)
	{
		$this->model->deletenonverifyproduct($x);
		redirect('welcome/nonverifiedvproduct');
	}
	// delete verified product at admin
	public function deleteverifyproduct($x)
	{
		$this->model->deletenonverifyproduct($x);
		redirect('welcome/verifyviewproduct');
	}
	
	// admin product detail view
	public function viewproductdetail($y)
	{
		$res['key']=$this->model->Viewproductdetail($y);
		$this->load->view('adminproductdetail',$res);
	}
	// view new vender
	public function addnewvender()
	{
		$this->load->view('addnewvender');
	}
	// add new vender
	public function addvender()
	{
		$this->model->insertvender();
		redirect('welcome/addnewvender');
	}
	// view verified  vender to admin
	public function verifiedvender()
	{
		$res['key'] = $this->model->verifiedvender();
		$this->load->view('verifiedvender',$res);
	}

	// edit vender detail
	public function vender_update($x)
	{
		$this->model->vender_update($x);
		redirect('welcome/verifiedvender');
	}
	// block verified vender at admin
	public function blockverifyvender($x)
	{
		$this->model->blockverifyvender($x);
		redirect('welcome/verifiedvender');
	}
	// verify block vender at admin 
	public function verifyblockvender($y)
	{
		$this->model->verifyblockvender($y);
		redirect('welcome/blockvender');
	}
	// view Non-verified  vender to admin
	public function blockvender()
	{
		$res['key'] = $this->model->blockvender();
		$this->load->view('blockvender',$res);
	}
	// block verify shipper from admin
	public function blockverifiedshipper($y)
	{
		$this->model->blockverifyvender($y);
		redirect('welcome/verifiedshipper');
	}
	// edit non verified vender
	public function blockvender_update($y)
	{
		$this->model->blockvender_update($y);
		redirect('welcome/blockvender');
	}
	// View  new shipper
	public function addnewshipper()
	{
		$this->load->view('addnewshipper');
	}
	// add new shipper
	public function addshipper()
	{
		$this->model->insertshipper();
		redirect('welcome/addnewshipper');
	}
	// view verified shipper to admin
	public function verifiedshipper()
	{
		$res['key']=$this->model->verifiedshipper();
		$this->load->view('verifiedshipper',$res);
	}
	//  view non-verified shipper to admin, panel
	public function verifyblockshipper($x)
	{
		$res['key']=$this->model->verifyblockshipper($x);
		redirect('welcome/blockshiper');
	}
	public function blockshiper()
	{
		$res['key']=$this->model->blockshipper();
		$this->load->view('blockshipper',$res);
	}
	// View  user
	public function addnewuser()
	{
		$this->load->view('addnewuser');
	}
	// add new user
	public function adduser()
	{
		$this->model->insertuser();
		redirect('welcome/addnewuser');
	}
	// View Verified User to admin 
	public function verifieduser()
	{
		$res['key']=$this->model->verifieduser();
		$this->load->view('verifieduser',$res);
	}
	// View Non-Verified User to admin 
	public function blockuser()
	{
		$res['key']=$this->model->blockuser();
		$this->load->view('blockuser',$res);
	}
	// verify block user
	public function verifyblockuser($x)
	{
		$res['key']=$this->model->verifyblockuser($x);
		redirect('welcome/blockuser');
	}
	// block verify user
	public function blockverifyuser($x)
	{
		$res['key']=$this->model->blockverifyuser($x);
		redirect('welcome/verifieduser');
	}
	// verified product view to vender panel
	function venderverifyproduct()
	{
		$uid=$_SESSION['uid'];
		$res['key']=$this->model->venderverifyproduct($uid);
		$this->load->view('vvproduct',$res);
	}
	// non-verified product view at vender panel
	function nonvenderverifyproduct()
	{
		$uid=$_SESSION['uid'];
		$res['key']=$this->model->nonvenderverifyproduct($uid);
		$this->load->view('nvproduct',$res);
	}
	// delete vender verify product
	public function deletevvproduct($x)
	{
		$this->model->deletevvproduct($x);
		redirect('welcome/venderverifyproduct');
	}
	// delete vender non-verify product
	public function deletenvproduct($x)
	{
		$this->model->deletevvproduct($x);
		redirect('welcome/nonvenderverifyproduct');
	}
	// load mores by categorieswise
	
	// load more product by ajax
	public function loadmore()
	{
		$position = $this->input->post('position');
		$output="";
		$result= $this->model->loadmore_product($position);
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$output.='
				<div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
					<div class="product-item bg-light mb-4">
						<div class="product-img position-relative overflow-hidden">
							<img class="img-fluid w-100" src="'. base_url($row->img1).'"alt="">
						</div>
						<div class="text-center py-4">
							<a class="h6 text-decoration-none text-truncate" href="'. site_url('welcome/detail/'.$row->pid.'/'.$row->product_type).'">'.$row->product_name.'</a>
							<div class="d-flex align-items-center justify-content-center mt-2">
								<h5>₹ <?php echo  $price;?></h5><h6 class="text-muted ml-2"><del>'.$row->price.'</del></h6>
							</div>
							
						</div>
					</div>
				</div>';
			}
			
			echo $output;
		}
		else
		{
			$output = $output == "" ? "error":$output;
			echo $output;
		}
	}
	// verify product by admin
	public function verifyproduct($x)
	{
		$this->model->verifyproduct($x);
		redirect('welcome/nonverifiedvproduct');
	}
	// block product by admin at admin
	public function blockproduct($y)
	{
		$this->model->blockproduct($y);
		redirect('welcome/verifyviewproduct');
	}
	// edit product by admin 
	public function editproduct($y)
	{ 
		$res['key'] = $this->model->editproduct($y);
		$res['p'] = $this->model->categoryedit();
		$res['s'] = $this->model->selectsize();
		$res['c'] = $this->model->selectcolor();
		$this->load->view('editproduct',$res);
	}
	// update product by admin (edit)
	public function updateproduct($x)
	{
		$this->model->updateproduct($x);
		redirect('welcome/verifyviewproduct');
	}
	// manage category
	public function managecategory()
	{
		$data['key'] = $this->model->managecategory();
		$this->load->view('managecategory',$data);
	}
	// manage  add category 
	public function addcategory()
	{
		$this->model->addcategory();
		redirect('welcome/managecategory');
	}
	// manage edit category
	public function editcategory($x)
	{
		$this->model->editcategory($x);
		redirect('welcome/managecategory');
		
	}
	// manage sub-category
	public function managesubcategory()
	{
		$data['key'] = $this->model->managesubcategory();
		$data['sub'] = $this->model->subcategory();
		$this->load->view('managesubcategory',$data);
	}
	// manage  add sub-category 
	public function addsubcategory()
	{
		$this->model->addsubcategory();
		redirect('welcome/managesubcategory');
	}
	// manage edit sub-category
	public function editsubcategory($x)
	{
		$this->model->editsubcategory($x);
		redirect('welcome/managesubcategory');
	}
	// manage product typw
	public function manageproducttype()
	{
		$data['key'] = $this->model->managesubcategory();
		$data['p'] = $this->model->manageproducttype();
		$this->load->view('manageproducttype',$data);
	}
	public function getsubcategory()
	{
		$cid=$this->input->post('category');
		$cat=$this->model->get_subdata($cid);
		$output="<option selected disabled> After select category</option>";
		foreach($cat as $row)
		{
			$output.="<option value='{$row->subc_id}'>{$row->category_name}</option>";
		}
		echo $output;
	}
	// add product type
	public function addproducttype()
	{
		$this->model->addproducttype();
		redirect('welcome/manageproducttype');
	}
	// edit product type
	public function editproducttype($x)
	{
		$this->model->editproducttype($x);
		redirect('welcome/manageproducttype');
	}
	// manage model 
	public function managemodel()
	{
		$data['key'] = $this->model->managesubcategory();
		$data['m'] = $this->model->managemod();
		$this->load->view('managemodel',$data);
	}
	public function sub_category()
	{
		$cid=$this->input->post('category');
		$cat=$this->model->get_subdata($cid);
		$output="<option selected disabled> After select category</option>";
		foreach($cat as $row)
		{
			$output.="<option value='{$row->subc_id}'>{$row->category_name}</option>";
		}
		echo $output;
	}
	public function getmodal()
	{
		$pid=$this->input->post('subid');
		$cat=$this->model->get_productdata($pid);
		$output="<option selected disabled> After select sub category</option>";
		foreach($cat as $row)
		{
			$output.="<option value='{$row->p_id}'>{$row->type_name}</option>";
		}
		echo $output;
	}
	// add model
	public function addmodal()
	{
		$this->model->addmodal();
		redirect('welcome/managemodel');
	}
	// edit modal
	public function editmodal($x)
	{
		$this->model->editmodal($x);
		redirect('welcome/managemodel');
	}
	// select by category 
	public function selectbycategory($cid)
	{
		$data['c'] = $this->model->selectcategory($cid);
		$_SESSION['c']=$data;
		$this->session->mark_as_flash('c');
		// $this->session->set_flashdata('c',$data);
		redirect('welcome/index/');
	}

	// filteraction data for instant search
	public function filter()
	{
		$result = $this->model->filter_data();
		if($result)
		{
			$output="";
			foreach($result as $row)
			{
				$output.=' 
					<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
						<div class="product-item bg-light mb-4 " >
							<div class="product-img position-relative overflow-hidden">
								<img class="img-fluid w-100" src="'.base_url($row->img1).'" alt="" style="height:300px">
							</div>
							<div class="text-center py-4">
								<a class="h6 text-decoration-none text-truncate" href="'.site_url('welcome/detail/'.$row->pid.'/'.$row->product_type ).'">'. $row->product_name.'</a>
								<div class="d-flex align-items-center justify-content-center mt-2">
									<h5>₹ '.$row->price.'</h5><h6 class="text-muted ml-2"></h6>
								</div>				
							</div>		
						</div>
					</div>';
			}
			echo $output;
		}
		else
		{
			echo '<h3>No data found</h3>';
		}
	}
	
	// Add to cart
	public function addtocart($x)
	{
		if(isset($_SESSION['uid']))
		{
			$cid=$this->input->post('color');
			$sizeid=$this->input->post('size');
		    $p=$this->model->addtocart($x);
			if($p==true)
			{
				$a=preg_replace("/[^a-zA-Z0-9]+/"," ", $p['product_name']);
		     $data = array(
				'id' => $p['pid'],
				'qty' => 1,
				'cid' =>$cid,
				'sid' =>$sizeid,
				'price' => $p['price'],
				'name' => $a,
				'img' => $p['img1'],
				);
			$this->cart->insert($data);
			redirect('welcome/cart');
			}
		}
		else
		{
			$this->session->set_flashdata('error','** First login your account then add to cart');
			redirect('welcome/log');
		}
	}
	public function updatecart()
	{  
		$id=$this->input->post('id');
	    $qty=$this->input->post('qty');
	    $data = array(
		'rowid'   =>$id,
		'qty'     =>$qty,
		);	
		$this->cart->update($data);
	}
	// remove the cart
	public function cartremove($rowid)
	{
		$delete = array(
            'rowid'   => $rowid,
            'qty'     => 0,
        );
        $this->cart->update($delete);
		redirect('welcome/cart');
	}
	// discount 
	public function discount($x)
	{
		$d=$this->input->post('discount');
		
		$res1=$this->model->get_promocode();
		$date=date('Y-m-d');
		foreach($res1 as $row)
		$promo=$row->promocode;
		$p_id=$row->pid;
		$sdate=$row->start_date;
		$edate=$row->end_date;
		if(!empty($d))
		{
			if($d==$promo)
			{ 
				if($sdate<=$date && $edate>=$date)
				{
					if($p_id==$x)
					{
					   	$this->load->view('cart',$res1);
					}
					else
					{
						$this->session->set_flashdata('error','** Your promocode is not valid on these item');
				    	redirect('welcome/cart');
					}
				}
				else
				{
					$this->session->set_flashdata('error','** Your promocode date is not valid');
				    redirect('welcome/cart');
				}
			}
			else
			{
				$this->session->set_flashdata('error','** You enter Wrong Coupon promocode');
				redirect('welcome/cart');
			}
		}
		else
		{
			$this->session->set_flashdata('error','** Please apply promocode');
			redirect('welcome/cart');
		}
		
	}
	// proceed for checkout
	public function checkout()
	{
		if(isset($_SESSION['uid']))
		{
			$uid=$_SESSION['uid'];
			$res1['k']=$this->model->get_detail_user($uid);
			$this->load->view('checkout',$res1);
		}
		else
		{
			$this->session->set_flashdata('error','** First login your account then checkout');
			redirect('welcome/log');
		}
	}
	
	public function Billing_address()
	{
		
		$this->model->billing_add();
		// $this->load->view('show');
	}
}