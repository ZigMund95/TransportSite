var page = '1';
function loadPage(){
	if(($('#sessioncheck').val() != '')||(location.pathname  == '/login')||(location.pathname  == '/register')){
	if((page != location.pathname)&&(location.pathname != "")){
		page = location.pathname;
		//alert(page);
		if(page == '/'){page1='main';}else{page1=page;};
		$.ajax({
			url: 'pages/'+page1+'.php',
			success: function(html){
				$("#content").html(html);
				$("#action").val("open");
			}
		});
	}
	}
};

function headerLogButton(){
if($('#inpsession').val() != ''){ $('#header p a').hide(); $("#logout_button").show(); }
else{ $('#header p a').show(); $("#logout_button").hide(); }
};

var data;
function loadRecordPage(data){
for(var key in data){
var value = data[key];
$('[name='+key+']').val(value);

if(typeof data['car'] != 'undefined'){
	var namearr = data['name'].split(' ');
	$("#name1").val(namearr[0]);
	$("#name2").val(namearr[1]);
	$("#name3").val(namearr[2]);
};
};
};

// ЗАПРЕТ НА ВВОД БУКВ(РАЗРЕШЕНЫ ЦИФРЫ/СТРЕЛКИ/DELETE/BACKSPACE/TAB)
function noLetters(keyCode){
	//alert(keyCode);
	if(!(keyCode >= 48 && keyCode <= 57 || keyCode >= 37 && keyCode <= 40 || keyCode == 46 || keyCode == 8 || keyCode == 9)){ return false; };
};

function calculateNetto(){
if($("[name=forma1]").val() != '?' & $("[name=forma2]").val() != '?'){ 
	if($("[name=forma1]").val() == 'нал'){
		$("[name=netto]").val($("[name=brutto]").val()-$("[name=poteri]").val()); 
	}
	else{
		if($("[name=forma1]").val() == 'безнал'){
			if($("[name=forma2]").val() == 'с НДС'){
				$("[name=netto]").val($("[name=brutto]").val()-$("[name=poteri]").val()); 
			}
			else{
				$("[name=netto]").val(0.98*$("[name=brutto]").val()-$("[name=poteri]").val()); 
			}
		}
		else{
			if($("[name=forma2]").val() == 'с НДС'){
				$("[name=netto]").val(0.98*$("[name=brutto]").val()-$("[name=poteri]").val()); 
			}
			else{
				$("[name=netto]").val(0.94*$("[name=brutto]").val()-$("[name=poteri]").val()); 
			}
		}
	}
};
}


function setDateFields(){
var day = ''; var month = ''; var year = '';
var months = ["", ["январь", 31], ["февраль", 28], ["март", 31], ["апрель", 30], ["май", 31], ["июнь", 30], 
				["июль", 31], ["август", 31], ["сентябрь", 30], ["октябрь", 31], ["ноябрь", 30], ["декабрь", 31]];
var currDate = Date();
var currDay = currDate.slice(' ');
for(var i=1; i<32; i++){ day = day + '<option>'+i+'</option>'};
for(var i=1; i<13; i++){ month = month + '<option>'+months[i][0]+'</option>'};
for(var i=2015; i<2017; i++){ year = year + '<option>'+i+'</option>'};
$(".date_picker").html("<select id='day'>"+day+"</select> <select id='month'>"+month+"</select> <select id='year'>"+year+"</select> <input type=hidden name='"+$(".date_picker").attr('name')+"' class='date'>");

$('.date').val($('#day').val()+'-'+j+'-'+$('#year').val());
var j = 1;
while(months[j][0] != $("#month").val()){ j++; };
var lastDay = 1; var lastMonth = 1; var lastYear = 2015;
$(".date_picker").on("change", "select", function(){ 
	if(lastDay != $("#day").val() || lastMonth != $("#month").val() || lastYear != $("#year").val()){
		lastDay = $("#day").val();
		lastYear = $("#year").val();
		if(lastYear % 4 == 0){ months[2][1] = 29; } else{ months[2][1] = 28; };
		var j = 1;
		while(months[j][0] != $("#month").val()){ j++; };
		day = '';
		for(var i=1; i<=months[j][1]; i++){ day = day + '<option>'+i+'</option>'}; 
		$("#day").html(day);
		$('#day').val(lastDay);
		if($('#day').val() == null){ $('#day').val('1'); };
		$('.date').val($('#day').val()+'-'+j+'-'+$('#year').val());
	}
	lastDay = $('#day').val();
	lastMonth = $('#month').val();
	lastYear = $('#year').val();
});
//var j = 1;
//while(months[j][0] != $("#month").val()){ j++; };
//var d;
//alert(d = $('#day').val()+' '+'May'+' '+$('#year').val());
//alert(Date(d));
};

//-------------------------------------------------------//
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
	
	$("#content a").hover( //НАВЕДЕНИЕ КУРСОРА НА КНОПКИ В ШАПКЕ
	function(){ $(this).css("background-image", "url(images/button_hover.png)"); },
	function(){ $(this).css("background-image", "url(images/button.png)"); }
	);
	
	$("#menu ul li").hover( //НАВЕЕНИЕ КУРСОРА НА ЭЛЕМЕНТЫ МЕНЮ
	function(){
		$("ul", this).slideDown("fast"); 
	},
	function(){	$("ul", this).hide(); }
	);
	
	/*----------------------------*/
	/*-ВЫДЕЛЕНИЕ ЯЧЕЙКИ В ТАБЛИЦЕ-*/
	/*----------------------------*/
	//{
	$("body, #content").on("click", ".canselect td", function(){
		$(".canselect td").css("border","1px solid black");
		$(".canselect td").css("background-color","white");
		$(".canselect td").attr("class","cell");
		var row = '[class][posY='+$(this).attr('posY')+']';
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
			str = '[class][posY='+(parseInt(posY)-1)+']';
			$(str).css("border-color", "red");
			$(str).css("background-color","#ccc");
			$(str).attr("class", "cell selected");
			}
		}
		
		if(event.keyCode == 40){
			cell.css("border-color", "black");
			cell.css("background-color","white");
			cell.attr("class", "cell");
			str = '[class][posY='+(parseInt(posY)+1)+']';
			$(str).css("border-color", "red"); 
			$(str).css("background-color","#ccc");
			$(str).attr("class", "cell selected");
		}
		return false;
		}
	});
	
	/*
	$(document).keydown(function(event){ 
		if(typeof $('.selected').html() != 'undefined'){ return false; }
	});*/
	
	//}
	
	/*---------------------------*/
	/*-НАЖАТИЕ КНОПОК ВХОД/ВЫХОД-*/
	/*---------------------------*/
	//{
	$("#content").on("click", "#login_button", function(){
		if (($("[name=login]").val() != '')&($("[name=password]").val() != '')){
			$.ajax({
				type: "POST",
				url: "pages/login.php",
				data: {login_send: $("[name=login]").val(), password_send: $("[name=password]").val()},
				success: function(html){ location.reload(); $("#content").html(html); }
			});
		};
		//window.location.pathname = '';
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
	//}
	
	
	/*-----------------------------------*/
	/*-ОТКРЫТИЕ/ЗАКРЫТИЕ МОДАЛЬНОГО ОКНА-*/
	/*-----------------------------------*/	
	//{
	$(".openfr").click(function(){
		$("#shadow").show();
		$("#fr").show();
		var namebutton = $(this).attr('name');
		$("#fr").attr("name", namebutton);
		if($(this).attr("href") == "counter_search" || $(this).attr("href") == "drivers_search"){ var action = 'select'; }
		else{ var action = 'open'; };
		$.ajax({ url: 'pages/'+$(this).attr('href')+'.php', success: function(html){ $("#fr").html(html); $("#action").val(action); } });
		return false;
	});
	
	$("#content").on("click", ".openfr", function(){
		$("#shadow").show();
		$("#fr").show();
		var namebutton = $(this).attr('name');
		$("#fr").attr("name", namebutton);
		if($(this).attr("href") == "counter_search" || $(this).attr("href") == "drivers_search"){ var action = 'select'; }
		else{ var action = 'open'; };
		$.ajax({ url: 'pages/'+$(this).attr('href')+'.php', success: function(html){ $("#fr").html(html); $("#action").val(action); } });
		return false;
	});
	
	$("#content").on("click", "#countersform", function(){
		$("#shadow").show();
		$("#fr").show();
		var namebutton = $(this).attr('name');
		$("#fr").attr("name", namebutton);
		$.ajax({ url: "pages/counter_search.php", success: function(html){ $("#fr").html(html); } });
		
		return false;
	});
	
	$("#shadow").click(function(){ $("#shadow").hide(); $("#fr").hide(); });
	//}
	
	/*-------------------------------------------*/
	/*-ВЫБОР КОНТРАГЕНТА/ВОДИТЕЛЯ В НОВОМ ЗАКАЗЕ-*/
	/*-------------------------------------------*/
	//{
	$("body").on("dblclick", ".dblclick_select_counter td", function(){
		if($("#action").val() == 'select'){
			$("[name="+$('#fr').attr('name')+"]").val($.trim($("[posX=2][posY="+$(this).attr('posY')+"]").html()));
			if($('#fr').attr('name') == 'zakazchik'){ $("[name=ati1]").val($.trim($("[posX=3][posY="+$(this).attr('posY')+"]").html())); }
			else{ $("[name=ati2]").val($.trim($("[posX=3][posY="+$(this).attr('posY')+"]").html())); };
			$("#shadow").hide(); 
			$("#fr").hide();
		}
	});
	
	$("body").on("dblclick", ".dblclick_select_driver td", function(){
		if($("#action").val() == 'select'){
			$("[name=driver]").val($("[posX=2][posY="+$(this).attr('posY')+"]").html());
			$("[name=phone1]").val($("[posX=3][posY="+$(this).attr('posY')+"]").html());
			$("[name=phone2]").val($("[posX=4][posY="+$(this).attr('posY')+"]").html());
			$("[name=car]").val($("[posX=11][posY="+$(this).attr('posY')+"]").html());
			$("#fr").hide();
			$("#shadow").hide();
		}
	});
	//}
	
	/*-----------------------------------------*/
	/*-ИЗМЕНЕНИЕ ЗАПИСИ О КОНТРАГЕНТЕ/ВОДИТЕЛЕ-*/
	/*-----------------------------------------*/
	//{
	$("#content").on("dblclick", ".dblclick_select_counter td", function(){
		if($("#action").val() == 'open'){
			$("#shadow").show(); 
			$("#fr").show();
			var datasend = 'index='+$("[posX=1][posY="+$(this).attr('posY')+"]").html();
			$.ajax({
				type: 'GET',
				url: 'pages/counter_add.php',
				data: datasend,
				success: function(html){ $("#fr").html(html); $("button").html("Изменить"); }
			});
		}
	});
	
	$("#content").on("dblclick", ".dblclick_select_driver td", function(){
		if($("#action").val() == 'open'){
			$("#shadow").show(); 
			$("#fr").show();
			var datasend = 'index='+$("[posX=1][posY="+$(this).attr('posY')+"]").html();
			$.ajax({
				type: 'GET',
				url: 'pages/driver_add.php',
				data: datasend,
				success: function(html){ $("#fr").html(html);  $("button").html("Изменить"); }
			});
		}
	});
	//}
	
	
	$("#content").on("dblclick", "#reisi td", function(){
		var datasend = 'index='+$("[posX=1][posY="+$(this).attr('posY')+"]").html();
		$.ajax({
			type: 'GET',
			url: 'pages/newrecord.php',
			data: datasend,
			success: function(html){ $('#content').html(html); }
		});
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
		location.reload();
		return false;
	});
	
	$("body").on("click", "#counteraddbutton", function(){
		var a = $("#formcounter").serialize();
		$.ajax({
			type: "POST",
			url: "pages/counter_add_send.php",
			data: a,
			success: function(html){
				$("#content").html(html);
			}
		});
		$("#fr").hide();
		$("#shadow").hide();		
		return false;
	});
	
	
	var last_search = '';
	$("body, #content").bind("keyup", "#search", function(){
		if($("#search").val() != last_search && typeof $("#search").val() != 'undefined'){
		last_search = $("#search").val();
		var search_page = $("#search").attr('name');
		$.ajax({
			type: 'POST',
			url: 'pages/'+search_page+'.php',
			data: 'search='+$("#search").val(),
			success: function(html){
				$("#drivers").html(html);
			}
		});
		};
	});
	
	$("#content").on("click", "#open_schet", function(){
		var form = $("#formrecord").serialize();
		window.open('pages/schet1.php?'+form);
		return false;
	});
	
	//---------------------------------------------------------------
	$("#content").on("click", "#setconfig", function(){
		$.ajax({
			url: 'pages/setconfig.php',
			success: function(html){
				$('#content').html(html);
			}
		});
	});
	
	setDateFields();
});

