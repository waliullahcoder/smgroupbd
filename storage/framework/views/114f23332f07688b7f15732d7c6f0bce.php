<?php $__env->startSection('content'); ?>

        <div class="page" data-page="home">
             <?php echo $__env->make('frontend.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="wrap stats-wrap">
                <div class="stats">
                    <div class="stat rv" style="--i:0"><b data-count>6+</b><span>Years of experience</span></div>
                    <div class="stat rv" style="--i:1"><b data-count>200+</b><span>Projects delivered</span></div>
                    <div class="stat rv" style="--i:2"><b data-count>250 MVA</b><span>Capacity supplied</span></div>
                    <div class="stat rv" style="--i:3"><b data-count>30+</b><span>Engineers and technicians</span>
                    </div>
                </div>
            </div>

            <?php echo $__env->make('frontend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('frontend.our_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('frontend.our_business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.milestone', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           

            
           <?php echo $__env->make('frontend.service_solution', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <section class="cta">
                <div class="wrap cta-in">
                    <div class="rv">
                        <h2 class="cond">Start your journey toward reliable power.</h2>
                        <p>Tell us about your site and load. Our engineers will respond with a practical proposal.</p>
                    </div>
                    <div class="btns rv" style="--i:2"><a class="btn btn-white" href="#/contact"><span>Contact us
                                now</span></a><a class="btn btn-line" href="#/contact">Call +88<?php echo e($setting->primary_mobile); ?></a></div>
                </div>
            </section>

            <?php echo $__env->make('frontend.news_media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <?php echo $__env->make('frontend.partials.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend.partials.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend.partials.services', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend.partials.projects', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend.partials.news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend.partials.contact', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\smgroupbd\resources\views/frontend/home.blade.php ENDPATH**/ ?>