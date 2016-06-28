function addComment() {

    var name = $('#name').val();
    var text = $('#text').val();

    if (name === '' || text === '') {
        alert('Заполните все поля!');
        return false;
    }

    $.ajax({
        type: 'POST',
        url: 'add.php',
        data: {name: name, text: text, parent_id: 0},
        success: function (data) {
            $("ul.commentslist").prepend(
                "<li class='comment'>" +
                "<div class='name'> + data.name + </div>" +
                "<div class='date'> + data.date + </div>" +
                "<p class='comment_text'> + data.text + </p>" +
                "<a href='/' class='delete' id='" + data.parent_id + "'>Delete</a>" +
                "<a href='/' class='reply' id='" + data.parent_id + "'>Reply</a>"
            );
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
}
$(document).ready(function () {

    $('a.reply').click(function () {

        var id = $(this).attr('id');

        $(this).parent().append(
            "<div id='form'>" +
            "<input type='text' name='name' id='name_reply' placeholder='Your name' required>" +
            "<textarea name='text' id='text_reply' placeholder='Your text' required></textarea>" +
            "<input type='hidden' name='parent_id' id='parent_id' value='" + id + "'>" +
            "<button id='add'>Add</button>" +
            "</div>");

        $('button').click(function () {
            var name = $('#name_reply').val();
            var text = $('#text_reply').val();
            var parent_id = id;

            if (name === '' || text === '') {
                alert('Заполните все поля!');
                return false;
            }

            $('#form').hide();
            $.ajax ({
                url: 'add.php',
                type: 'POST',
                dataType: 'json',
                data: {name: name, text: text, parent_id: parent_id},
                success: function (data) {
                    $(this).prev().append(
                        "<li class='comment'>" +
                        "<div class='name'> + data.name + </div>" +
                        "<div class='date'> + data.date + </div>" +
                        "<p class='comment_text'> + data.text + </p>" +
                        "<a href='/'  class='delete' id='" + data.parent_id + "'>Delete</a>" +
                        "<a href='/'  class='reply' id='" + data.parent_id + "'>Reply</a>"
                    );
                }
            });
        });
    });

    $('a.delete').click(function () {

        var id = $(this).attr('id');

        $.ajax ({
            url: 'remove.php',
            type: 'POST',
            data: {id: id},
            success: $(this).parent().remove()
    });
    });
});