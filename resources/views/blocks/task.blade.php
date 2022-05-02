<tr data-id="{{ $task->id }}">
    <th scope="row">{{ $task->name }}</th>
    <td>
        <ul>
            <li>
                @if($task->status)
                    Задача выполнена
                @else
                    <a href="javascript:void(0);" class="btn btn-success">Сделано</a>
                @endif
            </li>
            <li><a href="javascript:void(0);" class="btn btn-danger @if(!$task->status) hide @endif">Удалить</a></li>
        </ul>
    </td>

</tr>
