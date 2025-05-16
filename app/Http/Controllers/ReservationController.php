<?php
namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use App\Models\Reservation;
use App\Models\User;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

  

    // public function index()
    // {
    //     $user = auth()->user();
   
    //     $reservations = Reservation::query()
    //         ->when($user->roles === 'Admin', function ($query) {
    //             return $query;
    //         })
    //         ->when($user->roles !== 'Admin', function ($query) use ($user) {
    //             return $query->where('user_id', $user->id);
    //         })
    //         ->with(['user']) // Include user relationship to display who created the reservation
    //         ->get();
    //         dd($reservations);
    //     return view('reservations.index', compact('reservations'));
    // }


    public function index()
    {
        $user = auth()->user();

        $reservations = Reservation::query()
            ->when($user->roles->contains('name', 'Admin'), function ($query) {
                return $query;
            })
            ->when(!$user->roles->contains('name', 'Admin'), function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->with(['user']) 
            ->get();
            
        return view('reservations.index', compact('reservations'));
    }


    

    // Show the form for creating a new reservation
    public function create()
    {
        return view('reservations.create');
    }

    // Store a newly created reservation

    public function store(ReservationRequest $request, ReservationService $reservationService)
    {
        // if (!auth()->check()) {
        //     // Save the intended URL to return to after login
        //     return redirect()->route('login', ['redirect_to' => route('reservations.create')]);
        // }

        if (!auth()->check()) {
            // Redirect to the login page if not authenticated
            return redirect()->route('login'); // You can add any parameters here if needed
        }
    
        $reservation = $reservationService->createReservation($request);
        // dd($reservation);

        return redirect()->back()->with('success', 'Reservation created successfully! Your reference number is ' . $reservation->reservation_reference);
    }

    // Show the form for editing a reservation
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // Update an existing reservation
    public function update(StoreReservationRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $this->reservationService->updateReservation($validated, $id);
            return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
