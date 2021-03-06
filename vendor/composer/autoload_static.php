<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9da73d270b25948f0eb2743069ea653e
{
    public static $files = array (
        'be6802f6fc50b58b69c95e60c987f831' => __DIR__ . '/../..' . '/env.php',
        '196dc9cab0e84224565cc991e0aa10c2' => __DIR__ . '/../..' . '/loadEnv.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9da73d270b25948f0eb2743069ea653e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9da73d270b25948f0eb2743069ea653e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
