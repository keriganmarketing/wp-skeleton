<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.index',[
    'headerImage' => $headerImageData['url'],
    'headline'    => get_field('headline')
]);