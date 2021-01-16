{include common/header@ebcms/admin}
<div class="my-4 display-4">插件</div>
<script>
    function change(name, disabled) {
        $.ajax({
            type: "POST",
            url: "{:$router->buildUrl('/ebcms/plugin/disabled')}",
            data: {
                name: name,
                disabled: disabled
            },
            dataType: "JSON",
            success: function(response) {
                if (!response.code) {
                    alert(response.message);
                } else {
                    location.reload();
                }
            },
            error: function() {
                alert('发生错误~');
            }
        });
    }

    function del(name) {
        if (confirm('确定彻底删除该插件吗？删除后无法恢复！')) {
            $.ajax({
                type: "POST",
                url: "{:$router->buildUrl('/ebcms/plugin/delete')}",
                data: {
                    name: name
                },
                dataType: "JSON",
                success: function(response) {
                    alert(response.message);
                    if (response.code) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('发生错误~');
                }
            });
        }
    }

    function install(name) {
        if (confirm('确定安装该插件吗？')) {
            $.ajax({
                type: "POST",
                url: "{:$router->buildUrl('/ebcms/plugin/install')}",
                data: {
                    name: name
                },
                dataType: "JSON",
                success: function(response) {
                    alert(response.message);
                    if (response.code) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('发生错误~');
                }
            });
        }
    }

    function uninstall(name) {
        if (confirm('确定卸载该插件吗？')) {
            $.ajax({
                type: "POST",
                url: "{:$router->buildUrl('/ebcms/plugin/uninstall')}",
                data: {
                    name: name
                },
                dataType: "JSON",
                success: function(response) {
                    alert(response.message);
                    if (response.code) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('发生错误~');
                }
            });
        }
    }
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.6/holder.min.js" integrity="sha256-yF/YjmNnXHBdym5nuQyBNU62sCUN9Hx5awMkApzhZR0=" crossorigin="anonymous"></script>
<ul class="list-unstyled">
    {foreach $plugins as $name => $vo}
    <li class="media my-4">
        {if isset($vo['logo']) && $vo['logo']}
        <img style="cursor:pointer;height:80px;width:80px;" class="img-thumbnail img-fluid mr-3" src="{$vo.logo}">
        {else}
        <img style="cursor:pointer;height:80px;width:80px;" class="img-thumbnail img-fluid mr-3" data-src="holder.js/80x80?auto=yes&text=nopic&size=16">
        {/if}
        <div class="media-body">
            <h5 class="mt-0 mb-1">{$vo['title']??$name}</h5>
            <div class="text-muted">{$vo['description']??'暂无介绍'}</div>
            <div>
                {if $vo['_install']}
                {if $vo['_disabled']}
                <span class="badge badge-warning" style="cursor:pointer;" onclick="change('{$name}', 0);" data-toggle="tooltip" title="应用已停用，点此切换">未启用...</span>
                <span class="badge badge-secondary" style="cursor:pointer;" onclick="uninstall('{$name}');" data-toggle="tooltip" title="点此卸载此插件">卸载</span>
                {else}
                <span class="badge badge-success" style="cursor:pointer;" onclick="change('{$name}', 1);" data-toggle="tooltip" title="应用运行中，点此切换">运行中...</span>
                {if $vo['manager-url']}
                <a class="badge badge-primary" href="{:$router->buildUrl(...$vo['manager-url'])}">管理</a>
                {/if}
                {/if}
                {else}
                <span class="badge badge-danger" style="cursor:pointer;" onclick="install('{$name}');" data-toggle="tooltip" title="该插件未安装，点此安装">安装</span>
                <span class="badge badge-secondary" style="cursor:pointer;" onclick="del('{$name}');" data-toggle="tooltip" title="彻底删除该插件">删除</span>
                {/if}
                {php}$url=$router->buildUrl('/ebcms/plugin/info',['name'=>$name]);{/php}
                <a class="badge badge-primary" href="javascript:M.open({url:'{$url}', title:'详情'});">详情</a>
            </div>
        </div>
    </li>
    {/foreach}
</ul>
{include common/footer@ebcms/admin}