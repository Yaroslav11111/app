<?php
/**
 * Created by PhpStorm.
 * User: snizh
 * Date: 07.10.2017
 * Time: 20:43
 */

namespace taskManager\system\controllers;

use taskManager\catalog\controllers\TaskController;
use taskManager\admin\controllers\AdminController;
use taskManager\catalog\models\Tasks;

class GeneralController
{
    protected $task;
    protected $admin;
    public $main_pattern_tpl = (PATH.'/catalog/view/main.tpl');
    public $content;
    public function __construct()
    {
        $this->task = new TaskController();
        $this->admin = new AdminController();
    }

    public function startPage($page = 1, $sort = 'name-asc'){

        require_once  $this->main_pattern_tpl;
        $this->task->Tasks($page, $sort);
        $taskArray = [];
        $taskArray =  $this->task->taskArray;
        $this->content = $this->task->pattern_tpl;
        $pagination = $this->task->pagination;
        $sort = $this->task->sort_order;
        $href = $this->task->href;
        $content =  include $this->content;

        return true;
    }
    // эта функция определяет какой метод нужно запустить из AdminController и какие данные передать в этот метод
    public function admin($action = null, $id = NULL){


        if(!isset($_SESSION['logged_user']['role']) || empty($_SESSION['logged_user']['role']))
        {

            $this->admin->adminAuth();
            require_once  $this->main_pattern_tpl;
            $this->content = $this->admin->pattern_tpl;
            $content =  include $this->content;
            return true;

        } elseif (isset($_SESSION['logged_user']['role']) || !empty($_SESSION['logged_user']['role'])) {
            $this->admin->$action($id);
            require_once  $this->main_pattern_tpl;

            $this->content = $this->admin->pattern_tpl;
            $taskArray = [];
            $taskArray =  $this->admin->taskArray;
            $statusArray = [];
            $statusArray = $this->admin->status;
            $pagination = $this->admin->pagination;
            $content =  include $this->content;

            return true;
        }
    }
    // эта функция определяет какой метод нужно запустить из TaskController и какие данные передать в этот метод
    public function task($action, $id = NULL)
    {
        require_once  $this->main_pattern_tpl;
        $this->task->$action($id);
        $taskArray = [];
        $taskArray[] =  $this->task->taskArray;
        $this->content = $this->task->pattern_tpl;
        $content =  include $this->content;


    }
}