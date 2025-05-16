<section id="specials" class="specials">
      <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Specials</h2>
            <p>Check Our Specials</p>
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column" id="special-tabs">
                  @foreach($specials as $special)
                      <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active show' : '' }}" 
                            id="tab-{{ $special->uuid }}-tab" 
                            data-bs-toggle="tab" 
                            href="#tab-{{ $special->uuid }}" 
                            role="tab" 
                            aria-controls="tab-{{ $special->uuid }}" 
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $special->name }}
                        </a>
                      </li>
                  @endforeach
                </ul>
            </div>

            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content" id="specials-content">
                  @foreach($specials as $special)
                      <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" 
                          id="tab-{{ $special->uuid }}" 
                          role="tabpanel" 
                          aria-labelledby="tab-{{ $special->uuid }}-tab">
                        <div class="row">
                            <div class="col-lg-8 details order-2 order-lg-1">
                              <h3>{{ $special->name }}</h3>
                              <p class="fst-italic">{{ $special->description }}</p>
                              <p>Price: ${{ $special->price }}</p>
                              <p>Available from {{ \Carbon\Carbon::parse($special->start_date)->format('d M Y') }} 
                                  to {{ \Carbon\Carbon::parse($special->end_date)->format('d M Y') }}</p>
                            </div>
                            <div class="col-lg-4 text-center order-1 order-lg-2">
                              <img src="{{ $special->image ? asset('storage/' . $special->image) : asset('assets/img/default-special.png') }}" 
                                    alt="{{ $special->name }}" 
                                    class="img-fluid">
                            </div>
                        </div>
                      </div>
                  @endforeach
                </div>
            </div>
          </div>
      </div>
    </section>