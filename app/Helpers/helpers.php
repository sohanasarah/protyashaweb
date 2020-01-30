<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helpers
{
    static function bob($string)
    {
        return '<strong> ' . $string . '?! Is that you?!</strong>';
    }

    static function get_item_details($item_code)
    {
        $query =  DB::table('items');
        $query->select(DB::raw('item_name, item_desc1, item_desc2 '))
            ->where('item_code', '=', $item_code);
        $result =  $query->first();
        return $result;
    }

    static function get_customer_details($cust_code)
    {
        $query =  DB::table('customers');
        $query->select(DB::raw('cust_name, cust_outlet '))
            ->where('cust_id', '=', $cust_code);
        $result =  $query->first();
        return $result;
    }

    static function get_brand_details($code)
    {
        $query =  DB::table('code_mstr');
        $query->select(DB::raw('code_value, code_cmmt, code_chr01 '))
            ->where('code_value', '=', $code);
        $result =  $query->first();
        return $result;
    }
}