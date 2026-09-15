<?php $slug=$_GET['slug']??''; include __DIR__.'/includes/header.php';
$row=null; if($pdo && $slug!==''){ try{ $s=$pdo->prepare("SELECT * FROM berita WHERE slug=? LIMIT 1"); $s->execute([$slug]); $row=$s->fetch(); }catch(Throwable $e){} }
if(!$row){
  $map=[
    'mgc-juara-2-fun-bike-kaltim-2026'=>['judul'=>'MGC Raih Juara 2 Fun Bike Kaltim 2026','kategori'=>'Prestasi','tanggal_publish'=>'2026-08-20','thumbnail'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','isi'=>'<p>Tim MGC berhasil meraih juara 2 kategori komunitas pada Fun Bike Kaltim 2026 yang diikuti 300 peserta.</p><p>Terima kasih atas kekompakan seluruh anggota. Sampai jumpa di event berikutnya!</p>'],
    'tips-gowes-aman-musim-hujan'=>['judul'=>'Tips Gowes Aman di Musim Hujan','kategori'=>'Tips','tanggal_publish'=>'2026-09-01','thumbnail'=>'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80','isi'=>'<p>Musim hujan bukan alasan berhenti gowes. Gunakan jas hujan tipis, rem lebih awal, hindari marka licin, bawa lampu.</p>'],
    'jersey-baru-mgc-2026'=>['judul'=>'Jersey Baru MGC 2026 Resmi Diluncurkan','kategori'=>'Berita','tanggal_publish'=>'2026-09-10','thumbnail'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','isi'=>'<p>Jersey hijau army + aksen orange resmi diluncurkan. Pre-order hingga 30 September.</p>'],
  ];
  $row=$map[$slug]??$map['mgc-juara-2-fun-bike-kaltim-2026'];
}
$title=e($row['judul']).' — MGC';
?>
<div class="max-w-3xl mx-auto px-4 py-6 space-y-6">
  <div class="text-sm"><a href="<?=BASE_URL?>/index.php" class="text-zinc-500">Beranda</a> <span class="text-zinc-300">/</span> <a href="<?=BASE_URL?>/berita.php" class="text-zinc-500">Berita</a> <span class="text-zinc-300">/</span> <span class="font-bold line2"><?=e($row['judul'])?></span></div>
  <div class="card overflow-hidden">
    <div class="aspect-[16/8] bg-zinc-100"><img src="<?=e(img_url($row['thumbnail']))?>" alt="" class="w-full h-full object-cover"></div>
    <div class="p-6 md:p-8 space-y-3">
      <div class="flex items-center gap-2"><span class="pill px-2.5 py-1 rounded-full bg-[#0B3D2E] text-white"><?=e($row['kategori'])?></span><span class="text-sm text-zinc-500"><?=e(tgl_id($row['tanggal_publish']))?></span></div>
      <h1 class="display text-2xl md:text-3xl font-extrabold text-[#0B3D2E] leading-tight"><?=e($row['judul'])?></h1>
      <div class="prose max-w-none"><?=$row['isi']?></div>
      <div class="flex gap-2 pt-4 border-t mt-4">
        <a href="https://wa.me/?text=<?=urlencode($row['judul'].' '.BASE_URL.'/berita-detail.php?slug='.$slug)?>" target="_blank" class="px-4 py-2 rounded-full bg-[#0B3D2E] text-white text-sm font-bold">Share WA</a>
        <a href="<?=BASE_URL?>/berita.php" class="px-4 py-2 rounded-full border bg-white text-sm font-bold">← Berita lain</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
