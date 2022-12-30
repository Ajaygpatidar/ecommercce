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
        <form action="<?php echo site_url('welcome/addsubcategory')?>" method="post">
            <div class="col-sm-2">
                <button type="submit"  class="btn btn-success text-right"  data-toggle="modal" data-target="#myModal">Add Sub-category</button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title text-warning" id="myModalLabel"> Sub category</h4>
                            </div>
                            <div class="modal-body">
                               
                                <div class="form-group">
                                    <label>Category:</label>
                                   
                                    <select name="category" id="" class="form-control">
                                        <option selected disabled>Add category</option>
                                        <?php 
                                        foreach($key as $row)
                                        {
                                            $cid=$row->cid;
                                            $cn=$row->category_name;
                                        ?>  
                                        <option value="<?php echo $cid;?>" class=""><?php echo $cn;?></option>
                                        <?php	}
                                        ?>
                                    </select>
                                   
                                </div>
                               
                                <div class="form-group">
                                    <label>Add Sub-category:</label>
                                    <input type="text" class="form-control" name="addsubcategory" required="required">
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
                        <th>Category id</th>
                        <th>Category</th>
                        <th>Action</th>
                       
                    </thead>
                    <tbody>
                            <?php
                            foreach($sub as $row)
                            {
                                $sid= $row->subc_id;
                                $name = $row->category_name;
                            ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><?php echo $sid ?></td>
                            <td><?php echo $name ?></td>
                            <td>
                                <a href="#<?php echo $sid ?>" type="submit"  class="btn btn-success  btn-xs"  data-toggle="modal">Edit</a>
                                <div class="modal fade" id="<?php echo $sid ?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title text-warning" id="myModalLabel">Edit Sub-category</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo site_url('welcome/editsubcategory/'.$sid)?>" method="post">
                                                
                                                    <div class="form-group">
                                                        <label>Add Sub-category:</label>
                                                        <input type="text" class="form-control" name="editsubcategory" value="<?php echo $name;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="editlocation">submit</button>
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