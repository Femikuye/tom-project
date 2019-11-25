<header>
    <?php $logo = isset($site['logo']) && !is_null($site['logo']) ? base_url().'assets/images/site-images/'.$site['logo'] : "" ?>
    <?php $top_cat = $this->general_model->get_top_catigories(10); ?>
    <div class="row hidden-print ">
        <div class="col-md-12 top_nav ">
            <div class="frame_wrap clearfix ">
                <!--<a class="brand" href="<?php /*echo base_url(); */?>">
                    <img src="<?php /*echo $logo */?>" alt="<?php /*echo $site['logo'] */?> - Logo" width="284" height="75">
                </a>-->
                <nav class="col-md-9 col-md-12 col-sm-10 pull-right np">
                    <a class="rightbar_key btn pull-right-xs visible-xs" data-toggle="collapse"  rel="nofollow" >
                        <span class="fa fa-bars"></span>
                    </a>
                    <a class="srch_key btn active visible-xs pull-right-xs" data-action="SH"  rel="nofollow" href="#">
                        <span class="fa fa-search"></span>
                    </a>
                    <div class="rightbar-wrapper collapse" data-type="TopMenu">
                        <div class="rightbar">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a rel="nofollow" href="<?php echo base_url('account/post-ad') ?>">
                                        <i style="color: #fff" class="fa fa-plus"></i> Post an Ad
                                    </a>
                                </li>
                                <!--<li>
                                    <a rel="nofollow" href="<?php /*echo base_url('account') */?>">
                                        <i class="fa fa-home"></i> My Account
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="help_and_how.html">
                                        <i class="fa fa-life-ring"></i> Help
                                    </a>
                                </li>-->
                            </ul>
                            <h2>My Account</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a rel="nofollow" href="<?php echo base_url('account') ?>">
                                        <i class="fa fa-star align"></i> My Account
                                    </a>
                                </li>
                                <?php if($this->session->userdata('user')){ ?>
                                    <li>
                                        <a rel="nofollow" href="<?php echo base_url('account/logout') ?>">
                                            <i class="fa fa-user-plus align"></i> Logout
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <ul class="nav nav-pills nav-stacked"></ul>
                        </div>
                    </div>
                    <ul class="top_menu pull-right">

                        <?php if($this->session->userdata('user')){ ?>
                            <li>
                                <a rel="nofollow" href="<?php echo base_url('account') ?>">
                                    <i class="fa fa-star align"></i> My Account
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" href="<?php echo base_url('account/logout') ?>">
                                    <i class="fa fa-user-plus align"></i> Logout
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a rel="nofollow" href="<?php echo base_url('login') ?>">
                                    <i class="fa fa-user-plus align"></i> Login
                                </a>
                            </li>
                        <?php } ?>
                        <li class="hidden-xs">
                            <a class="btn btn-primary submit-new" rel="nofollow" href="<?php echo base_url('account/post-ad') ?>">
                                <i class="fa fa-plus-circle fa-lg"></i> Post an ad
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- logo and search div start from here -->
        <div class="inner_head">
            <div class="col-md-12 " data-type="SearchHidden">
                <div class="frame_wrap clearfix ">
                    <div class="col-md-4">
                        <a class="ml-lg-5" href="<?php echo base_url(); ?>">
                            <img src="<?php echo $logo ?>" alt="<?php echo $site['logo'] ?> - Logo" width="284" height="75">
                        </a>
                    </div>
                    <div class="col-md-7 col-sm-12 pull-right np mr-5">
                        <h2 class="visible-lg visible-md visible-sm">
                            Buy or sell anything, anytime ,anywhere in Ghana
                        </h2>
                        <form method="post" action="#" data-type="SearchForm" autocomplete="off">
                            <fieldset>
                                <div class="input-group col-md-7 col-sm-7 pull-left" role="search">
                                    <div class="has-sug clearfix">
                                        <input class="form-control srch_input" placeholder="I'm looking for..." type="search" name="search_data" value="" Title="Tormami"/>
                                        <div class="input_sug" style="display: none;">
                                            <ul class="list-unstyled" data-type="Suggestion">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn dropdown-toggle group_btn col-md-12 pull-left slct eclps" data-action="SH" data-id="SearchSelectionHolder" data-dest="[data-type=Cats]" type="button" name="Categories">All Categories</button>
                                        <ul class="dropdown-menu group_dropdown" data-type="Cats">
                                            <li class="select">
                                                <a href="javascript:;">All Categories</a>
                                            </li>
                                            <?php if($top_cat){ foreach($top_cat as $num => $cat){ ?>
                                                <li data-type="SearchCategoryItem">
                                                    <a class="has-list" data-action="SH" data-cb="CatActive" data-dest="[data-item=SearchCategory][data-type=<?php echo $cat['cat_name']; ?>]" data-active="open" href="#" class="has-list">
                                                        <?php echo $cat['cat_name']; ?>
                                                    </a>
                                                    <?php
                                                    if($subs = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$cat['id_cat'])){

                                                        foreach($subs as $sub){

                                                            ?>
                                                            <ul class="list" data-item="SearchCategory" style="display: none;" data-type="<?php echo $cat['cat_name']; ?>">
                                                                <li >
                                                                    <a href="<?php echo base_url('ads/cat/'.$sub['cat_slug']) ?>">
                                                                        <?php echo $sub['cat_name'] ?>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        <?php }} ?>
                                                </li>
                                            <?php }} ?>
                                        </ul>
                                    </div>
                                </div>
                                <span class="divider pull-left visible-lg visible-md visible-sm">in</span>
                                <div class="input-group col-md-4 col-sm-4 col-xs-11 pull-left" role="city">
                                    <input class="form-control srch_input" placeholder="Ghana" type="text" name="SearchCity" value="" Title="SearchCity"/>								<span class="input-group-addon dg" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <button class="btn btn-primary srch_btn pull-right" type="submit" name="Find">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div class="region_main" data-type="Loc" style="display: none;">
                                    <div class="arrow pull-right"></div>
                                    <header class="region_head voffset3 vonset3 col-md-12">
                                        <div class="input-group col-md-5 col-sm-4 col-xs-11 pull-left" role="city">
                                            <div class="has-sug clearfix">
                                                <input class="form-control srch_input" placeholder="Ghana" type="text" name="CitySugs" value="" Title="CitySugs"/>											<div class="input_sug" style="display:none;">
                                                    <ul class="list-unstyled" data-type="CSuggestion"></ul>
                                                </div>
                                            </div>
                                            <span class="input-group-addon dg" id="basic-addon1">
                                            <i class="fa fa-map-marker"></i>
                                        </span>
                                        </div>
                                        <a data-action="SH" data-dest="[data-type=Loc]" class="pull-right voffset1" href="#">
                                            <i class="fa fa-close fa-lg"></i>
                                        </a>
                                    </header>
                                    <div class="col-md-12 gray region_top">
                                        <p class="voffset1">Popular City:</p>
                                        <div class="row">
                                            <ul class="list-unstyled col-md-12">
                                                <li>
                                                    <a href="#">
                                                        <b>All Ghana</b>
                                                    </a>
                                                </li>
                                            </ul>
                                            <?php
                                            $top_states = $this->gm->get_ghana_states('6');
                                            if ($top_states) {
                                                foreach ($top_states as $state) {
                                                    $top_cities = $this->gm->get_ghana_cities($state['id_province'],'5');
                                                    if ($top_cities) {
                                                        foreach ($top_cities as $city) {
                                                            ?>
                                                            <ul class="list-unstyled col-xs-6 col-sm-2 col-md-2">
                                                                <li>
                                                                    <a rel="nofollow"
                                                                       href="<?php echo base_url('ads/p/'.$city['p_slug']) ?>">
                                                                        <?php echo $city['p_name']; ?>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <footer class="region_ftr col-md-12 ">
                                    </footer>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- logo and search div end   from here -->
    </div>
</header>
<!-- image -->

<!-- <section class="bg-dark py-3">
    <div class="container bg-dark py-3 shadow-lg text-white">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 text-center">
                            <i class="fa fa-tachometer fa-4x text-info"></i></br>
                            <small class="text-secondary">Mileage (upto)</small>
                            <h5>General Service</h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-wrench fa-4x text-light"></i><br>
                            <small class="text-secondary">Mileage (upto)</small>
                            <h5>Denting/Penting</h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-tag fa-4x text-warning"></i></br>
                            <small class="text-secondary">Mileage (upto)</small>
                            <h5>Accidental Repair</h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-whatsapp fa-4x text-success"></i></br>
                            <small class="text-secondary">Mileage (upto)</small>
                            <h5>Electrical Work</h5>
                        </div>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</section> -->
