<?php

namespace App\Services\Booking;

use Illuminate\Http\Request;
use App\Models\Type;

interface BookingServiceInterface
{
  public function validate(Request $request, Type $type): void;
  public function calculatePrice(Request $request, Type $type): int;
  public function getBasedPrice(Request $request, Type $type): int;

  public function getMaximumPerson(Request $request, Type $type): int;
}
