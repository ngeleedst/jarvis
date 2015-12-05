<?php

if (!function_exists('array_merge_recursive_distinct')) {
    function array_merge_recursive_distinct(array &$array1, array &$array2)
    {
        $merged = $array1;
        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset ($merged [$key]) && is_array($merged [$key])) {
                $merged [$key] = array_merge_recursive_distinct($merged [$key], $value);
            } else {
                $merged [$key] = $value;
            }
        }

        return $merged;
    }
}


//if (!function_exists('dump')) {
//    function dump($var, $type = 'symfony', $pre = true, $die = true)
//    {
//        switch ($type) {
//            case 'symfony':
//                \Symfony\Component\VarDumper\VarDumper::dump($var);
//                break;
//            case 'doctrine':
//                if ($pre) {
//                    echo '<pre>';
//                }
//                \Doctrine\Common\Util\Debug::dump($var);
//                if ($pre) {
//                    echo '</pre>';
//                }
//                break;
//            default:
//                throw new \Exception(sprintf('invalid var_dumper format %s', $type));
//        }
//
//        if ($die) {
//            die;
//        }
//    }
//}