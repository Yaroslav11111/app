<section id="task_List">

    <div class="container task_list">
        <div class=" sort">
            Сортировать по: <strong>Имени</strong>/ <strong>Email</strong>/ <strong>Статусу</strong>
        </div>
        <ul>
            <? foreach( $taskArray as $key => $task) {
                ?>
                <li>
                    <div class="task_block col-xs-12">
                        <div id="task">
                            <p><a href="task/item/<? echo $task['id'] ?>"><span>Задача №:</span><? echo $task['id'] ?></a></p>
                        </div>
                        <div class="col-xs-2 task_img">
                            <img src="/uploads/images/<? echo $task['img'] ?>" alt="">
                        </div>
                        <div class="info_block col-xs-10">
                            <div id="name" class="col-xs-12">
                                <div class="col-xs-3 ">Название:</div>
                                <div class="col-xs-3 item_value">  <? echo $task['name'] ?></div>
                            </div>

                            <div id="email" class="col-xs-12">
                                <div class="col-xs-3">email:</div>
                                <div class="col-xs-3 item_value">  <? echo $task['email'] ?></div>
                            </div>
                            <div id="date" class="col-xs-12">
                                <div class="col-xs-3">Дата создания:</div>
                                <div class="col-xs-3 item_value">  <? echo $task['date'] ?></div>
                            </div>
                            <div id="status" class="col-xs-12">
                                <div class="col-xs-3">Статуc выполнения:</div>
                                <div class="col-xs-3 item_value">  <? echo $task['status'] ?></div>
                            </div>
                            <div id="text" class="col-xs-12 text_area">
                                <? echo $task['text'] ?>
                            </div>
                        </div>

                        <div class="col-xs-12 edit_view">

                            <div class="more pull-right"><a href="http://app/administrator/edit/<? echo $task['id'] ?>">Редактировать</a></div>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
    </div>
</section>
<div class="container ">
    <? echo $pagination->get(); ?>
</div>
