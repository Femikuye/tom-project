

<?php //$this->load->view('template/default/user/paths/top-header-view'); ?>
<?php $top_cat = $this->general_model->get_top_catigories(10);?>
<div class="row">
    <a rel="nofollow" href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('assets/images/site-images/'.$site['home_banner']); ?>" alt="Large" class="img-responsive visible-lg visible-md center-block" />
    </a>
    <?php //var_dump($site) ?>
</div>
<div class="row gray main_row ">
    <nav class="tab_nav frame_wrap">
        <h2 class="small-head visible-xs">Browse by category</h2>

        <ul class="nav nav-pills ct_pills nav-justified hidden-xs">
            <?php
                $top_category = $this->general_model->get_top_catigories(7);
                if ($top_category) { foreach ($top_category as $top){
            ?>
            <li data-action="VOID" data-dest="[data-item=CategoryPanel][data-type=<?php echo $top['cat_short_name']; ?>]" data-cb="CategoryTabsDisplayed" data-type="TabCategoryTitle">
                <a href="javascript:;">
                    <i class="fa <?php echo $top['cat_icon']; ?> align"></i><?php echo $top['cat_name']; ?>
                    <i class="fa fa-plus pull-right visible-xs fa-lg close_acr"></i>
                </a>
            </li>
            <?php }} ?>
        </ul>

            <div class="tab-content">
                <?php
                if ($top_category) {
                    foreach ($top_category as $top) {
                        ?>
                        <h3 class="tab_responsive visible-xs" data-type="PanelCategoryName" data-dest="[data-item=CategoryPanel][data-type=<?php echo $top['cat_short_name']; ?>]" data-active="active">
                            <a href="javascript:;">
                                <i class="bl-icon-fs5 align"></i><?php echo $top['cat_short_name']; ?>
                                
                                <i class="fa fa-plus pull-right visible-xs fa-lg close_acr"></i>
                            </a>
                        </h3>
                        <div class="tab-pane nt_contnt clearfix" data-item="CategoryPanel" data-type="<?php echo $top['cat_short_name']; ?>">
                            <?php
                            if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$top['id_cat'])) {
                                foreach ($subs as $sub) {
                                    ?>
                                    <ul class="col-xs-12 col-sm-3">
                                        <li>
                                            <a href="<?php echo base_url('ads/cat/'.$sub['cat_slug']); ?>">
                                                <?php echo $sub['cat_name'];?>
                                            </a>
                                        </li>
                                    </ul>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

    </nav>
</div>

<!-- for testinf purpose -->
<!-- product slider start -->
<?php
    $top_ads = $this->gm->get_latest_advert(20);
?>

<div class="row main_row">
    <div class="frame_wrap clearfix voffset2 container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 np" data-type="SLDRC">
            <header class="clearfix">
                <h2 class="small-head  pull-left">Latest Ads</h2>
                <div class="pull-right">
                    <a class="btn btn-default carousel_btn dg" data-type="PRV" href="javascript:;">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </a>
                    <a class="btn btn-default carousel_btn dg" data-type="NXT" href="javascript:;">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>
                </div>
            </header>
            <div class="col-xm-12 np voffset3">
                <div class="carousel edslider" data-type="SLDR" data-name="TopA">
                    <ul class="carousel-inner adsf" data-type="SLDRI">
                        <?php
                            if ($top_ads) {
                                foreach ($top_ads as $ads) {
                                    $img_name = $this->gm->get_aid_featured_images($ads['id_aid'])['image_name'];
                                    $img_path = base_url('assets/images/aid-images/' . $ads['id_aid'] . '/' . $img_name);
                                    ?>
                                    <li class="item s-ed carousel-item text-center">
                                        <a href="<?php echo base_url('ad/' . $this->gm->define_aid_slug($ads['id_aid'], $ads['aid_title'])) ?>">
                                            <div class="thumbnail_container sdi_cont">
                                                <div class="thumbnail thum_img">
                                                    <img src="<?= $img_path ?>" ds="<?= $img_path ?>"
                                                         alt="<?= $ads['aid_title'] ?>" width="auto" height="auto"/>
                                                    <!-- <div class="price">GH₵  <?php //echo $ads['aid_price']; ?></div> -->
                                                </div>
                                            </div>
                                            <h5 class="ld_title"><?= $ads['aid_title'] ?></h5>
                                            <span class="pstd_city eclps"> <?php echo $this->gm->define_price($ads['aid_price']) ?></span>
                                            <span class="pstd_time eclps"><?php echo @date("D, d M Y. ", $ads['date_created']) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product slider end   -->
<div class="container">

    <div class="text-center" id="listing-head">

        <h1 class="mt-4">Welcome to <?php echo $site['title'] ?></h1>

        <h3>Browse Top Categories </h3>

    </div>
</div>
<div style="background-color: #f2f2f2;" class="row main_row borderless hidden-sm hidden-xs">
    <div class="frame_wrap clearfix ft_tab_main container">
        <div class="col-xs-12 np">
            <ul class="nav nav-tabs ft_tab" style="margin-left: 20px;margin-right: 20px;">
                <li class="col-lg-3 np ft_nav active">
                    <a class="ft_nav" aria-controls="search" data-toggle="tab" href="#search" style="margin: 0">
                        <i class="fa fa-search align"></i>
                        <span class="hidden-xs">Top Searches</span>
                    </a>
                </li>
                <li class="col-lg-3 np ft_nav">
                    <a class="ft_nav" aria-controls="location" data-toggle="tab" href="#location">
                        <i class="fa fa-map-marker align"></i>
                        <span class="hidden-xs">Top Locations</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="padding-top: 0;">
                <div class="tab-pane active ft_tab_content clearfix" id="search">
                    <div class="clearfix"></div>
                    <?php if($top_cat){ foreach($top_cat as $num => $cat){ ?>
                        <div class="jodit_clearfix"></div>
                    <ol class="col-md-4 ft_list" >
                        <h4 class="mt-4">
                            <a class="text-default" href="<?php echo base_url('ads/cat/'.$cat['cat_slug']) ?>">
                                <?php echo $cat['cat_name']; ?>
                            </a>
                        </h4>
                        <?php

                        if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$cat['id_cat'],6)){

                        foreach($subs as $sub){

                        ?>
                        <li>
                            <a href="<?php echo base_url('ads/cat/'.$sub['cat_slug']) ?>">
                                <?php echo $sub['cat_name'] ?>
                            </a>
                        </li>
                        <?php }
                        } else {
                            echo '<h4 class="mt-4 text-default">No Sub Category</h4>';
                        }
                        ?>
                    </ol>
                    <?php }} ?>
                </div>
                <div class="tab-pane ft_tab_content" id="location">
                    <?php
                    if($states = $this->gm->get_ghana_states('6')){
                        foreach($states as $state){
                            ?>
                            <div class="regions col-xs-12 col-sm-6 col-md-2">
                                <div id="listing-head">
                                    <h4 class="mt-4">
                                        <a class="text-default" href="<?php echo base_url('ads/p/'.$state['p_slug']) ?>">
                                            <?php echo $state['p_name']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <ul class="list-unstyled">
                                    <?php if($cities = $this->gm->get_ghana_cities($state['id_province'],'5')){
                                        foreach($cities as $city){
                                            ?>
                                            <li>
                                                <a class="region-link" href="<?php echo base_url('ads/p/'.$city['p_slug']) ?>">
                                                    <?php echo $city['p_name']; ?>
                                                </a>
                                            </li>

                                        <?php }} ?>
                                    <h6 class="mt-4"> <a class="text-default" href="<?php echo base_url('ads/p/'.$state['p_slug']) ?>">All <?php echo $state['p_name']; ?> Cities</a></h6>
                                </ul>

                            </div>

                        <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- for testing purpose -->




