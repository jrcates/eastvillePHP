<?php
$cocktails = [
  ['name'=>'House Marg','description'=>'House tequila, lime juice, simple syrup, triple sec.','price'=>'$16'],
  ['name'=>'Blueberry Mule','description'=>'Blueberry liqueur, lime juice, ginger beer.','price'=>'$16'],
  ['name'=>'Mocha Martini','description'=>'Patron coffee, simple syrup, Stok coffee, splash of Baileys.','price'=>'$16'],
  ['name'=>'Spicy Marg','description'=>'Jalapeño tequila, lime juice, simple syrup, triple sec.','price'=>'$16'],
  ['name'=>'Spiked Hot Cocoa','description'=>'Hot chocolate, shot of Makers, whipped cream.','price'=>'$14'],
  ['name'=>'Hot Toddy','description'=>'Hot water, shot of Bulleit bourbon, lemon, honey.','price'=>'$14'],
  ['name'=>'Peach Daiquiri','description'=>'Peach schnapps, lemon juice, simple syrup, dry cider.','price'=>'$16'],
];
$beers = [
  ['name'=>'Stella','price'=>'$10'],
  ['name'=>'Bud Light','price'=>'$10'],
  ['name'=>'Budweiser','price'=>'$10'],
  ['name'=>'Brooklyn Lager','price'=>'$10'],
  ['name'=>'Bronx Pilsner','price'=>'$10'],
  ['name'=>'Toasted Lager','price'=>'$10'],
  ['name'=>'Allagash','price'=>'$10'],
  ['name'=>'Juicebomb IPA','price'=>'$10'],
  ['name'=>'Lagunitas IPA','price'=>'$10'],
  ['name'=>'Dry Cider','price'=>'$12'],
  ['name'=>'Blackberry Cider','price'=>'$12'],
  ['name'=>'Nutrl','price'=>'$12'],
  ['name'=>'N/A Athletic Golden','price'=>'$10'],
  ['name'=>'N/A Athletic IPA','price'=>'$10'],
];
$nonAlcoholic = [
  ['name'=>'Coffee','price'=>'$5'],
  ['name'=>'Tea','price'=>'$5'],
  ['name'=>'Water Bottle','price'=>'$5'],
  ['name'=>'Canned Seltzer','price'=>'$5'],
  ['name'=>'Coke','price'=>'$5'],
  ['name'=>'Diet Coke','price'=>'$5'],
  ['name'=>'Sprite','price'=>'$5'],
  ['name'=>'Ginger Ale','price'=>'$5'],
  ['name'=>'Orange Juice','price'=>'$5'],
  ['name'=>'Cranberry Juice','price'=>'$5'],
  ['name'=>'Pink Lemonade','price'=>'$5'],
];

function menuSection(string $title, string $iconSvg, array $items, string $image, string $side = 'left', string $id = ''): void { ?>
<section class="py-12" <?= $id ? 'id="' . $id . '"' : '' ?>>
  <div class="flex flex-col <?= $side === 'right' ? 'lg:flex-row-reverse' : 'lg:flex-row' ?> gap-12 lg:gap-20 items-start">
    <!-- Image -->
    <div class="w-full lg:w-5/12 sticky top-24">
      <div class="rounded-[5px] overflow-hidden shadow-2xl border border-neutral-800 aspect-[3/4] lg:aspect-auto lg:h-[600px] relative group">
        <div class="absolute inset-0 bg-neutral-900/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
        <img src="<?= $image ?>" alt="<?= htmlspecialchars($title) ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
      </div>
    </div>
    <!-- Content -->
    <div class="w-full lg:w-7/12 space-y-8">
      <div class="flex items-center gap-4 border-b border-[#24CECE]/30 pb-4">
        <div class="p-3 bg-[#24CECE]/10 rounded-[5px] text-[#24CECE]"><?= $iconSvg ?></div>
        <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight"><?= htmlspecialchars($title) ?></h2>
      </div>
      <div class="grid gap-6">
        <?php foreach ($items as $item): ?>
        <div class="group">
          <div class="flex justify-between items-baseline mb-1">
            <h3 class="text-xl font-bold text-neutral-200 group-hover:text-[#24CECE] transition-colors"><?= htmlspecialchars($item['name']) ?></h3>
            <div class="dotted-line"></div>
            <span class="text-xl font-bold text-[#24CECE] flex-shrink-0"><?= htmlspecialchars($item['price']) ?></span>
          </div>
          <?php if (!empty($item['description'])): ?>
          <p class="text-neutral-500 text-sm font-medium leading-relaxed max-w-[90%]"><?= htmlspecialchars($item['description']) ?></p>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php }

$wines = [
  ['name'=>'Archer Roose Sauv. Blanc','price'=>'$18'],
  ['name'=>'AR Pinot Grigio','price'=>'$18'],
  ['name'=>'AR Pinot Noir','price'=>'$18'],
  ['name'=>'AR Malbec','price'=>'$18'],
  ['name'=>'AR Prosecco','price'=>'$18'],
  ['name'=>'AR Dry Rosé','price'=>'$18'],
];
$mocktails = [
  ['name'=>'Canned Margarita','price'=>'$12'],
  ['name'=>'Canned Mule','price'=>'$12'],
  ['name'=>'Virgin Sunrise','price'=>'$12'],
];

$snacks = [
  ['name'=>'Chocolate Bars','price'=>'$5'],
  ['name'=>'Chips','price'=>'$4'],
  ['name'=>'Cookies','price'=>'$5'],
  ['name'=>'Popcorn','price'=>'$6'],
];

$cocktailIcon = '<i data-lucide="wine" class="w-8 h-8"></i>';
$beerIcon = '<i data-lucide="beer" class="w-8 h-8"></i>';
$wineIcon = '<i data-lucide="grape" class="w-8 h-8"></i>';
$mocktailIcon = '<i data-lucide="glass-water" class="w-8 h-8"></i>';
$coffeeIcon = '<i data-lucide="coffee" class="w-8 h-8"></i>';
$snackIcon = '<i data-lucide="cookie" class="w-8 h-8"></i>';
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- Header -->
  <div class="text-center mb-20">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight text-white">
      DRINKS <span class="text-[#24CECE]">MENU</span>
    </h1>
    <p class="text-xl text-white max-w-2xl mx-auto mb-6">We started opening during the day, on Friday, Saturday and Sunday. We open at noon.</p>
    <div class="inline-flex items-center gap-2 text-neutral-400 bg-neutral-900 px-6 py-3 rounded-[5px] border border-neutral-800">
      <i data-lucide="wine" class="w-5 h-5 text-[#24CECE]"></i>
      <span class="font-semibold uppercase tracking-wider text-sm">2-Drink Minimum at All Shows</span>
    </div>
  </div>

  <div class="w-full mx-auto pb-12">
    <?php menuSection('Specialty Cocktails', $cocktailIcon, $cocktails, 'assets/drinks-img1.jpg', 'left', 'specialty-cocktails'); ?>
    <?php menuSection('Mocktails', $mocktailIcon, $mocktails, 'assets/mocktails.jpg', 'right', 'mocktails'); ?>
    <?php menuSection('Wines', $wineIcon, $wines, 'assets/wines.jpg', 'left', 'wines'); ?>
    <?php menuSection('Beer & Cider', $beerIcon, $beers, 'assets/drinks-img2.jpg', 'right', 'beers'); ?>
    <?php menuSection('California Sober Drinks', $coffeeIcon, $nonAlcoholic, 'assets/drinks-img3.jpg', 'left', 'california-sober'); ?>
    <?php menuSection('Snacks', $snackIcon, $snacks, 'assets/snacks.jpg', 'right', 'snacks'); ?>
  </div>
</div>
