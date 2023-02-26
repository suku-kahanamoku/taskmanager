<?php
include_once 'services/service-manager.class.php';

define('SP_KEYS', ['sort', 'page', 'items']);

class Manager
{
    readonly ServiceManager $serviceManager;

    function __construct($config)
    {
        $this->serviceManager = new ServiceManager($config);
    }

    static function USE_FILTER(array $queryParams = [], string $items): string
    {
        $result = $items;
        if (count($queryParams) && $items) {
            // nejdriv odstrani sort a page atributy
            foreach (SP_KEYS as $key) {
                unset($queryParams[$key]);
            }

            // dekoduje zaznamy, projede a porovna atributy
            $items = json_decode($items, true);
            if (is_array($items)) {
                $matched = array_filter($items, function ($item) use ($queryParams) {
                    foreach ($queryParams as $key => $value) {
                        if (isset($item[$key]) && !str_contains($item[$key], $value)) {
                            return false;
                        }
                    }
                    return true;
                });

                // nakonec vrati vyfiltrovane zaznamy
                $result = count($matched) ? json_encode($matched) : $result;
            }
        }
        return $result;
    }
}
