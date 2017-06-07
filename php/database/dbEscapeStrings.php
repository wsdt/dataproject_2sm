<?php

/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 07.06.2017
 * Time: 16:14
 */
class dbEscapeStrings
{
    function escapeStrings($string) {
        return mysqli::real_escape_string($string);
    }
}