<?php $title='MGC — Manggar Gowes Community'; $desc='Gowes bareng, sehat bareng. Histori kegiatan, berita, dan galeri MGC Manggar.'; include __DIR__.'/includes/header.php';
function q($pdo,$sql,$p=[]){ try{ $s=$pdo->prepare($sql); $s->execute($p); return $s->fetchAll(); }catch(Throwable $e){ return []; } }
$berita=[]; $kegiatan=[]; $galeri=[];
if($pdo){
  $berita=q($pdo,"SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 3");
  $kegiatan=q($pdo,"SELECT * FROM kegiatan ORDER BY tanggal DESC LIMIT 4");
  $galeri=q($pdo,"SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
}
// fallback kalau DB kosong
if(!$berita) $berita=[
  ['judul'=>'MGC Raih Juara 2 Fun Bike Kaltim','slug'=>'mgc-juara','kategori'=>'Prestasi','thumbnail'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','tanggal_publish'=>'2026-08-20','isi'=>'Tim MGC juara 2 fun bike...'],
  ['judul'=>'Tips Gowes Aman di Musim Hujan','slug'=>'tips-hujan','kategori'=>'Tips','thumbnail'=>'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80','tanggal_publish'=>'2026-09-01','isi'=>'Musim hujan bukan alasan berhenti...'],
  ['judul'=>'Jersey Baru MGC 2026 Diluncurkan','slug'=>'jersey-baru','kategori'=>'Berita','thumbnail'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','tanggal_publish'=>'2026-09-10','isi'=>'Jersey hijau army + orange...'],
];
if(!$kegiatan) $kegiatan=[
  ['judul'=>'Gowes Manggar — Pantai Seribu Batu','slug'=>'gowes-pantai','tanggal'=>'2026-08-17','lokasi'=>'Manggar – Pantai Seribu Batu','foto_cover'=>'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=800&q=80','status'=>'selesai','peserta'=>45],
  ['judul'=>'Fun Ride HUT RI ke-81','slug'=>'fun-ride-hut','tanggal'=>'2026-08-10','lokasi'=>'Balikpapan – Manggar','foto_cover'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','status'=>'selesai','peserta'=>62],
  ['judul'=>'Gowes Subuh Rutin','slug'=>'gowes-subuh','tanggal'=>'2026-09-20','lokasi'=>'Manggar Loop 20K','foto_cover'=>'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=800&q=80','status'=>'akan_datang','peserta'=>null],
  ['judul'=>'Night Ride Manggar','slug'=>'night-ride','tanggal'=>'2026-07-12','lokasi'=>'Manggar – Lamaru','foto_cover'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','status'=>'selesai','peserta'=>28],
];
if(!$galeri) $galeri=[
  ['url_foto'=>'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80','caption'=>'Start'],
  ['url_foto'=>'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=600&q=80','caption'=>'Finish'],
  ['url_foto'=>'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=600&q=80','caption'=>'Rutin'],
  ['url_foto'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','caption'=>'Night'],
  ['url_foto'=>'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=600&q=80','caption'=>'Bareng'],
  ['url_foto'=>'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80','caption'=>'Peloton'],
];
?>
<div class="max-w-6xl mx-auto px-4 py-6 space-y-10">

<!-- HERO -->
<div class="hero bg-[#0B3D2E] min-h-[420px] flex">
  <div class="flex-1 p-8 md:p-10 flex flex-col justify-center relative z-10">
    <div class="inline-flex items-center gap-2 text-white/80 text-xs font-bold tracking-widest uppercase"><span class="w-2 h-2 rounded-full bg-[#FF6B2B]"></span> Manggar • Balikpapan • Sejak 2019</div>
    <h1 class="display text-white text-[32px] md:text-[44px] font-extrabold leading-[0.95] mt-3">Gowes bareng,<br>sehat bareng.</h1>
    <p class="text-white/80 mt-3 max-w-[44ch] leading-relaxed">Komunitas sepeda Manggar. Fun ride, gowes subuh, night ride. Terbuka untuk semua level — yang penting kompak.</p>
    <div class="flex flex-wrap gap-3 mt-6">
      <a href="<?=WA_LINK?>" target="_blank" class="px-6 py-3 rounded-full bg-[#FF6B2B] text-white font-extrabold hover:brightness-110">Gabung WhatsApp →</a>
      <a href="<?=BASE_URL?>/kegiatan.php" class="px-6 py-3 rounded-full bg-white text-[#0B3D2E] font-bold">Lihat Kegiatan</a>
    </div>
    <div class="flex gap-6 mt-8">
      <div><div class="text-white font-extrabold text-xl"><?=count($kegiatan)?>+</div><div class="text-white/60 text-xs uppercase tracking-wide">Kegiatan</div></div>
      <div><div class="text-white font-extrabold text-xl">120+</div><div class="text-white/60 text-xs uppercase tracking-wide">Anggota</div></div>
      <div><div class="text-white font-extrabold text-xl">7 th</div><div class="text-white/60 text-xs uppercase tracking-wide">Berdiri</div></div>
    </div>
  </div>
  <div class="hidden md:block w-[48%] relative">
    <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=900&q=80" alt="Gowes Manggar" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-r from-[#0B3D2E] via-transparent to-transparent md:from-[#0B3D2E]"></div>
  </div>
</div>

<!-- BERITA -->
<div class="space-y-4">
  <div class="flex items-end justify-between">
    <h2 class="display text-2xl font-extrabold text-[#0B3D2E]">Berita Terbaru</h2>
    <a href="<?=BASE_URL?>/berita.php" class="text-sm font-bold text-[#FF6B2B] hover:underline">Lihat semua →</a>
  </div>
  <div class="grid md:grid-cols-3 gap-5">
  <?php foreach($berita as $b): ?>
    <a href="<?=BASE_URL?>/berita-detail.php?slug=<?=e($b['slug'])?>" class="card group">
      <div class="aspect-[16/10] overflow-hidden bg-zinc-100"><img src="<?=e(img_url($b['thumbnail']??''))?>" alt="" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.02] transition"></div>
      <div class="p-4">
        <div class="flex items-center gap-2"><span class="pill px-2 py-1 rounded-full bg-[#0B3D2E] text-white"><?=e($b['kategori'])?></span><span class="text-xs text-zinc-500"><?=e(tgl_id($b['tanggal_publish']))?></span></div>
        <h3 class="font-bold leading-tight mt-2 line2 group-hover:text-[#0B3D2E]"><?=e($b['judul'])?></h3>
        <p class="text-sm text-zinc-500 mt-1 line2"><?=e(excerpt($b['isi']??'',110))?></p>
      </div>
    </a>
  <?php endforeach; ?>
  </div>
</div>

<!-- KEGIATAN -->
<div class="space-y-4">
  <div class="flex items-end justify-between">
    <h2 class="display text-2xl font-extrabold text-[#0B3D2E]">Histori Kegiatan</h2>
    <a href="<?=BASE_URL?>/kegiatan.php" class="hidden md:inline-flex px-4 py-2 rounded-full border border-zinc-200 bg-white text-sm font-bold hover:bg-zinc-50">Lihat semua kegiatan</a>
  </div>
  <div class="grid md:grid-cols-2 gap-5">
  <?php foreach($kegiatan as $k): $isUpcoming=($k['status']==='akan_datang'); ?>
    <a href="<?=BASE_URL?>/kegiatan-detail.php?slug=<?=e($k['slug']??$k['id']??'')?>" class="card flex overflow-hidden group">
      <div class="w-[38%] min-h-[160px] bg-zinc-100 overflow-hidden"><img src="<?=e(img_url($k['foto_cover']??''))?>" alt="" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.02] transition"></div>
      <div class="flex-1 p-4 flex flex-col">
        <div class="flex items-center gap-2"><span class="pill px-2 py-1 rounded-full <?= $isUpcoming?'bg-[#FF6B2B] text-white':'bg-emerald-100 text-emerald-800' ?>"><?= $isUpcoming?'Akan datang':'Selesai' ?></span><span class="text-xs text-zinc-500"><?=e(tgl_id($k['tanggal']))?></span></div>
        <h3 class="font-bold leading-tight mt-2 line2"><?=e($k['judul'])?></h3>
        <div class="text-xs text-zinc-500 mt-1">📍 <?=e($k['lokasi'])?> <?php if(!empty($k['peserta'])) echo '• '.$k['peserta'].' peserta'; ?></div>
        <span class="mt-auto pt-3 text-sm font-bold text-[#0B3D2E] group-hover:underline">Lihat detail →</span>
      </div>
    </a>
  <?php endforeach; ?>
  </div>
  <a href="<?=BASE_URL?>/kegiatan.php" class="md:hidden inline-flex px-4 py-2 rounded-full border bg-white font-bold">Lihat semua kegiatan</a>
</div>

<!-- GALERI -->
<div class="space-y-4">
  <h2 class="display text-2xl font-extrabold text-[#0B3D2E]">Galeri</h2>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
  <?php foreach($galeri as $g): ?>
    <a href="<?=e(img_url($g['url_foto']))?>" data-lightbox class="card aspect-[4/3] overflow-hidden"><img src="<?=e(img_url($g['url_foto']))?>" alt="<?=e($g['caption']??'Galeri')?>" loading="lazy" class="w-full h-full object-cover hover:scale-[1.02] transition"></a>
  <?php endforeach; ?>
  </div>
  <a href="<?=BASE_URL?>/galeri.php" class="inline-flex px-4 py-2 rounded-full bg-[#0B3D2E] text-white text-sm font-bold">Buka galeri lengkap →</a>
</div>

<!-- TENTANG RINGKAS -->
<div class="card p-6 md:p-8 flex flex-col md:flex-row gap-6 items-center">
  <div class="flex-1"><h3 class="display text-xl font-extrabold text-[#0B3D2E]">Tentang MGC</h3><p class="text-zinc-600 mt-2 leading-relaxed">Manggar Gowes Community — wadah silaturahmi penggemar sepeda di Manggar & sekitarnya. Visi: hidup sehat, guyub, dan peduli lingkungan. Kumpul rutin Sabtu subuh, fun ride bulanan, dan bakti sosial.</p><a href="<?=BASE_URL?>/tentang.php" class="inline-block mt-3 font-bold text-[#FF6B2B] hover:underline">Selengkapnya →</a></div>
  <a href="<?=WA_LINK?>" target="_blank" class="px-6 py-3 rounded-full bg-[#FF6B2B] text-white font-extrabold shrink-0">Gabung Sekarang</a>
</div>

</div>
<dialog id="lb" class="p-0 bg-transparent backdrop:bg-black/70"><img alt="" class="max-w-[90vw] max-h-[85vh] rounded-2xl"><form method="dialog"><button class="absolute top-2 right-2 w-9 h-9 grid place-items-center rounded-full bg-black/60 text-white">✕</button></form></dialog>
<?php include __DIR__.'/includes/footer.php'; ?>
