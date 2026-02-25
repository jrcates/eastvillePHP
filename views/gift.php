<?php
$success = isset($_POST['gift_submitted']) && $_POST['gift_submitted'] === '1';
?>

<?php if ($success): ?>
<div class="pt-[150px] pb-24 container mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <div class="w-24 h-24 bg-green-500/10 rounded-[5px] flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-12 h-12 text-green-500"></i>
  </div>
  <h1 class="text-4xl md:text-5xl font-bold mb-6">Thank You!</h1>
  <p class="text-xl text-neutral-400 max-w-lg mb-8">Your gift certificate purchase was successful. We've sent a confirmation email with the certificate attached.</p>
  <a href="?view=gift" class="px-8 py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-[5px] hover:bg-[#20B8B8] transition-colors">Purchase Another</a>
</div>
<?php else: ?>

<div class="pt-[150px] pb-24 container mx-auto px-6">
  <!-- Header -->
  <div class="max-w-4xl mx-auto mb-16 text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">GIFT <span class="text-[#24CECE]">CERTIFICATES</span></h1>
    <p class="text-xl text-neutral-400 max-w-2xl mx-auto">Give the gift of laughter. Perfect for birthdays, holidays, or just because.</p>
  </div>

  <div class="grid lg:grid-cols-12 gap-12 max-w-6xl mx-auto">

    <!-- Info Side -->
    <div class="lg:col-span-5 space-y-8">
      <div class="bg-neutral-900/50 p-8 rounded-[5px] border border-neutral-800">
        <i data-lucide="gift" class="w-12 h-12 text-[#24CECE] mb-6"></i>
        <h2 class="text-2xl font-bold mb-4">How it works</h2>
        <div class="space-y-4 text-neutral-300">
          <p>You can purchase a gift certificate here for tickets to the club! We will email you a copy of the gift certificate and then you can use it or send it to the person you are gifting it to.</p>
          <div class="p-4 bg-[#24CECE]/10 border border-[#24CECE]/20 rounded-[5px] text-[#24CECE] text-sm">
            <strong>Please note:</strong> Gift certificates only cover purchase of tickets.
          </div>
        </div>
      </div>

      <!-- Certificate Preview -->
      <div class="relative aspect-[1.586/1] bg-gradient-to-br from-neutral-800 to-neutral-900 rounded-[5px] overflow-hidden border border-[#24CECE]/30 shadow-2xl" style="transform:rotate(1deg);transition:transform .5s ease;" onmouseenter="this.style.transform='rotate(0deg)'" onmouseleave="this.style.transform='rotate(1deg)'">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#24CECE]/10 rounded-full blur-2xl"></div>
        <div class="relative h-full p-8 flex flex-col justify-between">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-2xl font-bold text-white tracking-wider">GIFT CERTIFICATE</h3>
              <p class="text-[#24CECE] text-sm font-semibold tracking-widest mt-1">EASTVILLE COMEDY CLUB</p>
            </div>
            <i data-lucide="gift" class="w-8 h-8 text-[#24CECE]/80"></i>
          </div>
          <div class="space-y-2">
            <div class="text-4xl font-bold text-white" id="cert-preview-amount">$0.00</div>
            <div class="h-px w-full bg-neutral-700"></div>
            <div class="flex justify-between text-xs text-neutral-500 uppercase tracking-wider">
              <span>Valid for Tickets Only</span>
              <span>No Expiration</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Side -->
    <div class="lg:col-span-7">
      <form method="POST" action="?view=gift" class="bg-white p-8 md:p-10 rounded-[5px] border border-neutral-200 shadow-xl space-y-8 text-neutral-900">
        <input type="hidden" name="gift_submitted" value="1" />

        <!-- Amount -->
        <div>
          <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-neutral-900">💵 Gift Amount</h3>
          <div class="grid grid-cols-3 gap-4 mb-4">
            <?php foreach (['25','50','100'] as $val): ?>
            <button type="button" class="amount-btn py-3 rounded-[5px] font-bold border transition-all bg-neutral-50 text-neutral-600 border-neutral-200 hover:border-[#24CECE]/50" data-val="<?= $val ?>">$<?= $val ?></button>
            <?php endforeach; ?>
          </div>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-500">$</span>
            <input type="number" name="amount" id="amount-input" placeholder="Custom Amount" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] py-3 pl-8 pr-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" required />
          </div>
        </div>

        <!-- Personal Info -->
        <div>
          <h3 class="text-xl font-bold mb-6 text-neutral-900">👤 Personal Information</h3>
          <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">First Name</label><input type="text" name="first_name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
            <div class="space-y-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">Last Name</label><input type="text" name="last_name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
            <div class="space-y-2 md:col-span-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">Email</label><input type="email" name="email" placeholder="good@friend.com" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
            <div class="space-y-2 md:col-span-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">Phone</label><input type="tel" name="phone" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
          </div>
        </div>

        <!-- Payment Info -->
        <div>
          <h3 class="text-xl font-bold mb-6 text-neutral-900">💳 Payment Information</h3>
          <div class="space-y-4">
            <div class="space-y-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">Card Number</label><input type="text" name="card" placeholder="0000 0000 0000 0000" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
            <div class="grid grid-cols-2 gap-4">
              <div class="space-y-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">Expiration</label><input type="text" name="exp" placeholder="MM/YY" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
              <div class="space-y-2"><label class="text-sm text-neutral-600 ml-1 font-semibold">CVC</label><input type="text" name="cvc" placeholder="123" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-3 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] outline-none" required /></div>
            </div>
          </div>
        </div>

        <button type="submit" class="w-full py-4 bg-[#24CECE] text-neutral-900 font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors shadow-lg mt-8">Purchase Gift Certificate</button>
        <p class="text-center text-xs text-neutral-500 mt-4 flex items-center justify-center gap-2">🔒 Secure 256-bit SSL Encrypted Payment</p>
      </form>
    </div>
  </div>
</div>

<script>
$(function () {
  $('.amount-btn').on('click', function () {
    var val = $(this).data('val');
    $('#amount-input').val(val);
    $('#cert-preview-amount').text('$' + parseFloat(val).toFixed(2));
    $('.amount-btn').removeClass('bg-[#24CECE] text-black border-[#24CECE]').addClass('bg-neutral-50 text-neutral-600 border-neutral-200');
    $(this).addClass('bg-[#24CECE] text-black border-[#24CECE]').removeClass('bg-neutral-50 text-neutral-600 border-neutral-200');
  });

  $('#amount-input').on('input', function () {
    var val = parseFloat($(this).val()) || 0;
    $('#cert-preview-amount').text('$' + val.toFixed(2));
    $('.amount-btn').removeClass('bg-[#24CECE] text-black border-[#24CECE]').addClass('bg-neutral-50 text-neutral-600 border-neutral-200');
  });
});
</script>
<?php endif; ?>
