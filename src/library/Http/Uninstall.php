<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\Request;

use function Composer\Autoload\includeFile;

class Uninstall extends Common
{

    public function post(
        App $app,
        Request $request
    ) {
        $name = $request->post('name');

        $install_lock = $app->getAppPath() . '/config/plugin/' . $name . '/install.lock';
        if (!file_exists($install_lock)) {
            return $this->failure('未安装！');
        }

        $disabled_lock = $app->getAppPath() . '/config/plugin/' . $name . '/disabled.lock';
        if (!file_exists($disabled_lock)) {
            return $this->failure('请先停用！');
        }

        $plugin_dir = $app->getAppPath() . '/plugin/' . $name;
        if (file_exists($plugin_dir . '/uninstall.php')) {
            includeFile($plugin_dir . '/uninstall.php');
        }

        unlink($install_lock);

        return $this->success('操作成功！');
    }
}
