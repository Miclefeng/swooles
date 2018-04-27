<?php
/**
 * Created by PhpStorm.
 * User: miclefengzss
 * Date: 2018/4/27
 * Time: 13:58
 */

$http = new swoole_http_server("0.0.0.0", 9501);

$http->set([
    'worker_num' => 4,
    'document_root' => '/data/wwwroot/default/swoole/public/static',
    'enable_static_handler' => true
]);

$http->on('WorkerStart', function (swoole_server $serv, $worker_id) {
    define('APP_PATH', __DIR__ . '/../application/');
    require __DIR__ . '/../thinkphp/base.php';
});

$http->on('request', function (swoole_http_request $req, swoole_http_response $resp) {
    $_GET = $_POST = $_SERVER = [];
    if (isset($req->server)) {
        foreach ($req->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    if (isset($req->get)) {
        foreach ($req->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }

    if (isset($req->post)) {
        foreach ($req->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    ob_start();
    try {
        echo \think\App::run()->send(). " Action : ".request()->action();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $content = ob_get_contents();
    ob_end_clean();
    $resp->end($content);
});

$http->start();