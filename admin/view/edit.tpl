<section id="create">
    <div class="container create_block">
        <form id="edit" method="POST" action="#" enctype="multipart/form-data">
            <? foreach($taskArray as $task) {?>

                <div class="col-xs-12 item_field">
                    <label  class="col-xs-4" for="id_task">ID задачи: <? echo  $task['id']?> </label>
                    <input id="id_task" class="hidden" type="text" name="id_task" value="<? echo  $task['id']?>">
                </div>
                <div class="col-xs-12 item_field">
                    <label  class="col-xs-4" for="name">Название задачи</label>
                    <input id="name" type="text" name="name" value="<? echo  $task['name']?>">
                </div>
                <div class="col-xs-12 item_field">
                    <label class="col-xs-4" for="date">Дата </label>
                    <input id="date" type="date" name="date" value="<? echo date('Y-m-d')?>">
                </div>
                <div class="col-xs-12 item_field">
                    <label class="col-xs-4" for="email">Введите email:</label>
                    <input id="email" class="col-xs-4" type="text" name="email"  value="<? echo  $task['email']?>">
                </div>
                <div class="col-xs-12 item_field">
                    <div class="upload-file-container">
                        <img id="image" src="//app/uploads/images/<? echo  $task['img']?>" alt="" />
                        <div class="upload-file-container-text">
                            <label class="col-xs-4" for="img">Выберите картинку:</label>
                            <input id="img" class="col-xs-4" type="file" name="img" onchange="loadFile(event)">
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 item_field">
                    <label class="col-xs-4" for="status">Статус выполнения:</label>
                    <select name="status"  form="edit" size="1">
                        <? foreach($statusArray as $status){?>
                            <option id="status" class="col-xs-4"  name="status" value="<?echo $status['name']?>" <?if($task['status'] == $status['name']){?>selected<?}?>><?echo $status['name']?> </option>
                        <? } ?>
                    </select>
                </div>
                <div class="col-xs-12 item_field">
                    <label class="col-xs-4" for="text">Заполните задачу:</label>
                    <textarea id="textarea" class="col-xs-4 text_task"  name="text"  value=""><? echo  $task['text']?> </textarea>
                </div>
                <div class="col-xs-2">
                    <button class="save"  type="submit" name="submit">сохранить</button>
                </div>
                <div class="col-xs-3">
                    <div id="show_task"  class="preview" >Предварительный просмотр</div>
                </div>
            <? } ?>

        </form>
    </div>
</section>

<!-- Modal -->
<div class="back_modal"></div>
<div class="modal" id="modalPre" role="dialog">
    <div class="task_block col-xs-12">
        <div id="task">
            <p><span>Задача №:</span></p>
        </div>
        <div class="col-xs-2 task_img">
            <img src="" alt="">
        </div>
        <div class="info_block col-xs-10">
            <div id="name_modal"></div>
            <div id="email_modal"></div>
            <div id="date_modal"></div>
            <div id="status_modal"></div>
            <div id="text_modal" class="col-xs-12 text_area"></div>
        </div>
        <div class="col-xs-12">
            <div class="pull-right">Подробнее</div>
        </div>
    </div>
    <div class="close">+</div>
</div>



