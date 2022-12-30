    <!-- recent viewed Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recently Viewed Products</span></h2>
        <div class="row px-xl-5">
            <?php
                foreach($k as $row)
                    {
                        $pn=$row->product_name;
                        $pid=$row->pid;
                        $pt=$row->product_type;
                        $price=$row->price;
                        $img = base_url($row->img1);
            ?> 
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pt )?>"><img class="img-fluid w-100" style="height:300px" src="<?php echo $img ?>" alt=""></a>
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?php echo $pn ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>₹ <?php echo $price;?></h5><h6 class="text-muted ml-2"></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
   
    <!--Recent viewed Products End -->