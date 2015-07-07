var page = '';
function loadPage(){
	if(("#"+page != location.hash)&&(location.hash != "")){
		page = location.hash;
		page = page.replace("#", "");
		$.ajax({
			url: 'pages/'+page+'.php',
			success: function(html){
				$("#content").html(html);
			}
		});
	}
};

function headerLogButton(){
//$('#inpsession').val("$_SESSION['userid']");
if($('#inpsession').val() != ''){ $('#header p a').hide(); $("#logout_button").show(); }
	else{ $('#header p a').show(); $("#logout_button").hide(); }
}

jQuery(document).ready(function($){
	
	setInterval("loadPage()", 250);
	
	$("#menu ul li ul").hide();
	headerLogButton();
	$("a").click(function(){
		if($(this).attr("href") != ""){
			loadPage();
		};
	});
	
	$("#content").on("click","#add",function(){
		$.ajax({
			type: "POST",
			url: "pages/main.php",
			data: "number="+$("#number").val(),
			success: function(html){
				$("#content").html(html);
			}
		});
		return false;
	});
	
	$("#logo").hover(
	function(){ $(this).attr('src', 'images/logo_hover.png'); },
	function(){ $(this).attr('src', 'images/logo.png'); }
	);
	
	$("#header p a").hover(
	function(){ $(this).css("background-image", "url(images/button_hover.png)"); },
	function(){ $(this).css("background-image", "url(images/button.png)"); }
	);
	
	$("#menu ul li").hover(
	function(){ 
		$("ul", this).slideDown("fast");
	},
	function(){
		$("ul", this).hide();
	});
	
	$("#reisi td").click(
	function(){ 
		$("#reisi td").css("border-color", "black")
		$("#reisi td").attr("class", "cell")
		$(this).css("border-color", "red") 
		$(this).attr("class", "cell selected");
	});
	
	$(document).keyup(function(event){
		if((event.keyCode > 36)&&(event.keyCode < 41)){
		cell = $(".selected");
		cellXY = cell.attr("id").split("x");
		if(event.keyCode == 37){
			if(cellXY[0] > 1){
			cell.css("border-color", "black");
			cell.attr("class", "cell");
			str = '#'+(parseInt(cellXY[0])-1)+'x'+(cellXY[1]);
			$(str).css("border-color", "red");
			$(str).attr("class", "cell selected");
			}
		}
		
		if(event.keyCode == 38){
			if(cellXY[1] > 1){
			cell.css("border-color", "black");
			cell.attr("class", "cell");
			str = '#'+(cellXY[0])+'x'+(parseInt(cellXY[1])-1);
			$(str).css("border-color", "red"); 
			$(str).attr("class", "cell selected");
			}
		}
		
		if(event.keyCode == 39){
			cell.css("border-color", "black");
			cell.attr("class", "cell");
			str = '#'+(parseInt(cellXY[0])+1)+'x'+(cellXY[1]);
			$(str).css("border-color", "red"); 
			$(str).attr("class", "cell selected");
		}
		
		if(event.keyCode == 40){
			cell.css("border-color", "black");
			cell.attr("class", "cell");
			str = '#'+(cellXY[0])+'x'+(parseInt(cellXY[1])+1);
			$(str).css("border-color", "red"); 
			$(str).attr("class", "cell selected");
		}
		event.keyCode = '';
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
	
	$("#shadow").click(function(){ $("#shadow").hide(); $("#fr").hide(); });
	
	$(document).keyup(function(event){
		$("#counters").append($("#search").val()+'<br>');
	});
	
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
});