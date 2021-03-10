<?php


namespace app\controllers;


abstract class Controller
{
    //всё с чем работает класс, мы сохраняем в его полях
    private $action;
    private $defaultAction = 'index';
    private $defaultLayout = 'main';
    private $useLayout = true; //проверка используется ли лейаут (для метода рендер)


    public function runAction($action = null) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) { //$this- ссылается на класс
            $this->$method(); //также динамически вызываем метод класса
        }
    }

    public function render($template, $params = []) {
        if($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->defaultLayout}", [
                'menu' => $this->renderTemplate('menu', $params),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }


//$params = [['catalog' => $catalog], []];
    public function renderTemplate($template, $params = []) {
        ob_start(); //весь последующий вывод (echo, include) не будет выводиться на страницу, а будет запоминаться в буфере
        extract($params); //переберёт массив и создаст переменные, имя возьмёт из ключа 'menu' и 'content', а значения $this->renderTemplate('menu', $params),
        // $this->renderTemplate($template, $params)
        $templatePath = VIEWS_DIR . $template . ".php";
        if(file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean(); //возвращаем текст из буфера и очищаем его
    }

}