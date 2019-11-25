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

                            <h3 class="mb-0">Update - <?php echo $aid_row['aid_title'] ?></h3>

                            <p class="text-default"></p>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <form accept-charset="UTF-8" id="editAid">

                          <fieldset>

                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="aid_title">Ad Title</label>

                                        <input value="<?php echo $aid_row['aid_title'] ?>" class="form-control" id="aid_title" name="aid_title" type="text">

                                    </div>

                                </div>

                            </div> 

                             <div class="row">

                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="cat">Category</label>

                                        <?php

                $aid_sub_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_row['aid_subcategory_id']);

                $aid_cat = $this->gm->get_a_table_row('aid_categories','id_cat',$aid_row['aid_category_id']);

             ?>

                                        <h4 class="text-default"><?php echo $aid_cat['cat_name']  ?></h4>

                                    </div>

                                </div>

                                 <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="sub-cat form-group">

                                        <label for="sub_cat">Sub Category</label>

                                        <select class="form-control" id="cat" name="cat">

                                            <option value="<?php echo $this->my_encrypt->encode($aid_sub_cat['id_cat']); ?>"><?php echo $aid_sub_cat['cat_name'] ?></option>

                                            <?php if($cats = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id',$aid_cat['id_cat'])){

                                                foreach($cats as $num => $cat){

                                            ?>

                                            <option value="<?php echo $this->my_encrypt->encode($cat['id_cat']); ?>"><?php echo $cat['cat_name'] ?></option>

                                            <?php }} ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="state">State</label>

                                        <select onchange="get_p_city(this.value)" class="form-control" id="state" name="state">

                                            <option value="<?php echo $aid_row['aid_state'] ?>"><?php echo $aid_row['aid_state'] ?></option>

                                            <?php if($states = $this->general_model->get_table_rows_by_a_field('ghana_province','p_state_id','0')){

                                                foreach($states as $num => $p){

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

                                            <option value="<?php echo $aid_row['aid_city'] ?>"><?php echo $aid_row['aid_city'] ?></option>

                                            <?php 

                                                $state_id = $this->general_model->get_a_table_row('ghana_province','p_name',$aid_row['aid_state'])['id_province'];

                                                if($cities = $this->general_model->get_table_rows_by_a_field('ghana_province','p_state_id',$state_id)){

                                                    foreach($cities as $city){ 

                                            ?>

                                            <option value="<?php echo $city['p_name'] ?>"><?php echo $city['p_name'] ?></option>

                                        <?php }} ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="area_editor">Ad Description</label>

                                       <textarea name="des" id="area_editor" class="form-control"> <?php echo $aid_row['aid_des'] ?> </textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                             <div class="col-md-3 col-sm-12 col-xs-12">

                                    <div class="form-group">

                                        <label for="price">Price</label>

                                        <input class="form-control" id="price" name="price" type="price" value="<?php echo $aid_row['aid_price'] ?>">

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p>Current Phone Number. Note: <small class="sms_error text-default">This number will be displayed on all the adverts you listed on this platform</small> </p>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <?php $user_profile = $this->general_model->get_sms_verified($this->user['id_user']); ?>
                                    <div class="form-group phone-con">
                                        <input placeholder="+233XXXXXXXXX" class="form-control input-tel" value="<?php echo $user_profile !== false ? $user_profile->phone : '' ?>" id="number" name="tel" type="tel" <?php echo $user_profile !== false && $user_profile->phone !== '' ? 'readonly="true"' : '' ?>>
                                        <input style="display: none;" type="text" class="form-control code-holder" name="ver-code">
                                    </div>
                                </div>
                                <div style="<?php echo $user_profile !== false && $user_profile->phone !== '' ? 'display:none' : '' ?>" class="col-md-3 col-sm-12 col-xs-12 ver-btn-con">
                                    <!-- <p class="btn-label"><?php //echo $user_profile !== false && $user_profile['user_tel_number'] !== '' ? 'Change Number' : 'Verify Number' ?></p> -->
                                    <button id="send_sms" class="btn elem btn-success btn-sms" type="button">Send Confirm Code</button> 
                                </div>
                                <div style="<?php echo $user_profile !== false && $user_profile->phone !== '' ? '' : 'display:none' ?>" class="col-md-3 col-sm-12 col-xs-12 ver-btn-reset">
                                    <button onclick="reset_verification()" class="btn btn-info" type="button">Change Number</button> 
                                </div>
                            </div>
                            <div class="row aid-img-con">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <p>Upload Images</p>

                                    <small class="text-default">Only JPG, JPEG, GIF & PNG Were accepted</small>

                                    <div id="aid-images-zone">

                                        <?php

                                            if($images){

                                                foreach($images as $image){



                                         ?>

                                        <div it-name="<?php echo $image['img_uid'] ?>" class="preview-image preview-show-<?php echo $image['img_uid'] ?>">

                                            <div class="image-cancel" data-act="old" data-no="<?php echo $image['img_uid'] ?>">x</div>

                                            <?php $img_src = base_url('assets/images/aid-images/'.$aid_row['id_aid'].'/'.$image['image_name']) ?>

                                            <div class="image-zone"><img id="pro-img-<?php echo $image['img_uid'] ?>" src="<?php echo $img_src; ?>"></div>

                                        </div>

                                    <?php }} ?>

                                    </div>

                                </div> 

                                <div class="col-md-2 col-sm-12 col-xs-12"> 

                                    <label class="upload" for="add-image"><span class="m-span"><i class="fa-x2 fas fa-cloud-upload-alt"></i></span></label>

                                    <input style="display: none;" onchange="addAidImage(event)" id="add-image" name="aid-images" accept="image/*" type="file">

                                    <span id="id-hoder" aid-id="<?php echo $this->my_encrypt->encode($aid_row['id_aid']) ?>"></span>
                                    <input type="hidden" value="<?php echo $this->my_encrypt->encode($aid_row['id_aid']) ?>" name="aid-id">
                                </div>

                            </div>

                            <div class="responce">

                                  

                            </div>

                             <div class="row">

                                <div class="col-md-4 col-sm-6 col-xs-12">

                                    <input class="btn btn-lg bg-featured btn-block" type="submit" id="submit" value="Update Aid">

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
    $body = $('body');
$(document).ready(function(){
  $("#send_sms").click(function(){
      var number = $("#number").val(); 
       $.ajax({
            url: '<?php echo base_url('Api/send_ver_sms');?>',
            type: 'POST',
            data:{number:number},
            beforeSend: function(){
                 $body.addClass("loading");
            },
            success: function (res) {
               if(res.success){
                $("#show_number").text(number);
                 $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true, 
                    show: true
                });
               }else if(res.error){
                $('.sms_error').text('There Was an error!');
               }
               $body.removeClass("loading");
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
            beforeSend: function(){
                $body.addClass("loading");
            },
            success: function (data) {
                $("#info").show();
               $("#info").text(data);
               $('#myModal').modal('hide');
            $('.sms-ver-con').html('<div class="col-md-12"><h3 class="text-success"> SMS Verification Successful</h3></div>');
            $('#submit').attr('disabled',false);
            $('.ver-btn-con').css('display','none');
            $('.ver-btn-reset').css('display','block');
            $('.input-tel').attr('readonly',true); 
            $('.sms_error').text("Number Verified");
            $('.sms_error').css('color', '#09b373');            
            $body.removeClass("loading");        
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