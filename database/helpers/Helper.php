<?php

namespace Database;

class Helper
{

    public  function convertToDate($strVal)
    {
        $exp = explode('/', $strVal);
        return date('Y-m-d', strtotime($exp[2] . '/' . $exp[0] . '/' . $exp[1]));
    }
}
