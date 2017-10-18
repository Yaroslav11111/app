<?php

namespace taskManager\admin\models;

use taskManager\system\config\db;

class adminRoom
{
    const SHOW_BY_DEFAULT_ADMIN = 4;
    protected $login;
    protected $name;
    protected $company;
    protected $email;
    protected $parol;
    protected $api_key;
    protected $errors;
    protected $data;
    static protected $db;


    public function __construct()
    {
        self::$db = new db();
    }

    public function auth()
    {

        $this->data = $_POST;
        if (isset($this->data["do_login"])) {

            $this->login = $this->data["admin_name"];
            $this->errors = array();
            $user_search = self::$db->connect->query("SELECT * FROM `user` WHERE user.name = '$this->login' ");
            $user = $user_search->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($this->data['password'], $user['password'])) {
                    //Все норм, логиним

                    $_SESSION['logged_user'] = $user;
                    header("Location: /administrator");
                    die;
                    return true;


                } else {
                    $this->errors[] = 'Не верно введен пароль!';
                }
            } else {
                $this->errors[] = 'Пользователь с таким логином не найден!';
            }
            if (!empty($this->errors)) {
                echo '<div style="color: red;">' . array_shift($this->errors) . '</div>';
            }
        }


    }

    public static function getTasksListAdmin($page)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT_ADMIN;
        $default = self::SHOW_BY_DEFAULT_ADMIN;

        $tasks = [];
        $result = self::$db->connect->query("SELECT * FROM `task` ORDER by id ASC LIMIT $default OFFSET $offset");
        $i = 0;
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
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

    public static function getTotalTasksAdmin()
    {
        $resualt = self::$db->connect->query("SELECT COUNT(id) as count FROM task");
        $resualt->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $resualt->fetch();
        return $row['count'];
    }

    public static function redirect()
    {
        header("Location: /", true, 301);
        exit();
    }
    public static function logout()
    {
        session_destroy();
        unset($_SESSION['logged_user']);
        self::redirect();

    }

    public static function getTaskInfo($id)
    {

        $tasks = [];
        $result = self::$db->connect->query("SELECT * FROM `task` WHERE id = '$id'");
        $i = 0;
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
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

    public static function getStatus()
    {

        $tasks = [];
        $result = self::$db->connect->query("SELECT * FROM `status`");
        $i = 0;
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['en_name'] = $row['en_name'];

            $i++;
        }
        return $tasks;
    }

    public static function getEditTask($options)
    {
        $sth = self::$db->connect->prepare("UPDATE `task` SET `name` = :name, 
                                                                        `date` = :date, 
                                                                        `email` = :email, 
                                                                        `img` = :img, 
                                                                        `text` = :text, 
                                                                        `status` = :status 
                                                        WHERE `id` = :id");
        $prod_id = $options['id'];
        $prod_name = $options['name'];
        $prod_date = $options['date'];
        $prod_email = $options['email'];
        $prod_img = $options['img'];
        $prod_text = $options['text'];
        $prod_status = $options['status'];

        $sth->bindValue(':name', $prod_name);
        $sth->bindValue(':date', $prod_date);
        $sth->bindValue(':email', $prod_email);
        $sth->bindValue(':img', $prod_img);
        $sth->bindValue(':text', $prod_text);
        $sth->bindValue(':status', $prod_status);
        $sth->bindValue(':id', $prod_id);
        $sth->execute();

    }
}