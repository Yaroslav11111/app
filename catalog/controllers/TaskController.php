<?php
/**
 * Created by PhpStorm.
 * User: snizh
 * Date: 08.10.2017
 * Time: 0:26
 */

namespace taskManager\catalog\controllers;

use taskManager\system\config\db;
use taskManager\catalog\models\Tasks;
use taskManager\system\controllers\Pagination;

class TaskController
{
    protected $tasks;
    public $pattern_tpl;
    public   $taskArray = [];
    public $pagination;
    public $sort_order;
    public $href;
    public function __construct()
    {
        $this->tasks = new Tasks();
    }

    public function Tasks($page, $sort)
    {
        $this->taskArray =  Tasks::getTasksList($page, $sort);
        $total = Tasks::getTotalTasks();

        $this->pagination = new Pagination($total, $page, Tasks::SHOW_BY_DEFAULT, 'page-' );
        $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if($uri == '/')
        {
            $this->href = 'page-1';
        } else {
            $this->href = explode('/',$uri);
            $this->href = $this->href['1'];
        }
        $href = $this->href;


        if(preg_match("~/page-([0-9]+)/([a-z]+)-asc~", $uri)){
            $this->sort_order = 'desc';
        } else {
            $this->sort_order = 'asc';
        }

        $this->pattern_tpl =  (PATH.'/catalog/view/themes/Lite/taskList.tpl');
        return true;
    }

    public function Item($id) {
        $this->taskArray =   Tasks::getTaskById($id);
        $this->pattern_tpl =  (PATH.'/catalog/view/themes/Lite/taskView.tpl');
        return true;
    }
    public function Create()
    {
        $this->pattern_tpl =  (PATH.'/catalog/view/themes/Lite/createTask.tpl');

        if (isset($_POST['submit']))
        {

            $options['name'] = $_POST['name'];

            $options['date'] = $_POST['date'];
            $options['email'] = $_POST['email'];
            $options['img'] = $_FILES['img']['name'];
            $options['text'] = $_POST['text'];


            $errors = [];
            if(!isset($options['name']) || empty($options['name']))
            {
                $errors[] = 'Заполните имя';
            } elseif(!isset($options['date']) || empty($options['date']))
            {
                $errors[] = 'Заполните дату';
            }elseif(!isset($options['email']) || empty($options['email']))
            {
                $errors[] = 'Заполните email';
            }
            if(empty($errors)){
                Tasks::createTask($options);
            } else {
                echo '<div style="color: red;">' . array_shift($errors) . '</div>';
            }

            if(is_uploaded_file($_FILES['img']['tmp_name']))
            {
                $fileName = basename($_FILES['img']['name']);
                copy($_FILES['img']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/uploads/images/".$_FILES['img']['name']);
            }

            //Функция по сжатию изображений, но я ее отключил, так как нет проверки на размер изображения, но она работает
            //просто сжимает все изображения входящие
//            function imageresize($outfile,$infile,$neww,$newh,$quality) {
//
//                $im=imagecreatefromjpeg($infile);
//                $im1=imagecreatetruecolor($neww,$newh);
//                imagecopyresampled($im1,$im,0,0,0,0,$neww,$newh,imagesx($im),imagesy($im));
//
//                imagejpeg($im1,$outfile,$quality);
//                imagedestroy($im);
//                imagedestroy($im1);
//            }
//
//            imageresize($_SERVER['DOCUMENT_ROOT']."/uploads/images/resized".$_FILES['img']['name'],$_SERVER['DOCUMENT_ROOT']."/uploads/images/".$_FILES['img']['name'],320,240,75);




        }

        return true;

    }
    public function Edit()
    {
        //если надо будет добавить редактирования для пользователя

    }
    public function delete()
    {
        //если надо будет добавить удаление для пользователя

    }
}