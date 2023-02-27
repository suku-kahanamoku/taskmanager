<?php
include_once '../../lib/manager.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents('../config.json'), true);

$manager = new Manager($config);

$method = $_GET['method'] ?? 'GET';

if (isset($_GET['id'])) {
    echo $manager->serviceManager->personService->getPerson($_GET['id']);
}
//
elseif (isset($_GET['project_id'])) {
    $queryParams = http_build_query($_GET);
    $queryParams = $queryParams ? "?$queryParams" : '';
    echo Manager::USE_FILTER(
        $_GET,
        $manager->serviceManager->personService->getProjectPersons($queryParams, $_GET['project_id'])
    );
}
//
else {
    $queryParams = http_build_query($_GET);
    $queryParams = $queryParams ? "?$queryParams" : '';
    echo Manager::USE_FILTER(
        $_GET,
        $manager->serviceManager->personService->getPersons($queryParams)
    );
}
