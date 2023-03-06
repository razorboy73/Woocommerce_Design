<?php

function style_maven_import_files()
{
    return array(

        array(
            'import_file_name'           => 'Style Maven',
            'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content2.xml',
            'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets2.json',
            'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer2.dat',
            'import_notice'              => __('A special note for this import.', 'your-textdomain'),
        ),
    );
}
add_filter('ocdi/import_files', 'style_maven_import_files');



function style_maven_import_setup()
{
    // Assign menus to their locations.
    //Add additional lines for second menu
    //watch for menu name - check the register_nav_menus function in fucnctions.php
    $main_menu = get_term_by('name', 'Style Maven Main Menu', 'nav_menu');
    $footer_menu = get_term_by('name', 'Style Maven Footer Menu', 'nav_menu');

    set_theme_mod(
        'nav_menu_locations',
        array(
            'style_maven_main_menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
            'style_maven_footer_menu' => $footer_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function

        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title('Home');
    $blog_page_id  = get_page_by_title('Blog');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);
}
add_action('ocdi/after_import', 'style_maven_import_setup');
