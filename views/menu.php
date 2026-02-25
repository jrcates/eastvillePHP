<?php
$cocktails = [
  ['name'=>'Watermelon Mule','description'=>'Watermelon vodka, lime juice, ginger beer.','price'=>'$16'],
  ['name'=>'Jalapeño Margarita','description'=>'Jalapeño tequila, lime juice, triple sec.','price'=>'$16'],
  ['name'=>'Espresso Martini','description'=>'Caramel vodka, coffee, baileys.','price'=>'$16'],
  ['name'=>'Winter Collins','description'=>'Hendricks, lime juice, simple syrup, seltzer.','price'=>'$16'],
  ['name'=>'Dark & Stormy','description'=>'Goslings rum, lime juice, ginger beer.','price'=>'$16'],
  ['name'=>'Negroni Sbagliato','description'=>'Campari, sweet vermouth, prosecco.','price'=>'$16'],
  ['name'=>'Strawberry Daiquiri','description'=>'Bacardi, lemon juice, simple syrup, strawberry cider.','price'=>'$16'],
];
$beers = [
  ['name'=>'Dry Cider','price'=>'$9'],
  ['name'=>'Strawberry Cider','price'=>'$9'],
  ['name'=>'Stella','price'=>'$9'],
  ['name'=>'Bud Light','price'=>'$8'],
  ['name'=>'Budweiser','price'=>'$8'],
  ['name'=>'Brooklyn Lager','price'=>'$9'],
  ['name'=>'Bronx Pilsner','price'=>'$9'],
  ['name'=>'Allagash','price'=>'$10'],
  ['name'=>'Juicebomb IPA','price'=>'$10'],
  ['name'=>'Toasted Lager','price'=>'$9'],
  ['name'=>'Athletic Golden (n/a)','price'=>'$8'],
  ['name'=>'Athletic IPA (n/a)','price'=>'$8'],
  ['name'=>'Nutrl','price'=>'$9'],
];
$nonAlcoholic = [
  ['name'=>'Phony Negroni','price'=>'$12'],
  ['name'=>'Athletic Golden (n/a)','price'=>'$8'],
  ['name'=>'Athletic IPA (n/a)','price'=>'$8'],
  ['name'=>'Seltzers','price'=>'$5'],
  ['name'=>'Tea','price'=>'$4'],
  ['name'=>'Coffee','price'=>'$4'],
  ['name'=>'Juices','price'=>'$5'],
  ['name'=>'Hot Chocolate','price'=>'$6'],
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

$cocktailIcon = '<i data-lucide="wine" class="w-8 h-8"></i>';
$beerIcon = '<i data-lucide="beer" class="w-8 h-8"></i>';
$coffeeIcon = '<i data-lucide="coffee" class="w-8 h-8"></i>';
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- Header -->
  <div class="text-center mb-20">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight text-white">
      DRINKS <span class="text-[#24CECE]">MENU</span>
    </h1>
    <div class="inline-flex items-center gap-2 text-neutral-400 bg-neutral-900 px-6 py-3 rounded-[5px] border border-neutral-800">
      <i data-lucide="wine" class="w-5 h-5 text-[#24CECE]"></i>
      <span class="font-semibold uppercase tracking-wider text-sm">1-Drink Minimum at All Shows</span>
    </div>
  </div>

  <div class="w-full mx-auto pb-12">
    <?php menuSection('Specialty Cocktails', $cocktailIcon, $cocktails, 'assets/drinks-img1.jpg', 'left', 'specialty-cocktails'); ?>
    <?php menuSection('Beer & Cider', $beerIcon, $beers, 'assets/drinks-img2.jpg', 'right', 'beers'); ?>
    <?php menuSection('Non-Alcoholic', $coffeeIcon, $nonAlcoholic, 'assets/drinks-img3.jpg', 'left', 'non-alcoholic'); ?>
  </div>
</div>
