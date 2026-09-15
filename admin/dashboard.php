<?php require_once __DIR__.'/../includes/config.php'; require_once __DIR__.'/../includes/functions.php'; require_login();
$ck=0;$cb=0;$cg=0; if($pdo){ try{$ck=$pdo->query("SELECT COUNT(*) FROM kegiatan")->fetchColumn(); $cb=$pdo->query("SELECT COUNT(*) FROM berita")->fetchColumn(); $cg=$pdo->query("SELECT COUNT(*) FROM galeri")->fetchColumn();}catch(Throwable $e){}}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard — MGC Admin</title><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-[#F6F7F4] min-h-screen">
<div class="max-w-5xl mx-auto p-4 md:p-6 space-y-6">
<div class="flex items-center justify-between"><h1 class="text-2xl font-extrabold text-[#0B3D2E]">Dashboard</h1><div class="flex gap-2 items-center"><span class="text-sm text-zinc-600"><?=e($_SESSION['admin_nama'])?></span><a href="<?=BASE_URL?>/admin/logout.php" class="px-4 py-2 rounded-full bg-white border text-sm font-bold">Logout</a></div></div>
<div class="grid grid-cols-3 gap-4">
<div class="bg-white rounded-2xl p-5 shadow"><div class="text-sm text-zinc-500">Kegiatan</div><div class="text-3xl font-extrabold"><?=$ck?></div><a href="<?=BASE_URL?>/admin/kegiatan.php" class="text-sm font-bold text-[#FF6B2B]">Kelola →</a></div>
<div class="bg-white rounded-2xl p-5 shadow"><div class="text-sm text-zinc-500">Berita</div><div class="text-3xl font-extrabold"><?=$cb?></div><a href="<?=BASE_URL?>/admin/berita.php" class="text-sm font-bold text-[#FF6B2B]">Kelola →</a></div>
<div class="bg-white rounded-2xl p-5 shadow"><div class="text-sm text-zinc-500">Galeri</div><div class="text-3xl font-extrabold"><?=$cg?></div><a href="<?=BASE_URL?>/admin/galeri.php" class="text-sm font-bold text-[#FF6B2B]">Kelola →</a></div>
</div>
<div class="bg-white rounded-2xl p-5 shadow flex flex-wrap gap-2">
<a href="<?=BASE_URL?>/admin/kegiatan.php" class="px-5 py-3 rounded-xl bg-[#0B3D2E] text-white font-bold">+ Kegiatan</a>
<a href="<?=BASE_URL?>/admin/berita.php" class="px-5 py-3 rounded-xl bg-[#FF6B2B] text-white font-bold">+ Berita</a>
<a href="<?=BASE_URL?>/admin/galeri.php" class="px-5 py-3 rounded-xl bg-white border font-bold">+ Galeri</a>
<a href="<?=BASE_URL?>/index.php" target="_blank" class="px-5 py-3 rounded-xl bg-white border font-bold">Lihat website →</a>
</div>
<?php if(!$pdo): ?><div class="p-4 rounded-xl bg-amber-50 text-amber-800 text-sm">DB belum terhubung — import <code>sql/schema.sql</code> & <code>seed.sql</code> via phpMyAdmin. CRUD tetap jalan setelah DB aktif.</div><?php endif; ?>
</div></body></html>
