<?php
$galleryImages = [
  "assets/newgal-img1.jpg",
  "assets/newgal-img2.jpg",
  "assets/newgal-img3.jpg",
  "assets/newgal-img4.jpg",
  "assets/newgal-img5.jpg",
  "assets/newgal-img6.jpg",
  "assets/newgal-img7.jpg",
  "assets/newgal-img8.jpg",
  "assets/newgal-img9.jpg",
  "assets/newgal-img10.jpg",
  "assets/newgal-img11.jpg",
  "assets/newgal-img12.jpg",
];
?>

<!-- Lightbox -->
<div id="lightbox" role="dialog" aria-label="Image lightbox" class="fixed inset-0 z-[60] bg-black/95 backdrop-blur-xl items-center justify-center p-4" style="display:none;">
  <button id="lightbox-close" aria-label="Close lightbox" class="absolute top-6 right-6 text-neutral-400 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#24CECE] rounded-full p-1">
    <i data-lucide="x" class="w-8 h-8"></i>
  </button>
  <img id="lightbox-img" src="" alt="Gallery image enlarged" class="max-w-full max-h-[90vh] object-contain shadow-2xl" style="border-radius:5px;" />
</div>

<section class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen" aria-label="Photo gallery">

  <!-- Header -->
  <div class="text-center mb-16">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">
      THE <span class="text-[#24CECE]">VIBE</span>
    </h1>
    <p class="text-xl text-white max-w-2xl mx-auto">Capturing the laughter, the lights, and the unforgettable nights at EastVille.</p>
  </div>

  <!-- Gallery Grid — Row 1: 1 large + 2 stacked -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 auto-rows-[200px] md:auto-rows-[220px]">
    <?php
    // Layout pattern per image index: [colSpan, rowSpan]
    $layout = [
      [2, 2], // img1 — large feature
      [1, 1], // img2
      [1, 1], // img3
      [1, 1], // img4
      [1, 1], // img5
      [1, 2], // img6 — tall
      [1, 1], // img7
      [2, 2], // img8 — large feature
      [1, 1], // img9
      [1, 1], // img10
      [1, 1], // img11
      [1, 1], // img12
    ];
    foreach ($galleryImages as $i => $img):
      [$cols, $rows] = $layout[$i] ?? [1, 1];
      $colClass = $cols === 2 ? 'col-span-2' : 'col-span-1';
      $rowClass = $rows === 2 ? 'row-span-2' : 'row-span-1';
    ?>
    <button type="button" class="gallery-item relative group cursor-zoom-in overflow-hidden bg-neutral-900 border border-neutral-800 <?= $colClass ?> <?= $rowClass ?> focus:outline-none focus:ring-2 focus:ring-[#24CECE] focus:ring-offset-2 focus:ring-offset-[#171C1C]" style="border-radius:5px;" aria-label="View image <?= $i + 1 ?>">
      <img src="<?= htmlspecialchars($img) ?>" alt="EastVille Comedy Club moment <?= $i + 1 ?>" class="w-full h-full object-cover block transition-transform duration-700 group-hover:scale-105" loading="lazy" />
      <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
        <i data-lucide="zoom-in" class="w-10 h-10 text-[#24CECE] scale-0 group-hover:scale-100 transition-transform duration-300"></i>
      </div>
    </button>
    <?php endforeach; ?>
  </div>
</section>

<script>
$(function () {
  var $lastFocused;

  // Open lightbox
  $('.gallery-item').on('click', function () {
    $lastFocused = $(this);
    var src = $(this).find('img').attr('src');
    $('#lightbox-img').attr('src', src);
    $('#lightbox').fadeIn(200).css('display', 'flex');
    $('body').css('overflow', 'hidden');
    $('#lightbox-close').focus();
  });

  // Close lightbox
  function closeLightbox() {
    $('#lightbox').fadeOut(200);
    $('body').css('overflow', '');
    if ($lastFocused) $lastFocused.focus();
  }

  $('#lightbox-close').on('click', closeLightbox);
  $('#lightbox').on('click', function (e) {
    if (e.target === this) closeLightbox();
  });

  // ESC key
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $('#lightbox').is(':visible')) closeLightbox();
  });

  // Prevent close when clicking image itself
  $('#lightbox-img').on('click', function (e) { e.stopPropagation(); });
});
</script>
