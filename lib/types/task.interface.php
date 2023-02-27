<?php

interface ITaskModel extends IModel
{
    public string $notes;
    public int $status;
    public string $status_updated_at;
    public int $section_id;
    public string $section_name;
    public int $project_id;
    public int $sequence;
    public int $assigned_to_id;
    public string $assignee_name;
    public int $tracked_time;
    public string $token;
    public string $due;
}

interface ITaskQueryModel extends IQueryModel
{
    public bool $assigned_to_me;
    public bool $focused_by_me;
    public string $labels;
    public EStatus $status;
}

enum EStatus
{
    case open;
    case completed;
    case completed_archived;
    case trashed;
}
