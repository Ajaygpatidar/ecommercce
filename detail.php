
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <?php 
            foreach($key as $row)
            {
                $pid = $row->pid; 
                $name = $row->product_name; 
                $brand = $row->pname;
                $cat = $row->category_name;
                $type = $row->type_name;
                $img1 = base_url($row->img1);
                $img2 = base_url($row->img2);
                $img3 = base_url($row->img3);
                $price = $row->price;
                $des = $row->description;
                $sid = $row->size_id;
                $size=explode(',',$sid);
                $cid = $row->color_id;
                $color=explode(',',$cid);
            ?>
        <div class="row px-xl-5">
          
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?php echo $img1;?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="<?php echo $img2;?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="<?php echo $img3;?>" alt="Image">
                        </div>
                       
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $name; ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-3">₹ <?php echo $price;?></h3>
                    <div class="d-flex ">
                        <strong class="text-dark">Category: </strong>
                        <label class="ml-2"> <?php echo $cat;?></label>
                    </div>
                    <div class="d-flex ">
                        <strong class="text-dark">Brand: </strong>
                        <label class="ml-2"> <?php echo $brand;?></label>
                    </div>
                    <div class="d-flex ">
                        <strong class="text-dark">Type:</strong>
                        <label class="ml-2"><?php echo $type;?></label>
                    </div>
                 <form action="<?php echo site_url('welcome/addtocart/'.$pid)?>" method="post">   
                    <strong class="text-dark">Sizes:</strong>
                    <?php
                    $a = '0';
                     foreach ($s as $row)
                     {
                        $si_table = $row->size_name;
                       $si_id_table= $row->size_id;
                       foreach ($size as $row1) if ($row1 == $si_id_table) 
                       {
                       
                    ?>
                    <div class="d-flex ml-5 ">          
                        <input type="radio" class="custom-control-input" id="size-<?php echo $a ?>" name="size" value="<?php echo $si_id_table; ?>" required>
                        <label class="custom-control-label" for="size-<?php echo $a++ ?>"><?php echo $si_table; ?></label>
                     </div>
                    <?php } 
                    } ?>
                    <!-- color select -->
                    <strong class="text-dark">Color:</strong>
                    <?php
                    $b = '0';
                     foreach ($c as $row1)
                     {
                        $c_id = $row1->color_id;
                       $c_name= $row1->color_name;
                       foreach ($color as $row1) if ($row1 == $c_id) 
                       {
                    ?>
                    <div class="d-flex ml-5 "> 
                        <input type="radio" class="custom-control-input" id="color-<?php echo $b ?>" name="color" value="<?php echo $c_id; ?>" required>
                        <label class="custom-control-label" for="color-<?php echo $b++ ?>"><?php echo $c_name; ?></label>
                     </div>
                    <?php } 
                    } ?>
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        
                        <input type="submit" class="btn btn-primary px-3" value=" Add To Cart">
                    </div>
                </form>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <?php } ?>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Product related to this item</span></h2>
        <div class="row px-xl-5">
            <div class="col">
           
                <div class="owl-carousel related-carousel">
                <?php
                foreach($Rp as $row)
                {
                    $pname = $row->product_name; 
                    $img = base_url($row->img1);
                    $price = $row->price;
                    $pr = $row->product_type;
                    $pid = $row->pid;
                    ?>
                    <div class="product-item bg-light">
                       
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?php echo $img;?>" alt="img">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pr )?>"><?php echo $pname; ?></a>
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
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-panel-2">Specification</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p><?php echo $des;?></p>
                        </div>  
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade " id="tab-panel-2">
                            <h4 class="mb-3">General</h4>
                            <p>Brand: <?php echo $brand;?></p>
                            <p>Type: <?php echo $type;?></p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    
<?php
    include 'footer.php';
?>