<?php

namespace App\util;

class Helper
{
    public function stringToFloat($str)
    {
        $straux = substr($str, 0, -2);

        return floatval(str_replace(',', '.', $str));
    }
}
