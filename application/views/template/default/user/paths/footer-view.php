<footer class="row footer">
    <div class="frame_wrap hidden-print container">
        <h3 class="sub-head">Follow Tormami</h3>
        <ul class="ft-social nav nav-pills">
            <li>
                <a class="btn-sm" target="_blank" rel="nofollow" href="https://www.facebook.com/tormami">
                   <img style="height: 40px;" class="img-responsive footer-social" src="<?php echo base_url('assets/images/site-images/social/facebook.jpg') ?>">  <!-- <i class="fa fa-facebook-f align fb"></i> -->
                </a>
            </li>
            <li>
                <a class="btn-sm" target="_blank" rel="nofollow" href="https://twitter.com/tormamigh">
                    <img style="height: 40px;" class="img-responsive footer-social" src="<?php echo base_url('assets/images/site-images/social/twitter.jpg') ?>"> <!-- <i class="fa fa-twitter align tweet"></i>  -->
                </a>
            </li>
        </ul>
        <nav class="ftr_nav">
            <ul class="ftr_nm col-xs-12">
                <?php if($pages = $this->general_model->get_table_rows_by_a_field('pages')){
                    foreach($pages as $page){
                        ?>
                        <li>
                            <a href="<?php echo base_url('page/'.$page['page_slug']) ?>">
                                <?php echo $page['page_name'] ?>
                            </a>
                        </li>
                <?php }} ?>
                <li>
                    <a href="<?php echo base_url('register') ?>">Register Now</a>
                </li>
                <li>
                    <a href="<?php echo base_url('login') ?>">Login</a>
                </li>
                <li>
                    <a href="<?php echo base_url('account/post-ad') ?>">Post Ad</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
<!-- <section class="disclaimer bg-light border">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 py-2">
                <small>
                   Disclaimer: Element Limited is only an intermediary offering its platform to facilitate the transactions between Seller and Customer/Buyer/User and is not and cannot be a party to or control in any manner any transactions between the Seller and the Customer/Buyer/User. All the offers and discounts on this Website have been extended by various Builder(s)/Developer(s) who have advertised their products. Element is only communicating the offers and not selling or rendering any of those products or services. It neither warrants nor is it making any representations with respect to offer(s) made on the site. Element Limited shall neither be responsible nor liable to mediate or resolve any disputes or disagreements between the Customer/Buyer/User and the Seller and both Seller and Customer/Buyer/User shall settle all such disputes without involving Element Limited in any manner.
               </small>
            </div>
        </div>
    </div>
</section> -->
<section class="copyright border">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 pt-3">
                <p class="text-muted">© <?php echo @date('Y',time()). " ".$site['title'] ?> </p>
            </div>
        </div>
    </div>
</section>
<div class="loading-modal"><!-- Place at bottom of page --></div>
<script type="text/javascript">
        let base_url = '<?php echo base_url(); ?>'
</script>
<script src="<?php echo base_url('assets/js/jquery.3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-4.min.js') ?>"></script>  
<script   src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('assets/js/actions.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/iscroll.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/helper.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/lib.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/user/bootstrap.js') ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ ?>
<script src="<?php echo base_url('assets/js/'.$script) ?>" type="text/javascript"></script>
<?php } } ?>
</body>
</html>