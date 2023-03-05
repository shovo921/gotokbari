<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7ec6d28e7a5b31abe58f7cc5ef9ad41a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit7ec6d28e7a5b31abe58f7cc5ef9ad41a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit7ec6d28e7a5b31abe58f7cc5ef9ad41a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit7ec6d28e7a5b31abe58f7cc5ef9ad41a::getInitializer($loader)();

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit7ec6d28e7a5b31abe58f7cc5ef9ad41a::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire7ec6d28e7a5b31abe58f7cc5ef9ad41a($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire7ec6d28e7a5b31abe58f7cc5ef9ad41a($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
