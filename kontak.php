<?php $title='Kontak — MGC Gowes'; include __DIR__.'/includes/header.php';
$sent=false; if($_SERVER['REQUEST_METHOD']==='POST'){ $sent=true; }
?>
<div class="max-w-6xl mx-auto px-4 py-8 grid md:grid-cols-2 gap-6">
  <div class="card p-6 md:p-8">
    <h1 class="display text-2xl font-extrabold text-[#0B3D2E]">Kontak & Gabung</h1>
    <p class="text-zinc-600 mt-2">Hubungi pengurus atau langsung gabung grup WhatsApp.</p>
    <div class="mt-6 space-y-3 text-sm">
      <a href="<?=WA_LINK?>" target="_blank" class="flex items-center gap-3 p-4 rounded-2xl bg-[#0B3D2E] text-white font-bold hover:brightness-110">💬 Gabung Grup WhatsApp MGC →</a>
      <div class="p-4 rounded-2xl bg-zinc-50">📍 Basecamp: Pelataran Masjid Manggar, Balikpapan</div>
      <div class="p-4 rounded-2xl bg-zinc-50">📷 Instagram: <span class="font-bold">@manggar.gowes</span></div>
      <div class="p-4 rounded-2xl bg-zinc-50">✉️ Email: manggar.gowes@gmail.com</div>
    </div>
  </div>
  <div class="card p-6 md:p-8">
    <h2 class="font-extrabold text-[#0B3D2E]">Kirim Pesan</h2>
    <?php if($sent): ?><div class="mt-3 p-3 rounded-xl bg-emerald-50 text-emerald-800 text-sm font-medium">Pesan terkirim! (demo — belum kirim email). Hubungi via WhatsApp untuk respon cepat.</div><?php endif; ?>
    <form method="post" class="mt-4 space-y-3">
      <input name="nama" placeholder="Nama" required class="w-full px-4 py-3 rounded-xl border bg-white">
      <input name="wa" placeholder="No. WhatsApp" required class="w-full px-4 py-3 rounded-xl border">
      <textarea name="pesan" rows="4" placeholder="Pesan..." required class="w-full px-4 py-3 rounded-xl border"></textarea>
      <button class="w-full py-3 rounded-xl bg-[#FF6B2B] text-white font-extrabold hover:brightness-110">Kirim Pesan</button>
      <p class="text-xs text-zinc-500">ponytail: form ini demo — add when butuh kirim email/DB (simpan ke tabel kontak).</p>
    </form>
  </div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
