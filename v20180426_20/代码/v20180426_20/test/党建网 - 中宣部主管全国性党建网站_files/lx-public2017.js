// 图片滚动
$(function(){
	 $(".foucua01").slide({ titCell:".num" , mainCell:".slides_item01" , effect:"fold", autoPlay:true, delayTime:1000 , autoPage:true ,interTime:5000});//delayTime:效果速度//effect：效果的展现形式
})

// 字体大小
$(function(){
			$('.miner').css('color','#c50c11');
			$('.bigger').click(function(){
				$('.lx-box1').css('font-size','20px');
				$('.dy b').eq(0).css('color','#c50c11').siblings('b').css('color','')
			});
			$('.miner').click(function(){
				$('.lx-box1').css('font-size','16px');
				$('.dy b').eq(1).css('color','#c50c11').siblings('b').css('color','')
			});
			$('.smaller').click(function(){
				$('.lx-box1').css('font-size','12px');
				$('.dy b').eq(2).css('color','#c50c11').siblings('b').css('color','')
			})
		})
	
						