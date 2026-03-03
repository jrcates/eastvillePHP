<?php
require_once __DIR__ . '/../data.php';

// Hardcoded promo dates
$promoDates = ['2026-02-21', '2026-03-06', '2026-03-25', '2026-04-04', '2026-04-18'];

// Filter shows to matching dates, exclude sold-out
$promoShows = [];
foreach ($shows as $show) {
  $ts = strtotime($show['date']);
  $dateKey = date('Y-m-d', $ts);
  if (in_array($dateKey, $promoDates) && $show['status'] !== 'Sold Out') {
    $show['weekday']       = date('D', $ts);
    $show['day']           = date('j', $ts);
    $show['month']         = date('M', $ts);
    $show['timeFormatted'] = date('g:i A', $ts);
    $show['dateKey']       = $dateKey;
    $promoShows[] = $show;
  }
}

// JSON encode promo dates for JS calendar
$promoDatesJson = json_encode($promoDates);

// Group by date label
$grouped = [];
foreach ($promoShows as $show) {
  $ts  = strtotime($show['date']);
  $key = date('l, F j', $ts);
  $grouped[$key][] = $show;
}
?>

<div class="pt-[150px] pb-24 max-w-[1200px] mx-auto px-4 md:px-6 min-h-screen">

  <!-- Page Title -->
  <div class="mb-4 text-center">
    <h1 class="text-4xl md:text-5xl font-black text-white mb-3 uppercase tracking-tight">Promo Dates</h1>
    <p class="text-neutral-400 text-lg max-w-2xl mx-auto">Grab $2 off per ticket on these select show dates!</p>
  </div>

  <!-- Promo Banner -->
  <div class="mb-10 bg-[#F26522]/10 border border-[#F26522] rounded-[8px] p-5 text-center">
    <p class="text-[#F26522] font-bold text-base">
      <i data-lucide="sparkles" class="w-5 h-5 inline-block align-middle mr-1"></i>
      Use code <span class="bg-[#F26522] text-white px-2 py-0.5 rounded font-black text-sm mx-1">EE001</span> at checkout for <strong>$2 off per ticket</strong> on any show below.
    </p>
  </div>

  <!-- ─── Calendar Filter Bar ─── -->
  <div class="mb-10 sticky top-4 z-40">
    <div class="bg-neutral-950/90 backdrop-blur-md border border-neutral-800 rounded-[8px] shadow-2xl relative">

      <!-- Controls -->
      <div class="flex flex-col md:flex-row md:items-center gap-0 p-3">
        <!-- All Shows + Month Picker -->
        <div class="grid grid-cols-2 md:flex md:items-center gap-3 shrink-0">
          <button id="filter-all" class="px-5 py-3 rounded-[5px] font-bold text-sm uppercase tracking-wider transition-colors bg-[#F26522] text-white whitespace-nowrap text-center">All Promos</button>
          <button id="month-picker-btn" class="flex items-center justify-center gap-2 px-4 py-3 rounded-[5px] bg-neutral-800 text-white font-bold text-sm hover:bg-neutral-700 transition-colors whitespace-nowrap">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span id="month-picker-label">Feb 2026</span>
          </button>
        </div>

        <!-- Week Strip -->
        <div class="flex-1 flex items-center mt-3 md:mt-0 md:ml-4 overflow-hidden">
          <button id="week-prev" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-800 text-neutral-500 hover:text-white transition-colors shrink-0">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
          </button>
          <div id="week-strip" class="flex-1 flex items-center justify-around overflow-hidden"></div>
          <button id="week-next" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-800 text-neutral-500 hover:text-white transition-colors shrink-0">
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
          </button>
        </div>
      </div>

      <!-- Dropdown Calendar -->
      <div id="calendar-dropdown" class="hidden absolute left-1/2 -translate-x-1/2 md:left-3 md:translate-x-0 top-full mt-1 bg-[#1E2323] border border-neutral-700 rounded-[10px] shadow-2xl p-5 w-[calc(100%-24px)] max-w-[300px] md:w-[300px] z-50">
        <div class="flex items-center justify-between mb-4">
          <button id="cal-prev-month" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-700 text-neutral-400 hover:text-white transition-colors">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
          </button>
          <span id="cal-month-title" class="text-white font-bold text-base"></span>
          <button id="cal-next-month" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-neutral-700 text-neutral-400 hover:text-white transition-colors">
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
          </button>
        </div>
        <div class="grid grid-cols-7 gap-1 mb-2">
          <div class="text-center text-xs font-bold text-neutral-500 py-1">SU</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">MO</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">TU</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">WE</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">TH</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">FR</div>
          <div class="text-center text-xs font-bold text-neutral-500 py-1">SA</div>
        </div>
        <div id="cal-grid" class="grid grid-cols-7 gap-1"></div>
      </div>

    </div>
  </div>

  <!-- ─── Shows List ─── -->
  <div class="space-y-12" id="promo-shows-list">
    <?php if (empty($grouped)): ?>
    <div class="text-center py-16">
      <p class="text-neutral-500 text-lg">No promo shows available right now. Check back soon!</p>
    </div>
    <?php endif; ?>

    <?php foreach ($grouped as $dateLabel => $dayShows): ?>
    <div class="show-group" data-date="<?= $dayShows[0]['dateKey'] ?>" data-month="<?= date('M Y', strtotime($dayShows[0]['date'])) ?>">
      <!-- Date Header -->
      <div class="flex items-center gap-4 mb-6 mt-8">
        <div class="w-2 h-8 bg-[#F26522] rounded-full"></div>
        <h2 class="text-[22px] font-extrabold text-white uppercase tracking-tighter"><?= htmlspecialchars(strtoupper($dateLabel)) ?></h2>
      </div>
      <div class="flex flex-col gap-4">
        <?php foreach ($dayShows as $show): ?>
        <div class="show-card group bg-white rounded-[5px] p-6 flex flex-col md:flex-row items-center gap-8 transition-all border border-neutral-800" data-show-date="<?= $show['dateKey'] ?>">
          <!-- Date Badge -->
          <div class="flex flex-col items-center flex-shrink-0">
            <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center date-badge bg-white">
              <div class="text-sm font-bold text-black leading-none"><?= $show['weekday'] ?></div>
              <div class="text-4xl font-black leading-none text-black my-1"><?= $show['day'] ?></div>
              <div class="text-sm font-bold text-black leading-none"><?= $show['month'] ?></div>
            </div>
            <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= $show['timeFormatted'] ?></div>
          </div>
          <!-- Image -->
          <div class="w-full md:w-[220px] h-[140px] rounded-[5px] overflow-hidden flex-shrink-0">
            <img src="<?= htmlspecialchars($show['image']) ?>" alt="<?= htmlspecialchars($show['title']) ?>" class="show-card-img w-full h-full object-cover" />
          </div>
          <!-- Content -->
          <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left self-center">
            <div class="flex flex-wrap justify-between items-start w-full mb-3 gap-2">
              <h3 class="text-[20px] font-extrabold text-black uppercase"><?= htmlspecialchars($show['title']) ?></h3>
              <span class="text-xs font-bold uppercase tracking-wider text-white bg-[#F26522] px-2 py-1 rounded whitespace-nowrap">$2 Off</span>
            </div>
            <p class="text-neutral-500 text-sm leading-relaxed line-clamp-2"><?= htmlspecialchars($show['description']) ?></p>
          </div>
          <!-- Button -->
          <a href="?view=event&show=<?= urlencode($show['id']) ?>&promo=EE001" class="px-8 py-3 bg-[#24CECE] text-black font-bold rounded-full text-sm hover:bg-[#20B8B8] transition-colors whitespace-nowrap flex-shrink-0 hover-lift shadow-lg shadow-[#24CECE]/20">Buy Tickets</a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
$(function () {
  var promoDates = <?= $promoDatesJson ?>;
  var dayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
  var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

  var today = new Date();
  var calMonth = today.getMonth();
  var calYear = today.getFullYear();
  var selectedDate = null;

  function pad(n) { return n < 10 ? '0' + n : '' + n; }
  function dateStr(d) { return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); }
  function hasPromo(d) { return promoDates.indexOf(dateStr(d)) !== -1; }

  function getFirstWeekStart(m, y) {
    var first = new Date(y, m, 1);
    var ws = new Date(first);
    ws.setDate(first.getDate() - first.getDay());
    return ws;
  }
  function getLastWeekStart(m, y) {
    var last = new Date(y, m + 1, 0);
    var ws = new Date(last);
    ws.setDate(last.getDate() - last.getDay());
    return ws;
  }

  var weekStart = getFirstWeekStart(calMonth, calYear);

  // ─── Week Strip ───
  function renderWeekStrip() {
    var $strip = $('#week-strip').empty();
    var firstWS = getFirstWeekStart(calMonth, calYear);
    var lastWS = getLastWeekStart(calMonth, calYear);

    $('#week-prev').toggleClass('opacity-30 pointer-events-none', weekStart.getTime() <= firstWS.getTime());
    $('#week-next').toggleClass('opacity-30 pointer-events-none', weekStart.getTime() >= lastWS.getTime());

    for (var i = 0; i < 7; i++) {
      var d = new Date(weekStart);
      d.setDate(weekStart.getDate() + i);
      var ds = dateStr(d);
      var inMonth = d.getMonth() === calMonth && d.getFullYear() === calYear;
      var isSelected = selectedDate === ds;
      var isToday = ds === dateStr(today);
      var hasEvent = hasPromo(d);

      var $day = $('<button class="flex flex-col items-center py-2 px-1.5 md:px-3 rounded-[8px] transition-colors min-w-0 md:min-w-[60px] flex-1"></button>');

      if (!inMonth) {
        $day.addClass('opacity-25 cursor-default');
        $day.append('<div class="text-[10px] font-bold tracking-wider text-neutral-600">' + dayNames[d.getDay()] + '</div>');
        $day.append('<div class="text-xl font-black text-neutral-600">' + d.getDate() + '</div>');
        $day.append('<div class="w-1.5 h-1.5 mt-1"></div>');
      } else {
        $day.addClass('cursor-pointer');
        $day.append('<div class="text-[10px] font-bold tracking-wider ' + (isSelected ? 'text-white' : 'text-neutral-500') + '">' + dayNames[d.getDay()] + '</div>');
        $day.append('<div class="text-xl font-black ' + (isSelected ? 'text-white' : 'text-white') + '">' + d.getDate() + '</div>');
        if (hasEvent) {
          $day.append('<div class="w-1.5 h-1.5 rounded-full mt-1 bg-[#F26522]"></div>');
        } else {
          $day.append('<div class="w-1.5 h-1.5 mt-1"></div>');
        }

        if (isSelected) {
          $day.addClass('bg-[#F26522]');
        } else if (isToday) {
          $day.addClass('bg-neutral-800');
        } else {
          $day.addClass('hover:bg-neutral-800');
        }

        $day.data('date', ds);
      }

      $strip.append($day);
    }

    $strip.find('button').on('click', function () {
      var clickedDate = $(this).data('date');
      if (!clickedDate) return;
      if (selectedDate === clickedDate) {
        selectedDate = null;
      } else {
        selectedDate = clickedDate;
      }
      updateFilterUI();
      filterShows();
      renderWeekStrip();
      renderCalendar();
    });
  }

  // ─── Dropdown Calendar ───
  function renderCalendar() {
    $('#cal-month-title').text(monthNames[calMonth] + ' ' + calYear);
    var $grid = $('#cal-grid').empty();

    var firstDay = new Date(calYear, calMonth, 1).getDay();
    var daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();

    for (var i = 0; i < firstDay; i++) {
      $grid.append('<div></div>');
    }

    for (var day = 1; day <= daysInMonth; day++) {
      var d = new Date(calYear, calMonth, day);
      var ds = dateStr(d);
      var isSelected = selectedDate === ds;
      var isToday = ds === dateStr(today);
      var hasEvent = hasPromo(d);

      var cls = 'flex flex-col items-center justify-center py-1.5 rounded-full text-sm cursor-pointer transition-colors ';
      if (isSelected) {
        cls += 'bg-[#F26522] text-white font-bold';
      } else if (isToday) {
        cls += 'border border-[#F26522] text-white font-bold';
      } else if (hasEvent) {
        cls += 'text-[#F26522] font-bold hover:bg-neutral-700';
      } else {
        cls += 'text-neutral-400 hover:bg-neutral-700';
      }

      var $cell = $('<button class="' + cls + '">' + day + '</button>');
      if (hasEvent) {
        $cell.append('<div class="w-1 h-1 rounded-full bg-[#F26522] mt-0.5"></div>');
      }
      $cell.data('date', ds);
      $cell.on('click', function () {
        var clickedDate = $(this).data('date');
        selectedDate = clickedDate;

        var sel = new Date(clickedDate);
        weekStart = new Date(sel);
        weekStart.setDate(sel.getDate() - sel.getDay());

        updateFilterUI();
        filterShows();
        renderWeekStrip();
        renderCalendar();
        $('#calendar-dropdown').addClass('hidden');
      });

      $grid.append($cell);
    }
  }

  // ─── Filter Shows ───
  function filterShows() {
    var monthLabel = shortMonths[calMonth] + ' ' + calYear;
    $('.show-group').each(function () {
      var $group = $(this);
      var groupMonth = $group.data('month');

      if (groupMonth !== monthLabel) {
        $group.hide();
        return;
      }

      if (selectedDate) {
        var $cards = $group.find('.show-card');
        var hasVisible = false;
        $cards.each(function () {
          if ($(this).data('show-date') === selectedDate) {
            $(this).show();
            hasVisible = true;
          } else {
            $(this).hide();
          }
        });
        if (hasVisible) $group.show(); else $group.hide();
      } else {
        $group.show();
        $group.find('.show-card').show();
      }
    });
  }

  function setMonth(m, y) {
    calMonth = m;
    calYear = y;
    selectedDate = null;
    weekStart = getFirstWeekStart(m, y);
    updateFilterUI();
    renderWeekStrip();
    renderCalendar();
    filterShows();
  }

  function updateFilterUI() {
    if (!selectedDate) {
      $('#filter-all').addClass('bg-[#F26522] text-white').removeClass('text-neutral-400 bg-transparent');
    } else {
      $('#filter-all').removeClass('bg-[#F26522] text-white').addClass('text-neutral-400');
    }
    $('#month-picker-label').text(shortMonths[calMonth] + ' ' + calYear);
  }

  // ─── Event Handlers ───
  $('#filter-all').on('click', function () {
    selectedDate = null;
    updateFilterUI();
    filterShows();
    renderWeekStrip();
    renderCalendar();
  });

  $('#month-picker-btn').on('click', function (e) {
    e.stopPropagation();
    $('#calendar-dropdown').toggleClass('hidden');
  });

  $(document).on('click', function (e) {
    if (!$(e.target).closest('#calendar-dropdown, #month-picker-btn').length) {
      $('#calendar-dropdown').addClass('hidden');
    }
  });

  $('#cal-prev-month').on('click', function () {
    var m = calMonth - 1, y = calYear;
    if (m < 0) { m = 11; y--; }
    setMonth(m, y);
  });
  $('#cal-next-month').on('click', function () {
    var m = calMonth + 1, y = calYear;
    if (m > 11) { m = 0; y++; }
    setMonth(m, y);
  });

  $('#week-prev').on('click', function () {
    var firstWS = getFirstWeekStart(calMonth, calYear);
    if (weekStart.getTime() <= firstWS.getTime()) return;
    weekStart.setDate(weekStart.getDate() - 7);
    renderWeekStrip();
  });
  $('#week-next').on('click', function () {
    var lastWS = getLastWeekStart(calMonth, calYear);
    if (weekStart.getTime() >= lastWS.getTime()) return;
    weekStart.setDate(weekStart.getDate() + 7);
    renderWeekStrip();
  });

  // ─── Initialize ───
  updateFilterUI();
  renderWeekStrip();
  renderCalendar();
  filterShows();
});
</script>
