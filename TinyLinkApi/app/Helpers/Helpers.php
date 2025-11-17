<?php

if (!function_exists('get_domain')) {
    function get_domain() {
        return request()->getHost();
    }
}
