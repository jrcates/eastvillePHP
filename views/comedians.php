<?php
// Generate comedian data server-side
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

$search      = isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'])) : '';
$page        = max(1, intval($_GET['page'] ?? 1));
$perPage     = 16;

$filtered = array_filter($allComedians, fn($c) => !$search || stripos($c['name'], $search) !== false);
$filtered = array_values($filtered);
$total    = count($filtered);
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$current = array_slice($filtered, ($page - 1) * $perPage, $perPage);
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- Header & Search -->
  <div class="flex flex-col items-center text-center gap-8 mb-20">
    <div>
      <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">
        OUR <span class="text-[#24CECE]">COMEDIANS</span>
      </h1>
      <p class="text-xl text-neutral-400 max-w-2xl mx-auto">
        Meet the talented performers lighting up our stage. From rising stars to seasoned headliners, we bring you the best laughs in Brooklyn.
      </p>
    </div>

    <!-- Search -->
    <form method="GET" action="?view=comedians" class="w-full">
      <input type="hidden" name="view" value="comedians" />
      <div class="relative flex items-center bg-neutral-900/80 border border-neutral-700 rounded-[5px] p-2 shadow-2xl focus-within:border-[#24CECE] transition-all group">
        <i data-lucide="search" class="ml-3 md:ml-5 w-5 h-5 md:w-6 md:h-6 text-neutral-500 group-focus-within:text-[#24CECE] transition-colors shrink-0"></i>
        <input type="text" name="q" value="<?= $search ?>" placeholder="Search by name..." class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-base md:text-lg px-3 md:px-4 text-white placeholder:text-neutral-500 h-10 md:h-12 min-w-0" />
        <button type="submit" class="bg-[#24CECE] text-neutral-950 font-bold py-2.5 md:py-3 px-5 md:px-8 rounded-[5px] hover:bg-[#20B8B8] transition-all shrink-0 text-sm md:text-base">Search</button>
      </div>
    </form>
  </div>

  <!-- Grid -->
  <?php if (count($current) > 0): ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 mb-16">
    <?php foreach ($current as $comedian): ?>
    <a href="?view=comedian&id=<?= $comedian['id'] ?>" class="group cursor-pointer block">
      <div class="relative overflow-hidden rounded-[5px] mb-4 aspect-[3/4] bg-neutral-900 border border-neutral-800 shadow-lg group-hover:border-[#24CECE]/50 transition-colors duration-300">
        <div class="absolute inset-0 bg-gradient-to-t from-neutral-950/90 via-neutral-950/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity z-10 duration-300"></div>
        <img src="<?= htmlspecialchars($comedian['image']) ?>" alt="<?= htmlspecialchars($comedian['name']) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0" />
        <?php if ($comedian['isHeadliner']): ?>
        <div class="absolute top-4 right-4 z-20">
          <span class="inline-flex items-center gap-1 px-3 py-1 rounded-[5px] bg-[#24CECE] text-neutral-900 text-xs font-bold uppercase tracking-wide shadow-lg">
            ★ Headliner
          </span>
        </div>
        <?php endif; ?>
        <div class="absolute bottom-0 left-0 right-0 p-6 z-20 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
          <span class="inline-flex items-center gap-1 px-3 py-1 rounded-[5px] bg-white text-neutral-900 text-xs font-bold uppercase tracking-wide mb-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-[#24CECE]">
            🎤 View Profile
          </span>
          <h3 class="text-xl font-bold text-white group-hover:text-[#24CECE] transition-colors"><?= htmlspecialchars($comedian['name']) ?></h3>
          <p class="text-neutral-400 text-sm mt-2 group-hover:text-neutral-300 transition-colors" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?= htmlspecialchars($comedian['bio']) ?></p>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
  <div class="text-center py-20 bg-neutral-900/50 rounded-[5px] border border-neutral-800">
    <p class="text-3xl font-bold mb-2 text-white">No comedians found</p>
    <p class="text-neutral-500 mb-8 text-lg">We couldn't find anyone matching "<?= $search ?>".</p>
    <a href="?view=comedians" class="px-8 py-3 bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-[5px] transition-colors">Clear search</a>
  </div>
  <?php endif; ?>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
  <div class="flex flex-col items-center gap-6 mt-20 border-t border-neutral-900 pt-10">
    <div class="flex items-center gap-3 flex-wrap justify-center">
      <?php if ($page > 1): ?>
      <a href="?view=comedians&q=<?= urlencode($search) ?>&page=<?= $page - 1 ?>" class="w-12 h-12 rounded-[5px] bg-neutral-900 border border-neutral-800 flex items-center justify-center text-neutral-400 hover:bg-neutral-800 hover:text-white transition-colors">
        <i data-lucide="chevron-left" class="w-6 h-6"></i>
      </a>
      <?php else: ?>
      <span class="w-12 h-12 rounded-[5px] bg-neutral-900 border border-neutral-800 flex items-center justify-center text-neutral-600 opacity-50">
        <i data-lucide="chevron-left" class="w-6 h-6"></i>
      </span>
      <?php endif; ?>

      <?php for ($p = 1; $p <= $totalPages; $p++):
        if ($totalPages > 10 && abs($p - $page) > 2 && $p !== 1 && $p !== $totalPages) continue;
      ?>
      <a href="?view=comedians&q=<?= urlencode($search) ?>&page=<?= $p ?>"
         class="w-12 h-12 rounded-[5px] font-bold transition-all text-lg flex items-center justify-center <?= $p === $page ? 'bg-[#24CECE] text-neutral-900 scale-110' : 'bg-neutral-900 border border-neutral-800 text-neutral-400 hover:bg-neutral-800 hover:text-white' ?>">
        <?= $p ?>
      </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
      <a href="?view=comedians&q=<?= urlencode($search) ?>&page=<?= $page + 1 ?>" class="w-12 h-12 rounded-[5px] bg-neutral-900 border border-neutral-800 flex items-center justify-center text-neutral-400 hover:bg-neutral-800 hover:text-white transition-colors">
        <i data-lucide="chevron-right" class="w-6 h-6"></i>
      </a>
      <?php else: ?>
      <span class="w-12 h-12 rounded-[5px] bg-neutral-900 border border-neutral-800 flex items-center justify-center text-neutral-600 opacity-50">
        <i data-lucide="chevron-right" class="w-6 h-6"></i>
      </span>
      <?php endif; ?>
    </div>
    <div class="text-neutral-500">
      Showing <span class="text-white font-bold"><?= (($page - 1) * $perPage) + 1 ?></span> &ndash; <span class="text-white font-bold"><?= min($page * $perPage, $total) ?></span> of <span class="text-white font-bold"><?= $total ?></span> comedians
    </div>
  </div>
  <?php endif; ?>
</div>
