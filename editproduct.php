<?php
    $role=$_SESSION['role'];
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
        <center><h2>Edit Product</h2></center>
        <div class="col-md-12 well mx-auto">
            <?php 
                foreach($key as $row)
                {
                    $name = $row->product_name;
                    $price = $row->price;
                    $quantity = $row->quantity;
                    $des = $row->description;
                    $pid = $row->pid;
                    $catid = $row->category_id;
                    $subid = $row->sub_category;
                    $type = $row->product_type;
                    $mod = $row->modal;
                    $brand = $row->brand_name;
                    $size = $row->size_id;
                    $color = $row->color_id;
                }
            ?>
            <form action="<?php echo site_url('welcome/updateproduct/'.$pid)?>" method="post">
                <div class="form-group">
                    <label>Product name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
                <div class="form-group">
                    <label for="">Category:</label>
                    <select name="category_id" class="form-control" id="category"  onchange="onchangecategory()">
                        <option  value="<?php echo $catid;?>" >Add category</option>
                        <?php 
                        foreach($p as $row)
                        {
                            $cid=$row->cid;
                            $cn=$row->category_name;
                        ?>  
                        <option value="<?php echo $cid;?>"><?php echo $cn;?></option>
                        <?php	}
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sub Category:</label>
                        <select name="subid" id="subcat" onchange="onchangebsubcategory()" class="form-control subcategory">
                            <option  value="<?php echo $subid;?>">Select sub category</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="">Product type:</label>
                        <select name="product_id" id="producttype" onchange="onchangeproducttype()" class="form-control producttype">
                            <option  value="<?php echo $type;?>">Select product type</option>
                        </select>
                </div> 
                <div class="form-group">
                    <label for="">Model:</label>
                        <select name="model" id="model" onchange="onchangemodel()" class="form-control">
                            <option  value="<?php echo $mod;?>">Select model</option>
                        </select>
                </div> 
                <div class="form-group">
                    <label for="">product Brand:</label>
                        <select name="pbrand" id="productbrand" onchange="onchangebrand()" class="form-control">
                            <option  value="<?php echo $mod;?>">Select brand</option>
                        </select>
                </div> 
                <div class="form-group">
                    <label for="size">Product Size:</label>
                        <label for="" ></label>
                        <select name="size" class="form-control" >
                        <option value="<?php echo $size;?>">Size</option>
                        <?php 
                        foreach($s as $row)
                        {
                            $id=$row->size_id;
                            $n=$row->size_name;
                        ?>
                        <option value="<?php echo $id;?>"><?php echo $n;?></option>
                        <?php	}
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                <label for="">color:</label>
                    <label for=""></label>
                    <select name="color" class="form-control" >
                    <option value="<?php echo $color;?>">Color</option>
                    <?php
                    foreach($c as $row)
                        {
                            $cd=$row->color_id;
                            $c=$row->color_name;
                            ?>
                        <option value="<?php echo $cd;?>"><?php echo $c;?></option>
                        <?php	}
                        ?>
                
                    </select>
                </div>
                 
                <div class="form-group">
                    <label>Price:</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $price;?>">
                </div>
                <div class="form-group">
                    <label>Quantity:</label>
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity?>">
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <input type="text" class="form-control" name="des" value="<?php echo $des;?>">
                </div> 
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ajax to select brand according to category -->
<script>
function onchangecategory()
{ 
    $.ajax({
        type:"post",
        url: "<?php echo site_url('welcome/get_subcat');?>",
        cache: false,
        data: $('#category').serialize(),
        success: function(em)
        {
            try
            {
                $('#subcat').html(em);
            }
            catch(e)
            {
                alert(e);
            }
        }
    });
}
$("select.subcategory").change(function()
{
    $.ajax
    ({
        type:"post",
        url: "<?php echo site_url('welcome/get_producttype');?>",
        cache: false,
        data: $('#subcat').serialize(),
        success: function(em)
        {
            try
            {
                console.log(em);
                $('#producttype').html(em);
            }
            catch(e)
            {
                alert(e);
            }
        }
    });       
}); 
// product model
function onchangeproducttype()
    { console.log('hye');
        $.ajax({
            
            type:"post",
            url: "<?php echo site_url('welcome/get_product');?>",
            cache: false,
            data: $('#producttype').serialize(),
            success: function(em)
            {
                try
                {
                    $('#model').html(em);
                }
                catch(e)
                {
                    alert(e);
                }
            }
        });
    }
    // product brand
    function onchangemodel()
    { 
        $.ajax({
            type:"post",
            url: "<?php echo site_url('welcome/get_productbrand');?>",
            cache: false,
            data: $('#model').serialize(),
            success: function(em)
            {
                try
                {
                    console.log('hye');
                    $('#productbrand').html(em);
                }
                catch(e)
                {
                    alert(e);
                }
            }
        });
    }
   
</script>