<?php

interface IProjectModel extends IModel
{
    public string $contentType;
    public int $size;
    public int $source;
    public int $person_id;
    public int $task_id;
    public string $thumb_url;
    public string $medium_url;
    public string $large_url;
}
