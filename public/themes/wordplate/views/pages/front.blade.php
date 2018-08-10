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
                            <header class="fittext">
                                <fit-text :max="3.05">Your Beach Dream</fit-text>
                            </header>
                            
                            {{ the_content() }}

                            <a href="/about-us/" class="btn btn-lg btn-outline-primary mt-3" >Meet Our Team &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                        </article>
                    </div>
                    <div class="col">
                    </div>
                </div>

            </div>
        </main>
        @include('partials.map')
        <div class="projects-section">
            <div class="projects-header header-image home" style="background-image: url('{{ $projectsHeader['url'] }}')">
                <h2 class="text-center text-uppercase text-white text-outlined">Projects</h2>
            </div>
            <div class="container">
                <portfolio-gallery :limit="6" :locations="{{ $locations }}" type="" location="" ></portfolio-gallery>
                <div class="section-button text-center">
                    <a class="btn btn-lg btn-outline-primary" href="/project-portfolio/">Project Portfolio &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="testimonial-section text-center">

            @foreach($featuredTestimonial as $testimonial)
                <div class="container">
                    <div class="testimonials text-center">
                        <div class="testimonial single">
                            <p class="shorttext">{!! $testimonial->truncate !!}</p>
                            <p class="author">{{ $testimonial->byline }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="section-button text-center">
                <a class="btn btn-lg btn-outline-white" href="/testimonials/">More Testimonials &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
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