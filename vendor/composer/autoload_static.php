<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit84c04ff4a7e1ce99ec1a77914b11c433
{
    public static $files = array (
        '82a6fdfa59515aa668b3e9acec16e8ae' => __DIR__ . '/../..' . '/src/files/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'Jey\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Jey\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit84c04ff4a7e1ce99ec1a77914b11c433::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit84c04ff4a7e1ce99ec1a77914b11c433::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
