<div id="page-wrapper">
    <div class="container-fluid well" >
        <center><h2>My Profile</h2></center>
        <div class="row  col-sm-12 " >
            <?php
                foreach($result as $row)
                {
                    $n=$row->name;
                    $m=$row->mobile;
                    $e=$row->email;
                    $img=base_url($row->img);
                    $add=$row->address;
                    ?>
                
            <div class="col-md-4">
                <div class="profile-img">
                <img src="<?php echo $img?>" alt="" id="image" class="img-rounded"  height="190px" width="210px">
                    <form action="<?php echo site_url('welcome/upload')?>" method="post" enctype="multipart/form-data">
                        <input type="file" class="form-control"  onchange="readURL(this);" style="margin-top:15px" name="img">
                        <button type="submit" class="btn btn-success">submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 ">
                        
                <div class="row">
                    <div class="col-md-4">
                        <label>Name:</label>
                    </div>
                    <div class="col-md-4">
                        <p><?php echo $n; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Email:</label>
                    </div>
                    <div class="col-md-4">
                        <p><?php echo $e ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Phone:</label>
                    </div>
                    <div class="col-md-4">
                        <p><?php echo $m;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Address:</label>
                    </div>
                    <div class="col-md-4">
                        <p><?php echo $add;?></p>
                    </div>
                </div>
            <?php } ?>  
                <div class="row"  style="margin-top:35px">
                    <div class="col-md-3 ">
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal">Edit Profile</button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?php echo site_url('welcome/update')?>" method="post">
                                    <div class="modal-content">
                                        <?php foreach($result as $row)
                                        {
                                            $name=$row->name;
                                            $mobile=$row->mobile;
                                            $email=$row->email;
                                            $add=$row->address;
                                            ?>
                                        
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label >Name:</label>
                                                <input type="text" class="form-control" name="n" value="<?php echo $name;?>">
                                            </div>
                                            <div class="form-group">
                                                <label >Mobile:</label>
                                                <input type="text" class="form-control" name="m"  value="<?php echo $mobile;?>">
                                            </div>
                                            <div class="form-group">
                                                <label >E-mail:</label>
                                                <input type="text" class="form-control" name="e"  value="<?php echo $email;?>">
                                            </div>
                                            <div class="form-group">
                                                <label >Address:</label>
                                                <input type="text" class="form-control" name="add"  value="<?php echo $add;?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="pupdate">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>  
                <div class="col-md-2" style="margin-top:-34px; margin-left:95px">
                    <button  type="button" class="btn btn-danger " data-toggle="modal" data-target="#password">
                    Change password
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="password" >
                        <div class="modal-dialog">
                            <form action="<?php echo site_url('welcome/password')?>" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="ModalLabel1">Edit Password</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Enter Old Password:</label>
                                            <input type="password" class="form-control" name="opassword" id="exampleInputEmail1" placeholder="old Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">New Password:</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" name="npassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Conform Password:</label>
                                            <input type="password" class="form-control" id="exampleInputEmail1" name="cpassword" placeholder="Conform Password">
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                            
                </div>
                    
            </div>
        </div>
                      
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<!-- script for image instance load when choose-->
<script>
    function readURL(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function(e)
            {
                $('#image').attr('src', e.target.result) 
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>