<?php
declare(strict_types=1);
 
function addition(int $a, int $b): int {
    return $a + $b;
}
 
echo addition('5', 3); // TypeError: Argument 1 must be of type int, string given
