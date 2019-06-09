@extends('frontend.layouts.app')

@section('body')
    <App inline-template>
        <div class="container">
            @include('frontend.partials.notifications')

            @yield('content')
        </div>
    </App>

@endsection
