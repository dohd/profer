<?php

if (!function_exists('inputClean')) {
    function inputClean($input=[])
    {
        $dates = ['date', 'start_date', 'end_date'];
        $totals = ['amount', 'total', 'grandtotal', 'subtotal', 'tax', 'rate', 'taxable', 'budget'];
        foreach ($input as $key => $value) {
            if (!is_array($value)) {
                if (in_array($key, $dates)) $input[$key] = databaseDate($value);
                if (in_array($key, $totals)) $input[$key] = numberClean($value);
                $input[$key] = trim($value);
            }
        }
        return $input;
    }
}

if (!function_exists('fillArray')) {
    function fillArray($main=[], $params=[])
    {
        foreach ($params as $key => $value) {
            $main[$key] = $value;
        }
        return $main;
    }
}

if (!function_exists('fillArrayRecurse')) {
    function fillArrayRecurse($main=[], $params=[])
    {
        foreach ($main as $i => $row) {
            foreach ($params as $key => $value) {
                $main[$i][$key] = $value;
            }
        }
        return $main;
    }
}

if (!function_exists('explodeArray')) {
    function explodeArray($separator='', $input=[])
    {
        $input_mod = [];
        foreach ($input as $key => $value) {
            $input_mod[] = explode($separator, $value);
        }
        return $input_mod;
    }
}

if (!function_exists('numberClean')) {
    function numberClean($value='')
    {
        return floatval(str_replace(',', '', $value)); 
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($number=0)
    {
        return number_format($number, 2);
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date='', $format='d-m-Y')
    {
        if (!$date) return date('d-m-Y');
        return date($format, strtotime($date));
    }
}

if (!function_exists('databaseDate')) {
    function databaseDate($date='')
    {
        if (!$date) return date('Y-m-d');
        return date('Y-m-d', strtotime($date));
    }
}

if (!function_exists('databaseArray')) {
    function databaseArray($input=[])
    {
        $input_mod = [];
        foreach ($input as $key => $value) {
            foreach ($value as $j => $v) {
                $input_mod[$j][$key] = $v;
            }
        }
        return $input_mod;
    }
}

if (!function_exists('browserLog')) {
    function browserLog(...$messages)
    {
        foreach ($messages as $value) {
            echo '<script>console.log(' . json_encode($value) . ')</script>';
        }
    }
}

if (!function_exists('errorLog')) {
    function errorLog(...$messages)
    {
        foreach ($messages as $value) {
            error_log(print_r($value, 1));
        }
    }
}

if (!function_exists('GeneralException')) {
    function GeneralException($message='Internal server error!')
    {
        if (is_array($message)) return \Illuminate\Validation\ValidationException::withMessages($message);
        return \Illuminate\Validation\ValidationException::withMessages([$message]);
    }
}
