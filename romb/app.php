<?php

function build(Int $linesCount) : Array
{
    if(($linesCount+2) % 2 == 1)
        return drawRomb($linesCount);
    else
        return drawTower($linesCount);
}

function drawRomb(Int $linesCount) : Array
{
    $linesCount--;
    $line = [];
    for ($i = 0; $i < ($linesCount)/2; $i++) {
        $line[] = printSpaces($linesCount/2 - $i)
            .printStars(2*$i+1)
            .printSpaces($linesCount/2 - $i);
    }
    for ($i = ($linesCount)/2; $i >= 0; $i--) {
        $line[] = printSpaces($linesCount/2 - $i)
            .printStars(2*$i+1)
            .printSpaces($linesCount/2 - $i);
    }
    return $line;
}

function drawTower(Int $linesCount) : Array
{
    $line = [];
    for ($i = 0; $i < $linesCount; $i++) {
        $line[] = printSpaces($linesCount - $i -1)
            .printStars(2*$i+1)
            .printSpaces($linesCount - $i -1);
    }
    return $line;
}

function printSpaces(Int $charsCount) : String
{
    $string = '';
    for ($i = 0; $i < $charsCount; $i++) {
        $string .= " ";
    }
    return $string;
}

function printStars(Int $charsCount) : String
{
    $string = '';
    for ($i = 0; $i < $charsCount; $i++) {
        $string .= "*";
    }
    return $string;
}

var_dump(build(2));