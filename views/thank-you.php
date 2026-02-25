<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">

  <!-- Animated Check Icon -->
  <div class="relative mb-12">
    <div class="absolute inset-0 bg-[#24CECE] blur-3xl opacity-20 rounded-full animate-pulse"></div>
    <div class="relative w-32 h-32 bg-[#24CECE]/10 rounded-full border-2 border-[#24CECE] flex items-center justify-center shadow-2xl">
      <i data-lucide="circle-check" class="w-16 h-16 text-[#24CECE]"></i>
    </div>
  </div>

  <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tight">
    YOU'RE <span class="text-[#24CECE]">IN!</span>
  </h1>

  <p class="text-xl text-neutral-400 max-w-2xl mx-auto mb-4 leading-relaxed">
    Your tickets are confirmed. Get ready to laugh — we'll see you at the club!
  </p>
  <p class="text-neutral-500 mb-12">A confirmation email has been sent to your inbox.</p>

  <!-- Key Info -->
  <div class="grid md:grid-cols-3 gap-6 max-w-3xl w-full mb-16">
    <?php foreach ([
      ['📅', 'Date', 'Saturday, Oct 12, 2024'],
      ['🕗', 'Doors Open', '7:00 PM — Show at 8:00 PM'],
      ['📍', 'Location', 'EastVille Comedy Club, Brooklyn, NY'],
    ] as [$icon, $title, $detail]): ?>
    <div class="bg-neutral-900/50 p-6 rounded-[5px] border border-neutral-800 text-center">
      <div class="text-3xl mb-2"><?= $icon ?></div>
      <h3 class="font-bold text-white text-sm uppercase tracking-wide mb-1"><?= $title ?></h3>
      <p class="text-neutral-400 text-sm"><?= $detail ?></p>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Important Reminder -->
  <div class="bg-[#24CECE]/10 border border-[#24CECE]/30 rounded-[5px] p-6 max-w-xl w-full mb-12 text-left">
    <h4 class="text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-2">Friendly Reminder</h4>
    <p class="text-neutral-300 text-sm leading-relaxed">Arrive 30 minutes early — seating is first come, first served. There is a 2-drink minimum for all shows.</p>
  </div>

  <div class="flex flex-col sm:flex-row gap-4">
    <a href="?view=home" class="px-8 py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-[5px] hover:bg-[#20B8B8] transition-colors">Back to Home</a>
    <a href="?view=schedule" class="px-8 py-4 bg-neutral-900 text-white font-bold rounded-[5px] hover:bg-neutral-800 transition-colors border border-neutral-800">View More Shows</a>
  </div>
</div>
