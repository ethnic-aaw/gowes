<?php $title='Galeri — MGC Gowes'; include __DIR__.'/includes/header.php';
$rows=[]; if($pdo){ try{ $rows=$pdo->query("SELECT * FROM galeri ORDER BY id DESC")->fetchAll(); }catch(Throwable $e){} }
if(!$rows) $rows=array_map(fn($u)=>['url_foto'=>$u,'caption'=>''],[
 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80',
 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=600&q=80',
 'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=600&q=80',
 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=600&q=80',
 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80',
]);
?>
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
  <h1 class="display text-3xl font-extrabold text-[#0B3D2E]">Galeri Foto</h1>
  <p class="text-zinc-500 -mt-4">Dokumentasi kegiatan MGC — klik untuk memperbesar.</p>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
  <?php foreach($rows as $r): ?>
    <a href="<?=e(img_url($r['url_foto']))?>" data-lightbox class="card aspect-[4/3] overflow-hidden"><img src="<?=e(img_url($r['url_foto']))?>" alt="<?=e($r['caption']??'')?>" loading="lazy" class="w-full h-full object-cover hover:scale-[1.02] transition"></a>
  <?php endforeach; ?>
  </div>
</div>
<dialog id="lb" class="p-0 bg-transparent backdrop:bg-black/70"><img alt="" class="max-w-[90vw] max-h-[85vh] rounded-2xl"><form method="dialog"><button class="absolute top-2 right-2 w-9 h-9 grid place-items-center rounded-full bg-black/60 text-white">✕</button></form></dialog>
<?php include __DIR__.'/includes/footer.php'; ?>
