<?php
$current_page = getCurrentPage();

$menu_items = [
    'dashboard' =>  [
        'title' => 'Dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'page' => 'dashboard',
        'url' => 'dashboard'
    ],
    'admin-profile' =>  [
        'title' => 'Admin Profile',
        'icon' => 'fas fa-user-shield',
        'page' => 'admin-profile',
        'url' => 'admin-profile'
    ],
    'home-slider' =>  [
        'title' => 'Home Slider',
        'icon' => 'fas fa-sliders-h',
        'page' => 'home-slider',
        'url' => 'home-slider'
    ],
    'residential' =>  [
        'title' => 'Residential Services',
        'icon' => 'fas fa-home',
        'page' => 'residential',
        'url' => 'residential'
    ],
    'commercial' =>  [
        'title' => 'Commercial Services',
        'icon' => 'fas fa-building',
        'page' => 'commercial',
        'url' => 'commercial'
    ],
    // 'turnkey' =>  [
    //     'title' => 'Turnkey Services',
    //     'icon' => 'fas fa-key',
    //     'page' => 'turnkey',
    //     'url' => 'turnkey'
    // ],
    'portfolio' =>  [
        'title' => 'Portfolio Gallery',
        'icon' => 'fas fa-image',
        'page' => 'portfolio',
        'url' => 'portfolio'
    ],
    'lead' =>  [
        'title' => 'Lead Users',
        'icon' => 'fas fa-users',
        'page' => 'leads',
        'url' => 'leads'
    ],
    'aboutus' =>  [
        'title' => 'About Us',
        'icon' => 'fas fa-info-circle',
        'page' => 'aboutus',
        'url' => 'aboutus'
    ],
    'testimonial' =>  [
        'title' => 'Testimonials',
        'icon' => 'fas fa-quote-left',
        'page' => 'testimonial',
        'url' => 'testimonial'
    ],
    'our-services' =>  [
        'title' => 'Our Services',
        'icon' => 'fas fa-list-alt',
        'page' => 'our-services',
        'url' => 'our-services'
    ],
    'site-settings' =>  [
        'title' => 'Site Settings',
        'icon' => 'fas fa-cog',
        'page' => 'site-settings',
        'url' => 'site-settings'
    ]
];
?>