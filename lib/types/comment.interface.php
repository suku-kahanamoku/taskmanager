<?php

interface ICommentModel extends IModel
{
    public int $task_id;
    public int $person_id;
    public string $text;
    public string $text_html;
}
