
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
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <form action="<?php echo site_url('welcome/Billing_address')?>"  method="post">
                    <div class="bg-light p-30 mb-5">
                        <?php foreach($k as $row)
                        {
                            $name=$row->name;
                            $mob=$row->mobile;
                            $eml=$row->email;
                            $address=$row->address;
                        ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $name?>">
                            </div>
                           
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" value="<?php echo $eml?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="mobile" value="<?php echo $mob?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>country</label>
                                <input class="form-control" type="text" name="country">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control"  id="state" type="text" name="state">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" min="6"  name="pincode">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" value="<?php echo $address?>">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php 
                            $sum=0;
                            $proid='';
                            $qty='';
                            $colorid='';
                            $sizeid='';
                            $ptt='';
                            foreach ($this->cart->contents() as $item) { 
                                $pname=$item['name'];
                                $rowid=$item['rowid'];
                                $pi=$item['img'];
                                $pprice=$item['price'];
                                $pqty=$item['qty'];
                              
                                $productid=$item['id'];
                                $pt=$pqty*$pprice;
                                $sum+=$pt;
                                $ptt.=$pt.',';
                                $proid.=$productid.',';
                                $qty.=$pqty.',';
                               
                        ?>
                         <input type="hidden" value="<?php echo $productid;?>" name="productid">
                        <input type="hidden" value="<?php echo $qty;?>" name="qty">
                        <input type="hidden" value="<?php echo $pt;?>" name="price">
                        <input type="hidden" value="<?php echo $sum;?>" name="totalsum">
                        <div class="text-dark justify-content-between">
                            <p>Product Name: <?php echo $pname;?></p>
                            <p>Price: <?php echo $pprice ?></p>
                            <p>Quantity: <?php echo $pqty ?></p>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>₹ <?php echo $sum;?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">CGST</h6>
                            <h6 class="font-weight-medium">₹ <?php  $gst=$sum *(3/100); echo $gst ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">₹ <?php  $ship=$sum *(0.3/100); echo $ship ?></h6>
                        </div>
                    </div>
                    
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>₹ <?php $total= $sum+$gst+$ship; echo $total;?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="cash" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Cash</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input"  value="card" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Debit Card</label>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
        
    </div>
    <!-- Checkout End -->
<?php
    include 'footer.php';
?>
