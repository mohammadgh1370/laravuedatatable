<?php

if (!function_exists('vue_props')) {

    function vue_props($props)
    {
        $string = '';
        foreach ($props as $key => $val) {
            if (is_array($val)) {
                $string .= " :$key='".json_encode($val)."'";
            } else if (is_numeric($val)) {
                $string .= " :$key='".$val."'";
            } else if (is_bool($val)) {
                $string .= " :$key=".($val ? 'true' : 'false');
            }else {
                $string .= " $key='$val'";
            }
        }
        return $string;
    }
}

if (!function_exists('flash_success')) {
    function flash_success($message = 'با موفقیت انجام شد', $delay = 5000, $sticky = false)
    {
        $flash = ['code' => 1, 'message' => $message, 'delay' => $delay, 'sticky' => $sticky];
        \Illuminate\Support\Facades\Session::flash('flash',$flash);
    }
}

if (!function_exists('flash_error')) {
    function flash_error($message = 'خطایی رخ داد', $delay = 5000, $sticky = false)
    {
        $flash = ['code' => -1, 'message' => $message, 'delay' => $delay, 'sticky' => $sticky];
        \Illuminate\Support\Facades\Session::flash('flash',$flash);
    }
}