<?php

interface IAttachmentModel extends IModel
{
    public int $size;
    public int $source;
    public string $contentType;
    public int $person_id;
    public int $task_id;
    public string $thumb_url;
    public string $medium_url;
    public string $large_url;
}
