<?php
// Enqueue parent and child theme styles
function twentytwentyone_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts', 'twentytwentyone_child_enqueue_styles');

// Enqueue Font Awesome
function twentytwentyone_child_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'twentytwentyone_child_enqueue_font_awesome');

// Register the menu location
function twentytwentyone_child_theme_setup() {
    register_nav_menu('custom-header-menu', __('Custom Header Menu'));
}
add_action('after_setup_theme', 'twentytwentyone_child_theme_setup');

// Automatically create and assign a menu
function twentytwentyone_child_create_menu() {
    // Check if the menu already exists
    $menu_name = 'Custom Header Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    // If the menu does not exist, create it
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Add Home, Blog, and Contact menu items
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Home'),
            'menu-item-url' => home_url('/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Blog'),
            'menu-item-url' => home_url('/blog/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Contact'),
            'menu-item-url' => home_url('/contact/'),
            'menu-item-status' => 'publish'
        ));

        // Assign the menu to the primary menu location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['custom-header-menu'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_setup_theme', 'twentytwentyone_child_create_menu');
?>
