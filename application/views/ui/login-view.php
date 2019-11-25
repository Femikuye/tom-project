<div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
      <div class="col-md-6 col-sm-8 col-xs-12 login-page">
        <div class="card">
          <h5 class="card-header">Enter Your Info To Login</h5>
          <div class="card-body">
            <h5 class="card-title"></h5>
			<?php if ($this->session->flashdata('message')) { ?>
				<div class="alert alert-success"> <?= $this->session->flashdata('message') ?> </div>
			<?php } ?>
            <form accept-charset="UTF-8" id="userLogin">
              <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email" type="email" required="">
                </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" required="">
                  </div>
                  <a href="<?php echo base_url('account/password-recovery') ?>">Forgot Password?</a>
                  <!-- <div class="checkbox">
                      <label>
                        <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                      </label>
                  </div> -->
                  <div class="responce text-default">
                      
                  </div> 
                  <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Login">
                  <p>You don't have account? <a class="text-default" href="<?php echo base_url('register') ?>">Register Here</a>  </p>
              </fieldset>
            </form>
            <h3 align="center">OR</h3>
            <div class="col-sm-12 social-buttons">
              <a href="<?php echo $this->general_model->facebook_login_url() ?>" style="color: #fff; margin-bottom: 15px;" class="btn btn-lg btn-social btn-facebook">
                <i class="fab fa-facebook"></i> Sign in with Facebook
              </a>
              <a href="<?php echo $this->general_model->google_login_url() ?>" style="color: #fff; margin-bottom: 15px;" class="btn btn-lg btn-social btn-google-plus">
                <i class="fab fa-google-plus"></i> Sign in with Google
              </a>
             <!--  <a href="" style="color: #fff; margin-bottom: 15px;" class="btn btn-lg btn-social btn-twitter">
                <i class="fab fa-twitter"></i> Sign in with Twitter
              </a> -->
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-2 col-xs-12"></div>
  </div>
</div>