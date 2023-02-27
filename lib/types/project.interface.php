<?php

interface IProjectModel extends IModel
{
    public string $token;
    public string $notes;
    public int $status;
}

interface IProjectQueryModel extends IQueryModel
{
    public EStatus $status;
}

enum EStatus
{
    case active;
    case archived;
    case all;
}
