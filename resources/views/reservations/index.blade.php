@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/>


<style>
  .table-dark {
    border-radius: 20px;
    color: white;
    overflow: hidden; 
  }
</style>

<section id="reservations" class="reservations">
  <div class="container" data-aos="fade-up">

  <div class="section-title">
      <h2>Reservation</h2>
    </div>

   
    @if (Auth::check())
    <table class="table table-striped table-dark">
    <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Time</th>
            <th>People</th>
            <th>Message</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $index = 0?>
          @foreach ($reservations as $reservation)
            <tr>
            <td>{{ $index + 1 }}</td>

                    <td>{{ $reservation->user_id }}</td>
              <td>{{ $reservation->reservation_datetime }}</td>
              <td>{{ $reservation->guest_count }}</td>
              <td>{{ $reservation->special_requests }}</td>
              <td>{{ $reservation->status }}</td>
              <td>
                <a href="#" class="btn btn-primary btn-sm">Approve</a>
                <a href="#" class="btn btn-danger btn-sm">Cancel</a>

                @if (Auth::user()->can('cancel reservations'))
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @if (count($reservations) === 0)
        <p>You don't have any past reservations.</p>
      @endif

    @else
      <p>Please log in to view your reservation history.</p>
    @endif

  </div>
</section>
@endsection