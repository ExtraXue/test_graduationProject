// JavaScript Document
document.writeln("<div id=\"footer\">");
document.writeln("<div class=\"footerbox\">");
document.writeln("党建网版权所有 转载请注明来源<br />");
document.writeln("互联网新闻信息服务许可证（1012012002）  信息网络传播视听节目许可证（0112649）<br />");
document.writeln("广告经营许可证：京西工商广字第0455号<br />");
document.writeln("版权所有 Copyright@ 2003-2018 党建网 <a href=\"http://www.miibeian.gov.cn/\">京ICP备17060826号</a><br />");
document.writeln("违法和不良信息举报电话：010-67026927<br />");
document.writeln("技术支持：中国文明网");
document.writeln("</div>");
document.writeln("</div>");
//统计代码
document.write(unescape("%3Cscript id='tr_statobj' src='http://202.123.107.15/webdig.js?z=11' type='text/javascript'%3E%3C/script%3E"));

var obj=document.getElementById("tr_statobj");
if(window.ActiveXObject){
	run();
}
else
	document.write(unescape("%3Cscript type='text/javascript'%3E wd_paramtracker('_wdxid=000000000000000000000000000000000000000000');%3C/script%3E"));

function run(){
	if(obj.readyState=='complete'){
		wd_paramtracker('_wdxid=000000000000000000000000000000000000000000');
	}
	else{
		window.setTimeout(run,50);
	}
}