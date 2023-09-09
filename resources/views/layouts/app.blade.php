<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'FitBite') }} | @yield('title')</title>
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/dashboard-style.css') }}">
    @if(\App::getLocale('ar'))
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
           font-family: 'Cairo', sans-serif;
     </style>
    @endif    
    @yield('pageStyle')
</head>


<body>

    <div class="container">
        @yield('content')
    </div>
    @yield('pageScript')
</body>

</html>
