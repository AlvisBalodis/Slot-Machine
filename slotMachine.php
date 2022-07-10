<?php

$wallet = 100;

$board = [
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "]
];

function checkFreeSpaces(array $board): int
{
    $freeSpaces = 10;

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 5; $j++) {
            if ($board[$i][$j] != " ") {
                $freeSpaces--;
            }
        }
    }
    return $freeSpaces;
}

function displayBoard(array $board)
{
    echo implode("  ", $board[0]) . PHP_EOL;
    echo implode("  ", $board[1]) . PHP_EOL;
    echo implode("  ", $board[2]) . PHP_EOL;
}

$symbols = ["🍎", "🍏", "🍐", "🍊", "🍋", "🍌", "🍉"];
$multipliers = [0.5, 1.5, 2, 3, 4, 5, 50];
$winningSymbol = " ";

function winLine($board, $winningSymbol)
{
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] === $board[$i][1]
            && $board[$i][0] === $board[$i][2]
            && $board[$i][0] === $board[$i][3]
            && $board[$i][0] === $board[$i][4]) {
            return $board[$i][0];
        }
        if ($board[$i][0] === $board[$i][1]
            && $board[$i][1] === $board[$i][2]
            && $board[$i][2] === $board[$i][3]) {
            return $board[$i][0];
        }
        if ($board[$i][1] === $board[$i][2]
            && $board[$i][2] === $board[$i][3]
            && $board[$i][3] === $board[$i][4]) {
            return $board[$i][1];
        }
        if ($board[$i][0] === $board[$i][1]
            && $board[$i][1] === $board[$i][2]) {
            return $board[$i][0];
        }
        if ($board[$i][1] === $board[$i][2]
            && $board[$i][2] === $board[$i][3]) {
            return $board[$i][1];
        }
        if ($board[$i][2] === $board[$i][3]
            && $board[$i][3] === $board[$i][4]) {
            return $board[$i][2];
        }
        if ($board[0][0] === $board[1][1]
            && $board[1][1] === $board[2][2]
            && $board[2][2] === $board[1][3]
            && $board[1][3] === $board[0][4]) {
            return $board[0][0];
        }
        if ($board[0][0] === $board[1][1]
            && $board[1][1] === $board[2][2]
            && $board[2][2] === $board[1][3]) {
            return $board[0][0];
        }
        if ($board[1][1] === $board[2][2]
            && $board[2][2] === $board[1][3]
            && $board[1][3] === $board[0][4]) {
            return $board[1][1];
        }
        if ($board[0][0] === $board[1][1]
            && $board[1][1] === $board[2][2]) {
            return $board[0][0];
        }
        if ($board[1][1] === $board[2][2]
            && $board[2][2] === $board[1][3]) {
            return $board[1][1];
        }
        if ($board[2][2] === $board[1][3]
            && $board[1][3] === $board[0][4]) {
            return $board[2][2];
        }
        if ($board[2][0] === $board[1][1]
            && $board[1][1] === $board[0][2]
            && $board[0][2] === $board[1][3]
            && $board[1][3] === $board[2][4]) {
            return $board[2][0];
        }
        if ($board[2][0] === $board[1][1]
            && $board[1][1] === $board[0][2]
            && $board[0][2] === $board[1][3]) {
            return $board[2][0];
        }
        if ($board[1][1] === $board[0][2]
            && $board[0][2] === $board[1][3]
            && $board[1][3] === $board[2][4]) {
            return $board[1][1];
        }
        if ($board[2][0] === $board[1][1]
            && $board[1][1] === $board[0][2]) {
            return $board[2][0];
        }
        if ($board[1][1] === $board[0][2]
            && $board[0][2] === $board[1][3]) {
            return $board[1][1];
        }
        if ($board[0][2] === $board[1][3]
            && $board[1][3] === $board[2][4]) {
            return $board[0][2];
        }
    }
    return $winningSymbol;
}

echo "Welcome to slots game!" . PHP_EOL;
echo PHP_EOL;
echo "Your balance is $wallet" . PHP_EOL;
$bet = (int)readline("Choose your bet size: ");
$choice = readline("Spin? (Y/N): ");

while (true) {
    while (checkFreeSpaces($board) > 0) {
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $randomChar = $symbols[array_rand($symbols)];
                $board[$i][$j] = $randomChar;
            }
        }
        echo PHP_EOL;
        displayBoard($board);

        if (winLine($board, $winningSymbol) != " ") {
            $keyForWinSymbol = array_search(winLine($board, $winningSymbol), $symbols);
            $multiplier = $multipliers[$keyForWinSymbol];
            $winningSum = $bet * $multiplier;
            echo "Multiplier you got is $multiplier" . PHP_EOL;
            echo "You won $winningSum" . PHP_EOL;
            $wallet += $winningSum;
        } else {
            echo "You lost!" . PHP_EOL;
            $wallet -= $bet;
            if ($wallet <= 0 || $wallet < $bet) {
                echo "You don't have money!" . PHP_EOL;
                exit();
            }
        }
        echo "Your balance is $wallet" . PHP_EOL;

//        $choice = readline("Spin? (Y/N): ");

        if ($choice === "Y") {
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 5; $j++) {
                    $board[$i][$j] = " ";
                }
            }
        } else {
            exit();
        }
    }
}