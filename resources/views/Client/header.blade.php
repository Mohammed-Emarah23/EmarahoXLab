 <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{ route('userProduct') }}"><h2>Emarah 0X <em>Lab</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                @auth
                  @if (Auth::user()->role === 'admin')
                    <a class="nav-link" href="{{ route('AdminWeb') }}">Home</a>
                  @else
                    <a class="nav-link" href="{{ route('userProduct') }}">Home</a>
                  @endif
                @endauth
              </li>
              @auth
                @if (Auth::user()->role === 'admin')
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('all-products') }}">All Products</a>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('userProduct') }}">All Products</a>
                  </li>
                @endif
              @endauth
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/user/profile') }}">Profile Setting</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="{{route('cartpage')}}">Add Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('Vsearch') }}">Critical Vuln here bro 😄 </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

   