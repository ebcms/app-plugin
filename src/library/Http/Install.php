<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\RequestFilter;

use function Composer\Autoload\includeFile;

class Install extends Common
{
    public function post(
        App $app,
        RequestFilter $input
    ) {
        $name = $input->post('name');

        $install_lock = $app->getAppPath() . '/config/plugin/' . $name . '/install.lock';
        if (file_exists($install_lock)) {
            return $this->failure('已经安装，若要重装请先卸载！');
        }

        $plugin_dir = $app->getAppPath() . '/plugin/' . $name;
        if (file_exists($plugin_dir . '/install.php')) {
            includeFile($plugin_dir . '/install.php');
        }

        if (!is_dir(dirname($install_lock))) {
            mkdir(dirname($install_lock), 0755, true);
        }
        file_put_contents($install_lock, date(DATE_ISO8601));

        return $this->success('操作成功！');
    }
}
