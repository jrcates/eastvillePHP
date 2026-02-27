<?php
require_once __DIR__ . '/../data.php';

// ─── Regenerate comedian data (same logic as comedians.php) ───
$firstNames = ["James","Sarah","Michael","Jessica","David","Emily","Robert","Jennifer","William","Elizabeth","Joseph","Maria","Thomas","Lisa","Charles","Ashley"];
$lastNames  = ["Chen","Johnson","Smith","Williams","Brown","Jones","Garcia","Miller","Davis","Rodriguez","Martinez","Hernandez","Lopez","Gonzalez","Wilson","Anderson"];
$images     = [
  "https://images.unsplash.com/photo-1580188928585-0ef5c1a5c4dd?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1726222959627-08918486e0c4?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1766532573885-8bd94537f1c4?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1719437364589-17a545612428?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1657771072153-878f8b0ce74a?auto=format&fit=crop&q=80&w=800",
  "https://images.unsplash.com/photo-1745848413113-4f39bdad5769?auto=format&fit=crop&q=80&w=800",
];
$bios = [
  "Regular at The Comedy Cellar and seen on The Tonight Show.",
  "Featured on Netflix's 'The Standups' and Comedy Central.",
  "Winner of the New York Comedy Festival's Funniest Stand-up.",
  "Writer for Saturday Night Live and touring headliner.",
  "Host of the popular 'Brooklyn Laughs' podcast.",
  "Seen on HBO's 'Crashing' and Late Night with Seth Meyers.",
  "Just for Laughs New Face and EastVille regular.",
  "Top touring act performing across the country.",
];

$allComedians = [];
for ($i = 0; $i < 160; $i++) {
  $allComedians[] = [
    'id'         => $i,
    'name'       => $firstNames[$i % count($firstNames)] . ' ' . $lastNames[(int)floor($i / count($firstNames)) % count($lastNames)],
    'image'      => $images[$i % count($images)],
    'bio'        => $bios[$i % count($bios)],
    'isHeadliner'=> ($i % 5 === 0),
  ];
}

// ─── Find the requested comedian ───
$comedianId = isset($_GET['id']) ? intval($_GET['id']) : -1;
$comedian = null;
foreach ($allComedians as $c) {
  if ($c['id'] === $comedianId) {
    $comedian = $c;
    break;
  }
}

if (!$comedian) {
  echo '<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-black mb-4">Comedian Not Found</h1>';
  echo '<p class="text-neutral-400 mb-8">We couldn\'t find the comedian you\'re looking for.</p>';
  echo '<a href="?view=comedians" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors">Back to Comedians</a>';
  echo '</div>';
  return;
}

// ─── Match comedian to shows ───
function matchesComedian($lineupName, $comedianName) {
  $clean = preg_replace('/^(Host:\s*|Opener:\s*)/i', '', $lineupName);
  return stripos(trim($clean), $comedianName) !== false;
}

$appearances = [];
foreach ($shows as $show) {
  foreach ($show['lineup'] as $performer) {
    if (matchesComedian($performer, $comedian['name'])) {
      $appearances[] = $show;
      break;
    }
  }
}

// If no real matches, assign shows deterministically so the page always has content
if (empty($appearances)) {
  $showCount = count($shows);
  $offset = $comedian['id'] % $showCount;
  for ($i = 0; $i < 3; $i++) {
    $appearances[] = $shows[($offset + $i) % $showCount];
  }
}

$firstName = explode(' ', $comedian['name'])[0];

// Extended bio paragraphs
$extendedBio = [
  "With over a decade of experience performing in comedy clubs across the nation, " . $comedian['name'] . " has built a reputation for sharp, observational humor that resonates with audiences of all backgrounds. Their unique perspective on everyday life, relationships, and modern culture has earned them a dedicated following.",
  "When not on stage, " . $comedian['name'] . " can be found writing new material, mentoring up-and-coming comedians, and making appearances on popular podcasts. Their commitment to the craft of comedy is evident in every performance, bringing fresh energy and authentic storytelling to each show at EastVille Comedy Club.",
];
?>

<!-- ─── Header ─── -->
<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
    <div>
      <span class="text-[#24CECE] text-sm font-bold uppercase tracking-widest mb-3 block">Artist Spotlight</span>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight">Comedian Profile</h1>
    </div>
    <a href="?view=comedians" class="flex items-center gap-1.5 text-sm text-neutral-400 hover:text-white transition-colors px-4 py-2 rounded-[5px] border border-neutral-700 hover:border-neutral-500">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back
    </a>
  </div>

  <!-- ─── Profile Card ─── -->
  <div class="rounded-[5px] overflow-hidden mb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
      <!-- Photo -->
      <div class="lg:col-span-5">
        <div class="aspect-[3/4] w-full">
          <img src="<?= htmlspecialchars($comedian['image']) ?>" alt="<?= htmlspecialchars($comedian['name']) ?>" class="w-full h-full object-cover" />
        </div>
      </div>
      <!-- Info -->
      <div class="lg:col-span-7 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
        <span class="inline-block px-3 py-1 bg-neutral-700/50 text-neutral-300 text-xs font-bold uppercase tracking-widest rounded-[5px] w-fit mb-6">Stand-Up Comic</span>

        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight mb-6"><?= htmlspecialchars($comedian['name']) ?></h2>

        <!-- Social Icons -->
        <div class="flex gap-3 mb-8">
          <a href="#" class="w-10 h-10 rounded-full border border-neutral-600 flex items-center justify-center text-neutral-400 hover:border-[#24CECE] hover:text-[#24CECE] transition-colors">
            <i data-lucide="instagram" class="w-4 h-4"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-full border border-neutral-600 flex items-center justify-center text-neutral-400 hover:border-[#24CECE] hover:text-[#24CECE] transition-colors">
            <i data-lucide="twitter" class="w-4 h-4"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-full border border-neutral-600 flex items-center justify-center text-neutral-400 hover:border-[#24CECE] hover:text-[#24CECE] transition-colors">
            <i data-lucide="facebook" class="w-4 h-4"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-full border border-neutral-600 flex items-center justify-center text-neutral-400 hover:border-[#24CECE] hover:text-[#24CECE] transition-colors">
            <i data-lucide="globe" class="w-4 h-4"></i>
          </a>
        </div>

        <!-- Bio -->
        <p class="text-white font-bold text-lg mb-4"><?= htmlspecialchars($comedian['bio']) ?></p>
        <?php foreach ($extendedBio as $paragraph): ?>
        <p class="text-neutral-400 leading-relaxed mb-4"><?= htmlspecialchars($paragraph) ?></p>
        <?php endforeach; ?>

        <!-- Share Button -->
        <div class="mt-6">
          <button class="inline-flex items-center gap-2 px-6 py-3 bg-white text-neutral-900 rounded-full font-bold text-sm uppercase tracking-wider hover:bg-neutral-200 transition-colors">
            <i data-lucide="share-2" class="w-4 h-4"></i>
            Share Profile
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ─── Upcoming Appearances ─── -->
  <div class="mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
      <div>
        <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">Upcoming Appearances</h2>
        <p class="text-neutral-400">Catch <?= htmlspecialchars($firstName) ?> at these upcoming shows</p>
      </div>
      <a href="?view=schedule" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors">View Full Calendar</a>
    </div>

    <div class="space-y-4">
      <?php foreach ($appearances as $show):
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
          <h3 class="text-2xl font-black text-black uppercase mb-3"><?= htmlspecialchars($show['title']) ?></h3>
          <div class="flex items-center gap-2 bg-[#F26522] text-white text-xs font-bold px-3 py-1.5 rounded-[5px] mb-3 w-fit">
            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
            <span class="uppercase"><?= htmlspecialchars($show['location']) ?>, South Glastonbury, CT</span>
          </div>
          <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2"><?= htmlspecialchars($show['description']) ?></p>
        </div>
        <!-- Button -->
        <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap flex-shrink-0 hover-lift shadow-lg shadow-[#24CECE]/20">Get Tickets</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
