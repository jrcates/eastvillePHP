<?php
require_once __DIR__ . '/../data.php';

$heroShows    = array_slice($shows, 0, 3);
$upcomingShows = array_slice($shows, 3, 6);

$galleryImages = [
  "assets/super-img2.png",
  "assets/super-img3.png",
  "assets/super-img4.png",
  "assets/super-img5.png",
  "assets/super-img6.png",
  "assets/super-img7.png",
  "assets/super-img8.png",
];
?>

<!-- ─── Hero Carousel ─── -->
<section class="relative pt-[150px] pb-0 flex flex-col items-center justify-center overflow-hidden">
  <style>
    .hero-carousel { overflow: visible; position: relative; }
    .hero-track { display: flex; transition: transform 0.5s ease; gap: 0; }
    .hero-slide {
      flex: 0 0 1200px; display: flex; justify-content: center;
      transition: opacity 0.5s ease;
      opacity: 0.5;
    }
    .hero-slide.active { opacity: 1; }
    .hero-card { width: 1200px; height: 660px; display: flex; background: white; border-radius: 0; overflow: hidden; position: relative; }
    .hero-slide.active .hero-card { border-radius: 5px; }
    @media (max-width: 1280px) {
      .hero-slide { flex: 0 0 70vw; }
      .hero-card { width: 70vw; height: auto; flex-direction: column; }
    }
    @media (max-width: 768px) {
      .hero-slide { flex: 0 0 88vw; }
      .hero-card { width: 88vw; flex-direction: column; }
    }
    .slick-prev-btn, .slick-next-btn {
      position: absolute; top: 50%; z-index: 20;
      width: 50px; height: 50px; background: white; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3); cursor: pointer; transform: translateY(-50%);
      border: none;
    }
    /* Arrows at the left/right edges of the center 1200px card */
    .slick-prev-btn { left: calc(50% - 600px - 25px); }
    .slick-next-btn { right: calc(50% - 600px - 25px); }
    @media (max-width: 1280px) {
      .slick-prev-btn { left: calc(50% - 35vw - 25px); }
      .slick-next-btn { right: calc(50% - 35vw - 25px); }
    }
    @media (max-width: 768px) {
      .slick-prev-btn { left: 4px; width: 40px; height: 40px; }
      .slick-next-btn { right: 4px; width: 40px; height: 40px; }
    }
  </style>

  <div class="w-full relative">
    <div class="hero-carousel">
      <div class="hero-track" id="hero-track">
        <?php foreach ($heroShows as $slide):
          $d = formatShowDate($slide['date']);
        ?>
        <div class="hero-slide">
          <div class="hero-card">
            <!-- Left Content -->
            <div class="w-full md:w-[678px] h-full p-8 md:p-16 md:pl-20 flex flex-col justify-between gap-6 md:gap-10 bg-white text-neutral-900 relative z-10">
              <!-- Date Badge -->
              <div class="flex flex-col items-center w-fit">
                <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center min-w-[80px] bg-white">
                  <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['weekday']) ?></div>
                  <div class="text-5xl font-black leading-none text-black my-1"><?= $d['day'] ?></div>
                  <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['month']) ?></div>
                </div>
                <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= htmlspecialchars($d['time']) ?></div>
              </div>

              <div class="space-y-4 md:space-y-5 max-w-lg mb-4 md:mb-8 relative z-10">
                <h2 class="text-3xl md:text-5xl font-black uppercase leading-[0.9] tracking-tight text-black"><?= htmlspecialchars($slide['title']) ?></h2>
                <p class="text-neutral-500 text-base md:text-lg leading-relaxed font-normal"><?= htmlspecialchars($slide['description']) ?></p>
                <a href="?view=event&show=<?= urlencode($slide['id']) ?>" class="inline-block px-8 py-3 bg-[#24CECE] hover:bg-[#20B8B8] text-black font-bold rounded-full text-base transition-all mt-2 hover:-translate-y-0.5">Buy Tickets</a>
              </div>
            </div>
            <!-- Mobile Image (shown only on mobile, at the bottom) -->
            <div class="block md:hidden w-full h-[200px] overflow-hidden">
              <img src="<?= htmlspecialchars($slide['image']) ?>" alt="<?= htmlspecialchars($slide['title']) ?>" class="w-full h-full object-cover" />
            </div>
            <!-- Right Image (desktop only) -->
            <div class="hidden md:block absolute top-1/2 right-12 -translate-y-1/2 w-[460px] h-[480px] rounded-[5px] overflow-hidden shadow-2xl">
              <img src="<?= htmlspecialchars($slide['image']) ?>" alt="<?= htmlspecialchars($slide['title']) ?>" class="w-full h-full object-cover" />
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <button class="slick-prev-btn" id="hero-prev">
      <i data-lucide="chevron-left" class="w-8 h-8 text-black"></i>
    </button>
    <button class="slick-next-btn" id="hero-next">
      <i data-lucide="chevron-right" class="w-8 h-8 text-black"></i>
    </button>
  </div>
</section>

<!-- ─── Upcoming Shows ─── -->
<section class="py-16 bg-[#171C1C] relative overflow-hidden">
  <div class="max-w-[1200px] mx-auto px-6 relative z-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
      <h2 class="text-3xl font-bold uppercase tracking-wide">Upcoming Comedy Shows</h2>
      <a href="?view=schedule" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors shrink-0">View Entire Schedule</a>
    </div>
    <div class="space-y-4">
      <?php foreach ($upcomingShows as $show):
        $d = formatShowDate($show['date']);
      ?>
      <div class="show-card bg-white rounded-[5px] p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-neutral-800">
        <!-- Date -->
        <div class="flex flex-col items-center flex-shrink-0">
          <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center date-badge bg-white">
            <div class="text-sm font-bold text-black leading-none"><?= $d['weekday'] ?></div>
            <div class="text-4xl font-black leading-none text-black my-1"><?= $d['day'] ?></div>
            <div class="text-sm font-bold text-black leading-none"><?= $d['month'] ?></div>
          </div>
          <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= $d['time'] ?></div>
        </div>
        <!-- Image -->
        <div class="w-full md:w-[220px] h-[140px] rounded-[5px] overflow-hidden flex-shrink-0">
          <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="show-card-img w-full h-full object-cover" />
        </div>
        <!-- Content -->
        <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left self-center">
          <h3 class="text-[20px] font-extrabold text-black uppercase mb-3"><?= htmlspecialchars($show['title']) ?></h3>
          <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2">Join us for Comedy Night at <?= htmlspecialchars($show['location']) ?>. The show will feature top acts from around the country.</p>
        </div>
        <!-- Button -->
        <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap flex-shrink-0 hover-lift shadow-lg shadow-[#24CECE]/20">Buy Tickets</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── Our Menu Section ─── -->
<section class="py-16 bg-[#171C1C]">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
      <div>
        <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">Our Menu</h2>
        <p class="text-neutral-500 text-sm">There is a 1-drink minimum at all of our shows</p>
      </div>
      <a href="?view=menu" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors shrink-0">View Menu</a>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ([
        ['SPECIALTY COCKTAILS', 'assets/specialty-cocktail.jpg', 'Eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        ['BEERS', 'assets/beers.jpg', 'Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor..'],
        ['NON-ALCOHOLIC', 'assets/non-alcoholic.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod..'],
      ] as [$title, $img, $desc]): ?>
      <div class="bg-white rounded-[5px] overflow-hidden group border border-transparent hover:border-[#24CECE]/50 transition-all duration-300">
        <div class="h-[300px] relative">
          <img src="<?= $img ?>" alt="<?= $title ?>" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-gradient-to-t from-white via-white/10 to-transparent"></div>
        </div>
        <div class="p-8 bg-white -mt-1 relative z-10">
          <h3 class="text-2xl font-black uppercase tracking-tight text-black mb-4"><?= $title ?></h3>
          <p class="text-neutral-500 text-sm leading-relaxed mb-8"><?= $desc ?></p>
          <a href="?view=menu" class="inline-block px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors shadow-lg shadow-[#24CECE]/20">View Menu</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── Gallery Preview ─── -->
<section class="py-16 bg-[#171C1C]">
  <div class="max-w-[1200px] mx-auto px-6">
    <div class="mb-12">
      <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">Super Fun Nights</h2>
      <p class="text-neutral-500 text-sm">Laughter makes sleep can those many nights.</p>
    </div>
    <div class="columns-1 sm:columns-2 md:columns-3 gap-4 space-y-4">
      <?php foreach ($galleryImages as $img): ?>
      <div class="gallery-item break-inside-avoid rounded-[5px] overflow-hidden">
        <img src="<?= htmlspecialchars($img) ?>" style="width:100%;display:block;" alt="" />
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── Carousel JS ─── -->
<script>
$(function () {
  var $track = $('#hero-track');
  var total = <?= count($heroShows) ?>;
  var isTransitioning = false;

  // Clone all slides and append/prepend for infinite loop
  var $origSlides = $track.children('.hero-slide');
  $origSlides.each(function () {
    $track.append($(this).clone().addClass('clone'));
  });
  $origSlides.each(function () {
    $track.prepend($(this).clone().addClass('clone'));
  });

  // Now the order is: [clones of all] [originals] [clones of all]
  // The "real" index 0 is at position `total` in the DOM
  var $allSlides = $track.children('.hero-slide');
  var current = total; // start at the first original slide

  function positionTrack(animate) {
    var slideW = $allSlides.eq(0).outerWidth();
    var viewW = $(window).width();
    var offset = -current * slideW + (viewW - slideW) / 2;

    if (animate) {
      $track.css({ transition: 'transform 0.5s ease', transform: 'translateX(' + offset + 'px)' });
    } else {
      $track.css({ transition: 'none', transform: 'translateX(' + offset + 'px)' });
    }

    $allSlides.removeClass('active');
    $allSlides.eq(current).addClass('active');
  }

  function goTo(idx) {
    if (isTransitioning) return;
    isTransitioning = true;
    current = idx;
    positionTrack(true);
  }

  // After transition ends, check if we need to jump to the real slide
  $track.on('transitionend', function () {
    isTransitioning = false;
    // If we scrolled into the clones after the originals, jump back
    if (current >= total * 2) {
      current = current - total;
      positionTrack(false);
    }
    // If we scrolled into the clones before the originals, jump forward
    if (current < total) {
      current = current + total;
      positionTrack(false);
    }
  });

  // Initialize
  positionTrack(false);

  $('#hero-prev').on('click', function () { goTo(current - 1); });
  $('#hero-next').on('click', function () { goTo(current + 1); });

  // Auto-advance every 5s
  setInterval(function () { if (!isTransitioning) goTo(current + 1); }, 5000);

  // Touch swipe support
  var touchStartX = 0;
  var touchEndX = 0;
  $track[0].addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
  $track[0].addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    var diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) {
      if (diff > 0) goTo(current + 1);
      else goTo(current - 1);
    }
  });

  // Recalculate on resize
  $(window).on('resize', function () { positionTrack(false); });
});
</script>
