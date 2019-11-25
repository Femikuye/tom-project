
<section style="margin-top: 24px;" class="py-5">
    <div class="container mt--7">
        <div class="row">
        <div class="col-lg-8">
            <?php
                $aid_sub_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_row['aid_category_id']);
                $aid_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_sub_cat['parent_id']);
             ?>
          <h3 class="mt-4"><?php echo "<span class='text-featured'>".$aid_cat['cat_name']."</span><span class='text-default'> > </span><span class='text-featured'>".$aid_sub_cat['cat_name']."</span><span class='text-default'> > </span>".$aid_row['aid_title']; ?></h3>
          <p class="lead">
            by
            <?php echo "<span class='text-default'>". $this->gm->get_a_table_row('users','id_user',$aid_row['poster_id'])['username']."</span>" ?>
          </p>
          <hr>
          <p>Posted on <?php echo @date("M d, Y",$aid_row['date_created']) ?></p>
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

        </div>
        <div class="col-md-4">
          <div class="card my-4">
            <h5 class="card-header">Review and Decide</h5>
            <div class="card-body">
                <div class="responce">
                    
                </div>
                <a style="color: #fff !important" href="<?php echo base_url('account/edit-ad/'.$aid_row['aid_slug']) ?>" class="btn bg-featured">Edit Advert</a>
                <button id="aid_publish" onclick="publish_advert('<?php echo $this->my_encrypt->encode($aid_row['id_aid']) ?>')" class="btn bg-featured">Publish Advert</button>
            </div>
          </div> 
        </div>
        </div>
    </div>
</section>