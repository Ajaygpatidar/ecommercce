<?php
    $role = $_SESSION['role'];
    if($role=='admin')
    {
        include 'adminheader.php';
    }
    else
    {
        include 'venderheader.php';
    }
?>
<div id="page-wrapper">
    <div class="container-fluid well" >
        <center><h2>View Product detail</h2></center>
        <div class="col-md-12 well">
            <div class="row m-0">
            <?php
                foreach($key as $row)
                {
                    $name = $row->product_name; 
                    $vn  = $row->name;
                    $cat = $row->category_name;
                    $subc = $row->category_name;
                    $brand = $row->pname;
                    $type = $row->product_type;
                    $img = base_url($row->img1);
                    $price = $row->price;
                    $des = $row->description;
                    $size = $row->size_name;
                    $color = $row->color_name;
                    $quan = $row->quantity;
                }?>
                <div class="col-lg-4 ">
                    <img src="<?php echo $img;?>" class="border p-3" height="350px" width="320px">
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4><strong>Vender Name:</strong> <?php echo $vn;?></h4>
                                <h4><strong>Product Name:</strong> <?php echo $name;?></h4>
                                <h4><strong>Category:</strong> <?php echo $cat;?></h4>
                                <h4><strong>Product Type:</strong> <?php echo $type;?></h4>
                                <h4><strong>Brand:</strong> <?php echo $brand ?></h4>
                                <h4><strong>Price:</strong> ₹<?php echo $price ?></h4>
                                <h4><strong>Size:</strong> <?php echo $size ?></h4>
                                <h4><strong>Color:</strong> <?php echo $color ?></h4>
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h4><strong>Product Detail</strong></h4>
                                <span><?php echo $des ?></span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12">
                                <!-- sub catgeory -->
                                <p class="tag-section"><strong>Tag : </strong> Men</p>
                            </div>
                            <div class="col-lg-12">
                                <h5><strong>Quantity:</strong> <?php echo $quan;?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>