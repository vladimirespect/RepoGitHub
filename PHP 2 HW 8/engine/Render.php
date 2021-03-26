<?php


namespace app\engine;


use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params = []) {  //рендерит шаблоны
        ob_start(); //весь последующий вывод (echo, include) не будет выводиться на страницу, а будет запоминаться в буфере
        extract($params); //переберёт массив и создаст переменные, имя возьмёт из ключа 'menu' и 'content', а значения $this->renderTemplate('menu', $params),
        // $this->renderTemplate($template, $params)


        //код до 8го урока
        //$templatePath = VIEWS_DIR . $template . ".php";
        $templatePath = App::call()->config['templates_dir'] . $template . ".php";
        if(file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean(); //возвращаем текст из буфера и очищаем его
    }
}