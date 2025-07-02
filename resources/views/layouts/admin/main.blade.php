<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multimedia Art</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>



    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    

</head>

<body>

    <header>
        <div class="header">
            <div class="logo">LOGO</div>
            <input type="text" placeholder="Search..." />
            <button onclick="openEventModal()"
                style="background: red; color: white; padding: 10px 15px; border: none; border-radius: 5px;">Create New
                Event</button>
        </div>


        <div class="nav-bar">
            <div><i class="fas fa-tachometer-alt"></i> <a href="{{ route('admin.dashboard') }}"> DASHBOARD</a> </div>
            <div><i class="fas fa-calendar-alt"></i> <a href="{{ route('index') }}"> EVENTS</a></div>
            {{-- <div><i class="fas fa-users"></i> <a href="{{ route('admin.user') }}"> PEOPLES</a></div> --}}
            {{-- <div><i class="fas fa-users"></i> <a href="{{ route('payments') }}"> USERS</a></div> --}}

            {{-- <div><i class="fas fa-comments"></i><a href="{{ route('payments') }}"> MESSAGES</a> </div> --}}
            <div><i class="fas fa-calendar"></i><a href="{{ route('admin.calendar') }}"> CALENDAR</a> </div>
            <div><i class="fas fa-cog"></i> SETTING</div>
            <div><i class="fas fa-sign-out-alt"></i>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>



                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>

    </header>




    <main>
        @yield('content')
    </main>

    @yield('scripts')


    {{-- <script>
        function openEventModal() {
          document.getElementById('eventModalOverlay').classList.add('active');
        }
      
        function closeEventModal() {
          document.getElementById('eventModalOverlay').classList.remove('active');
        }
      </script> --}}
      
</body>


</html>
