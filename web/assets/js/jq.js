$(document).ready(function(){
	$("a.hideDiv").click(function(){
		$("input.demoDiv").hide(2000); /// 1000 means 1sec
		return false;	
	});	
	
	$("a.showDiv").click(function(){
		$("div.demoDiv").show(2000);
		return false;	
	});

	$("a.slideFadeInDiv").click(function(){
		$("div.demoDiv").fadeIn(2000);
		return false;	
	});

	$("a.slideFadeOutDiv").click(function(){
		$("div.demoDiv").fadeOut(2000);
		return false;	
	});

	$("a.slideDownDiv").click(function(){
		$("div.demoDiv").slideDown(2000, function(){
			$(this).css('background','yellow');
			if($("div.demoDiv").hasClass('alreadyDown')){
				alert('Already Down');
			}
			$("div.demoDiv").removeClass('completed');	
			$("div.demoDiv").addClass('alreadyDown');	
		});
		return false;	
	});

	$("a.slideUpDiv").click(function(){		
		$("div.demoDiv").slideUp(2000);
		if($("div.demoDiv").hasClass('completed')){
			alert('	Already up');		
		}
		$("div.demoDiv").removeClass('alreadyDown');
		$("div.demoDiv").addClass('completed');
		return false;
	});

	$("div.demoDiv").mouseover(function(){
		$(this).css('background','yellow');	
	});

	$("div.demoDiv").mouseout(function(){
		$(this).css('background','blue');	
	});
	
	$("a.showBorder").click(function(){
		$("div.demoDiv").addClass('border');
		//alert($("div.demoDiv").attr('class'));
		return false;	
	});

	$("a.hideBorder").click(function(){
		$("div.demoDiv").removeClass('border');
		return false;	
	});
	
	$("a.hasClass").click(function(){
		if($("div.demoDiv").hasClass('border')){
			alert('This has border class');	
		}else{
			alert('This don\'t have border class');
		}
		return false;	
	});
	
	/*setTimeout(function(){
		$("a.slideUpDiv").trigger('click');
	},2000);*/
	
	$("img.imgClass").click(function(){
		 var src = $(this).attr('src');
		 $("div.showImg img").fadeOut(1000,function(){
		 $("div.showImg img").attr('src',src)
		 		$("div.showImg img").fadeIn(1000);
		});

		if($("div.showImg img").hasClass('completed')){
			alert('Window is Already Active');		
		}
		$("div.showImg img").removeClass('alreadyActive');
		$("div.showImg img").addClass('completed');
		
		return false;
		
	});
	
	$("a.isAnimate").click(function(){
		$("div.demoDiv").animate({left: '250px'},function(){
			$(this).find('div.textClass').animate({top:'20px'});	
		});
		
		return false;
	});
});		 
