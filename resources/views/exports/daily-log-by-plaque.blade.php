<table>
    <thead>
    <tr>
        <th>پلاک</th>
        <th>تاریخ</th>
        <th>زمان</th>
        <th>وضعیت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($daily_logs as $daily_log)
        <tr>
            <td>{{ $daily_log->tenant_id }}</td>
            <td>{{ verta($daily_log->date)->formatJalaliDate() }}</td>
            <td>{{ $daily_log->time }}</td>
            <td>{{ $daily_log->status }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
