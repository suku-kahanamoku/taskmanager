<?php
include_once 'project-service.class.php';
include_once 'section-service.class.php';
include_once 'task-service.class.php';
include_once 'person-service.class.php';
include_once 'checklist-service.class.php';
include_once 'attachment-service.class.php';
include_once 'comment-service.class.php';
include_once 'label-service.class.php';

class ServiceManager
{
    private $_client;

    readonly ProjectService $projectService;

    readonly SectionService $sectionService;

    readonly TaskService $taskService;

    readonly PersonService $personService;

    readonly ChecklistService $checklistService;

    readonly AttachmentService $attachmentService;

    readonly CommentService $commentService;

    readonly LabelService $labelService;

    function __construct($config)
    {
        $this->_client = new GuzzleHttp\Client();
        // inicializuje jednotlive servisy
        $this->projectService = new ProjectService($config, $this->_client);
        $this->sectionService = new SectionService($config, $this->_client);
        $this->taskService = new TaskService($config, $this->_client);
        $this->personService = new PersonService($config, $this->_client);
        $this->checklistService = new ChecklistService($config, $this->_client);
        $this->attachmentService = new AttachmentService($config, $this->_client);
        $this->commentService = new CommentService($config, $this->_client);
        $this->labelService = new LabelService($config, $this->_client);
    }
}
