<?php

namespace App\Services\Booking;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;

class WeddingBookingService implements BookingServiceInterface
{
  public function validate(Request $request, Type $type): void
  {
    $options = collect($type->moreDetails['packageOptions'])->pluck('name')->implode(',');
    $locations = implode(',', array_keys($type->moreDetails['locationSurcharge']));

    Validator::make($request->all(), [
      'package' => 'required|in:' . $options,
      'location' => 'required|in:' . $locations,
      'name' => 'required',
      'phone' => 'required',
      'date' => 'required|date',
    ])->validate();
  }

  public function calculatePrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;

    $package = collect($details['packageOptions'])->firstWhere('name', $request->package);
    $surcharge = $details['locationSurcharge'][$request->location] ?? 0;

    return ($package['price'] ?? 0) + $surcharge;
  }

  public function getBasedPrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;
    
    $package = collect($details['packageOptions'])->firstWhere('name', $request->package);
    return $package['price'] ?? 0;
  }

  public function getMaximumPerson(Request $request, Type $type): int
  {
    $details = $type->moreDetails;

    $package = collect($details['packageOptions'])->firstWhere('name', $request->package);

    return $package['maximumPerson'] ?? 0;
  }
}
