<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0a5d69f94046cd3a8e9fcc4328f93d9
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite0a5d69f94046cd3a8e9fcc4328f93d9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite0a5d69f94046cd3a8e9fcc4328f93d9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite0a5d69f94046cd3a8e9fcc4328f93d9::$classMap;

        }, null, ClassLoader::class);
    }
}
