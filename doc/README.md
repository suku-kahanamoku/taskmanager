# TASKMANAGER

Tato aplikace je napsána v PHP a slouží k komunikaci s API službou MeisterTask, která je dokumentována na https://developers.meistertask.com/. Pro komunikaci se službou je použita knihovna GuzzleHttp.

**Struktura složek aplikace:**

-   **/api/\<service\>:** jednotlivé endpointy pro komunikaci s API službami, kde \<service\> může být následující: attachment, checklist, comment, label, person, project, section, task.
    > API umožňuje externím vývojářům komunikovat s MeisterTaskem a používat jeho funkcionality, jako jsou úkoly, projekty nebo tagy. Každá funkce API je přístupná prostřednictvím jednotlivých endpointů na stránce https://developers.meistertask.com/reference/\<service\>. Endpointy jsou specifické URL adresy, ke kterým můžete přistupovat, aby bylo možné přistupovat k určitým datům nebo provádět určité akce. Například "/api/tasks" => "https://developers.meistertask.com/reference/tasks" může mít endpoint pro získání seznamu úkolů nebo pro vytvoření nového úkolu.
-   **/doc/:** obsahuje dokumentace.
-   **/lib/:** obsahuje jednotlivé třídy a služby.
    -   **/lib/services/task-service.class.php:** třída pro práci s úkoly.
    -   **/lib/services/section-service.class.php:** třída pro práci se sekcemi.
    -   **/lib/services/project-service.class.php:** třída pro práci s projekty.
    -   **/lib/services/person-service.class.php:** třída pro práci s lidmi.
    -   **/lib/services/label-service.class.php:** třída pro práci s popisky.
    -   **/lib/services/comment-service.class.php:** třída pro práci s komentáři.
    -   **/lib/services/checklist-service.class.php:** třída pro práci s kontrolními seznamy.
    -   **/lib/services/attachment-service.class.php:** třída pro práci s přílohami.
    -   **/lib/services/service-manager.class.php:** knihovna obsahující všechny výše uvedené služby.
    -   **/lib/types/\<models\>:** obsahuje všechna rozhraní modelů response a request (...QueryModel).
    -   **/lib/manager.class.php:** nejvyšší třída obsluhující všechny služby.

Knihovna **ServiceManager** obsahuje všechny výše uvedené služby a umožňuje s nimi snadno komunikovat. Konstruktor této třídy inicializuje jednotlivé služby.

Knihovna **Manager** obsahuje třídu ServiceManager a poskytuje tak nejvyšší úroveň obsluhy MeisterTask API služeb. Metoda USE_FILTER umožňuje filtrovat výsledky API volání podle zadaných parametrů. Metoda RM_DIACRITICS odstraňuje diakritiku ze zadaného řetězce.
