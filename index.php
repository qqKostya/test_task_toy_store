<?php

declare(strict_types=1);

// Примерный список продуктов с тегами
$productList = [
    ['name' => 'апельсины', 'tags' => ['скидка', 'овощи фрукты']],
    ['name' => 'бананы', 'tags' => ['овощи фрукты']],
    ['name' => 'картошка', 'tags' => ['кэшбек 10%', 'овощи фрукты', 'эко']],
    ['name' => 'кефир', 'tags' => ['молоко']],
    ['name' => 'кофе', 'tags' => ['скидка', 'кэшбек 10%', 'бакалея', 'эко']],
    ['name' => 'лук', 'tags' => ['овощи фрукты']],
    ['name' => 'масло', 'tags' => ['скидка', 'молоко']],
    ['name' => 'молоко', 'tags' => ['молоко', 'для детей']],
    ['name' => 'мука', 'tags' => ['бакалея']],
    ['name' => 'огурцы', 'tags' => ['скидка', 'кэшбек 10%', 'овощи фрукты', 'эко']],
    ['name' => 'перцы', 'tags' => ['овощи фрукты']],
    ['name' => 'помидоры', 'tags' => ['кэшбек 10%', 'овощи фрукты', 'эко']],
    ['name' => 'рис', 'tags' => ['бакалея']],
    ['name' => 'сахар', 'tags' => ['скидка', 'бакалея']],
    ['name' => 'сыр', 'tags' => ['кэшбек 10%', 'молоко', 'эко']],
    ['name' => 'творог', 'tags' => ['молоко']],
    ['name' => 'чай', 'tags' => ['бакалея']],
    ['name' => 'яблоки', 'tags' => ['овощи фрукты']]
];


// Массив приоритетов тегов
$tagsPriority = [
    'скидка' => 1,
    'кэшбек 10%' => 2,
    'молоко' => 3,
    'бакалея' => 4,
    'овощи фрукты' => 5,
    'эко' => 6,
    'для детей' => 7
];

usort($productList, function(array $a, array $b) use ($tagsPriority): int {
    $aPriority = min(array_map(fn($tag) => $tagsPriority[$tag], $a['tags']));
    $bPriority = min(array_map(fn($tag) => $tagsPriority[$tag], $b['tags']));

    return $aPriority <=> $bPriority;
});


$itemsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$totalItems = count($productList);
$totalPages = ceil($totalItems / $itemsPerPage);

$startIndex = ($page - 1) * $itemsPerPage;
$endIndex = min($startIndex + $itemsPerPage, $totalItems);

// Вывод данных на страницу
for ($i = $startIndex; $i < $endIndex; $i++) {
    $product = $productList[$i];
    echo "Название: " . $product['name'] . " - Теги: " . implode(', ', $product['tags']) . "<br>";
}

echo "<br>Страницы: ";
for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
    if ($pageNumber == $page) {
        echo "$pageNumber ";
    } else {
        echo "<a href='?page=$pageNumber'>$pageNumber</a> ";
    }
}

if ($page > 1) {
    $prevPage = $page - 1;
    echo "<a href='?page=$prevPage'>Предыдущая</a> ";
}

if ($page < $totalPages) {
    $nextPage = $page + 1;
    echo "<a href='?page=$nextPage'>Следующая</a>";
}