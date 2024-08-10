<?php

namespace App\Helpers;

use App\Models\Config;

class ConfigHelper
{
  public static function get($parameter)
  {
    $config = Config::where('id', 1)->first();
    return $config->$parameter;
  }
}
