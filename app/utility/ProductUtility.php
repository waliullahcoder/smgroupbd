<?php

namespace App\Utility;

class ProductUtility
{
    public static function get_attribute_options($collection)
    {
        $options = array();

        if (isset($collection['choice_no']) && $collection['choice_no']) {
            foreach ($collection['choice_no'] as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (request()[$name] as $key => $eachValue) {
                    array_push($data, $eachValue);
                }
                array_push($options, $data);
            }
        }

        return $options;
    }

    public static function get_combination_string($combination)
    {
        $str = '';
        foreach ($combination as $key => $item) {
            if ($key > 0) {
                $str .= '-' . str_replace(' ', '', $item);
            } else {
                $str .= str_replace(' ', '', $item);
            }
        }
        return $str;
    }
}
