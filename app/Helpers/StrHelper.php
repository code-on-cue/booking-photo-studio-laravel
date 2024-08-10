<?php

namespace App\Helpers;

class StrHelper
{
  /**
   * Given a number formatted as currency
   */
  public static function currency($numberOfPrice, $prefix = null, $suffix = null)
  {
    $reversedNumber = str_split(strrev(strval($numberOfPrice)));

    $price = "";

    foreach ($reversedNumber as $index => $number) {
      if ($index % 3 == 0 && $index !== 0) $price .= ".";
      $price .= $number;
    }

    $price = strrev($price);

    if ($prefix) $price = "{$prefix} {$price}";
    if ($suffix) $price = "{$price} {$suffix}";

    return $price;
  }
}
