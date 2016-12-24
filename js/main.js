var oContainer = document.querySelector("#container"),
	oBtn = oContainer.querySelector("#submit"),
    oTxt = oContainer.querySelector("#text"),
    oStatement = oContainer.querySelector("#statement"),
	oRedPack = oContainer.querySelector("#redpack"),
    oMat = oContainer.querySelector("#mat"),
    oResultMat = oContainer.querySelector("#resultMat");

	
/*
 * 让以下全屏尺寸的元素尺寸变成固定值，保证键盘激活的时候尺寸不会变化
 */
oContainer.style.height = oRedPack.style.height = oMat.style.height = oStatement.style.height = oContainer.offsetHeight + "px";
oContainer.style.width = oRedPack.style.width = oMat.style.width = oStatement.style.width = oContainer.offsetWidth + "px";


/*
 * 结果显示和隐藏的两个函数
 */
var oResult = oResultMat.querySelector("p");
function showResult()
{
    oResult.innerHTML = "正在检测红包码……";
    oResultMat.style.display = "block";
    oResultMat.style.backgroundColor = "rgba(0,0,0,0.5)";
}
function hideResult()
{
    oResultMat.style.display = "none";
    oResultMat.style.backgroundColor = "transparent";
    oResult.innerHTML = "";
    document.removeEventListener("touchend", hideResult);
}


/*
 * 提交兑换码
 */
var bTouched = false;
var xhr = new XMLHttpRequest();
xhr.addEventListener('readystatechange', function(){
	if (xhr.readyState == 4){
		if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304){
			oResult.innerHTML = xhr.responseText;
			document.addEventListener("touchend", hideResult);
		}
		else{
			oResult.innerHTML = "发送失败。网络错误，请返回重试。";
		}
		bTouched = false;
	}
}, false);

oBtn.addEventListener("touchend", function()
{
	if( !bTouched )
	{
		bTouched = true;
		showResult();
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
