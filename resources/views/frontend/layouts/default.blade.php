@extends('frontend.layouts.app')

@section('body')
    <div class="container">
        @include('frontend.partials.notifications')

        @yield('content')
    </div>
@endsection
