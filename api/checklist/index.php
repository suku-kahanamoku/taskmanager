<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

switch ($method) {
    case 'POST':
        if (isset($_GET['project_id'])) {
            echo $manager->serviceManager->checklistService->createProjectChecklist(
                $_GET['project_id'],
                file_get_contents('php://input')
            );
        }
        //
        elseif (isset($_GET['task_id'])) {
            echo $manager->serviceManager->checklistService->createTaskChecklist(
                $_GET['task_id'],
                file_get_contents('php://input')
            );
        }
        break;

    case 'PATCH':
        echo $manager->serviceManager->checklistService->updateChecklist(
            $_GET['id'],
            file_get_contents('php://input')
        );
        break;

    case 'DELETE':
        echo $manager->serviceManager->checklistService->deleteChecklist($_GET['id']);
        break;

    default:
        if (isset($_GET['id'])) {
            echo $manager->serviceManager->checklistService->getChecklist($_GET['id']);
        }
        //
        else {
            $queryParams = http_build_query($_GET);
            $queryParams = $queryParams ? "?$queryParams" : '';
            //
            if (isset($_GET['project_id'])) {
                echo Manager::USE_FILTER(
                    $_GET,
                    $manager->serviceManager->checklistService->getProjectChecklists(
                        $queryParams,
                        $_GET['project_id']
                    )
                );
            }
            //
            elseif (isset($_GET['task_id'])) {
                echo Manager::USE_FILTER(
                    $_GET,
                    $manager->serviceManager->checklistService->getTaskChecklists(
                        $queryParams,
                        $_GET['task_id']
                    )
                );
            }
        }
        break;
}
