<?php

interface ISectionModel extends IModel
{
    public string $description;
    public string $color;
    public int $indicator;
    public int $status;
    public int $project_id;
    public int $sequence;
}
