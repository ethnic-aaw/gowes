document.getElementById('mnav')?.addEventListener('click',()=>document.getElementById('mdraw').classList.toggle('hidden'));
// lightbox
document.addEventListener('click',e=>{
  const a=e.target.closest('[data-lightbox]'); if(!a) return;
  e.preventDefault();
  const d=document.getElementById('lb'); d.querySelector('img').src=a.href; d.showModal();
});
