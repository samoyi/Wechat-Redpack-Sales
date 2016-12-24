
<?php
define("UniAppName", $_POST["uniappname"]);
require 'initInfo.php';

$sOpenID = $_POST['OpenID'];
$sRedPackCode = $_POST['ResPacketCode'];
function isResPacketCode($str)
{
	$str = trim($str);
	$re = "/^[A-Za-z][A-Za-z0-9]{8}$/";
	return preg_match($re, $str);
}

if( isResPacketCode($sRedPackCode) )
{
	$nRedPackErrorCode = 0;
	$sRedPackCode = trim($sRedPackCode);
	
	require "mysql_check_code.php";
	$WXredPack  = new WXredPacket($sRedPackCode, $sOpenID, UniAppName);
	$nCodeStatus = $WXredPacket->redPacket();
	
	switch($nCodeStatus)
	{
		case 2:
		{
			echo "很遗憾，没有中奖哦！";
			break;
		}
		case 3:
		{
			echo "红包码已使用，<br />请重新购买以获得有效的字符。";
			break;
		}
		case 4:
		{
			echo "输入错误，请输入正确的字符。";
			break;
		}
		case 5:
		{
			echo "兑换失败。<br />兑换码输入错误次数过多";
			break;
		}
		default:
		{	
			if( gettype($nCodeStatus) === "integer" )
			{	
				require "RedPack.class.php";
                $RedPack = new RedPack;
                $result = $RedPack->sendOrdinaryRedPack($sOpenID, $nCodeStatus);
				
				if($result){   
					echo "领取成功，请返回拆红包。";
				}
				else{
					echo "很遗憾，没有中奖哦！！"; // post ssl 或 红包参数导致的失败
				}
			}
			else
			{
				echo  "很遗憾，没有中奖哦！！！"; // 查询数据库时异常返回导致的失败
			}
		}
	}
}
else
{
	echo '兑奖码输入错误';
}
?>