<?php

spl_autoload_register( function($className) {
    $autoload_dirs = [ 'core', 'core/classes' ];
    $found = false;
    foreach ( $autoload_dirs as $dir ) {
        if ( is_file($fileName = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $className.'.php') ) {
            require_once($fileName);
            $found = true;
        }
    }

    if ( !$found )
        return new WP_Error( 'class_not_found', 'Класс не найден...', 404 );

    return true;
} );

add_action( 'init', function() {
    new Iqwik();
} );
