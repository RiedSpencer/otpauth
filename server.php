<?php
//生成otp auth密钥

require_once('GoogleAuthenticator.php');
require_once('sqlite.php');
$ga = new PHPGangsta_GoogleAuthenticator();
$tag = 'blog.raoye.me';
$db = new Mydb();
session_start();

//得到二维码图片
function getqr($ga,$tag){
	//创建一个新的"安全密匙SecretKey"
	//把本次的"安全密匙SecretKey" 入库,和账户关系绑定,客户端也是绑定这同一个"安全密匙SecretKey"
	$secret = $ga->createSecret();
	$_SESSION['secret'] = $secret;//保存session  等注册的时候进行绑定
	$qrCodeUrl = $ga->getQRCodeGoogleUrl($tag, $secret); //第一个参数是"标识",第二个参数为"安全密匙SecretKey" 生成二维码信息
	return $qrCodeUrl;
}

//注册函数   生成安全密钥和二维码图片
function register($uname,$pswd,$db,$ga){
	//1.先判断是否已经存在该账户
	//2.进行账户和密钥
	$key = $_SESSION['secret'];
	$sql = "select * from CUS where name = '".$uname."'";
	$res = $db->query($sql);
	if(!$res->fetchArray()){
		//代表没有该账户
		$sql = "insert into CUS(name,key) values ('".$uname."','".$key."')";
		$res = $db->query($sql);
		//其中的4  代表 4*30s 有2min的时间容错
		$checkResult = $ga->verifyCode($key, $pswd,4);
		if($checkResult){
			//代表验证通过
			echo "success";
		}else{
			echo "OTP is wrong";
		}

	}else{
		echo "The username have been registered,please change a name or just login in";
	}

}

function login($uname,$pswd,$db,$ga){
	//1、判断是否存在该uname
	//2、根据uname得到secreat进行校验
	$sql = "select * from CUS where name = '".$uname."'";
	$res = $db->query($sql);
	$row = $res->fetchArray();
	if(!$row){
		//代表没有该账户
		echo "This account isn't exist,please register first";
	}else{
		$key = $row['key'];

		$checkResult = $ga->verifyCode($key, $pswd,4);
		if($checkResult){
			//代表验证通过
			echo "success";
		}else{
			echo "OTP is wrong";
		}
	}
}


$type = $_GET['type'];
switch ($type) {
	case 'getqr':
		$res = getqr($ga,$tag);
		break;

	case 'register':
		$uname = $_GET['uname'];
		$pswd = $_GET['pswd'];
		$res = register($uname,$pswd,$db,$ga);
		break;

	case 'login':
		$uname = $_GET['uname'];
		$pswd = $_GET['pswd'];
		$res = login($uname,$pswd,$db,$ga);
		break;
	
	default:
		$res = "what's wrong with u ?";
		break;
}

echo $res;
