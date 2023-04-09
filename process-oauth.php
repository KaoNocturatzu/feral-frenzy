<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_GET['code'])){
    echo 'no code';
    exit();
}

$discord_code = $_GET['code'];


$payload = [
    'code'=>$discord_code,
    'client_id'=>'1089577834579771590',
    'client_secret'=>'cEl78bWO5zIzcV9Octq5ZvffPtXfIb2e',
    'grant_type'=>'authorization_code',
    'redirect_uri'=>'https://localhost/starmaninja/process-oauth.php',
    'scope'=>'identify%20guids',
];

print_r($payload);

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);
print_r($result);

if(!$result){
    echo curl_error($ch);
}

$result = json_decode($result,true);
$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me/guilds/631820336731783188/member";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);


session_start();

$_SESSION['logged_in'] = true;
$_SESSION['roleValue'] = 0;

// check if Standard Tier
if (in_array(1073434202055397406, $result['roles']) || in_array(1061560163166846988, $result['roles'])) {
    $_SESSION['roleValue'] = 1;
}

// check if Premium Tier
if (in_array(1060698720368341002, $result['roles']) || in_array(957090962310565959, $result['roles'])) {
    $_SESSION['roleValue'] = 2;
}

// check if VIP Tier
if (in_array(1060699632356827248, $result['roles']) || 
    in_array(957071410545688677, $result['roles']) ||
    in_array(790369335096246312, $result['roles']) ||
    in_array(784095600865706034, $result['roles'])) {
    $_SESSION['roleValue'] = 3;
}

header("location: dashboard.php");
exit();