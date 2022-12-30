<!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                    
                </nav>
               
            </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Product type -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Product Type</span></h5>
                <div class="bg-light p-4 mb-30 " style="height:170px;  overflow-y: scroll;">
                    <form>
                       
                       <?php
                        foreach($type as $row)
                        {
                            $prid = $row->p_id;
                            $p=$row->type_name;
                         ?>
                        <div class="custom-control  d-flex  mb-3">
                            <input type="checkbox"   value="<?php echo $prid;?>" name="type[]" onchange="search()"><h6 class="ml-3"><?php echo $p; ?></h6>
                        </div>
                        <?php } ?>
                      
                    </form>
                </div>
                <!-- end product type -->
                <!-- Product brand -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Product Brand</span></h5>
                <div class="bg-light p-4 mb-30 " style="height:170px;  overflow-y: scroll;">
                    <form>     
                       <?php
                        foreach($brand as $row)
                        {
                            $bid = $row->bid;
                            $b=$row->pname;
                         ?>
                        <div class="custom-control  d-flex  mb-3">
                            <input type="checkbox"  value="<?php echo $bid?>" name="brand[]" onchange="search()"> <h6 class="ml-3"><?php echo $b; ?></h6>
                            
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php } ?>
                    </form>
                </div>
                <!-- end product brand-->
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30" style="height:170px;  overflow-y: scroll;">
                    <form>
                        
                        <?php
                        foreach($price as $row)
                        {
                            $slotid=$row->slot_id;
                            $price=$row->price_slot;
                            
                        ?>
                        <div class="custom-control d-flex  mb-3">
                            <input type="checkbox" name="price[]" value="<?php echo $slotid;?>" onchange="search()" class="checkbox" > <h6 class="ml-3"><?php echo $price; ?></h6>
                        </div>
                        <?php } ?> 
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30 " style="height:170px;  overflow-y: scroll;">
                    <form>
                      
                       <?php
                        foreach($color as $row)
                        {
                            $color=$row->color_name;
                            $cid=$row->color_id;
                         ?>
                        <div class="custom-control d-flex  mb-3">
                            <input type="checkbox" name="color[]" value="<?php echo $cid;?>" onchange="search()"><h6 class="ml-3"><?php echo $color; ?></h6>
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php } ?>
                      
                    </form>
                </div>
                <!-- Color End -->
                
                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Size</span></h5>
                <div class="bg-light p-4 mb-30 " style="height:170px;  overflow-y: scroll;">
                    <form>
                       
                       <?php
                        foreach($size as $row)
                        {
                            $size=$row->size_name;
                            $sid = $row->size_id;
                         ?>
                        <div class="custom-control  d-flex  mb-3 check">
                            <input type="checkbox" value="<?php echo $sid;?>" name="size[]" onchange="search()"  ><h6 class="ml-3"><?php echo $size; ?></h6>
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php } ?>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            
        <div class="col-lg-9"  id="r">    
            <!-- after select category -->
            <?php if(isset($c))
            {
                ?>        
            <div class="row pb-3" id="load">
                <?php 
                    foreach($c as $row)
                    {
                        $pn=$row->product_name;
                        $csid=$row->category_id;
                        $pid=$row->pid;
                        $pt=$row->product_type;
                        $price=$row->price;
                        $img = base_url($row->img1);
                        ?>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4 " >
                        <div class="product-img position-relative overflow-hidden">
                        <a href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pt )?>"><img class="img-fluid" src="<?php echo $img ?>" alt=""  style="height:300px" ></a>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pt )?>"><?php echo $pn; ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹ <?php echo  $price;?></h5>
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
          
            <?php }
            else { ?>
            <div class="row pb-3" id="load">
                <?php 
                    foreach($key as $row)
                    {
                        $pn=$row->product_name;
                        $pid=$row->pid;
                        $pt=$row->product_type;
                        $price=$row->price;
                        $img = base_url($row->img1);
                        ?>
                <div class="col-lg-4 col-md-5  col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4 " >
                        <div class="product-img position-relative overflow-hidden">
                            <a href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pt )?>"><img class="img-fluid" src="<?php echo $img ?>" alt="" style="height:300px"></a>
                          
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="<?php echo site_url('welcome/detail/'.$pid.'/'.$pt )?>"><?php echo $pn; ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹ <?php echo  $price;?></h5>
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
            <div class="col-12" id="h">
                <nav>
                    <!-- load more -->
                    <form id="valueload" name="valueload">
                        <input type="hidden" id="position" name="position" value="0">
                    </form>
                    
                    <div id="diverror" class="" align="center">
                        <input type="image" src="<?php echo base_url('images/load.gif');?>" height="50" width="50">
                    </div>
                    
                    <div id="divload"  align="center">
                        <input type="button" id="btnloadmore" value="Viewmore" onclick="loadmore()" class="btn btn-sm btn-primary"> 
                    </div>
                </nav>
            </div>
            <?php } ?>
        </div>
    </div>  
        <!-- Shop Product End -->
    <!-- recent viewed Products Start -->

    <!-- Shop End -->
<!-- load more javascript when page load-->
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#diverror").hide();
        $("#divload").show();
        $(document).ajaxStart(function()
        {
            $("#diverror").show();
            $("#divload").hide();
        });
        $(document).ajaxStop(function()
        {
            $("#diverror").hide();
            $("#divload").show();
        });
    });
    function loadmore()
    {
        var v = document.getElementById('position');
        var position = parseInt(v.value);
        position++;
        v.value = position;
        $.ajax({
            type:"post",
            url: "<?php echo site_url('welcome/loadmore');?>",
            cache: false,
            data: $('#valueload').serialize(),
            success: function(data)
            {
                if(data=="error")
                {
                    $("#load").append("");
                    $('#btnloadmore').attr('disabled',true);
                }
                else
                {
                    $('#load').append(data);
                }
            }
        });
    }
   
  
// filteration data to searching product
function search()
{
    
    var typelist=[];
    var brandlist=[];
    var colorlist=[];
    var pricelist=[];
    var sizelist=[];
    $.each($("input[name='type[]']:checked"), 
    function(){
        typelist.push($(this).val());
    });

    $.each($("input[name='brand[]']:checked"), 
    
    function(){
        brandlist.push($(this).val());
    });
    $.each($("input[name='color[]']:checked"), function(){
        colorlist.push($(this).val());
    });
    $.each($("input[name='price[]']:checked"), function(){
        pricelist.push($(this).val());
    });
    $.each($("input[name='size[]']:checked"), function(){
        sizelist.push($(this).val());
    });

    $.ajax({
       
        url:"<?php echo site_url('Welcome/filter');?>",
        method:"post",
        data:{'data':typelist,'x':brandlist,'y':colorlist,'z':sizelist,'p':pricelist},
        cache:false,
        success:function(a)
        {
            $('.pb-3').empty();
            $('.pb-3').append(a);
            $("#h").hide();
        }
    });
}
</script>