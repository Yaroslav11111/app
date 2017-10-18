<?php


namespace taskManager\admin\controllers;

use taskManager\admin\models\adminRoom;
use taskManager\system\controllers\Pagination;

class AdminController
{
    protected $room;
    public $pattern_tpl;
    public $taskArray;
    public $pagination;
    public $status;
    public function __construct()
    {
        $this->room = new adminRoom();
    }

    public function adminAuth()
    {
        $this->room->auth();
        $this->pattern_tpl =  (PATH.'/admin/view/auth.tpl');
        return true;

    }
    public function logout()
    {
      adminRoom::logout();
    }
    public function TaskList($page)
    {
        $this->taskArray = adminRoom::getTasksListAdmin($page);
        $total = adminRoom::getTotalTasksAdmin();

        $this->pagination = new Pagination($total, $page, adminRoom::SHOW_BY_DEFAULT_ADMIN, 'page-' );

        $this->pattern_tpl =  (PATH.'/admin/view/tasklist.tpl');
        return true;
    }
    public  function edit($id)
    {
        $this->status = adminRoom::getStatus();
        $this->taskArray = adminRoom::getTaskInfo($id);

        $this->pattern_tpl =  (PATH.'/admin/view/edit.tpl');

        if (isset($_POST['submit']))
        {
            $options['id'] = $_POST['id_task'];
            $options['name'] = $_POST['name'];

            $options['date'] = $_POST['date'];
            $options['email'] = $_POST['email'];
            $options['img'] = $_FILES['img']['name'];
            $options['text'] = $_POST['text'];
            $options['status'] = $_POST['status'];


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
                adminRoom::getEditTask($options);
            } else {
                echo '<div style="color: red;">' . array_shift($errors) . '</div>';
            }

            if(is_uploaded_file($_FILES['img']['tmp_name']))
            {
                $fileName = basename($_FILES['img']['name']);
                copy($_FILES['img']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/uploads/images/".$_FILES['img']['name']);
            }


        }

        return true;

    }
}