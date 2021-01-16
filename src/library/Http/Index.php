<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Psr\Http\Message\ResponseInterface;
use Ebcms\Template;

class Index extends Common
{
    public function get(
        App $app,
        Template $template
    ): ResponseInterface {
        $plugins = [];
        foreach (glob($app->getAppPath() . '/plugin/*/plugin.json') as $value) {
            $name = pathinfo(dirname($value), PATHINFO_FILENAME);
            $info = array_merge([
                'name' => '',
                'version' => '',
                'title' => '',
                'description' => '',
                'logo' => '',
                'license' => '',
                'manager-url' => '',
            ], (array)json_decode(file_get_contents($value), true));
            $info['_install'] = file_exists($app->getAppPath() . '/config/plugin/' . $name . '/install.lock');
            $info['_disabled'] = file_exists($app->getAppPath() . '/config/plugin/' . $name . '/disabled.lock');
            $plugins[$name] = $info;
        }

        $html = $template->renderFromFile('index@ebcms/plugin', [
            'plugins' => $plugins,
        ]);
        return $this->html($html);
    }
}
