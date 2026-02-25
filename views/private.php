<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6">

  <!-- Header -->
  <div class="max-w-4xl mx-auto mb-16 text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">PRIVATE <span class="text-[#24CECE]">EVENTS</span></h1>
    <p class="text-xl text-neutral-400">Host your next special occasion at EastVille Comedy Club.</p>
  </div>

  <!-- Main Content + Image -->
  <div class="grid md:grid-cols-2 gap-16 items-center mb-24">
    <!-- Image Side -->
    <div class="relative">
      <div class="absolute -bottom-6 -right-6 w-3/4 h-3/4 bg-[#24CECE] rounded-[5px] -z-10"></div>
      <div class="absolute -top-6 -left-6 w-full h-full border-2 border-neutral-700 rounded-[5px] -z-10"></div>
      <div class="rounded-[5px] overflow-hidden shadow-2xl relative z-10 bg-black">
        <img src="assets/pri-img1.jpg" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700" alt="Private Event Atmosphere" />
      </div>
    </div>

    <!-- Text Side -->
    <div class="space-y-6 text-neutral-300">
      <p class="leading-relaxed">Events at the EastVille Comedy Club are always memorable. From birthday parties to business functions, EastVille Comedy Club is the perfect place to host your next special event.</p>
      <p class="leading-relaxed">Our devoted event staff will happily assist you with each and every detail to ensure you and your guests have a memorable experience.</p>
      <a href="?view=contact" class="inline-flex items-center gap-2 mt-4 px-8 py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-full hover:bg-[#20B8B8] transition-colors">
        Inquire Now
        <i data-lucide="arrow-right" class="w-5 h-5"></i>
      </a>
    </div>
  </div>

  <!-- Event Types Grid -->
  <div class="mb-24">
    <h2 class="text-3xl font-bold mb-12 text-center">Perfect For Any Occasion</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ([
        ['🎁', 'Birthday Parties'],
        ['🎉', "Kid's Parties"],
        ['🏆', 'Graduations'],
        ['🥂', 'Bachelor/ette'],
        ['❤️', 'Engagement Parties'],
        ['📅', 'Anniversaries'],
        ['✨', 'Promotions'],
        ['➡️', 'And Much More'],
      ] as [$icon, $title]): ?>
      <div class="bg-neutral-900/50 p-6 rounded-[5px] border border-neutral-800 hover:border-[#24CECE] transition-all hover:-translate-y-1 group flex flex-col items-center text-center">
        <div class="w-14 h-14 bg-neutral-950 rounded-[5px] flex items-center justify-center mb-4 group-hover:bg-[#24CECE] transition-colors text-2xl">
          <?= $icon ?>
        </div>
        <h3 class="text-lg font-bold text-white"><?= htmlspecialchars($title) ?></h3>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
