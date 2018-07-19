<!--Login & Register-->
$(document).ready(function(){
			$("div.showReg").hide(); 
			$("a.openReg").click(function(){
			$("div.showReg").show(500); 
			$("div.hideLog").hide(500);/// 1000 means 1sec
			return false;	
			});
			$("a.openLog").click(function(){
			$("div.hideLog").show(500);/// 1000 means 1sec	
			$("div.showReg").hide(500); 
			return false;	
			});
			
			$("div.showThis").hide();
			$("a.openFor").click(function(){
			$("div.showThis").toggle(500);/// 1000 means 1sec	
			return false;	
			});
		});
		$(document).ready(function(){
	 $("#fade").hide(0);
	setInterval(function(){
        $("#fade").fadeIn(1000);
    }, 0);
		return false;	
	});