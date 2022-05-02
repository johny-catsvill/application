<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body id="#app">


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Events</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        @include('blocks.task')
    @endforeach
    </tbody>
</table>

<hr>

<form action="{{ route('create-task') }}">
    @csrf

    <input type="text" name="name" placeholder="task name...">

    <input class="btn-create-task" type="submit" name="submit" placeholder="Создать">
</form>


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>

    $('.btn-create-task').click(function (e) {
        e.preventDefault()
        var el = $(this)

        var data = el.closest('form')

        $.ajax({
            type: 'post',
            url: '/create-task',
            data: data.serialize()
        })

    })

    $('.btn-danger').click(function () {
        var el = $(this)
        var id = el.closest('tr').data('id')

        $.ajax({
            type:'get',
            url: '/remove-task',
            data: {id}
        })

    })

    $('.btn-success').click(function () {
        var el = $(this)
        var id = el.closest('tr').data('id')

        $.ajax({
            type:'get',
            url: '/change-status-task',
            data: {id}
        })

    })


    var echoInstance = Echo.join('todo')


    echoInstance.listen('CreateTaskEvent', function (e) {

        $('table tbody').append(e.html)

    }).listen('ChangeStatusTaskEvent', function (e) {
        var row = $('body').find('table').find('tr[data-id="'+ e.taskId +'"]')

        row.find('.btn-success').closest('li').text('Задача выполнена')
        console.log(row)
        row.find('.hide').removeClass('hide')
    }).listen('RemoveTaskEvent', function (e) {
        var row = $('body').find('table').find('tr[data-id="'+ e.taskId +'"]')

        row.remove()
    })


</script>

<style>
    .hide {
        display: none;
    }
</style>
</body>
</html>
