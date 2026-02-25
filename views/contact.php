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
    <div class="w-full grid grid-cols-3 gap-4">
      <?php foreach ([
        ['contact', 'Contact Us'],
        ['talent',  'New Talents'],
        ['producers','Producers'],
      ] as [$id, $label]): ?>
      <a href="?view=contact&tab=<?= $id ?>"
         class="tab-btn px-3 md:px-6 py-3 md:py-4 font-bold flex items-center justify-center transition-colors w-full text-xs md:text-sm <?= $tab === $id ? 'bg-[#24CECE] text-black' : 'bg-[#0E1414] text-[#6A7474] hover:text-white' ?>">
        <?= $label ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto items-start">

    <!-- Left Column: Info -->
    <div class="space-y-8">
      <?php if ($tab === 'contact'): ?>
      <div class="relative bg-[#3A4655] p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-8">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg> Visit Us</div>
            <h3 class="text-3xl font-bold text-white mb-4">Get in <span class="text-[#24CECE]">Touch</span></h3>
            <p class="text-lg text-neutral-300 leading-relaxed">For information about shows, booking the club for a private event or any other questions please use the contact form below.</p>
          </div>
          <ul class="space-y-4">
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></div>
              <div>
                <h4 class="text-white font-bold text-lg">Address</h4>
                <p class="text-neutral-400 text-sm">487 Atlantic Ave, Brooklyn, NY 11217</p>
              </div>
            </li>
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></div>
              <div>
                <h4 class="text-white font-bold text-lg">Email</h4>
                <p class="text-neutral-400 text-sm">info@eastvillecomedy.com</p>
              </div>
            </li>
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
              <div>
                <h4 class="text-white font-bold text-lg">Phone</h4>
                <p class="text-neutral-400 text-sm">(347) 889-5226</p>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <?php elseif ($tab === 'talent'): ?>
      <div class="relative bg-[#3A4655] p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-8">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Auditions Open</div>
            <h3 class="text-3xl font-bold text-white mb-4">Join the <span class="text-[#24CECE]">Ranks</span></h3>
            <p class="text-xl text-neutral-300 leading-relaxed">EastVille Comedy Club is always looking for the best up and coming comedians in NYC. We hold a weekly <strong class="text-white border-b-2 border-[#24CECE]/50">"Rising Stars Showcase"</strong> and other new talent shows.</p>
          </div>
          <div class="p-6 bg-neutral-950/50 rounded-[5px] border border-white/5">
            <h4 class="text-white font-bold mb-2 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m22 8-6 4 6 4V8Z"/><rect width="14" height="12" x="2" y="6" rx="2" ry="2"/></svg> How to Apply</h4>
            <p class="text-neutral-400 leading-relaxed">For audition consideration, please fill out the form. Enter your info below to receive an alert once we begin booking the next "Rising Stars Showcase."</p>
          </div>
        </div>
      </div>

      <?php else: ?>
      <div class="relative bg-[#3A4655] p-10 rounded-[5px] border border-neutral-800 shadow-2xl overflow-hidden">
        <div class="relative z-10 space-y-6">
          <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-[5px] text-[#24CECE] font-bold text-sm uppercase tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg> Paid Opportunity</div>
            <h3 class="text-3xl font-bold text-white mb-4">Produce &amp; <span class="text-[#24CECE]">Earn</span></h3>
            <p class="text-lg text-neutral-300 leading-relaxed">We offer producing slots to ambitious comedians who have an eye for talent and putting together a great show.</p>
          </div>
          <ul class="space-y-4">
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
              <div>
                <h4 class="text-white font-bold text-lg">Make Some Cash</h4>
                <p class="text-neutral-400 text-sm">Producers receive a percentage of tickets sold.</p>
              </div>
            </li>
            <li class="flex gap-4 items-start p-4 rounded-[5px] bg-neutral-950/40 border border-white/5 hover:bg-neutral-950/60 transition-colors">
              <div class="shrink-0 w-10 h-10 rounded-[5px] flex items-center justify-center text-[#24CECE]"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
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
    <div class="bg-white pt-0 pb-8 px-8 md:px-10 rounded-[5px] border border-neutral-200 shadow-xl text-neutral-900">
      <form method="POST" action="?view=contact&tab=<?= $tab ?>" class="space-y-6">
        <input type="hidden" name="form_submitted" value="1" />

        <?php if ($tab === 'contact'): ?>
        <h2 class="text-2xl font-bold mb-8 text-neutral-900 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg> Send us a Message</h2>
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
        <h2 class="text-2xl font-bold mb-8 text-neutral-900 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" x2="12" y1="19" y2="22"/></svg> Talent Submission</h2>
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
        <h2 class="text-2xl font-bold mb-8 text-neutral-900 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#24CECE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Show Proposal</h2>
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
