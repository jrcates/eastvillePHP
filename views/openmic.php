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
        <a href="?view=schedule" class="block w-full py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-[5px] hover:bg-[#20B8B8] transition-colors text-center uppercase tracking-wide text-sm">View Calendar</a>
        <p class="text-xs text-center mt-4 text-neutral-400 font-medium">*Late arrivals are not guaranteed to perform.</p>
      </div>
    </div>
  </div>

  <!-- Important Reminders -->
  <div class="bg-[#2D3748] rounded-[5px] p-8 md:p-12 mb-24 border-t-4 border-[#24CECE]">
    <h3 class="text-3xl font-black uppercase mb-10 text-white">Important Reminders</h3>
    <div class="grid md:grid-cols-2 gap-6">
      <?php foreach ([
        ['☕', '1 Drink Minimum', 'Applies to everyone, performers and audience members alike.'],
        ['🕐', 'Arrive Early',    'Comics must arrive 30 minutes early to sign up in person.'],
        ['👥', 'First Come Basis','Line-ups determined day-of. No email or phone sign-ups.'],
        ['🎤', '5-7 Minutes',     'Stage time usually varies based on the lineup size.'],
      ] as [$icon, $title, $desc]): ?>
      <div class="bg-[#3A4659] p-8 rounded-[5px] shadow-lg flex flex-col items-start gap-4">
        <div class="text-3xl"><?= $icon ?></div>
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
      <div class="w-10 h-10 rounded-full bg-[#24CECE]/10 flex items-center justify-center text-[#24CECE]">📅</div>
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
        <div class="bg-[#24CECE] p-3 text-center">
          <h3 class="font-bold text-neutral-900 uppercase tracking-widest text-sm"><?= $day ?></h3>
        </div>
        <div class="bg-[#171C1C] p-6 flex-1 flex flex-col gap-4">
          <?php foreach ($slots as $k => $slot): ?>
          <div class="flex flex-col gap-1">
            <span class="text-[#24CECE] text-xs font-bold"><?= $slot ?></span>
            <span class="text-white text-sm font-medium leading-tight"><?= htmlspecialchars($names[$k]) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
