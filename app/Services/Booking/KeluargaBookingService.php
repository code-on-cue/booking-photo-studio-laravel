<?php

namespace App\Services\Booking;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;

class KeluargaBookingService implements BookingServiceInterface
{
  public function validate(Request $request, Type $type): void
  {
    $locations = collect($type->moreDetails['locationOptions'])->pluck('type')->implode(',');

    Validator::make($request->all(), [
      'numberOfPerson' => 'required|integer|min:1',
      'location_type' => 'required|in:' . $locations,
      'name' => 'required',
      'phone' => 'required',
      'date' => 'required|date',
      'time' => 'required'
    ])->validate();
  }

  public function calculatePrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;

    $location = collect($details['locationOptions'])->firstWhere('type', $request->location_type);
    $tier = collect($details['personTier'])->firstWhere(fn($t) => $request->numberOfPerson <= $t['max']);

    return ($location['price'] ?? 0) + ($tier['price'] ?? 0);
  }

  public function getBasedPrice(Request $request, Type $type): int
  {
    $details = $type->moreDetails;

    $location = collect($details['locationOptions'])->firstWhere('type', $request->location_type);
    $tier = collect($details['personTier'])->firstWhere(fn($t) => $request->numberOfPerson <= $t['max']);
    return ($location['price'] ?? 0) + ($tier['basePrice'] ?? 0);
  }

  public function getMaximumPerson(Request $request, Type $type): int
  {
    $details = $type->moreDetails;

    $tier = collect($details['personTier'])->firstWhere(fn($t) => $request->numberOfPerson <= $t['max']);

    return $tier['max'] ?? 0;
  }
}
