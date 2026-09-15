<?php require_once __DIR__.'/../includes/config.php'; require_once __DIR__.'/../includes/functions.php'; require_login();
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='delete' && csrf_check($_POST['_csrf']??'')){
  $id=(int)$_POST['id']; if($pdo) $pdo->prepare("DELETE FROM kegiatan WHERE id=?")->execute([$id]); $msg='Kegiatan dihapus.';
}
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act']??'')==='save' && csrf_check($_POST['_csrf']??'')){
  $judul=trim($_POST['judul']??''); $tanggal=$_POST['tanggal']??date('Y-m-d'); $lokasi=trim($_POST['lokasi']??''); $deskripsi=$_POST['deskripsi']??''; $status=$_POST['status']??'selesai'; $peserta=$_POST['peserta']!==''?(int)$_POST['peserta']:null;
  $foto=null; if(!empty($_FILES['foto']['tmp_name'])) $foto=upload_image($_FILES['foto']);
  $slug=slugify($judul).'-'.date('His');
  if($judul && $pdo){
    if($foto) $pdo->prepare("INSERT INTO kegiatan(judul,slug,tanggal,lokasi,deskripsi,foto_cover,status,peserta) VALUES(?,?,?,?,?,?,?,?)")->execute([$judul,$slug,$tanggal,$lokasi,$deskripsi,$foto,$status,$peserta]);
    else $pdo->prepare("INSERT INTO kegiatan(judul,slug,tanggal,lokasi,deskripsi,status,peserta) VALUES(?,?,?,?,?,?,?)")->execute([$judul,$slug,$tanggal,$lokasi,$deskripsi,$status,$peserta]);
    $msg='Kegiatan ditambahkan.';
  } elseif($judul) $msg='DB belum aktif — data tidak tersimpan (demo).';
}
$rows=[]; if($pdo) try{ $rows=$pdo->query("SELECT * FROM kegiatan ORDER BY tanggal DESC")->fetchAll(); }catch(Throwable $e){}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Kelola Kegiatan — MGC</title><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-[#F6F7F4] min-h-screen">
<div class="max-w-5xl mx-auto p-4 md:p-6 space-y-6">
<div class="flex items-center justify-between"><h1 class="text-xl font-extrabold text-[#0B3D2E]">Kelola Kegiatan</h1><a href="<?=BASE_URL?>/admin/dashboard.php" class="px-4 py-2 rounded-full bg-white border text-sm font-bold">← Dashboard</a></div>
<?php if($msg): ?><div class="p-3 rounded-xl bg-emerald-50 text-emerald-800 text-sm"><?=e($msg)?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data" class="bg-white rounded-2xl p-5 shadow space-y-3">
<input type="hidden" name="act" value="save"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>">
<div class="grid md:grid-cols-2 gap-3">
<input name="judul" required placeholder="Judul kegiatan" class="px-4 py-3 rounded-xl border">
<input name="lokasi" required placeholder="Lokasi / rute" class="px-4 py-3 rounded-xl border">
<input name="tanggal" type="date" required value="<?=date('Y-m-d')?>" class="px-4 py-3 rounded-xl border">
<select name="status" class="px-4 py-3 rounded-xl border"><option value="selesai">Selesai</option><option value="akan_datang">Akan datang</option></select>
<input name="peserta" type="number" placeholder="Jumlah peserta (opsional)" class="px-4 py-3 rounded-xl border">
<input name="foto" type="file" accept="image/*" class="px-4 py-3 rounded-xl border bg-white">
</div>
<textarea name="deskripsi" rows="3" placeholder="Deskripsi..." class="w-full px-4 py-3 rounded-xl border"></textarea>
<button class="px-6 py-3 rounded-xl bg-[#0B3D2E] text-white font-bold">Simpan Kegiatan</button>
</form>
<div class="bg-white rounded-2xl shadow overflow-hidden">
<table class="w-full text-sm">
<tr class="bg-zinc-50 text-left"><th class="p-3">Judul</th><th class="p-3">Tanggal</th><th class="p-3">Status</th><th class="p-3"></th></tr>
<?php foreach($rows as $r): ?>
<tr class="border-t"><td class="p-3 font-medium"><?=e($r['judul'])?></td><td class="p-3"><?=e($r['tanggal'])?></td><td class="p-3"><?=e($r['status'])?></td><td class="p-3"><form method="post" onsubmit="return confirm('Hapus?')"><input type="hidden" name="act" value="delete"><input type="hidden" name="_csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="id" value="<?=$r['id']?>"><button class="text-red-600 font-bold">Hapus</button></form></td></tr>
<?php endforeach; if(!$rows): ?><tr><td colspan="4" class="p-6 text-center text-zinc-500">Belum ada data (atau DB belum aktif).</td></tr><?php endif; ?>
</table>
</div>
</div></body></html>
