<?php
class Request
{
    public static function ValidateKeys ($request, $keys) {
        foreach ($keys as $key) {
            if(isset($request[$key]) && !empty($request[$key])) {
                continue;
            } else {
                return false;
            }
        }
        return true;
    }
}
?>