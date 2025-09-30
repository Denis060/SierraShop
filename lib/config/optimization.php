<?php
/**
 * SEO and Performance Configuration
 */

$seo_config = [
    'site_name' => 'Sierra Shop',
    'site_description' => 'Your premier destination for online shopping',
    'site_keywords' => 'online shop, ecommerce, shopping, retail',
    'default_title_format' => '%s - Sierra Shop',
    'social_media' => [
        'facebook' => 'https://facebook.com/sierrashop',
        'twitter' => 'https://twitter.com/sierrashop',
        'instagram' => 'https://instagram.com/sierrashop'
    ]
];

$cache_config = [
    'enable_cache' => true,
    'cache_time' => 3600, // 1 hour
    'cache_path' => 'cache/',
    'cached_queries' => true,
    'query_cache_time' => 300 // 5 minutes
];

$image_config = [
    'compression_quality' => 85,
    'max_width' => 1920,
    'thumbnail_sizes' => [
        'small' => 150,
        'medium' => 300,
        'large' => 600
    ],
    'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp']
];

$js_files = [
    'public/js/jquery.min.js',
    'public/js/bootstrap.min.js',
    'public/js/form-validation.js',
    'public/js/custom.js'
];

$css_files = [
    'public/css/bootstrap.min.css',
    'public/css/theme.css',
    'public/css/custom.css'
];
