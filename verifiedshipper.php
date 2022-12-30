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
        <center><h2>View Verified Shipper</h2></center>
        <div class="col-md-12 well" >
            <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th>Select All</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>address</th>
                            <th>E-mail </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($key as $row)
                            {
                                $name = $row->name; 
                                $mobile = $row->mobile;
                                $email= $row->email;
                                $add = $row->address;
                                $img = base_url($row->img);
                                $uid = $row->uid;
                           ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><img src="<?php echo $img ?>" alt="" height="100px" width="100px"></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $mobile;?></td>
                            <td><?php echo $add;?></td>
                            <td><?php echo $email;?></td>
                            <td>
                            <a href="<?php echo $uid?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                                <div class="modal fade" id="<?php echo $uid;?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title text-warning" id="myModalLabel">Edit Shiper</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo site_url('welcome/vender_update/'.$uid);?>" method="post">

                                                    <div class="form-group">
                                                        <label>Name:</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mobile:</label>
                                                        <input type="text" class="form-control" name="mobile" value="<?php echo $mobile;?> " required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="email" class="form-control" name="email" value=" <?php echo $email;?>" required="required">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Address:</label>
                                                        <input type="text" class="form-control" name="address" value=" <?php echo $add;?>" required="required">
                                                    </div>                      
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="submit">submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <a href="<?php echo site_url('welcome/blockverifiedshipper/'.$uid)?>" type="submit "  class="btn btn-success btn-xs" >Block</a>
                            <a href="<?php echo site_url('welcome/')?>" class="btn btn-danger btn-xs" >Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
