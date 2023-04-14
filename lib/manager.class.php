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

    /**
     * Musi se to takhle pitome filtrovat, pac Meistertask ma nedostatecne filtrovani
     *
     * @param array $queryParams
     * @param string $items
     * @return string
     */
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
                        if (isset($item[$key])) {
                            // odstrani diakritiku a porovna zaznamy
                            $itemValue = strtolower(self::RM_DIACRITICS($item[$key]));
                            $searchValue = strtolower(self::RM_DIACRITICS($value));
                            if (!str_contains($itemValue, $searchValue)) {
                                return false;
                            }
                        }
                    }
                    return true;
                });
                $matched = array_values($matched);

                // nakonec vrati vyfiltrovane zaznamy
                $result = count($matched) ? json_encode($matched, false) : $result;
            }
        }
        return $result;
    }

    /**
     * Odstrani diakritiku
     *
     * @param string $value
     * @return void
     */
    static function RM_DIACRITICS(string $value)
    {
        $table = array(
            ' ' => '-', 'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'C' => 'C', 'c' => 'c', 'C' => 'C', 'c' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'R' => 'R', 'r' => 'r', "'" => '-', '"' => '-'
        );
        return strtr($value, $table);
    }
}
