<?php

use Ebcms\App;
use Ebcms\Router;

return App::getInstance()->execute(function (
    Router $router
): array {
    $res = [];
    $res[] = [
        'title' => '插件',
        'url' => $router->buildUrl('/ebcms/plugin/index'),
        'priority' => 2,
        'icon' => '<svg t="1609050228877" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="87723" width="20" height="20"><path d="M844.56334223 483.00942223q36.11761778 0 68.73998221 13.98101333t57.08913779 38.44778667 38.44778666 57.08913777 13.98101334 68.73998223q0 37.28270222-13.98101334 69.32252443t-38.44778666 56.50659557-57.08913779 38.44778666-68.73998221 13.98101334q-33.78744889 0-63.49710223-12.23338667t-53.01134222-32.03982223l0 145.63555556q0 31.45728-22.13660445 53.59388444t-53.59388444 22.13660445l-574.38663111 0q-31.45728 0-54.17642667-22.13660445t-22.71914667-53.59388444l0-129.32437333q5.82542222-24.46677333 20.97152-36.11761778t44.27320889 5.82542223q13.98101333 8.15559111 20.97152 9.32067555 30.29219555 15.14609778 61.74947556 15.14609777t58.83676444-11.65084444 47.76846223-32.03982223 32.03982222-47.18592 11.65084445-58.25422222-11.65084445-58.83676443-32.03982222-47.76846223-47.76846223-32.03982222-58.83676444-11.65084445q-30.29219555 0-59.41930666 12.8159289-6.99050667 2.33016889-11.65084445 4.66033777-13.98101333 6.99050667-27.37948445 12.81592888t-23.8842311 4.66033778-17.47626667-11.65084443-8.15559112-34.95253335l0-122.33386665q0-31.45728 22.71914667-54.17642668t54.17642667-22.71914667l181.75317333 0q-18.64135111-23.30168889-29.70965333-51.84625777t-11.06830222-61.16693333q0-38.44778667 14.56355555-71.65269333t39.03032889-57.67168 57.67168-39.0303289 70.48760889-14.56355555 70.48760889 14.56355555 57.67168 39.0303289 39.03032888 57.67168 14.56355557 71.65269333q0 65.24472889-40.77795557 113.0131911l110.68302223 0q31.45728 0 53.59388444 22.71914667t22.13660445 54.17642668l0 154.9562311q23.30168889-19.80643555 53.01134222-32.03982222t63.49710223-12.23338666z" fill="#1296db" p-id="87724"></path></svg>',
    ];
    return $res;
});
