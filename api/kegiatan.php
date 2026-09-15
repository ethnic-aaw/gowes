<?php header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../includes/config.php';
if(!$pdo){ http_response_code(503); echo json_encode(['error'=>'DB off']); exit; }
$tahun=$_GET['tahun']??'';
if($tahun!=='' && ctype_digit($tahun)){ $s=$pdo->prepare("SELECT * FROM kegiatan WHERE YEAR(tanggal)=? ORDER BY tanggal DESC"); $s->execute([$tahun]); $rows=$s->fetchAll(); }
else $rows=$pdo->query("SELECT * FROM kegiatan ORDER BY tanggal DESC LIMIT 50")->fetchAll();
echo json_encode($rows, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
