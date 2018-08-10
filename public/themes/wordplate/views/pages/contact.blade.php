@extends('layouts.main')
@section('content')

@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
        <main role="main" class="contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221519.67086835808!2d-85.43854927989516!3d29.82835328196134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8894964418c727c9%3A0x11a94e7a6daceeb6!2s346+Commerce+Blvd%2C+Port+St+Joe%2C+FL+32456!5e0!3m2!1sen!2sus!4v1532113986979" width="100%" height="100%" frameborder="0" style="border:0" ></iframe>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif

@endsection