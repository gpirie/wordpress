<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit8d3a545ad41415d26b40c72611f9788d
=======
class ComposerAutoloaderInite65e71171c1a5e9e7f808031e878a5e0
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit8d3a545ad41415d26b40c72611f9788d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit8d3a545ad41415d26b40c72611f9788d', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInite65e71171c1a5e9e7f808031e878a5e0', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInite65e71171c1a5e9e7f808031e878a5e0', 'loadClassLoader'));
>>>>>>> 183795979354da53b136df92de933c2cb84a544a

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require_once __DIR__ . '/autoload_static.php';

<<<<<<< HEAD
            call_user_func(\Composer\Autoload\ComposerStaticInit8d3a545ad41415d26b40c72611f9788d::getInitializer($loader));
=======
            call_user_func(\Composer\Autoload\ComposerStaticInite65e71171c1a5e9e7f808031e878a5e0::getInitializer($loader));
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
<<<<<<< HEAD
            $includeFiles = Composer\Autoload\ComposerStaticInit8d3a545ad41415d26b40c72611f9788d::$files;
=======
            $includeFiles = Composer\Autoload\ComposerStaticInite65e71171c1a5e9e7f808031e878a5e0::$files;
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
<<<<<<< HEAD
            composerRequire8d3a545ad41415d26b40c72611f9788d($fileIdentifier, $file);
=======
            composerRequiree65e71171c1a5e9e7f808031e878a5e0($fileIdentifier, $file);
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequire8d3a545ad41415d26b40c72611f9788d($fileIdentifier, $file)
=======
function composerRequiree65e71171c1a5e9e7f808031e878a5e0($fileIdentifier, $file)
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}
