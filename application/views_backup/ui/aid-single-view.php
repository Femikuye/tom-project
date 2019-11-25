

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

              <p>To Contact By Phonee</p>

              

              <p><strong>Use:</strong> <span><a href="tel:<?php echo $aid_row['poster_phone']; ?>"><?php echo $aid_row['poster_phone'];?></a></span></p>

              <p>To Contact By Email</p>

              <div class="row justify-content-center">

                <div class="col-12">

                  <form id="contact-aid-poster">

                        <div class="card rounded-0">

                            <div class="card-header p-0">

                                <div class="bg-featured text-white text-center py-2">

                                    <h3><i class="fa fa-envelope"></i> Fill the form</h3>

                                    <p class="m-0">Contact advertiser here</p>
                                </div>

                            </div>

                            <div class="card-body p-3">

                                <div class="form-group">

                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">

                                            <div class="input-group-text"><i class="fa fa-user text-featured"></i></div>

                                        </div>

                                        <input type="text" class="form-control" id="nombre" name="name" placeholder="Your name" required>

                                        <input type="hidden" value="<?php echo $this->my_encrypt->encode($aid_row['poster_id']) ?>" name="advertiser">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">

                                            <div class="input-group-text"><i class="fa fa-envelope text-featured"></i></div>

                                        </div>

                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="Your Email" required>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">

                                            <div class="input-group-text"><i class="fa fa-comment text-featured"></i></div>

                                        </div>

                                        <textarea name="message" class="form-control" placeholder="Message" required></textarea>

                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <label for="file-doc">Have a file? Upload here</label>

                                    <div class="input-group mb-2">

                                        <input class="form-control" id="file-cod" type="file" name="file">

                                    </div>

                                </div> -->

                                <div class="responce"></div>

                                <div class="text-center">

                                    <input type="submit" value="Send Message" class="btn bg-featured btn-block rounded-0 py-2">

                                </div>

                            </div>



                        </div>

                    </form>

                </div>

              </div>

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

            <h5 class="card-header">Sponsored Aids</h5>

            <div class="card-body">



            </div>

          </div>

        </div>

        </div>

        <?php }else{ ?>

          <h2 align="center" class="text-featured">Sorry! The advert you want to view is not available</h2>

      <?php } ?>

    </div>

</section>

