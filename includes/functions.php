<?php
function e($s){ return htmlspecialchars($s??'',ENT_QUOTES,'UTF-8'); }
function slugify($s){ $s=strtolower(trim($s)); $s=preg_replace('/[^a-z0-9]+/','-',$s); return trim($s,'-'); }
function tgl_id($d){ if(!$d) return '-'; $b=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des']; $t=strtotime($d); return date('j',$t).' '.$b[date('n',$t)-1].' '.date('Y',$t); }
function excerpt($html,$n=140){ $t=strip_tags($html); $t=trim(preg_replace('/\s+/',' ',$t)); return mb_strimwidth($t,0,$n,'…'); }
function img_url($v){ if(!$v) return 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=800&q=80'; if(str_starts_with($v,'http')) return $v; return BASE_URL.'/uploads/'.ltrim($v,'/'); }
function require_login(){ if(empty($_SESSION['admin_id'])){ header('Location: '.BASE_URL.'/admin/index.php'); exit; } }
function upload_image($file,$destDir='uploads'){ // return filename or null; resize max 1280
  if(empty($file['tmp_name'])||$file['error']!==0) return null;
  if($file['size']>3*1024*1024) return null;
  $f=finfo_open(FILEINFO_MIME_TYPE); $mime=finfo_file($f,$file['tmp_name']); finfo_close($f);
  $allow=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp']; if(!isset($allow[$mime])) return null;
  $ext=$allow[$mime]; $name=date('Ymd-His').'-'.bin2hex(random_bytes(4)).'.'.$ext;
  $dir=__DIR__.'/../'.$destDir; if(!is_dir($dir)) mkdir($dir,0777,true);
  $path=$dir.'/'.$name;
  // resize via GD jika ada dan jpeg/png
  if(function_exists('imagecreatetruecolor') && in_array($mime,['image/jpeg','image/png'])){
    $src=$mime==='image/png'?@imagecreatefrompng($file['tmp_name']):@imagecreatefromjpeg($file['tmp_name']);
    if($src){ $w=imagesx($src); $h=imagesy($src); $max=1280;
      if($w>$max||$h>$max){ $r=min($max/$w,$max/$h); $nw=(int)($w*$r); $nh=(int)($h*$r);
        $dst=imagecreatetruecolor($nw,$nh); if($mime==='image/png'){ imagealphablending($dst,false); imagesavealpha($dst,true); }
        imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); $src=$dst; $w=$nw; $h=$nh;
      }
      if($mime==='image/png') imagepng($src,$path,6); else imagejpeg($src,$path,82);
      imagedestroy($src); return $name;
    }
  }
  move_uploaded_file($file['tmp_name'],$path); return $name;
}
