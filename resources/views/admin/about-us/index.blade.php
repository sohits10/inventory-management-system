@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/>

<style>
  .about-table {
    border-radius: 20px;
    color: white;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    margin-top: 20px;
  }

  .about-table th {
    text-align: center;
    background-color: #343a40;
    color: #ffffff;
    font-weight: bold;
    padding: 1rem;
  }

  .about-table td {
    color: #f1f1f1;
    background-color: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    text-align: center;
    font-size: 0.95rem;
  }

  .about-table td img {
    border-radius: 10px;
    max-height: 80px;
  }

  .about-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>

<section id="about" class="about">
  <div class="container" data-aos="fade-up">

  <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>About Us</h1>
        <a href="{{ route('about-us.create') }}" class="btn btn-primary">Add New Record</a>
    </div>


    @if (count($aboutUsEntries) > 0)
      <table class="table table-striped about-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Contents</th>
            <th>Key Points</th>
            <th>Image</th>
            <th colspan="3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($aboutUsEntries as $index => $aboutUs)
            <tr>
              <!-- Serial Number -->
              <td>{{ $index + 1 }}</td>

              <!-- Image Column -->
              

              <!-- Title Column -->
              <td>{{ $aboutUs->title ?? 'No Title' }}</td>

              <!-- Contents Column -->
              <td>
                {{ data_get($aboutUs->content, 'paragraphs.0.text', 'No content available.') }}
              </td>

              <!-- Key Points Column -->
              <td>
                @if (is_array(data_get($aboutUs->content, 'paragraphs.0.points')))
                  <ul>
                    @foreach (data_get($aboutUs->content, 'paragraphs.0.points', []) as $point)
                      <li>{{ $point }}</li>
                    @endforeach
                  </ul>
                @else
                  <p>No key points available</p>
                @endif
              </td>
              <td>
              <td>
                @if ($aboutUs->image)
                  <img src="{{ asset($aboutUs->image) }}" alt="About Image">
                @else
                  <p>No image available</p>
                @endif
              </td>
              </td>
              <td>
              <a href="{{ route('about-us.edit', $aboutUs->uuid) }}" class="btn btn-warning btn-sm ms-1"><i class="bx bx-edit"></i> Edit</a>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p>No About Us entries found.</p>
    @endif

  </div>
</section>

@endsection
