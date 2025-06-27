<!DOCTYPE html>
<html lang="en">
  @include('Client.head')
  <body>
    @if(isset($error))
        <div class="alert alert-danger text-center mt-3">
          <strong>Error:</strong> {{ $error }}
        </div>
    @endif

    <!-- ***** Preloader ***** -->
    <div id="preloader">
      <div class="jumper"><div></div><div></div><div></div></div>
    </div>

    @include('Client.header')
    @include('Client.banner')

    <div class="container mt-4">
      <form method="GET" action="{{ url('/search')}}">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search products..." name="keyword" value="{{ request('keyword') }}">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
    @if(isset($error))
    <div style="background-color: #ff4d4d; color: white; padding: 15px; margin: 20px auto; text-align: center; border-radius: 6px; width: 90%; max-width: 600px;">
        <strong>Error:</strong> {{ $error }}
    </div>
@endif



      @if(isset($keyword) && $keyword)
          <div class="alert alert-info text-center">
              Results for: <strong>{!! $keyword !!}</strong>. 
              {{-- The main cause of XSS vulnerability IS : {!! $keyword !!} 
               displays user input directly on the page without proper filtering or escaping
              --}}
          </div>
      @endif

    </div>

    <!-- Products Section -->
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="#">View all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>

          @foreach ($products as $product)
            <div class="col-md-4 mb-4 d-flex">
              <div class="product-item w-100">
                <a href="{{ route('show-userProduct', $product->id) }}">
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                </a>
                <div class="down-content">
                  <a href="#"><h4>{{ $product->name }}</h4></a>
                  <h6>${{ $product->price }}</h6>
                  <p>{{ $product->desc }}</p>
                  <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                  </ul>
                  <form action="{{ url('addTocart', $product->id) }}" class="mt-3" method="POST">
                    @csrf
                      <div class="input-group">
                          <input type="number" name="qty" min="1" value="1" class="form-control" style="max-width: 80px;">
                          <button type="submit" class="btn btn-success">Add To Cart</button>
                      </div>
                  </form>
              </div>
              </div>
            </div>
          @endforeach
          
        </div>
      </div>
    </div>

    @include('Client.footer')
  </body>
</html>
