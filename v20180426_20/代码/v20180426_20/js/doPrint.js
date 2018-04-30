// JavaScript Document

function doZoom(size,content){
    document.getElementById(content).style.fontSize=size+'px';
}

function doPrint(vTitle,vTime,vContent)
{
    var Title = document.getElementById(vTitle).innerHTML;
    var Time = document.getElementById(vTime).innerHTML;
    var Position =""; //= document.all.Position.innerHTML;
    var mContent = document.getElementById(vContent).innerHTML;
    var Images = ""; //document.all.Image.innerHTML;
    var PartI = ' \
<style type="text/css"><!-- \
p { \
padding-top:10px; \
} \
.print-font16 { \
line-height:30px; \
font-size:16px; \
} \
--></style><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bordercolor="#C50C11" > \
 <tr>  <td bgcolor="#C50C11" color="#FFF" width="600" style="color: #fff;"><b><font class="font-family: 宋体 ;font-size: 12px; color:#fff; line-height:20px;"  style="color: #fff;">欢迎访问党建网</font>  <font face="Verdana, Arial, Helvetica, sans-serif" size="1" style="color: #fff;"> - www.dangjian.com</font></b> </td> \
 </tr>  <tr bgcolor="#EAEAEA">     <td class="p9" colspan="6">       <div align="right"><font color="#000000"> ';

    var PartII = Position+'<font size="1"><b>&gt;&gt;</b></font></font></div>    </td>  </tr>  <tr><td colspan="6">      <hr size="1" noshade>    </td></tr>  <tr valign="top" align="left"> \
    <td colspan="6" class="print-font16">       <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="main">        <tr>           <td>  ';

    var PartIII= '<div align="center"><b>'+Title+'</b></div>';
    var Part4='</td></tr><tr><td> <div align="center" class="p9">'+Time+'</div>';
    var Part5='</td></tr><tr><td color="#FFF" align="center">'+Images+'</td></tr><tr> <td>'+mContent+'</td></tr></table> </td></tr> <tr> <td colspan="6">      <hr noshade size="1"></td>  </tr>  <tr>     <td bgcolor="#C50C11" colspan="6">       <div align="right" class="p9"><b><font face="宋体" font-size="12px" style="line-height:20px; color: #fff;">党建网版权所有</b></font></div> </td>  </tr></table>';
    document.body.innerHTML = PartI+PartII+PartIII+Part4+Part5;
    window.print();
}
