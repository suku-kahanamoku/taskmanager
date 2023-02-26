<?php

interface IChecklistModel extends IModel
{
    public int $sequence;
    public int $project_id;
    public int $task_id;
}
