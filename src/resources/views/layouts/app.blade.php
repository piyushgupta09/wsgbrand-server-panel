@extends('panel::layouts.master')

@section('top')

    <meta name="author" content="pg.softcode@gmail.com">
    <meta name="description" content="Its an internal managment system for Metro Fashion">
    <meta name="keywords" content="metro fashion, fpaipl, deshigirl, fashion passion">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <meta name="theme-color" content="#ea3941" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-startup-image" href="{{ asset('logo.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
    @livewireStyles()

@endsection

@section('body')

    <div id="app">

        @yield('main')

    </div>

@endsection

@section('bottom')

    @yield('scripts')
    @livewireScripts()

@endsection