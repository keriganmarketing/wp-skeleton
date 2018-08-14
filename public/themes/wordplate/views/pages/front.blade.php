@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        <kma-slider class="slider-container"></kma-slider>
        <main role="main">
            <div class="container">

                <div class="row no-gutters">
                    <div class="col-lg-7">
                        <article class="front">
                            <header>
                                <h1>{{ the_title() }}</h1>
                            </header>
                            
                            {{ the_content() }}

                        </article>
                    </div>
                </div>

            </div>
        </main>

        <div class="feature-box-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-white box-container">
                        <div class="feature-box feat-one">
                            <h3 class="text-uppercase">{{ $featureBox1['title'] }}</h3>
                            <p>{{ $featureBox1['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white" href="{{ $featureBox1['link']['url'] }}" >Learn More &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 text-white box-container">
                        <div class="feature-box feat-two">
                            <h3 class="text-uppercase">{{ $featureBox2['title'] }}</h3>
                            <p>{{ $featureBox2['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white" href="{{ $featureBox2['link']['url'] }}" >Learn More &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endwhile
@else
    @include('pages.404')
@endif
@endsection