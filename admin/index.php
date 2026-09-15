<?php require_once __DIR__.'/../includes/config.php'; require_once __DIR__.'/../includes/functions.php';
$err=''; if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!csrf_check($_POST['_csrf']??'')) $err='CSRF gagal.';
  else{
    $email=trim($_POST['email']??''); $pass=$_POST['password']??'';
    if($pdo){
      $s=$pdo->prepare("SELECT * FROM admin WHERE email=? LIMIT 1"); $s->execute([$email]); $u=$s->fetch();
      if($u && password_verify($pass,$u['password_hash'])){ $_SESSION['admin_id']=$u['id']; $_SESSION['admin_nama']=$u['nama']; $_SESSION['admin_role']=$u['role']; header('Location: '.BASE_URL.'/admin/dashboard.php'); exit; }
    }
    // fallback demo akun agar tetap bisa login tanpa DB
    if($email==='admin@mgc.local' && $pass==='admin123'){ $_SESSION['admin_id']=1; $_SESSION['admin_nama']='Admin Demo'; $_SESSION['admin_role']='super_admin'; header('Location: '.BASE_URL.'/admin/dashboard.php'); exit; }
    $err='Email / password salah.';
  }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login Admin — MGC</title><script src="https://cdn.tailwindcss.com"></script></head><body class="min-h-screen bg-[#F6F7F4] grid place-items-center p-4">
<form method="post" class="w-full max-w-sm bg-white rounded-2xl shadow p-6 space-y-4">
<h1 class="text-xl font-extrabold text-[#0B3D2E]">Login Admin MGC</h1>
<p class="text-sm text-zinc-500">Demo: admin@mgc.local / admin123</p>
<?php if($err): ?><div class="p-3 rounded-xl bg-red-50 text-red-700 text-sm"><?=e($err)?></div><?php endif; ?>
<input type="hidden" name="_csrf" value="<?=e(csrf_token())?>">
<input name="email" type="email" required placeholder="Email" class="w-full px-4 py-3 rounded-xl border">
<input name="password" type="password" required placeholder="Password" class="w-full px-4 py-3 rounded-xl border">
<button class="w-full py-3 rounded-xl bg-[#0B3D2E] text-white font-bold">Masuk</button>
<a href="<?=BASE_URL?>/index.php" class="block text-center text-sm text-zinc-500 hover:text-zinc-700">← Kembali ke website</a>
</form></body></html>
