var page = '1';
function loadPage(){/*
	if(("#"+page != location.hash)&&(location.hash != "")){
		page = location.hash;
		page = page.replace("#", "");
		$.ajax({
			url: 'pages/'+page+'.php',
			success: function(html){
				$("#content").html(html);
			}
		});
	}*/
	if(($('#sessioncheck').val() != '')||(location.pathname  == '/login')||(location.pathname  == '/register')){
	if((page != location.pathname)&&(location.pathname != "")){
		page = location.pathname;
		//alert(page);
		if(page == '/'){page1='main';}else{page1=page;};
		$.ajax({
			url: 'pages/'+page1+'.php',
			success: function(html){
				$("#content").html(html);
			}
		});
	}
	}
};

function headerLogButton(){
if($('#inpsession').val() != ''){ $('#header p a').hide(); $("#logout_button").show(); }
else{ $('#header p a').show(); $("#logout_button").hide(); }
};


jQuery(document).ready(function($){
	
	setInterval("loadPage()", 250);
	
	$("#menu ul li ul").hide();
	
	headerLogButton();
	
	$("a").click(function(){
		if($(this).attr("href") != ""){
			loadPage();
		};
	});
	
	$(".nothref").click(function(){ return false; });
	
	$("#logo").hover( //НАВДЕНИЕ КУРСОРА НА ЛОГО В ШАПКЕ
	function(){ $(this).attr('src', 'images/logo_hover.png'); },
	function(){ $(this).attr('src', 'images/logo.png'); }
	);
	
	$("#header p a").hover( //НАВЕДЕНИЕ КУРСОРА НА КНОПКИ В ШАПКЕ
	function(){ $(this).css("background-image", "url(images/button_hover.png)"); },
	function(){ $(this).css("background-image", "url(images/button.png)"); }
	);
	
	$("#menu ul li").hover( //НАВЕЕНИЕ КУРСОРА НА ЭЛЕМЕНТЫ МЕНЮ
	function(){
		//$("ul", this).css("left", $(this).offsetLeft-100);
		$("ul", this).slideDown("fast"); 
	},
	function(){	$("ul", this).hide(); }
	);
	
	/*----------------------------*/
	/*-ВЫДЕЛЕНИЕ ЯЧЕЙКИ В ТАБЛИЦЕ-*/
	/*----------------------------*/
	$("body, #content").on("click", ".canselect td", function(){
		$("table td").css("border","1px solid black");
		$("table td").css("background-color","white");
		$("table td").attr("class","cell");
		var row = '[posY='+$(this).attr('posY')+']';
		$(row).css("border","1px solid red");
		$(row).css("background-color","#ccc");
		$(row).attr("class","cell selected");
	});
	
	$(document).keyup(function(event){
		if((event.keyCode == 38)||(event.keyCode == 40)){
		cell = $(".selected");
		var posY = cell.attr("posY");
		if(event.keyCode == 38){
			if(posY > 1){
			cell.css("border-color", "black");
			cell.css("background-color","white");
			cell.attr("class", "cell");
			str = '[posY='+(parseInt(posY)-1)+']';
			$(str).css("border-color", "red");
			$(str).css("background-color","#ccc");
			$(str).attr("class", "cell selected");
			}
		}
		
		if(event.keyCode == 40){
			cell.css("border-color", "black");
			cell.css("background-color","white");
			cell.attr("class", "cell");
			str = '[posY='+(parseInt(posY)+1)+']';
			$(str).css("border-color", "red"); 
			$(str).css("background-color","#ccc");
			$(str).attr("class", "cell selected");
		}
		return false;
		}
	});
	
	$("#content").on("click", "#login_button", function(){
		if (($("[name=login]").val() != '')&($("[name=password]").val() != '')){
			$.ajax({
				type: "POST",
				url: "pages/login.php",
				data: {login_send: $("[name=login]").val(), password_send: $("[name=password]").val()},
				success: function(html){ location.reload(); $("#content").html(html); }
			});
		};
		window.location.pathname = '';
		return false;
		});
		
	$("#header").on("click", "#logout_button", function(){
		$.ajax({
				type: "POST",
				url: "pages/login.php",
				data: {event: "logout"},
				success: function(html){ location.reload(); $("#content").html(html); }
			});
		return false;
	});
	
	$("#content").on("click", "#countersform", function(){
		$("#shadow").show();
		$("#fr").show();
		$.ajax({ url: "pages/counters.php",	success: function(html){ $("#fr").html(html); } });
		return false;
	});
	
	$("#shadow").click(function(){ $("#shadow").hide(); $("#fr").hide(); }); //ЗАКРЫТИЕ МОДАЛЬНОГО ОКНА
	
	$("body").on("dblclick", "#counters td", function(){
		var cell = $(this).attr('id');
		var pos = cell.split('x');
		var selecter = '#1x'+pos[1];
		$("[name=zakazchik]").val($.trim($(selecter).html()));
		$("#shadow").hide(); 
		$("#fr").hide();
	});
	
	$("body").on("click", "#counters td", function(){
		$(this).css('border', '1px solid red');
	});
	
	$("#content").on("click", "[name=ok]", function(){
		var a = $("#formrecord").serialize();
		$.ajax({
			type: "POST",
			url: "pages/newrecordadd.php",
			data: a,
			success: function(html){
					$("#content").html(html);
			}
		});
		$("#content").append(a);
		return false;
	});
	
	$("body").on("click", "#setvision", function(){
		var a = $("#viewform").serialize();
		$.ajax({
			type: 'POST',
			url: 'pages/view.php',
			data: a,
			success: function(html){
				$('#content').html(html);
			}
		});
		location.load('');
		return false;
	});
	
	$("body").on("click", "#checkall", function(){
		$('input').attr('checked', 'checked');
		return false;
	});
	
	$(".openfr").click(function(){
		$("#shadow").show();
		$("#fr").show();
		$.ajax({ url: 'pages/'+$(this).attr('href')+'.php', success: function(html){ $("#fr").html(html); } });
		return false;
	});
	
	$("#content").on("click", ".openfr", function(){
		$("#shadow").show();
		$("#fr").show();
		$.ajax({ url: 'pages/'+$(this).attr('href')+'.php', success: function(html){ $("#fr").html(html); } });
		return false;
	});
	
	$("#content").on("click", "#setconfig", function(){
		$.ajax({
			url: 'pages/setconfig.php',
			success: function(html){
				$('#content').html(html);
			}
		});
	});
	
	$("body").bind("keyup", ".name", function(){
		$('#name').val($('#name1').val()+' '+$('#name2').val()+' '+$('#name3').val());
	});
	
	$("body").on("click", "#driveraddbutton", function(){
		var a = $("#formdriver").serialize();
		$.ajax({
			type: "POST",
			url: "pages/driver_add_send.php",
			data: a,
			success: function(html){
				$("#content").html(html);
			}
		});
		$("#fr").hide();
		$("#shadow").hide();		
		return false;
	});
	
	$("body, #content").bind("keyup", "#drivers_search", function(){
		$.ajax({
			type: 'GET',
			url: 'pages/drivers.php',
			data: 'search='+$("#drivers_search").val(),
			success: function(html){
				$("#drivers").html(html);
			}
		});
	});
});