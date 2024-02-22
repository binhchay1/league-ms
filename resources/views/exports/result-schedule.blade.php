<table>
    <thead>
        <tr>
            <th>Match</th>
            <th>Round</th>
        </tr>
    </thead>
    <tbody>
        @foreach($getSchedule as $schedule)
        <tr>
            <td>{{ $schedule->match }}</td>
            <td>{{ $schedule->round }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
