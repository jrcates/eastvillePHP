<?php
require_once __DIR__ . '/data.php';

$view = isset($_GET['view']) ? preg_replace('/[^a-z\-]/', '', $_GET['view']) : 'home';
$validViews = ['home','schedule','comedians','comedian','gallery','menu','about','contact','openmic','private','gift','merchandise','event','addons','checkout','thank-you'];
if (!in_array($view, $validViews)) $view = 'home';

// Asset name aliases
$logoImg        = 'assets/59451cc7149d85f34ba0c1b826f86f2e0f826432.png';
$logoImgAlt     = 'assets/44e59a7f34f174b0a161fc78770929df40232ad0.png';
$footerBgImg    = 'assets/c70bd828898199745bfcb94d33c19b3d22b9b9fd.png';
$headerBgImg    = 'assets/4140ced9b7302bb6f1f2d3630b72a1a92f7d22f5.png';
$newsletterBgImg = 'assets/2d185aa45392e3ff7f1b5d944f149117d5a27397.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EastVille Comedy Club</title>

  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            teal: { DEFAULT: '#24CECE', dark: '#20B8B8' },
          }
        }
      }
    }
  </script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <style>
    * { font-family: 'Montserrat', sans-serif; }
    ::selection { background: #24CECE; color: #111; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    /* Slide-in drawer animation */
    #nav-drawer { transform: translateX(100%); transition: transform 0.3s ease; }
    #nav-drawer.open { transform: translateX(0); }
    #drawer-backdrop { opacity: 0; pointer-events: none; transition: opacity 0.3s ease; }
    #drawer-backdrop.open { opacity: 1; pointer-events: all; }
    /* Simple fade for view transitions */
    .view-fade { animation: fadeIn 0.3s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    /* Date badge */
    .date-badge { min-width: 80px; }
    /* Gallery hover */
    .gallery-item img { transition: transform 0.5s ease; }
    .gallery-item:hover img { transform: scale(1.05); }
    /* Show card hover */
    .show-card:hover { box-shadow: 0 20px 40px rgba(36,206,206,0.1); }
    .show-card:hover .show-card-img { transform: scale(1.1); }
    .show-card-img { transition: transform 0.5s ease; }
    /* Dotted line */
    .dotted-line { border-bottom: 2px dotted rgba(255,255,255,0.15); flex-grow: 1; margin: 0 1rem; position: relative; top: -2px; }
    /* Tab active indicator */
    .contact-tab.active { background: #24CECE; color: #111; }
    /* Sticky nav */
    #main-nav { transition: all 0.3s ease; }
    #main-nav.scrolled { background: rgba(23,28,28,0.9); backdrop-filter: blur(12px); padding-top: 1rem; padding-bottom: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border-bottom: 1px solid rgba(255,255,255,0.08); }
    /* Carousel */
    .hero-carousel { overflow: hidden; }
    .hero-track { display: flex; transition: transform 0.5s ease; }
    .hero-slide { flex: 0 0 100%; }
    /* Card hover lift */
    .hover-lift:hover { transform: translateY(-2px); }
    /* All buttons: 40px border radius */
    button,
    a[class*="font-bold"][class*="px-"] {
      border-radius: 40px !important;
    }
    /* Contact tab buttons: 5px border radius */
    a.tab-btn.tab-btn {
      border-radius: 5px !important;
    }
    /* Inner page titles: 62px / 800 weight */
    .inner-page h1 {
      font-size: 32px !important;
      font-weight: 800 !important;
    }
    @media (min-width: 768px) {
      .inner-page h1 {
        font-size: 62px !important;
      }
    }
    /* Teal buttons: force black text */
    .bg-\[\#24CECE\] {
      color: #000000 !important;
    }
  </style>
</head>
<body class="min-h-screen bg-[#171C1C] text-neutral-100 overflow-x-hidden">

  <!-- Header Background Glow -->
  <div class="absolute top-0 left-0 w-full h-[600px] pointer-events-none -z-10">
    <div class="absolute -top-[600px] left-[28%] w-[700px] h-[700px] rounded-full bg-[#8B7CBC] opacity-35 blur-[130px]"></div>
    <div class="absolute -top-[700px] left-1/2 -translate-x-1/2 w-[900px] h-[900px] rounded-full bg-[#20ffff] opacity-40 blur-[130px]"></div>
    <div class="absolute -top-[600px] right-[28%] w-[700px] h-[700px] rounded-full bg-[#B19139] opacity-30 blur-[130px]"></div>
  </div>

  <!-- ─── Navigation ─── -->
  <nav id="main-nav" class="fixed top-0 w-full z-50 py-[50px]">
    <div class="max-w-[1200px] mx-auto px-6 flex justify-between items-center">
      <a href="?view=home" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        <img src="<?= $logoImg ?>" alt="EastVille Comedy Club" class="h-12 object-contain" />
      </a>

      <!-- Desktop Nav -->
      <div class="hidden md:flex items-center gap-8">
        <a href="?view=schedule" class="text-sm font-bold uppercase tracking-wider text-neutral-400 hover:text-white transition-colors">Calendar</a>
        <a href="?view=contact" class="text-sm font-bold uppercase tracking-wider text-neutral-400 hover:text-white transition-colors">Contact</a>
        <button id="open-drawer-btn" class="px-6 py-2 bg-[#24CECE] text-black font-bold rounded-full hover:bg-[#20B8B8] transition-colors uppercase tracking-wider text-xs">More</button>
      </div>

      <!-- Mobile Menu Button -->
      <button id="open-drawer-btn-mobile" class="md:hidden text-neutral-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
      </button>
    </div>
  </nav>

  <!-- ─── Navigation Drawer ─── -->
  <div id="drawer-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60]"></div>
  <div id="nav-drawer" class="fixed top-0 right-0 h-full w-full md:w-[400px] bg-white text-neutral-900 z-[70] shadow-2xl overflow-y-auto">
    <div class="p-8">
      <div class="flex justify-between items-center mb-12">
        <img src="<?= $logoImgAlt ?>" alt="EastVille" class="h-10 object-contain" />
        <button id="close-drawer-btn" class="p-2 hover:bg-neutral-100 rounded-[5px] transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <nav class="space-y-6">
        <a href="?view=home" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Home</a>
        <div class="space-y-3">
          <div class="font-bold text-lg">About</div>
          <div class="pl-6 space-y-3 border-l-2 border-neutral-100 ml-1">
            <a href="?view=about" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">About Us</a>
            <a href="?view=private" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Private Events</a>
          </div>
        </div>
        <a href="?view=schedule" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Calendar</a>
        <a href="?view=openmic" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Open Mics</a>
        <a href="?view=merchandise" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Merchandise</a>
        <a href="?view=gift" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Gift Certificates</a>
        <a href="?view=gallery" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Gallery</a>
        <a href="?view=menu" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Drink &amp; Snack Menu</a>
        <a href="?view=comedians" class="block text-lg font-bold hover:text-[#24CECE] transition-colors">Comedians</a>
        <div class="space-y-3">
          <div class="font-bold text-lg">Contact</div>
          <div class="pl-6 space-y-3 border-l-2 border-neutral-100 ml-1">
            <a href="?view=contact&tab=contact" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Contact Us</a>
            <a href="?view=contact&tab=talent" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">New Talent</a>
            <a href="?view=contact&tab=producers" class="block text-neutral-600 hover:text-[#24CECE] font-medium transition-colors">Comedy Show Producers</a>
          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- ─── Main Content ─── -->
  <main class="view-fade<?= $view !== 'home' ? ' inner-page' : '' ?>">
    <?php
      $viewFile = __DIR__ . "/views/{$view}.php";
      if (file_exists($viewFile)) {
        include $viewFile;
      } else {
        include __DIR__ . '/views/home.php';
      }
    ?>
  </main>

  <!-- ─── Newsletter ─── -->
  <section class="py-16 relative z-10">
    <div class="max-w-[1200px] mx-auto px-6">
      <div class="relative rounded-[5px] overflow-hidden">
        <div class="absolute right-[-100px] top-0 h-full w-[500px] pointer-events-none z-0">
          <div class="absolute top-[-10%] right-[0%] w-[350px] h-[350px] rounded-full bg-[#8B7CBC] opacity-30 blur-[100px]"></div>
          <div class="absolute top-1/2 -translate-y-1/2 right-[10%] w-[350px] h-[350px] rounded-full bg-[#20ffff] opacity-40 blur-[100px]"></div>
          <div class="absolute bottom-[-10%] right-[0%] w-[350px] h-[350px] rounded-full bg-[#B19139] opacity-25 blur-[100px]"></div>
        </div>
        <div class="relative z-10 p-6 md:p-16 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 lg:gap-[72px]">
          <div class="flex-1 max-w-2xl">
            <h2 class="text-[26px] md:text-[52px] font-extrabold text-white leading-[1.15] md:leading-tight tracking-tight">
              <span class="hidden md:inline">For updates and<br />special events,<br />subscribe to our<br />newsletter:</span>
              <span class="md:hidden">For updates and special events, subscribe to our newsletter:</span>
            </h2>
          </div>
          <div class="flex-1 w-full max-w-xl flex flex-col justify-center">
            <p class="text-[#E3E3E3] text-sm md:text-lg leading-relaxed md:leading-loose mb-6 md:mb-12 font-medium">With deep roots in comedy and culture, Brooklyn has already become the bedrock of entertainment in New York City.</p>
            <form class="flex flex-col gap-4 md:gap-8" onsubmit="return false;">
              <input type="email" placeholder="Enter your best email" class="w-full px-5 md:px-8 py-3 md:py-6 bg-white border border-white rounded-[5px] text-black placeholder:text-neutral-400 font-medium text-sm md:text-lg focus:outline-none focus:ring-2 focus:ring-[#24CECE]" />
              <button type="submit" class="w-fit px-8 md:px-10 py-3 md:py-5 bg-[#24CECE] hover:bg-[#20B8B8] text-black font-bold rounded-full uppercase tracking-wider text-sm md:text-base transition-colors">Subscribe Now</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── Footer ─── -->
  <footer class="relative bg-[#171C1C] pt-24 pb-12">
    <div class="absolute bottom-0 left-0 w-full pointer-events-none z-0 overflow-hidden" style="height: 900px">
      <div class="absolute bottom-[-200px] left-[35%] w-[450px] h-[450px] rounded-full bg-[#8B7CBC] opacity-20 blur-[120px]"></div>
      <div class="absolute bottom-[-250px] left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-[#20ffff] opacity-25 blur-[120px]"></div>
      <div class="absolute bottom-[-200px] right-[35%] w-[450px] h-[450px] rounded-full bg-[#B19139] opacity-15 blur-[120px]"></div>
    </div>
    <div class="max-w-[1200px] mx-auto px-6 relative z-10">
      <div class="grid md:grid-cols-[300px_1fr] gap-12 lg:gap-24 mb-20">
        <!-- Logo & Socials -->
        <div class="space-y-6">
          <img src="<?= $logoImg ?>" alt="EastVille Comedy Club" class="h-12 object-contain" />
          <p class="text-neutral-400 text-xs leading-relaxed max-w-xs">With deep roots in comedy and culture, Brooklyn has already become the bedrock of entertainment in New York City.</p>
          <div class="flex gap-4">
            <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="#" class="w-8 h-8 rounded-full bg-neutral-800 flex items-center justify-center text-white hover:bg-[#24CECE] hover:text-black transition-all">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
          </div>
        </div>
        <!-- Navigation Links -->
        <div class="w-full">
          <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-8 border-b border-[#42B2B4] pb-4">Navigation</h4>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-4 gap-x-8">
            <?php foreach ([
              ['Home','home'],['About Us','about'],['Private Events','private'],['Calendar','schedule'],
              ['Open Mic','openmic'],['Merchandise','merchandise'],['Gift Certificates','gift'],['Gallery','gallery'],
              ['Drinks &amp; Snack Menu','menu'],['Comedians','comedians'],['Contact','contact'],
            ] as [$label, $link]): ?>
            <a href="?view=<?= $link ?>" class="text-xs text-neutral-400 font-medium hover:text-[#24CECE] transition-colors"><?= $label ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-neutral-400 font-bold uppercase tracking-widest">
        <p>&copy; 2024 &ndash; 2026 &ndash; EastVille Comedy Club &ndash; All Rights Reserved</p>
        <div class="flex gap-6">
          <a href="#" class="hover:text-white transition-colors">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ─── Global JS ─── -->
  <script>
  $(function () {
    // Initialize Lucide icons
    lucide.createIcons();

    // Sticky nav on scroll
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 50) {
        $('#main-nav').addClass('scrolled').removeClass('py-[50px]').addClass('py-4');
      } else {
        $('#main-nav').removeClass('scrolled').addClass('py-[50px]').removeClass('py-4');
      }
    });

    // Open / close drawer
    function openDrawer() {
      $('#nav-drawer').addClass('open');
      $('#drawer-backdrop').addClass('open');
      $('body').css('overflow', 'hidden');
    }
    function closeDrawer() {
      $('#nav-drawer').removeClass('open');
      $('#drawer-backdrop').removeClass('open');
      $('body').css('overflow', '');
    }
    $('#open-drawer-btn, #open-drawer-btn-mobile').on('click', openDrawer);
    $('#close-drawer-btn, #drawer-backdrop').on('click', closeDrawer);
  });
  </script>
</body>
</html>