var oTxt = document.querySelector("#text"),
	oSubmit = document.querySelector("#submit"),
    oStatus = document.querySelector("#status");


/*
 * 提交兑换码
 */

var xhr = new XMLHttpRequest();
xhr.addEventListener('readystatechange', function(){
	if (xhr.readyState == 4){
		if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304){
			oStatus.innerHTML = xhr.responseText;
		}
		else{
			oStatus.innerHTML = "发送失败。网络错误，请返回重试。";
		}
		bTouched = false;
	}
}, false);

var bTouched = false;
oSubmit.addEventListener("touchend", function()
{
	if( !bTouched ){
		bTouched = true;
		oStatus.innerHTML = "正在检测红包码……";
		var sRedPackCode = oTxt.value.trim();
		xhr.open("post", "handleRedPackDraw.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		var data =  "OpenID=" + sOpenID + "&ResPacketCode=" + sRedPackCode + "&uniappname=" + sUniappname;
		xhr.send(data);
	}
});


/*
 * 禁止搓动屏幕
 */
document.addEventListener("touchmove",function(ev){
    ev.preventDefault();
});
