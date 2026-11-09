<section class="sec">
                <div class="wrap">
                    <div class="sec-head split">
                        <div>
                            <div class="eyebrow rv"><span>News and media</span></div>
                            <h2 class="title cond rv">Latest from SM Group.</h2>
                        </div><a class="tlink rv" style="--i:1" href="#/news"><span>All news</span><svg width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M13 6l6 6-6 6"></path>
                            </svg></a>
                    </div>
                    <div class="grid g-news mt">
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="ncard card rv" href="#/news" style="--i:0">
                            <div class="ph " role="img" aria-label="Demo image: [Headline: announcement or milestone]"
                                style="--img: url('<?php echo e(asset($slider->image)); ?>');"></div>
                            <div class="bd">
                                <div class="meta"><b>Stablished</b><span>2020</span></div>
                                <h3 class="cond"><?php echo e($slider->title); ?></h3>
                                <p><?php echo e($slider->heading); ?></p>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <!-- <a class="ncard card rv" href="#/news" style="--i:1">
                            <div class="ph " role="img"
                                aria-label="Demo image: [Headline: project handover or commissioning]"
                                style="--img:var(--img-substation-b);"></div>
                            <div class="bd">
                                <div class="meta"><b>Stablished</b><span>2020</span></div>
                                <h3 class="cond">Grison Power Engineering</h3>
                                <p>Our Sister Concern of SM Group Bangladesh</p>
                            </div>
                        </a><a class="ncard card rv" href="#/news" style="--i:2">
                            <div class="ph " role="img"
                                aria-label="Demo image: [Headline: exhibition or industry event]"
                                style="--img:var(--img-switchgear-b);"></div>
                            <div class="bd">
                                 <div class="meta"><b>Stablished</b><span>2020</span></div>
                                <h3 class="cond">MSI Corporation International</h3>
                                <p>Our Sister Concern of SM Group Bangladesh</p>
                            </div>
                        </a> -->
                    </div>
                </div>
            </section><?php /**PATH E:\laragon\www\smgroupbd\resources\views/frontend/news_media.blade.php ENDPATH**/ ?>