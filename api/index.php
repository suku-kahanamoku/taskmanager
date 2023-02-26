<?php
include '../lib/manager.class.php';
require_once 'C:\Users\sukhtseren.tsetsegee\vendor\autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('config.json'), true);

$manager = new Manager($config);

$model = $_GET['model'] ?? '';
$method = $_GET['method'] ?? 'GET';

switch ($model) {
    case 'task':
        switch ($method) {
            case 'POST':
                echo $manager->serviceManager->taskService->createTask(
                    $_GET['section_id'],
                    file_get_contents('php://input')
                );
                break;

            case 'PATCH':
                echo $manager->serviceManager->taskService->updateTask(
                    $_GET['id'],
                    file_get_contents('php://input')
                );
                break;

            default:
                if (isset($_GET['id'])) {
                    echo $manager->serviceManager->taskService->getTask($_GET['id']);
                } else {
                    $queryParams = http_build_query($_GET);
                    $queryParams = $queryParams ? "?$queryParams" : '';
                    echo Manager::USE_FILTER(
                        $_GET,
                        $manager->serviceManager->taskService->getTasks($queryParams)
                    );
                }
                break;
        }
        break;
}

//echo $manager->getTask($queryParams, 145511546);
