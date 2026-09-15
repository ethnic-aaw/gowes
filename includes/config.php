<?php
// DB — baca env (Docker) fallback XAMPP
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'mgc_gowes');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('BASE_URL', getenv('BASE_URL') !== false ? getenv('BASE_URL') : '/gowes');
define('SITE_NAME','MGC — Manggar Gowes Community');
define('WA_LINK','https://wa.me/6281234567890?text=Halo%20MGC%20mau%20gabung%20gowes');

$pdo=null;$db_ok=false;
try{
  $pdo=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
  ]);
  $db_ok=true;
}catch(Throwable $e){ $pdo=null; $db_ok=false; }

if(session_status()===PHP_SESSION_NONE) session_start();
function csrf_token(){ if(empty($_SESSION['_csrf'])) $_SESSION['_csrf']=bin2hex(random_bytes(16)); return $_SESSION['_csrf']; }
function csrf_check($t){ return hash_equals($_SESSION['_csrf']??'', $t??''); }
