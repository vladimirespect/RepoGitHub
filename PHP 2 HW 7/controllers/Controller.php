<?php


namespace app\controllers;
use app\interfaces\IRenderer;
use app\models\repositories\{UsersRepository, BasketRepository};

abstract class Controller
{
    //всё с чем работает класс, мы сохраняем в его полях
    private $action;
    private $defaultAction = 'index';
    private $defaultLayout = 'main';
    private $useLayout = true; //проверка используется ли лейаут (для метода рендер)

    private $renderer;

    public function __construct(IRenderer $render) {
        $this->renderer = $render;
        /*чтобы вынести рендер отсюда по первому принципу солид, мы:  ПЕРВЫЙ ПРИНЦИП СОЛИД: ПРИНЦИП ЕДИНСТВЕННОЙ ОТВЕТСТВЕННОСТИ
        создали класс рендер в Engine
        вынесли туда одну функцию отсюда, при этом тут оставив наименование функции с ретурном в самом низу public function renderTemplate
        создали этот конструктор
        создали тут же приватную переменную рендерер
        создали неймспейс и use Render*/
    }


    public function runAction($action = null) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) { //$this- ссылается на класс
            $this->$method(); //также динамически вызываем метод класса
        }
    }

    public function render($template, $params = []) {  //собирает страницу из главного шаблона и подшаблона
        if($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->defaultLayout}", [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => (new UsersRepository())->isAuth(),
                    'userName' => (new UsersRepository())->getName(),
                    'count' => (new BasketRepository())->getCountWhere('session_id',session_id())  // $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
                    //эта переменная будет отображаться на всех страницах, поэтому пробрасываем её значение тут (подсчёт кол-ва товаров в корзине)
                    ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) { //рендерит шаблоны
        return $this->renderer->renderTemplate($template, $params);
    }

}