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
            <!-- login form -->
            <div class="text-lg-left" id="log" tabindex="-1">
                <div class="modal-dialog shadow">
                    <div class="modal-content">
                        <form action="<?php echo site_url('welcome/login')?>" method="post">
                            <div class=" bg-primary">
                                <h3 class="  text-dark text-center mb-2" >LOGIN</h3>
                                <?php if( $this->session->flashdata('error')!='') 
                                    {
                                        ?>
                                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error');$this->session->unset_userdata('error');?> </div>
                            <?php   } ?>
                            </div>
                            <div class="modal-body">
                                <div class="signup-form">
                                    <div class="mb-1">
                                        <label  class="form-label">E-mail:</label>
                                        <input type="text"  class="form-control" placeholder="Enter email" name="email" >
                                    </div>
                                    <div class="mb-1">
                                        <label  class="form-label">Password:</label>
                                        <input type="password"  class="form-control" placeholder="Enter password" name="password">
                                    </div>	
                                    
                                    <div class="text-center small">Create account <a href="<?php echo site_url('welcome/signin')?>">click here</a></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">submit</button>
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