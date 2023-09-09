<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'FitBite') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/home-style.css?v=').time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    @yield('pageStyle')

  
</head>

<body>
    </head>

    <body>
        <div class="container1">

            @include('layouts.partials.profile.header_profile')
            @include('layouts.partials.profile.nav')

            @yield('content')

            @yield('pageScript')
    </body>
</body>

</html>
