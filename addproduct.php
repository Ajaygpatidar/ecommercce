<?php
    include 'venderheader.php';
?>
<div class="col-sm-12 col-md-12 well" id="content">
    <div class="container-fluid well" >   
        <h5> <?php echo $this->session->flashdata('item');?></h5>
        <form action="<?php echo site_url('Welcome/product_upload')?>" method="post" enctype="multipart/form-data" >
            <center><h2>Add New Product</h2></center>
            <div class="row  col-sm-12 ">
                <div class="col-md-3">
                    <div class="profile-img">
                        <img src="" alt="Upload Image "class="img-rounded" id="image" height="100px" width="130px" >
                        <input type="file" class="btn-primary" style="margin-top:15px" onchange="readURL(this);" name="img1">
                        <img src="" alt="Upload Image "class="img-rounded" id="image1" height="100px" width="130px" style="margin-top:15px" >
                        <input type="file" class="btn-primary" style="margin-top:15px" onchange="readURL1(this);" name="img2">
                        <img src="" alt="Upload Image " class="img-rounded" id="image3" height="100px" width="130px" style="margin-top:15px" >
                        <input type="file" class="btn-primary" style="margin-top:15px" onchange="readURL3(this);" name="img3">
                    </div>
                </div>
                <div class="col-md-7 col-sm-offset-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Product Name:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="pname" placeholder="Enter Product name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> Category:</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <select name="category_id" class="form-control" id="category"  onchange="onchangecategory()">
                                    <option selected disabled>Add category</option>
                                    <?php 
                                    foreach($cat as $row)
                                    {
                                        $cid=$row->cid;
                                        $cn=$row->category_name;
                                    ?>  
                                    <option value="<?php echo $cid;?>"><?php echo $cn;?></option>
                                    <?php	}
                                    ?>
                            
                                </select>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> Sub category:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="subid" id="subcat" onchange="onchangebsubcategory()" class="form-control subcategory">
                                    <option selected disabled>Select sub category</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <label>Product type:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="product_id" id="producttype" onchange="onchangeproducttype()" class="form-control producttype">
                                    <option selected disabled>Select product type</option>
                                </select>
                            </div>    
                        </div>
                    </div>
                       
                    <div class="row" >
                        <div class="col-md-4">
                            <label>Model:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="model" id="model" onchange="onchangemodel()" class="form-control">
                                    <option selected disabled>Select model</option>
                                </select>
                            </div>    
                        </div>
                    </div>
                
                    <div class="row" >
                        <div class="col-md-4">
                            <label>Product brand:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="pbrand" id="productbrand" onchange="onchangebrand()" class="form-control">
                                    <option selected disabled>Select brand</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- add new brand -->
                        <div class="row" id="addproductbrand">
                            <div class="col-md-4">
                                <label>New Product brand:</label>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" name="addproductbrand" value="" placeholder="Add new type">
                                </div> 
                            </div>    
                        </div>
                    <!-- size -->
                    <div class="row">
                        <div class="col-md-4">
                            <label>Size:</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <?php 
                                foreach($size as $row)
                                {
                                    $id=$row->size_id;
                                    $n=$row->size_name;
                                    ?>
                                <label for="" name="size">
                                    <div class="checkbox">
                                        <label> 
                                            <input type="checkbox"  value="<?php echo $id;?>" name="size[]"> <?php echo $n;?>
                                        </label>
                                    </div>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label> Product Color:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php 
                                foreach($col as $row)
                                {
                                    $cd=$row->color_id;
                                    $c=$row->color_name;
                                    ?>
                                <label for="" name="size">
                                    <div class="checkbox">
                                        <label> 
                                            <input type="checkbox"  value="<?php echo $cd;?>" name="color[]"> <?php echo $c;?>
                                        </label>
                                    </div>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label> product Price:</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="price" placeholder="Enter product price price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">    
                                <select name="priceslot" class="form-control"  >
                                    <option selected disabled>choose price slot</option>
                                    <?php 
                                    foreach($slot as $row)
                                    {
                                        $slotid=$row->slot_id;
                                        $sn=$row->price_slot;
                                    ?>  
                                    <option value="<?php echo $slotid;?>"><?php echo $sn;?></option>
                                    <?php	}
                                    ?>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Quantity:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="quantity" placeholder=" Enter Product value">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Description:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <textarea name="description" id="" cols="35" rows="3" placeholder=" describe about product"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success ">Upload</button>
                </div>
            </div>
        </form>
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
    $.ajax({
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
    { 
       
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
                    
                    $('#productbrand').html(em);
                }
                catch(e)
                {
                    alert(e);
                }
            }
        });
    }
    // model 
    $(document).ready(function()
    {
        $("#addproductbrand").hide();
    });
    function onchangebrand()
    {
        var selectoption=document.getElementById('productbrand').value;
        if(selectoption=="addnewbrand")
        {
            $('#categrory').show();
            $('#subcat').show();
            $('#producttype').show();
            $('#model').show();
            $('#productbrand').show();
            $('#addproductbrand').show();
        }
        else
        {
            $('#categrory').show();
            $('#subcat').show();
            $('#producttype').show();

            $('#model').show()
            $('#productbrand').show();
            $('#addproductbrand').hide();
        }
    }
    </script>
    <!-- script for image instance load when choose-->
<script>
    function readURL(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function(e)
            {
                $('#image')
                .attr('src', e.target.result)    
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL1(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function(e)
            {
                $('#image1')
                .attr('src', e.target.result)    
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL3(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function(p)
            {
                $('#image3')
                .attr('src', p.target.result)    
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>