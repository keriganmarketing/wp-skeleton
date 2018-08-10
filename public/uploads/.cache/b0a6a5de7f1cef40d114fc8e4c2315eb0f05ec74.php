<!DOCTYPE html>
<html <?php echo e(language_attributes()); ?>>
<head>
  <meta charset="<?php echo e(bloginfo('charset')); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#6d9aea">
  <?php echo e(wp_head()); ?>

</head>
<body <?php echo e(body_class()); ?>>
    <div id="app">
        <div class="site-wrapper" :class="{'full-height': footerStuck, 'scrolling': isScrolling }">
            <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

            <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

    <?php echo e(wp_footer()); ?>

    <?php echo $__env->yieldContent('footer-scripts'); ?>
</body>
</html>