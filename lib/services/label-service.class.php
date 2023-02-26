<?php

class LabelService
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
     * Vrati json seznam labelu z daneho projektu (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $projectId
     * @param array $headers
     * @return string<ILabelModel[]>
     */
    function getProjectLabels(string $queryParams = '', int $projectId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$projectId/labels$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam labelu z daneho tasku (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $taskId
     * @param array $headers
     * @return string<ILabelModel[]>
     */
    function getTaskLabels(string $queryParams = '', int $taskId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks/$taskId/labels$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 label (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<ILabelModel>
     */
    function getLabel(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/labels/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori label pro dany projekt
     *
     * @param integer $projectId
     * @param string $params
     * @param array $headers
     * @return string<ILabelModel>
     */
    function createProjectLabel(int $projectId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/projects/$projectId/labels/", $headers);
        return $response->getBody();
    }

    /**
     * Upravi label
     *
     * @param integer $id
     * @param string $params
     * @param array $headers
     * @return string<ILabelModel>
     */
    function updateLabel(int $id, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('PUT', "$this->_api/labels/$id", $headers);
        return $response->getBody();
    }
}
