<div class="panel panel-default">
              	<div class="panel-heading">
                  	Change Site Settings
              	</div>
              	<div class="panel-body">
                    <!-- <div class="container"> -->
                <div class="row">
                  <div class="text-danger" id="responce"></div>
                 <div class="col-md-1"></div>            
                <div class="col-md-10">
                        <?php echo form_open_multipart(uri_string(),array('id'=>'settingForm')); ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="site-name">Site Title</label>
                                        <input name="site-name" id="site-name" class="form-control" value="<?php echo $site['title'] !== '' ? $site['title'] : '' ?>" type="text">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Site Email</label>
                                        <input name="email" value="<?php echo $site['email'] !== '' ? $site['email'] : '' ?>" id="email" class="form-control" type="email">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="tel">Site Phone Number</label>
                                        <input name="tel" value="<?php echo $site['phone'] !== '' ? $site['phone'] : '' ?>" id="tel" class="form-control" type="tel">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="sms_api">API Key for SMS Gateway Integrations</label>
                                        <input name="sms_api" value="<?php echo $site['sms_api_key'] !== '' ? $site['sms_api_key'] : '' ?>" id="sms_api" class="form-control" type="text">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="st_sk_key">Stripe Secret Key</label>
                                        <input name="st_sk_key" value="<?php echo $site['stripe_sk_key'] !== '' ? $site['stripe_sk_key'] : '' ?>" id="st_sk_key" class="form-control" type="text">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="st_pk_key">Stripe Publichable Key</label>
                                        <input name="st_pk_key" value="<?php echo $site['stripe_pk_key'] !== '' ? $site['stripe_pk_key'] : '' ?>" id="st_pk_key" class="form-control" type="text">
                                    </div> 
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea rows="3" name="description" id="description" class="form-control"><?php echo $site['des'] !== '' ? $site['des'] : '' ?></textarea>
                                    </div> 
                                </div> 
                                <div class="col-md-6 col-sm-6">
                                	<img class="icon-image-con" width="50%" src="<?php echo $site['icon'] !== '' ? base_url().'assets/images/site-images/'.$site['icon'] : '' ?>">
                                    <div class="form-group">
                                        <label class="btn btn-default" for="icon">Upload Icon</label>
                                        <input style="display: none;" name="icon" class="icon" id="icon" type="file">
                                    </div>
                                </div>
                                 <div class="col-md-6 col-sm-6">
                                 	<img class="logo-image-con" width="50%" src="<?php echo $site !== false && $site['logo'] !== '' ? base_url().'assets/images/site-images/'.$site['logo'] : '' ?>">
                                    <div class="form-group">
                                        <label class="btn btn-info" for="logo">Upload Logo</label>
                                        <input style="display: none;" name="logo" class="logo" id="logo" type="file" accept="image/*">
                                    </div>  
                                </div> 
                                <div class="col-md-12 col-sm-12">
                                    <img class="logo-image-con" width="50%" src="<?php echo $site !== false && $site['home_banner'] !== '' ? base_url().'assets/images/site-images/'.$site['home_banner'] : '' ?>">
                                    <div class="form-group">
                                        <label >Upload Home Banner</label>
                                        <input  name="banner" class="logo" id="banner" type="file" accept="image/*">
                                    </div>  
                                </div> 
                                <div class="col-md-12">
                                	<p class="error text text-danger"></p>
                                	<p class="success text text-success"></p>
                                    <div class="form-group-btn text-right">
                                        <button class="submit" type="submit" class="btn btn-danger btn-primary">Change Setting</button>
                                    </div>
                                </div>
                            </div>   
                       <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-1"></div> 
                </div>
            <!-- </div> -->
              	</div>
          	</div>
	</div>