<?php

interface ITaskModel extends IModel
{
    public string $token;
    public string $notes;
    public string $notes_html;
    public int $status;
    public string $status_updated_at;
    public int $section_id;
    public string $section_name;
    public int $project_id;
    public int $sequence;
    public int $assigned_to_id;
    public string $assignee_name;
    public int $tracked_time;
    public string $due;
}
