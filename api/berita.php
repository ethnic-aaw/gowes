<?php header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../includes/config.php';
if(!$pdo){ http_response_code(503); echo json_encode(['error'=>'DB off']); exit; }
$rows=$pdo->query("SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 50")->fetchAll();
echo json_encode($rows, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
