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
                                      <small class="pull-right"><?php echo substr($row['aid_title'], 0,30) ?></small>
                                  </a>
                                </h2>
                                  <p class="hidden-xs"><?php echo substr($row['aid_des'], 0,40)."..." ?></p>
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
              <?php } ?>
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <?php if($pages > 0){ if($cpp > 1){ $prev = $cpp - 1;  ?>
                    <li class="page-item">
                      <a class="page-link" href="<?php echo $paging_url.'/'.$prev.'?'.$s_query ?>" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <?php } ?>
                    <?php for($i=0;$i<$pages;$i++){ $link = $i ; ?>
                    <li class="page-item <?php echo $link === $cpp ? 'active' : '' ?>"><a class="page-link" href="<?php echo $paging_url.'/'.$link.'?'.$s_query  ?>"><?php echo $link ?></a></li>
                    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                <?php }if($cpp < $pages ){ $next = $cpp ; ?>

                    <li class="page-item">

                      <a class="page-link" href="<?php echo $paging_url.'/'.$next.'?'.$s_query ?>" aria-label="Next">

                        <span aria-hidden="true">»</span>

                        <span class="sr-only">Next</span>

                      </a>

                    </li>

                <?php }} ?>

                  </ul>

                </nav>

        <?php }else{ ?>

          <h2 align="center" class="text-featured">Sorry! No advert available for your search term</h2>

      <?php } ?> 

    </div>

</section>

