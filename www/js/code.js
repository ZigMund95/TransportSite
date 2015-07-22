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
alert(data['zakazchik']);
for(var key in data){
var value = data[key];
$('[name='+key+']').val(value);
};
};

/*
function setDateFields(){
var day = '';
var month = '';
var year = '';
var months = ["", ["январь", 31], ["февраль", 28], ["март", 31], ["апрель", 30], ["май", 31], ["июнь", 30], 
				["июль", 31], ["август", 31], ["сентябрь", 30], ["октябрь", 31], ["ноябрь", 30], ["декабрь", 31]];
var currDate = Date();
//var strDate = string(currDate)
var currDay = currDate.slice(' ');
//alert(currDate+'<'+currDay[-1]+'>');
for(var i=1; i<32; i++){ day = day + '<option>'+i+'</option>'};
for(var i=1; i<13; i++){ month = month + '<option>'+months[i][0]+'</option>'};
for(var i=2015; i<2017; i++){ year = year + '<option>'+i+'</option>'};
$(".date_field").html("<select id='day'>"+day+"</select> <select id='month'>"+month+"</select> <select id='year'>"+year+"</select> <input type=text name='"+$(this).attr('name')+"' class='date'>");

var lastDay = 0;
var lastMonth = 0;
var lastYear = 0;
$(".date_field").bind("change", "select", function(){ 
	$('.date').val($('#day').val()+'-'+$('#month').val()+'-'+$('#year').val()); 	
	if(lastMonth != $("#month")){
		var j = 1;
		alert('asd');
		while(months[j][0] != $("#month").val()){ j++; };
		var n = months[j][1]+1;
		day = '';
		for(var i=1; i<n; i++){ day = day + '<option>'+i+'</option>'}; 
		$("#day").html(day);
		$('.date').val(lastDay+'-'+$('#month').val()+'-'+lastYear);
		$('#day').val(lastDay);
	}
	lastDay = $('#day').val();
	lastMonth = $('#month').val();
	lastYear = $('#year').val();
});

};*/

//-------------------------------------------------------//
jQuery(document).ready(function($){

	//showalert();
	
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
	
	
	//setDateFields();
	
	/*----------------------------*/
	/*-ВЫДЕЛЕНИЕ ЯЧЕЙКИ В ТАБЛИЦЕ-*/
	/*----------------------------*/
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
	
	
	/*---------------------------*/
	/*-НАЖАТИЕ КНОПОК ВХОД/ВЫХОД-*/
	/*---------------------------*/
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
	
	
	/*-----------------------------------*/
	/*-ОТКРЫТИЕ/ЗАКРЫТИЕ МОДАЛЬНОГО ОКНА-*/
	/*-----------------------------------*/	
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
	
	$("#content").on("click", "#countersform", function(){
		$("#shadow").show();
		$("#fr").show();
		var namebutton = $(this).attr('name');
		$("#fr").attr("name", namebutton);
		$.ajax({ url: "pages/counter_search.php", success: function(html){ $("#fr").html(html); } });
		
		return false;
	});
	
	$("#shadow").click(function(){ $("#shadow").hide(); $("#fr").hide(); });
	
	
	$("body").on("dblclick", ".dblclick_select_counter td", function(){
		$("[name="+$('#fr').attr('name')+"]").val($.trim($("[posX=1][posY="+$(this).attr('posY')+"]").html()));
		if($('#fr').attr('name') == 'zakazchik'){ $("[name=ati1]").val($.trim($("[posX=2][posY="+$(this).attr('posY')+"]").html())); }
		else{ $("[name=ati2]").val($.trim($("[posX=2][posY="+$(this).attr('posY')+"]").html())); };
		$("#shadow").hide(); 
		$("#fr").hide();
	});
	
	$("#content").on("dblclick", ".dblclick_select_counter td", function(){
		$("#shadow").show(); 
		$("#fr").show();
		$("#content").append('asd');
		/*$.ajax({
			type: 'GET',
			url: 'pages/counter_add.php',
			success: function(html){ $("#fr").html(html); }*/
	});
	
	$("body").on("dblclick", ".dblclick_select_driver td", function(){
		$("[name=driver]").val($("[posX=1][posY="+$(this).attr('posY')+"]").html());
		$("[name=phone1]").val($("[posX=2][posY="+$(this).attr('posY')+"]").html());
		$("[name=phone2]").val($("[posX=3][posY="+$(this).attr('posY')+"]").html());
		$("[name=car]").val($("[posX=10][posY="+$(this).attr('posY')+"]").html());
		$("#fr").hide();
		$("#shadow").hide();
	});
	
	$("#content").on("dblclick", "#reisi td", function(){
		var datasend = 'index='+$("[posX=1][posY="+$(this).attr('posY')+"]").html();
		alert(datasend);
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
		if($("#search").val() != last_search){
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
	
	
	
	
	//---------------------------------------------------------------
	$("#content").on("click", "#setconfig", function(){
		$.ajax({
			url: 'pages/setconfig.php',
			success: function(html){
				$('#content').html(html);
			}
		});
	});
});