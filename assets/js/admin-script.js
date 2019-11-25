$(function () {
  	$('.navbar-toggle-sidebar').click(function () {
  		$('.navbar-nav').toggleClass('slide-in');
  		$('.side-body').toggleClass('body-slide-in');
  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
  	});

  	$('#search-trigger').click(function () {
  		$('.navbar-nav').removeClass('slide-in');
  		$('.side-body').removeClass('body-slide-in');
  		$('.search-input').focus();
  	});
  });
$('body').on('submit','#settingForm',function(e){
  e.preventDefault();
  let submit = $(".submit");
  let sbmText = submit.text();
  $('.success').text('');
  $('.error').text('');
  var _this = $(this);
    var targetForm = _this.closest('form');
    var formDetail = new FormData(targetForm[0]);
    $.ajax({
      method : 'POST',
      url : base_url+'admin/adminapi/site_setting',
      data:formDetail,
      cache:false,
      contentType: false,
      processData: false,
      'beforeSend': function(){
        submit.text("Please Wait");
        submit.attr("disabled",true);
      },
      'success' : function(res){
        if(res.error){
          submit.text(sbmText);
          submit.attr("disabled",false);
          $(".error").text(res.msg);
        }else if(res.success){
            $('.success').text('Updated Successful, will redirect in seconds');
           setTimeout(function(){location.href=base_url+'admin'},5000); 
        }
        submit.removeAttr("disabled");
      }
    })
});
$('body').on('submit','#admin-login',function(e){
  e.preventDefault();
  var _this = $(this);
    var targetForm = _this.closest('form');
    var formDetail = new FormData(targetForm[0]);
    formDetail.append('login' , _this.attr('form-type'));
    $.ajax({
      method : 'POST',
      url : base_url+'admin/signin',
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
          $("#submit").text("Login Admin");
           $("#submit").attr("disabled",false);
          $(".error").text(res.msg);
        }else if(res.success){
          window.location.href=res.link;
        }
        $("#submit").removeAttr("disabled");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text("Login Admin");
      }      
    })
});
$('body').on('submit','#addCategory',function(e){
  e.preventDefault();
  var _this = $(this);
    let targetForm = _this.closest('form');
    let formDetail = new FormData(targetForm[0]);
    let rows = '';
    $.ajax({
      method : 'POST',
      url : base_url+'admin/adminapi/add_category',
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
          $("#submit").text("Login Admin");
           $("#submit").attr("disabled",false);
          $(".error").text(res.msg);
        }else if(res.success){
         location.reload();
        }
        $("#submit").removeAttr("disabled");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text("Login Admin");
      }      
    })
});
let editCategory = function(id){
  $.ajax({
      method : 'GET',
      url : base_url+'admin/adminapi/add_category',
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
          $("#submit").text("Login Admin");
           $("#submit").attr("disabled",false);
          $(".error").text(res.msg);
        }else if(res.success){
         location.reload();
        }
        $("#submit").removeAttr("disabled");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text("Login Admin");
      }      
    })
}
let deleteCategory = function(id){
    $.ajax({
      method : 'GET',
      url : base_url+'admin/adminapi/delete_category',
      data:{'id':id},
      'success' : function(res){
        if(res.error){
          $(".error").text(res.msg);
        }else if(res.success){
         location.reload();
        }
      } 
    })
}
$('body').on('submit','#addPage',function(e){
  e.preventDefault();
  var _this = $(this);
  let btn_txt = $("#submit").text();
    let targetForm = _this.closest('form');
    let formDetail = new FormData(targetForm[0]);
    let rows = '';
    $.ajax({
      method : 'POST',
      url : base_url+'admin/adminapi/add_page',
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
          $("#submit").text(btn_txt);
           $("#submit").attr("disabled",false);
          $(".responce").text('<p class="error bg-fetured ">'+res.msg+'</p>');
        }else if(res.success){
         location.href=base_url+'admin/pages';
        }
        $("#submit").removeAttr("disabled");
        message_flaher(".error");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text(btn_txt);
      }      
    })
});
$('body').on('submit','#addAdmin',function(e){
  e.preventDefault();
  var _this = $(this);
  let btn_txt = $("#submit").text();
    let targetForm = _this.closest('form');
    let formDetail = new FormData(targetForm[0]);
    let rows = '';
    $.ajax({
      method : 'POST',
      url : base_url+'admin/adminapi/add_admin',
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
          $("#submit").text(btn_txt);
           $("#submit").attr("disabled",false);
          $(".responce").text('<p class="error bg-fetured ">'+res.msg+'</p>');
        }else if(res.success){
         location.href=base_url+'admin/pages';
        }
        $("#submit").removeAttr("disabled");
        message_flaher(".error");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text(btn_txt);
      }      
    })
});
$('body').on('submit','#updatePage',function(e){
  e.preventDefault();
  var _this = $(this);
  let btn_txt = $("#submit").text();
    let targetForm = _this.closest('form');
    let formDetail = new FormData(targetForm[0]);
    let rows = '';
    $.ajax({
      method : 'POST',
      url : base_url+'admin/adminapi/update_page',
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
          $("#submit").text(btn_txt);
           $("#submit").attr("disabled",false);
          $(".responce").text('<p class="error bg-fetured ">'+res.msg+'</p>');
        }else if(res.success){
         location.href=base_url+'admin/pages';
        }
        $("#submit").removeAttr("disabled");
        message_flaher(".error");
      },
      'afterSend' : function(res){
        $("#submit").attr("disabled",false);
        $("#submit").text(btn_txt);
      }      
    })
});
let deletePage = function(id){
  if(confirm("Do you realy want to delete this page?")){
    $.ajax({
      method : 'GET',
      url : base_url+'admin/adminapi/delete_page',
      data:{'pid':id},
      'beforeSend' : function(){
      },
      'success' : function(res){
        if(res.error){
          
        }else if(res.success){
          location.reload();
        }
      }   
    })
  } 
}
function message_flaher(selector){
  setTimeout("$("+"'"+selector+"'"+").fadeOut('slow')", 1000);
}