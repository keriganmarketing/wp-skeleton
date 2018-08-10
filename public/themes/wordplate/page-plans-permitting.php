<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.planspermitting', [
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);