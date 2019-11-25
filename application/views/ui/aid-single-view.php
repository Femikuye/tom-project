

<section style="margin-top: 24px;" class="py-5">

    <div class="container mt--7">

      <?php if($aid_row){ 

          $this->general_model->increase_ad_view($aid_row['id_aid']);

       ?>

        <div class="row">

        <div class="col-lg-8">

            <?php

                $aid_sub_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_row['aid_subcategory_id']);

                $aid_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_row['aid_category_id']);

             ?>

          <h3 class="mt-4"><?php echo "<a  href='".base_url('aids/cat/'.$aid_cat['cat_slug'])."' class='text-featured'>".$aid_cat['cat_name']."</a><span class='text-default'> > </span><a  href='".base_url('aids/cat/'.$aid_sub_cat['cat_slug'])."' class='text-featured'>".$aid_sub_cat['cat_name']."</a><span class='text-default'> > </span>".$aid_row['aid_title']; ?></h3>

          <p class="lead">

            by

            <?php echo "<span class='text-default'>". $this->gm->get_a_table_row('users','id_user',$aid_row['poster_id'])['username']."</span>" ?>

          </p>

          <hr>

          <p><strong>Posted on:</strong> <?php echo @date("M d, Y",$aid_row['date_created']) ?></p>

          <hr>

          <div class="accordian">

            <ul>

              <?php if($images = $this->gm->get_aid_images($aid_row['id_aid'])){

                  foreach($images as $image){

                    $img_path = base_url('assets/images/aid-images/'.$aid_row['id_aid'].'/'.$image['image_name']);

               ?>

              <li>

                <img class="card-img-top" src="<?php echo $img_path; ?>"/>

              </li>

            <?php }} ?>

            </ul>

          </div>

          <hr>

          <div>

              <?php echo $aid_row['aid_des'] ?>

          </div>

          <div>

            <!-- <h4>Adver Details</h4> -->

            <ul class="list-inline">

              <li class="list-inline-item">

                  <strong>City:</strong>

              </li>

              <li class="list-inline-item">

                  |

              </li>

              <li class="list-inline-item">

                  <span><?php echo $aid_row['aid_city'] ?></span>

              </li>

            </ul>

            <ul class="list-inline">

              <li class="list-inline-item">

                  <strong>State:</strong>

              </li>

              <li class="list-inline-item">

                  |

              </li>

              <li class="list-inline-item">

                  <span><?php echo $aid_row['aid_state'] ?></span>

              </li>

            </ul>

            <ul class="list-inline">

              <li class="list-inline-item">

                  <strong>Price:</strong>

              </li>

              <li class="list-inline-item">

                  |

              </li>

              <li class="list-inline-item">

                  <span><?php echo $this->gm->define_price($aid_row['aid_price'])  ?></span>

              </li>

            </ul>

          </div>

        </div>

        <div class="col-md-4">

          <div class="card my-4">

            <h5 class="card-header">Contact the advertiser</h5>

            <div class="card-body">

              <p>Phone Number:</p>

              <?php $poster = $this->general_model->get_a_table_row('users','id_user',$aid_row['poster_id']) ?>

              <p> <span><a href="tel:<?php echo $poster['phone']; ?>"><?php echo $poster['phone'];?></a></span></p>

            </div>

          </div> 

          <div class="card my-4">

            <h5 class="card-header">Related Posts</h5>

            <div class="card-body">

              <?php if($related = $this->gm->get_related_advert($aid_row['id_aid'],$aid_row['aid_category_id'])){ 

                  foreach($related as $row){

                    $images = $this->gm->get_aid_images($row['id_aid']);

                    $img_path = base_url('assets/images/aid-images/'.$row['id_aid'].'/'.$images[0]['image_name']);

                ?>

                <div class="row">

                    <div class="col-md-12">

                      <div class="row border">

                          <div class="col-md-4  no-margin">

                              <img style="width: 70px;" src="<?php echo $img_path ?>" >

                          </div>

                          <div style="padding: 0;" class="col-md-8  card-body">

                              <h4 style="margin: 0" class="text-default"> <a class="text-featured" href="<?php echo base_url('ad/'.$this->gm->define_aid_slug($row['id_aid'],$row['aid_title'])) ?>"><?php echo substr($row['aid_title'], 0,40) ?></a></h4>

                          </div>                           

                        </div>

                    </div>

                </div>

              <?php }} ?>

            </div>

          </div>

          <div class="card my-4">

            <h5 class="card-header">SAFETY TIPS</h5>

            <div class="card-body">

<h5> Tormami.com manually review any ads placed on our website hence any ads we found inappropriate will be deleted without prior notice.</h5>
<p>Take note of these safety precaution in any transaction.</p>

<p>Do not disburse money prior to receiving or seeing a promised ITEM.</p>

<p>Do not meet buyer/Seller in an isolated are. Bars, Restaurants, Coffee shops, Shopping mall e.t.c is advisable.</p>

<p>Do not meet buyer/Seller Alone.</p>

<p>Take some time to thoroughly examine a product ask necessary questions and be satisfied before making any payment.</p>

<p>Be careful of visa contactors.</p>

            </div>

          </div>

        </div>

        </div>

        <?php }else{ ?>

          <h2 align="center" class="text-featured">Sorry! The advert you want to view is not available</h2>

      <?php } ?>

    </div>

</section>

