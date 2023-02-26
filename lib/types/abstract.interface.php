<?php

interface IModel
{
    public int $id;
    public string $name;
    public string $created_at;
    public string $updated_at;
}

interface ISortModel
{
    public string $sort;
}

interface IPaginationModel
{
    public int $items;
    public int $page;
}

interface IQueryModel extends IPaginationModel, ISortModel
{
}
