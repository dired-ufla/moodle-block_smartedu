<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7c071b38f69a0b82ff94c1527c44426
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'b' => 
        array (
            'block_smartedu\\' => 15,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'block_smartedu\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Smalot\\PdfParser\\' => 
            array (
                0 => __DIR__ . '/..' . '/smalot/pdfparser/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7c071b38f69a0b82ff94c1527c44426::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7c071b38f69a0b82ff94c1527c44426::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf7c071b38f69a0b82ff94c1527c44426::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf7c071b38f69a0b82ff94c1527c44426::$classMap;

        }, null, ClassLoader::class);
    }
}
