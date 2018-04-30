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