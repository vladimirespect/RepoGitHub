<?php


namespace app\engine;

/*class RequestException extends \Exception { //нужно если мы хотим через try catch ловить здесь ошибки отдельно от основного try catch
//необходимо дописать в классе ниже throw RequestException
}*/


class Request
// будет принимать все данные от пользователя, гет пост глобальные переменные
//это даёт контроль над всеми обращениями пользователя, для их валидации или ещё чего угодно
{
    protected $requestString;  //строка запроса - эти данные $url = explode('/', $_SERVER['REQUEST_URI']); с индекс.рнр
    protected $controllerName;
    protected $actionName;

    protected $params = [];
    protected $method;

    public function __construct() {
        $this->parseRequest();
    }

    protected function parseRequest(){
        $this->requestString =$_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);

        $this->controllerName = $url[1]; //если значения не будет, ставим по умолчанию product пока что//$url[1] ?? 'product'; - с такой записью не работала главная, переписали на тернарный иф
        $this->actionName = $url[2];//имя экшена от пользователя

        $this->params = $_REQUEST;

        $data = json_decode(file_get_contents('php://input')); //в ответе будет тело запроса
        //json_decode превратит ответ в объект //метод с баскет контроллера
        if(!is_null($data)) {
            foreach($data as $key => $value) {
                $this->params[$key] = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;

    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }



}