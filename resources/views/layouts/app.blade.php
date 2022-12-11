<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- App Stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Exo 2">
    <link rel="stylesheet" type="text/css" href="http://coderoj.com/style/lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ckeditor.css') }}">

    <style>
        button.logout-btn{
            background-color: transparent;
            color: inherit;
             padding: 0px;
        }
    </style>

    {{ $styles ?? '' }}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div id="sidebar-area">
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <div>EduHome</div>
                </div>
                <a title="profile" class="inbox-avatar" style="border-radius: 0%"
                    href="http://classrooom.test/student/profile">
                    <div class="sidebar-user-info">
                        <img style="
                                    border-radius: 100%;
                                    border: 1px solid #eeeeee;
                                " width="74" hieght="70"
                            src="{{ asset('upload/avatars/default_avatar.png') }}" />
                        <div style="font-size: 17px; font-weight: bold">
                            {{ auth()->user()->name ?? auth()->user()->login_id }}
                        </div>
                        <div style="font-size: 14px">{{ auth()->user()->user_type }}</div>
                    </div>
                </a>
                <div class="sidebar-menu">
                    <ul class="nav" style="flex-direction: column">
                        <a href="{{ route('dashboard') }}" page-title="Dashboard" title="dashboard">
                            <li id="sidebar_dashboard" class="@if(request()->routeIs('dashboard')) active @endif">
                                <div class="li-area">
                                    <span class="fas fa-home"></span>
                                    <span class="li-title">Dashboard</span>
                                </div>
                            </li>
                        </a>
                        <a href="{{ route('courses.index') }}" page-title="Courses" title="courses">
                            <li id="sidebar_courses" class="@if(request()->routeIs('courses.index')) active @endif">
                                <div class="li-area">
                                    <span class="fas fa-chalkboard-teacher"></span>
                                    <span class="li-title">Courses</span>
                                </div>
                            </li>
                        </a>
                        <a href="{{ route('routine.list') }}" page-title="Routine" title="routine">
                            <li id="sidebar_routine" class="@if(request()->routeIs('routine.list')) active @endif">
                                <div class="li-area">
                                    <span class="fas fa-calendar-alt"></span>
                                    <span class="li-title">Routine</span>
                                </div>
                            </li>
                        </a>
                        {{-- <a href="http://classrooom.test/student/profile" page-title="Profile" title="profile">
                            <li id="sidebar_profile" class="">
                                <div class="li-area">
                                    <span class="fas fa-user"></span>
                                    <span class="li-title">Profile</span>
                                </div>
                            </li>
                        </a> --}}
                        <form action="{{ route('logout') }}" page-title="Logout" title="logout" method="POST">
                            @csrf
                            <li id="sidebar_logout" class="">
                                <button type="submit" class="li-area logout-btn">
                                    <span class="fas fa-sign-out-alt"></span>
                                    <span class="li-title">Logout</span>
                                </button>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- page content --}}
        <div class="container-fluid container-left-margin" style="padding: 0px" id="app">
            {{ $slot }}
        </div>

    </div>

    <!-- App Scriopt -->
    <script type="text/javascript" src="{{ asset('lib/jquery/jquery3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/preload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/course/course.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Congrats!',
                @json(session('success')),
                'success'
            )
        </script>
    @endif
    @if (session()->has('quiz_status'))
        <script>
            let quiz_status = @json(session('quiz_status'));
            if(quiz_status){
                window.localStorage.removeItem('answer')
            }
        </script>
    @endif
    @error('error')
        <script>
            Swal.fire(
                'Oops!',
                @json($message),
                'error'
            )
        </script>
    @enderror
    {{ $footer ?? '' }}
</body>

</html>