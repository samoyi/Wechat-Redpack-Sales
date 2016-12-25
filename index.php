<?php
    define("UniAppName", $_GET["uniappname"]); // 用来区别是从哪个公众号来的
    require "getOpenID.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>微信红包</title>
</head>
<body>
    <input id="text" type="text" placeholder="输入9位红包码" />
    <input id="submit" type="button" value="兑奖" />
    <p id="status"></p>
</body>
<script>
var sOpenID = <?php echo json_encode($sOpenID); ?>,
    sUniappname = <?php echo json_encode(UniAppName); ?>;
</script>
       <script src="js/main.js"></script>
       </html>