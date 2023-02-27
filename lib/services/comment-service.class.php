<?php

class CommentService
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
     * Vrati json seznam komentaru pro dany task (lze filtrovat dle queryParams)
     *
     * @param string<IQueryModel> $queryParams
     * @param integer $taskId
     * @param array $headers
     * @return string<ICommentModel[]>
     */
    function getTaskComments(string $queryParams = '', int $taskId, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/tasks/$taskId/comments$queryParams", $headers);
        return $response->getBody();
    }

    /**
     * Vrati 1 komentar (vyhledava dle id)
     *
     * @param integer $id
     * @param array $headers
     * @return string<ICommentModel>
     */
    function getComment(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('GET', "$this->_api/comments/$id", $headers);
        return $response->getBody();
    }

    /**
     * Pro dany task vytvori komentar
     *
     * @param integer $taskId
     * @param string $params
     * @param array $headers
     * @return string<ICommentModel>
     */
    function createTaskComment(int $taskId, string $params, $headers = []): string
    {
        $headers = array_merge($headers, [
            'body' => $params,
            'headers' => [
                'Authorization' => $this->_token,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        ]);
        $response = $this->_client->request('POST', "$this->_api/tasks/$taskId/comments/", $headers);
        return $response->getBody();
    }

    /**
     * 
     *
     * @param integer $id
     * @param array $headers
     * @return string
     */
    function deleteComment(int $id, $headers = []): string
    {
        $headers = array_merge($headers, [
            'headers' => [
                'Authorization' => $this->_token,
            ]
        ]);
        $response = $this->_client->request('DELETE', "$this->_api/comments/$id", $headers);
        return $response->getBody();
    }
}
