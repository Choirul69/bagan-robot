<?php
@error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
system("clear");
while("ttue"){
echo " \033[1;97mUntuk Melanjutkan Ketik \033[1;91m[\033[1;92m1\033[1;91m]\n";
echo " \033[1;97mUntuk Ganti Akun Ketik  \033[1;91m[\033[1;92m2\033[1;91m]\n";
echo " \033[1;97mExit Ketik              \033[1;91m[\033[1;92m3\033[1;91m]\n";
echo "          \033[1;90mInput Pilihan : \033[1;92m";
$tt = trim(fgets(STDIN));
echo "\n";
if($tt=="3"){
echo " \033[1;92mBerhasil Stop Bot \n";
exit;
}
if($tt==""){
echo " \033[1;91mScript Terhenti \n";
break;
}
if($tt=="1"){
if (!file_exists("config.json")){
echo " \033[1;97mInput Nomor HP    \033[1;90m: \033[1;91m+62";
$api["NoHP"] = trim(fgets(STDIN));
echo " \033[1;97mInput Password    \033[1;90m: \033[100m\033[1;90m";
$api["Pass"] = trim(fgets(STDIN));
echo "\033[0m";
system("clear");
file_put_contents('config.json', json_encode($api, JSON_PRETTY_PRINT));
}
while("true"){
$NoHP = json_decode(file_get_contents("config.json"), true)["NoHP"];
$Pass = json_decode(file_get_contents("config.json"), true)["Pass"];

//while("true"){
system("clear");
$ua[]="Host: api.online2015.com";
$ua[]="user-agent: Mozilla/5.0 (Linux; Android 10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Mobile Safari/537.36";
$ua[]="content-type: application/json;charset=UTF-8";
$ua[]="accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
echo "\033[100m";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"account":"62'.$NoHP.'","password":"'.$Pass.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$login=$json->msg;
$token=$json->data->token;
echo "\033[1;92m".$login."\r";
sleep(3);
//echo $token."\n";
if($login=="Username dan password salah"){
exit;
}

$ua[]="authori-zation: Bearer $token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/user");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$name=$json->data->nickname;
$hp=$json->data->phone;
$dana=$json->data->now_money;
$poin=$json->data->integral;
echo " \033[1;97mNickname \033[1;91m[\033[1;92m".$name."\033[1;91m]\n";
echo " \033[1;97mNomor HP \033[1;91m[\033[1;97m+\033[1;92m".$hp."\033[1;91m]\n";
echo " \033[1;97mSaldo    \033[1;91m[\033[1;96mRp\033[1;92m".$dana."\033[1;91m]\n";
echo " \033[1;97mPoin     \033[1;91m[\033[1;92m".$poin."\033[1;91m]\n\n";

echo " \033[1;97mBet \033[1;96mRp5.000 \033[1;97mKetik \033[1;92m1 \033[1;90matau \033[1;97mBet \033[1;96mRp10.000 \033[1;97mKetik \033[1;92m2 \033[1;91m: \033[1;92m";
$bet = trim(fgets(STDIN));
echo "\n";
if($bet==""){
echo " \033[1;91mScript Terhenti \n";
exit;
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/cart/add");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"productId":"34","cartType":"Custom","cartNum":'.$bet.',"new":1,"uniqueId":""}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$car=$json->data->cartId;
echo $car."\r";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/confirm");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"cartId":"'.$car.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$key=$json->data->orderKey;
//echo $key."\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/computed/$key");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"useIntegral":0,"couponId":0,"shipping_type":1}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$pay=$json->data->result->total_price;
echo " \033[1;92mTotal Pembayaran \033[1;96mRp".$pay."  \n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/create/$key");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"real_name":"","phone":"","useIntegral":0,"couponId":0,"payType":"yue","pinkId":0,"seckill_id":0,"combinationId":0,"bargainId":0,"from":"weixinh5","mark":"","shipping_type":1}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$msg=$json->msg;
$oid=$json->data->result->orderId;
echo " \033[1;97mStatus \033[1;92m".$msg."\n\n";
//echo " ".$oid."\n";

echo " \033[1;97mGENAP  Pilih \033[1;92m0   \n";
echo " \033[1;97mGANJIL Pilih \033[1;92m1   \n";
echo " \033[1;97mInput Pilihan :\033[1;92m ";
$odd = trim(fgets(STDIN));
echo "\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/guess_odd/saveOrder");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"order_id":"'.$oid.'","guess":'.$odd.'}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$msg=$json->msg;
echo " \033[1;92m".$msg."\n";

while("true"){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/detail/$oid");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$msg=$json->data->_game_state;
echo " \033[1;92m".$msg."\r";
if($msg=="Promosi gagal"){
break;
}
if($msg=="Is not on sales yet"){
exit;
}
if($msg=="Promosi sukses"){
break;
}
}

if($msg=="Promosi sukses"){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/game_refund");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"order_id":"'.$oid.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$msg=$json->msg;
echo " ".$msg."  \n";
echo "\033[0m";
//sleep(3);
//exit;
//system("clear");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"account":"62'.$NoHP.'","password":"'.$Pass.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$login=$json->msg;
$token=$json->data->token;
echo "\033[1;92m".$login."\r";
//sleep(3);
//echo $token."\n";
if($login=="Username dan password salah"){
exit;
}

$ua[]="authori-zation: Bearer $token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/user");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$name=$json->data->nickname;
$hp=$json->data->phone;
$dana=$json->data->now_money;
$poin=$json->data->integral;
//echo " \033[1;97mNickname \033[1;91m[\033[1;92m".$name."\033[1;91m]\n";
//echo " \033[1;97mNomor HP \033[1;91m[\033[1;97m+\033[1;92m".$hp."\033[1;91m]\n";
echo " \033[1;97mSaldo    \033[1;91m[\033[1;96mRp\033[1;92m".$dana."\033[1;91m]\n";
echo " \033[1;97mPoin     \033[1;91m[\033[1;92m".$poin."\033[1;91m]    \n\n";
exit;
}

if($msg=="Promosi gagal"){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/order/game_integral");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"order_id":"'.$oid.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$msg=$json->msg;
echo " ".$msg."      \n";
//sleep(3);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data='{"account":"62'.$NoHP.'","password":"'.$Pass.'"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$login=$json->msg;
$token=$json->data->token;
echo "\033[1;92m".$login."\r";
//sleep(3);
//echo $token."\n";
if($login=="Username dan password salah"){
exit;
}

$ua[]="authori-zation: Bearer $token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
"https://api.online2015.com/api/user");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
$res = curl_exec($ch);
$json=json_decode($res);
$name=$json->data->nickname;
$hp=$json->data->phone;
$dana=$json->data->now_money;
$poin=$json->data->integral;
//echo " \033[1;97mNickname \033[1;91m[\033[1;92m".$name."\033[1;91m]\n";
//echo " \033[1;97mNomor HP \033[1;91m[\033[1;97m+\033[1;92m".$hp."\033[1;91m]\n";
echo " \033[1;97mSaldo    \033[1;91m[\033[1;96mRp\033[1;92m".$dana."\033[1;91m] ";
echo " \033[1;97mPoin     \033[1;91m[\033[1;92m".$poin."\033[1;91m]    \n\n";

exit;
//system("clear");
}
}
}
if($tt=="2"){
system("rm config.json");
echo " \033[1;92mBerhasil Menghapus data, Silahkan Jalankan Ulang \n";
break;
}
}
