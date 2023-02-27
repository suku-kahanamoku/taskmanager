<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

switch ($method) {
    case 'POST':
        echo $manager->serviceManager->commentService->createTaskComment(
            $_GET['task_id'],
            file_get_contents('php://input')
        );
        break;

    case 'DELETE':
        echo $manager->serviceManager->commentService->deleteComment($_GET['id']);
        break;

    default:
        if (isset($_GET['id'])) {
            echo $manager->serviceManager->commentService->getComment($_GET['id']);
        }
        //
        if (isset($_GET['task_id'])) {
            $queryParams = http_build_query($_GET);
            $queryParams = $queryParams ? "?$queryParams" : '';
            echo $manager->serviceManager->commentService->getTaskComments($queryParams, $_GET['task_id']);
        }
        break;
}
