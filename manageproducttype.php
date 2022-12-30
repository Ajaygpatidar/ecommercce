<?php
    $role= $_SESSION['role'];
    if($role=='admin')
    {
        include 'adminheader.php';
    }
    else
    {
        include 'venderheader.php';
    }
?>
<script>
    $(document).ready(function() {
    $('#mytable').DataTable();
} );
</script>

<div id="page-wrapper">
    <div class="container-fluid well" >
        <form action="<?php echo site_url('welcome/addproducttype')?>" method="post">
            <div class="col-sm-2">
                <button type="submit"  class="btn btn-success text-right"  data-toggle="modal" data-target="#myModal">Add Sub-category</button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title text-warning" id="myModalLabel"> Product Type</h4>
                            </div>
                            <div class="modal-body">
                               
                                <div class="form-group">
                                    <label>Category:</label>
                                   
                                    <select name="category" class="form-control" id="category"  onchange="onchangecategory()">
                                        <option selected disabled>category</option>
                                        <?php 
                                        foreach($key as $row)
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
                                    <label>Sub-category</label>
                                    <select name="subid" id="subcat" onchange="onchangebsubcategory()" class="form-control subcategory">
                                        <option selected disabled>Select sub category</option>
                                    </select>                         
                                </div>
                                <div class="form-group">
                                    <label>Add Product Type:</label>
                                    <input type="text" class="form-control" name="addproducttype" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="addlocation">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>               
        </form>
        <div class="col-md-12 well" style="margin-top:20px">
          
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">  
                    <thead>
                        <th>Select all</th>
                        <th>product id</th>
                        <th>Product Name</th>
                        <th>Action</th>
                       
                    </thead>
                    <tbody>
                            <?php
                            foreach($p as $row)
                            {
                                $pid= $row->p_id;
                                $name = $row->type_name;
                            ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><?php echo $pid ?></td>
                            <td><?php echo $name ?></td>
                            <td>
                                <a href="#<?php echo $pid ?>" type="submit"  class="btn btn-success  btn-xs"  data-toggle="modal">Edit</a>
                                <div class="modal fade" id="<?php echo $pid ?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title text-warning" id="myModalLabel">Edit Sub-category</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo site_url('welcome/editproducttype/'.$pid)?>" method="post">
                                                
                                                    <div class="form-group">
                                                        <label>Add Sub-category:</label>
                                                        <input type="text" class="form-control" name="editproducttype" value="<?php echo $name;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" >submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      <!-- /.modal-dialog --> 
    </div>
</div>
<script>
    function onchangecategory()
    { 
        $.ajax({
            type:"post",
            url: "<?php echo site_url('welcome/getsubcategory');?>",
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
</script>