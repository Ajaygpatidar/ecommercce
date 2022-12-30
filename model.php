<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class model extends CI_Model
    {
        public function reg()
        {  
            $e= $this->input->post('email');
            $this->db->where('email',$e);
            $r=$this->db->get('user')->result();
            foreach($r as $row)
            $em=$row->email;
            if($e==$em)
            { 
                // When email is matched;
               return 4; 
            }
            else
            {
                $data['name'] = $this->input->post('name');
                $data['mobile'] = $this->input->post('mobile');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');
                $data['role'] = 'user';   
                return $this->db->insert('user',$data);
            }
        }  
        public function logindata()
        {   
            $eml = $this->input->post('email');
            $pass = $this->input->post('password');
            $this->db->where("email",$eml);  
            $this->db->where("password",$pass);
            $r=$this->db->get('user')->result();
            foreach($r as $row)
            {
                $em = $row->email;
                $psw = $row->password;
                $ver = $row->is_verified;
            }
            if($eml==$em)
            {
                if($pass==$psw)
                {
                    if(!empty($ver))
                    {
                        $this->db->where("email",$eml);  
                        $this->db->where("password",$pass);
                        return $this->db->get('user')->result();
                    }
                   else
                   {
                      return 2;
                   }
                }
                else
                {
                    return 1;
                }
            }
            else
            {
                return 0;
            }
        } 
        // profile dashboard
        public function get_data($uid)
        {
            $this->db->where('uid',$uid);
            return $this->db->get('user')->result();
        }
        public function imageupload($uid)
        {
            $config['upload_path']='./images/';
            $config['allowed_types']='gif|JPG|jpg|JPEG|JPEG|PNG|png';
            $config['max_size'] = 0;
            $this->load->library('upload',$config);
            $p=$this->upload->do_upload('img');
            if($p>0)
            {
                $img= $this->upload->data();
                $data['img']="images/".$img['file_name'];
                $this->db->where('uid',$uid);
                $this->db->update('user',$data);
                return 8;
            }
        }
        //edit detail
        public function editdetail($uid)
        {
            $x['name']=$this->input->post('n');
            $x['mobile']=$this->input->post('m');
            $x['email']=$this->input->post('e');
            $x['address']=$this->input->post('add');
            $this->db->where("uid",$uid);
            return $this->db->update('user',$x);
        }
        // change password
        public function changepassword($uid)
        {
            $op=$this->input->post('opassword');
            $np=$this->input->post('npassword');
            $cp=$this->input->post('cpassword');
            $this->db->where("uid",$uid);
            $r = $this->db->get('user')->result();
            foreach($r as $row)
            {
               $psw = $row->password;
            }
            if($op==$psw)
            {
               
                if($np==$cp)
                {
                    $data['password']=$this->input->post('cpassword');
                    $this->db->update('user',$data);
                    return 2;
                }
                else
                {
                    //match the passwoord
                    return 1;
                }
            }
            else
            {
                // old password Wrong
                return 0;
            }
        }
        public function selectcat()
        {
            return $this->db->get('category')->result();
        }
        // select color 
        public function selectcolor()
        {
            return $this->db->get('color')->result();
        }
        // select category for add new product
        public function get_subdata($cid)
        {
            $this->db->where('cid',$cid);
            return $this->db->get('sub_category')->result();
        }
        public function get_productdata($pid)
        {
            $this->db->where('subc_id',$pid);
            return $this->db->get('product_type')->result();
        }
        // model 
        public function get_model($mid)
        {
            $this->db->where('pid',$mid);
            return $this->db->get('modal')->result();
        }
        // brand 
        public function get_brand($bid)
        {
            $this->db->where('mid',$bid);
            return $this->db->get('product_brand')->result();
        }
        // size
        public function selectsize()
        {
            return $this->db->get('size_cloth')->result();
        }
        // price slot
        public function priceslot()
        {
            return $this->db->get('price_slot')->result();
        }
        // upload product detail
        public function product_upload()
        {
            $config['upload_path']=FCPATH.'file/';
            $config['allowed_types']='gif|JPG|jpg|JPEG|JPEG|PNG|png';
            $config['max_size']="26200";
            $this->load->library('upload');
            $this->upload->initialize($config);
            $this->upload->do_upload('img1');
            $img= $this->upload->data();
            $data['img1']="file/".$img['file_name'];
            $this->upload->do_upload('img2');
            $img1= $this->upload->data();
            $data['img2']="file/".$img1['file_name'];
            $this->upload->do_upload('img3');
            $img2= $this->upload->data();
            $data['img3']="file/".$img2['file_name'];
            $data['vender_id']= $_SESSION['uid'];
            $data['product_name']= $this->input->post('pname');
            $data['category_id']=$this->input->post('category_id');
            $data['sub_category']=$this->input->post('subid');
            $data['product_type']= $this->input->post('product_id');
            $s=$this->input->post('size');
            $data['size_id']= implode(',',$s);
            $c= $this->input->post('color');
            $data['color_id']= implode(',',$c);
            $data['price']=$this->input->post('price');
            $data['price_slot']= $this->input->post('priceslot');
            $data['quantity']= $this->input->post('quantity');
            $data['description']=$this->input->post('description');
            $m=$data['modal']=$this->input->post('model');
            $d=$this->input->post('addproductbrand');
            if(!empty($d))
            {
                $this->db->query("insert into product_brand(mid, pname) values('$m','$d')");
                $data['brand_name']=  $this->db->insert_id();
                return $this->db->insert('product_detail',$data);
                $pid=$this->db->insert_id();
            }
            else
            {  
                $data['brand_name']= $this->input->post('pbrand');
                return $this->db->insert('product_detail',$data);
            }
        }
        // size for daitel page
        public function sizeget()
        {
            return $this->db->get('size_cloth')->result();
        }
         // Color for detail page
         public function colorget()
         {
             return $this->db->get('color')->result();
         }
        // show product in index
        public function getproductdetail()
        {
           return $this->db->query("select * from product_detail where is_verify='1'and is_deleted='0' order by pid DESC limit 0,9")->result();
        }
        //  show product on detail page
        public function get_detail($product_id)
        {  
            $this->db->select('product_detail.product_name,product_detail.brand_name,product_detail.img1,product_detail.img2,product_detail.img3,product_detail.size_id,product_brand.pname,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('pid',$product_id);
            return $this->db->get()->result();
        }
        // related product show on detail.php
        public function relatedproduct($pt)
        {
            return $this->db->query("select * from product_detail where product_type='$pt' and is_verify='1'")->result();
        }
        // category to show
        public function category()
        {
            return  $this->db->get('category')->result();
        }
        // producttype for 
        
        public function producttype()
        { 
            return  $this->db->get('product_type')->result();
        }
        // productbrand  for filter
        public function productbrand()
        {
            return  $this->db->get('product_brand')->result();
        }
        // color for filtraction 
        public function color()
        {
            return  $this->db->get('color')->result();
        }
        //  size filtraction 
        public function size_filter()
        {
            return  $this->db->get('size_cloth')->result();
        }
        public function price_filter()
        {
            return  $this->db->get('price_slot')->result();
        }
        // add new vender
        public function insertvender()
        {
                $data['name'] = $this->input->post('name');
                $data['mobile'] = $this->input->post('mobile');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');
                $data['address'] = $this->input->post('address');
                $data['role'] = 'vender';   
                return $this->db->insert('user',$data);
        }
      
        // view verified vender to admin
        public function verifiedvender()
        { 
            $this->db->where('role','vender');
            $this->db->where('is_verified',1);
            $this->db->where('is_delete',0);
            return $this->db->get('user')->result();
        }
        // block verified vender at admin
        public function blockverifyvender($x)
        {
            $this->db->where('uid',$x);
            $this->db->set('is_verified',0);
            return $this->db->update('user');
        }
        // verify block vender at admin
        public function verifyblockvender($y)
        {
            $this->db->where('uid',$y);
            $this->db->set('is_verified',1);
            return $this->db->update('user');
        }
        // block verify shipper from admin
      
        // view Non-verified vender to admin
        public function blockvender()
        {
            $this->db->where('role','vender');
            $this->db->where('is_verified',0);
            $this->db->where('is_delete',0);
            return $this->db->get('user')->result();
        }
        // edit vender at admin panel
        public function vender_update($x)
        {
            $data['name'] = $this->input->post('name');
            $data['mobile'] = $this->input->post('mobile');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $this->db->where('uid',$x);
            return $this->db->update('user',$data);
        }
        // edit block vender at admin panel
        public function blockvender_update($y)
        {
            $data['name'] = $this->input->post('name');
            $data['mobile'] = $this->input->post('mobile');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $this->db->where('uid',$y);
            return $this->db->update('user',$data);
        }
       
        // add new Shipper
        public function insertshipper()
        {
            $data['name'] = $this->input->post('name');
            $data['mobile'] = $this->input->post('mobile');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['address'] = $this->input->post('address');
            $data['role'] = 'shipper';   
            return $this->db->insert('user',$data);
        }
        // view verified shipper to admin
        public function verifiedshipper()
        {
            $this->db->where('role','shipper');
            $this->db->where('is_verified',1);
            $this->db->where('is_delete',0);
            return $this->db->get('user')->result();
        }
        // view non-verified shipper to admin
        public function blockshipper()
        {
            $this->db->where('role','shipper');
            $this->db->where('is_verified',0);
            $this->db->where('is_delete',0);
            return $this->db->get('user')->result();
        }
        public function verifyblockshipper($x)
        {
            $this->db->where('uid',$x);
            $this->db->set('is_verified',1);
            return $this->db->update('user');
        }
        // add new User
        public function insertuser()
        {
            $data['name'] = $this->input->post('name');
            $data['mobile'] = $this->input->post('mobile');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['address'] = $this->input->post('address');
            $data['role'] = 'user';   
            return $this->db->insert('user',$data);
        }
        // verify block user
        public function verifyblockuser($x)
        {
            $this->db->where('uid',$x);
            $this->db->set('is_verified',1);
            return $this->db->update('user');
        }
        public function blockverifyuser($x)
        {
            $this->db->where('uid',$x);
            $this->db->set('is_verified',0);
            return $this->db->update('user');
        }
        // verified user to admin
        public function verifieduser()
        {
            $this->db->where('role','user');
            $this->db->where('is_verified',1);
            $this->db->where('is_delete',0);
            return $this->db->get('user')->result();
        }
         // Non-verified user to admin
         public function blockuser()
         {
             $this->db->where('role','user');
             $this->db->where('is_verified',0);
             $this->db->where('is_delete',0);
             return $this->db->get('user')->result();
         }
        // load more
        public function loadmore_product($position)
        {
            $position=$position*9;
            return $this->db->query("select * from product_detail order by pid DESC limit {$position},9 ")->result();
          
        }
        // load more by categories wise
        public function loadmore_products($position)
        {
            $position=$position*9;
            return $this->db->query("select * from product_detail where category_id='1' order by pid DESC limit {$position},9 ")->result();
        }
        // view product detail at vender panel
        public function venderverifyproduct($uid)
        {
            $this->db->select('product_detail.product_name,product_detail.img1,product_detail.brand_name,product_detail.size_id,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('vender_id',$uid );
            $this->db->where('is_verify',1);
            $this->db->where('is_deleted',0);
            return $this->db->get()->result();
        }
        // non verified product at vender panel
        public function nonvenderverifyproduct($uid)
        {
            $this->db->select('product_detail.product_name,product_detail.img1,product_detail.brand_name,product_detail.size_id,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('vender_id',$uid );
            $this->db->where('is_verify',0);
            $this->db->where('is_deleted',0);
            return $this->db->get()->result();
        }
        // delete verify-product by vender
        public function deletevvproduct($x)
        {
            $this->db->where('pid',$x);
            $this->db->set('is_deleted',1);
            $this->db->update('product_detail');
        }
         //  non- verified  product in table at admin panel
         public function nonverifiedvproduct()
         {
            $this->db->select('product_detail.product_name,product_detail.brand_name,product_detail.img1,user.name,product_detail.size_id,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('user','product_detail.vender_id = user.uid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('is_verify',0);
            $this->db->where('is_deleted',0);
            return $this->db->get()->result();
         }
        //  verified product at admin panel
        public function verifyviewproduct()
        {
            $this->db->select('product_detail.product_name,product_detail.brand_name,product_detail.img1,user.name,product_detail.size_id,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('user','product_detail.vender_id = user.uid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('is_verify',1);
            $this->db->where('is_deleted',0);
            return $this->db->get()->result();
        }
        // delete not-verify product at admin
        public function deletenonverifyproduct($x)
        {
            $this->db->where('pid',$x);
            $this->db->set('is_deleted',1);
            $this->db->update('product_detail');
        }
        // view all product to admin when clik on view by pid
        public function viewproductdetail($y)
        {
            $this->db->select('product_detail.product_name,user.name,product_detail.product_type,product_detail.quantity,product_detail.description,product_detail.img1,product_brand.pname,product_detail.pid,category.category_name,product_detail.price,color.color_name,size_cloth.size_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('user','product_detail.vender_id = user.uid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('pid',$y);
            return $this->db->get()->result();
        }
        // verify product by admin from admin panel
        public function verifyproduct($x)
        {
            $this->db->where('pid',$x);
            $this->db->set('is_verify',1);

            $this->db->update('product_detail');
        }
        // block product by admin at admin 
        public function  blockproduct($y)
        {
            $this->db->where('pid',$y);
            $this->db->set('is_verify',0);
            $this->db->update('product_detail');
        }
        // edit product at admin dashboard
        public function editproduct($y)
        {
            $this->db->select('product_detail.product_name,product_detail.brand_name,product_detail.sub_category,,product_detail.modal,product_detail.category_id,product_detail.size_id,product_type.type_name,product_detail.description,product_detail.category_id,product_detail.color_id,product_detail.brand_name,product_detail.product_type,product_detail.size_id,product_detail.color_id,product_detail.pid,product_detail.quantity,category.category_name,product_detail.price,size_cloth.size_name,color.color_name');
            $this->db->from('product_detail');
            $this->db->join('category','product_detail.category_id = category.cid');
            $this->db->join('product_brand','product_detail.brand_name = product_brand.bid');
            $this->db->join('product_type','product_detail.product_type = product_type.p_id');
            $this->db->join('size_cloth','product_detail.size_id = size_cloth.size_id');
            $this->db->join('color','product_detail.color_id = color.color_id');
            $this->db->where('pid',$y);
            return $this->db->get()->result();
        }
        // select category for edit product
        public function categoryedit()
        {
            return $this->db->get('category')->result();
        }
        // update product by admin on admin panel
        public function updateproduct($x)
        {
            $data['product_name']=$this->input->post('name');
            $data['category_id']=$this->input->post('category_id');
            $data['sub_category']=$this->input->post('subcid');
            $data['product_type']=$this->input->post('product_id');
            $data['modal']=$this->input->post('model');
            $data['price']=$this->input->post('price');
            $data['brand_name']=$this->input->post('pbrand');
            $data['size_id']=$this->input->post('size');
            $data['color_id']=$this->input->post('color');
            $data['quantity']=$this->input->post('quantity');
            $data['description']=$this->input->post('des');
            $this->db->where("pid",$x);
            return $this->db->update('product_detail',$data);
        }
        // manage category
        public function managecategory()
        {
            return $this->db->get('category')->result();
        }
        // add category
        public function addcategory()
        {
            $data['category_name'] = $this->input->post('addcategory');
            return $this->db->insert('category',$data);
        }
        // edit category
        public function editcategory($x)
        {
            $data['category_name'] = $this->input->post('editcategory');
            $this->db->where('cid',$x);
            return $this->db->update('category',$data);
        }
        // manage sub-category
        public function managesubcategory()
        {
            return $this->db->get('category')->result();
        }
        // manage  select sub category
        public function subcategory()
        {
            return $this->db->get('sub_category')->result();
        }
        // manage add Sub-category
        public function addsubcategory()
        {
            $c = $this->input->post('category');
            $sc = $this->input->post('addsubcategory');
            $this->db->query("INSERT into sub_category (cid,category_name) values('$c','$sc')");
        }
        // edit Sub-category
        public function editsubcategory($x)
        {
            $data['category_name'] = $this->input->post('editsubcategory');
            $this->db->where('subc_id',$x);
            return $this->db->update('sub_category',$data);
        }
        // manage select product type to show in table
        public function manageproducttype()
        {
            return $this->db->get('product_type')->result();
        }
        // add product type
        public function addproducttype()
        {
            $sid= $this->input->post('subid');
            $type= $this->input->post('addproducttype');
            return $this->db->query("INSERT into product_type (subc_id,type_name) values('$sid','$type')");
        }
        // edit product type
        public function editproducttype($x)
        {
            $data['type_name'] = $this->input->post('editproducttype');
            $this->db->where('p_id',$x);
            return $this->db->update('product_type',$data);
        }
        //  manage model 
        public function managemod()
        {
            return $this->db->get('modal')->result();
        }
        // add modal
        public function addmodal()
        {
            $pid= $this->input->post('product_id');
            $m= $this->input->post('addmodel');
            return $this->db->query("INSERT into modal(pid,product) values('$pid','$m')");
        }
        // edit modal
        public function editmodal($x)
        {
            $data['product'] = $this->input->post('editmodal');
            $this->db->where('mid',$x);
            return $this->db->update('modal',$data);
        }
        // select by category
        public function selectcategory($cid)
        {
            // $this->db->where('category_id',$cid);
            // return $this->db->get('product_detail')->result();
            return $this->db->query("select * from product_detail where is_verify='1'and is_deleted='0'and category_id='$cid' order by pid DESC limit 0,9")->result();

        }
        // filter data by product type
        public function filter_data()
        {
            $type = array();
            $brand = array();
            $color = array();
            $size = array();
            $price = array();
            $c1= $this->input->post("data");
            $c2 = $this->input->post("x");
            $c3 = $this->input->post("y");
            $c4 = $this->input->post("z");
            $c5 = $this->input->post("p");
            if($c1)
            $type = "'".implode("','",$c1)."'";
            if($c2)
            $brand = "'".implode("','",$c2)."'";
            if($c3)
            $color = "'".implode("','",$c3)."'";
            if($c4)
            $size = "'".implode("','",$c4)."'";
            if($c5)
            $price = "'".implode("','",$c5)."'";
            
           
            if(!empty($type) && !empty($brand) && !empty($color) && !empty($size) && !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and color_id IN ($color) and size_id IN ($size) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($color) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and color_id IN ($color) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($color)   && !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and color_id IN ($color) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($size)  && !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and price_slot IN ($price) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($color) && !empty($size)  && !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and color_id IN ($color) and price_slot IN ($price) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($color) )
            {
                return 
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and color_id IN ($color) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($size) )
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand) && !empty($price) )
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($color) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and color_id IN ($color) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($brand) && !empty($color) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where brand_name IN ($brand) and color_id IN ($color) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($brand) && !empty($color) && !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where brand_name IN ($brand) and color_id IN ($color) and  price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($color) && !empty($price) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where size_id IN ($size) and color_id IN ($color) and  price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($brand))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and brand_name IN ($brand)  and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($price))
            {
               
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and price_slot IN ($price)  and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($brand) && !empty($color))
            {
                return   
                $this->db->query("select * from product_detail where  brand_name IN ($brand) and color_id IN ($color)  and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($color) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where color_id IN ($color) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) &&  !empty($color))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and color_id IN ($color) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type) && !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where product_type IN ($type) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            if(!empty($brand)&& !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where brand_name IN ($brand) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            if(!empty($color)&& !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where color_id IN ($color) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            if(!empty($size)&& !empty($price))
            {
                return   
                $this->db->query("select * from product_detail where size_id IN ($size) and price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result();
            }
            if(!empty($brand)&& !empty($size))
            {
                return   
                $this->db->query("select * from product_detail where brand_name IN ($brand) and size_id IN ($size) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($type))
            {  
                return
                $this->db->query("select * from product_detail where product_type IN ($type) and is_verify='1' and is_deleted='0'")->result();
            }
            elseif(!empty($brand))
            { 
                return 
                $this->db->query("select * from product_detail where brand_name IN ($brand) and is_verify='1' and is_deleted='0' ")->result();
            }
            elseif(!empty($size))
            { 
                return 
                $this->db->query("select * from product_detail where size_id IN ($size) and is_verify='1' and is_deleted='0' ")->result();
            }
            elseif(!empty($color))
            { 
                return 
                $this->db->query("select * from product_detail where color_id IN ($color) and is_verify='1' and is_deleted='0' ")->result();
            }
            if(!empty($price))
            {
                return
                $this->db->query("select * from product_detail where price_slot IN ($price) and is_verify='1' and is_deleted='0'")->result(); 
            }
            else
            {   
                return 
                $this->db->query("select * from product_detail where is_verify='1' and is_deleted='0'")->result();
            }
        }
        public function getproductlist($picd)
        {
            $this->db->select('*');
            $this->db->where($picd);
            $this->db->limit(4); 
            $qry=$this->db->get('product_detail');
            return $qry->result();

            // return $this->db->query("select * from product_detail where $picd and is_verify='1'and is_deleted='0' order by pid DESC limit 0,4")->result();
        }
        // move to add to cart
        public function addtocart($x)
        {
            $this->db->where('pid',$x);
            return $this->db->get('product_detail')->row_array();
        }
        // promocode 
        public function get_promocode()
        {
            return $this->db->get('promocode')->result();
        }
       
        // checkout detail 
        public function get_detail_user($uid)
        {
            $this->db->where('uid',$uid);
            return $this->db->get('user')->result();
        }
    
        // add detail of user
        public function billing_add()
        {
            $uid=$_SESSION['uid'];
            ////order table
            $pm=$data['payment_method']=$this->input->post('payment');
            if($pm=='case')
            {
                $proid=$data['product_id']=$this->input->post('productid');
                $quantity=$data['quantity']=$this->input->post('qty');
                $e=$data['user_id']=$uid;
                $data['total_price']=$this->input->post('totalsum');
                $data['address']=$this->input->post('address');
                $this->db->insert('orders',$data);
                $orderid=$this->db->insert_id();
                /////billing address
                $d['user_id']=$uid; 
                $d['name']=$this->input->post('name'); 
                $d['mobile']=$this->input->post('mobile'); 
                $d['email']=$this->input->post('email'); 
                $d['baddress']=$this->input->post('address');
                $d['city']=$this->input->post('city');
                $d['zip_code']=$this->input->post('zipcode');
                ////order detail
                $pid=explode(',',$proid);
                $qty=explode(',',$quantity);
                $ptp=$this->input->post('price');
                $pprice=explode(',',$ptp);
                for ($i=0; $i < count($pid); $i++) { 
    
                    $dd['orderid']=$orderid; 
                    $dd['product_id']=$pid[$i];
                    $dd['quantity']=$qty[$i];
                    $dd['price']=$pprice[$i];
                    $this->db->insert('orderdetail',$dd);
                    
                }
                
                $this->cart->destroy();
                $this->db->where('user_id',$uid);
                $res=$this->db->get('billing_address')->result();
                if(!empty($res))
                {
                
                return;
                }
                else
                {
                
                    $this->db->insert('billing_address',$d);
                }
                return; 
            }
            elseif($pm=='card')
            {   
                $uid=$_SESSION['uid']; 
                $proid=$data['product_id']=$this->input->post('productid');
                $quantity=$data['quantity']=$this->input->post('qty');
                $e=$data['user_id']=$uid;
                $totalPrice=$data['total_price']=$this->input->post('totalsum');
                $data['address']=$this->input->post('address');
                $this->db->insert('orders',$data);
                $orderid=$this->db->insert_id();
                
                $d['user_id']=$uid; 
                $name=$d['name']=$this->input->post('name'); 
                $mobile=$d['mobile']=$this->input->post('mobile'); 
                $email=$d['email']=$this->input->post('email'); 
                $d['baddress']=$this->input->post('address');
                $d['city']=$this->input->post('city');
                $d['zip_code']=$this->input->post('zipcode');
                // payment gateway code
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                array("X-Api-Key:test_9443137c545b35f482d6fc236cd",
                "X-Auth-Token:test_717d84464fac75ab5054dcecc85"));
                    $payload = Array(
                        'purpose' => 'test',
                        'amount' => $totalPrice,
                        'buyer_name' =>$name,
                        'email' =>$email,
                        'phone' => '9999999999',
                        'redirect_url' => base_url('Welcome/billing_add'),
                        'send_email' =>true,
                        'send_sms' => true,
                        'webhook' => 'http://www.example.com/webhook/',
                        'allow_repeated_payments' =>false,
                        );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                $response = curl_exec($ch);
                curl_close($ch);
                $response=json_decode($response);
                $paymentlink=$response->payment_request->longurl;      
                redirect($paymentlink); 
            }
        
        }
    }
?>