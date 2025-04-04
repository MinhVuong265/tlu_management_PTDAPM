<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Trang chủ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
      li{
        border-radius: 10px;
      }
      #sidebar li:hover{
        background-color: rgb(49, 159, 203); 

      }

      html, body {
          height: 100%;
          margin: 0;
          font-family: "Roboto", sans-serif;
          font-weight: 400;
          font-style: normal;
          font-stretch: normal;
          font-optical-sizing: auto;
      }

      .wrapper {
          display: flex;
          min-height: 100vh;
          align-items: stretch;
      }

      #sidebar {
          min-height: 100vh; /* Giúp sidebar mở rộng theo nội dung */
      }

      .content-container {
          flex-grow: 1; /* Phần nội dung mở rộng toàn bộ phần còn lại */
          padding: 20px; /* Khoảng cách nội dung */
      }

      
    </style>
</head>
<body>

    <header class="p-3 border-bottom" style="background-color: #D9D9D9; width:100%">
        <div class="container-fluid">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">
            <a href="{{ route('home') }}" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
              <img class="bi me-2" width="55" height="42" role="img" aria-label="Bootstrap" src="{{ asset('images/tlu/tlu_logo.png') }}" alt="logo đhtl">
            </a>

            {{-- <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
              <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
              <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
              <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
            </ul> --}}

            {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form> --}}

            <div class="dropdown text-end">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
                <strong>{{ Auth::user()->name }}</strong>
              </a>
              <ul class="dropdown-menu text-small">
                {{-- <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                {{-- <li><hr class="dropdown-divider"></li> --}}
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">Đăng xuất</button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>

<div class="wrapper" >
    {{-- sidebar --}}
    <div class="d-flex flex-column flex-shrink-0 p-3 text-dark" style="width: 280px; background-color: #457B9D" id="sidebar">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
          <span class="fs-4">Menu</span>
      </a>
      <hr>
        @if(Auth::check())
          @if(Auth::user()->role === 'quantri')
              @include('layouts.sidebar.admin')
          @elseif(Auth::user()->role === 'giangvien')
              @include('layouts.sidebar.lecturer')
          @elseif(Auth::user()->role === 'sinhvien')
              @include('layouts.sidebar.student')
          @endif
        @endif
    </div>  
      <div class="container">
        @yield('content')
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các phần tử alert
        const alerts = document.querySelectorAll('.alert');
        if (alerts) {
            // Sau 5 giây, ẩn từng alert với hiệu ứng fadeOut
            setTimeout(() => {
                alerts.forEach(alert => {
                    // Sử dụng CSS transition để tạo hiệu ứng fade-out
                    alert.style.transition = "opacity 0.5s ease-out";
                    alert.style.opacity = "0";
                    setTimeout(() => {
                        alert.style.display = "none";
                    }, 500); // sau 0.5s hiệu ứng fade-out
                });
            }, 5000); // 5000 ms = 5 giây
        }
    });
</script>
</html>
