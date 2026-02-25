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
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8V4"/><path d="M12 12v8"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>', 'Birthday Parties'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5.8 11.3 2 22l10.7-3.79"/><path d="M4 3h.01"/><path d="M22 8h.01"/><path d="M15 2h.01"/><path d="M22 20h.01"/><path d="m22 2-2.24.75a2.9 2.9 0 0 0-1.96 3.12v0c.1.86-.57 1.63-1.45 1.63h-.38c-.86 0-1.6.6-1.76 1.44L14 10"/><path d="m22 13-.82-.33c-.86-.34-1.82.2-1.98 1.11v0c-.11.7-.72 1.22-1.43 1.22H17"/><path d="m11 2 .33.82c.34.86-.2 1.82-1.11 1.98v0C9.52 4.9 9 5.52 9 6.23V7"/><path d="M11 13c1.93 1.93 2.83 4.17 2 5-.83.83-3.07-.07-5-2-1.93-1.93-2.83-4.17-2-5 .83-.83 3.07.07 5 2Z"/></svg>', "Kid's Parties"],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>', 'Graduations'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>', 'Bachelor/ette'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>', 'Engagement Parties'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>', 'Anniversaries'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>', 'Promotions'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>', 'And Much More'],
      ] as [$icon, $title]): ?>
      <div class="bg-[#3A4655] p-6 rounded-[5px] border border-neutral-800 hover:border-[#24CECE] transition-all hover:-translate-y-1 group flex flex-col items-center text-center">
        <div class="w-14 h-14 bg-[#535B71] rounded-full flex items-center justify-center mb-4 group-hover:bg-[#24CECE] group-hover:text-black transition-colors text-[#24CECE]">
          <?= $icon ?>
        </div>
        <h3 class="text-lg font-bold text-white"><?= htmlspecialchars($title) ?></h3>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
