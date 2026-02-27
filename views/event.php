<?php
require_once __DIR__ . '/../data.php';

$showId = isset($_GET['show']) ? $_GET['show'] : null;
$show = null;

foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    break;
  }
}

if (!$show) {
  echo '<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-bold mb-4">Event Not Found</h1>';
  echo '<p class="text-neutral-400 mb-8">The event you\'re looking for doesn\'t exist.</p>';
  echo '<a href="?view=schedule" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors">View Schedule</a>';
  echo '</div>';
  return;
}

$d = formatShowDate($show['date']);
$isSoldOut = $show['status'] === 'Sold Out';
$priceValue = $show['priceValue'];

// Generate initials from performer name
function getInitials(string $name): string {
  // Strip prefix like "Host: "
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $name);
  $words = explode(' ', trim($clean));
  if (count($words) >= 2) {
    return strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
  }
  return strtoupper(mb_substr($clean, 0, 2));
}

$avatarColors = ['#C084FC', '#9CA3AF', '#F59E0B', '#6B7280', '#EC4899', '#34D399', '#F97316', '#60A5FA'];

// Generate comedian lookup for linking performers
$cfn = ["James","Sarah","Michael","Jessica","David","Emily","Robert","Jennifer","William","Elizabeth","Joseph","Maria","Thomas","Lisa","Charles","Ashley"];
$cln = ["Chen","Johnson","Smith","Williams","Brown","Jones","Garcia","Miller","Davis","Rodriguez","Martinez","Hernandez","Lopez","Gonzalez","Wilson","Anderson"];
$comedianLookup = [];
for ($ci = 0; $ci < 160; $ci++) {
  $cname = $cfn[$ci % count($cfn)] . ' ' . $cln[(int)floor($ci / count($cfn)) % count($cln)];
  $comedianLookup[strtolower($cname)] = $ci;
}

function findComedianId(string $performer, array $lookup): ?int {
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $performer);
  $clean = strtolower(trim($clean));
  return isset($lookup[$clean]) ? $lookup[$clean] : null;
}
?>

<div class="pt-[140px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- ─── Tab Navigation ─── -->
  <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex flex-wrap items-center gap-2">
      <a href="#about-section" class="event-tab text-sm font-medium px-4 py-2 rounded-[5px] border border-neutral-300 bg-white text-black transition-colors">About</a>
      <a href="#restrictions-section" class="event-tab text-xs md:text-sm font-medium px-3 md:px-4 py-2 rounded-[5px] border border-neutral-300 bg-white text-black transition-colors">Restrictions</a>
    </div>
    <a href="?view=schedule" class="flex items-center gap-1.5 text-sm text-neutral-400 hover:text-white transition-colors px-4 py-2 rounded-[5px] border border-neutral-700 hover:border-neutral-500">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back
    </a>
  </div>

  <!-- ─── Hero Banner (matches homepage carousel card) ─── -->
  <style>
    .event-hero-card { width: 100%; min-height: 420px; display: flex; background: white; border-radius: 5px; overflow: hidden; position: relative; }
    @media (max-width: 1280px) {
      .event-hero-card { height: auto; flex-direction: column; }
    }
  </style>
  <div class="mb-12">
    <div class="event-hero-card">
      <!-- Left Content -->
      <div class="w-full md:w-[678px] h-full p-6 md:p-12 md:pl-16 flex flex-col justify-center gap-6 bg-white text-neutral-900 relative z-10">
        <!-- Date Badge -->
        <div class="flex flex-col items-center w-fit">
          <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center min-w-[80px] bg-white">
            <div class="text-sm font-bold text-black leading-none"><?= $d['weekday'] ?></div>
            <div class="text-5xl font-black leading-none text-black my-1"><?= $d['day'] ?></div>
            <div class="text-sm font-bold text-black leading-none"><?= $d['month'] ?></div>
          </div>
          <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= $d['time'] ?></div>
        </div>

        <div class="space-y-4 max-w-lg relative z-10">
          <h1 class="text-3xl md:text-5xl font-black uppercase leading-[0.9] tracking-tight text-black"><?= htmlspecialchars($show['title']) ?></h1>
          <div class="inline-flex items-center gap-2 bg-[#F26522] text-white text-sm font-medium px-4 py-2 rounded-[5px] w-fit">
            <i data-lucide="map-pin" class="w-4 h-4"></i>
            EastVille Comedy Club
          </div>
        </div>
      </div>
      <!-- Right Image -->
      <div class="hidden md:block absolute top-1/2 right-12 -translate-y-1/2 w-[420px] h-[340px] rounded-[5px] overflow-hidden shadow-2xl">
        <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover" />
      </div>
      <!-- Mobile Image Fallback -->
      <div class="md:hidden w-full h-[200px]">
        <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="w-full h-full object-cover" />
      </div>
    </div>
  </div>

  <!-- ─── Two Column Layout ─── -->
  <div class="grid lg:grid-cols-12 gap-12">

    <!-- ─── Left Column ─── -->
    <div class="lg:col-span-7 space-y-10 order-2 lg:order-1">

      <!-- ABOUT -->
      <div id="about-section">
        <h2 class="text-lg font-black uppercase tracking-wide text-white mb-4">About</h2>
        <div id="about-text" class="text-neutral-400 text-base leading-relaxed line-clamp-3">
          <p><?= htmlspecialchars($show['description']) ?> Join us at EastVille Comedy Club in the heart of Brooklyn for an unforgettable night of live entertainment. Our intimate venue offers the perfect setting to experience comedy up close and personal, with excellent sightlines from every seat in the house. Whether you're a seasoned comedy fan or a first-timer, this show promises non-stop laughs from start to finish. Doors open one hour before showtime — arrive early to grab a drink from our full bar and settle into the best seats. EastVille has been a cornerstone of Brooklyn's comedy scene, hosting both rising stars and legendary performers in an atmosphere that feels like home.</p>
        </div>
        <button id="read-more-btn" class="text-[#24CECE] text-sm font-bold mt-3 hover:text-[#20B8B8] transition-colors">Read More...</button>
      </div>

      <!-- FEATURING (only comedians with profiles, min 3) -->
      <?php
        $profiledPerformers = [];
        $usedIds = [];
        if (!empty($show['lineup'])) {
          foreach ($show['lineup'] as $i => $performer) {
            $cId = findComedianId($performer, $comedianLookup);
            if ($cId !== null) {
              $profiledPerformers[] = ['name' => $performer, 'id' => $cId, 'index' => $i];
              $usedIds[] = $cId;
            }
          }
        }
        // Fill up to 3 with other comedians based on show ID for consistency
        $minFeatured = 3;
        if (count($profiledPerformers) < $minFeatured) {
          $showSeed = crc32($show['id']);
          $allIds = array_keys($comedianLookup);
          $allNames = array_flip($comedianLookup);
          $needed = $minFeatured - count($profiledPerformers);
          $offset = abs($showSeed) % 160;
          for ($fi = 0; $fi < 160 && $needed > 0; $fi++) {
            $candidateId = ($offset + $fi) % 160;
            if (!in_array($candidateId, $usedIds)) {
              $cname = $cfn[$candidateId % count($cfn)] . ' ' . $cln[(int)floor($candidateId / count($cfn)) % count($cln)];
              $profiledPerformers[] = ['name' => $cname, 'id' => $candidateId, 'index' => count($profiledPerformers)];
              $usedIds[] = $candidateId;
              $needed--;
            }
          }
        }
      ?>
      <?php if (!empty($profiledPerformers)): ?>
      <div>
        <h2 class="text-lg font-black uppercase tracking-wide text-white mb-6">Featuring</h2>
        <div class="flex flex-wrap gap-5">
          <?php foreach ($profiledPerformers as $p):
            $initials = getInitials($p['name']);
            $bgColor = $avatarColors[$p['index'] % count($avatarColors)];
          ?>
          <a href="?view=comedian&id=<?= $p['id'] ?>" class="flex flex-col items-center gap-2 w-[130px] group">
            <div class="w-[130px] h-[130px] rounded-[8px] flex items-center justify-center group-hover:ring-2 group-hover:ring-[#24CECE] transition-all" style="background-color: <?= $bgColor ?>">
              <span class="text-4xl font-black text-white tracking-wider"><?= $initials ?></span>
            </div>
            <span class="text-sm font-bold text-white text-center leading-tight group-hover:text-[#24CECE] transition-colors"><?= htmlspecialchars($p['name']) ?></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- SERIES BANNER -->
      <?php if (!empty($show['series'])): ?>
      <a href="?view=series&name=<?= urlencode($show['series']) ?>" class="block w-full bg-[#F26522] hover:bg-[#D9551A] transition-colors text-white font-semibold text-center py-3.5 px-6 rounded-[8px] text-sm md:text-base">
        This event is part of: <?= htmlspecialchars($show['series']) ?>!
      </a>
      <?php endif; ?>

      <!-- RESTRICTIONS & REQUIREMENTS -->
      <div id="restrictions-section" class="bg-white rounded-[10px] border border-neutral-200 p-8">
        <h2 class="text-lg font-black uppercase tracking-wide text-black mb-6 flex items-center gap-2">
          <i data-lucide="info" class="w-5 h-5 text-neutral-500"></i>
          Restrictions &amp; Requirements
        </h2>
        <ul class="space-y-5 text-sm text-neutral-600">
          <li class="flex items-start gap-3">
            <i data-lucide="clock" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">Arrive 30 mins before showtime</strong> as seating is on a first-come basis. Those arriving late are not guaranteed seats as we begin seating standby customers. If reservations are missed, tickets may be used another time without penalty.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span>There is a <strong class="text-black">2-drink minimum</strong> for all shows.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">LINE-UPS SUBJECT TO CHANGE.</strong> If you're coming to see a specific performer, please note they might not be in the lineup. Rosters are current at time of posting but may get switched around. Tickets are for a comedy show, not for any specific performer.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="circle-check" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span>
          </li>
          <li class="flex items-start gap-3">
            <i data-lucide="list" class="w-5 h-5 text-neutral-400 shrink-0 mt-0.5"></i>
            <span><strong class="text-black">'Front Row' and 'Gold Front Row VIP'</strong> tickets guarantee stage-side seats and expedited check-in. General admission seating is first-come. 'Front Row' tickets are a way to secure patrons' seats of choice.</span>
          </li>
        </ul>
        <div class="mt-6 pt-4 border-t border-neutral-200">
          <span class="inline-block text-xs font-bold uppercase tracking-wider text-neutral-500 border border-neutral-300 px-3 py-1.5 rounded-[5px]">All Sales Are Final</span>
        </div>
      </div>
    </div>

    <!-- ─── Right Column: Purchase Tickets ─── -->
    <div class="lg:col-span-5 order-1 lg:order-2">
      <div class="bg-white p-8 rounded-[10px] shadow-xl sticky top-32 text-black space-y-6">

        <h2 class="text-2xl font-black uppercase tracking-tight text-black">Purchase Tickets</h2>

        <!-- Ticket Type -->
        <div class="border border-neutral-200 rounded-[8px] p-5">
          <div class="flex items-center justify-between mb-1">
            <span class="font-bold text-black text-lg">General Admission</span>
            <span class="text-xl font-black text-black"><?= htmlspecialchars($show['price']) ?></span>
          </div>
          <p class="text-sm text-neutral-400">Standard seating</p>
        </div>

        <!-- Quantity -->
        <?php if (!$isSoldOut): ?>
        <div class="flex items-center justify-between">
          <span class="text-sm font-bold uppercase tracking-wider text-neutral-500">Quantity</span>
          <div class="flex items-center gap-3">
            <button id="qty-minus" class="w-9 h-9 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-400 hover:border-neutral-500 hover:text-black transition-colors">
              <i data-lucide="minus" class="w-4 h-4"></i>
            </button>
            <input id="qty-input" type="text" value="1" readonly class="w-12 text-center font-bold text-lg border border-neutral-300 rounded-[5px] py-1" />
            <button id="qty-plus" class="w-9 h-9 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-400 hover:border-neutral-500 hover:text-black transition-colors">
              <i data-lucide="plus" class="w-4 h-4"></i>
            </button>
          </div>
        </div>

        <!-- Total -->
        <div class="flex items-center justify-between pt-4 border-t border-neutral-200">
          <span class="text-base font-medium text-neutral-600">Total</span>
          <span id="total-price" class="text-2xl font-black text-black"><?= htmlspecialchars($show['price']) ?></span>
        </div>

        <p class="text-xs text-neutral-400 text-center">* Promo codes can be added in the next step</p>

        <!-- Checkout Button -->
        <a href="?view=addons&show=<?= urlencode($show['id']) ?>&qty=1" id="checkout-btn" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center">Checkout</a>

        <p class="text-xs text-neutral-400 text-center flex items-center justify-center gap-1.5">
          <i data-lucide="lock" class="w-3.5 h-3.5"></i>
          Secure Checkout powered by Stripe
        </p>

        <?php else: ?>
        <!-- Sold Out State -->
        <div class="pt-4 border-t border-neutral-200 text-center">
          <button disabled class="w-full py-4 bg-neutral-200 text-neutral-500 font-black text-base uppercase tracking-wider rounded-[8px] cursor-not-allowed">Sold Out</button>
          <p class="text-xs text-neutral-400 mt-3">This show is sold out. Check our schedule for other available shows.</p>
        </div>
        <?php endif; ?>

      </div>
    </div>

  </div>
</div>

<!-- ─── Event Page JS ─── -->
<script>
$(function () {
  var price = <?= $priceValue ?>;
  var qty = 1;
  var maxQty = 10;

  function updateTotal() {
    var total = price * qty;
    $('#total-price').text('$' + total);
    $('#qty-input').val(qty);
    $('#checkout-btn').attr('href', '?view=addons&show=<?= urlencode($show['id']) ?>&qty=' + qty);
  }

  $('#qty-minus').on('click', function () {
    if (qty > 1) { qty--; updateTotal(); }
  });

  $('#qty-plus').on('click', function () {
    if (qty < maxQty) { qty++; updateTotal(); }
  });

  // Read More / Read Less toggle
  var $aboutText = $('#about-text');
  var $readMoreBtn = $('#read-more-btn');
  var expanded = false;

  $readMoreBtn.on('click', function () {
    expanded = !expanded;
    if (expanded) {
      $aboutText.removeClass('line-clamp-3');
      $readMoreBtn.text('Read Less');
    } else {
      $aboutText.addClass('line-clamp-3');
      $readMoreBtn.text('Read More...');
    }
  });

  // Smooth scroll for tab anchors
  $('.event-tab').on('click', function (e) {
    e.preventDefault();
    var target = $($(this).attr('href'));
    if (target.length) {
      $('html, body').animate({ scrollTop: target.offset().top - 120 }, 400);
    }
  });
});
</script>
