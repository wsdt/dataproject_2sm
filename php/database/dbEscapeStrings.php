<?php

/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 07.06.2017
 * Time: 16:14
 */
class dbEscapeStrings
{
    public static $stringtoescape;

    public function getString() {
        return $stringtoescape;
    }
}

$obj = new dbEscapeStrings();
mysqli::real_escape_string($obj->getString();

// TODO: Strings escapen for SQL Injections

