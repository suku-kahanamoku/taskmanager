<?php

class AttachmentService
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
     * Vrati 1 prilohu (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<IAttachmentModel>
     */
    function getAttachment(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/attachments/$id", $headers);
        return $response->getBody();
    }

    /**
     * Vrati json seznam priloh z daneho tasku (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $taskId
     * @param array $headers
     * @return string<IAttachmentModel[]>
     */
    function getTaskAttachments(string $queryParams = '', int $taskId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks/$taskId/attachments$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Pro dany task vytvori prilohu
     *
     * @param integer $taskId
     * @param string $params
     * @param array $headers
     * @return string<IAttachmentModel>
     */
    function createTaskAttachment(int $taskId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/tasks/$taskId/attachments/", $headers);
        return $response->getBody();
    }
}
