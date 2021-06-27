<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\Request;
use Ebcms\Template;

class Info extends Common
{
    public function get(
        App $app,
        Template $template,
        Request $request
    ) {
        $data = [];
        $data['plugin'] = (array)json_decode(file_get_contents($app->getAppPath() . '/plugin/' . $request->get('name') . '/plugin.json'), true);
        $readme_file = $app->getAppPath() . '/plugin/' . $request->get('name') . '/README.md';
        if (file_exists($readme_file)) {
            $data['readme'] = file_get_contents($readme_file);
        }
        return $template->renderFromFile('info@ebcms/plugin', $data);
    }
}
