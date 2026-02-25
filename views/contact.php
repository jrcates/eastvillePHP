<?php
$tab = isset($_GET['tab']) ? preg_replace('/[^a-z]/', '', $_GET['tab']) : 'contact';
$validTabs = ['contact', 'talent', 'producers'];
if (!in_array($tab, $validTabs)) $tab = 'contact';

$success = isset($_POST['form_submitted']) && $_POST['form_submitted'] === '1';
?>

<?php if ($success): ?>
<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6 min-h-screen flex flex-col items-center justify-center text-center">
  <div class="w-24 h-24 bg-green-500/10 rounded-[5px] flex items-center justify-center mb-8">
    <i data-lucide="circle-check" class="w-12 h-12 text-green-500"></i>
  </div>
  <h1 class="text-4xl md:text-5xl font-bold mb-6">Message Sent!</h1>
  <p class="text-xl text-neutral-400 max-w-lg mb-8">Thanks for reaching out. We've received your submission and will get back to you soon.</p>
  <a href="?view=contact" class="px-8 py-4 bg-[#24CECE] text-neutral-900 font-bold rounded-[5px] hover:bg-[#20B8B8] transition-colors">Send Another</a>
</div>
<?php else: ?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-6">

  <!-- Header -->
  <div class="max-w-4xl mx-auto mb-12 text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-6 uppercase tracking-tight">QUESTIONS?</h1>
    <p class="text-xl text-neutral-400 max-w-2xl mx-auto">Select a category below for General Inquiries, New Talent Auditions, or Show Production Proposals.</p>
  </div>

  <!-- Tabs -->
  <div class="w-full mb-16 sticky top-24 z-30">
    <div class="w-full bg-neutral-900/80 backdrop-blur-xl p-1.5 rounded-[5px] border border-neutral-800 shadow-2xl grid grid-cols-3 gap-1">
      <?php foreach ([
        ['contact', 'Contact Us',  'mail'],
        ['talent',  'New Talent',  'mic'],
        ['producers','Producers',  'clapperboard'],
      ] as [$id, $label, $iconPath]): ?>
      <a href="?view=contact&tab=<?= $id ?>"
         class="relative px-3 md:px-6 py-3 md:py-4 rounded-[5px] font-bold flex items-center justify-center gap-1.5 md:gap-2 transition-colors w-full <?= $tab === $id ? 'bg-[#24CECE] text-neutral-900' : 'text-neutral-400 hover:text-white hover:bg-white/5' ?>">
        <i data-lucide="<?= $iconPath ?>" class="w-4 h-4 md:w-5 md:h-5 shrink-0"></i>
        <span class="whitespace-nowrap text-xs md:text-sm"><?= $label ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto items-start">

    <!-- Left Column: Info -->
    <div class="space-y-8">
      <?php if ($tab === 'contact'): ?>
      <div class="relative bg-gradient-to-br from-neutral-900 to-neutral-800 p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-8">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] bg-[#24CECE]/10 text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4">📍 Visit Us</div>
            <h3 class="text-3xl font-bold text-white mb-4">Get in <span class="text-[#24CECE]">Touch</span></h3>
            <p class="text-lg text-neutral-300 leading-relaxed">For information about shows, booking the club for a private event or any other questions please use the contact form below.</p>
          </div>
          <ul class="space-y-4">
            <?php foreach ([
              ['📍 Address', '487 Atlantic Ave, Brooklyn, NY 11217'],
              ['✉️ Email', 'info@eastvillecomedy.com'],
              ['📞 Phone', '(347) 889-5226'],
            ] as [$label, $value]): ?>
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] bg-[#24CECE]/10 flex items-center justify-center text-[#24CECE] text-sm"><?= explode(' ', $label)[0] ?></div>
              <div>
                <h4 class="text-white font-bold text-lg"><?= explode(' ', $label, 2)[1] ?></h4>
                <p class="text-neutral-400 text-sm"><?= htmlspecialchars($value) ?></p>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <?php elseif ($tab === 'talent'): ?>
      <div class="relative bg-gradient-to-br from-neutral-900 to-neutral-800 p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-8">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] bg-[#24CECE]/10 text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4">⭐ Auditions Open</div>
            <h3 class="text-3xl font-bold text-white mb-4">Join the <span class="text-[#24CECE]">Ranks</span></h3>
            <p class="text-xl text-neutral-300 leading-relaxed">EastVille Comedy Club is always looking for the best up and coming comedians in NYC. We hold a weekly <strong class="text-white border-b-2 border-[#24CECE]/50">"Rising Stars Showcase"</strong> and other new talent shows.</p>
          </div>
          <div class="p-6 bg-neutral-950/50 rounded-[5px] border border-white/5">
            <h4 class="text-white font-bold mb-2">🎥 How to Apply</h4>
            <p class="text-neutral-400 leading-relaxed">For audition consideration, please fill out the form. Enter your info below to receive an alert once we begin booking the next "Rising Stars Showcase."</p>
          </div>
        </div>
      </div>

      <?php else: ?>
      <div class="relative bg-gradient-to-br from-neutral-900 to-neutral-800 p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-6">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] bg-[#24CECE]/10 text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4">💰 Paid Opportunity</div>
            <h3 class="text-3xl font-bold text-white mb-4">Produce &amp; <span class="text-[#24CECE]">Earn</span></h3>
            <p class="text-lg text-neutral-300 leading-relaxed">We offer producing slots to ambitious comedians who have an eye for talent and putting together a great show.</p>
          </div>
          <ul class="space-y-4">
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] bg-[#24CECE]/10 flex items-center justify-center text-[#24CECE]">💵</div>
              <div>
                <h4 class="text-white font-bold text-lg">Make Some Cash</h4>
                <p class="text-neutral-400 text-sm">Producers receive a percentage of tickets sold.</p>
              </div>
            </li>
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] bg-[#24CECE]/10 flex items-center justify-center text-[#24CECE]">⭐</div>
              <div>
                <h4 class="text-white font-bold text-lg">Build Your Brand</h4>
                <p class="text-neutral-400 text-sm">Perform alongside NYC's top headliners.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Right Column: Form -->
    <div class="bg-white p-8 md:p-10 rounded-[5px] border border-neutral-200 shadow-xl text-neutral-900">
      <form method="POST" action="?view=contact&tab=<?= $tab ?>" class="space-y-6">
        <input type="hidden" name="form_submitted" value="1" />

        <?php if ($tab === 'contact'): ?>
        <h2 class="text-2xl font-bold mb-8 text-neutral-900">Send us a Message ✉️</h2>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Name</label>
          <input required type="text" name="name" placeholder="Your name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Email</label>
          <input required type="email" name="email" placeholder="your@email.com" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Message</label>
          <textarea required name="message" rows="6" placeholder="How can we help you?" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400 resize-none"></textarea>
        </div>

        <?php elseif ($tab === 'talent'): ?>
        <h2 class="text-2xl font-bold mb-8 text-neutral-900">Talent Submission 🎤</h2>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Name</label>
          <input required type="text" name="name" placeholder="Your name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Email</label>
          <input required type="email" name="email" placeholder="your@email.com" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Short Bio</label>
          <textarea required name="bio" rows="4" placeholder="Tell us about yourself..." class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400 resize-none"></textarea>
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Performance Video Link(s)</label>
          <input required type="url" name="video" placeholder="YouTube / Vimeo link" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>

        <?php else: ?>
        <h2 class="text-2xl font-bold mb-8 text-neutral-900">Show Proposal 🎬</h2>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Name</label>
          <input required type="text" name="name" placeholder="Your name" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Email</label>
          <input required type="email" name="email" placeholder="your@email.com" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Number of Guests</label>
          <input required type="number" name="guests" placeholder="Estimated attendance" class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400" />
        </div>
        <div class="space-y-2">
          <label class="text-sm font-bold text-neutral-600 ml-1 uppercase tracking-wider">Additional Details</label>
          <textarea required name="details" rows="4" placeholder="Short bio and why you'd be a good producer..." class="w-full bg-neutral-50 border border-neutral-200 rounded-[5px] p-4 text-neutral-900 focus:ring-2 focus:ring-[#24CECE] focus:border-transparent outline-none placeholder:text-neutral-400 resize-none"></textarea>
        </div>
        <?php endif; ?>

        <button type="submit" class="w-full py-4 bg-[#24CECE] text-neutral-900 font-bold text-lg rounded-[5px] hover:bg-[#20B8B8] transition-colors shadow-lg mt-4">Submit</button>
      </form>
    </div>

  </div>
</div>
<?php endif; ?>
