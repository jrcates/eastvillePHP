<?php
require_once __DIR__ . '/../data.php';

$success = isset($_POST['checkout_submitted']) && $_POST['checkout_submitted'] === '1';
$showId = isset($_GET['show']) ? $_GET['show'] : null;
$quantity = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
$addonsTotal = isset($_GET['addons']) ? floatval($_GET['addons']) : 0;
$addonItems = [];
if (isset($_GET['addon_items']) && $_GET['addon_items'] !== '') {
  foreach (explode('|', $_GET['addon_items']) as $item) {
    $parts = explode(':', $item);
    if (count($parts) === 3) {
      $addonItems[] = ['name' => $parts[0], 'qty' => intval($parts[1]), 'price' => floatval($parts[2])];
    }
  }
}

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
          <i data-lucide="calendar" class="w-5 h-5 text-[#94A0AF] shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm"><?= date('l', strtotime($show['date'])) ?>, <?= $d['time'] ?></div>
            <div class="text-xs text-[#94A0AF]">Doors open 1 hour before</div>
          </div>
        </div>
        <div class="flex items-center gap-3 text-neutral-300">
          <i data-lucide="map-pin" class="w-5 h-5 text-[#94A0AF] shrink-0"></i>
          <div>
            <div class="font-bold text-white text-sm">EastVille Comedy Club</div>
            <div class="text-xs text-[#94A0AF]">487 Atlantic Ave, Brooklyn, NY</div>
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
    <div id="checkout-step1" class="lg:col-span-7 space-y-8 order-2 lg:order-1">

      <!-- Event Details -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8">
        <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
          <i data-lucide="ticket" class="w-5 h-5 text-[#24CECE]"></i>
          Event Details
        </h2>
        <div class="space-y-4">
          <div>
            <h3 class="text-xl font-bold text-[#24CECE] mb-1"><?= $show ? htmlspecialchars($show['title']) : 'Comedy Show' ?></h3>
            <p class="text-neutral-400 text-sm"><?= $show ? htmlspecialchars($show['location']) : 'EastVille Comedy Club' ?></p>
          </div>
          <div class="space-y-3 pt-4">
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="calendar" class="w-5 h-5 text-[#94A0AF]"></i>
              <span><?= $show ? date('l, F j, Y', strtotime($show['date'])) : 'TBD' ?></span>
            </div>
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="clock" class="w-5 h-5 text-[#94A0AF]"></i>
              <span><?= $show ? htmlspecialchars($show['time']) : 'TBD' ?></span>
            </div>
            <div class="flex items-center gap-3 text-neutral-300">
              <i data-lucide="map-pin" class="w-5 h-5 text-[#94A0AF]"></i>
              <span>EastVille Comedy Club, Brooklyn, NY</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Order Summary -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8">
        <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
          <i data-lucide="receipt" class="w-5 h-5 text-[#24CECE]"></i>
          Order Summary
        </h2>

        <!-- Ticket -->
        <div class="flex items-center justify-between py-4 border-b border-neutral-700">
          <div>
            <div class="font-bold text-white">General Admission</div>
            <div class="text-xs text-[#94A0AF] mt-0.5"><?= $quantity ?> x $<?= number_format($pricePerTicket, 2) ?></div>
          </div>
          <span class="font-bold text-white">$<?= number_format($subtotal, 2) ?></span>
        </div>

        <!-- Add-ons -->
        <?php if (!empty($addonItems)): ?>
        <div class="py-4 border-b border-neutral-700 space-y-2">
          <?php foreach ($addonItems as $addon): ?>
          <div class="flex justify-between text-sm text-neutral-300">
            <span><?= htmlspecialchars($addon['name']) ?> x<?= $addon['qty'] ?></span>
            <span>$<?= number_format($addon['price'] * $addon['qty'], 2) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Fees -->
        <div class="py-4 border-b border-neutral-700 space-y-2">
          <div class="flex justify-between text-sm text-neutral-300"><span>Tax</span><span>$<?= number_format($tax, 2) ?></span></div>
          <div class="flex justify-between text-sm text-neutral-300"><span>Service Fee</span><span>$<?= number_format($serviceFee, 2) ?></span></div>
        </div>

        <!-- Total -->
        <div class="py-4 border-b border-neutral-700 space-y-2">
          <div id="promo-discount-row" class="hidden flex justify-between text-sm text-green-400">
            <span>Promo Code (5%)</span>
            <span id="promo-discount-amount">-$0.00</span>
          </div>
          <div id="gift-discount-row" class="hidden flex justify-between text-sm text-green-400">
            <span>Gift Certificate (5%)</span>
            <span id="gift-discount-amount">-$0.00</span>
          </div>
          <div class="flex justify-between text-lg font-bold text-white">
            <span>Total</span>
            <span id="order-total" class="text-[#24CECE]">$<?= number_format($total, 2) ?></span>
          </div>
        </div>

        <!-- Promo Code -->
        <div class="py-4">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" id="promo-toggle" class="w-4 h-4 accent-[#24CECE] cursor-pointer" />
            <span class="text-sm font-medium text-[#94A0AF]">I have a promo code</span>
          </label>
          <div id="promo-input" class="hidden mt-3">
            <div class="flex gap-2">
              <input type="text" id="promo-code-input" placeholder="Enter code" class="flex-1 bg-white text-black border border-neutral-200 rounded-[5px] px-4 py-3 focus:ring-2 focus:ring-[#24CECE] outline-none uppercase placeholder:capitalize text-sm" />
              <button type="button" id="promo-apply-btn" class="px-5 py-3 bg-neutral-800 hover:bg-neutral-700 text-white font-bold rounded-[5px] transition-colors text-sm">Apply</button>
            </div>
            <p id="promo-msg" class="hidden text-xs mt-2"></p>
          </div>
        </div>

        <div class="flex justify-between items-center text-xs text-[#94A0AF] italic">
          <span>* All sales are final</span>
          <span>NY Sales Tax (8.875%)</span>
        </div>

        <!-- Mobile Continue Button -->
        <button type="button" id="mobile-continue-btn" class="lg:hidden w-full py-4 bg-[#24CECE] text-black font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors mt-6">Continue to Payment</button>
      </section>

      <!-- Restrictions (Accordion) -->
      <section class="bg-[#3A4655] rounded-[5px] border border-neutral-800 p-8">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-6">
          <i data-lucide="alert-triangle" class="w-5 h-5 text-[#24CECE]"></i>
          Restrictions &amp; Requirements
        </h2>
        <ul class="space-y-4 text-sm font-medium text-neutral-400">
          <li class="flex items-start gap-3"><i data-lucide="clock" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">Arrive 30 mins before showtime</strong> as seating is on a first-come basis.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span>There is a <strong class="text-neutral-300">2-drink minimum</strong> for all shows.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="alert-triangle" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">LINE-UPS SUBJECT TO CHANGE.</strong> Tickets are for a comedy show, not for any specific performer.</span></li>
          <li class="flex items-start gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-[#94A0AF] shrink-0 mt-0.5"></i><span><strong class="text-neutral-300">All ages welcome.</strong> Shows may contain adult content but there are no age restrictions for admission.</span></li>
        </ul>
      </section>
    </div>

    <!-- Right Column: Form & Total -->
    <div id="checkout-step2" class="lg:col-span-5 space-y-8 order-1 lg:order-2 hidden lg:block">
      <div class="bg-white pt-0 pb-8 px-8 rounded-[5px] border border-neutral-200 shadow-xl sticky top-32 text-black">
        <!-- Mobile Back Button -->
        <button type="button" id="mobile-back-btn" class="lg:hidden flex items-center gap-2 text-sm font-bold text-neutral-400 hover:text-black py-4 transition-colors">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to Order Summary
        </button>
        <form method="POST" action="?view=checkout&show=<?= urlencode($showId) ?>" class="space-y-8">
          <input type="hidden" name="checkout_submitted" value="1" />

          <!-- Customer Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Customer Information</h3>
            <div class="grid grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">First Name</label><input required type="text" name="first_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Last Name</label><input required type="text" name="last_name" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Email</label><input required type="email" name="email" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Phone</label><input required type="tel" name="phone" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
            </div>
          </div>

          <!-- Payment Info -->
          <div>
            <h3 class="text-xl font-bold mb-4 text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg> Payment Information</h3>
            <div class="space-y-4">
              <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Card Number</label><input required type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] py-3 px-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">Expiration</label><input required type="text" name="exp" placeholder="MM/YY" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
                <div class="space-y-2"><label class="text-xs font-bold text-[#94A0AF] uppercase">CVC</label><input required type="text" name="cvc" placeholder="123" class="w-full bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none" /></div>
              </div>
            </div>
          </div>

          <!-- Gift Certificate -->
          <div>
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" id="gift-toggle-form" class="w-5 h-5 accent-[#24CECE] cursor-pointer" />
              <h3 class="text-xl font-bold text-black flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8V4"/><path d="M12 12v8"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg> Use Gift Certificate</h3>
            </label>
            <div id="gift-input-form" class="hidden mt-4">
              <div class="flex gap-2">
                <input type="text" id="gift-code-input-form" name="gift_code" placeholder="Enter certificate code" class="flex-1 bg-neutral-50 border border-neutral-200 text-black rounded-[5px] p-3 focus:ring-2 focus:ring-[#24CECE] outline-none placeholder:text-neutral-400" />
                <button type="button" id="gift-apply-btn-form" class="px-6 py-3 bg-black text-white font-bold rounded-[5px] hover:bg-neutral-800 transition-colors">Apply</button>
              </div>
              <p id="gift-msg-form" class="hidden text-xs mt-2"></p>
            </div>
          </div>

          <!-- You Will Be Charged -->
          <div class="rounded-[5px] p-5 border-2 border-[#24CECE]">
            <div class="flex justify-between items-center">
              <span class="text-sm font-bold text-neutral-600 uppercase tracking-wider">You will be charged</span>
              <span id="checkout-total" class="text-2xl font-black text-[#24CECE]">$<?= number_format($total, 2) ?></span>
            </div>
          </div>

          <button type="submit" class="w-full py-4 bg-[#24CECE] text-white font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors shadow-lg">Purchase Tickets</button>
          <p class="text-center text-xs text-[#94A0AF] flex justify-center items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Secure Transaction</p>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
$(function () {
  var baseTotal = <?= $total ?>;
  var promoApplied = false;
  var giftApplied = false;

  function updateTotals() {
    var total = baseTotal;
    if (promoApplied) {
      var promoDiscount = baseTotal * 0.05;
      $('#promo-discount-amount').text('-$' + promoDiscount.toFixed(2));
      $('#promo-discount-row').removeClass('hidden');
      total -= promoDiscount;
    } else {
      $('#promo-discount-row').addClass('hidden');
    }
    if (giftApplied) {
      var giftDiscount = baseTotal * 0.05;
      $('#gift-discount-amount').text('-$' + giftDiscount.toFixed(2));
      $('#gift-discount-row').removeClass('hidden');
      total -= giftDiscount;
    } else {
      $('#gift-discount-row').addClass('hidden');
    }
    $('#order-total, #checkout-total').text('$' + total.toFixed(2));
  }

  // Promo code
  $('#promo-toggle').on('change', function () {
    $('#promo-input').toggleClass('hidden', !this.checked);
    if (!this.checked) {
      $('#promo-code-input').val('');
      $('#promo-msg').addClass('hidden');
      promoApplied = false;
      updateTotals();
    }
  });

  $('#promo-apply-btn').on('click', function () {
    var code = $('#promo-code-input').val().trim();
    if (code === '1111') {
      promoApplied = true;
      updateTotals();
      $('#promo-msg').removeClass('hidden text-red-500').addClass('text-green-400').text('Promo code applied! 5% discount.');
    } else {
      promoApplied = false;
      updateTotals();
      $('#promo-msg').removeClass('hidden text-green-400').addClass('text-red-500').text('Invalid promo code. Please try again.');
    }
  });

  // Gift certificate
  $('#gift-toggle-form').on('change', function () {
    $('#gift-input-form').toggleClass('hidden', !this.checked);
    if (!this.checked) {
      $('#gift-code-input-form').val('');
      $('#gift-msg-form').addClass('hidden');
      giftApplied = false;
      updateTotals();
    }
  });

  $('#gift-apply-btn-form').on('click', function () {
    var code = $('#gift-code-input-form').val().trim();
    if (code === '1111') {
      giftApplied = true;
      updateTotals();
      $('#gift-msg-form').removeClass('hidden text-red-500').addClass('text-green-600').text('Gift certificate applied! 5% discount.');
    } else {
      giftApplied = false;
      updateTotals();
      $('#gift-msg-form').removeClass('hidden text-green-600').addClass('text-red-500').text('Invalid certificate code. Please try again.');
    }
  });

  // Mobile 2-step checkout
  var isMobile = function () { return window.innerWidth < 1024; };

  $('#mobile-continue-btn').on('click', function () {
    $('#checkout-step1').addClass('hidden');
    $('#checkout-step2').removeClass('hidden');
    $('html, body').animate({ scrollTop: 0 }, 300);
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });

  $('#mobile-back-btn').on('click', function () {
    $('#checkout-step2').addClass('hidden');
    $('#checkout-step1').removeClass('hidden');
    $('html, body').animate({ scrollTop: 0 }, 300);
  });

  // On resize, ensure both columns show on desktop
  $(window).on('resize', function () {
    if (!isMobile()) {
      $('#checkout-step1, #checkout-step2').removeClass('hidden');
    } else {
      // If both visible on mobile after resize, show step 1
      if (!$('#checkout-step1').hasClass('hidden') && !$('#checkout-step2').hasClass('hidden')) {
        $('#checkout-step2').addClass('hidden');
      }
    }
  });
});
</script>
<?php endif; ?>
