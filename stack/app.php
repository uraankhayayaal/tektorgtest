<?php

function check(String $input) : bool
{
    $brackets = "(){}[]";
    $stack = [];

    $chrArray = preg_split('//u', $input, -1, PREG_SPLIT_NO_EMPTY);
    foreach($chrArray as $char){
        if(($index = strpos($brackets, $char)) !== false){
            if(($index + 2) % 2 == 1){ // закрывающие скобки
                if(empty($stack))
                    return false;

                $lastElement = array_pop($stack);

                if($lastElement != $index-1)
                    return false;
            }
            else{
                $stack[] = $index;
            }
        }
    }

    if(!empty($stack))
        return false;

    return true;
}

echo check("{([()]){}({})}") ? "Правильно" : "Ошибка";
echo "\n";