<footer class="footer">
    <div class="wrap f-in">
        <div class="rv">
            <div class="f-logo"><img src="{{ asset(@$admin_setting->logo) }}" alt="{{ @$admin_setting->title }}"></div>
            <p class="about">{{$setting->description}}</p>
            <form class="fnl nlf"><label for="f-mail">Get news and product updates</label>
                <div class="row"><input id="f-mail" type="email" placeholder="Your email address" required
                        autocomplete="email"><button type="submit">Subscribe</button></div>
            </form>
        </div>
        <div class="rv" style="--i:1">
            <h2 class="cond">Company</h2>
            <ul>
                <li><a href="#/about">About us</a></li>
                <li><a href="#/products">Products</a></li>
                <li><a href="#/services">Services</a></li>
                <li><a href="#/projects">Projects</a></li>
                <li><a href="#/news">News</a></li>
                <li><a href="#/contact">Contact</a></li>
            </ul>
        </div>
        <div class="rv" style="--i:2">
            <h2 class="cond">Products</h2>
            <ul>
                <li><a href="#/products">Power transformers</a></li>
                <li><a href="#/products">Switchgear and panels</a></li>
                <li><a href="#/products">Generators</a></li>
                <li><a href="#/products">Solar and energy storage</a></li>
                <li><a href="#/products">Substations</a></li>
                <li><a href="#/products">Busbar trunking</a></li>
            </ul>
        </div>
        <div class="rv" style="--i:3">
            <h2 class="cond">Contact</h2>
            <ul class="f-contact">
                <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11zM9 10a3 3 0 1 0 6 0a3 3 0 1 0 -6 0">
                        </path>
                    </svg><span>{{$setting->address}}</span></li>
                <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path
                            d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z">
                        </path>
                    </svg><span>+88{{$setting->primary_mobile}}, +88{{$setting->secondary_mobile}}</span></li>
                <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 5h18v14H3zM3 6l9 7 9-7"></path>
                    </svg><span>{{$setting->primary_email}}, {{$setting->secondary_email}}</span></li>
            </ul>
        </div>
    </div>
    <div class="f-bot">
        <div class="wrap"><span>© 2026 SM Group Bangladesh. All rights reserved. Developed by <a href="https://technoparkbd.com/" target="_blank">Techno Park BD</a></span> <span><a href="#">Privacy policy</a><a href="#">Terms of use</a></span></div>
    </div>
</footer>