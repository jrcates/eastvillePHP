<?php
require_once __DIR__ . '/../data.php';

$showId = isset($_GET['show']) ? $_GET['show'] : null;
$ticketQty = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
$ticketPrice = 0;
$show = null;

foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    $ticketPrice = $s['priceValue'];
    break;
  }
}

$ticketSubtotal = $ticketPrice * $ticketQty;

$addons = [
  [
    'id'    => 'addon-1',
    'name'  => '2-Drink Voucher',
    'price' => 18,
    'desc'  => 'Skip the line — two drinks of your choice, redeemable at the bar anytime during the show.',
    'icon'  => '<i data-lucide="wine" class="w-6 h-6"></i>',
  ],
  [
    'id'    => 'addon-2',
    'name'  => 'Premium Cocktail Pack',
    'price' => 45,
    'desc'  => '4 handcrafted cocktails for your group. Choose from our signature menu on arrival.',
    'icon'  => '<i data-lucide="sparkles" class="w-6 h-6"></i>',
  ],
  [
    'id'    => 'addon-3',
    'name'  => 'Bottle Service',
    'price' => 120,
    'desc'  => 'A full bottle of your choice (vodka, tequila, or whiskey) with mixers and a dedicated server.',
    'icon'  => '<i data-lucide="beer" class="w-6 h-6"></i>',
  ],
  [
    'id'    => 'addon-4',
    'name'  => 'Snack Platter for 2',
    'price' => 22,
    'desc'  => 'A curated spread of our best bites — wings, sliders, and loaded nachos.',
    'icon'  => '<i data-lucide="utensils" class="w-6 h-6"></i>',
  ],
  [
    'id'    => 'addon-5',
    'name'  => 'Date Night Bundle',
    'price' => 35,
    'desc'  => '2 signature cocktails + a shareable snack platter. The perfect combo for two.',
    'icon'  => '<i data-lucide="heart" class="w-6 h-6"></i>',
  ],
];
?>

<div class="pt-[140px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen">

  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">ENHANCE YOUR NIGHT</h1>
      <p class="text-neutral-400 text-base mt-2">Add food &amp; drinks to your order — or skip ahead to complete your purchase.</p>
    </div>
    <a href="?view=event&show=<?= urlencode($showId) ?>" class="flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white bg-neutral-900 hover:bg-neutral-800 px-5 py-3 rounded-[5px] transition-all border border-neutral-800 whitespace-nowrap">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Back to Event
    </a>
  </div>

  <div class="border-b border-neutral-800 mb-10"></div>

  <!-- Two Column Layout -->
  <div class="grid lg:grid-cols-12 gap-10">

    <!-- Left: Add-on Items -->
    <div class="lg:col-span-7 space-y-4">
      <?php foreach ($addons as $addon): ?>
      <div class="addon-card bg-neutral-900 rounded-[8px] border border-neutral-800 p-6" data-id="<?= $addon['id'] ?>" data-price="<?= $addon['price'] ?>" data-name="<?= htmlspecialchars($addon['name']) ?>">
        <div class="flex items-start gap-4">
          <!-- Icon -->
          <div class="w-12 h-12 rounded-full bg-neutral-800 flex items-center justify-center text-neutral-400 shrink-0">
            <?= $addon['icon'] ?>
          </div>
          <!-- Content -->
          <div class="flex-1">
            <div class="flex items-start justify-between gap-4 mb-2">
              <h3 class="text-base font-bold text-white"><?= htmlspecialchars($addon['name']) ?></h3>
              <span class="text-[#24CECE] font-bold text-base whitespace-nowrap">$<?= $addon['price'] ?></span>
            </div>
            <p class="text-neutral-500 text-sm leading-relaxed mb-4"><?= htmlspecialchars($addon['desc']) ?></p>
            <!-- Quantity Controls -->
            <div class="flex items-center gap-3">
              <button class="addon-minus w-8 h-8 rounded-[6px] bg-neutral-800 flex items-center justify-center text-neutral-500 hover:bg-neutral-700 hover:text-white transition-colors">
                <i data-lucide="minus" class="w-4 h-4"></i>
              </button>
              <span class="addon-qty text-base font-bold text-white w-6 text-center">0</span>
              <button class="addon-plus w-8 h-8 rounded-[6px] bg-[#24CECE] flex items-center justify-center text-black hover:bg-[#20B8B8] transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Right: Order Summary -->
    <div class="lg:col-span-5">
      <div class="bg-white p-8 rounded-[10px] shadow-xl sticky top-32 text-black space-y-6">

        <h2 class="text-xl font-black text-black flex items-center gap-2">
          <i data-lucide="circle-check" class="w-5 h-5 text-neutral-500"></i>
          Order Summary
        </h2>

        <p id="summary-empty" class="text-sm text-neutral-400 italic">No add-ons selected yet.</p>

        <!-- Summary Line Items (populated by JS) -->
        <div id="summary-items" class="space-y-2 hidden"></div>

        <!-- Totals -->
        <div class="border border-neutral-200 rounded-[8px] p-4 space-y-3">
          <div class="flex justify-between text-sm text-neutral-500">
            <span>Add-ons Subtotal</span>
            <span id="addons-subtotal">$0.00</span>
          </div>
          <div class="flex justify-between text-base font-bold text-black">
            <span>Add-ons Total</span>
            <span id="addons-total" class="text-black">$0.00</span>
          </div>
        </div>

        <!-- Continue to Checkout -->
        <a href="#" id="continue-checkout" class="block w-full py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors text-center">Continue to Checkout</a>

        <p class="text-xs text-neutral-400 text-center flex items-center justify-center gap-1.5">
          <i data-lucide="lock" class="w-3.5 h-3.5"></i>
          Secure Transaction
        </p>

      </div>
    </div>

  </div>
</div>

<script>
$(function () {
  var showId = '<?= htmlspecialchars($showId) ?>';
  var ticketQty = <?= $ticketQty ?>;
  var ticketPrice = <?= $ticketPrice ?>;

  function updateSummary() {
    var total = 0;
    var hasItems = false;
    var $items = $('#summary-items').empty();

    $('.addon-card').each(function () {
      var qty = parseInt($(this).find('.addon-qty').text());
      if (qty > 0) {
        hasItems = true;
        var price = parseInt($(this).data('price'));
        var name = $(this).data('name');
        var lineTotal = price * qty;
        total += lineTotal;
        $items.append(
          '<div class="flex justify-between text-sm"><span class="text-neutral-600">' + name + ' x' + qty + '</span><span class="text-neutral-800 font-medium">$' + lineTotal.toFixed(2) + '</span></div>'
        );
      }
    });

    if (hasItems) {
      $('#summary-empty').addClass('hidden');
      $items.removeClass('hidden');
    } else {
      $('#summary-empty').removeClass('hidden');
      $items.addClass('hidden');
    }

    $('#addons-subtotal').text('$' + total.toFixed(2));
    $('#addons-total').text('$' + total.toFixed(2));

    // Build checkout URL with addon total and item details
    var url = '?view=checkout&show=' + encodeURIComponent(showId) + '&qty=' + ticketQty + '&addons=' + total.toFixed(2);
    var addonItems = [];
    $('.addon-card').each(function () {
      var qty = parseInt($(this).find('.addon-qty').text());
      if (qty > 0) {
        addonItems.push($(this).data('name') + ':' + qty + ':' + $(this).data('price'));
      }
    });
    if (addonItems.length > 0) {
      url += '&addon_items=' + encodeURIComponent(addonItems.join('|'));
    }
    $('#continue-checkout').attr('href', url);
  }

  $('.addon-plus').on('click', function () {
    var $qty = $(this).closest('.addon-card').find('.addon-qty');
    var val = parseInt($qty.text());
    if (val < 10) {
      $qty.text(val + 1);
      updateSummary();
    }
  });

  $('.addon-minus').on('click', function () {
    var $qty = $(this).closest('.addon-card').find('.addon-qty');
    var val = parseInt($qty.text());
    if (val > 0) {
      $qty.text(val - 1);
      updateSummary();
    }
  });

  // Initialize checkout link
  updateSummary();
});
</script>
