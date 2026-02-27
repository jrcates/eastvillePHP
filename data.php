<?php
// ─────────────────────────────────────────────
//  EastVille Comedy Club – Shared Data
//  Shows generated: Feb 16 – Apr 30, 2026
// ─────────────────────────────────────────────

// Series definitions keyed by day of week (0=Sun … 6=Sat)
$seriesDefs = [
  1 => [[ // Monday
    'title'    => 'MONDAY PRIME-TIME COMEDY IN BROOKLYN!',
    'time'     => '19:00:00',
    'display'  => '07:00 PM',
    'series'   => 'Monday Prime-Time Comedy in Brooklyn!',
    'location' => 'Main Stage',
    'type'     => 'standup',
    'prices'   => [15, 15, 20, 15, 20, 15],
    'images'   => [
      'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
      'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
    ],
    'descriptions' => [
      'Start your week right with our Monday Night showcase! Featuring a rotating lineup of the city\'s best up-and-coming comedians and seasoned pros working on new material.',
      'Monday nights just got funnier. Join us for a killer lineup of Brooklyn\'s finest comedians kicking off the week with non-stop laughs.',
      'The best cure for the Monday blues is live comedy. Grab a drink and let our all-star lineup turn your week around.',
    ],
    'lineups' => [
      ['Host: Sarah Johnson', 'Mike Smith', 'Jenny Jones', 'Special Guest'],
      ['Host: Stavros Halkias', 'Dan Soder', 'Guest Comedians'],
      ['Host: Joe List', 'Mark Normand', 'Sam Morril'],
    ],
  ]],
  2 => [[ // Tuesday
    'title'    => 'COMEDY SPOTLIGHT',
    'time'     => '19:00:00',
    'display'  => '07:00 PM',
    'series'   => 'Comedy Spotlight',
    'location' => 'Lounge',
    'type'     => 'standup',
    'prices'   => [10, 10, 12, 10, 15, 10],
    'images'   => [
      'https://images.unsplash.com/photo-1641903806973-17eaf2d2634f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
      'https://images.unsplash.com/photo-1514525253440-b393452e8d26?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Catch the rising stars of the New York comedy scene before they make it big.',
      'Our Tuesday spotlight shines on the best new voices in comedy. Intimate setting, big laughs.',
      'Every Tuesday we put the spotlight on fresh talent and fan favorites. You never know who might drop in.',
    ],
    'lineups' => [
      ['Host: Dave Miller', 'Various Artists'],
      ['Host: Jessica Kirson', 'Rotating Lineup'],
      ['Host: Matteo Lane', 'Special Guests'],
    ],
  ]],
  3 => [[ // Wednesday
    'title'    => 'COMEDY LOVES YA',
    'time'     => '19:00:00',
    'display'  => '07:00 PM',
    'series'   => 'Comedy Loves Ya',
    'location' => 'Main Stage',
    'type'     => 'standup',
    'prices'   => [20, 25, 20, 25, 20, 25],
    'images'   => [
      'https://images.unsplash.com/photo-1730791480843-12ef754c5123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
      'https://images.unsplash.com/photo-1514525253440-b393452e8d26?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Mid-week comedy therapy — because Comedy Loves Ya! A stacked lineup of comedians who\'ll make you forget it\'s only Wednesday.',
      'Hump day never felt so good. Our Wednesday showcase brings the love with wall-to-wall laughs.',
      'Comedy Loves Ya and we love you back! Join us for our signature Wednesday night show featuring top-tier talent.',
    ],
    'lineups' => [
      ['Host: Whitney Cummings', 'Taylor Tomlinson', 'Iliza Shlesinger'],
      ['Host: Ali Wong', 'Chris Rock', 'Guest Comedians'],
      ['Host: Rosebud Baker', 'Shane Gillis', 'Special Guest'],
    ],
  ]],
  5 => [ // Friday — two shows
    [
      'title'    => 'WEEKEND WARMUP COMEDY IN BROOKLYN!',
      'time'     => '19:00:00',
      'display'  => '07:00 PM',
      'series'   => 'Weekend Warmup comedy in Brooklyn!',
      'location' => 'Main Stage',
      'type'     => 'standup',
      'prices'   => [25, 30, 25, 30, 25, 30],
      'images'   => [
        'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Kick off the weekend with our raw and unfiltered Friday night showcase. No holds barred comedy.',
        'The weekend starts here! Get warmed up with Brooklyn\'s hottest comedy lineup before hitting the town.',
        'Friday night, live comedy, great drinks — what more do you need? Our Weekend Warmup sets the tone for the entire weekend.',
      ],
      'lineups' => [
        ['Host: Big Jay Oakerson', 'Dan Soder', 'Rosebud Baker'],
        ['Host: Mark Normand', 'Sam Morril', 'Guest Comedians'],
        ['Host: Shane Gillis', 'Tim Dillon', 'Special Guest'],
      ],
    ],
    [
      'title'    => 'TGIF COMEDY IN BROOKLYN!',
      'time'     => '19:30:00',
      'display'  => '07:30 PM',
      'series'   => 'TGIF Comedy in Brooklyn!',
      'location' => 'Main Stage',
      'type'     => 'standup',
      'prices'   => [20, 25, 20, 25, 20, 25],
      'images'   => [
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
        'https://images.unsplash.com/photo-1649772308558-db37c0dfae7e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
        'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
      ],
      'descriptions' => [
        'Thank God It\'s Friday! Celebrate the end of the work week with a night of pure comedy gold.',
        'TGIF hits different with live stand-up. Bring your crew and let the weekend begin with laughter.',
        'The Friday night late show — edgier, louder, and funnier. Not for the faint of heart!',
      ],
      'lineups' => [
        ['Host: Ari Shaffir', 'Shane Gillis', 'Tim Dillon'],
        ['Host: Dan Soder', 'Jessica Kirson', 'Rotating Guests'],
        ['Host: Big Jay Oakerson', 'Stavros Halkias', 'Guest Comedians'],
      ],
    ],
  ],
  6 => [[ // Saturday
    'title'    => 'SATURDAY STANDUP LIVE!',
    'time'     => '20:00:00',
    'display'  => '08:00 PM',
    'series'   => 'Saturday Standup Live!',
    'location' => 'Main Stage',
    'type'     => 'standup',
    'prices'   => [30, 35, 35, 40, 30, 35],
    'images'   => [
      'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Our premier Saturday night show. The perfect night out featuring top-tier talent.',
      'Saturday night is THE night for comedy in Brooklyn. An all-star lineup you don\'t want to miss.',
      'The biggest night of the week deserves the biggest laughs. Dress up, show up, and laugh it up!',
    ],
    'lineups' => [
      ['Host: Ronny Chieng', 'Hasan Minhaj', 'Michelle Wolf'],
      ['Host: Colin Quinn', 'Joe List', 'Mark Normand'],
      ['Surprise Headliner', 'Regular Favorites'],
    ],
  ]],
  0 => [[ // Sunday
    'title'    => 'GUY\'Z NITE COMEDY',
    'time'     => '20:00:00',
    'display'  => '08:00 PM',
    'series'   => 'Guy\'z Nite Comedy',
    'location' => 'Lounge',
    'type'     => 'standup',
    'prices'   => [20, 20, 20, 20, 20, 20],
    'images'   => [
      'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&q=80&w=1080',
      'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?auto=format&fit=crop&q=80&w=1080',
    ],
    'descriptions' => [
      'Round up the boys for a Sunday night of non-stop laughs. Cold drinks, hot takes, and the best comedians in the city.',
      'Sunday nights are for the guys. Kick back with your crew and enjoy an evening of raw, unfiltered comedy.',
      'End the weekend on a high note with Guy\'z Nite — the funniest Sunday show in Brooklyn.',
    ],
    'lineups' => [
      ['Host: Matteo Lane', 'Judy Gold'],
      ['Host: Joe List', 'Mark Normand'],
      ['Host: Stavros Halkias', 'Guest Comedians'],
    ],
  ]],
];

// Status rotation: most are available, some selling fast, rare sold out
$statusPool = ['Tickets Available','Tickets Available','Tickets Available','Selling Fast','Tickets Available','Tickets Available','Selling Fast','Tickets Available','Tickets Available','Sold Out'];

// Generate shows: Feb 16 → Apr 30, 2026
$shows = [];
$current = new DateTime('2026-02-16');
$end     = new DateTime('2026-04-30');
$num     = 1;

while ($current <= $end) {
  $dow = (int) $current->format('w'); // 0=Sun … 6=Sat
  if (isset($seriesDefs[$dow])) {
    foreach ($seriesDefs[$dow] as $tpl) {
      $idx   = ($num - 1); // running index for rotation
      $cnt   = count($tpl['images']);
      $price = $tpl['prices'][$idx % count($tpl['prices'])];
      $shows[] = [
        'id'          => 'show-' . $num,
        'title'       => $tpl['title'],
        'date'        => $current->format('Y-m-d') . 'T' . $tpl['time'],
        'time'        => $tpl['display'],
        'location'    => $tpl['location'],
        'price'       => '$' . $price,
        'priceValue'  => $price,
        'image'       => $tpl['images'][$idx % $cnt],
        'description' => $tpl['descriptions'][$idx % count($tpl['descriptions'])],
        'lineup'      => $tpl['lineups'][$idx % count($tpl['lineups'])],
        'type'        => $tpl['type'],
        'status'      => $statusPool[$idx % count($statusPool)],
        'featured'    => ($idx % 3 === 0),
        'series'      => $tpl['series'],
      ];
      $num++;
    }
  }
  $current->modify('+1 day');
}

// ─────────────────────────────────────────────
//  Helper: format date parts from ISO string
// ─────────────────────────────────────────────
function formatShowDate(string $isoDate): array {
  $ts = strtotime($isoDate);
  return [
    'weekday' => date('D', $ts),
    'day'     => date('j', $ts),
    'month'   => date('M', $ts),
    'year'    => date('Y', $ts),
    'time'    => date('g:i A', $ts),
  ];
}
