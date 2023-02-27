<?php

class SectionService
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
     * Vrati json seznam sekci (lze filtrovat dle queryParams)
     *
     * @param string<ISectionQueryModel> $queryParams
     * @param array $headers
     * @return string<ISectionModel[]>
     */
    function getSections(string $queryParams = '', $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/sections$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam sekci z daneho projektu (lze filtrovat dle queryParams)
     *
     * @param string<ISectionQueryModel> $queryParams
     * @param array $headers
     * @return string<ISectionModel[]>
     */
    function getProjectSections(string $queryParams = '', int $projectId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$projectId/sections$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 sekci (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<ISectionModel>
     */
    function getSection(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/sections/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vytvori sekci
     *
     * @param integer $projectId
     * @param string $params
     * @param array $headers
     * @return string<ISectionModel>
     */
    function createProjectSection(int $projectId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/projects/$projectId/sections/", $headers);
        return $response->getBody();
    }

    /**
     * Upravi sekci
     *
     * @param integer $id
     * @param string $params
     * @param array $headers
     * @return string<ISectionModel>
     */
    function updateSection(int $id, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('PUT', "$this->_api/sections/$id", $headers);
        return $response->getBody();
    }
}
