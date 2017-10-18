<?php
namespace taskManager\system\core;

// главный контроллер, который определяет какие контролерры подключать и какие методы запускать
use taskManager\system\controllers\GeneralController;

// Основной клас по обработке URI
class Router
{
    private $routes;
    public function __construct()
    {
        $routes_path = PATH.'/system/config/routers.php';
        $this->routes = include($routes_path);       //наши шаблоны путей
    }

    //  получаемя текущий URI
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
           return urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        }
        return true;
    }
    //основная функция отображения (вызывается в index.php - единая точка доступа)
    public function index(){

        $uri = $this->getURI();
        // если страница главная, то вызываем метод startPage(), который получаем в TaskController;
        if($uri == '/')
        {
            $controller = new GeneralController();
            $controller->startPage();
        } elseif($uri == '/administrator'){         // если страница админитстратора,то вызываем метод admin(), который получаем с AdminController
            $controller = new GeneralController();
            $controller->admin($action = 'TaskList', $id=1);
        } else {
            foreach ($this->routes as $pattern => $path)
            {
                if(preg_match("~$pattern~", $uri)){     //определяем есть шаблоны путей в текущем URI

                    $internalRoute = preg_replace("~$pattern~", $path, $uri);
                    $segment = explode('/',$internalRoute );
                    $methodName= array_shift($segment);     // метод который будет запускаться в главном контроллере CeneralController
                    $parametrs = $segment;      // параметры которые мы передаем получаем из URI

                    $controller = new GeneralController();

                    $result = call_user_func_array(array($controller, $methodName), $parametrs);/* определяем какой контроллер из GeneralController запустить.
                                                                                                   $parametrs - это не просто параметры, вних передаются либо колво-отображаемых страниц,
                                                                                                   сортировка, либо какой метод будет наследован основными методами в GeneralController
                                                                                                */

                    exit;

                }
            }
        }




    }

}