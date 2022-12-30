<?php
    include 'header.php';
?>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products-Img</th>
                            <th>Product-Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php 
                      $sum=0;
                      $pid=0;
                      $ship=0;
                     foreach ($this->cart->contents() as $item) { 
                       $pid=$item['id'];
                        $pn=$item['name'];
                        $rowid=$item['rowid'];
                        $pi=$item['img'];
                        $pp=$item['price'];
                        $pq=$item['qty'];
                        $pt=$pq * $pp;
                        $sum+=$pt;
                        ?>
                        
                        <tr>
                            <input type="hidden" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $rowid;?>" id="rowid">
                            <td class="align-middle"><img src="<?php echo base_url($pi)?>" alt="" style="width: 50px;" height="50px"></td>
                            <td class="align-middle"><?php echo substr($pn,0,40);?></td>
                            <td class="align-middle"><span>&#8377;</span>  <?php echo $pp;?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                  
                                    <input type="number" id="p" class="form-control form-control-sm bg-secondary border-0 text-center " value="<?php echo $pq;?>"  >
                                   
                                </div>
                            </td>
                            <td class="align-middle"><span>&#8377;</span>  <?php echo $pt;?></td>
                            <td class="align-middle"><a class="btn btn-sm btn-danger" href="<?php echo site_url('welcome/cartremove/'.$rowid)?>"><i class="fa fa-times"></i></a></td> 
                        </tr>
                        <?php }?> 
                    </tbody>
                    
                </table>
            </div>
            <div class="col-lg-4">
                <?php
                     if($this->session->flashdata('error')!='') 
                     {
                         ?>
                         <div class="alert alert-danger"><?php echo $this->session->flashdata('error');$this->session->unset_userdata('error');?> </div>
                 <?php }
               ?>
                <form class="mb-30" action="<?php echo site_url('welcome/discount/'.$pid)?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" name="discount" value="" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="mr-3">₹<?php echo $sum;?></h6>
                        </div>
                        
                        <?php 
                        //foreach($res1 as $row1)
                        //{
                            // $pid=$row1['pid1=array('pid'=>'0');'];
                        // }
                        //  if($pid>=1)
                        // {?>
                            <!-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Disscount</h6>
                            <h6 class="font-weight-medium mr-3">₹<?php  $dis= $sum - 100; echo $dis?></h6>
                            </div> -->
                        <!-- } -->
                       
                        <?php if($sum==0)
                        { ?>
                            <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium mr-3">₹0</h6>
                            </div>
                            
                       <?php }else{
                        ?>
                            <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium mr-3">₹<?php  $ship=$sum * (0.3/100); echo $ship?></h6>
                            </div>
                        <?php }
                      ?>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">GST</h6>
                            <h6 class="font-weight-medium"> 3% <span>(<?php  $Gst=$sum * (3/100); echo $Gst ?>)</span></h6>
                        </div>
                      
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php  $total=$sum + $ship + $Gst;echo $total?></h5>
                        </div>
                        <a href="<?php echo site_url('welcome/checkout')?>" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
<?php
    include 'footer.php';
?>
<script>
 
    $(document).ready(function(){
          $("#p").on('change',function(){
              var el=$(this).closest('tr');
              var id=$(el).find('#rowid').val();
              var qty= $('#p').val();
              
              $.ajax({
                
                url:'<?php echo site_url('welcome/updatecart')?>',
                method:"post",
                data:{'id':id,'qty':qty},
                datatype:"text",
                success:function(data)
                {
                    location.href = "cart";
                    // location.reload();
                }

              })
          });
          });

</script>