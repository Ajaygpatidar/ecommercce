<?php
    include 'adminheader.php';  
?>
<div class="container-fluid">    
        <div id="loginbox"  class="mainbox  col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-warning col-sm-12" >
                <div class="form-header">
                    <h1 class="col-sm-12 col-sm-offset-3">Add Shipper</h1> 
                    
                </div>
                <div style="padding-top:10px" clss="panel-body" >
                    <div class="col-sm-12">
                    <form action="<?php echo site_url('welcome/addshipper')?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" required="required">
                        </div>
                        <div class="form-group">
                            <label>Mobile:</label>
                            <input type="text" class="form-control" name="mobile" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" required="required">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control"  name="password" required="required">
                        </div>
                        <div class="form-group">
                            <label>address:</label>
                           <textarea name="address"  cols="10" rows="4" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block btn-lg" name="addnewreporter">Add</button>
                        </div>
                    </form>     
                    </div>              
                </div> 
            </div> 
        </div>
        
    </div>