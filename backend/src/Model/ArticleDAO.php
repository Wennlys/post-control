<?php

namespace Source\Model;

use Source\Core\Connection;

class ArticleDAO
{
    public function __construct(Connection $dbConnection)
    {
        $this->database = $dbConnection;
    }

    public function index()
    {
        return ['id' => 1];
    }
}
