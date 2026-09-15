<?php require_once __DIR__.'/config.php'; require_once __DIR__.'/functions.php';
$cur = basename($_SERVER['SCRIPT_NAME']);
function nav_a($href,$label,$cur){$on=str_contains($cur,trim($href,'/'))||($href==='index.php'&&$cur==='index.php');return '<a href="'.BASE_URL.'/'.$href.'" class="px-3 py-2 rounded-full text-sm font-medium '.($on?'bg-white text-[#0B3D2E]':'text-white/90 hover:bg-white/15').'">'.$label.'</a>';}
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($title??SITE_NAME)?></title>
<meta name="description" content="<?=e($desc??'Manggar Gowes Community — gowes bareng, sehat bareng. Histori kegiatan, berita, dan galeri.')?>">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css">
</head><body class="bg-[#F6F7F4] text-zinc-800 antialiased">
<header class="sticky top-0 z-40 bg-[#0B3D2E] border-b border-white/10">
<div class="max-w-6xl mx-auto px-4 h-[64px] flex items-center justify-between gap-4">
<a href="<?=BASE_URL?>/index.php" class="flex items-center gap-3">
<div class="w-9 h-9 rounded-xl bg-[#FF6B2B] grid place-items-center text-white font-extrabold text-sm">MGC</div>
<span class="text-white font-extrabold tracking-tight leading-none">MGC<span class="font-medium text-white/70"> Gowes</span></span>
</a>
<nav class="hidden md:flex items-center gap-1" aria-label="Utama">
<?=nav_a('index.php','Beranda',$cur)?>
<?=nav_a('kegiatan.php','Kegiatan',$cur)?>
<?=nav_a('berita.php','Berita',$cur)?>
<?=nav_a('galeri.php','Galeri',$cur)?>
<?=nav_a('tentang.php','Tentang',$cur)?>
<?=nav_a('kontak.php','Kontak',$cur)?>
</nav>
<div class="hidden md:flex items-center gap-2">
<a href="<?=WA_LINK?>" target="_blank" class="px-4 py-2 rounded-full bg-[#FF6B2B] text-white text-sm font-bold hover:brightness-110">Gabung WA</a>
<a href="<?=BASE_URL?>/admin/index.php" class="text-white/70 text-sm hover:text-white">Admin</a>
</div>
<button id="mnav" class="md:hidden w-10 h-10 grid place-items-center rounded-xl bg-white/10 text-white" aria-label="Menu">☰</button>
</div>
<div id="mdraw" class="hidden md:hidden border-t border-white/10 bg-[#0B3D2E] px-4 py-3 space-y-1">
<a href="<?=BASE_URL?>/index.php" class="block text-white py-2">Beranda</a>
<a href="<?=BASE_URL?>/kegiatan.php" class="block text-white py-2">Kegiatan</a>
<a href="<?=BASE_URL?>/berita.php" class="block text-white py-2">Berita</a>
<a href="<?=BASE_URL?>/galeri.php" class="block text-white py-2">Galeri</a>
<a href="<?=BASE_URL?>/tentang.php" class="block text-white py-2">Tentang</a>
<a href="<?=BASE_URL?>/kontak.php" class="block text-white py-2">Kontak</a>
<a href="<?=WA_LINK?>" target="_blank" class="inline-block mt-2 px-4 py-2 rounded-full bg-[#FF6B2B] text-white font-bold">Gabung WA</a>
</div>
</header>
<main>
