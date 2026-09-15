<?php $title='Berita — MGC Gowes'; include __DIR__.'/includes/header.php';
$rows=[]; if($pdo){ try{ $rows=$pdo->query("SELECT * FROM berita ORDER BY tanggal_publish DESC")->fetchAll(); }catch(Throwable $e){} }
if(!$rows) $rows=[
  ['judul'=>'MGC Raih Juara 2 Fun Bike Kaltim 2026','slug'=>'mgc-juara-2-fun-bike-kaltim-2026','kategori'=>'Prestasi','thumbnail'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','tanggal_publish'=>'2026-08-20','isi'=>'<p>Tim MGC juara 2...</p>'],
  ['judul'=>'Tips Gowes Aman di Musim Hujan','slug'=>'tips-gowes-aman-musim-hujan','kategori'=>'Tips','thumbnail'=>'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80','tanggal_publish'=>'2026-09-01','isi'=>'<p>Musim hujan...</p>'],
  ['judul'=>'Jersey Baru MGC 2026 Resmi Diluncurkan','slug'=>'jersey-baru-mgc-2026','kategori'=>'Berita','thumbnail'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','tanggal_publish'=>'2026-09-10','isi'=>'<p>Jersey baru...</p>'],
];
?>
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
  <div><a href="<?=BASE_URL?>/index.php" class="text-sm text-zinc-500">Beranda</a><span class="text-zinc-300"> / </span><span class="text-sm font-bold">Berita</span><h1 class="display text-3xl font-extrabold text-[#0B3D2E] mt-1">Berita Terbaru</h1></div>
  <div class="grid md:grid-cols-3 gap-5">
  <?php foreach($rows as $b): ?>
    <a href="<?=BASE_URL?>/berita-detail.php?slug=<?=e($b['slug'])?>" class="card group overflow-hidden">
      <div class="aspect-[16/10] bg-zinc-100 overflow-hidden"><img src="<?=e(img_url($b['thumbnail']))?>" alt="" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.02] transition"></div>
      <div class="p-4"><div class="flex gap-2 items-center"><span class="pill px-2 py-1 rounded-full bg-[#0B3D2E] text-white"><?=e($b['kategori'])?></span><span class="text-xs text-zinc-500"><?=e(tgl_id($b['tanggal_publish']))?></span></div><h3 class="font-bold mt-2 line2"><?=e($b['judul'])?></h3><p class="text-sm text-zinc-500 line2 mt-1"><?=e(excerpt($b['isi'],110))?></p></div>
    </a>
  <?php endforeach; ?>
  </div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
