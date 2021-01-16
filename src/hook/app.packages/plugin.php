<?php

use Composer\Autoload\ClassLoader;
use Ebcms\App;

$loader = new ClassLoader();
$app_path = App::getInstance()->getAppPath();
foreach (glob($app_path . '/plugin/*/plugin.json') as $value) {
    $dir = dirname($value);
    $name = pathinfo(dirname($value), PATHINFO_FILENAME);
    if (
        file_exists($app_path . '/config/plugin/' . $name . '/install.lock') &&
        !file_exists($app_path . '/config/plugin/' . $name . '/disabled.lock')
    ) {
        $params['plugin/' . $name] = [
            'dir' => $dir,
        ];
        $loader->addPsr4(str_replace(
            ['-'],
            '',
            ucwords('App\\Plugin\\' . $name . '\\', '\\-')
        ), $dir . '/src/library/');
    }
}
$loader->register();
