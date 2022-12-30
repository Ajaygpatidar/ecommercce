<?php
    include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>E-commerce</title>
</head>
<body>
<div class="container-fluid">    
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 text-center mx-auto">
            <div class="text-lg-left">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo site_url('welcome/registraction')?>" method="post">
                            <div class="modal-header bg-primary text-align-center">
                                <h3 class=" text-align-center" >Sign-up</h3>
                            </div>
                            <div class="modal-body">
                            <?php if( $this->session->flashdata('error')!='') 
                                    {
                                        ?>
                                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error');$this->session->unset_userdata('error');?> </div>
                            <?php   } ?>
                                <div class="signup-form">                                             
                                    <div class="mb-1">
                                        <label  class="form-label">Name:</label>
                                        <h5><?php echo form_error('name')?></h5>
                                        <input type="text"  class="form-control" placeholder="Enter name" name="name">
                                    </div>
                                    <div class="mb-1">
                                        <label  class="form-label">Mobile:</label>
                                        <h5><?php echo form_error('mobile')?></h5>
                                        <input type="text"  class="form-control" placeholder="Enter Mobile" name="mobile">
                                    </div>
                                    <div class="mb-1">
                                        <label  class="form-label">E-mail:</label>
                                        <h5><?php echo form_error('email')?></h5>
                                        <input type="text"  class="form-control" onchange="onchangeemail()"value="" placeholder="Enter email" name="email" id="E">
                                    </div>
                                    <!-- otp button -->
                                    <button type="button"  class="btn btn-primary btn-block"  onclick="send_otp()" >Send OTP</button>
                                    <!-- otp -->
                                    <div class="mb-1" id="O">
                                      
                                        <label  class="form-label">OTP:</label>
                                        <h5><?php echo form_error('otp')?></h5>
                                        <input type="text"  class="form-control" placeholder="Enter otp" name="otp" >
                                    </div>
                                    <div class="mb-1">
                                        <label  class="form-label">Password:</label>
                                        <h5><?php echo form_error('password')?></h5>
                                        <input type="password"  class="form-control" placeholder="Enter password" name="password">
                                    </div>	
                                    
                                    <div class="text-center small" class="tooltip-test" title="login Here">Already have an account? <a href="<?php echo site_url('welcome/log')?>">Login here</a></div>
                                </div>
                            </div>
                            <div >
                                <center><a type="submit" class="btn btn-primary mb-3" >submit</a></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include 'footer.php';
?>
</body>
</html>
