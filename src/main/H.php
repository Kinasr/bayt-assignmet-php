<?php

class H
{

    static function timestamp(): String
    {
        $now = DateTime::createFromFormat('U.u', microtime(true));
        // return gmdate('Ymdhisu', microtime(true));
        return $now->format("Ymdhisu");
    }
}
