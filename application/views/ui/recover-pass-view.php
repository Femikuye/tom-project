<div class="container">
    <div class="row">
      <div class="col-4 offset-4 login-page">
        <div class="card">
          <h5 class="card-header">Enter your email to reset password</h5>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <form accept-charset="UTF-8" class="user_recover" id="passwordRequest">
              <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email" type="email" required="">
                </div>
                <div class="responce"> </div> 
                <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Login">
                <p>You don't have account? <a class="text-default" href="<?php echo base_url('register') ?>">Register Here</a> <strong>OR</strong> <a class="text-default" href="<?php echo base_url('login') ?>">Login Here</a>  </p>
              </fieldset>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>