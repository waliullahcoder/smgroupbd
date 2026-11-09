@extends('layouts.frontend.app')
@section('content')

        <div class="page" data-page="home">
             @include('frontend.hero')

            <div class="wrap stats-wrap">
                <div class="stats">
                    <div class="stat rv" style="--i:0"><b data-count>6+</b><span>Years of experience</span></div>
                    <div class="stat rv" style="--i:1"><b data-count>200+</b><span>Projects delivered</span></div>
                    <div class="stat rv" style="--i:2"><b data-count>250 MVA</b><span>Capacity supplied</span></div>
                    <div class="stat rv" style="--i:3"><b data-count>30+</b><span>Engineers and technicians</span>
                    </div>
                </div>
            </div>

            @include('frontend.overview')

            @include('frontend.our_products')

            @include('frontend.our_business')
            @include('frontend.milestone')
           

            
           @include('frontend.service_solution')
            <section class="cta">
                <div class="wrap cta-in">
                    <div class="rv">
                        <h2 class="cond">Start your journey toward reliable power.</h2>
                        <p>Tell us about your site and load. Our engineers will respond with a practical proposal.</p>
                    </div>
                    <div class="btns rv" style="--i:2"><a class="btn btn-white" href="#/contact"><span>Contact us
                                now</span></a><a class="btn btn-line" href="#/contact">Call +88{{$setting->primary_mobile}}</a></div>
                </div>
            </section>

            @include('frontend.news_media')
        </div>
        
        @include('frontend.partials.about')
        @include('frontend.partials.products')
        @include('frontend.partials.services')
        @include('frontend.partials.projects')
        @include('frontend.partials.news')
        @include('frontend.partials.contact')
    

@endsection
