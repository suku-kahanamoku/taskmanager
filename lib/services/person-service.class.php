<?php

class PersonService
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
     * Vrati json seznam uzivatelu (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param array $headers
     * @return string<IPersonModel[]>
     */
    function getPersons(string $queryParams = '', $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/persons$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam uzivatelu z daneho projektu (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $projectId
     * @param array $headers
     * @return string<IPersonModel[]>
     */
    function getProjectPersons(string $queryParams = '', int $projectId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/projects/$projectId/persons$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 uzivatele (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<IPersonModel>
     */
    function getPerson(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/persons/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vrati udaje o prihlasenem uzivateli
     *
     * @param array $headers
     * @return string<IPersonModel>
     */
    function getMe($headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/persons/me", $headers);
        return $response->getBody();
    }
}
