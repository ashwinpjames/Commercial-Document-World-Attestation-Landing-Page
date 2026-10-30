<?php
// Hostinger PHP endpoint. Configure CONTACT_TO in the hosting environment or replace the placeholder below.
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['ok'=>false,'message'=>'Method not allowed']); exit; }
function fail($code,$message){http_response_code($code);echo json_encode(['ok'=>false,'message'=>$message]);exit;}
$name=trim((string)($_POST['name']??''));$phone=trim((string)($_POST['phone']??''));$email=trim((string)($_POST['email']??''));$type=trim((string)($_POST['document_type']??''));$message=trim((string)($_POST['message']??''));$honeypot=trim((string)($_POST['website']??''));$consent=(string)($_POST['consent']??'');
if($honeypot!==''){fail(200,'Enquiry received');}
if($name===''||$phone===''||$type===''||$consent!=='yes'){fail(422,'Please complete the required fields and consent.');}
foreach([$name,$phone,$email,$type,$message] as $value){if(preg_match('/[\r\n]/',$value)){fail(400,'Invalid input.');}}
if(strlen($name)>100||strlen($phone)>30||strlen($email)>150||strlen($type)>120||strlen($message)>2000){fail(422,'Input is too long.');}
if($email!==''&&!filter_var($email,FILTER_VALIDATE_EMAIL)){fail(422,'Please enter a valid email address.');}
if(!preg_match('/^[+0-9() .-]{7,30}$/',$phone)){fail(422,'Please enter a valid phone number.');}
// Basic IP rate limit: 5 requests per hour. Ensure this directory is writable on Hostinger.
$ip=$_SERVER['REMOTE_ADDR']??'unknown';$key=hash('sha256',$ip);$dir=sys_get_temp_dir().'/wa-contact-limits';if(!is_dir($dir)){@mkdir($dir,0700,true);}$file=$dir.'/'.$key.'.json';$now=time();$record=['start'=>$now,'count'=>0];if(is_file($file)){$decoded=json_decode((string)file_get_contents($file),true);if(is_array($decoded)&&isset($decoded['start'],$decoded['count'])&&$now-(int)$decoded['start']<3600)$record=$decoded;}
if((int)$record['count']>=5){fail(429,'Please try again later.');}$record['count']++;@file_put_contents($file,json_encode($record),LOCK_EX);
$to=getenv('CONTACT_TO')?:'info@worldattestation.com';$subject='Website enquiry: '.substr($type,0,80);$body="Name: {$name}\nPhone: {$phone}\nEmail: {$email}\nDocument: {$type}\n\nMessage:\n{$message}\n";$host=preg_replace('/[^a-z0-9.-]/i','',$_SERVER['HTTP_HOST']??'worldattestation.com');$headers="From: Website Enquiries <no-reply@{$host}>\r\n";if($email!=='')$headers.='Reply-To: '.$email."\r\n";$headers.="Content-Type: text/plain; charset=UTF-8\r\n";
if(!mail($to,$subject,$body,$headers)){fail(500,'Unable to send enquiry. Please contact us on WhatsApp.');}echo json_encode(['ok'=>true,'message'=>'Enquiry sent']);
