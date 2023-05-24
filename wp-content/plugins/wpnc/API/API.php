<?php

namespace WPNC\CreateNFT\API;

require_once "Settings.php";
require_once "Misc.php";
require_once "Translations.php";

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handles logic for registering all APIs
 */
class API
{
    public function __construct()
    {
        new Settings();
        new Misc();
        new Translations();
    }
}
