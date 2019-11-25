var Elems = {

	//Data Type

	dty : 'data-type',

	//Onchange Other Element

	onc : 'data-onchange',

	//Onchnage Data to Show

	dsh : 'data-show',

	//Request Attribute

	ra : 'data-request',

	//ID Attribute

	ai : 'data-id',

	//Name Attribute

	an : 'data-name',

	//Parent Attribute

	pi : 'data-parent-id',

	//Parent Name Attribute

	pn : 'data-parent',

	//Brand Attribute

	bi : 'data-brand',

	//Model Attribute

	mi : 'data-model',

	//Action Attribute

	aca : 'data-action',

	//Destination Attribute

	dta : 'data-dest',				

	//Item Source

	src : 'data-src',

	//Data Active State

	dac : 'data-active',

	//CallBack

	clb : 'data-cb',

	//Change Element

	ce : '[data-type=change-elm]',

	//Popup Containter

	cpc	: '[data-type=popup]',

	//Favorite ads Element

	fav : '[data-type=fav]',

	//Remove Favorites Element

	rf : '[data-type=rfav]',

	//Close Attribute

	cls : 'data-close',

	//Selected Attribute

	sl : 'data-selected',

	//Popup HTML

	PCHTMLA : '<div class="modal_bg" data-type="overlay" data-action="CB" data-cb="POPUP_CLOSE"></div>',

	PCHTMLB : '<div class="modal_bg" data-type="overlay"></div>',

	PCBUTTON : '<button type="button" class="close" title="close" data-action="CB" data-cb="POPUP_CLOSE"><span class="fa fa-close fa-lg"></span></button>',

	FITEM : '<li data-parent-id="{0}"><div class="thumbnail_container nm"><div class="thumbnail thum_img fp"><a href="{1}">{2}</a><a href="" class="close_thum" data-id="{0}" data-type="fav" data-active="active"><i class="fa fa-close"></i></a></div></div><script type="text/javascript">$(\'[data-parent-id={0}]\').popover({title: \'{3}\',content: \'<p>{4}<\/p>\'+\'<strong>{5}<\/strong>\',placement: \'top\',html: true,container: \'body\'}).on(\'mouseenter\',function(){var E = $(this);E.popover(\'show\');E.siblings(\'.popover\').on(\'mouseleave\',function(){E.popover(\'hide\');});}).on(\'mouseleave\',function(){var E = $(this);setTimeout(function(){if(!$(\'.popover:hover\').length){E.popover(\'hide\');}}, 100);});</script></li>',

	//Favorite Ads Container

	FAVP : '[data-type=faves]',

	//Fav Items Tooltip

	FTHTML : '<div class="popover fade top in" role="tooltip" data-id="tt-{0}"><div class="arrow" style="left: 50%;"></div><h3 class="popover-title">{1}</h3><div class="popover-content"><p>{2}</p><strong>{3}</strong></div></div>',

	//Favorites Items

	fi : '[data-type=faves-items]'

};

var AutoChange = true;

var RequestData = {};

//Global Form Validation

var EmailRegx = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;

var DigitRegx = /^\d+$/;

var SpecialRegx = /^[a-zA-Z\-0-9\.]+$/;

var RQUIREDERRORHTML = '<ul data-field="{0}" class="list-unstyled voffset1"><li class="error-text">{1}</li></ul>';

var ClickAble = true;

var Deleted = '';

var I = 0;

var DefaultData = {};

var DefaultValidation = {};

var SuggestionWorking = false;

var SuggestionLastQuery = '';

var SuggestionActiveClass = 'active';

var Suggestions = $('[data-type=Suggestion]');

var CitySugestion = '';

$(function(){

	//Stop All Form Fields Data

	StoreSelect();



	//Home Page PanelCategory

	$('body').on('click','[data-type=PanelCategoryName]',function(){

		var E = $(this);

		var Active = E.attr(Elems.dac);

		var Dest = $(E.attr(Elems.dta));

		$('[data-item=CategoryPanel]').not(Dest).hide();

		$('[data-type=PanelCategoryName]').not(E).removeClass(Active)

		Dest.toggle();

		E.toggleClass(Active);		

	});

	$('body').on('click','[data-type=CSuggestionLink]',function(){

		document.location = $(this).attr('data-dest');

	});	

	//City Search Suggestion

	$('body').on('keyup','input[name=CitySugs]',function(){

		var CSuggestions = $('[data-type=CSuggestion]');

		CSuggestions.parent().show();

		var E = $(this);

		var Query = E.val();

		if(Clean(Query)){

			if(Query != CitySugestion){

				CitySugestion = Query;

				Query  = Base64.encode(Query);

				Request(URI('json/suggestc/'+Query),function(Data){

					var HTML = '';

					if(Count(Data.items) > 0){

						for(var I in Data.items){

							var Item = Data.items[I];

							HTML += '<li data-type="CSuggestionLink" data-dest="{0}">{1}</li>'.SPrintF(I,Item);

						}

					}else{

						CSuggestions.parent().hide();

					}

					CSuggestions.html(HTML);

				});

			}

		}

	});

	$('body').on('focus','input[name=SearchCity]',function(){

		$('[data-type=Loc]').show();

		$('[name=CitySugs]').focus();

	});



	//Slider

	$(window).on('scroll resize',document,function(){
		//ApplySlider();
	});

	ApplySlider();



	//Model Brand Description View More

	var MB = $('[data-type=MBD]');

	if(MB.length > 0){

		var MBD = MB.html();

		var Less = MBD.substr(0,90)+'... ';

		$('body').on('click','a[data-type=MBDS]',function(){

			var Elm = $(this);

			var Text = Elm.html();

			if(Text == 'Show More'){

				Elm.html('Less');

				MB.html(MBD);

			}else{

				Elm.html('Show More');

				MB.html(Less);

			}

		});

		$('a[data-type=MBDS]').click();

	}



	//Focus On Form First Field

	$('.container input[type=text]').first().focus();



	//Lazy Load Action

	$(window).on('scroll resize',document,function(){

		Center($('[data-container=ssp]:visible'));

		$('img').OnView(function(){$(this).SetSrc('ds');});

	});

	$('img').OnView(function(){$(this).SetSrc('ds');});



	//Input Boxes Active State

	$('body').on('focus','input[type=text],input[type=password],select,textarea',function(){

		$(this).parent().addClass('focus');

	});

	$('body').on('focusout','input[type=text],input[type=password],select,textarea',function(){

		$('input[type=text],input[type=password],select,textarea').parent().removeClass('focus');

	});



	//Anchor For Special Action

	$('body').on('click change','*',function(){

		Element = $(this);

		var TAG = this.tagName;

		var HREF = Element.attr('href');

		var Action = Element.attr(Elems.aca);

		var AC = $(this).attr(Elems.dac);

		var Dest = Element.attr(Elems.dta);

		var CallBack = Element.attr(Elems.clb);

		var REQ = Element.attr(Elems.ra);

		if(typeof Action != 'undefined' && Action != ''){

			if((typeof HREF != 'undefined' && HREF != '') || (typeof REQ != 'undefined' && REQ != '')){

				if(ClickAble){

					//ClickAble = false;

					Request(HREF ? HREF : REQ+Element.val(),function(Data){

						if(Action == 'VOID'){}

						if(Action == 'CB'){}

						if(typeof CallBack != 'undefined'){eval(CallBack+'(Data,Element);');}

						if(Action == 'REMOVE'){

							if(Dest == 'self'){Element.remove();}

							else{$(Dest).remove();}

						}

					});

					if(Action == 'SH'){

						if(!$(Dest).is(':animated')){$(Dest).toggle();}

					}

				}else{

					Fail('An request is in process, please wait.');

					if(typeof CallBack != 'undefined'){eval(CallBack+'(Element);');}

				}

			}else{

				var Src = Element.attr(Elems.src);

				switch(Action){

					default:

						break;

					case 'REMOVE':

						if(Dest == 'self'){Element.remove();}

						else{$(Dest).remove();}

						break;

					case 'CLOSE':

						$(Dest).hide();

						break;

					case 'SH':		

						if(!$(Dest).is(':animated')){$(Dest).toggle();}

						break;

					case 'TSH':

						var DDT = $(Dest).attr(Elems.dty);

						var DET = Element.attr(Elems.dty);

						//Resetting

						if($(Dest).is(':hidden')){

							$('body').find('[{0}={1}]'.SPrintF(Elems.dty,DDT)).hide();

							$('body').find('[{0}={1}]'.SPrintF(Elems.dty,DET)).removeClass(AC);

						}

						$(Dest).toggle();

						break;

					case 'SINGLEAPPEND':

						if($(Dest).html() == '')$(Dest).html('').append(eval(Src));

						$(Dest).slideToggle(100);

						break;

					case 'APPEND':						

						$(Dest).append(eval(Src)).slideDown(100);

						break;

					case 'DTC':

					case 'CB':

					case 'VOID':

						break;

				}

				if(CallBack && typeof CallBack != 'undefined'){eval(CallBack+'(Element);');}

			}

			if(AC){Element.toggleClass(AC,'');}

			var Class = Element.attr('data-class');

			if(Class){$(Dest).toggleClass(Class);}

			return TAG == 'A' ? false : true;

		}

	});



	//Popup Action

	$('body').on('click',Elems.cpc,function(){

		var E = $(this);

		var Title = E.attr('title');

		var Inner = eval(E.attr(Elems.src));

		var ID = E.attr(Elems.ai);

		var CallBack = E.attr(Elems.clb);

		var CLS = E.attr(Elems.cls);

		$('body').addClass('modal-open');

		CLS = typeof CLS == 'undefined' || CLS == false ? false : true;

		var Elem = $('div['+Elems.ai+'='+ID+']');

		if(Elem.length == 0){

			var HTML  = Elems.PHTML.SPrintF(ID,CLS ? Elems.PCHTMLB : Elems.PCHTMLA,Title,CLS ? '' : Elems.PCBUTTON,Inner);

			$('body').children().first().before(HTML);

			Elem = $('div['+Elems.ai+'='+ID+']');

		}else{

			Elem.show();

		}

		Center(Elem);

		StoreSelect();

		if(typeof CallBack != 'undefined')eval(CallBack);

		return false;

	});



	//Form Validation

	var FElems = 'input,select,textarea';

	$('body').on('focusout',FElems,function(){

		VField(this);

	});

	$('body').on('focusout change','select',function(){VField(this);});

	$('body').on('keyup keydown keypress change','input.error,select.error,textarea.error',function(){VField(this);});

	$('body').on('submit','form[validation=true]',function(){



		var Form = $(this);

		Form.addClass('NOK');

		Form.find(FElems).each(function(I,E){VField(E);});

		var Errors = Form.find('input.error,select.error,textarea.error');

		if(Errors.length == 0){

			Form.removeClass('NOK');

			var CallBack = Form.attr(Elems.clb);

			Form.find('[type=submit]').each(function(I,E){

				$(E).attr('readonly','true');

			});

			if(typeof CallBack != 'undefined'){

				eval(CallBack+'();');

			}else{

				return true;

			}

		}else{

			var First = Errors.first();

			if(First.attr('type') == 'hidden') First = First.parent();

			$('body').animate({scrollTop: (First.offset().top - 50)});

			First.focus();

			Undo();

			return false;

		}

		return false;

	});

	

	//Action Ajax Form

	$('body').on('submit','form[data-submit=ajx]',function(){

		var Form = $(this);

		if(!Form.hasClass('NOK')){

			var Options = {

				dataType : 'json',

				beforeSend : function(){

					var Func = Form.attr('data-bef');

					if(typeof Func != 'undefined')eval(Func+'(Form)');

				},

				complete : function(){

					var Func = Form.attr('data-cpl');

					if(typeof Func != 'undefined')eval(Func);

				},

				success : function(E,M,D){

					var Func = Form.attr('data-success');

					var JSON = $.parseJSON(D.responseText);

					if(typeof Func != 'undefined')eval(Func+'(JSON,Form)');

					Undo();

				}

			};

			var Submit = Form.find('button[type=submit]');

			Submit.attr('disabled','disabled');

			Submit.html('<img src="/resources/images/user/loader.gif" height="20" width="20" style="max-width: 20px !important;" />');

			Form.ajaxSubmit(Options);

			return false;

		}

	});

	

	//Delete Button Action

	$('body').on('click','*[data-button=delete]',function(){

		if(ClickAble){

			Deleted = $(this);

			$(this).before('<img src="/resources/images/user/loader.gif" height="20" width="20" class="{0}" style="max-width: 20px !important;" />'.SPrintF(Deleted.attr('class')));

			$(this).hide();

		}

	});



	//Global On Chnage IF Attribute Value == Elems.onc attribute then show data-show

	$('body').on('change click focusout','*',function(){

		var ONC = $(this).attr(Elems.onc);

		var DSH = $(this).attr(Elems.dsh);

		if(typeof ONC != 'undefined'){

			if($(this).val() == ONC || $(this).children('option:selected').text() == ONC)$(DSH).show();

			else $(DSH).hide();

		}

	});



	//Price Validation

	Price('input[data-price=true]');



	//Changer On Change Element

	$('body').on('change',Elems.ce,function(){

		var Element = $(this);

		var Name = Text(Element.attr('name'));

		var Val = Element.val();

		if(Val != ''){

			Request(Element.attr(Elems.ra)+Val,function(Data){

	

				if(Count(Data.items) > 0){

					AppendRequest(Element.attr(Elems.dta),Data.items,'<option value="{0}"{2}>{1}</option>');

				}else{

					$($(Element.attr(Elems.dta)).attr(Elems.pn)).hide().find('select').html('');

				}

				if(AutoChange)$(Element.attr(Elems.dta)).change();

			});

		}else{

			$($(Element.attr(Elems.dta)).attr(Elems.pn)).hide().find('select').html('');

		}

	});

	

	//Check Boxes Action

	$('body').on('change','[name=chkall]',function(){

		var E = $(this);

		var DID = E.attr('data-id');

		if(E.is(':checked'))CheckAll(E);

		else UnCheckAll(E);

	});

	

	//Search Submition

	$('[data-type=SearchForm]').on('submit',function(){

		var E = $(this);

		var Search = $('[name=BoleeSearch]').val();

		/*if(Clean(Search) == ''){

			alert('Please enter a valid search');

		}else{*/

			document.location = E.attr('action')+'/'+encodeURIComponent(Search.toLowerCase());

		//}

		return false;

	});

	$('body').on('click','[data-type=SuggestionLink]',function(){

		var E = $(this);

		document.location = E.attr(Elems.dta);

	});



	//Search Suggestion

	$(document).mouseup(function(Event){

		var Container = Suggestions.parent();

		if(!Container.is(Event.target) && Container.has(Event.target).length === 0){

			Container.hide();

		}

	});

	

	$('body').on('keyup focus','input[name=BoleeSearch]',function(Event){

		var E = $(this);

		var Query = E.val();

		Suggestions.parent().show();

		//Up and Down Function

		if(Suggestions.children().length > 0){

			var Key = Event.which;

			var Child = Suggestions.children();

			var CurrentActive = Suggestions.find('li.'+SuggestionActiveClass);

			if(Key == 38){

				//Up

				//E[0].selectionEnd = Query.length;

				if(CurrentActive.length == 0){

					ActiveSuggestion(Child.first(),Suggestions);

				}else if(CurrentActive.is(':first-child')){

					ActiveSuggestion(Child.last(),Suggestions);

				}else{

					ActiveSuggestion(CurrentActive.prev(),Suggestions);

				}

				return false;

			}else if(Key == 40){

				//Down

				//E[0].setSelectionRange(Query.length,Query.length);

				if(CurrentActive.length == 0){

					ActiveSuggestion(Child.first(),Suggestions);

				}else if(CurrentActive.is(':last-child')){

					ActiveSuggestion(Child.first(),Suggestions);

				}else{

					ActiveSuggestion(CurrentActive.next(),Suggestions);

				}

				return false;

			}

		}

		if(!SuggestionWorking){

			SuggestionWorking = true;

			if(Query != ''){

				if(Query != SuggestionLastQuery){

					SuggestionLastQuery = Query;

					Query  = Base64.encode(Query);

					var Req = Request(URI('json/suggest/{0}?t={1}'.SPrintF(Query,Math.random())),function(Data){

						if(Count(Data.items) > 0){

							var HTML = '';

							for(var I in Data.items){

								var Item = Data.items[I];

								HTML += '<li data-type="SuggestionLink" data-dest="{0}" data-text="{1}">{2}</li>'.SPrintF(I,Item.K,Item.T);

							}

							HTML += '';

							Suggestions.html(HTML);

						}else{

							Suggestions.html('');

							Suggestions.parent().hide();

						}

						SuggestionWorking = false;

					});

					Req.done(function(){

						SuggestionWorking = false;

					});

					Rqst.fail(function(){

						SuggestionWorking = false;

					});

				}else{

					Suggestions.parent().show();

				}

				SuggestionWorking = false;

			}else{

				Suggestions.html('');

				Suggestions.parent().hide();

				SuggestionWorking = false;

			}

		}

	});



	//Favorites Ads Action

	$('body').on('click',Elems.fav,function(){

		var E = $(this);

		var ID = E.attr(Elems.ai);

		var AC = E.attr(Elems.dac);

		if(ClickAble){

			ClickAble = false;

			Request(URI('ad/favorites?t='+(Math.random())),function(Data){

				if(Data.status == 0){

					$(Elems.fav+'[data-id='+ID+']').removeClass(AC);

					var RElem = $(Elems.FAVP).find('li['+Elems.pi+'="'+ID+'"]');

					var Width = RElem.width();

					RElem.remove();

					$('[role=tooltip]').remove();

					//$(Elems.fi).width(Width);

					if($('[data-type=FavContainer]').find(Elems.fav).length == 0){

						$('[data-type=FavContainer]').hide();

					}

				}else{

					var Width = FAVADD(Data.items);

					//$(Elems.fi).css({width: '+='+ Width});

					E.addClass(AC);

					$('[data-type=FavContainer]').show();

					Lazy();

				}

			},{AID:ID});

		}

		$(Elems.FAVP).show();

		return false;

	});

	Request(URI('json/fav/g'),function(Data){

		if(Data.c > 0){

			var HTML = '';

			var Width = 0;

			for(I in Data.items){

				var J = Data.items[I];

				Width += FAVADD(J);

			}

			//$(Elems.fi).width(Width);

			$('[data-type=FavContainer]').show();

		}

	});



	//Checkbox Radio

	$('body').ajaxComplete(function() {

		ChangeInputBoxes();

	});

	ChangeInputBoxes();

	

	//Listing Link

	$('body').on('click','li[data-type=ListItem]',function(){

		document.location = $(this).find('h2.ld_title').parent('a').attr('href');

	});

});

window.onload = function(){

	ChangeInputBoxes();

}

/*document.addEventListener('touchmove',function(Event){

	Event.preventDefault();

},false);*/

function ChangeInputBoxes(){

	/*$('body').find('input[type=checkbox]').each(function(I,E){

		E = $(E);

		if(!E.hasClass('checkboxChanged')){

			E.addClass('checkboxChanged').addClass('f_left').after('<div class="checkboxContainer f_left"></div>');

		}

	});

	$('body').find('input[type=radio]').each(function(I,E){

		E = $(E);

		if(!E.hasClass('radioChanged')){

			E.addClass('radioChanged').addClass('f_left').after('<div class="radioContainer f_left"></div>');

		}

	});*/

}

function FAVADD(E){

	var Main = $(Elems.FAVP).find(Elems.fi);

	var Child = Main.children();

	var HTML = Elems.FITEM.SPrintF(E.i,E.l,E.im,E.t,E.d,E.p);	

	(Child.length == 0 ? Main.append(HTML) : Child.first().before(HTML));

	//Adding Active Class

	I = $(Elems.fav+'[data-id='+E.i+']');

	I.addClass(I.attr(Elems.dac));

	Lazy();

	var Element = $(Elems.FAVP).find('li[{0}={1}]'.SPrintF(Elems.pi,E.i));

	return Element.width();

}

function POPUP_REMOVE(){

	$('body').removeClass('modal-open');

	$('html [data-container=ssp]').remove();

}

function POPUP_CLOSE(){

	$('body').removeClass('modal-open');

	$('html [data-container=ssp]').hide();

}

function Lazy(){

	$('img').OnView(function(){$(this).SetSrc('ds');});

}

function Request(URI,CallBack,Vars){

	//ClickAble = false;

	//ClickAble = true;

	if(typeof RequestData[URI] != 'undefined'){

		var Data = RequestData[URI];

		CallBack(Data);

		DefaultValidation = new Array();

		StoreSelect();

		return;

	}

	Rqst = $.post(URI,Vars,function(Data){



		if(Data && typeof Data.code != 'undefined' && Data.code == 200 && typeof CallBack == 'function'){

			CallBack(Data);

			DefaultValidation = new Array();

			StoreSelect();

			if(typeof RequestData[URI] == 'undefined'){

				RequestData[URI] = Data;

			}

		}

	},'json');

	Rqst.done(function(){Undo();});

	Rqst.fail(function(){Undo();});

	Rqst.always(function(){Undo();});

	return Rqst;

}

//Revert The Deleted Button Changes

function Undo(){

	ClickAble = true;

	if(typeof Deleted == 'object'){

		Deleted.prev('img').remove();

		Unset();

		if(typeof Deleted.attr(Elems.dac) != 'undefined'){

			Deleted.after(Deleted.attr(Elems.dac));

			Deleted.remove();

		}else{

			Deleted.show();

			Deleted.removeAttr('readonly');

		}

	}

}

function AppendRequest(CC,Items,Format){

	

	CC = $(CC);

	//IF Selected Item is Done

	var Selected = CC.attr(Elems.sl);

	var HTML = '';

	var Values = new Array();

	for(I in Items){

		J = Items[I];

		Values.push(I);

		HTML += Format.SPrintF(I,J,I == Selected ? ' selected="selected"' : null);

	}

	DefaultData[CC.attr('name')] = Values;

	CC.html(HTML);

	$(CC.attr(Elems.pn)).show();

}

function shuffle(O){

    for(var J, X, I = O.length; I; J = Math.floor(Math.random() * I),X = O[--I], O[I] = O[J], O[J] = X);

    return O;

};

function OnComplete(CallBack){

	$(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {

		CallBack(event, XMLHttpRequest, ajaxOptions);

	});

}

function OnSuccess(CallBack){

	$(document).ajaxSuccess(function(event, XMLHttpRequest, ajaxOptions) {

		CallBack(event, XMLHttpRequest, ajaxOptions);

	});

}

function Count(OBJ){

	L = 0;

	for(I in OBJ){

		L++;

	}

	return L;

}

function Price(Element){



	//Price Validation

	$('body').on('keyup keydown keypress blur mouseleave mouseout focus focusin focusout',Element,function(E){

		$(this).attr('type','number');

		/*var Codes = {96:0,97:1,98:2,99:3,100:4,101:5,102:6,103:7,104:8,105:9,48:0,49:1,50:2,51:3,52:4,53:5,54:6,55:7,56:8,57:9,8:0,46:1,35:7,36:2,37:3,38:4,39:5,40:6,13:13,9:9};

		var Code = E.keyCode || E.which;

		if(this.value.length == 0 && (Code == 96 || Code == 48))return false;

		var Intval = parseInt($(this).val());

		$(this).val(isNaN(Intval) ? '' : Intval);

		if(Code in Codes == false){

			return false;

		}*/

	});

}

function Limit(Counter,Element,Length){

	$('body').on('keyup keydown keypress blur',Element,function(E){

		var Current = $(this).val().length;

		var Code = E.keyCode || E.which;

		var Codes = {8:0,46:1,37:2,38:3,39:3,40:4};

		if(Code in Codes == false){



			if(Current >= Length){

				$(this).val($(this).val().substring(0,Length));

				$(Counter).html(0);

				return false;

			}

		}

		$(Counter).html(Length-Current);

	});

	$(Element).keyup();

}

function Search(URI,Form){

	var SV = Form.search.value;

	document.location = URI+'/'+SV.replace(/[!@#$%^&*()_\+= ]+/g,'-').toLowerCase();

	return false;

}

function Text(Name){

	if(typeof Name != 'undefined' && Name != '')return Name.replace('[','\\[').replace(']','\\]');

}

//Validation Functions

function Success(E){



	var Name = E.attr('name');

	var Title = E.attr('title');

	$('[data-field='+Text(Name)+']').each(function(I,E){$(E).remove();});

	var Parent = E.parent();

	if(Parent.hasClass('input-group'))Parent = Parent.parent();

	Parent.removeClass('has-error').addClass('has-success');

	E.removeClass('error');

}

function BError(E,Error){

	var Name = E.attr('name');

	var Title = E.attr('title');

	var ETip = E.attr('data-tip');

	$('[data-field='+Text(Name)+']').remove();

	E.addClass('error');

	var Parent = E.parent();

	if(Parent.hasClass('input-group'))Parent = Parent.parent();

	Parent.addClass('has-feedback has-error').append(typeof ETip == 'undefined' ? RQUIREDERRORHTML.SPrintF(Name,Error) :  null);

}

function Unset(E){

	if(E){

		var Name = E.attr('name');

		$('[data-field='+Text(Name)+']').remove();

		var Parent = E.parent();

		if(Parent.hasClass('input-group'))Parent = Parent.parent();

		Parent.removeClass('has-error');

		E.removeClass('error');

	}else{

		$('html *[data-field]').remove();

	}

}

function VField(Element){



	var E = $(Element);

	//var Validation = E.attr('data-valid');

	var Name = E.attr('name');

	var Validation = DefaultValidation[Name];

	/*if(typeof Validation == 'undefined'){

	    StoreSelect();

	}*/

	var Title = E.attr('title');

	var Val = E.val();

	var OK = 0;

	var DData = DefaultData[Name];

	if(typeof NoV == false){

		if(Val && typeof DData != 'undefined' && DData.indexOf(Val) < 0){

			BError(E,'Invalid value.');

			return false;

		}else{

			Unset(E);

		}

	}

	if(typeof Validation != 'undefined'){

		var Validation = eval('('+Validation+')');

		for(Type in Validation){

			//Required Validation

			if(Type == 'required'){

				if(Val == ''){

					BError(E,Title+' should not be empty');

					break;

				}else{

					OK++;

				}

			}

			//Type Match With

			if(Type == 'matchWith'){

				

				var D = Validation.matchWith;

				var DVal = D.val();

				if(Val != DVal){

					BError(E,Title+' did not match with '+D.attr('title'));

					break;

				}else{

					OK++;

				}

				break;

			}

			//Type Validation

			if(Type == 'type' && Val != ''){



				if(Validation.type == 'email' && EmailRegx.test(Val) == false){

					BError(E,Title+' is not valid');

					break;

				}else if(Validation.type == 'phone' && DigitRegx.test(Val) == false){

					BError(E,Title+' is not valid');

					break;

				}else if (Validation.type == 'special' && SpecialRegx.test(Val) == false){

					BError(E,Title+' is not valid');

					break;

				}else if (Validation.type == 'numonly'){

					var NumCheck = Val.replace(/[0-9!@#$%^&*\(\)\[\]\:\"\'\,\.\/\\\~\`\<\>\?\+]+/,'');

					if(NumCheck == ''){

						BError(E,Title+' must not have only numbers');

						break;

					}else{

						OK++;

					}

				}else{

					OK++;

				}

			}

			//Min Validation

			if(Type == 'min' && Val != ''){

				

				if(Val.length < parseInt(Validation.min)){



					BError(E,'Please enter atleast '+Validation.min+' chrachters');

					break;

				}else{

					OK++;

				}

			}

			//Max Validation

			if(Type == 'max' && Val != ''){

				

				if(Val.length > parseInt(Validation.max)){



					BError(E,Title+' must be less than '+Validation.max+' characters');

					break;

				}else{

					OK++;

				}

			}

			//Extension Validation

			if(Type == 'ext' && Val != ''){

				

				var Pcs = Val.split('.');

				var Ext = Pcs[Pcs.length-1].toLowerCase();

				var VP = Validation.ext.split('|');

				var Valid = false;

				for(I in VP){

					if(VP[I] == Ext){

						Valid = true;

					}

				}

				if(Valid){

					OK++;

				}else{

					BError(E,'Only  '+Validation.ext+' files are allowd.');

					break;

				}

			}

		}

		if(OK == Count(Validation)){

			Success(E);

			return true;

		}else{

			if(!('required' in Validation) && Val == '')Unset(E);

			return false;

		}

	}else{

		return false;

	}

}



//Checkbox Functions

function CheckAll(E){

	var DID = E.attr('data-id');

	E.parents('form:first').find('input[type=checkbox][data-id='+DID+']').each(function(I,A){

		this.checked = true;

	});

}

function UnCheckAll(E){

	var DID = E.attr('data-id');

	E.parents('form:first').find('input[type=checkbox][data-id='+DID+']').each(function(I,A){

		this.checked = false;

	});

}

function DelAll(){

	var E = $('[name=chkall]');

	var DID = E.attr('data-id');

	var DA = E.parents('form:first').find('input[type=checkbox][data-id='+DID+']:checked');

	if(DA.length == 0){

		alert('Please select an ad to delete.');

	}else{

		if(confirm('Are you sure you want to delete the selected ad(s)?')){

			E.parents('form:first').submit();

		}

	}

	return false;

}

function Center(Element){

	/*var Height = document.documentElement.clientHeight;

	var Width = document.documentElement.clientWidth;

	var H = Element.height();

	var W = Element.width();

	var X = Height / 2.5;

	H = X - ( H / 2);

	X = Width / 2;

	W = X - (W / 2);

	Element.animate({'top':Math.ceil(H),'left':Math.ceil(W)},100);

	$('[data-type=overlay]').height(Height);*/

}

function URI(Slug){

	return Base+Slug;

}

function StoreSelect(){

	$('body').find('select,input,textarea').each(function(){

		var E = $(this);

		var Name = E.attr('name');

		var Attrs = E.attr('data-valid');

		DefaultValidation[Name] = Attrs;

		//E.removeAttr('data-valid');

	});

	$('body').find('select').each(function(){

		var E = $(this);

		var Field = new Array();

		E.find('option').each(function(){

			Field.push($(this).val());

		});

		var Name = Text(E.attr('name'));

		if(typeof DefaultData[Name] == 'undefined' || Count(DefaultData[Name]) == 0){

			eval('DefaultData[\''+Name+'\'] = Field;');

		}

	});

}



function SearchIn(E){

	var Title = E.attr('data-title');

	$('[data-type=SearchForm]').attr('action',E.attr('data-search'));

	$('[data-id=SearchSelectionHolder]').html(Title);

	$('[data-type=SearchCategory][data-item=SearchCategory]').removeClass('select');

	$('[data-type=Cats]').hide();

}



function ActiveSuggestion(Element){

	

	Suggestions.find('li').each(function(){

		$(this).removeClass(SuggestionActiveClass);

	});

	$('input[name=BoleeSearch]').val(Element.attr('data-text'));

	Element.addClass(SuggestionActiveClass);

}

function Clean(Str){

	return Str.replace(/[0-9!@#$%^&*\-\(\)\[\]\:\"\'\,\.\/\\\~\`\<\>\?\+]+/,'');

}



function CatActive(E){	

	//E.parents('[data-type=SearchCategoryItem]').first().show();

	$('[data-type=SearchCategoryItem]').not(E.parent()).toggle();

}



function ApplySlider(){

	$('body [data-type=SLDR]').each(function(){		

		var E = $(this);		
		var interval = null;
		var Rand = E.attr('data-name');		

		var Slider = E.find('[data-type=SLDRI]');

		var Childs = Slider.children();

		var First = Childs.first();

		var Container = E.parents('[data-type=SLDRC]').first();

		var Extra = parseInt(First.css('padding-right'));

		var SlideWidth = (Rand == 'Thumb' ? Childs.first().width() + parseInt(First.css('margin-right')) : 195) + Extra;

		var TotalWidth = (SlideWidth * Childs.length);

		Slider.width(TotalWidth);	
		//console.log(Container);
		

		if(Rand != 'Thumb'){

			var Child = 1;

			E.attr('id',Rand);

			var Scroller = new IScroll('#'+Rand,{
				scrollX: true,
				scrollY: false,
				tap: true,
				preventDefault: false,
				eventPassthrough: true
			});
			Matrix = GetMatrix(Slider.css('transform'));
			if(Matrix[4] == 0){
				$(Container).find('[data-type=PRV]').addClass('disabled');
			}
			if(TotalWidth > E.width() && -Matrix[4] + SlideWidth + Extra >= (Slider.width() - E.width())){
				$(Container).find('[data-type=NXT]').removeClass('disabled');
			}
			interval = setInterval(function(){
				if(Child == Childs.length){
					Child = 1;					
				}
					Matrix = GetMatrix(Slider.css('transform'));
					if(-Matrix[4] + SlideWidth + Extra >= (Slider.width() - E.width())){
						$(this).addClass('disabled');
					}
					Child++
					Scroller.scrollToElement(document.querySelector('#'+Rand+' li:nth-child('+Child+')'),500);
					$(Container).find('[data-type=PRV]').removeClass('disabled');
				
			},3000);
			$(Container).on('click','[data-type=PRV]',function(){
				clearInterval(interval);
				Matrix = GetMatrix(Slider.css('transform'));
				if(-Matrix[4] - SlideWidth - Extra <= 0){
					$(this).addClass('disabled');
				}
				Child--;
				Scroller.scrollToElement(document.querySelector('#'+Rand+' li:nth-child('+Child+')'),500);
				$(Container).find('[data-type=NXT]').removeClass('disabled');
			});

			//Next Slider

			$(Container).on('click','[data-type=NXT]',function(){
				clearInterval(interval);
				Matrix = GetMatrix(Slider.css('transform'));
				if(-Matrix[4] + SlideWidth + Extra >= (Slider.width() - E.width())){
					$(this).addClass('disabled');
				}
				Child++
				Scroller.scrollToElement(document.querySelector('#'+Rand+' li:nth-child('+Child+')'),500);
				$(Container).find('[data-type=PRV]').removeClass('disabled');
			});
			$(Container).on('mouseleave','[data-type=NXT]',function(){
				interval = setInterval(function(){
					if(Child == Childs.length){
						Child = 1;					
					}
						Matrix = GetMatrix(Slider.css('transform'));
						if(-Matrix[4] + SlideWidth + Extra >= (Slider.width() - E.width())){
							$(this).addClass('disabled');
						}
						Child++
						Scroller.scrollToElement(document.querySelector('#'+Rand+' li:nth-child('+Child+')'),500);
						$(Container).find('[data-type=PRV]').removeClass('disabled');
					
				},3000);
			});
			$(Container).on('mouseleave','[data-type=PRV]',function(){
				interval = setInterval(function(){
					if(Child == Childs.length){
						Child = 1;					
					}
						Matrix = GetMatrix(Slider.css('transform'));
						if(-Matrix[4] + SlideWidth + Extra >= (Slider.width() - E.width())){
							$(this).addClass('disabled');
						}
						Child++
						Scroller.scrollToElement(document.querySelector('#'+Rand+' li:nth-child('+Child+')'),500);
						$(Container).find('[data-type=PRV]').removeClass('disabled');
					
				},3000);
			});
			

		}/*else{

			if(E.scrollLeft() == 0){$(Container).find('[data-type=PRV]').addClass('disabled');}

			

			//Prev Slider

			$(Container).on('click','[data-type=PRV]',function(){			

				if(!E.is(':animated')){

					E.animate({scrollLeft: '-='+(SlideWidth)});

				}

				if(E.scrollLeft() - SlideWidth - Extra <= 0){

					$(this).addClass('disabled');				

				}

				$(Container).find('[data-type=NXT]').removeClass('disabled');

			});

			//Next Slider

			$(Container).on('click','[data-type=NXT]',function(){

				if(!E.is(':animated')){

					E.animate({scrollLeft: '+='+(SlideWidth)});

				}

				if(E.scrollLeft() + SlideWidth + Extra >= (Slider.width() - E.width())){

					$(this).addClass('disabled');

				}

				$(Container).find('[data-type=PRV]').removeClass('disabled');

			});

		}*/	

	});

}
$(document).ready(function(){
	setInterval(function () {
			  
	}, 2000);
});
function GetMatrix(Matrix){

	Matrix = Matrix.replace('matrix','').replace('(','').replace(')','').split(', ');	

	return Matrix;

}



function CategoryTabsDisplayed(E){

	E.toggleClass('active');

	$(E.attr('data-dest')).toggle();	

	E.siblings('[data-type=TabCategoryTitle]').not(E).each(function(){

		var Elem = $(this);

		Elem.removeClass('active');

		$(Elem.attr('data-dest')).hide();

	});		

}