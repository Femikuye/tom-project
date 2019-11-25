<style>

.modal {

  display: none; /* Hidden by default */

  position: fixed; /* Stay in place */

  z-index: 1; /* Sit on top */

  padding-top: 8%; /* Location of the box */

  left: 0;

  top: 0;

  width: 100%; /* Full width */

  height: 100%; /* Full height */

  /*overflow: none;*/ /* Enable scroll if needed */

  background-color: rgb(0,0,0); /* Fallback color */

  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

}

.modal-content {

  background-color: #fefefe;

  margin: auto;

  overflow: auto;

  padding: 20px;

  border: 1px solid #888;

  width: 70%;

  height: 80%;

}

.close {

  color: #aaaaaa;

  float: right;

  font-size: 28px;

  font-weight: bold;

  opacity: 0.6;

}

.close:hover,

.close:focus {

  color: #000;

  text-decoration: none;

  cursor: pointer;

}

</style>

<section style="margin-top: 24px;" class="py-5">

    <div class="container mt--7"> 

        <div class="row">

        <div class="col-md-12">

          <div class="row">

              <div id="listing-head" class="col-md-12">

                <h5 class="mt-4"> <?php echo $heading; ?></h5>

              </div>            

            </div>

            <?php 

              if($aid_rows){ foreach($aid_rows as $row){

                $img_name = $this->gm->get_aid_featured_images($row['id_aid'])['image_name'];

                $img_path = base_url('assets/images/aid-images/'.$row['id_aid'].'/'.$img_name);

                $aid_sub_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$row['aid_category_id']);

            ?>            

            <div id="listings" class="row">

                <div class="col-sm-12"> 

                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">

                        <div class="media row">

                            <div class="col-sm-12 col-md-4 col-xs-12">

                                <a class="pull-left" href="<?php echo base_url('ad/'.$this->gm->define_aid_slug($row['id_aid'],$row['aid_title'])) ?>" target="_parent">

                            <img alt="image" class="img-responsive listing-img" src="<?php echo $img_path ?>"></a>

                            </div> 

                            <div class="clearfix visible-sm"></div>

                            <div  class="media-body fnt-smaller col-sm-12 col-md-8 col-xs-12">

                                <h2 class="media-heading">

                                  <a href="<?php echo base_url('ad/'.$this->gm->define_aid_slug($row['id_aid'],$row['aid_title'])) ?>" target="_parent">
                                      <small class="text-info"><?php echo substr($row['aid_title'], 0,30) ?></small>
                                  </a>
                                </h2>
                                  <p class="hidden-xs"><?php echo substr($row['aid_des'], 0,100)."..." ?></p>
                                  <span class="fnt-smaller fnt-lighter fnt-arial"><?php echo $row['aid_city'].' , '.$row['aid_state'] ?>
                                      <span class="text-info" style="list-style: none"> | </span>
                                      <?php echo $this->general_model->get_a_table_row('aid_categories','id_cat',$row['aid_category_id'])['cat_name'] ?>
                                  </span>
                                  <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                    <li><?php echo @date("D, d M Y. ",$row['date_created'])  ?></li>
                                </ul>
                                <span style="font-size: 25px; font-weight: 700;" class="fnt-smaller fnt-lighter fnt-arial">
                                    <?php echo $this->gm->define_price($row['aid_price']) ?>
                                </span>

                            </div>

                        </div>

                    </div>

                  </div>

                </div>

                <nav aria-label="Page navigation example">

                  <ul class="pagination">

                    <?php if($pages > 0){ if($cpp > 1){ $prev = $cpp - 1;  ?>

                    <li class="page-item">

                      <a class="page-link" href="<?php echo $paging_url.'/'.$prev ?>" aria-label="Previous">

                        <span aria-hidden="true">«</span>

                        <span class="sr-only">Previous</span>

                      </a>

                    </li>

                    <?php } ?>

                    <?php for($i=0;$i<$pages;$i++){ $link = $i + 1; ?>                   

                    <li class="page-item <?php echo $link === $cpp ? 'active' : '' ?>"><a class="page-link" href="<?php echo $paging_url.'/'.$link ?>"><?php echo $link ?></a></li>

                    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>

                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->

                <?php }if($cpp < $pages ){ $next = $cpp + 1; ?>

                    <li class="page-item">

                      <a class="page-link" href="<?php echo $paging_url.'/'.$next ?>" aria-label="Next">

                        <span aria-hidden="true">»</span>

                        <span class="sr-only">Next</span>

                      </a>

                    </li>

                <?php }} ?>

                  </ul>

                </nav>

        <?php }}else{ ?>

          <h2 align="center" class="text-featured">Sorry! No advert available for your search term</h2>

      <?php } ?> 

    </div>

</section>

<!-- <button id="myBtn">c</button> -->

<!-- Category Modal Start -->

<div id="categoryModal" class="modal">

          <div class="modal-content">

            <div align="left">

                <span id="c-modal-close" class="close">&times;</span>

            </div>

             <div class="container">

            <div id="listing-head">

                <h3 class="mt-4">Browse Category</h3>

            </div>

            <div class="row">

                <?php 

                   if($cats =  $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id','0')){

                    foreach($cats as $cat){

                        $c_url = '';

                        if(!is_null($seg)){

                            if($seg === 'cat'){ 

                                $c_url = base_url('ads/cat/'.$cat['cat_slug']);

                            }elseif($seg === 'p'){

                                $c_url = base_url('ads/'.$slug.'/'.$cat['cat_slug']);

                            }

                        }else{

                            if(!is_null($this->uri->segment(2))){

                                if(ctype_digit($this->uri->segment(2))){

                                    $c_url = base_url('ads/cat/'.$cat['cat_slug']);

                                }else{

                                    if(!is_null($this->uri->segment(3))){

                                        $c_url = base_url('ads/'.$this->uri->segment(2).'/'.$cat['cat_slug']);

                                    }else{

                                        $c_url = base_url('ads/cat/'.$cat['cat_slug']);

                                    } 

                                } 

                            }else{

                                $c_url = base_url('ads/cat/'.$cat['cat_slug']);

                            }                                    

                        }

                    ?>

               <div class="col-xs-12 col-sm-6 col-md-3">

                    <div id="listing-head">

                        <h3 class="mt-4"><?php echo $cat['cat_name'] ?></h3>

                    </div>

                    <ul class="list-unstyled">

                    <li><a  class="select-category-search" data-name="<?php echo $cat['cat_name'] ?>" data-id="<?php echo $this->my_encrypt->encode($cat['id_cat']) ?>" href="<?php echo $c_url ?>"><?php echo $cat['cat_name']; ?></a></li>

                    <?php if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$cat['id_cat'])){

                        foreach($subs as $sub){

                            $s_url = '';

                        if(!is_null($seg)){

                            if($seg === 'cat'){ 

                                $s_url = base_url('ads/cat/'.$sub['cat_slug']);

                            }elseif($seg === 'p'){

                                $s_url = base_url('ads/'.$slug.'/'.$sub['cat_slug']);

                            }

                        }else{

                            if(!is_null($this->uri->segment(2))){

                                if(ctype_digit($this->uri->segment(2))){

                                    $s_url = base_url('ads/cat/'.$sub['cat_slug']);

                                }else{

                                    if(!is_null($this->uri->segment(3))){

                                        $s_url = base_url('ads/'.$this->uri->segment(2).'/'.$sub['cat_slug']);

                                    }else{

                                        $s_url = base_url('ads/cat/'.$sub['cat_slug']);

                                    } 

                                } 

                            }else{

                                $s_url = base_url('ads/cat/'.$sub['cat_slug']);

                            }                                    

                        }

                    ?>

                     <li><a  class="select-category-search" data-name="<?php echo $sub['cat_name'] ?>" data-id="<?php echo $this->my_encrypt->encode($sub['id_cat']) ?>" href="<?php echo $s_url ?>"><?php echo $sub['cat_name']; ?></a></li>

                    <?php }} ?>

                    </ul>

                </div>

            <?php }} ?>

           </div>

       </div>

          </div>

        </div>

        <!-- Category Modal End -->

        <!-- Province Modal Start -->

        <div id="provinceModal" class="modal">

          <div class="modal-content">

            <div align="left">

                <span id="p-modal-close" class="close">&times;</span>

                <?php //echo $this->uri->segment(4); ?>

            </div>

             <div class="container">

                <div id="navbar-example" class="category-con">

                    <ul class="nav nav-tabs" role="tablist">

                        <?php $states = $this->gm->get_ghana_states('10'); ?>

                        <?php if($states){ foreach($states as $num => $state){ ?>

                        <li class="nav-item"> 

                            <a class="nav-link <?php echo $num === 0 ? 'active' : '' ?>" data-toggle="tab" href="#cat-list-<?php echo $num ?>" role="tab"><span class="text-center" style="display: block;"></span><?php echo $state['p_name'] ?></a>

                        </li>

                        <?php }} ?>

                    </ul>

                    <div class="tab-content">

                        <?php if($states){ foreach($states as $num => $state){ ?>

                        <div class="tab-pane fade <?php echo $num === 0 ? 'in active show' : '' ?>" id="cat-list-<?php echo $num ?>" role="tabpanel">

                            <div class="row">

                            <?php 

                            $s_url = '';

                                if(!is_null($seg)){

                                    if($seg === 'cat' ){ 

                                        $s_url = base_url('ads/'.$state['p_slug'].'/'.$slug);

                                    }elseif($seg === 'p'){

                                        $s_url = base_url('ads/p/'.$state['p_slug']);

                                    }

                                }else{

                                    if(!is_null($this->uri->segment(2))){

                                        if(ctype_digit($this->uri->segment(2))){

                                            $s_url = base_url('ads/p/'.$state['p_slug']);

                                        }else{

                                            if(!is_null($this->uri->segment(3))){

                                                $s_url = base_url('ads/'.$state['p_slug'].'/'.$this->uri->segment(3));

                                            }else{

                                                $s_url = base_url('ads/p/'.$state['p_slug']);

                                            } 

                                        } 

                                    }else{

                                        $s_url = base_url('ads/p/'.$state['p_slug']);

                                    }                                    

                                }

                            ?>

                            <div class="col-xs-12 col-sm-6 col-md-3">

                                 <a  class="select-province-search" data-name="<?php echo $state['p_name'] ?>" href="<?php echo $s_url ?>"><?php echo $state['p_name']; ?></a>

                            </div>

                            <?php 

                               if($cities = $this->general_model->get_table_rows_by_a_field('ghana_province','p_state_id',$state['id_province'])){

                                foreach($cities as $city){

                                    $c_url = '';

                                    if(!is_null($seg)){

                                        if($seg === 'cat' ){ 

                                            $c_url = base_url('ads/'.$city['p_slug'].'/'.$slug);

                                        }elseif($seg === 'p'){

                                            $c_url = base_url('ads/p/'.$city['p_slug']);

                                        }

                                    }else{

                                        if(!is_null($this->uri->segment(2))){

                                            if(ctype_digit($this->uri->segment(2))){

                                                $c_url = base_url('ads/p/'.$city['p_slug']);

                                            }else{

                                                if(!is_null($this->uri->segment(3))){

                                                    $c_url = base_url('ads/'.$city['p_slug'].'/'.$this->uri->segment(3));

                                                }else{

                                                    $c_url = base_url('ads/p/'.$city['p_slug']);

                                                } 

                                            } 

                                        }else{

                                            $c_url = base_url('ads/p/'.$city['p_slug']);

                                        }                                    

                                    }

                            ?>

                           <div class="col-xs-12 col-sm-6 col-md-3">

                                <a  class="select-province-search" data-name="<?php echo $city['p_name'] ?>" href="<?php echo $c_url ?>"><?php echo $city['p_name']." "; ?></a>

                            </div>

                        <?php }} ?>

                       </div>

                        </div>

                        <?php }} ?>

                    </div>

                </div>

       </div>

          </div>

        </div>

        <!-- Province Modal End-->

        <script>

            let cat_modal = document.getElementById("categoryModal");

            let p_modal = document.getElementById("provinceModal");

            //var btn = document.getElementById("myBtn");

            let pspan = document.getElementById("p-modal-close");

            let cspan = document.getElementById("c-modal-close");

            // btn.onclick = function() {

            //   modal.style.display = "block";

            // }

            pspan.onclick = function() {

              p_modal.style.display = "none";

            }

            cspan.onclick = function() {

              cat_modal.style.display = "none";

            }

            // window.onload = function(event) {

            //   //if (event.target == modal) {

            //     modal.style.display = "block";

            //   //}

            // }

            let category_modal = function(){

              cat_modal.style.display = "block";

            }

            let province_modal = function(){

              p_modal.style.display = "block";

            }

        </script>

