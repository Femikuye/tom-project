<div class="col-md-10 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		Site Overview
	</div>
	<div class="panel-body">
		<div class="row">
			<?php $icon = isset($site['icon']) && !is_null($site['icon']) ? base_url().'assets/images/site-images/'.$site['icon'] : "" ;
            ?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                            <img src="<?php echo $icon ?>">
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                            <h4>Total Website Adverts</h4>
                            <h2 style="font-size: 15px;"><?php  echo count($this->general_model->get_table_rows_by_a_field('aids','published','1')) ?></h2>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                    <div class="inforide">
                      <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                            <img src="<?php echo $icon ?>">
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                            <h4>Total Website Users</h4>
                            <h2 style="font-size: 15px;"><?php  echo count($this->general_model->get_table_rows_by_a_field('users')) ?></h2>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                    <div class="inforide">
                      <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                            <img src="<?php echo $icon ?>">
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                            <h4>Total Adverts Views</h4>
                            <h2 style="font-size: 15px;">
                            	<?php 
                            		$adverts = $this->general_model->get_table_rows_by_a_field('aids','published','1');
                            		$ad_v_total = array();
                            		foreach($adverts as $ad){
                            			array_push($ad_v_total, $ad['aid_views']);
                            		} 
                            		echo array_sum($ad_v_total);
                             	?>                             	
                             </h2>
                        </div>
                      </div>
                    </div>
                </div>
		</div>
	</div>
  </div>
</div>