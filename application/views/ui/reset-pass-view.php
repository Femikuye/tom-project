<div class="container">
    <div class="row">
      <div class="col-4 offset-4 login-page">
        <div class="card">
          <h5 class="card-header">Enter Your New Password</h5>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <?php if($success){ ?>
            <form accept-charset="UTF-8" class="user_recover" id="passwordReset">
              <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="Enter Password" name="password" type="password" required="">
                    <input type="hidden" value="<?php echo $this->my_encrypt->encode($user_id) ?>" name="user_id">
                    <input type="hidden" value="<?php echo $code ?>" name="code">
                  </div>
                  <div class="responce"> </div> 
                  <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Login">
              </fieldset>
            </form>
          <?php }else{ ?>
            <p><?php echo $msg ?></p>
          <?php } ?>
          </div>
        </div>
    </div>
  </div>
</div>