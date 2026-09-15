<?php $title='Kegiatan — MGC Gowes'; include __DIR__.'/includes/header.php';
$tahun=$_GET['tahun']??'';
$rows=[]; $years=[];
if($pdo){
  try{
    $years=$pdo->query("SELECT DISTINCT YEAR(tanggal) y FROM kegiatan ORDER BY y DESC")->fetchAll(PDO::FETCH_COLUMN);
    if($tahun!=='' && ctype_digit($tahun)){$s=$pdo->prepare("SELECT * FROM kegiatan WHERE YEAR(tanggal)=? ORDER BY tanggal DESC");$s->execute([$tahun]);$rows=$s->fetchAll();}
    else{$rows=$pdo->query("SELECT * FROM kegiatan ORDER BY tanggal DESC")->fetchAll();}
  }catch(Throwable $e){}
}
if(!$rows) $rows=[
  ['judul'=>'Gowes Manggar — Pantai Seribu Batu','slug'=>'gowes-manggar-pantai-seribu-batu','tanggal'=>'2026-08-17','lokasi'=>'Manggar – Pantai Seribu Batu','foto_cover'=>'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=800&q=80','status'=>'selesai','peserta'=>45],
  ['judul'=>'Fun Ride HUT RI ke-81','slug'=>'fun-ride-hut-ri-81','tanggal'=>'2026-08-10','lokasi'=>'Balikpapan – Manggar','foto_cover'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','status'=>'selesai','peserta'=>62],
  ['judul'=>'Gowes Subuh Rutin','slug'=>'gowes-subuh-rutin','tanggal'=>'2026-09-20','lokasi'=>'Manggar Loop 20K','foto_cover'=>'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=800&q=80','status'=>'akan_datang','peserta'=>null],
  ['judul'=>'Night Ride Manggar','slug'=>'night-ride-manggar','tanggal'=>'2026-07-12','lokasi'=>'Manggar – Lamaru','foto_cover'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','status'=>'selesai','peserta'=>28],
];
if(!$years) $years=[2026,2025];
?>
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
  <div><a href="<?=BASE_URL?>/index.php" class="text-sm text-zinc-500 hover:text-zinc-700">Beranda</a><span class="text-zinc-300"> / </span><span class="text-sm font-bold">Kegiatan</span>
  <h1 class="display text-3xl font-extrabold text-[#0B3D2E] mt-1">Histori Kegiatan</h1><p class="text-zinc-500 mt-1">Arsip gowes MGC — filter per tahun, klik untuk detail rute & foto.</p></div>
  <div class="flex flex-wrap gap-2">
    <a href="<?=BASE_URL?>/kegiatan.php" class="px-4 py-2 rounded-full text-sm font-bold <?= $tahun===''?'bg-[#0B3D2E] text-white':'bg-white border' ?>">Semua</a>
    <?php foreach($years as $y): ?><a href="?tahun=<?=$y?>" class="px-4 py-2 rounded-full text-sm font-bold <?= (string)$tahun===(string)$y?'bg-[#0B3D2E] text-white':'bg-white border' ?>"><?=$y?></a><?php endforeach; ?>
  </div>
  <div class="grid md:grid-cols-2 gap-5">
  <?php foreach($rows as $k): $up=$k['status']==='akan_datang'; ?>
    <a href="<?=BASE_URL?>/kegiatan-detail.php?slug=<?=e($k['slug'])?>" class="card flex overflow-hidden group">
      <div class="w-[40%] bg-zinc-100"><img src="<?=e(img_url($k['foto_cover']))?>" alt="" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.02] transition"></div>
      <div class="flex-1 p-4">
        <span class="pill px-2 py-1 rounded-full <?= $up?'bg-[#FF6B2B] text-white':'bg-emerald-100 text-emerald-800' ?>"><?= $up?'Akan datang':'Selesai' ?></span>
        <h3 class="font-bold leading-tight mt-2 line2"><?=e($k['judul'])?></h3>
        <div class="text-xs text-zinc-500 mt-1"><?=e(tgl_id($k['tanggal']))?> • <?=e($k['lokasi'])?></div>
        <?php if(!empty($k['peserta'])): ?><div class="text-xs text-zinc-500"><?=$k['peserta']?> peserta</div><?php endif; ?>
      </div>
    </a>
  <?php endforeach; ?>
  </div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
