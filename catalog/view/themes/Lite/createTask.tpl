<section id="create">
    <div class="container create_block">
        <form method="POST" action="/task/create" enctype="multipart/form-data">

           <div class="col-xs-12 item_field">
               <label  class="col-xs-4" for="name">Название задачи</label>
               <input id="name" type="text" name="name">
           </div>
            <div class="col-xs-12 item_field">
                <label class="col-xs-4" for="date">Дата (нельзя изменить)</label>
                <input id="date" type="date" name="date" value="<? echo date('Y-m-d')?>">
            </div>
            <div class="col-xs-12 item_field">
                <label class="col-xs-4" for="email">Введите email:</label>
                <input id="email" class="col-xs-4" type="text" name="email">
            </div>
            <div class="col-xs-12 item_field">
                <div class="upload-file-container">
                    <img id="image" src="//app/catalog/view/themes/Lite/img/missing_image.png" alt="" />
                    <div class="upload-file-container-text">
                        <label class="col-xs-4" for="img">Выберите картинку:</label>
                        <input id="img" class="col-xs-4" type="file" name="img" onchange="loadFile(event)">
                    </div>
                </div>

            </div>
            <div class="col-xs-12 item_field">
                <label class="col-xs-4" for="text">Заполните задачу:</label>
                <textarea id="textarea" class="col-xs-4 text_task"  name="text"> </textarea>
            </div>
            <div class="col-xs-2">
                <button class="save"  type="submit" name="submit">сохранить</button>
            </div>
            <div class="col-xs-3">
                <div id="show_task"  class="preview" >Предварительный просмотр</div>
            </div>
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
            <div  class="col-xs-12">
                <div class="col-xs-3 ">Название:</div>
                <div id="name_modal" class="item_value"></div>
            </div>
            <div  class="col-xs-12">
                <div class="col-xs-3 ">email:</div>
                <div id="email_modal" class="item_value"></div>
            </div>
            <div  class="col-xs-12">
                <div class="col-xs-3 ">дата создания:</div>
                <div id="date_modal" class="item_value"></div>
            </div>
            <div  class="col-xs-12">
                <div class="col-xs-3 ">Статус:</div>
                <div id="status_modal" class="item_value"></div>
            </div>
            <div id="text_modal" class="col-xs-12 text_area"></div>
        </div>
        <div class="col-xs-12">
            <div class="more pull-right">Подробнее</div>
        </div>
    </div>
    <div class="close">+</div>
</div>


