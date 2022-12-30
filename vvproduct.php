<?php
      include 'venderheader.php';
?>
<script>
$(document).ready(function() 
{
    $('#mytable').DataTable();
} );
</script>
<div id="page-wrapper">
    <div class="container-fluid well" >
        <center><h2>View Verified Product</h2></center>
        <div class="col-md-12 well" >
            <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th>Select All</th>
                            <th>Image</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Category </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($key as $row)
                            {
                                $name = $row->product_name; 
                                $cid = $row->category_id;
                                $cn = $row->category_name;
                                $pid = $row->pid;
                                $typeid = $row->product_type;
                                $type = $row->type_name;
                                $price = $row->price;
                                $des = $row->description;
                                $sizeid = $row->size_id;
                                $size = $row->size_name;
                                $colorid = $row->color_id;
                                $color = $row->color_name;
                                $quantity = $row->quantity;
                                $img = base_url($row->img1);
                           ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><img src="<?php echo $img ?>" alt="" height="100px" width="100px"></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $cn;?></td>
                            <td>
                            <a href="<?php echo site_url('welcome/editproduct/'.$pid);?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                            <a href="<?php echo site_url('welcome/viewproductdetail/'.$pid)?>" class="btn btn-primary btn-xs" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="<?php echo site_url('welcome/deletevvproduct/'.$pid)?>" class="btn btn-danger btn-xs" >Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
