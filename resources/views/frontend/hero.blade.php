 <section class="hero"><svg class="hero-tri" viewBox="0 0 700 600" aria-hidden="true">
         <polygon points="40,600 250,170 460,600" fill="rgba(82,164,66,0.16)" />
         <polygon points="250,600 470,60 690,600" fill="rgba(122,49,144,0.30)" />
         <polygon points="420,600 590,240 760,600" fill="rgba(30,91,163,0.34)" />
     </svg>
     <div class="wrap hero-in">
         <div>
             <div class="eyebrow on-dark g-in" style="--d:.05"><span>SM Group Bangladesh · Power and engineering</span>
             </div>
             <h1 class="cond"><span class="ln"><span style="--i:0">Reliable power,</span></span><span class="ln"><span
                         style="--i:1">engineered for Bangladesh.</span></span></h1>
             <p class="lead g-in" style="--d:.55">We supply, install and service electrical power equipment, from
                 transformers and switchgear to generators and solar, for industry, utilities and commercial projects.
             </p>
             <div class="hero-btns g-in" style="--d:.7"><a class="btn btn-leaf" href="#/products"><span>Explore
                         products</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                         <path d="M5 12h14M13 6l6 6-6 6"></path>
                     </svg></a><a class="btn btn-line" href="#/contact"><span>Talk to an expert</span></a></div>
         </div>
         <div class="hero-media g-in" style="--d:.35" role="region" aria-roledescription="carousel"
             aria-label="Featured products">
             <div class="slides">
                @foreach($sliders as $key => $slider)
                 <div class="slide is-on" role="group" aria-roledescription="slide" aria-label="1 of 3">
                    <!-- <span class="ph-bg" style="--img:var(--img-hero-sparkling)"></span> -->
                <span class="ph-bg" style="--img: url('{{ asset($slider->image) }}');">
                     </span>
                     <div class="feat">
                         <div>
                             <div class="k">Sister concern</div>
                             <div class="t"> {{ $slider->title }}</div>
                             <div class="d"> {{ $slider->heading }}</div>
                         </div><a class="feat-go" href="#/about" aria-label="About Sparkling Engineering Solution"><svg
                                 width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                 <path d="M5 12h14M13 6l6 6-6 6"></path>
                             </svg></a>
                     </div>
                 </div>
                  @endforeach
                 <!-- <div class="slide" role="group" aria-roledescription="slide" aria-label="2 of 3"><span class="ph-bg"
                         style="--img:var(--img-hero-grison)"></span>
                     <div class="feat">
                         <div>
                             <div class="k">Sister concern</div>
                             <div class="t">Grison Power Engineering</div>
                             <div class="d">Electrical, civil and mechanical supplier and installation contractors.
                             </div>
                         </div><a class="feat-go" href="#/about" aria-label="About Grison Power Engineering"><svg
                                 width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                 <path d="M5 12h14M13 6l6 6-6 6"></path>
                             </svg></a>
                     </div>
                 </div>
                 <div class="slide" role="group" aria-roledescription="slide" aria-label="3 of 3"><span class="ph-bg"
                         style="--img:var(--img-hero-msi)"></span>
                     <div class="feat">
                         <div>
                             <div class="k">Sister concern</div>
                             <div class="t">MSI Corporation International</div>
                             <div class="d">Real estate business.</div>
                         </div><a class="feat-go" href="#/about" aria-label="About MSI Corporation International"><svg
                                 width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                 <path d="M5 12h14M13 6l6 6-6 6"></path>
                             </svg></a>
                     </div>
                 </div> -->
             </div>
             <div class="dots"><button class="dot" aria-label="Show slide 1"><i></i></button><button class="dot"
                     aria-label="Show slide 2"><i></i></button><button class="dot"
                     aria-label="Show slide 3"><i></i></button></div>
         </div>
     </div>
 </section>
<!-- 
 <section class="hero"><svg class="hero-tri" viewBox="0 0 700 600" aria-hidden="true">
         <polygon points="40,600 250,170 460,600" fill="rgba(82,164,66,0.16)" />
         <polygon points="250,600 470,60 690,600" fill="rgba(122,49,144,0.30)" />
         <polygon points="420,600 590,240 760,600" fill="rgba(30,91,163,0.34)" />
     </svg>
     <div class="wrap hero-in">
         <div>
             <div class="eyebrow on-dark g-in" style="--d:.05"><span>SM Group Bangladesh · Power and
                     engineering</span></div>
             <h1 class="cond"><span class="ln"><span style="--i:0">Reliable power,</span></span><span class="ln"><span
                         style="--i:1">engineered for Bangladesh.</span></span></h1>
             <p class="lead g-in" style="--d:.55">We supply, install and service electrical power equipment,
                 from transformers and switchgear to generators and solar, for industry, utilities and
                 commercial projects.</p>
             <div class="hero-btns g-in" style="--d:.7"><a class="btn btn-leaf" href="#/products"><span>Explore
                         products</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                         <path d="M5 12h14M13 6l6 6-6 6"></path>
                     </svg></a><a class="btn btn-line" href="#/contact"><span>Talk to an expert</span></a>
             </div>
         </div>
         <div class="hero-media g-in" style="--d:.35" role="region" aria-roledescription="carousel"
             aria-label="Featured products">
             <div class="slides">
                 @foreach($sliders as $key => $slider)
                 <div class="slide {{ $loop->first ? 'is-on' : '' }}" role="group" aria-roledescription="slide"
                     aria-label="{{ $loop->iteration }} of {{ $sliders->count() }}">

                     {{-- Dynamic Background Image --}}
                     <span class="ph-bg" style="background-image: url('{{ asset($slider->image) }}');">
                     </span>

                     <div class="feat">
                         <div>
                             <div class="k">Featured</div>

                             <div class="t">
                                 {{ $slider->title }}
                             </div>

                             <div class="d">
                                 {{ $slider->heading ?? 'Stable, efficient power distribution.' }}
                             </div>
                         </div>

                         <a class="feat-go" href="#/products" aria-label="View {{ $slider->title }}">

                             <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                 <path d="M5 12h14M13 6l6 6-6 6"></path>
                             </svg>

                         </a>
                     </div>
                 </div>
                 @endforeach
             </div>
             <div class="dots"><button class="dot" aria-label="Show slide 1"><i></i></button><button class="dot"
                     aria-label="Show slide 2"><i></i></button><button class="dot"
                     aria-label="Show slide 3"><i></i></button></div>
         </div>
     </div>
 </section> -->