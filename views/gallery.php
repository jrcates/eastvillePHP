<?php
$galleryImages = [
  "assets/gal-img2.jpg",
  "assets/gal-img3.jpg",
  "assets/gal-img4.jpg",
  "assets/gal-img5.jpg",
  "assets/gal-img6.jpg",
  "assets/gal-img7.jpg",
  "assets/gal-img8.jpg",
  "assets/gal-img9.jpg",
  "assets/gal-img10.jpg",
  "assets/gal-img11.jpg",
  "assets/gal-img12.jpg",
  "assets/gal-img13.jpg",
  "assets/gal-img14.jpg",
  "assets/gal-img15.jpg",
];
?>

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 z-[60] bg-black/95 backdrop-blur-xl hidden items-center justify-center p-4" style="display:none;">
  <button id="lightbox-close" class="absolute top-6 right-6 text-neutral-400 hover:text-white transition-colors">
    <i data-lucide="x" class="w-8 h-8"></i>
  </button>
  <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-[5px] shadow-2xl" />
</div>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- Header -->
  <div class="text-center mb-16">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">
      THE <span class="text-[#24CECE]">VIBE</span>
    </h1>
    <p class="text-xl text-neutral-400 max-w-2xl mx-auto">Capturing the laughter, the lights, and the unforgettable nights at EastVille.</p>
  </div>

  <!-- Masonry Grid -->
  <div class="columns-1 sm:columns-2 md:columns-3 gap-6" style="column-gap:24px;">
    <?php foreach ($galleryImages as $i => $img): ?>
    <div class="gallery-item relative group cursor-zoom-in overflow-hidden rounded-[5px] bg-neutral-900 border border-neutral-800 mb-6 break-inside-avoid" style="animation-delay:<?= $i * 0.05 ?>s">
      <img src="<?= htmlspecialchars($img) ?>" alt="EastVille moment" class="w-full h-auto block transition-transform duration-700 group-hover:scale-105" style="min-height:150px;" />
      <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
        <i data-lucide="zoom-in" class="w-12 h-12 text-[#24CECE] scale-0 group-hover:scale-100 transition-transform duration-300"></i>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
$(function () {
  // Open lightbox
  $('.gallery-item').on('click', function () {
    var src = $(this).find('img').attr('src');
    $('#lightbox-img').attr('src', src);
    $('#lightbox').fadeIn(200).css('display', 'flex');
    $('body').css('overflow', 'hidden');
  });

  // Close lightbox
  $('#lightbox-close, #lightbox').on('click', function (e) {
    if (e.target === this) {
      $('#lightbox').fadeOut(200);
      $('body').css('overflow', '');
    }
  });

  // ESC key
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape') {
      $('#lightbox').fadeOut(200);
      $('body').css('overflow', '');
    }
  });

  // Prevent close when clicking image itself
  $('#lightbox-img').on('click', function (e) { e.stopPropagation(); });
});
</script>
