

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
                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="<?php echo base_url('ads/cat/'.$cat['cat_slug']) ?>">All <?php echo $cat['cat_name'] ?></a>
                </div>
                <?php 

                   if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$cat['id_cat'])){

                    foreach($subs as $sub){

                ?>
               <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="<?php echo base_url('ads/cat/'.$sub['cat_slug']) ?>"><?php echo $sub['cat_name'] ?></a>
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
            <?php 
               if($states = $this->gm->get_ghana_states('6')){
                foreach($states as $state){
            ?>
           <div class="regions col-xs-12 col-sm-6 col-md-2">
                <div id="listing-head">
                    <h4 class="mt-4"> <a class="text-default" href="<?php echo base_url('ads/p/'.$state['p_slug']) ?>"><?php echo $state['p_name']; ?></a></h4>
                </div>
                <ul class="list-unstyled">
                <?php if($cities = $this->gm->get_ghana_cities($state['id_province'],'5')){
                    foreach($cities as $city){
                ?>
                 <li><a class="region-link" href="<?php echo base_url('ads/p/'.$city['p_slug']) ?>"><?php echo $city['p_name']; ?></a></li>

                <?php }} ?>
                <h6 class="mt-4"> <a class="text-default" href="<?php echo base_url('ads/p/'.$state['p_slug']) ?>">All <?php echo $state['p_name']; ?> Cities</a></h6>
                </ul>

            </div>

        <?php }} ?>

       </div>

   </div>

</section>



