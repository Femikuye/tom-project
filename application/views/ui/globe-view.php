
<style type="text/css">

</style>
<div class="container-fluid main-container">
  <?php $this->load->view('ui/left-bar-view') ?>
  <div class="col-md-10">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="col-md-7">
                <iframe width="460" height="265" src="https://www.youtube.com/embed/cDed5eXmngE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="col-md-4">
                <div style="width: 100%;">
                  <div class="row">
                    <div class="">
                      <img class="" id="img" src="<?php echo base_url('assets/images/site-images/earth-small.png') ?>" width="200" alt="milind kamthe"/>
                    </div>
                  </div>
                </div>
                <div style="width: 100%;">
                  
                </div>
              </div>
              <div class="col-md-1">
               <div class="range">
                <input type="range" name="range" min="-360" max="360" value="7" onchange="rotate(this.value)" oninput="rotate(this.value)" orient="vertical">
                <output id="range">7deg</output>
              </div>
              </div> 
          </div> 
        </div>
  </div>