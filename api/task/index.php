<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

switch ($method) {
    case 'POST':
        echo $manager->serviceManager->taskService->createSectionTask(
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
        }
        //
        else {
            $queryParams = http_build_query($_GET);
            $queryParams = $queryParams ? "?$queryParams" : '';
            //
            if (isset($_GET['project_id'])) {
                echo Manager::USE_FILTER(
                    $_GET,
                    $manager->serviceManager->taskService->getProjectTasks($queryParams, $_GET['project_id'])
                );
            }
            //
            elseif (isset($_GET['section_id'])) {
                echo Manager::USE_FILTER(
                    $_GET,
                    $manager->serviceManager->taskService->getSectionTasks($queryParams, $_GET['section_id'])
                );
            }
            //
            else {
                echo Manager::USE_FILTER(
                    $_GET,
                    $manager->serviceManager->taskService->getTasks($queryParams)
                );
            }
        }
        break;
}
