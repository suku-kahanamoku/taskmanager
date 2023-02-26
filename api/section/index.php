<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

switch ($method) {
    case 'POST':
        echo $manager->serviceManager->sectionService->createSection(
            $_GET['project_id'],
            file_get_contents('php://input')
        );
        break;

    case 'PATCH':
        echo $manager->serviceManager->sectionService->updateSection(
            $_GET['id'],
            file_get_contents('php://input')
        );
        break;

    default:
        if (isset($_GET['id'])) {
            echo $manager->serviceManager->sectionService->getSection($_GET['id']);
        } else {
            $queryParams = http_build_query($_GET);
            $queryParams = $queryParams ? "?$queryParams" : '';
            echo Manager::USE_FILTER(
                $_GET,
                $manager->serviceManager->sectionService->getSections($queryParams)
            );
        }
        break;
}
