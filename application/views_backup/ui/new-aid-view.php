<style>

.plastic_select, input[type=url], input[type=text], input[type=tel], input[type=number], input[type=email], input[type=password], select, textarea {
    font-size: 1.25rem;
    line-height: normal;
    padding: .75rem;
    border: 1px solid #C5C5C5;
    border-radius: .25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    color: #555459;
    width: 100%;
    max-width: 100%;
    font-family: Slack-Lato,appleLogo,sans-serif;
    margin: 0 0 .5rem;
    -webkit-transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    -moz-transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    box-shadow: none;
    height: auto;
}
.no_touch .plastic_select:hover,.no_touch input:hover,.no_touch select:hover,.no_touch textarea:hover{border-color:#2780f8}
.focus,.plastic_select:active,.plastic_select:focus,input[type=url]:active,input[type=url]:focus,input[type=text]:active,input[type=text]:focus,input[type=number]:active,input[type=number]:focus,input[type=email]:active,input[type=email]:focus,input[type=password]:active,input[type=password]:focus,select:active,select:focus,textarea:active,textarea:focus{border-color:#2780f8;box-shadow:0 0 7px rgba(39,128,248,.15);outline-offset:0;outline:0}

.large_bottom_margin {
    margin-bottom: 2rem!important;
}
.split_input{display:table;border-spacing:0}



.fs_split{position:absolute;overflow:hidden;width:100%;top:0;bottom:0;left:0;right:0;background-color:#e8e8e8;-webkit-transition:background-color .2s ease-out 0s;-moz-transition:background-color .2s ease-out 0s;transition:background-color .2s ease-out 0s}
.fs_split h1{font-size:2.625rem;line-height:3rem;font-weight:300;margin-bottom:2rem}
.fs_split label{margin-bottom:.5rem}
.fs_split .desc{font-size:1.25rem;color:#9e9ea6;margin-bottom:2rem}
.fs_split .email{color:#555459;font-weight:700}
.fs_split .header_error_message{margin:0 11%;padding:1rem 2rem;background:#fff1e1;border:none;border-left:.5rem solid #ffa940;border-radius:.25rem}
.fs_split .header_error_message h3{margin:0}
.fs_split .error_message{display:none;font-weight:700;color:#ffa940}
.fs_split .error input,.fs_split .error textarea{border:1px solid #ffa940;background:#fff1e1}
.fs_split .error input:focus,.fs_split .error textarea:focus{border-color:#fff1e1;box-shadow:0 0 7px rgba(255,185,100,.15)}
.fs_split .error .error_message{display:inline}
.confirmation_code_span_cell{display:table-cell;font-weight:700;font-size:2rem;text-align:center;padding:0 .5rem;width:2rem}
.confirmation_code_state_message{position:absolute;width:100%;opacity:0;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;transition:opacity .2s}
.confirmation_code_state_message.error,.confirmation_code_state_message.processing,.confirmation_code_state_message.ratelimited{font-size:1.25rem;font-weight:700;line-height:2rem}
.confirmation_code_state_message.processing{color:#3aa3e3}
.confirmation_code_state_message.error,.confirmation_code_state_message.ratelimited{color:#ffa940}
.confirmation_code_state_message ts-icon:before{font-size:2.5rem}
.confirmation_code_state_message svg.ts_icon_spinner{height:2rem;width:2rem}
.confirmation_code_checker{position:relative;height:12rem;text-align:center}
.confirmation_code_checker[data-state=unchecked] .confirmation_code_state_message.unchecked,.confirmation_code_checker[data-state=error] .confirmation_code_state_message.error,.confirmation_code_checker[data-state=processing] .confirmation_code_state_message.processing,.confirmation_code_checker[data-state=ratelimited] .confirmation_code_state_message.ratelimited{opacity:1}
.large_bottom_margin {
    margin-bottom: 2rem !important;
}



</style>
<section class="py-5">
    <div class="header pb-8 pt-5  pt-lg-8 d-flex align-items-center" style="min-height: 120px; background-size: cover; background-position: center top;">
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
            </div>
        </div>
    </div>
    <div class="container mt--7">
        <div class="row">
            <?php //$this->load->view('template/default/user/paths/user-account-left-view') ?>
            <div class="col-xl-12 order-xl-2">
                <div style="border: 0"  class="card shadow">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col-8">
                            <h3 class="mb-0">Create New Advert</h3>
                            <p class="text-default"></p>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <form accept-charset="UTF-8" id="newAd">

                          <fieldset>

                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="aid_title">Ad Title</label>

                                        <input class="form-control" id="aid_title" name="aid_title" type="text">

                                    </div>

                                </div>

                            </div> 

                             <div class="row">

                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="cat">Category</label>

                                        <select onchange="get_sub_cat(this.value)" class="form-control" id="cat" name="cat">

                                            <option value="">Select Category</option>

                                            <?php if($cats = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id','0')){

                                                foreach($cats as $num => $cat){

                                            ?>

                                            <option value="<?php echo $this->my_encrypt->encode($cat['id_cat']); ?>"><?php echo $cat['cat_name'] ?></option>

                                            <?php }} ?>

                                        </select>

                                    </div>

                                </div>

                                 <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div style="display: none;" class="sub-cat form-group">

                                        <label for="sub_cat">Sub Category</label>

                                        <select class="form-control" id="sub_cat" name="sub_cat">

                                            

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row"> 

                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="state">State</label>

                                        <select onchange="get_p_city(this.value)" class="form-control" id="state" name="state">

                                            <option value="">Select State</option>

                                            <?php if($cats = $this->general_model->get_table_rows_by_a_field('ghana_province','p_state_id','0')){

                                                foreach($cats as $num => $p){

                                            ?>

                                            <option value="<?php echo $p['p_name']; ?>"><?php echo $p['p_name'] ?></option>

                                            <?php }} ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="city">City</label>

                                        <select class="form-control" id="city" name="city">

                                            <option value=""></option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="area_editor">Ad Description</label>

                                       <textarea name="des" id="area_editor" class="form-control"> </textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                             <div class="col-md-3 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="price">Price</label>

                                        <input class="form-control" id="price" name="price" type="price">

                                    </div>

                                </div> 
                            </div>
							 <?php if($user->sms_verified==0){?>
                            <div class="row">
                                <div class="col-12">
                                    <p>Enter and verify your phone number. Note: <small class="text-default">This number will be displayed on all the adverts you listed on this platform</small> </p>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                   
                                    <div class="form-group phone-con">
                                        <!-- <label class="num-label" for="tel">Phone Number</label> -->
                                        <input placeholder="+233XXXXXXXXX" class="form-control input-tel"  id="number"  name="tel" type="text" >
                                        <input style="display: none;" type="text" class="form-control code-holder" name="ver-code">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 ver-btn-con">
                                    <!-- <p class="btn-label"><?php //echo $user_profile !== false && $user_profile['user_tel_number'] !== '' ? 'Change Number' : 'Verify Number' ?></p> -->
                                   <!-- <button onclick="send_sms()" class="btn elem btn-success btn-sms" type="button">Send Confirm Code</button> -->
								  
								   <button type="button" class="btn btn-primary" id="send_sms">
									  Verify
									</button>
                                </div>
                              
                            </div>
							 <?php } ?>
                            <div class="row aid-img-con">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <p>Upload Images</p>

                                    <small class="text-default">Only JPG, JPEG, GIF & PNG Were accepted</small>

                                    <div class="preview-images-zone">

                                    </div>

                                </div> 

                                <div class="col-md-12 col-sm-12 col-xs-12"> 

                                    <label class="upload" for="aid-images"><span class="m-span"><i class="fa-x2 fas fa-cloud-upload-alt"></i></span></label>

                                    <input style="display: none;" id="aid-images" name="aid-images" accept="image/*" type="file">

                                </div>

                            </div>

                            <div class="responce">

                                  

                            </div>

                             <div class="row">

                                <div class="col-md-4 col-sm-12 col-xs-12">

                                    <input class="btn btn-lg btn-info btn-block" type="submit" id="submit" value="Create Ad">

                                </div>

                            </div>

                          </fieldset>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
	<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Phone Verification</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <p class="desc">We’ve sent a six-digit confirmation code to <strong>Your mobile <mark><span id="show_number" style=""></span></mark></strong>.Enter it below to confirm your mobile number.</p>
		<p class="alert alert-info" id="info" style="display:none;"></p>
       <label><span class="normal">Your </span>confirmation code</label>
	     <form id="form">
         <div class="" data-multi-input-code="true" style="display: inline-block;">
		 
				
					<input type="text"  class="input" name="digit_1" maxlength="1"  size="3" style="width:62px;" />-
					 <input type="text" class="input" name="digit_2" maxlength="1" size="3" style="width:62px;" />-
					<input type="text"  class="input" name="digit_3" maxlength="1"  size="4" style="width:62px;" />-
					<input type="text"  class="input" name="digit_4" maxlength="1"  size="3" style="width:62px;" />-
					<input type="text"  class="input" name="digit_5" maxlength="1"  size="3" style="width:62px;" />-
					<input type="text"  class="input" name="digit_6" maxlength="1"  size="4" style="width:62px;" />
				
		      
			
			</div>
			</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info"  id="verify">Verify</button>
      </div>

    </div>
  </div>
</div>

</section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
$(document).ready(function(){
  $("#send_sms").click(function(){
	  var number = $("#number").val();
      $("#show_number").text(number);
	 $('#myModal').modal({
		backdrop: 'static',
		keyboard: true, 
		show: true
    });
	   $.ajax({
            url: '<?php echo base_url('Api/send_ver_sms');?>',
            type: 'POST',
			data:{number:number},
            success: function (data) {
               
            }
        });
    });
  });


</script>


<script>
$(document).ready(function($){
$("#number").mask("+233999999999"); 

});
</script>

</script>

<script>
$(document).ready(function(){
  $("#verify").click(function(){
    
	   $.ajax({
            url: '<?php echo base_url('Api/verifySms');?>',
            type: 'post',
			data:$('#form').serialize(),
            success: function (data) {
				$("#info").show();
               $("#info").text(data);
            }
        });
    });
	
	
  });


</script>
<script type="text/javascript">
	$(function(){
		$('.input').keyup(function(e){
			if($(this).val().length==$(this).attr('maxlength'))
				$(this).next(':input').focus()
		})
	})
	</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jodit/jodit.min.css') ?>">