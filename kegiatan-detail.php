<?php $slug=$_GET['slug']??$_GET['id']??''; include __DIR__.'/includes/header.php';
$row=null; $fotos=[];
if($pdo && $slug!==''){
  try{
    $s=$pdo->prepare("SELECT * FROM kegiatan WHERE slug=? OR id=? LIMIT 1"); $s->execute([$slug,$slug]); $row=$s->fetch();
    if($row){ $q=$pdo->prepare("SELECT * FROM galeri WHERE kegiatan_id=? ORDER BY id DESC"); $q->execute([$row['id']]); $fotos=$q->fetchAll(); }
  }catch(Throwable $e){}
}
if(!$row){
  $map=[
    'gowes-manggar-pantai-seribu-batu'=>['judul'=>'Gowes Manggar — Pantai Seribu Batu','tanggal'=>'2026-08-17','lokasi'=>'Manggar – Pantai Seribu Batu','status'=>'selesai','peserta'=>45,'foto_cover'=>'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=900&q=80','deskripsi'=>'<p>Gowes 28km menyusuri pesisir Manggar. Start 06.00, finish sarapan bersama di Pantai Seribu Batu.</p><p>Rute flat, cocok pemula. Wajib helm & lampu.</p>'],
    'fun-ride-hut-ri-81'=>['judul'=>'Fun Ride HUT RI ke-81','tanggal'=>'2026-08-10','lokasi'=>'Balikpapan – Manggar','status'=>'selesai','peserta'=>62,'foto_cover'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=900&q=80','deskripsi'=>'<p>Fun ride kemerdekaan dress code merah-putih. Doorprize sepeda lipat.</p>'],
    'gowes-subuh-rutin'=>['judul'=>'Gowes Subuh Rutin','tanggal'=>'2026-09-20','lokasi'=>'Manggar Loop 20K','status'=>'akan_datang','peserta'=>null,'foto_cover'=>'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=900&q=80','deskripsi'=>'<p>Rutin tiap Sabtu subuh. Kumpul 05.30 di pelataran Masjid Manggar.</p>'],
    'night-ride-manggar'=>['judul'=>'Night Ride Manggar','tanggal'=>'2026-07-12','lokasi'=>'Manggar – Lamaru','status'=>'selesai','peserta'=>28,'foto_cover'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900&q=80','deskripsi'=>'<p>Night ride perdana 18km. Reflektor wajib.</p>'],
  ];
  $row=$map[$slug]??$map['gowes-manggar-pantai-seribu-batu'];
  $row['slug']=$slug ?: 'gowes-manggar-pantai-seribu-batu';
}
$title=e($row['judul']).' — MGC';
?>
<div class="max-w-6xl mx-auto px-4 py-6 space-y-6">
  <div class="text-sm"><a href="<?=BASE_URL?>/index.php" class="text-zinc-500 hover:text-zinc-700">Beranda</a> <span class="text-zinc-300">/</span> <a href="<?=BASE_URL?>/kegiatan.php" class="text-zinc-500 hover:text-zinc-700">Kegiatan</a> <span class="text-zinc-300">/</span> <span class="font-bold"><?=e($row['judul'])?></span></div>
  <div class="card overflow-hidden">
    <div class="aspect-[16/7] bg-zinc-100"><img src="<?=e(img_url($row['foto_cover']))?>" alt="" class="w-full h-full object-cover"></div>
    <div class="p-6 md:p-8 space-y-3">
      <div class="flex flex-wrap items-center gap-2"><span class="pill px-2.5 py-1 rounded-full <?=($row['status']==='akan_datang'?'bg-[#FF6B2B] text-white':'bg-emerald-100 text-emerald-800')?>"><?=e($row['status'])?></span><span class="text-sm text-zinc-500"><?=e(tgl_id($row['tanggal']))?> • <?=e($row['lokasi'])?></span><?php if(!empty($row['peserta'])):?><span class="text-sm text-zinc-500">• <?=$row['peserta']?> peserta</span><?php endif;?></div>
      <h1 class="display text-2xl md:text-3xl font-extrabold text-[#0B3D2E]"><?=e($row['judul'])?></h1>
      <div class="prose max-w-none"><?=$row['deskripsi']?></div>
      <div class="flex gap-2 pt-2"><a href="<?=WA_LINK?>" target="_blank" class="px-5 py-2.5 rounded-full bg-[#FF6B2B] text-white font-bold">Tanya via WA</a><a href="<?=BASE_URL?>/kegiatan.php" class="px-5 py-2.5 rounded-full border bg-white font-bold">Kembali</a></div>
    </div>
  </div>
  <?php if($fotos): ?>
  <div class="space-y-3"><h2 class="font-extrabold text-[#0B3D2E]">Dokumentasi</h2><div class="grid grid-cols-2 md:grid-cols-3 gap-3"><?php foreach($fotos as $f): ?><a href="<?=e(img_url($f['url_foto']))?>" data-lightbox class="card aspect-[4/3] overflow-hidden"><img src="<?=e(img_url($f['url_foto']))?>" alt="<?=e($f['caption']??'')?>" loading="lazy" class="w-full h-full object-cover"></a><?php endforeach; ?></div></div>
  <?php endif; ?>
</div>
<dialog id="lb" class="p-0 bg-transparent backdrop:bg-black/70"><img alt="" class="max-w-[90vw] max-h-[85vh] rounded-2xl"><form method="dialog"><button class="absolute top-2 right-2 w-9 h-9 grid place-items-center rounded-full bg-black/60 text-white">✕</button></form></dialog>
<?php include __DIR__.'/includes/footer.php'; ?>
