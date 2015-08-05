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
				if(page1 == "main"){ $("[href=view]").show(); }
				else{ $("[href=view]").hide(); }
				
				if(typeof $(".fixed").css("width") != "undefined"){
					$(".tableData").css({height: $("#content")[0].offsetHeight-$(".fixed")[0].offsetHeight-22});
					$(".tableData").css({width: $(".fixed")[0].offsetWidth+21});
				}
				
				if(typeof $(".table1").css("width") != "undefined"){
					$(".table1 col").eq(0).css("width", "10%");
					$(".table1 col").eq(1).css("width", "70%");
					$(".table1 col").eq(2).css("width", "20%");
				};
				
				$(".fixed th").hover(
					function(){},
					function(){ $("body").css("cursor", ""); }
				);
				
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
	
	
	var thiss = $('[name='+key+']').parent("div");
	
	
	if(typeof $(thiss).attr("class") != 'undefined'){
		var namethis = $(thiss).attr("name");
		var months = ["", ["январь", 31], ["февраль", 28], ["март", 31], ["апрель", 30], ["май", 31], ["июнь", 30], 
					["июль", 31], ["август", 31], ["сентябрь", 30], ["октябрь", 31], ["ноябрь", 30], ["декабрь", 31]];
		var date = $('[name='+key+']').val().split("-");
		if(date[0] < 10){ date[0] = date[0][1]; }
		if(date[1] < 10){ date[1] = date[1][1]; }
		$(thiss).find(".day").val(date[0]);
		$(thiss).find(".month").val(months[date[1]][0]);
		$(thiss).find(".year").val(date[2]);
	}
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
}
else{ $("[name=netto]").val("Выберите форму оплаты"); };
calculateStavka();
calculateZakaz();
}

function calculateZakaz(){
	$("[name=dolg1]").val($("[name=netto]").val()-$("[name=post_sum1]").val()-$("[name=post_sum2]").val()-$("[name=post_sum3]").val()-$("[name=post_sum4]").val());
	$("[name=dolg2]").val($("[name=stavka]").val()-$("[name=opl_sum1]").val()-$("[name=opl_sum2]").val()-$("[name=opl_sum3]").val()-$("[name=opl_sum4]").val());
}

function calculateStavka(){
	var stavka;
	if($("[name=stavka]").attr("stavka") != ""){
		$("[name=stavka]").val($("[name=brutto]").val()*(100-$("[name=stavka]").attr("stavka")) / 100);
	}
	else{
		$("[name=stavka]").val($("[name=brutto]").val());
	}
}

function setDateFields(){
var today = new Date();

var day = ''; var month = ''; var year = '';
var months = [["", 0], ["январь", 31], ["февраль", 28], ["март", 31], ["апрель", 30], ["май", 31], ["июнь", 30], 
				["июль", 31], ["август", 31], ["сентябрь", 30], ["октябрь", 31], ["ноябрь", 30], ["декабрь", 31]];
for(var i=1; i<32; i++){ day = day + '<option>'+i+'</option>'};
for(var i=0; i<13; i++){ month = month + '<option>'+months[i][0]+'</option>'};
for(var i=2015; i<2017; i++){ year = year + '<option>'+i+'</option>'};

var lastDay = today.getDate(); var lastMonth = today.getMonth()+1; var lastYear = today.getFullYear();
var date_picker = $(".date_picker");
for(var i=0;i<14;i++){
	date_picker.eq(i).html("<select class='day'>"+day+"</select> <select class='month'>"+month+"</select> <select class='year'>"+year+"</select> <input type=hidden name='"+date_picker.eq(i).attr('name')+"' class='date'>");

	if(i<3){
		date_picker.eq(i).find(".day").val(lastDay);
		date_picker.eq(i).find(".month").val(months[lastMonth][0]);
		date_picker.eq(i).find(".year").val(lastYear);
	}
	else{
		date_picker.eq(i).append("<img src='images/cross.png' class='deletedate'>");
		date_picker.eq(i).find(".day").val('');
		date_picker.eq(i).find(".month").val('');
		date_picker.eq(i).find(".year").val('');
	}
	var j = 0;
	while(months[j][0] != date_picker.eq(i).find(".month").val() && j < 12){ j++; };
	date_picker.eq(i).find('.date').val(date_picker.eq(i).find('.day').val()+'-'+j+'-'+date_picker.eq(i).find('.year').val());
}

$(".date_picker").on("change", "select", function(){ 
	var thiss = $(this).parent("div");
	if(lastDay != $(thiss).find(".day").val() || lastMonth != $(thiss).find(".month").val() || lastYear != $(thiss).find(".year").val()){
		lastDay = $(thiss).find(".day").val();
		lastYear = $(thiss).find(".year").val();
		if(lastYear % 4 == 0){ months[2][1] = 29; } else{ months[2][1] = 28; }; // ПРОВЕРКА НА ВИСОКОСНОСТЬ ГОДА
		var j = 0;
		if($(thiss).find(".month").val() == ''){ $(thiss).find(".month").val(months[today.getMonth()+1][0]); };
		if($(thiss).find(".year").val() == null){ $(thiss).find(".year").val(today.getFullYear()); };
		while(months[j][0] != $(thiss).find(".month").val()){ j++; };
		day = '';
		for(var i=1; i<=months[j][1]; i++){ day = day + '<option>'+i+'</option>'}; 
		$(thiss).find(".day").html(day);	
		$(thiss).find(".day").val(lastDay);
		if($(thiss).find(".day").val() == null){ $(thiss).find(".day").val('1'); };
		$(thiss).find(".date").val($(thiss).find(".day").val()+'-'+j+'-'+$(thiss).find(".year").val());
	}
	lastDay = $(thiss).find(".day").val();
	lastMonth = $(thiss).find(".month").val();
	lastYear = $(thiss).find(".year").val();
});

$(".date_picker").on("change", "input", function(){
var date = $(this).val().split("-");
var thiss = $(this).parent("div");
if(date[0] < 10){ date[0] = date[0][1]; }
if(date[1] < 10){ date[1] = date[1][1]; }
$(thiss).find(".day").val(date[0]);
$(thiss).find(".month").val(months[date[1]][0]);
$(thiss).find(".year").val(date[2]);
});

$(".deletedate").click(function(){ 
	var thiss = $(this).parent("div");
	//alert('asd');
	$(thiss).find(".day").val('');
	$(thiss).find(".month").val('');
	$(thiss).find(".year").val(''); 
	$(thiss).find(".date").val($(thiss).find(".day").val()+'-'+j+'-'+$(thiss).find(".year").val());
	return false;
});
};

function filter(sort){
	var data = '';
	var i = 0;
	var j = 0;
	var b = '1';
	while(typeof $(".filterCol").eq(i).attr("id") != "undefined"){
		if(($(".filterInp").eq(j).attr("id")) == $(".filterCol").eq(i).attr("id")+"input"){
			if(b=='1'){ b = ' '; }
			else{ b = '&'; };
			data = data+b+"filterC[]="+$(".filterCol").eq(i).attr("id")+"&filter[]="+$(".filterInp").eq(j).val();;
			j++;
		};
		i++;
	}
	data = data + '&' + sort;
	$.ajax({
		type: "GET",
		url: "pages/main_filter.php",
		data: data,
		success: function(html){ 
			$(".tableData").html(html); 
			for(i = 0; i<100; i++){
				$("#reisi col").eq(i).css("width", $(".fixed col").eq(i).css("width"));
			}
			$(".tableData").css({height: $("#content")[0].offsetHeight-$(".fixed")[0].offsetHeight-22});
			$(".tableData").css({width: $(".fixed")[0].offsetWidth+21});
			}
	})
}

var colWidths;
var colVisible;
function setColWidth(widths, visibleCol){
	//alert(widths+' '+visibleCol);
	colWidths = widths;
	colVisible = visibleCol;
	var i;
	for(i = 0; i<100; i++){
		$(".fixed col").eq(i).css("width", "100");
		$("#reisi col").eq(i).css("width", '100');
	}
	var key;
	var i = 0;
	for(key in widths){
		if(visibleCol[key] == 1){
		$(".fixed col").eq(i).css("width", widths[key]);
		$("#reisi col").eq(i).css("width", widths[key]);
		i++;
		}
	}
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
	
	if($("#sessioncheck").val() != '3'){ $("[href=sluzhebnie]").hide(); };
	
	$(".nothref").click(function(){ return false; });
	
	$("#logo").hover( //НАВДЕНИЕ КУРСОРА НА ЛОГО В ШАПКЕ
	function(){ $(this).attr('src', 'images/logo_hover.png'); },
	function(){ $(this).attr('src', 'images/logo.png'); }
	);
	
	$("#header p a").hover( //НАВЕДЕНИЕ КУРСОРА НА КНОПКИ В ШАПКЕ
	function(){ $(this).css("background-image", "url(images/button_hover.png)"); },
	function(){ $(this).css("background-image", "url(images/button.png)"); }
	);
	
	$("#content a").hover(
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
		var row = '[class=cell][posY='+$(this).attr('posY')+']';
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
			str = '[class=cell][posY='+(parseInt(posY)-1)+']';
			$(str).css("border-color", "red");
			$(str).css("background-color","#ccc");
			$(str).attr("class", "cell selected");
			}
		}
		
		if(event.keyCode == 40){
			cell.css("border-color", "black");
			cell.css("background-color","white");
			cell.attr("class", "cell");
			str = '[class=cell][posY='+(parseInt(posY)+1)+']';
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
				success: function(html){ location.reload(); $("#content").html(html); window.location.pathname = ''; }
			});
		};
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
		var action = $(this).attr("rule");
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
		var action = $(this).attr("rule");
		var button = $(this).attr("butN");
		
		$.ajax({ url: 'pages/'+$(this).attr('href')+'.php', success: function(html){ $("#fr").html(html); $("#action").val(action); $("#button_pressed").val(button);} });
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
	
	$("#shadow").click(function(){ 
		$("#shadow").hide();  
		$("#fr").hide(); 
	});
	//}
	
	/*-------------------------------------------*/
	/*-ВЫБОР КОНТРАГЕНТА/ВОДИТЕЛЯ В НОВОМ ЗАКАЗЕ-*/
	/*-------------------------------------------*/
	//{
	$("body").on("dblclick", ".dblclick_select_counter td", function(){
		if($("#action").val() == 'select'){
			$("[name="+$('#fr').attr('name')+"]").val($.trim($("[posX=2][posY="+$(this).attr('posY')+"]").html()));
			if($('#fr').attr('name') == 'zakazchik'){ 
				$("[name=ati1]").val($.trim($("[posX=3][posY="+$(this).attr('posY')+"]").html())); 
			}
			else{ 
				$("[name=ati2]").val($.trim($("[posX=3][posY="+$(this).attr('posY')+"]").html()));
				var sluz = $("#sluz").val().split(";");
				//alert($.trim($("[posX=1][posY="+$(this).attr('posY')+"]").html())+' '+sluz.length);
				var stavka = '';
				for(var i = 0; i < sluz.length; i++){
					if(sluz[i] == $.trim($("[posX=1][posY="+$(this).attr('posY')+"]").html())){
						stavka = '5';
					}
				}
				$("[name=stavka]").attr("stavka", stavka);
				calculateStavka();
			};
			$("#shadow").hide(); 
			$("#fr").hide();
		}
		else{
			if($("#action").val() == 'select_sluzhebnaya'){
				alert('<'+$("[class=table1] [posY="+$("#button_pressed").val()+"]").find("td").eq(0).html()+'>');
				if($("[class=table1] [posY="+$("#button_pressed").val()+"]").find("td").eq(0).html() != ''){
					var b = "&indexC="+$("#button_pressed").val();
				}
				else{ var b = ''; };
				alert("indexCounter="+$.trim($("[posX=1][posY="+$(this).attr('posY')+"]").html())+b);
				$.ajax({
					type: "GET",
					url: "pages/sluzhebnie.php",
					data: "indexCounter="+$.trim($("[posX=1][posY="+$(this).attr('posY')+"]").html())+b,
					success: function(html){ 
						$("#content").html(html); 
						$(".table1 col").eq(0).css("width", "10%");
						$(".table1 col").eq(1).css("width", "70%");
						$(".table1 col").eq(2).css("width", "20%");
					}
				});
				$("#shadow").hide(); 
				$("#fr").hide();
			}
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
		window.location.pathname = '';
		return false;
	});
	
	$("body").on("click", "#setvision", function(){
		var a = $("#viewform").serialize();
		$.ajax({
			type: 'POST',
			url: 'pages/view.php',
			data: a
		});
		page = '1';
		loadPage();
		$("#fr").hide();
		$("#shadow").hide();
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
			data: a
		});
		$("#fr").hide();
		$("#shadow").hide();	
		page = '1';
		loadPage();
		return false;
	});
	
	$("body").on("click", "#counteraddbutton", function(){
		var a = $("#formcounter").serialize();
		$.ajax({
			type: "POST",
			url: "pages/counter_add_send.php",
			data: a
		});
		$("#fr").hide();
		$("#shadow").hide();	
		page = '1';
		loadPage();
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
	
	$("#content").on("click", "#open_zayavka", function(){
		var form = $("#formrecord").serialize();
		window.open('pages/zayavka.php?'+form);
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
	
	$("#content").on("click", ".fixed .sortCol", function(){
		if($(this).attr("name") == "DESC"){ $(this).attr("name", "ASC"); }
		else{ $(this).attr("name", "DESC"); };
		filter("sort="+$(this).attr('id')+"&tsort="+$(this).attr('name'));
	});
	
	$("#content").on("click", ".fixed .filterCol", function(){
		if($("[class=filterDiv][id="+$(this).attr("id")+"]").html() == ""){
			$("[class=filterDiv][id="+$(this).attr("id")+"]").html("<input type=text id='"+$(this).attr("id")+"input' class='filterInp width110' onkeyup='filter()'>");
			if($(this).attr("id") == "forma1" || $(this).attr("id") == "forma2"){ 
				$("[class=filterDiv][id="+$(this).attr("id")+"]").html("<select id='"+$(this).attr("id")+"input' class='filterInp width110' onchange='filter()'> <option> ? </option> <option> нал </option> <option> безнал </option> <option> с НДС </option> </select>");
			};
			$("#"+$(this).attr("id")+"input").css("width", "calc("+$(".fixed col").eq($($($("#"+$(this).attr("id")+"input").parent("div")).parent("th")).attr("posX")).css("width")+" - 10px)");
			//alert("calc("+$(".fixed col").eq($($($("#"+$(this).attr("id")+"input").parent("div")).parent("th")).attr("posX")).css("width")+" - 10px)");
			
		}
		else{
			$("[class=filterDiv][id="+$(this).attr("id")+"]").html("");
			filter();
		}
	});
	
	

	
	$("#content").on("click", "#sluzhebnie table td", function(){
		//$("#change_pass").show();
		$("#shadow").show();
		$("#fr").show();
		$.ajax({
			url: "pages/user_options.php",
			success: function(html){ 
			$("#fr").html(html); 
			$("#change_pass [name=login]").val($(".selected[posX=1]").html());
			}
		});
	});

	
	$("#content").on("click", "[name=change_pass_send_button]", function(){
		if($("[name=new_pass]").val() == $("[name=confirm_new_pass]").val() && $("[name=confirm_new_pass]").val() != ''){
		var change_pass = $("#change_pass_form").serialize();
		$.ajax({
			type: "POST",
			url: "pages/sluzhebnie.php",
			data: change_pass,
			success: function(html){ if(html.indexOf("notfind")+1){ alert('Неверный старый пароль'); } else{ $("#content").html(html); }}
		});
		}
		else( alert('Пароли не совпадают или не введены'));
		return false;
		
	});
	
	
	/*-----------------------------*/
	/*-ИЗМЕНЕНИЕ РАЗМЕРОВ СТОЛБЦОВ-*/
	/*-----------------------------*/
	//{
	var indCol = -1;
	var width = 0;
	var x1 = 0;
	var x2 = 0;
	
	$("#content").on("mousedown", ".fixed th", function(){
		width2 = $(".fixed col").eq($(this).attr("posX")).css("width").split('px');
		if((event.which==1)&&((+width2[0]-event.offsetX) <= 10)){
			width = $(".fixed col").eq($(this).attr("posX")).css("width");
			$(this).css("border-right", "3px solid #f00");
			indCol = $(this).attr("posX");
			x1 = event.pageX;
		}
		if(event.which==3){
			return false;
		}
	});

	$("#content").on("mousemove", ".fixed th", function(){
		width2 = $(".fixed col").eq($(this).attr("posX")).css("width").split('px');
		if((+width2[0]-event.offsetX) <= 10){
			$("body").css("cursor", "url('images/resize.cur'), pointer");
		}
		else{
			$("body").css("cursor", "");
		};
	});				
						
	$("body").mousemove(function(){
		if(indCol != -1){
			x2 = event.pageX;
			if((x1-x2) < -5 || (x1-x2) > 5){
				width2 = width.split('px');
				width1 = (+width2[0]+(x2-x1));
				$(".fixed col").eq(indCol).css("width", width1);
				$("#reisi col").eq(indCol).css("width", width1);
			}
		}
	});
	
	$("#content").on("dblclick", ".fixed th", function(){
		width2 = $(".fixed col").eq($(this).attr("posX")).css("width").split('px');
		if((+width2[0]-event.offsetX) <= 10){
			$(".fixed col").eq($(this).attr("posX")).css("width", colWidths[$(this).attr("posX")]);
			$("#reisi col").eq($(this).attr("posX")).css("width", colWidths[$(this).attr("posX")]);
			$(".fixed th").css("border-right", "1px solid #000");
			$("body").css("cursor", "");
			$(".tableData").css({height: $("#content")[0].offsetHeight-$(".fixed")[0].offsetHeight-22});
			$(".tableData").css({width: $(".fixed")[0].offsetWidth+21});
		}
	});
	
	$("body").mouseup(function(){
		if(event.which==1 && indCol != -1){
			x2 = event.pageX;
			if((x1-x2) < -5 || (x1-x2) > 5){
			width1 = width.split('px');
			width2 = (+width1[0]+(x2-x1));
			var i = 0;
			var j = 0;
			indCol++;
			while((indCol) != j){ 
				if(colVisible[i] == '1'){  
					j++; 
				}
				i++; 
			};
			colWidths[i-1] = width2;
			}
			var widthStr = '';
			for(i in colWidths){
					widthStr = widthStr + colWidths[i]+';';
			}
			$.ajax({
				type: "GET",
				url: "pages/setwidth.php",
				data: "widths="+widthStr
				//success: function(html){ $("#content").append(html); }
			})
			indCol = -1
			$(".tableData").css({height: $("#content")[0].offsetHeight-$(".fixed")[0].offsetHeight-22});
			$(".tableData").css({width: $(".fixed")[0].offsetWidth+21});
		}
		if(event.which==3){
			return false;
		}
		$(".fixed th").css("border-right", "1px solid #000");
	});
	
	$("#content").on("selectstart", ".fixed th", function(){ return false; });
	$("body").on("selectstart", function(){ if(width != 0){ return false; }});
	
	//}
});
