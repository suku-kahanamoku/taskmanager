<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

switch ($method) {
    case 'POST':
        echo $manager->serviceManager->projectService->createProject(
            file_get_contents('php://input')
        );
        break;

    case 'PATCH':
        echo $manager->serviceManager->projectService->updateProject(
            $_GET['id'],
            file_get_contents('php://input')
        );
        break;

    default:
        if (isset($_GET['id'])) {
            echo $manager->serviceManager->projectService->getProject($_GET['id']);
        } else {
            $queryParams = http_build_query($_GET);
            $queryParams = $queryParams ? "?$queryParams" : '';
            echo Manager::USE_FILTER(
                $_GET,
                $manager->serviceManager->projectService->getProjects($queryParams)
            );
        }
        break;
}
