<?php

bladerunner('views.pages.home', [
    'headerImageData' => get_field('header_image'),
    'headline'        => get_field('headline')
]);