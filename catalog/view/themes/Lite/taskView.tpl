<section id="view_task">
    <div class="container task_item">
          <? foreach ($taskArray as $item){ ?>
                <div class="col-xs-2 task_img">
                    <img src="/uploads/images/<? echo $item['img'] ?>" alt="">
                </div>
               <div class="col-xs-10">
                   <div>  <p><h1>Название задачи: <? echo $item['name']?></h1></p></div>
                  <div class="col-xs-12">
                      <div class="col-xs-3"><p> id-задачи:</p></div>
                      <div class="col-xs-3 item_value"><p><? echo $item['id']?></p></div>
                  </div>
                   <div class="col-xs-12">
                   <div class="col-xs-3"><p>email:</p></div>
                   <div class="col-xs-3 item_value"><p><? echo $item['email']?></p></div>
                   </div>
                   <div class="col-xs-12">
                   <div class="col-xs-3"><p>статус выполнения:</p></div>
                   <div class="col-xs-3 item_value"><p><? echo $item['status']?></p></div>
                   </div>
                   <div class="col-xs-12 text_area" ><p><? echo $item['text']?></p></div>
               </div>
            <? } ?>
    </div>
</section>