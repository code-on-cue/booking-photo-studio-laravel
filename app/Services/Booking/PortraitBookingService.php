<?php

namespace App\Services\Booking;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;

class PortraitBookingService implements BookingServiceInterface
{
  public function validate(Request $request, Type $type): void
  {
    Validator::make($request->all(), [
      'numberOfPerson' => 'required|integer|min:1',
      'name' => 'required',
      'phone' => 'required',
      'date' => 'required|date',
      'time' => 'required'
    ])->validate();
  }

  public function calculatePrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;
    $max = $details['maximumPerson'];
    $extra = max(0, $request->numberOfPerson - $max);
    return $details['price'] + ($extra * $details['additionalPrice']);
  }

  public function getBasedPrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;
    return $details['price'];
  }

  public function getMaximumPerson(Request $request, Type $type): int
  {
    $details = $type->moreDetails;
    return $details['maximumPerson'];
  }
}
