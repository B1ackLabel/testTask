<?php
require_once "db/CProducts.php";
require_once "db/CConfigs.php";
$connectCfg = require_once "db/cfg.php";
header("Content-Type: application/json; charset=UTF-8");

if (isset($_POST['method'])){
    $method = $_POST['method'];

    switch ($method) {
        case 'hideRow':
            $id = $_POST['id'];
            if (!empty($id)){
                $Products = new CProducts($connectCfg);
                if ($Products->hide($id)){
                    echo successResult();
                } else {
                    echo failResult('Запрос не выполнен');
                }
            } else {
                echo failResult('ID не указан');
            }
            break;

        case 'changeCounter':
            $count = $_POST['count'];
            if (!empty($count) || $count == 0 ) {
                $Configs = new CConfigs($connectCfg);
                if ($Configs->setConfig('counter', $count)) {
                    echo successResult();
                }
            } else {
                echo failResult('Count значение не указано');
            }
            break;

        case 'reloadTable':
            $count = $_POST['count'];
            if (!empty($count) || $count == 0 ){
                $Products = new CProducts($connectCfg);
                echo successResult($Products->get($count, $_POST['offset']));
            } else {
                 echo failResult('Count значение не указано');
            }
            break;

        default:
            echo failResult('Такого метода не существует');
            break;
    }
}
else {
    echo failResult('Метод не указан');
}

function successResult($data = null)
{
    http_response_code(200);
    $json['success'] = true;
    $json['data'] = $data;
    return json_encode($json);
}

function failResult($msg, $data = null, $statusCode = 400 )
{
    http_response_code($statusCode);
    $json['success'] = false;
    $json['data'] = $data;
    $json['message'] = $msg;
    return json_encode($json);
}
?>