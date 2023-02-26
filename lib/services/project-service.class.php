<?php

class ProjectService
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
     * Vrati json seznam projektu (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param array $headers
     * @return string<IProjectModel[]>
     */
    function getProjects(string $queryParams = '', $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 projekt (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<IProjectModel>
     */
    function getProject(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori projekt
     *
     * @param string $params
     * @param array $headers
     * @return string<IProjectModel>
     */
    function createProject(string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/projects/", $headers);
        return $response->getBody();
    }

    /**
     * Upravi projekt
     *
     * @param integer $id
     * @param string $params
     * @param array $headers
     * @return string<IProjectModel>
     */
    function updateProject(int $id, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('PUT', "$this->_api/projects/$id", $headers);
        return $response->getBody();
    }
}
