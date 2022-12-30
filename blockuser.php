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
        <center><h2>View Non- verified  User</h2></center>
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
                                $uid= $row->uid;
                                $name = $row->name; 
                                $mobile = $row->mobile;
                                $email= $row->email;
                                $add = $row->address;
                                $img = base_url($row->img);
                           ?>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td><img src="<?php echo $img ?>" alt="" height="100px" width="100px"></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $mobile;?></td>
                            <td><?php echo $add;?></td>
                            <td><?php echo $email;?></td>
                            <td>
                            <a href="<?php echo site_url('welcome/edituser');?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                            <a href="<?php echo site_url('welcome/verifyblockuser/'.$uid)?>" type="submit "  class="btn btn-success btn-xs" data-toggle="modal">Verify</a>
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
