<section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Reservation</h2>
          <p>Book a table</p>
        </div>
        <form action="{{ route('reservations.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
            @csrf 
            <div class="row">
                
            <input type="hidden" name="status" value="pending"> 
                <input type="hidden" name="reservation_reference" id="reservation_reference">
             

                <div class="col-lg-4 col-md-6 form-group mt-3">

                
                    <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}" required style="border-radius: 15px;">
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4 col-md-6 form-group mt-3">
                    <input type="time" class="form-control" name="time" id="time" value="{{ old('time') }}" required style="border-radius: 15px;">
                    @error('time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4 col-md-6 form-group mt-3">
                    <input type="number" class="form-control" name="guest_count" id="guest_count" placeholder="# of guest" value="{{ old('people') }}" required style="border-radius: 15px;">
                    @error('people')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" name="special_requests" rows="5" placeholder="special_requests" style="border-radius: 15px;">{{ old('message') }}</textarea> 
            </div>
            <div class="text-center mt-3"><button type="submit">Book a table</button></div>
        </form>

    </div>
</section>

