<?php

namespace App\Services\Booking;


class BookingServiceFactory
{
  /**
   * Create a booking service instance based on the type slug.
   *
   * @param string $slug
   * @return BookingServiceInterface
   */
  public static function resolveService(string $slug): BookingServiceInterface
  {
    return match ($slug) {
      'portrait' => app(\App\Services\Booking\PortraitBookingService::class),
      'wedding' => app(\App\Services\Booking\WeddingBookingService::class),
      'keluarga' => app(\App\Services\Booking\KeluargaBookingService::class),
      default => throw new \Exception("Tipe booking tidak dikenal.")
    };
  }
}
