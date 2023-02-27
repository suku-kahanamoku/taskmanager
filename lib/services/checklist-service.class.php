<?php

class ChecklistService
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
     * Vrati 1 projekt (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<IChecklistModel>
     */
    function getChecklist(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/checklists/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam zaskrtavatek pro projekt (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $projectId
     * @param array $headers
     * @return string<IChecklistModel[]>
     */
    function getProjectChecklists(string $queryParams = '', int $projectId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$projectId/checklists$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam zaskrtavatek pro task (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $taskId
     * @param array $headers
     * @return string<IChecklistModel[]>
     */
    function getTaskChecklists(string $queryParams = '', int $taskId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks/$taskId/checklists$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori vytvori zaskrtavatko pro projekt
     *
     * @param integer $projectId
     * @param string $params
     * @param array $headers
     * @return string<IChecklistModel>
     */
    function createProjectChecklist(int $projectId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/projects/$projectId/checklists", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori vytvori zaskrtavatko pro task
     *
     * @param integer $taskId
     * @param string $params
     * @param array $headers
     * @return string<IChecklistModel>
     */
    function createTaskChecklist(int $taskId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/tasks/$taskId/checklists", $headers);
        return $response->getBody();
    }

    /**
     * Upravi zaskrtavatko
     *
     * @param integer $id
     * @param string $params
     * @param array $headers
     * @return string<IChecklistModel>
     */
    function updateChecklist(int $id, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('PUT', "$this->_api/checklists/$id", $headers);
        return $response->getBody();
    }

    /**
     * 
     *
     * @param integer $id
     * @param array $headers
     * @return string
     */
    function deleteChecklist(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('DELETE', "$this->_api/checklists/$id", $headers);
        return $response->getBody();
    }
}
