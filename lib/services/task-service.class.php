<?php

class TaskService
{
    private $_client;

    private readonly string $_api;

    private readonly string $_token;

    function __construct($config, $client)
    {
        $this->_client = $client;
        $this->_api = $config['api'];
        $this->_token = $config['token'];
    }

    /**
     * Vrati json seznam tasku (lze filtrovat dle queryParams)
     *
     * @param string<ITaskQueryModel> $queryParams
     * @param array $headers
     * @return string<ITaskModel[]>
     */
    function getTasks(string $queryParams = '', $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam tasku z daneho projektu (lze filtrovat dle queryParams)
     *
     * @param string<ITaskQueryModel> $queryParams
     * @param integer $projectId
     * @param array $headers
     * @return string<ITaskModel[]>
     */
    function getProjectTasks(string $queryParams = '', int $projectId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$projectId/tasks$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam tasku z dane sekce (lze filtrovat dle queryParams)
     *
     * @param string<ITaskQueryModel> $queryParams
     * @param integer $sectionId
     * @param array $headers
     * @return string<ITaskModel[]>
     */
    function getSectionTasks(string $queryParams = '', int $sectionId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/sections/$sectionId/tasks$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 task (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<ITaskModel>
     */
    function getTask(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori task
     *
     * @param integer $sectionId
     * @param string $params
     * @param array $headers
     * @return string<ITaskModel>
     */
    function createSectionTask(int $sectionId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/sections/$sectionId/tasks/", $headers);
        return $response->getBody();
    }

    /**
     * Upravi task
     *
     * @param integer $id
     * @param string $params
     * @param array $headers
     * @return string<ITaskModel>
     */
    function updateTask(int $id, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('PUT', "$this->_api/tasks/$id", $headers);
        return $response->getBody();
    }
}
