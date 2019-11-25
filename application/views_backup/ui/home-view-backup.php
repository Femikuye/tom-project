<?php $this->load->view('template/default/user/paths/top-header-view'); ?>
<section class="py-5">
    <?php $top_cat = $this->general_model->get_top_catigories(10); ?>
    <div class="container">
        <div class="text-center" id="listing-head">
            <h1 class="mt-4">Welcome to <?php echo $site['title'] ?></h1>
            <h3>Browse Top Categories</h3>
        </div>
        <div id="navbar-example" class="category-con">
        <ul class="nav nav-tabs" role="tablist">
            <?php if($top_cat){ foreach($top_cat as $num => $cat){ ?>
            <li class="nav-item"> 
                <a class="nav-link <?php echo $num === 0 ? 'active' : '' ?>" data-toggle="tab" href="#cat-list-<?php echo $num ?>" role="tab"><span class="text-center" style="display: block;"><i class="<?php echo $cat['cat_icon'] ?> fa-2x text-featured"></i></span><?php echo $cat['cat_short_name'] ?></a>
            </li>
            <?php }} ?>
        </ul>
        <div class="tab-content">
            <?php if($top_cat){ foreach($top_cat as $num => $cat){ ?>
            <div class="tab-pane fade <?php echo $num === 0 ? 'in active show' : '' ?>" id="cat-list-<?php echo $num ?>" role="tabpanel">
                <div class="row">
                <?php 
                   if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$cat['id_cat'])){
                    foreach($subs as $sub){
                ?>
               <div class="col-xs-12 col-sm-6 col-md-3">
                   <a href="<?php echo base_url('search/cat/'.$sub['cat_slug']) ?>"><?php echo $sub['cat_name'] ?></a>
                    
                </div>
            <?php }} ?>
           </div>
            </div>
            <?php }} ?>
        </div>
    </div>   
</div>
</section>
<section style="background-color: #f2f2f2;" class="py-5">
    <div class="container">
        <div id="listing-head">
            <h3 class="mt-4">Browse In Your Location</h3>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
              <!--   <div id="listing-head">
                    <h3 class="mt-4">Browse By Region</h3>
                </div> -->
              <ul class="nav navbar-nav category-class w3-ul w3-small">
                <?php if($states = $this->gm->get_ghana_states('6')){
                    foreach($states as $num => $state){
                ?>
                <li class="dropdown mega-dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#!" > <?php echo $state['p_name'] ?> <span><i class="fa fa-arrow-right"></i></span></a> 
                    <ul class="dropdown-menu mega-dropdown-menu">
                        <li class="col-sm-12">
                            <ul>
                                <li class="dropdown-header"><?php echo $state['p_name'] ?></li>
                                <?php if($cities = $this->general_model->get_table_rows_by_a_field('ghana_province','p_state_id',$state['id_province'])){
                                    foreach($cities as $num => $city){
                                ?>
                                <li><a href="<?php echo base_url().'search/p/'.$city['p_slug'] ?>"><?php echo $city['p_name'] ?> </a></li>
                                <?php }} ?>
                            </ul>
                        </li>
                    </ul>      
                </li>
            <?php }} ?>
              </ul>        
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
               <!--  <div id="listing-head">
                    <h3 class="mt-4">Latest Adverts</h3>
                </div> -->

<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <?php 
        if($rows = $this->gm->get_latest_advert()){ foreach($rows as $num => $row){
            $img_name = $this->gm->get_aid_featured_images($row['id_aid'])['image_name'];
            $img_path = base_url('assets/images/aid-images/'.$row['id_aid'].'/'.$img_name);
            $aid_sub_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$row['aid_category_id']);
    ?> 
    <div class="carousel-item <?php echo $num === 0 ? 'active' : '' ?>">
      <div class="mask flex-center">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7 col-12 order-md-1 order-2">
              <h4><?php echo substr($row['aid_title'], 0,30) ?></h4>
              <p><?php echo substr($row['aid_des'], 0,70) ?></p>
              <h2><?php echo $this->gm->define_price($row['aid_price']) ?></h2>
              <a href="<?php echo base_url('ad/'.$this->gm->define_aid_slug($row['id_aid'],$row['aid_title'])) ?>">VIEW AD</a> </div>
            <div class="col-md-5 col-12 order-md-2 order-1"><img src="<?php echo $img_path ?>" class="mx-auto" alt="slide"></div>
          </div>
        </div>
      </div>
    </div> 
<?php }}?>
  </div>
  <!-- <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div> -->
<!--slide end--> </div>
  </div>
</div>
   </div>
</section>
