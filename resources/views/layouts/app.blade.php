<html>

<head>
    <meta name="viewport" conent="width=device-width, initial-scale=1.0">
    <title>AHMS</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap5.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
    * {
        margin: 0;
        padding: 0;
        font-family: khcontent;
    }



    body {
        background: #d2d9e3;
        /* background: rgb(60,140,188); */
        /* background: linear-gradient(90deg, rgba(60,140,188,1) 0%, rgba(255,255,255,1) 92%); */
        /* background: linear-gradient(90deg, rgba(60,140,188,1) 0%, rgba(255,255,255,1) 50%, rgba(252,176,69,1) 100%); */
        /* background: linear-gradient(90deg, rgba(60,140,188,1) 0%, rgba(255,255,255,1) 50%, rgba(0,162,186,1) 100%); */
        /* background-image: url("{{asset('img/app-bg.png')}}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover; */
    }

    .welcome {
        font-family: khmoul;
        font-weight: normal;
        font-size: 40px;
        margin-top: 50px;
        /* letter-spacing: 4px;
        padding: 200px 0 100px; */
        color: #007cc4;
        text-align: center;

    }

    .app-container {
        justify-content: center;
        display: flex;
    }

    .app-container a {
        /* float: left; */
        /* flex-direction: row; */
        display: flex;
        background: #fff;
        height: 150px;
        width: 150px;
        margin: 0 15px;
        margin-bottom: 35px;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 6px 6px 10px -1px rgba(0, 124, 196, 0.15),
            -6px -6px 10px -1px rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 124, 196, 0.1);
        transition: transform 0.5s
    }

    .glass {
        /* backdrop-filter: blur(1px); */
        /* background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
        min-width: 180px;
        position: relative;
        transition: transform 250ms; */
        margin: auto;
        padding: 20px;
        width: 1200px;
    }

    .app-container a img {
        /* font-size: 20px; */
        transition: transform 0.5s;
    }

    .app-container a:hover {
        box-shadow: inset 4px 4px 6px -2px rgba(0, 0, 0, 0.2),
            inset -4px -4px 6px -1px rgba(255, 255, 255, 0.7),
            -0.5px -0.5px 0px -1px rgba(255, 255, 255, 1),
            0.5px 0.5px 0px rgba(0, 0, 0, 0.15),
            0px 12px 10px -10px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 124, 196, 0.1);
        transform: translateY(2px);
    }

    .app-container a:hover img {
        transform: scale(0.90);
    }

    .clock {
        font-size: 30px;
        font-family: arial;
        letter-spacing: 7px;
        position: relative;
        margin: auto;

    }
    .clock-glass {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
        min-width: 180px;
        position: relative;
        transition: transform 250ms;
        margin: auto;
        padding: 20px;
        width: 500px;
        text-align: center;
        top: -7%;
    }
    .dropdown-toggle::after {
        content: none;
    }
    ..bg-body-tertiary{
        background-color: red !important;
    }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background: #d2d9e3 !important;">
        <div class="container-fluid" style="background: #d2d9e3;">
            <a class="navbar-brand tpg_text_color" href="{{route('home')}}">
                <img src="{{asset('img/logo.png')}}" alt="Logo" width="35" height="24"
                    class="d-inline-block align-text-top rounded-circle" style="margin-top: 5px;">
                <strong class="text-bold text-primary" >AHMS</strong>
            </a>

            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav float-right">
                    <li class="nav-item">
                        <a class="nav-link me-3" aria-current="page" href="{{route('setting.dashboard')}}"><i class="fa fa-cogs"></i></a>
                    </li>
                </ul>
                <div class="dropdown dropstart">
                    <div type="button" class="dropdown" data-bs-toggle="dropdown">
                        <img src="{{asset('img/logo.png')}}" alt="Logo" width="30" height="24"
                            class="d-inline-block align-text-top">
                            <?php
                                $profileUserNave = DB::table('employees')->find(auth()->user()->employee_id);
                            ?>
                        <span>{{$profileUserNave->kh}}</span>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('myprofile')}}">ព័ត៌មានខ្ញុំ</a></li>
                        <li><a class="dropdown-item" href="{{route('change_password')}}">ប្ដូរលេខសម្ងាត់</a></li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" class="dropdown-item" method="post">
                                @csrf
                                <i class="fas fa-sign-out-alt mr-2 text-danger"></i>
                                <button class="btn btn-sm" type="submit">ចាកចេញ</button>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- toastr  -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    <script>
        function showNotifyMessage(type, sms){
            myMsg.notify(type, sms);
        }
        // for action with rediretion
        @if(session()->has('success'))
            showNotifyMessage('Success', "{{session()->get('success')}}");
        @endif
        @if(session()->has('error'))
            showNotifyMessage('error', "{{session()->get('error')}}");
        @endif

        // Defining showTime funcion
function showTime() {
    // Getting current time and date
    let time = new Date();
    let hour = time.getHours();
    let min = time.getMinutes();
    let sec = time.getSeconds();
    am_pm = "AM";

    // Setting time for 12 Hrs format
    if (hour >= 12) {
        if (hour > 12) hour -= 12;
        am_pm = "PM";
    } else if (hour == 0) {
        hr = 12;
        am_pm = "AM";
    }

    hour =
        hour < 10 ? "0" + hour : hour;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;

    let currentTime =
        hour +
        ":" +
        min +
        ":" +
        sec +
        am_pm;

    // Displaying the time
    document.getElementById(
        "clock"
    ).innerHTML = currentTime;
}
setInterval(() => {
showTime();

});
    </script>
</body>

</html>
