<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6">

  <!-- Header -->
  <div class="max-w-4xl mx-auto mb-20 text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">Open <span class="text-[#24CECE]">Mics</span></h1>
    <p class="text-xl text-neutral-400 font-medium">Where the magic (and the silence) happens.</p>
  </div>

  <!-- Top Section -->
  <div class="grid lg:grid-cols-12 gap-12 mb-20 items-start">
    <!-- Left: Intro Text -->
    <div class="lg:col-span-7 space-y-6">
      <h2 class="text-3xl font-black uppercase tracking-wide mb-2">Hone Your Craft</h2>
      <div class="space-y-4 text-lg text-neutral-400 leading-relaxed">
        <p>Many of the world's top comedians began honing their stand-up skills on the EastVille stage! Our open mics feature the city's top up-and-coming comedians regularly crafting and fine-tuning their material.</p>
        <p>EastVille often has the audience sitting in on the open mics watching the raw creative process at work. It's a unique opportunity to see jokes in their infancy, before they end up on Netflix specials.</p>
      </div>
    </div>
    <!-- Right: CTA Box -->
    <div class="lg:col-span-5">
      <div class="bg-white p-8 rounded-[5px] text-neutral-900 shadow-xl">
        <h3 class="text-2xl font-black uppercase mb-4">Want to Perform?</h3>
        <p class="text-neutral-600 mb-8 leading-relaxed font-medium">Each mic has a different sign-up process. Visit our Calendar Page and click on whichever date you prefer to see specific instructions.</p>
        <a href="?view=schedule" class="block w-full py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-[40px] hover:bg-[#20B8B8] transition-colors text-center uppercase tracking-wide text-sm">View Calendar</a>
        <p class="text-xs text-center mt-4 text-neutral-400 font-medium">*Late arrivals are not guaranteed to perform.</p>
      </div>
    </div>
  </div>

  <!-- Important Reminders -->
  <div class="bg-[#2D3748] rounded-[5px] p-8 md:p-12 mb-24 border-t-4 border-[#24CECE]">
    <h3 class="text-3xl font-black uppercase mb-10 text-white">Important Reminders</h3>
    <div class="grid md:grid-cols-2 gap-6">
      <?php foreach ([
        ['<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 11h1a3 3 0 0 1 0 6h-1"/><path d="M9 12v6"/><path d="M13 12v6"/><path d="M14 7.5c-1 0-1.44.5-3 .5s-2-.5-3-.5-1.72.5-2.5.5a2.5 2.5 0 0 1 0-5c.78 0 1.57.5 2.5.5S9.44 3 11 3s2 .5 3 .5 1.72-.5 2.5-.5a2.5 2.5 0 0 1 0 5c-.78 0-1.5-.5-2.5-.5z"/><path d="M5 8v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8"/></svg>', '1 Drink Minimum', 'Applies to everyone, performers and audience members alike.'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>', 'Arrive Early', 'Comics must arrive 30 minutes early to sign up in person.'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>', 'First Come Basis', 'Line-ups determined day-of. No email or phone sign-ups.'],
        ['<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" x2="12" y1="19" y2="22"/></svg>', '5-7 Minutes', 'Stage time usually varies based on the lineup size.'],
      ] as [$icon, $title, $desc]): ?>
      <div class="bg-[#3A4659] p-8 rounded-[5px] shadow-lg flex flex-col items-start gap-4">
        <div class="text-[#24CECE]"><?= $icon ?></div>
        <div>
          <h4 class="font-bold text-white text-xl mb-2"><?= $title ?></h4>
          <p class="text-neutral-400 leading-relaxed"><?= $desc ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Weekly Schedule -->
  <div>
    <div class="flex items-center gap-3 mb-12">
      <div class="w-10 h-10 rounded-full bg-[#0E1414] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></div>
      <h2 class="text-3xl font-black uppercase tracking-wide">Weekly Schedule</h2>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ([
        ['Monday',    ['6:00pm – 7:00pm', '7:00pm – 8:00pm', '8:00pm – 9:00pm'], ['EastVille Open Mic Spectacular', 'EastVille Open Mic Spectacular', 'EastVille Open Mic Spectacular']],
        ['Tuesday',   ['5:00pm – 6:00pm', '6:00pm – 7:00pm', '7:00pm – 8:00pm'], ['EastVille Open Mic', 'Mecca Mic', 'EastVille Open Mic']],
        ['Wednesday', ['6:00pm – 7:45pm', '9:45pm – 11:30pm'], ['Comedy Loves Ya Mic', "Try New Sh*t Mic"]],
        ['Thursday',  ['6:00pm – 7:45pm'], ['The Best G.D. Open Mic Ever']],
        ['Friday',    ['5:30pm – 7:30pm', '11:30pm – 1:00am'], ['The Golden Pen Mic', 'Starr Struck Late Night']],
        ['Saturday',  ['4:00pm – 4:30pm', '11:30pm – 1:00am'], ['EastVille Open Mic', 'Late Night Mic']],
        ['Sunday',    ['5:00pm – 6:00pm', '6:00pm – 7:45pm'], ['The Golden Pen Mic', 'No Name Mic']],
      ] as [$day, $slots, $names]): ?>
      <div class="border border-[#24CECE] rounded-[5px] overflow-hidden flex flex-col h-full">
        <div class="bg-[#24CECE] px-6 py-4">
          <h3 class="font-black text-[#9FFFFF] uppercase tracking-wide text-lg"><?= $day ?></h3>
        </div>
        <div class="px-6 py-6 flex-1 flex flex-col gap-5">
          <?php foreach ($slots as $k => $slot): ?>
          <div class="flex flex-col gap-1">
            <span class="text-[#24CECE] text-[14px] font-normal"><?= $slot ?></span>
            <span class="text-white text-[14px] font-normal leading-tight"><?= htmlspecialchars($names[$k]) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
