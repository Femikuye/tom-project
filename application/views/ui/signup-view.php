<div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
      <div class="col-md-6 col-sm-8 col-xs-12 login-page">
        <div class="card">
          <h5 class="card-header">Register New Account</h5>
          <div class="card-body">
            <p class="card-title"></p>
            <div class="user_signup">
            <form accept-charset="UTF-8" id="userSignup">
              <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Username" name="username" type="text" required="">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email" type="email" required="">
                </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" required="">
                  </div>
                  <div class="responce text-default">
                      
                  </div> 
                  <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Register">
                  <p>Have account? <a class="text-default" href="<?php echo base_url('login') ?>">Login Here</a>  </p>
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
    </div>
    <div class="col-md-3 col-sm-2 col-xs-12"></div>
  </div>
</div>