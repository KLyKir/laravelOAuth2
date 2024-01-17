<tr>
    <th scope="row">{{$event->id}}</th>
    <td>{{$event->title}}</td>
    <td>{{$event->notes}}</td>
    <td>{{$event->dt_start}}</td>
    <td>{{$event->dt_end}}</td>
    <td>{{$event->user->name}}</td>
    <td><a href = "{{route('event.show', ['id' => $event->id])}}">Show</a></td>
    @if(isset($user))
        <td><a href = "{{route('user.update.show.event', ['id' => $event->id])}}">Update</a></td>
    @else
        <td><a href = "{{route('event.show.update', ['id' => $event->id])}}">Update</a></td>
    @endif
    @can('delete-event', $event)
        @if(isset($user))
            <td><a href = "{{route('user.delete.event', ['id' => $event->id])}}">Delete</a></td>
        @else
            <td><a href = "{{route('event.delete', ['id' => $event->id])}}">Delete</a></td>
        @endif
    @endcan
</tr>

