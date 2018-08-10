<?php $__env->startSection('content'); ?>
<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php echo e(the_post()); ?>

                
        <kma-slider class="slider-container"></kma-slider>
        <main role="main">
            <div class="container">

                <div class="row no-gutters">
                    <div class="col-lg-7">
                        <article class="front">
                            <header class="fittext">
                                <fit-text :max="3.05">Your Beach Dream</fit-text>
                            </header>
                            
                            <?php echo e(the_content()); ?>


                            <a href="/about-us/" class="btn btn-lg btn-outline-primary mt-3" >Meet Our Team &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                        </article>
                    </div>
                    <div class="col">
                    </div>
                </div>

            </div>
        </main>
        <?php echo $__env->make('partials.map', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="projects-section">
            <div class="projects-header header-image" style="background-image: url('<?php echo e($projectsHeader['url']); ?>')">
                <h2 class="text-center text-uppercase text-white text-outlined">Projects</h2>
            </div>
            <div class="container">
                <portfolio-gallery :limit="6" :locations="<?php echo e($locations); ?>" :construction-types="<?php echo e($types); ?>" type="" location="" ></portfolio-gallery>
                <div class="section-button text-center">
                    <a class="btn btn-lg btn-outline-primary" href="/project-portfolio/">Project Portfolio &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="testimonial-section text-center">

            <?php $__currentLoopData = $featuredTestimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="container">
                    <div class="testimonials text-center">
                        <div class="testimonial single">
                            <p class="shorttext"><?php echo $testimonial->truncate; ?></p>
                            <p class="author"><?php echo e($testimonial->byline); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="section-button text-center">
                <a class="btn btn-lg btn-outline-white" href="/testimonials/">More Testimonials &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="feature-box-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-white box-container">
                        <div class="feature-box feat-one">
                            <h3 class="text-uppercase"><?php echo e($featureBox1['title']); ?></h3>
                            <p><?php echo e($featureBox1['text']); ?></p>
                            <a class="btn btn-lg btn-outline-white" href="<?php echo e($featureBox1['link']['url']); ?>" >Learn More &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 text-white box-container">
                        <div class="feature-box feat-two">
                            <h3 class="text-uppercase"><?php echo e($featureBox2['title']); ?></h3>
                            <p><?php echo e($featureBox2['text']); ?></p>
                            <a class="btn btn-lg btn-outline-white" href="<?php echo e($featureBox2['link']['url']); ?>" >Learn More &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <?php echo $__env->make('pages.404', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>