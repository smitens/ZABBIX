<?php

function checkWinner($gridArr, $wins, $player):bool
{
    foreach ($wins as $win) {
        if ($gridArr[$win[0]] === $player && $gridArr[$win[1]] === $player && $gridArr[$win[2]] === $player) {
            return true;
        }
    }
    return false;
}

$input = file_get_contents('php://stdin');
$lines = explode("\n", trim($input));

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

$N = intval(array_shift($lines));

$results = [];
$index = 0;

while ($index < count($lines) && $N > 0) {

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
        $N--;
        continue;
    }

    $gridArr = str_split($grid);

    $xWins = checkWinner($gridArr, $wins, 'X');
    $oWins = checkWinner($gridArr, $wins, 'O');

    if ($xWins && $oWins) {
        $results[] = 'no';
    } elseif ($xWins && $xCount !== $oCount + 1) {
        $results[] = 'no';
    } elseif ($oWins && $xCount !== $oCount) {
        $results[] = 'no';
    } else {
        $results[] = 'yes';
    }

    $N--;
}
echo implode("\n", $results) . "\n";