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

                    <?php 

                        if($aid_rows){

                            foreach($aid_rows as $row){

                                $img_name = $this->gm->get_aid_featured_images($row['id_aid'])['image_name'];

                                $img_path = base_url('assets/images/aid-images/'.$row['id_aid'].'/'.$img_name);

                     ?>

                    <div class="row user-aid-<?php echo $row['uid'] ?>">

                      <div class="col-md-12">

                        <div class="row border">

                            <div class="col-md-4  no-margin">

                                <img src="<?php echo $img_path ?>" >

                            </div>

                            <div class="col-md-8  card-body">

                                <h4 class="text-default"><?php echo substr($row['aid_title'], 0,20) ?>...</h4>

                                <p><?php echo substr($row['aid_des'], 0,60) ?>...</p>

                                <ul class="list-inline">

                                    <li class="list-inline-item">

                                        <a href="#!"><?php echo $this->gm->get_a_table_row('aid_categories','id_cat',$row['aid_category_id'])['cat_name'] ?></a>

                                    </li>

                                    <li class="list-inline-item">

                                        <a href="#!">|</a>

                                    </li>

                                    <li class="list-inline-item">

                                        <a href="#!"><?php echo $this->gm->define_price($row['aid_price']); ?></a>

                                    </li>

                                    <li class="list-inline-item">

                                        <a href="#!">|</a>

                                    </li>

                                    <li class="list-inline-item">

                                        <a href="#!"><?php echo $row['aid_views']." Views" ?></a>

                                    </li>

                                </ul>

                                <button onclick="javascript:location.href='<?php echo base_url('ad/'.$this->gm->define_aid_slug($row['id_aid'],$row['aid_title'])) ?>'" type="button" class="btn btn-primary btn-outline-info">View Ad</button>

                               <button onclick="javascript:location.href='<?php echo base_url('account/edit-ad/'.$row['aid_slug']) ?>'" type="button" class="btn btn-primary btn-outline-info">Edit Ad</button>

                                <button onclick="delete_user_aid('<?php echo $this->my_encrypt->encode($row['id_aid']); ?>')" type="button" class="btn btn-info btn-outline-info">Delete Ad</button>

                            </div>                           

                        </div>

                    </div>

                    </div>

                <?php }} ?>

                </div>

            </div>

        </div>

    </div>

</section>