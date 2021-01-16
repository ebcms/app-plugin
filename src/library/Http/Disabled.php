<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use Ebcms\App;
use Ebcms\RequestFilter;

class Disabled extends Common
{

    public function post(
        App $app,
        RequestFilter $input
    ) {
        $name = $input->post('name');

        $install_lock = $app->getAppPath() . '/config/plugin/' . $name . '/install.lock';
        if (!file_exists($install_lock)) {
            return $this->failure('未安装！');
        }

        $disabled_file = $app->getAppPath() . '/config/plugin/' . $name . '/disabled.lock';
        if ($input->post('disabled')) {
            if (!file_exists($disabled_file)) {
                if (!is_dir(dirname($disabled_file))) {
                    mkdir(dirname($disabled_file), 0755, true);
                }
                touch($disabled_file);
            }
        } else {
            if (file_exists($disabled_file)) {
                unlink($disabled_file);
            }
        }
        return $this->success('操作成功！');
    }
}
