


<section id="about" class="about">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
        <div class="about-img">
          <!-- Check if aboutUs is available and show a default image if not -->
         
        </div>
      </div>

      <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
        <!-- Check if aboutUs is available before accessing its properties -->
        <h3>{{ $aboutUs->title ?? 'About Us' }}</h3> <!-- Fallback to 'About Us' if title is not available -->
        
        <p class="fst-italic">
          {{ $aboutUs && isset($aboutUs->content['paragraphs'][0]['text']) ? $aboutUs->content['paragraphs'][0]['text'] : 'Content not available' }}
        </p>

        <ul>
          @if($aboutUs && isset($aboutUs->content['paragraphs'][0]['points']))
            @foreach ($aboutUs->content['paragraphs'][0]['points'] as $point)
              <li><i class="bi bi-check-circle"></i> {{ $point }}</li>
            @endforeach
          @else
            <li>No points available</li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</section>
