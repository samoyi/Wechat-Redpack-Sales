
<?php
/*
 * 这个文件会引入一个mysql_check_code.php类，并调用该类的两个方法：
 * 1. checkRedPackCode
 */

/*
 TODO  确保只有在真正合适的时候才在数据库里让该红包码用过


*/
echo 2233;
exit;
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

	if( gettype($nCodeStatus) === "integer" && if( $nCodeStatus>0 ) )
	{


	}
	switch($nCodeStatus)
	{
		case 2:
		{
			echo "没有中奖";
			break;
		}
		case 3:
		{
			echo "红包码已使用";
			break;
		}
		case 4:
		{
			echo "输入错误";
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
					echo "领取成功";
				}
				else{
					echo "很遗憾，没有中奖哦！！"; // post ssl 或 红包参数导致的失败
				}
			}
			else
			{
				echo  "红包码查询异常"; // 查询数据库时异常返回导致的失败
			}
		}
	}
}
else
{
	echo '兑奖码输入错误';
}
?>