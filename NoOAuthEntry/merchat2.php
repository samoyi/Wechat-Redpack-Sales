<?php
/*
 * 该公众号授权回调域名被占用的情况下，当前文件为用户进入领红包的入口
 * 如果域名占用者有固定的OpenID请求格式，可能需要对本文件稍作修改
 */
 
// 占用授权回调域名下的一个OpenID请求接口
/*
 * 从本项目
 */
$sGetOpenIDUrl = 'www.merchat2Domain.com/RedPack/getOpenID.php';


/*
 * 要求 $sGetOpenIDUrl 在接到请求后，获取$sReceiveOpenIDUrl，并引导用户进行授权以获得OpenID
 * 以“openid”为参数名，获得OpenID为参数值，使用GET方法发送到 $sReceiveOpenIDUrl
 */
$sReceiveOpenIDUrl = 'http://www.funca.org/redChoco/getOpenIDandResponseFormpage.php?uniappname=merchat2';


$sFetchOpenIDUrlWithArg = $sFetchOpenIDUrl . '?receiveOpenIDUrl=' . urlencode($sReceiveOpenIDUrl); 

header("location: $sFetchOpenIDUrlWithArg");

?>

   