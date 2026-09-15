<?php require_once __DIR__.'/../includes/config.php'; require_once __DIR__.'/../includes/functions.php'; require_login();
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='delete' && csrf_check($_POST['_csrf']??'')){
  $id=(int)$_POST['id']; if($pdo) $pdo->prepare("DELETE FROM galeri WHERE id=?")->execute([$id]); $msg='Foto dihapus.';
}
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='save' && csrf_check($_POST['_csrf']??'')){
  $kegiatan_id=$_POST['kegiatan_id']!==''?(int)$_POST['kegiatan_id']:null; $caption=trim($_POST['caption']??'');
  $url=$_POST['url_foto']??''; $file=null;
  if(!empty($_FILES['foto']['tmp_name'])){ $fn=upload_image($_FILES['foto']); if($fn) $url=$fn; }
  if($url && $pdo){ $pdo->prepare("INSERT INTO galeri(kegiatan_id,url_foto,caption) VALUES(?,?,?)")->execute([$kegiatan_id,$url,$caption]); $msg='Foto ditambahkan.'; }
  elseif($url) $msg='DB belum aktif.';
}
$rows=[]; $keg=[]; if($pdo){ try{ $rows=$pdo->query("SELECT g.*,k.judul FROM galeri g LEFT JOIN kegiatan k ON k.id=g.kegiatan_id ORDER BY g.id DESC")->fetchAll(); $keg=$pdo->query("SELECT id,judul FROM kegiatan ORDER BY tanggal DESC")->fetchAll(); }catch(Throwable $e){} }
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Galeri — MGC</title><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-[#F6F7F4] min-h-screen">
<div class="max-w-5xl mx-auto p-4 md:p-6 space-y-6">
<div class="flex items-center justify-between"><h1 class="text-xl font-extrabold text-[#0B3D2E]">Kelola Galeri</h1><a href="<?=BASE_URL?>/admin/dashboard.php" class="px-4 py-2 rounded-full bg-white border text-sm font-bold">← Dashboard</a></div>
<?php if($msg): ?><div class="p-3 rounded-xl bg-emerald-50 text-emerald-800 text-sm"><?=e($msg)?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data" class="bg-white rounded-2xl p-5 shadow space-y-3">
<input type="hidden" name="act" value="save"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>">
<div class="grid md:grid-cols-2 gap-3">
<select name="kegiatan_id" class="px-4 py-3 rounded-xl border"><option value="">— Tanpa kegiatan —</option><?php foreach($keg as $k): ?><option value="<?=$k['id']?>"><?=e($k['judul'])?></option><?php endforeach; ?></select>
<input name="caption" placeholder="Caption (opsional)" class="px-4 py-3 rounded-xl border">
<input name="foto" type="file" accept="image/*" class="px-4 py-3 rounded-xl border bg-white">
<input name="url_foto" placeholder="atau URL foto https://..." class="px-4 py-3 rounded-xl border">
</div>
<button class="px-6 py-3 rounded-xl bg-[#0B3D2E] text-white font-bold">Upload</button>
<p class="text-xs text-zinc-500">Upload file (max 3MB, auto-resize 1280px) atau isi URL.</p>
</form>
<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
<?php foreach($rows as $r): ?>
<div class="bg-white rounded-2xl overflow-hidden shadow"><img src="<?=e(img_url($r['url_foto']))?>" alt="" class="aspect-[4/3] w-full object-cover"><div class="p-3 text-xs"><div class="font-bold truncate"><?=e($r['caption']?:$r['judul']??'—')?></div><form method="post" onsubmit="return confirm('Hapus foto?')"><input type="hidden" name="act" value="delete"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="id" value="<?=$r['id']?>"><button class="text-red-600 font-bold mt-1">Hapus</button></form></div></div>
<?php endforeach; if(!$rows): ?><div class="col-span-full text-center text-zinc-500 py-8">Belum ada foto.</div><?php endif; ?>
</div>
</div></body></html>
