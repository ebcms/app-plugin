<?php

declare(strict_types=1);

namespace App\Ebcms\Plugin\Http;

use App\Ebcms\Admin\Http\Common;
use App\Ebcms\Plugin\Traits\DirTrait;
use Ebcms\App;
use Ebcms\Request;

class Delete extends Common
{
    use DirTrait;

    public function post(
        App $app,
        Request $request
    ) {
        $name = $request->post('name');
        $install_lock = $app->getAppPath() . '/config/plugin/' . $name . '/install.lock';
        if (file_exists($install_lock)) {
            return $this->failure('请先卸载！');
        }
        $disabled_lock = $app->getAppPath() . '/config/plugin/' . $name . '/disabled.lock';
        if (!file_exists($disabled_lock)) {
            return $this->failure('请先停用！');
        }
        $this->delDir($app->getAppPath() . '/plugin/' . $name);
        $this->delDir($app->getAppPath() . '/config/plugin/' . $name);
        return $this->success('操作成功！');
    }
}
