﻿function loadPage(page){
	$.ajax({
		url: 'pages/'+page+'.php',
		success: function(html){
			$("#content").html(html);
		}
	})
};

jQuery(document).ready(function($){
	
	$("#menu ul li ul").hide();
	
	var page = "main";
	loadPage(page);
	
	/*$("a").click(
	function(){
		page = $(this).attr("href");
		loadPage(page);
		return false;
	});*/
	
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
		$("ul", this).slideUp("fast");
	});
	
	$("#reisi td").click(
	function(){ 
	$("#reisi td").css("border-color", "black")
	$("#reisi td").attr("class", "cell")
	$(this).css("border-color", "red") 
	$(this).attr("class", "cell selected");
	});
	
	$(document).keyup(function(event){
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
		return false;
	});
	
	$("#footer").click(function(){
		$("iframe").show();
	});
});