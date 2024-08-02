<?php

$input = file_get_contents('php://stdin');
$lines = explode("\n", trim($input));

$results = [];
$index = 0;

while ($index < count($lines)) {
    $grid = '';
    for ($i = 0; $i < 3; $i++) {
        $grid .= str_replace(' ', '', $lines[$index++]);
    }

    while ($index < count($lines) && trim($lines[$index]) === '') {
        $index++;
    }

    $xCount = substr_count($grid, 'X');
    $oCount = substr_count($grid, 'O');

    if ($oCount > $xCount || $xCount > $oCount + 1) {
        $results[] = 'no';
        continue;
    }

    $wins = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

    $grid_arr = str_split($grid);

    $xWins = false;
    $oWins = false;

    foreach ($wins as $win) {
        if ($grid_arr[$win[0]] === 'X' && $grid_arr[$win[1]] === 'X' && $grid_arr[$win[2]] === 'X') {
            $xWins = true;
        }
        if ($grid_arr[$win[0]] === 'O' && $grid_arr[$win[1]] === 'O' && $grid_arr[$win[2]] === 'O') {
            $oWins = true;
        }
    }

    if ($xWins && $oWins) {
        $results[] = 'no';
    } elseif ($xWins && $xCount !== $oCount + 1) {
        $results[] = 'no';
    } elseif ($oWins && $xCount !== $oCount) {
        $results[] = 'no';
    } else {
        $results[] = 'yes';
    }
}
echo implode("\n", $results) . "\n";



