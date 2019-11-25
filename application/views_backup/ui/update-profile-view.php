<section class="py-5">
    <div class="header pb-8 pt-5  pt-lg-8 d-flex align-items-center" style="min-height: 120px; background-size: cover; background-position: center top;">
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
            </div>
        </div>
    </div>
    <div class="container mt--7">
        <div class="row">
            <?php $this->load->view('template/default/user/paths/user-account-left-view') ?>
            <div class="col-xl-8 order-xl-2">
                <div style="border: 0"  class="card shadow">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">Update Account</h3>
                            <p class="text-default"><?php echo $this->session->userdata('msg'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form accept-charset="UTF-8" id="profileUpdate">
                          <fieldset>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input value="<?php echo !is_null($profile) ? $profile['first_name'] : "" ?>" class="form-control" id="first_name" name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" id="last_name" name="last_name" value="<?php echo !is_null($profile) ? $profile['last_name'] : "" ?>" type="text">
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input class="form-control" id="city" name="city" type="text"  value="<?php echo !is_null($profile) ? $profile['city'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input class="form-control" id="state" name="state" type="text"  value="<?php echo !is_null($profile) ? $profile['state'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Full Address</label>
                                        <input class="form-control" id="address" name="address" type="text"  value="<?php echo !is_null($profile) ? $profile['address'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="about">About You</label>
                                       <textarea name="about" id="about" class="form-control"><?php echo !is_null($profile) ? $profile['about_user'] : "" ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="responce">
                                  
                            </div>
                             <div class="row">
                                <div class="col-4">
                                    <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Update Profile">
                                </div>
                            </div>
                          </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>