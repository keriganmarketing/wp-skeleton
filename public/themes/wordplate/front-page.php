<?php

use KeriganSolutions\KMATestimonials\Testimonial;
$testimonials = new Testimonial;
$featuredTestimonial = $testimonials->queryTestimonials(true, 1, 'date', 'DESC', 115);

bladerunner('views.pages.front', [
    'locations' => json_encode(get_terms([
        'taxonomy' => 'build-location',
    ])),
    'featureBox1' => [
        'title' => get_field('feat_1_headline'),
        'text' => get_field('feat_1_text'),
        'link' => get_field('feat_1_link')
    ],
    'featureBox2' => [
        'title' => get_field('feat_2_headline'),
        'text' => get_field('feat_2_text'),
        'link' => get_field('feat_2_link')
    ],
    'projectsHeader' => get_field('projects_header'),
    'featuredTestimonial' => $featuredTestimonial
]);