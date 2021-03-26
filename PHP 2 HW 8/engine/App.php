<?php


namespace app\engine;

//такой список работает в версиях старше 7й
use app\models\repositories\{UsersRepository, BasketRepository, FeedbackRepository, GalleryRepository, GoodsRepository, OrdersRepository};
use app\traits\TSingletone;


//Для удобства вызова компонентов делаем подсказку для шторма php doc
//Где передаём будто бы у класса APP есть свойства равные именам классов Db Db Request
// как будто свойство с именем $Request возвращает экземпляр класса Request

/**
 * Class App
 * @property Db $db
 *  @property Session $session
 *  @property Request $request
 *  @property Render $render
 *  @property TwigRender $twigRender
 * @property UsersRepository $usersRepository
 * @property BasketRepository $basketRepository
 * @property FeedbackRepository $feedbackRepository
 * @property GalleryRepository $galleryRepository
 * @property GoodsRepository $goodsRepository
 * @property OrdersRepository $ordersRepository
 */

class App
{
    use TSingletone;

    public $config;
    //хранилище компонентов-объектов
    private $components;//  ['Db' => new Db()] //new Storage

    private $controller;
    private $action;

    public function run($config) {
        $this->config = $config; //сохранили конфиг
        $this->components = new Storage(); //т.к. App верхушка нашей архитектуры здесь можно нарушать Solid//создали хранилище приложения
        $this->runController();//запустили контроллер в работу
    }


    //то, чем занимался по сути index - запуск контроллера
    //внутри функции не пишем обращение App::call-> так как мы и так внутри класса App
    //через методы гет вытаскиваем значения полей с Реквеста для передачи управления соответствующему контроллеру
    public function runController() {
        $this->controller = $this->request->getControllerName() ?: 'product'; //если значения не будет, ставим по умолчанию product
        $this->action = $this->request->getActionName();

//ЧПУ    //настройка ЧПУ сделана в файле public/.htaccess под сервер apache
        //TODO new render and twigRender App::call()->render?
        //получаем имя класса контроллера объект которого мы должны создать
        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";
            ////ucfirst($controllerName) - делает заглавной первую букву для имени класса, пришедшего из url
        if (class_exists($controllerClass)) { //проверяем ведь данные пришли от пользователя
            $controller = new $controllerClass(App::call()->render); //через переменную переменных, создадим динамически объект класса по имени класса от пользователя
            //new $controllerClass(App::call()->twigRender); - в этом поле теперь можем переключать рендер. В скобочках создаётся объект класса рендер который рендерит шаблоны
            $controller->runAction($this->action);
        } else {
            echo "Не правильный контроллер";
        }
    }
    /*Создаётся контроллер в зависимости от того какую страницу хочет пользователь, находится нужный класс,
    создаётся его экземпляр, в нём вызывается метод Render
    При создании экземпляра в конструктор подставляется экземпляр Twig или Render*/


    public static function call() { //чисто для краткости чтобы писать call instead get instance
        return static::getInstance();
    }

    //создание компонента при обращении, возвращает объект для хранилища
    public function createComponent($name) {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if(class_exists($class)) {
                unset($params['class']); //очищаем парамс от лишнего значения имя класса
                //Воспользуемся библиотекой ReflectionClass для создания класса
                //просто return new $class нельзя(вроде потому что конструктор ДБ просит не в виде массива данные
                //т.к. не будут переданы параметры для конструктора
                $reflection = new \ReflectionClass($class);
                /* ReflectionClass - класс, встроенный в РНР и созданный специально для того,
                 чтобы было можно раскладывать другие классы на атомы
                через $reflection-> можно вызвать уйму методов
                Через него можно достать даже приватные методы*/
                return $reflection->newInstanceArgs($params); // в этом методе в конструктор для создания экземпляра класса ожидается передача
                //переменных именно в виде массива
            }
        }
        return null;
    }


    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    public function __get($name) {
        //магический метод гет позволяет нам перехватить обращение к компоненту APP,
        //App::call()->request->info() // request- которого ещё не существует в полях App
        return $this->components->get($name);
        //обратились к компоненту, который уже есть объект Storage и вызвали метод Storage get
    }

}