<?php
require_once __DIR__ . '/../data.php';

$seriesName = isset($_GET['name']) ? $_GET['name'] : null;

// Find all shows in this series
$seriesShows = [];
$seriesImage = '';
foreach ($shows as $s) {
  if (isset($s['series']) && $s['series'] === $seriesName) {
    $seriesShows[] = $s;
    if (!$seriesImage) $seriesImage = $s['image'];
  }
}

if (!$seriesName || empty($seriesShows)) {
  echo '<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen text-center">';
  echo '<h1 class="text-4xl font-black mb-4">Series Not Found</h1>';
  echo '<p class="text-neutral-400 mb-8">The show series you\'re looking for doesn\'t exist.</p>';
  echo '<a href="?view=schedule" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors">View Schedule</a>';
  echo '</div>';
  return;
}

// Series metadata
$firstShow = $seriesShows[0];
$dayOfWeek = date('l', strtotime($firstShow['date']));
$showTime  = $firstShow['time'];
$totalShows = count($seriesShows);

// Series descriptions
$seriesDescriptions = [
  'Monday Prime-Time Comedy in Brooklyn!' => [
    'tagline' => 'The best way to start your week.',
    'about'   => 'Every Monday night, EastVille Comedy Club lights up with our signature Prime-Time show. Featuring a rotating lineup of the city\'s best up-and-coming comedians and seasoned pros, this weekly showcase is the perfect cure for the Monday blues. Grab a drink, settle in, and let Brooklyn\'s finest comedians turn your week around.',
    'extra'   => 'Monday Prime-Time has become a staple of Brooklyn\'s comedy scene, drawing both regulars and newcomers week after week. With a laid-back atmosphere and world-class talent, it\'s the kind of show that makes you look forward to Mondays.',
  ],
  'Comedy Spotlight' => [
    'tagline' => 'Where rising stars shine brightest.',
    'about'   => 'Every Tuesday, our Comedy Spotlight puts the focus on the freshest voices in New York comedy. This intimate showcase in our Lounge is where careers are launched and legends are born. You never know who might drop in to test new material or surprise the crowd.',
    'extra'   => 'Comedy Spotlight has a track record of featuring comedians before they blow up. If you want to say "I saw them when," this is the show for you. The relaxed Tuesday vibe makes it perfect for a casual night out with big laughs.',
  ],
  'Comedy Loves Ya' => [
    'tagline' => 'Mid-week therapy, Brooklyn style.',
    'about'   => 'Wednesday nights belong to Comedy Loves Ya — our mid-week showcase that proves comedy really does love you back. A stacked lineup of established headliners and fan favorites makes this the perfect way to break up the work week with wall-to-wall laughs.',
    'extra'   => 'Comedy Loves Ya has earned its reputation as one of the most consistent shows on the Brooklyn comedy circuit. Whether you\'re a first-timer or a regular, you\'ll leave feeling the love — and probably with sore abs from laughing.',
  ],
  'Weekend Warmup comedy in Brooklyn!' => [
    'tagline' => 'The weekend starts here.',
    'about'   => 'Every Friday at 7:00 PM, Weekend Warmup kicks off the weekend with raw, unfiltered comedy from Brooklyn\'s hottest performers. This high-energy show sets the tone for your entire weekend with no-holds-barred stand-up that will have you rolling.',
    'extra'   => 'Weekend Warmup is the show that gets you fired up for Friday night. Come early, grab your drinks, and get ready for a lineup that hits hard and fast. It\'s the perfect pre-game for whatever your weekend has in store.',
  ],
  'TGIF Comedy in Brooklyn!' => [
    'tagline' => 'Thank God It\'s Funny.',
    'about'   => 'Following the Weekend Warmup every Friday at 7:30 PM, TGIF Comedy brings a different energy — edgier, louder, and just as hilarious. Celebrate the end of the work week with a night of pure comedy gold alongside your crew.',
    'extra'   => 'TGIF is Brooklyn\'s go-to Friday night comedy experience. The later slot means a crowd that\'s warmed up and ready to go, and our comedians bring their A-game every single week. Bring your friends — this one\'s a party.',
  ],
  'Saturday Standup Live!' => [
    'tagline' => 'The biggest night in Brooklyn comedy.',
    'about'   => 'Saturday Standup Live is our flagship show — the crown jewel of the EastVille weekly lineup. Every Saturday at 8:00 PM, the Main Stage hosts the biggest names and the best talent for a premium comedy experience. This is THE night out in Brooklyn.',
    'extra'   => 'Saturday nights at EastVille are legendary. From surprise drop-ins to headliner sets that go viral, Saturday Standup Live consistently delivers unforgettable nights. Dress up, show up, and laugh it up — this is the main event.',
  ],
  'Guy\'z Nite Comedy' => [
    'tagline' => 'Round up the boys. Sunday nights are for laughs.',
    'about'   => 'Every Sunday at 8:00 PM, Guy\'z Nite takes over the Lounge for an evening of raw, unfiltered comedy. Kick back with your crew, cold drinks in hand, and enjoy a lineup of comedians who keep it real and keep it hilarious.',
    'extra'   => 'Guy\'z Nite has become a Sunday tradition at EastVille. It\'s the perfect way to end the weekend — relaxed atmosphere, great company, and non-stop laughs. Everyone\'s welcome, but the vibe is strictly good times.',
  ],
];

$meta = isset($seriesDescriptions[$seriesName]) ? $seriesDescriptions[$seriesName] : [
  'tagline' => 'A recurring show at EastVille Comedy Club.',
  'about'   => 'Join us for this weekly showcase at EastVille Comedy Club in the heart of Brooklyn.',
  'extra'   => 'Check below for all upcoming dates and grab your tickets.',
];
?>

<!-- ─── Header ─── -->
<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
    <div>
      <span class="text-[#F26522] text-sm font-bold uppercase tracking-widest mb-3 block">Recurring Show</span>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight">Show Series</h1>
    </div>
    <a href="?view=schedule" class="flex items-center gap-1.5 text-sm text-neutral-400 hover:text-white transition-colors px-4 py-2 rounded-[5px] border border-neutral-700 hover:border-neutral-500">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back to Schedule
    </a>
  </div>

  <!-- ─── Series Profile Card ─── -->
  <div class="rounded-[5px] overflow-hidden mb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
      <!-- Image -->
      <div class="lg:col-span-5">
        <div class="aspect-[3/4] w-full">
          <img src="<?= htmlspecialchars($seriesImage) ?>" alt="<?= htmlspecialchars($seriesName) ?>" class="w-full h-full object-cover" />
        </div>
      </div>
      <!-- Info -->
      <div class="lg:col-span-7 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
        <div class="flex flex-wrap gap-2 mb-6">
          <span class="inline-block px-3 py-1 bg-[#F26522]/20 text-[#F26522] text-xs font-bold uppercase tracking-widest rounded-[5px]">Every <?= htmlspecialchars($dayOfWeek) ?></span>
          <span class="inline-block px-3 py-1 bg-neutral-700/50 text-neutral-300 text-xs font-bold uppercase tracking-widest rounded-[5px]"><?= htmlspecialchars($showTime) ?></span>
        </div>

        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight mb-6"><?= htmlspecialchars($seriesName) ?></h2>

        <!-- Quick Stats -->
        <div class="flex flex-wrap gap-6 mb-8">
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="calendar" class="w-4 h-4 text-[#24CECE]"></i>
            <span class="text-sm font-medium"><?= $totalShows ?> upcoming shows</span>
          </div>
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="map-pin" class="w-4 h-4 text-[#24CECE]"></i>
            <span class="text-sm font-medium"><?= htmlspecialchars($firstShow['location']) ?>, EastVille</span>
          </div>
          <div class="flex items-center gap-2 text-neutral-400">
            <i data-lucide="ticket" class="w-4 h-4 text-[#24CECE]"></i>
            <span class="text-sm font-medium">From <?= htmlspecialchars($firstShow['price']) ?></span>
          </div>
        </div>

        <!-- Tagline & Description -->
        <p class="text-white font-bold text-lg mb-4"><?= htmlspecialchars($meta['tagline']) ?></p>
        <p class="text-neutral-400 leading-relaxed mb-4"><?= htmlspecialchars($meta['about']) ?></p>
        <p class="text-neutral-400 leading-relaxed mb-8"><?= htmlspecialchars($meta['extra']) ?></p>

        <!-- CTA -->
        <div class="flex flex-wrap gap-3">
          <a href="#upcoming" class="inline-flex items-center gap-2 px-6 py-3 bg-[#24CECE] text-black rounded-full font-bold text-sm uppercase tracking-wider hover:bg-[#20B8B8] transition-colors">
            <i data-lucide="ticket" class="w-4 h-4"></i>
            View All Dates
          </a>
          <button class="inline-flex items-center gap-2 px-6 py-3 bg-white text-neutral-900 rounded-full font-bold text-sm uppercase tracking-wider hover:bg-neutral-200 transition-colors">
            <i data-lucide="share-2" class="w-4 h-4"></i>
            Share
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ─── All Upcoming Shows ─── -->
  <div id="upcoming" class="mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
      <div>
        <h2 class="text-3xl font-bold uppercase tracking-wide mb-2">All Upcoming Dates</h2>
        <p class="text-neutral-400">Every <?= htmlspecialchars($dayOfWeek) ?> at <?= htmlspecialchars($showTime) ?></p>
      </div>
      <a href="?view=schedule" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full uppercase tracking-wider text-xs hover:bg-[#20B8B8] transition-colors">View Full Calendar</a>
    </div>

    <div class="space-y-4">
      <?php foreach ($seriesShows as $show):
        $d = formatShowDate($show['date']);
        $isSoldOut = $show['status'] === 'Sold Out';
      ?>
      <div class="show-card bg-white rounded-[5px] p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-neutral-800">
        <!-- Date Badge -->
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
          <div class="flex flex-wrap justify-between items-start w-full mb-3 gap-2">
            <h3 class="text-[20px] font-extrabold text-black uppercase"><?= htmlspecialchars($show['title']) ?></h3>
            <?php if ($isSoldOut): ?>
            <span class="text-xs font-bold uppercase tracking-wider text-red-500 border border-red-500 px-2 py-1 rounded whitespace-nowrap">Sold Out</span>
            <?php elseif ($show['status'] === 'Selling Fast'): ?>
            <span class="text-xs font-bold uppercase tracking-wider text-[#F26522] border border-[#F26522] px-2 py-1 rounded whitespace-nowrap">Selling Fast</span>
            <?php endif; ?>
          </div>
          <div class="flex items-center gap-2 bg-[#F26522] text-white text-xs font-bold px-3 py-1.5 rounded-[5px] mb-3 w-fit">
            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
            <span class="uppercase"><?= htmlspecialchars($show['location']) ?>, EastVille Comedy Club</span>
          </div>
          <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2"><?= htmlspecialchars($show['description']) ?></p>
        </div>
        <!-- Button -->
        <?php if ($isSoldOut): ?>
        <button disabled class="px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap flex-shrink-0 bg-neutral-800 text-neutral-500 cursor-not-allowed">Sold Out</button>
        <?php else: ?>
        <a href="?view=event&show=<?= urlencode($show['id']) ?>" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap flex-shrink-0 hover-lift shadow-lg shadow-[#24CECE]/20">Get Tickets</a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
