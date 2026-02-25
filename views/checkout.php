<?php
require_once __DIR__ . '/../data.php';

$success = isset($_POST['checkout_submitted']) && $_POST['checkout_submitted'] === '1';
$showId = isset($_GET['show']) ? $_GET['show'] : null;
$quantity = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
$addonsTotal = isset($_GET['addons']) ? floatval($_GET['addons']) : 0;

$show = null;
$pricePerTicket = 25.00;
foreach ($shows as $s) {
  if ($s['id'] === $showId) {
    $show = $s;
    $pricePerTicket = floatval($s['priceValue']);
    break;
  }
}

$subtotal = $pricePerTicket * $quantity;
$tax = ($subtotal + $addonsTotal) * 0.08875;
$serviceFee = 3.50 * $quantity;
$total = $subtotal + $addonsTotal + $tax + $serviceFee;
?>

<?php
if ($success):
  $d = $show ? formatShowDate($show['date']) : null;
?>
<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">

  <!-- Check Icon -->
  <div class="w-20 h-20 bg-[#1E2E23] rounded-[10px] flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-10 h-10 text-green-500"></i>
  </div>

  <!-- Heading -->
  <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-white mb-4">You're Going!</h1>
  <p class="text-lg text-neutral-400 max-w-lg mb-10">Your tickets have been confirmed. We've sent the receipt and details to your email.</p>

  <!-- Event Card -->
  <?php if ($show && $d): ?>
  <div class="w-full max-w-[560px] bg-[#1E2323] rounded-[10px] overflow-hidden border-t-4 border-[#24CECE] text-left">
    <div class="p-8">
      <!-- Title Row -->
      <div class="flex items-start justify-between gap-4 mb-6">
        <div>
          <h2 class="text-2xl font-black uppercase tracking-tight text-white leading-tight mb-1"><?= htmlspecialchars($show['title']) ?></h2>
          <span class="text-[#24CECE] font-bold text-sm"><?= htmlspecialchars($show['location']) ?></span>
        </div>
        <div class="border border-neutral-600 rounded-[5px] pt-1.5 pb-1 px-3 text-center shrink-0">
          <div class="text-xs font-bold text-neutral-400 leading-none uppercase"><?= $d['month'] ?></div>
          <div class="text-2xl font-black text-white leading-none mt-0.5"><?= $d['day'] ?></div>
        </div>
      </div>

      <!-- Details -->
      <div class="space-y-4 mb-8">
        <div class="flex items-center gap-3 text-neutral-300">
          <i data-lucide="calendar" class="w-5 h-5 text-neutral-500 shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm"><?= date('l', strtotime($show['date'])) ?>, <?= $d['time'] ?></div>
            <div class="text-xs text-neutral-500">Doors open 1 hour before</div>
          </div>
        </div>
        <div class="flex items-center gap-3 text-neutral-300">
          <i data-lucide="map-pin" class="w-5 h-5 text-neutral-500 shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm">EastVille Comedy Club</div>
            <div class="text-xs text-neutral-500">487 Atlantic Ave, Brooklyn, NY</div>
          </div>
        </div>
      </div>

      <!-- Dotted Divider -->
      <div class="border-t border-dashed border-neutral-700 mb-6"></div>

      <!-- Action Buttons -->
      <div class="flex gap-3">
        <button onclick="return false;" class="flex-1 flex items-center justify-center gap-2 bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-sm py-3 rounded-[8px] transition-colors">
          <i data-lucide="download" class="w-4 h-4"></i>
          Save to Calendar
        </button>
        <button onclick="return false;" class="flex-1 flex items-center justify-center gap-2 bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-sm py-3 rounded-[8px] transition-colors">
          <i data-lucide="share-2" class="w-4 h-4"></i>
          Share
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Back to Home -->
  <a href="?view=home" class="mt-10 inline-block px-12 py-4 bg-[#24CECE] text-black font-black text-base uppercase tracking-wider rounded-[8px] hover:bg-[#20B8B8] transition-colors">Back to Home</a>

</div>
<?php else: ?>

<div class="pt-[150px] pb-24 container mx-auto px-6 max-w-[1200px]">

  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12 border-b border-neutral-800 pb-8">
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight">CHECKOUT</h1>
    <a href="?view=schedule" class="flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-white bg-neutral-900 hover:bg-neutral-800 px-5 py-3 rounded-[5px] transition-all border border-neutral-800">
      <i data-lucide="arrow-left" class="w-5 h-5"></i>
      Back to Schedule
    </a>
  </div>

  <div class="grid lg:grid-cols-12 gap-12">

    <!-- Left Column -->
    <div class="lg:col-span-7 space-y-8">

      <!-- Event Details -->
      <section class="bg-neutral-900 rounded-[5px] border border-neutral-800 p-8">
        <h2 class="text-2xl font-bold mb-6 border-b border-neutral-800 pb-4">Event Details</h2>
        <div class="space-y-4">
          <div>
            <h3 class="text-xl font-bold text-[#24CECE] mb-1"><?= $show ? htmlspecialchars($show['title']) : 'Comedy Show' ?></h3>
            <p class="text-neutral-400 text-sm"><?= $show ? htmlspecialchars($show['location']) : 'EastVille Comedy Club' ?></p>
          </div>
          <div class="space-y-3 pt-4">
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="calendar" class="w-5 h-5 text-neutral-500"></i>
              <span><?= $show ? date('l, F j, Y', strtotime($show['date'])) : 'TBD' ?></span>
            </div>
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="clock" class="w-5 h-5 text-neutral-500"></i>
              <span><?= $show ? htmlspecialchars($show['time']) : 'TBD' ?></span>
            </div>
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="map-pin" class="w-5 h-5 text-neutral-500"></i>
              <span>EastVille Comedy Club, Brooklyn, NY</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Restrictions (Accordion) -->
      <section class="bg-neutral-900/50 rounded-[5px] border border-neutral-800 p-8">
        <button id="restrictions-toggle" class="w-full flex items-center justify-between group">
          <h2 class="text-lg font-bold flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-[#24CECE]"></i>
            Restrictions &amp; Requirements
          </h2>
          <span id="restrictions-label" class="text-sm font-bold text-neutral-500 group-hover:text-[#24CECE] transition-colors">Show Details</span>
        </button>
        <ul id="restrictions-list" class="hidden space-y-4 text-sm font-medium text-neutral-400 mt-6">
          <li class="flex items-start gap-3"><i data-lucide="clock" class="w-5 h-5 text-neutral-500 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-neutral-500 shrink-0 mt-0.5"></i><span>There is a <strong class="text-neutral-300">2-drink minimum</strong> for all shows.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="alert-triangle" class="w-5 h-5 text-neutral-500 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">LINE-UPS SUBJECT TO CHANGE.</strong> Tickets are for a comedy show, not for any specific performer.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-neutral-500 shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span></li>
        </ul>
      </section>

      <!-- Ticket Selection -->
      <section class="bg-neutral-900 rounded-[5px] border border-neutral-800 p-8">
        <table class="w-full text-left">
          <thead>
            <tr class="border-b border-neutral-800 text-sm text-neutral-500 uppercase tracking-wider">
              <th class="pb-4 font-semibold">Admission</th>
              <th class="pb-4 font-semibold text-center">Qty</th>
              <th class="pb-4 font-semibold text-right">Price</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-neutral-800">
            <tr>
              <td class="py-4"><div class="font-bold">General Admission</div><div class="text-xs text-neutral-500">First come, first served seating</div></td>
              <td class="py-4 text-center font-mono text-neutral-300 font-bold"><?= $quantity ?></td>
              <td class="py-4 text-right font-mono">$<?= number_format($pricePerTicket, 2) ?></td>
            </tr>
          </tbody>
        </table>
        <p class="text-xs text-neutral-500 mt-4 italic">* All sales are final</p>
      </section>

      <!-- Promo Code -->
      <section class="bg-neutral-900 rounded-[5px] border border-neutral-800 p-8">
        <label class="text-sm font-bold uppercase tracking-wider text-neutral-500 mb-3 block">Promo Code</label>
        <div class="flex gap-2">
          <input type="text" placeholder="Enter code" class="flex-1 bg-white text-black border border-neutral-200 rounded-[5px] px-4 py-3 focus:ring-2 focus:ring-[#24CECE] outline-none uppercase placeholder:capitalize" />
          <button type="button" class="px-6 py-3 bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-[5px] transition-colors">Apply</button>
        </div>
      </section>
    </div>

    <!-- Right Column: Form & Total -->
    <div class="lg:col-span-5 space-y-8">
      <div class="bg-white p-8 rounded-[5px] border border-neutral-200 shadow-xl sticky top-32 text-black">
        <form method="POST" action="?view=checkout&show=<?= urlencode($showId) ?>" class="space-y-8">
          <input type="hidden" name="checkout_submitted" value="1" />

          <!-- Customer Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black">Customer Information</h3>
            <div class="grid grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">First Name</label><input required type="text" name="first_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">Last Name</label><input required type="text" name="last_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="col-span-2 space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">Email</label><input required type="email" name="email" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="col-span-2 space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">Phone</label><input required type="tel" name="phone" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
            </div>
          </div>

          <!-- Payment Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black">Payment Information</h3>
            <div class="space-y-4">
              <div class="space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">Card Number</label><input required type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] py-3 px-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">Expiration</label><input required type="text" name="exp" placeholder="MM/YY" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
                <div class="space-y-2"><label class="text-xs font-bold text-neutral-500 uppercase">CVC</label><input required type="text" name="cvc" placeholder="123" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              </div>
            </div>
          </div>

          <!-- Totals -->
          <div class="bg-neutral-50 rounded-[5px] p-4 space-y-2 border border-neutral-200">
            <div class="flex justify-between text-sm text-neutral-600"><span>Tickets (<?= $quantity ?> x $<?= number_format($pricePerTicket, 2) ?>)</span><span>$<?= number_format($subtotal, 2) ?></span></div>
            <?php if ($addonsTotal > 0): ?>
            <div class="flex justify-between text-sm text-neutral-600"><span>Add-ons</span><span>$<?= number_format($addonsTotal, 2) ?></span></div>
            <?php endif; ?>
            <div class="flex justify-between text-sm text-neutral-600"><span>Tax</span><span>$<?= number_format($tax, 2) ?></span></div>
            <div class="flex justify-between text-sm text-neutral-600"><span>Service Fee</span><span>$<?= number_format($serviceFee, 2) ?></span></div>
            <div class="flex justify-between text-lg font-bold text-black pt-2 border-t border-neutral-200 mt-2">
              <span>Total</span><span class="text-[#24CECE]">$<?= number_format($total, 2) ?></span>
            </div>
          </div>

          <button type="submit" class="w-full py-4 bg-[#24CECE] text-white font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors shadow-lg">Purchase Tickets</button>
          <p class="text-center text-xs text-neutral-500 flex justify-center items-center gap-1">🔒 Secure Transaction</p>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
$(function () {
  $('#restrictions-toggle').on('click', function () {
    var $list = $('#restrictions-list');
    $list.toggleClass('hidden');
    $('#restrictions-label').text($list.hasClass('hidden') ? 'Show Details' : 'Hide Details');
  });
});
</script>
<?php endif; ?>
