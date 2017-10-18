<?php
namespace taskManager\catalog\models;

use taskManager\system\config\db;

class Tasks
{
    const SHOW_BY_DEFAULT = 3;
    static private $db;
    static protected $sort;
    static protected $sortname;
    public function __construct()
    {
        self::$db = new db();
    }
    public static function getTasksList($page, $sort )
    {
        $page= intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $default = self::SHOW_BY_DEFAULT;
        $sortArray = [];
        $sortArray = explode('-', $sort);

        self::$sortname = $sortArray[0];
        self::$sort = $sortArray[1];

        $tasks = [];
        $result = self::$db->connect->query("SELECT * FROM `task` ORDER by ".self::$sortname." ".self::$sort."  LIMIT $default OFFSET $offset") ;
        $i=0;
        while ($row = $result->fetch(\PDO::FETCH_ASSOC))
        {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['email'] = $row['email'];
            $tasks[$i]['date'] = $row['date'];
            $tasks[$i]['text'] = $row['text'];
            $tasks[$i]['img'] = $row['img'];
            $tasks[$i]['status'] = $row['status'];
            $i++;
        }

        return $tasks;


    }
    public static function  getTaskById($id)
    {
        $task= '';
        $result = self::$db->connect->query("SELECT `id`, name, `email`, `text`, `img`, `status` FROM `task` WHERE id = '$id'");
        $task = $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $task;

    }
    public static function createTask($options)
    {
        $i=0;
        $value = array();
        foreach ($options as $key => $option) {
            $value[] = ':' . $key ;
            $i++;
        }
        $string[$i] = '(' . implode(',', $value) . ')';



        $sql="insert into `task` (`name`, `date`, `email`, `img`, `text`) values " . implode(',', $string);
        $sth= self::$db->connect->prepare($sql);




        $prod_name = $options['name'];
        $prod_date = $options['date'];
        $prod_email = $options['email'];
        $prod_img = $options['img'];
        $prod_text = $options['text'];


        $sth->bindValue(':name', $prod_name);
        $sth->bindValue(':date', $prod_date);
        $sth->bindValue(':email', $prod_email);
        $sth->bindValue(':img', $prod_img);
        $sth->bindValue(':text', $prod_text);


        $sth->execute();

    }
    public  static function getTotalTasks(){
        $resualt = self::$db->connect->query("SELECT COUNT(id) as count FROM task");
        $resualt->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $resualt->fetch();
        return $row['count'];
    }
}