<?php
class JsFilesRules {
    static public function set() {
        add_action('wp_enqueue_scripts', function() {
            // отменяем зарегистрированный jQuery
            wp_deregister_script('jquery-core');
            wp_deregister_script('jquery');
            // добавляем свои js-скрипты
            //wp_enqueue_script(
            //    'wp-frontend',
            //    get_stylesheet_directory_uri() . '/static/app.js',
            //    ['wp-element', 'wp-api-fetch'],
            //    wp_get_theme()->get('Version'),
            //time(), // для production используйте wp_get_theme()->get('Version')
            //    true
            //);
            //	wp_enqueue_script('site-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', [], BUNDLE_VERSION, true);
        });
        /*
        // подключение на определенных страницах
        add_action('wp', function() {
            add_action('wp_enqueue_scripts', function() {
                wp_enqueue_script('site-app', get_template_directory_uri() . '/assets/js/app.min.js', [], BUNDLE_VERSION, true);
            });
        });
        */
        add_action('after_setup_theme', function() {
            remove_action('wp_head','wp_print_scripts');
            remove_action('wp_head','wp_print_head_scripts',9);
            remove_action('wp_head','wp_enqueue_scripts',1);
            add_action('wp_footer','wp_print_scripts',5);
            add_action('wp_footer','wp_print_head_scripts',5);
            add_action('wp_footer','wp_enqueue_scripts',5);
        });
        # удаляет версию WP из преданного URL у скриптов и стилей
        add_filter( 'script_loader_src', 'remove_wp_version_from_src' );
        add_filter( 'style_loader_src', 'remove_wp_version_from_src' );
        function remove_wp_version_from_src($src) {
            global $wp_version;
            parse_str(parse_url($src, PHP_URL_QUERY), $query);
            if (! empty($query['ver']) && $query['ver'] === $wp_version) {
                $src = remove_query_arg('ver', $src);
            }
            return $src;
        }
    }
}
