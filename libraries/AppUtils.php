<?php

// library for re-usable utility functions
// All methods should be static, accessed like: AppUtils::method(...);
class AppUtils {

    /*-------------------------------------------------------------------------------------------------
    
    -------------------------------------------------------------------------------------------------*/
    public static function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
} #eoc    