<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multimedia Art</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css"integrity="sha512-XcPoWhhzQ3zSKsuBQyysOwTcBiiyh2dVj0tLRL3nvUFIhC7H/98x8GFDpAvqIittlJhPFUCJ5DGTcd3U53IQdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">

</head>

<body>
    <header>
        <div class="header" style="background: #FFF; position:sticky top: 0; z-index: 50;">
            <div class="logo">LOGO</div>
            <input type="text" placeholder="Search..." />
            <button id="openEventModalBtn"
                style="background: red; color: white; padding: 10px 15px; border: none; border-radius: 5px;">Create New
                Event</button>
        </div>
        <div class="nav-bar" style="position: sticky; top: 0; z-index: 10;">
            <div><i class="fas fa-tachometer-alt"></i> <a href="{{ route('home') }}"> HOME</a></div>
            <div><i class="fas fa-calendar-alt"></i> <a href="{{ route('index') }}"> EVENTS</a></div>
            <div><i class="fas fa-users"></i><a href="{{ route('member.resource') }}"> RESOURCE HUB</a></div>
            <div><i class="fas fa-comments"></i> <a href="{{ route('member.community') }}"> FORUM</a></div>
            <div><i class="fas fa-calendar"></i><a href="{{ route('admin.calendar') }}"> CALENDAR</a></div>
            <div><i class="fas fa-cog"></i> <a href="{{ route('member.portfolio') }}"> SETTING</a></div>
            <div><i class="fas fa-cog"></i> <a href="{{ route('membership') }}"> MEMBERSHIP</a></div>
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
        {{-- <div class="ribbon" style="background: #FFF">
            <h1>RESOURCE HUB</h1>
            <div class="tabs" style="gap: 0;">
                <input type="radio" id="tab-active" name="eventTab" checked hidden>
                <label for="tab-active" class="tab-radio-btn">Active</label>
                <input type="radio" id="tab-draft" name="eventTab" hidden>
                <label for="tab-draft" class="tab-radio-btn">Draft</label>
            </div>
        </div> --}}
    </header>


    <main>
        @yield('content')
    </main>

    @yield('scripts')



</body>
{{-- <script>
    function openEventModal() {
        document.getElementById('eventModalOverlay').style.display = 'block';
    }

    function closeEventModal() {
        document.getElementById('eventModalOverlay').style.display = 'none';
    }
    document.getElementById('openEventModalBtn').addEventListener('click', openEventModal);
</script> --}}



</html>
