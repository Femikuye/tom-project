<section class="footers  pt-5 pb-3">
   <div class="container pt-5">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-4 footers-one">
                <div class="footers-info mt-3">
                    <p>Share Us On Social Media</p>
                </div>
                <div class="social-icons"> 
                <a href="https://www.facebook.com/tormami"><!--<i id="social-fb" class="fab fa-facebook-square fa-2x social"></i>-->
                    <img style="width:45px; height:45px" alt="Facebook Icon" class="img img-responsive" src="<?php echo base_url('assets/images/site-images/facebook-ico.jpg') ?>">
                </a>
                <a href="https://twitter.com/tormamigh"><!--<i id="social-tw" class="fab fa-twitter-square fa-2x social"></i>-->
                    <img style="width:45px; height:45px" alt="twitter Icon" class="img img-responsive" src="<?php echo base_url('assets/images/site-images/twitter-ico.jpg') ?>">
                </a>
            </div>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-2 footers-two">
                <h5>Our Pages </h5>
                <ul class="list-unstyled">
                <?php if($pages = $this->general_model->get_table_rows_by_a_field('pages')){
                    foreach($pages as $page){
                ?>
                 <li><a href="<?php echo base_url('page/'.$page['page_slug']) ?>"><?php echo $page['page_name'] ?></a></li>
             <?php }} ?>
                </ul>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-3 footers-three">
                <h5>Links </h5>
                <ul class="list-unstyled">
                 <li><a href="<?php echo base_url('register') ?>">Register Now</a></li>
                 <li><a href="<?php echo base_url('login') ?>">Login</a></li>
                 <li><a href="<?php echo base_url('account/post-ad') ?>">Post Ad</a></li>
                </ul>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-3 footers-four">
                <h5>Popular Aids</h5>
                <ul class="list-unstyled">
                 <!-- <li><a href="#!">News</a></li> -->
                </ul>
            </div>
       </div>
   </div>
</section>
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
<?php if(isset($scripts)){ foreach($scripts as $script){ ?>
<script src="<?php echo base_url('assets/js/'.$script) ?>" type="text/javascript"></script>
<?php } } ?>
</body>
</html>