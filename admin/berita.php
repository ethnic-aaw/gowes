<?php require_once __DIR__.'/../includes/config.php'; require_once __DIR__.'/../includes/functions.php'; require_login();
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='delete' && csrf_check($_POST['_csrf']??'')){
  $id=(int)$_POST['id']; if($pdo) $pdo->prepare("DELETE FROM berita WHERE id=?")->execute([$id]); $msg='Berita dihapus.';
}
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='save' && csrf_check($_POST['_csrf']??'')){
  $judul=trim($_POST['judul']??''); $kategori=trim($_POST['kategori']??'Umum'); $isi=$_POST['isi']??''; $tgl=$_POST['tanggal_publish']??date('Y-m-d');
  $thumb=null; if(!empty($_FILES['thumb']['tmp_name'])) $thumb=upload_image($_FILES['thumb']);
  $slug=slugify($judul).'-'.date('His');
  if($judul && $pdo){
    if($thumb) $pdo->prepare("INSERT INTO berita(judul,slug,kategori,isi,thumbnail,tanggal_publish,admin_id) VALUES(?,?,?,?,?,?,?)")->execute([$judul,$slug,$kategori,$isi,$thumb,$tgl,$_SESSION['admin_id']]);
    else $pdo->prepare("INSERT INTO berita(judul,slug,kategori,isi,tanggal_publish,admin_id) VALUES(?,?,?,?,?,?)")->execute([$judul,$slug,$kategori,$isi,$tgl,$_SESSION['admin_id']]);
    $msg='Berita ditambahkan.';
  } elseif($judul) $msg='DB belum aktif.';
}
$rows=[]; if($pdo) try{ $rows=$pdo->query("SELECT * FROM berita ORDER BY tanggal_publish DESC")->fetchAll(); }catch(Throwable $e){}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Kelola Berita — MGC</title><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-[#F6F7F4] min-h-screen">
<div class="max-w-5xl mx-auto p-4 md:p-6 space-y-6">
<div class="flex items-center justify-between"><h1 class="text-xl font-extrabold text-[#0B3D2E]">Kelola Berita</h1><a href="<?=BASE_URL?>/admin/dashboard.php" class="px-4 py-2 rounded-full bg-white border text-sm font-bold">← Dashboard</a></div>
<?php if($msg): ?><div class="p-3 rounded-xl bg-emerald-50 text-emerald-800 text-sm"><?=e($msg)?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data" class="bg-white rounded-2xl p-5 shadow space-y-3">
<input type="hidden" name="act" value="save"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>">
<div class="grid md:grid-cols-2 gap-3">
<input name="judul" required placeholder="Judul berita" class="px-4 py-3 rounded-xl border">
<input name="kategori" placeholder="Kategori (Umum/Prestasi/Tips)" class="px-4 py-3 rounded-xl border" value="Umum">
<input name="tanggal_publish" type="date" required value="<?=date('Y-m-d')?>" class="px-4 py-3 rounded-xl border">
<input name="thumb" type="file" accept="image/*" class="px-4 py-3 rounded-xl border bg-white">
</div>
<textarea name="isi" rows="5" placeholder="Isi berita (boleh pakai <p> <strong> <a>)..." class="w-full px-4 py-3 rounded-xl border"></textarea>
<button class="px-6 py-3 rounded-xl bg-[#FF6B2B] text-white font-bold">Publish Berita</button>
</form>
<div class="bg-white rounded-2xl shadow overflow-hidden">
<table class="w-full text-sm"><tr class="bg-zinc-50 text-left"><th class="p-3">Judul</th><th class="p-3">Kategori</th><th class="p-3">Tanggal</th><th class="p-3"></th></tr>
<?php foreach($rows as $r): ?><tr class="border-t"><td class="p-3 font-medium"><?=e($r['judul'])?></td><td class="p-3"><?=e($r['kategori'])?></td><td class="p-3"><?=e($r['tanggal_publish'])?></td><td class="p-3"><form method="post" onsubmit="return confirm('Hapus?')"><input type="hidden" name="act" value="delete"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="id" value="<?=$r['id']?>"><button class="text-red-600 font-bold">Hapus</button></form></td></tr><?php endforeach; if(!$rows): ?><tr><td colspan="4" class="p-6 text-center text-zinc-500">Belum ada data.</td></tr><?php endif; ?>
</table>
</div>
</div></body></html>
