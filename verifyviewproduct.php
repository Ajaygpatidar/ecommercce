<?php
      include 'adminheader.php';
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
                            <th>Images</th>
                            <th>Vender Name</th>
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
                                $vn = $row->name;  
                                $cn = $row->category_name;
                                $price = $row->price;
                                $pid = $row->pid;
                                $img = base_url($row->img1);
                        ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><img src="<?php echo $img ?>" alt="" height="100px" width="100px"></td>
                            <td><?php echo $vn;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $cn;?></td>
                            <td>
                            <a href="<?php echo site_url('welcome/editproduct/'.$pid);?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                            <a href="<?php echo site_url('welcome/viewproductdetail/'.$pid)?>" class="btn btn-primary btn-xs" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="<?php echo site_url('welcome/blockproduct/'.$pid)?>" class="btn btn-danger btn-xs" >Block</a>
                            <a href="<?php echo site_url('welcome/deleteverifyproduct/'.$pid)?>" class="btn btn-danger btn-xs" >Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
