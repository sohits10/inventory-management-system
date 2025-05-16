<?php

namespace App\Services;

use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;


class ReservationService
{
    // Check for reservation conflicts based on the datetime
    public function isReservationConflict($reservationDatetime)
    {
        return Reservation::where('reservation_datetime', $reservationDatetime)->exists();
    }

    // Create a new reservation
    public function createReservation(ReservationRequest $request)
    {
        $datetime = \Carbon\Carbon::parse($request->date . ' ' . $request->time);

     
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'reservation_datetime' => $datetime,
            'guest_count' => $request->guest_count,
            'special_requests' => $request->special_requests,
            'reservation_reference' => $this->generateUniqueReferenceNumber(),
        ]);

        // dd($reservation);
        return $reservation;
    }


    private function generateUniqueReferenceNumber()
    {
        $prefix = date('Ymd') . '-'; // Year, month, day prefix

        do {
            $uniquePart = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 8)); // Random alphanumeric string
            $reservationReference = $prefix . $uniquePart;
        } while (Reservation::where('reservation_reference', $reservationReference)->exists());

        return $reservationReference;
    }

    // Update an existing reservation
    public function updateReservation($data, $id)
    {
        $reservation = Reservation::findOrFail($id);
        return $reservation->update($data);
    }
}
