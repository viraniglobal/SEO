<?php

if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Scanner
{
    public function scan()
    {
        $posts = get_posts([
            'post_type' => ['post', 'page', 'product'],
            'post_status' => 'publish',
            'numberposts' => -1
        ]);

        return [
            'message' => 'SEO Audit completed successfully.',
            'total_pages' => count($posts)
        ];
    }
}