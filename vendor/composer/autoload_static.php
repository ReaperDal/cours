<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87f454ad57307c8edeab0671c032c80d
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpImap' => 
            array (
                0 => __DIR__ . '/..' . '/php-imap/php-imap/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit87f454ad57307c8edeab0671c032c80d::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit87f454ad57307c8edeab0671c032c80d::$classMap;

        }, null, ClassLoader::class);
    }
}
