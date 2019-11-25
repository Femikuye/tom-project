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

                            <h3 class="mb-0">My account</h3>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="listing-head" class="col-md-12">
                                  <h3 class="mt-4">Welcome Back <?php echo $this->user['username']; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <?php $icon = isset($site['icon']) && !is_null($site['icon']) ? base_url().'assets/images/site-images/'.$site['icon'] : "" ;

                                $user_aids = $this->gm->get_table_rows_by_a_field('aids','poster_id',$this->user['id_user']);

                                $aid_views = array();

                                if($user_aids){ foreach($user_aids as $aid){ 

                                    array_push($aid_views, $aid['aid_views']); }}

                            ?>

                          <!-- Icon Cards-->

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">

                                <div class="inforide">

                                  <div class="row">

                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">

                                        <img src="<?php echo $icon ?>">

                                    </div>

                                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">

                                        <h4>Total Advert</h4>

                                        <h2 style="font-size: 15px;"><?php echo $user_aids !== false ? count($user_aids) : '0'; ?></h2>

                                    </div>

                                  </div>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">

                                <div class="inforide">

                                  <div class="row">

                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">

                                        <img src="<?php echo $icon ?>">

                                    </div>

                                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">

                                        <h4>Total Views</h4>

                                        <h2 style="font-size: 15px;"><?php echo $user_aids !== false ? array_sum($aid_views) : '0'; ?></h2>

                                    </div>

                                  </div>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">

                                <div class="inforide">

                                  <div class="row">

                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">

                                        <img src="<?php echo $icon ?>">

                                    </div>

                                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">

                                        <h4>Last Login</h4>

                                        <h2 style="font-size: 15px;"><?php echo @date('d M, Y',$this->user['last_login']) ?></h2>

                                    </div>

                                  </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>