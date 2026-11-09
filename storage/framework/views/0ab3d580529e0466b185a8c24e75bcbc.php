 <?php 
        $slider = App\Models\Slider::orderBy('id','desc')->first();             
 ?>
 <section class="sec">
                <div class="wrap two">
                    <div class="ov-media">
                        <div class="ph rv-img" role="img" aria-label="Demo image: SM Group team on site"
                            style="--img: url('<?php echo e(asset($slider->image)); ?>');"></div>
                        <div class="badge rv" style="--i:4"><b data-count>2020</b><span>Year of founding</span></div>
                    </div>
                    <div>
                        <div class="eyebrow rv"><span>Corporate overview</span></div>
                        <h2 class="title cond rv">One group. Engineering, supply and service.</h2>
                        <p class="p rv">Founded in [Year], SM Group Bangladesh brings engineering, supply and service
                            businesses together under one name. We work with industrial plants, developers and utilities
                            to plan, deliver and maintain dependable power infrastructure.</p>
                        <p class="p rv">Our teams combine [XX] years of field experience with equipment from trusted
                            manufacturers, backed by testing, commissioning and after-sales support.</p>
                        <ul class="checks rv">
                            <li><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2F7D2A"
                                    stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12.5l4.5 4.5L19 7.5"></path>
                                </svg><span>Genuine equipment from [partner manufacturers]</span></li>
                            <li><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2F7D2A"
                                    stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12.5l4.5 4.5L19 7.5"></path>
                                </svg><span>Supply, installation, testing and service under one roof</span></li>
                            <li><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2F7D2A"
                                    stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M5 12.5l4.5 4.5L19 7.5"></path>
                                </svg><span>[Quality and safety certifications]</span></li>
                        </ul>
                        <div class="actions rv"><a class="btn btn-green" href="#/about"><span>Read our story</span><svg
                                    width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6"></path>
                                </svg></a></div>
                    </div>
                </div>
            </section><?php /**PATH E:\laragon\www\smgroupbd\resources\views/frontend/overview.blade.php ENDPATH**/ ?>