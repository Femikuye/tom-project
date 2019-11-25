

<div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                <div style="border: 0" class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="profile-header-container">
                         <?php 
                                $profile_image = base_url().'assets/images/user-images/'.$this->user['id_user'].'/'.$this->profile['user_image'];
                                 ?>   
                            <div class="profile-header-img card-profile-image">
                                <img class="img-circle user-profile-img" src="<?php echo $profile_image; ?>" />
                                <!-- badge -->
                                <div class="rank-label-container">
                                    <label for="profile_pohoto" class="label label-default rank-label">Change</label>
                                </div>
                            <input id="profile_pohoto" onchange="uploadProfilePhoto(event)" style="display: none;" type="file" name="profile-photo">
                            <p class="text-default upload-error"></p>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body pt-0 pt-md-4"> 
                            <ul class="w3-ul w3-small">
                                    <li><a href="<?php echo base_url('account/update-profile') ?>">Update Profile</a></li>
                                    <li><a href="<?php echo base_url('account/post-ad') ?>">Post New Advert</a></li>
                                    <li><a href="<?php echo base_url('account/my-ads') ?>">My Adverts</a></li>
                            </ul>
                    </div>
                </div>
            </div>