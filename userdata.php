<?php

// пользователи для аутентификации
$users = [
    [
        'email' => 'ignat.v@gmail.com',
        'name' => 'Игнат',
        'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
    ],
    [
        'email' => 'kitty_93@li.ru',
        'name' => 'Леночка',
        'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
    ],
    [
        'email' => 'warrior07@mail.ru',
        'name' => 'Руслан',
        'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
    ]
];

$cats = [
    [
      'pic' => 'boards',
      'cat' => 'Доски и лыжи'
    ],
    [
      'pic' => 'attachment',
      'cat' => 'Крепления'
    ],
    [
      'pic' => 'boots',
      'cat' => 'Ботинки'
    ],
    [
      'pic' => 'clothing',
      'cat' => 'Одежда'
    ],
    [
      'pic' => 'tools',
      'cat'=>'Инструменты'
    ],
    [
      'pic' => 'other',
      'cat' => 'Разное'
    ],
];

$lots = [
    [
      'lot-name' => '2014 Rossignol District Snowboard',
      'category' => 0, 
      'lot-rate' => 10999, 
      'url' => 'img/lot-1.jpg',
      'message' => null
    ], 
    [
     'lot-name' => 'DC Ply Mens 2016/2017 Snowboard',
     'category' => 0, 
     'lot-rate' => 159999, 
     'url' => 'img/lot-2.jpg',
     'message' => 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                        снег
                        мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                        снаряд
                        отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                        кэмбер
                        позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                        просто
                        посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.'
   ], 
   [
     'lot-name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
     'category' => 1, 
     'lot-rate' => 8000, 
     'url' => 'img/lot-3.jpg',
     'message' => null
   ], 
   [
     'lot-name' => 'Ботинки для сноуборда DC Mutiny Charocal',
     'category' => 2, 
     'lot-rate' => 10999, 
     'url' => 'img/lot-4.jpg',
     'message' => null
   ], 
   [
     'lot-name' => 'Куртка для сноуборда DC Mutiny Charocal',
     'category' => 3, 
     'lot-rate' => 7500, 
     'url' => 'img/lot-5.jpg',
     'message' => null
   ], 
   [
     'lot-name' => 'Маска Oakley Canopy',
     'category' => 5, 
     'lot-rate' => 5400, 
     'url' => 'img/lot-6.jpg',
     'message' => null
   ]
];

$bets = [
    ['name' => 'Иван', 'lot-rate' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'lot-rate' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'lot-rate' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'lot-rate' => 10000, 'ts' => strtotime('last week')]
];

?>