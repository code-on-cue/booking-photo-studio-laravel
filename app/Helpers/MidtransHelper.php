<?php

namespace App\Helpers;


class MidtransHelper
{
  protected static  $snapBaseUrl = "https://app.sandbox.midtrans.com/snap/";
  protected static $apiBaseUrl = "https://api.sandbox.midtrans.com/v2/";


  public static function getSnapToken(string $trxId, int $amount): array
  {
    $serverKey = config('midtrans.serverKey');

    $params = [
      'transaction_details' => [
        'order_id' => $trxId,
        'gross_amount' => $amount,
      ],
    ];

    $headers = [
      'Authorization: Basic ' . base64_encode($serverKey . ':'),
      'Content-Type: application/json',
    ];

    $options = [
      'http' => [
        'method'  => 'POST',
        'header'  => $headers,
        'content' => json_encode($params),
        'ignore_errors' => true,
      ],
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
      ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents(self::$snapBaseUrl . 'v1/transactions', false, $context);
    $response = json_decode($result, true);
    return $response;
  }

  public static function checkPayment(string $trxId): bool
  {
    $url = self::$apiBaseUrl . $trxId . '/status';

    $serverKey = config('midtrans.serverKey');

    $headers = [
      'Authorization: Basic ' . base64_encode($serverKey . ':'),
    ];

    $options = [
      'http' => [
        'method'  => 'GET',
        'header'  => $headers,
        'ignore_errors' => true,
        'timeout' => 5,
      ],
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
      ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if (isset($response['status_code']) && $response['status_code'] == "404") return false;
    if ($response['transaction_status'] == 'settlement') return true;
    return false;
  }
}
