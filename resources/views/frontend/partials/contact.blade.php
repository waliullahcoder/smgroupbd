
    <div class="page" data-page="contact" hidden>
            <section class="banner"><svg class="hero-tri" viewBox="0 0 700 600" aria-hidden="true">
                    <polygon points="40,600 250,170 460,600" fill="rgba(82,164,66,0.16)" />
                    <polygon points="250,600 470,60 690,600" fill="rgba(122,49,144,0.30)" />
                    <polygon points="420,600 590,240 760,600" fill="rgba(30,91,163,0.34)" />
                </svg>
                <div class="wrap banner-in">
                    <nav class="crumb" aria-label="Breadcrumb"><a href="#/home">Home</a><span
                            aria-hidden="true">/</span><span aria-current="page">Contact</span></nav>
                    <h1 class="cond g-in" style="--d:.05">Contact us</h1>
                    <p class="g-in" style="--d:.2">Tell us what you need. An engineer from SM Group Bangladesh will
                        reply within 24/7</p>
                </div>
            </section>
            <section class="sec soft" style="padding-block:clamp(40px,6vw,88px)">
                <div class="wrap contact">
                    <div class="formcard rv">
                        <div id="form-wrap">
                            <h2 class="cond">Send an enquiry</h2>
                            <p class="sub">Fields marked with an asterisk are required.</p>
                            <form class="form" id="contact-form">
                                <div class="f2">
                                    <div class="fld"><label for="c-name">Full name *</label><input id="c-name"
                                            type="text" required autocomplete="name"></div>
                                    <div class="fld"><label for="c-company">Company</label><input id="c-company"
                                            type="text" autocomplete="organization"></div>
                                </div>
                                <div class="f2">
                                    <div class="fld"><label for="c-email">Email *</label><input id="c-email"
                                            type="email" required autocomplete="email"></div>
                                    <div class="fld"><label for="c-phone">Phone</label><input id="c-phone" type="tel"
                                            autocomplete="tel"></div>
                                </div>
                                <div class="fld"><label for="c-type">What can we help with?</label><select id="c-type">
                                        <option>Product quote</option>
                                        <option>Installation or EPC project</option>
                                        <option>Maintenance and AMC</option>
                                        <option>Consultancy</option>
                                        <option>Careers</option>
                                        <option>Something else</option>
                                    </select></div>
                                <div class="fld"><label for="c-message">Message *</label><textarea id="c-message"
                                        rows="5" required></textarea></div>
                                <div><button type="submit" class="btn btn-green"
                                        style="min-height:52px;padding-inline:32px">Send enquiry</button></div>
                            </form>
                        </div>
                        <div class="thanks" id="thanks" role="status" tabindex="-1" hidden><span class="ck"><svg
                                    width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12.5l4.5 4.5L19 7.5"></path>
                                </svg></span>
                            <h2 class="cond" style="font-size:2.25rem;color:var(--ink)">Thank you. We have your enquiry.
                            </h2>
                            <p>An engineer will reply within 24/7. For urgent matters, call +88{{$setting->primary_mobile}}.</p>
                            <button type="button" class="btn btn-ink" id="again">Send another enquiry</button>
                        </div>
                    </div>
                    <div class="info">
                        <div class="icard card rv" style="--i:1"><span class="ico"><svg width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path
                                        d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11zM9 10a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                                    </path>
                                </svg></span>
                            <div>
                                <h3 class="cond">Head office</h3>
                                <p>{{$setting->address}}</p>
                            </div>
                        </div>
                        <div class="icard card rv" style="--i:2"><span class="ico"><svg width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path
                                        d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z">
                                    </path>
                                </svg></span>
                            <div>
                                <h3 class="cond">Phone</h3>
                                <p>+88{{$setting->primary_mobile}}<br>+88{{$setting->secondary_mobile}}</p>
                            </div>
                        </div>
                        <div class="icard card rv" style="--i:3"><span class="ico"><svg width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 5h18v14H3zM3 6l9 7 9-7"></path>
                                </svg></span>
                            <div>
                                <h3 class="cond">Email</h3>
                                <p>{{$setting->primary_email}}<br>{{$setting->secondary_email}}</p>
                            </div>
                        </div>
                        <div class="icard card rv" style="--i:4"><span class="ico"><svg width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0M12 7v5l3 2"></path>
                                </svg></span>
                            <div>
                                <h3 class="cond">Office hours</h3>
                                <p>[Sat to Thu, 9:00 am to 6:00 pm]<br>Emergency support: [24/7 or hours]</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="sec" style="padding-block:clamp(40px,6vw,72px) clamp(56px,8vw,96px)">
                <div class="wrap">
                    <h2 class="cond rv" style="font-size:clamp(1.875rem,3.4vw,2.5rem);color:var(--ink)">Find us</h2>
                    <div class="ph map rv-img" role="img" aria-label="Demo map of the head office location"
                        style="--img:var(--img-map);"></div>
                </div>
            </section>
        </div>

