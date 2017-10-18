<?php
/*
 *  routes
 * all methods was used from GeneralController
 * */
return array (


    "/administrator/page-([0-9]+)" => "admin/TaskList/$1",
    "/administrator/([a-z]+)/([0-9]+)" => "admin/$1/$2",
    "/administrator/logout" => "admin/logout",
    "/task/([a-z]+)" => "task/$1",
    "/page-([0-9]+)" => "startPage/$1",
    "/page-([0-9]+)/([a-z]+)-asc" => "startPage/$1/$2",
    "/page-([0-9]+)/([a-z]+)-desc" => "startPage/$1/$2",

    "/task/([a-z]+)/([0-9]+)" => "task/$1/$2"

);