
function show_task() {
    $name = $("#name").val();
    $date = $('#date').val();
    $email = $('#email').val();
    $image = $('#image').attr('src');
    $status = 'в процесе';
    $text = $('#textarea').val();

    var str = '<div id="id1"><span class="class1"> Текст1 </span> </div>';
    $('#task p').append('id вашей задачи');
    $('#name_modal').append($name);
    $('#email_modal').append($email);
    $('#date_modal').append($date);
    $('#status_modal').append($status);
    $('#text_modal').append($text);
    $('.task_img img').attr('src', $image);

}
$(document).ready(function(){

    $("#show_task").click(function(){
        $(".modal").show();
        $('.back_modal').show();
        show_task();
    });
    $(".close").click(function(){
        $(".modal").css({"display": 'none'});
        $(".back_modal").css({"display": 'none'});

    });


});

    var loadFile = function(event) {
        var output = document.getElementById('image');
        output.src = URL.createObjectURL(event.target.files[0]);
}




// $(document).click( function(event){
//     if( $(event.target).closest(".modal").length )
//         return;
//     $(".modal").css({'display': 'none'});
//     event.stopPropagation();
// });