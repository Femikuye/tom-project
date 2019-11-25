$body = $('body');
$('body').on('submit','#userLogin',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'api/signin',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").text(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){

          if(res.link !== ""){

            location.href=res.link;

          }else{

            location.href=base_url;

          }          

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      } 

    })

});

$('body').on('submit','#userSignup',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'api/register',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").text(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){

          $('.user_signup').fadeOut('slow');

          $('.card-header').fadeOut('slow');

          $('.card-title').html(res.msg);

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      } 

    })

});

$('body').on('submit','#passwordRequest',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'api/recover_password',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").text(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){

          $('.user_recover').fadeOut('slow');

          $('.card-header').fadeOut('slow');

          $('.card-title').html(res.msg);

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      } 

    })

});

$('body').on('submit','#passwordReset',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'api/reset_password',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").text(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){

          $('.user_recover').fadeOut('slow');

          $('.card-header').fadeOut('slow');

          $('.card-title').html(res.msg);

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      } 

    })

});

$('body').on('submit','#profileUpdate',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'api/update_profile',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").text(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){

          location.reload();

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      }

    })

});

function uploadProfilePhoto(event){

  let fileInput = document.getElementById('profile_pohoto');

  let file = fileInput.files[0];

  let formDetail = new FormData();

  formDetail.append('photo',file);

    $.ajax({

      method : 'POST',

      url : base_url+'api/upload_profile',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        

      },

      'success' : function(res){

        if(res.error){

          $("upload-error").text(res.msg);

        }else if(res.success){

          $('.circle').fadeOut();

          $('.user-profile-img').attr('src',res.link);

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

      }

    })

}

function message_flaher(selector){

  setTimeout("$("+"'"+selector+"'"+").fadeOut('slow')", 3000);

}



$(document).ready(function(){
    $(".dropdown").hover(           

        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");

            $(this).toggleClass('open');       

        },

        function() {

            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");

            $(this).toggleClass('open');       

        }

    );

});

let get_sub_cat = function(val){

    let options = '<option>Select Sub Category</option>';

    $.ajax({

      method : 'GET',

      url : base_url+'api/get_sub_cat',

      data:{'cat':val},

      'beforeSend' : function(){
        $body.addClass("loading");
        $('.sub-cat').css('display','none');
      },
      'success' : function(res){
        if(res.error){
          

        }else if(res.success){
          res.rows.forEach(function(row){
            options += '<option value="'+row.cat_slug+'">'+row.cat_name+'</option>';
          })        
          $body.removeClass("loading");
          $('#sub_cat').html(options);
          $('.sub-cat').css('display','block');
        }
        $("#submit").removeAttr("disabled");

      }   

    })

}

let get_p_city = function(p_name){

  let options = '<option>Select City</option>';

    $.ajax({

      method : 'GET',

      url : base_url+'api/get_p_city',

      data:{'p':p_name},

      'beforeSend' : function(){
        $body.addClass("loading");
      },
      'success' : function(res){
        if(res.error){
        }else if(res.success){
          res.rows.forEach(function(row){
            options += '<option value="'+row.p_name+'">'+row.p_name+'</option>';
          })        

          $('#city').html(options);
          $body.removeClass("loading");
        }
      }  

    })
}

let aid_images = [];

let aid_image_names = [];

let aid_documents = [];

let count = 0;

let name;

$("body").on("change","#aid-images",function(event){

  let tgt = event.target || window.event.srcElement,

        files = tgt.files;

        aid_images.push(files[0]);

        name = files[0].name;

        aid_image_names.push(name);

        count = count + 1;

        ids = aid_image_names.length - 1;

        let output = $(".preview-images-zone");

    // FileReader support

    if (FileReader && files && files.length) {

        let fr = new FileReader();

        fr.onload = function () {

            let html =  '<div it-name="'+name+'" class="preview-image preview-show-' + count + '">' +

                            '<div class="image-cancel" data-na="'+name+'" data-act="new" data-no="' + count + '">x</div>' +

                            '<div class="image-zone"><img id="pro-img-' + count + '" src="' + fr.result + '"></div>' + 

                            '</div>';

            output.append(html);

          }

        fr.readAsDataURL(files[0]);

        // console.log(aid_images);

        // console.log(aid_image_names);

    }

});

let delete_aid_image = function(name){

  let first_img = $('#aid-images-zone div:first-child').attr('it-name');

  $.ajax({

      method : 'POST',

      url : base_url+'api/delete_aid_image',

      data:{'img_uid':name,'f_img':first_img},

      'beforeSend': function(){

      },

      'success' : function(res){

        if(res.error){

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

          $(".circle.loader").fadeOut();

        }else if(res.success){ 

          

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

        $(".circle.loader").fadeOut();

      }

    })

}

$(document).ready(function() { 

  $( ".preview-images-zone" ).sortable({

      cursor: "move",

        forceHelperSize: true,

        delay: 150,

        stop: function() {

            let i = 0;

            var selectedData = new Array();

            $('.preview-images-zone>div').each(function() {

                $(this).attr("id","row-item-"+i);

                selectedData.push($(this).attr("id"));

                i++;

            });

            let old_index = aid_image_names.indexOf($('#row-item-0').attr('it-name'));

            array_move(aid_images, old_index, 0);

            array_move(aid_image_names, old_index, 0);

        },

    });

  $( "#aid-images-zone" ).sortable({

      cursor: "move",

        forceHelperSize: true,

        delay: 150,

        stop: function() {

            var selectedData = new Array();

            $('#aid-images-zone>div').each(function() {

                selectedData.push($(this).attr("it-name"));

            });

            re_arrange_images(selectedData);

        },

    });

    

    $(document).on('click', '.image-cancel', function() {

        let no = $(this).data('no');

        let name = $(this).data('na');

        let action = $(this).data('act');

        if(action === 'new'){

          let ids = aid_image_names.indexOf(name); console.log(ids);

          let count = 0;

          aid_images.splice(ids,1);

          aid_image_names.splice(ids,1);

          $(".preview-image.preview-show-"+no).remove();

          // console.log(aid_images);

          // console.log(aid_image_names);

        }else if(action === 'old'){

          $(".preview-image.preview-show-"+no).remove();

          delete_aid_image(no);

        } 

    });
    $(document).on('click', '.cat-pick', function() {
        let name = $(this).data('name');
        $('.cat-shor-name').val(name);
        $('.group_dropdown').css('display','none');
        $('.slct').text(name);
    });
    $(document).on('click', '.region-pick', function() {
        let region = $(this).data('region');
        $('.region').val(region);
        $('.region_main').css('display','none');
    });
});

function array_move(arr, old_index, new_index) {

    while (old_index < 0) {

        old_index += arr.length;

    }

    while (new_index < 0) {

        new_index += arr.length;

    }

    if (new_index >= arr.length) {

        var k = new_index - arr.length + 1;

        while (k--) {

            arr.push(undefined);

        }

    }

    arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);

    // return arr;

};

$('body').on('submit','#newAd',function(e){
  e.preventDefault();
  let btn_text = $("#submit").text(); 
  var _this = $(this);
    var targetForm = _this.closest('form');
    var formDetail = new FormData(targetForm[0]);
    if(aid_images.length > 0){
      for(let i=0;i<aid_images.length;i++){
        formDetail.append('images['+i+']',aid_images[i]);      
      }
    }else{
      $('.responce').html('<h3 class="text-danger"> Please Upload At least one image</h3>');
      return;
    }
    
    $.ajax({
      method : 'POST',
      url : base_url+'api/add_new_ad',
      data:formDetail,
      cache:false,
      contentType: false,
      processData: false,
      'beforeSend': function(){
        $body.addClass("loading");
        $("#submit").attr("disabled",true);
      },
      'success' : function(res){
        if(res.error){
          $("#submit").html(btn_text);
           $("#submit").attr("disabled",false);
          $(".responce").html('<p class="error text-default ">'+res.msg+'</p>');
          $(".circle.loader").fadeOut();
          $body.removeClass("loading");
        }else if(res.success){
          $(".circle.loader").fadeOut();
          console.log(res.success);
          location.href=res.link;
        }
        $("#submit").removeAttr("disabled");
        message_flaher(".error");
        $(".circle.loader").fadeOut();
        $body.removeClass("loading");
      }
    })
});
function delete_user_aid(id){
  if(confirm("This Ad will be permanently deleted and you wont be able to recover it. To Proceed Click OK to Cancel Clieck CANCEL")){
    $.ajax({
      method : 'POST',
      url : base_url+'api/delete_ad',
      data:{'ad_id':id},     
      'beforeSend': function(){
        $body.addClass('loading');
      },
      'success' : function(res){
        if(res.error){
          $body.removeClass('loading');
        }else if(res.success){
          $body.removeClass('loading');
          $('.user-aid-'+res.uid).remove();
        }
      }
    })
  }
  
}
$('body').on('submit','#editAid',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);;

    $('body').addClass("loading"); 

    $.ajax({

      method : 'POST',

      url : base_url+'api/update_ad',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $('#submit').html(loading); 

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").html(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error text-default ">'+res.msg+'</p>');

          $(".circle.loader").fadeOut();

          $('body').removeClass("loading");

        }else if(res.success){

          $(".circle.loader").fadeOut();

          console.log(res.success);

          location.href=res.link;

        }

        $('body').removeClass("loading");

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

        $(".circle.loader").fadeOut();

      }

    })

});

let publish_advert = function(id){

  let btn_text = $('#aid_publish').text();

  $.ajax({

      method : 'GET',

      url : base_url+'api/publish_aid',

      data:{'aid_id':id},

      'beforeSend': function(){

        $('#aid_publish').html(loading);

        //$("#submit").text("Please Wait");

        $('#aid_publish').attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#aid_publish").html(btn_text);

           $("#aid_publish").attr("disabled",false);

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

          $(".circle.loader").fadeOut();

        }else if(res.success){ 

          location.href=res.link;

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

        $(".circle.loader").fadeOut();

      }

    })

}

function addAidImage(event){

  let fileInput = document.getElementById('add-image');

  let file = fileInput.files[0];

  let formDetail = new FormData();

  formDetail.append('file',file);

  let output = $("#aid-images-zone");

  let aid_id = $('#id-hoder').attr('aid-id');

  formDetail.append('id',aid_id);

  $.ajax({

  method : 'POST',

  url : base_url+'api/add_aid_image',

  data:formDetail,

  cache:false,

  contentType: false,

  processData: false,

  'beforeSend': function(){

          

  },

  'success' : function(res){

    if(res.error){

      $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

      $(".circle.loader").fadeOut();

    }else if(res.success){

      let row = res.row;

      let img_src = base_url+'assets/images/aid-images/'+row.aid_id+'/'+row.image_name;

      let html =  '<div it-name="'+row.img_uid+'" class="preview-image preview-show-'+ row.img_uid + '">' +

                  '<div class="image-cancel" data-act="old" data-no="' + row.img_uid + '">x</div>' +

                  '<div class="image-zone"><img id="pro-img-' + row.img_uid + '" src="' + img_src + '"></div>' + 

                  '</div>';

            output.append(html);

      }

      $("#submit").removeAttr("disabled");

      message_flaher(".error");

      $(".circle.loader").fadeOut();

    }

  })

}

function re_arrange_images(list){

  let id = $('#id-hoder').attr('aid-id');

  let img_list = [];

  for(let i=0;i<list.length;i++){

    img_list.push(list[i]);

  }

  $.ajax({

      method : 'POST',

      url : base_url+'api/arrange_aid_images',

      data:{'list':img_list},

      'success' : function(res){

        if(res.error){

          $(".responce").html('<p class="error bg-fetured ">'+res.msg+'</p>');

        }else if(res.success){ 

          

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

        $(".circle.loader").fadeOut();

      }

    })

}

$('body').on('submit','#contact-aid-poster',function(e){

  e.preventDefault();

  let btn_text = $("#submit").text();

  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'home/contact_advertiser',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

      },

      'success' : function(res){

        if(res.error){

          $("#submit").html(btn_text);

           $("#submit").attr("disabled",false);

          $(".responce").html('<p class="error text-default ">'+res.msg+'</p>');

          $(".circle.loader").fadeOut();

        }else if(res.success){

          $(".circle.loader").fadeOut();

          $(".responce").html('<p class="text-featured ">Message Sent Successfully</p>');

        }

        $("#submit").removeAttr("disabled");

        message_flaher(".error");

        $(".circle.loader").fadeOut();

      }

    })

});

$('body').on('submit','#search-advert',function(e){
  e.preventDefault();
  let btn_text = $("#submit").text();
  $body = $("body");
  let html = '';
  var _this = $(this);

    var targetForm = _this.closest('form');

    var formDetail = new FormData(targetForm[0]);

    $.ajax({

      method : 'POST',

      url : base_url+'home/search_aids',

      data:formDetail,

      cache:false,

      contentType: false,

      processData: false,

      'beforeSend': function(){

        $("#submit").text("Please Wait");

        $("#submit").attr("disabled",true);

        $body.addClass("loading");

      },

      'success' : function(res){

        if(res.error){

          $(".responce").html('<p class="error text-default ">'+res.msg+'</p>');

          $(".circle.loader").fadeOut();

          $('#listings').html('<h2 align="center" class="text-featured">Sorry! No advert available for your search term</h2>');

        }else if(res.success){

          res.rows.forEach(function(row){

            let image = base_url+'assets/images/aid-images/'+row.id_aid+'/'+row.image_name;

            let link = base_url+'aid/'+create_slug(row.id_aid,row.aid_title);

            html += '<div class="col-sm-12">'+ 

                    '<div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">'+

                        '<div class="media">'+

                            '<a class="pull-left" href="'+link+'" target="_parent">'+

                            '<img alt="image" class="img-responsive listing-img" src="'+image+'"></a>'+

                            '<div class="clearfix visible-sm"></div>'+

                            '<div class="media-body fnt-smaller">'+

                                '<h4 class="media-heading">'+

                                  '<a href="'+link+'" target="_parent"><small class="pull-right">'+row.aid_title.substring(0,30)+'</small></a></h4>'+

                                '<p class="hidden-xs">'+row.aid_des.substring(0,80)+'</p><span class="fnt-smaller fnt-lighter fnt-arial">'+currency+row.aid_price+' </span>'+

                            '</div>'+

                        '</div>'+

                    '</div>'+

                  '</div>'

          });

          $('#listings').html(html);

          $body.removeClass("loading");

        }

        $('#listing-head').html(res.rowhead);

        $("#submit").removeAttr("disabled");

        $("#submit").text(btn_text);

        message_flaher(".error");

        $(".circle.loader").fadeOut();

        $body.removeClass("loading");

      }

    })

});

let create_slug = function(id,data){

  let str = data;

  str = str.replace(/^\s+|\s+$/g, ''); // trim

    str = str.toLowerCase();

  

    // remove accents, swap ñ for n, etc

    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";

    var to   = "aaaaeeeeiiiioooouuuunc------";

    for (var i=0, l=from.length ; i<l ; i++) {

        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));

    }



    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars

        .replace(/\s+/g, '-') // collapse whitespace and replace by -

        .replace(/-+/g, '-'); // collapse dashes



    return str+'-'+id;

}

let verify_code = '';
let send_sms = function(){
  //unique_code()
  //https://api.smsglobal.com/http-api.php?action=sendsms&user=testuser&password=secret&from=Test&to=61447100250&text=Hello%20world

  let tel = $('#tel').val();
  let query = {
              'num': tel
              // 'code': verify_code
            };
  $.ajax({
      method : 'POST',
      url : base_url+'api/send_ver_sms',
      data: query,
      'beforeSend' : function(){
        $('body').addClass("loading");
        $('.elem').attr("disabled",true);
      },
      'success' : function(res){
          if(res.success){
            verify_code = res.ver_code;
            $('.input-tel').fadeOut();
            $('.code-holder').fadeIn();
            $('.code-holder').attr('placeholder','Please Enter the Code sent to you');
            $('.btn-sms').attr('onclick','verify()');
            $('.btn-sms').text('Verify Number');
            $('.elem').attr("disabled",false);
            $('.ver-btn-reset').fadeIn();
            $('body').removeClass("loading"); 

          }else if(res.error){

            $('.num-label').html('<small class="text-danger">'+res.msg+'</small>');;

            $('body').removeClass("loading"); 

          };

        $('body').removeClass("loading");  

      }

    })

}
function reset_verification(){
  $('.input-tel').fadeIn();
  $('.code-holder').fadeOut();
  $('.input-tel').val('');
  $('.input-tel').removeAttr('readonly');
  $('.input-tel').attr('placeholder','+233XXXXXXXXX');
  $('.input-tel').attr('id','number');
  //$('.btn-sms').attr('id','send_sms');
  $('.btn-sms').text('Send Me Code');
  $('.ver-btn-reset').fadeOut();
  $('.ver-btn-con').fadeIn();
  $('.profile-num').fadeOut();
}
let verify = function(){
  let code = $('.code-holder').val();
  let tel = $('#tel').val();
     $.ajax({
      method : 'POST',
      url : base_url+'api/update_user_num',
      data: {'num':tel , 'code':code},
      'beforeSend' : function(){
        $('body').addClass("loading");
        $('.elem').attr("disabled",true);
      },
      'success' : function(res){
        if(res.success){
          $('.num-label').html('<small class="text-success">'+res.msg+'</small>');
          $('.code-holder').fadeOut();
          $('.phone-con').append('<h4 class="text-default profile-num">'+$('.input-tel').val()+'</h4>');
          $('.ver-btn-con').fadeOut();
          $('.ver-btn-reset').fadeIn();
          $('#submit').attr('disabled',false);
        }else if(res.fail){
          $('.code-holder').css('border','1px solid red');
        }
        $('body').removeClass("loading");
      }
    });
}

function unique_code() {

 let v =  ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>

    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)

  );

 verify_code = v.substring(0,6);

}



$(document).ready(function() {

  if(verify_code === ''){

    $('.btn-sms').attr('disabled',true);

  }

  $('.input-tel').keyup(

      function()  {

        let num_pattern = /^[\+][2]{1}[3]{1}[3]{1}[0-9]{9}$/g;

        let num_pattern2 = /^[\+][2]{1}[3]{1}[4]{1}[0-9]{10}$/g;

        let num = $(this).val();

        let res = num_pattern2.exec(num);

        if(res !== null ){

          if(res[0] === num){

              $('.btn-sms').attr('disabled',false);

              $('#submit').attr('disabled',true);

          }else{

            $('.btn-sms').attr('disabled',true);

          }

        }else{

          $('.btn-sms').attr('disabled',true);

          $('#submit').attr('disabled',true);

        }

      }

    );

  if($('#tel').val() === ''){

    $('#submit').attr('disabled',true);

  }

});

$(document).on('click', '.select-category-search', function() {

    let id = $(this).data('id');

    let name = $(this).data('name');

    let modal = document.getElementById("categoryModal");

    $('#cat-id-holder').val(id);

    $('.category-holder').val(name);

    modal.style.display = "none";

    console.log(id);

});



$(document).on('click', '.select-province-search', function() {

    let name = $(this).data('name');

    let modal = document.getElementById("provinceModal");

    $('.p-name-holder').val(name);

    modal.style.display = "none";

});

$(document).on('click', '.slide-left', function() {

    $('.slide-left').removeClass('open');

    $('.slide-left').children('ul').css('display','none');

    $($(this)).addClass('open');

    $(this).children('ul').css('display','block');

});

 



