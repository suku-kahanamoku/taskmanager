<?php

interface IPersonModel extends IModel
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $avatar;
    public string $avatar_thumb;
}
