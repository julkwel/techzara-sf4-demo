$('.datetime').datetimepicker({
    uiLibrary: 'bootstrap', modal: true, footer: true,
    format: 'yyyy-mm-dd HH:MM'
});

$('.modal').on('shown.bs.modal', function () {
    $('.datetime').datetimepicker({
        modal: true, footer: true,
        format: 'yyyy-mm-dd HH:MM'
    });
});

function addTodo(url) {
    $.ajax({
        url: url,
        success: function (data) {
            $('.modal-body').html(data);
            $('.modal-title').html('<h2 class="text-center">Add new task</h2>')
        }
    });

    $(document).on('click', '#add', function () {
        $.ajax({
            type: 'POST',
            url: url,
            data: $('#formdata').serializeArray(),
            dataType: 'json',
        })
    })
}

function modifierTodo(url) {
    $.ajax({
        url: url,
        success: function (data) {
            $('.modal-body').html(data);
            $('.modal-title').html('<h2 class="text-center">Edit task</h2>')
        }
    });

    $(document).on('click', '#edit', function () {
        $.ajax({
            type: 'POST',
            url: url,
            data: $('#formdata').serializeArray(),
            dataType: 'json',
        }).done(function () {
            location.reload()
        }).fail(function () {
            alert("Une erreur se produite!")
        });
    })
}