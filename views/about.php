<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6">

  <!-- Header -->
  <div class="text-center mb-24">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">
      WHO ARE <span class="text-[#24CECE]">WE?</span>
    </h1>
    <p class="text-lg md:text-xl text-neutral-400 font-medium">We are Eastville Comedy Club.. Brooklyn's oldest comedy club! Just laughs &amp; cocktails!</p>
  </div>

  <!-- Section 1: The Story -->
  <div class="grid md:grid-cols-2 gap-16 items-center mb-32 relative">

    <!-- Image Side -->
    <div class="relative">
      <div class="absolute -bottom-6 -right-6 w-3/4 h-3/4 bg-[#24CECE] rounded-[5px] -z-10"></div>
      <div class="absolute -top-6 -left-6 w-full h-full border-2 border-neutral-700 rounded-[5px] -z-10"></div>
      <div class="rounded-[5px] overflow-hidden shadow-2xl relative z-10 bg-black">
        <img src="assets/about-img2.jpg" alt="Eastville Comedy Club Neon Sign" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700" />
      </div>
    </div>

    <!-- Content Side -->
    <div class="space-y-8 bg-[#171C1C] md:pl-8">
      <div class="flex items-center gap-3 mb-2">
        <i data-lucide="mic" class="w-6 h-6 text-[#24CECE]"></i>
        <h2 class="text-2xl font-black uppercase tracking-wide">THE STORY</h2>
      </div>
      <div class="space-y-6 text-neutral-400 leading-relaxed text-sm md:text-base">
        <p>Eastville is the oldest bonafide comedy club in the entire borough of Brooklyn! We also offer specialty-crafted cocktails to quench your thirst if you so desire. Along with yummy homemade popcorn and candy.</p>
        <p>Eastville is a 120 seat comedy club located right by the Barclays Center, and downtown Brooklyn's nightlife district! The club was founded by native New Yorkers with decades of experience in the comedy and bar business.</p>
        <p>Therefore, we pride ourselves in featuring the most experienced, popular, and hilarious comedians while also providing an authentic Brooklyn setting for our patrons.</p>
      </div>
    </div>
  </div>

  <!-- Features Grid -->
  <div class="grid md:grid-cols-3 gap-8 mb-12">
    <?php foreach ([
      ['TV AND FILM', 'film', 'We\'ve been the site of numerous TV and film shoots, and are often the outlet for celebrity comedians who drop by for impromptu performances. We also offer private parties and events for kids featuring child-friendly comedians, magicians and other performers.'],
      ['MANHATTAN', 'map-pin', 'Eastville was established in Manhattan in 2008, and after 10 wonderful years, it was time to upgrade our space. Brooklyn\'s explosion in popularity, culture, and nightlife made it the perfect location.'],
      ['INFLUENTIAL COMEDIANS', 'users', 'Many of the most influential comedians to ever take the stage, such as: Jackie Gleason, Chris Rock, Mel Brooks, Joan Rivers, as well as all Three Stooges all hail from Brooklyn.'],
    ] as [$title, $iconPath, $desc]): ?>
    <div class="bg-[#232828] p-8 rounded-[5px] border border-white/5 hover:border-[#24CECE]/30 transition-colors group">
      <div class="w-12 h-12 bg-[#24CECE]/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-[#24CECE] transition-colors">
        <i data-lucide="<?= $iconPath ?>" class="w-6 h-6 text-[#24CECE] group-hover:text-black transition-colors"></i>
      </div>
      <h3 class="text-xl font-black uppercase mb-4"><?= $title ?></h3>
      <p class="text-neutral-400 text-sm leading-relaxed"><?= $desc ?></p>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Bottom Images -->
  <div class="grid md:grid-cols-2 gap-8">
    <div class="h-[300px] md:h-[400px] rounded-[5px] overflow-hidden relative group">
      <img src="assets/about-img3.jpg" alt="Comedian performing" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale hover:grayscale-0" />
    </div>
    <div class="h-[300px] md:h-[400px] rounded-[5px] overflow-hidden relative group">
      <img src="assets/about-img4.jpg" alt="Eastville Bar Crowd" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale hover:grayscale-0" />
    </div>
  </div>
</div>
