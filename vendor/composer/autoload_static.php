<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a0f75c3a027b16e5a1acdadd7bfe9a8
{
    public static $classMap = array (
        'Robanostra\\SimpleImgSrcReplacer\\Main' => __DIR__ . '/../..' . '/inc/Main.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0a0f75c3a027b16e5a1acdadd7bfe9a8::$classMap;

        }, null, ClassLoader::class);
    }
}
