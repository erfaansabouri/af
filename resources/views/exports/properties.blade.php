<table>
    <thead>
    <tr>
        <th>پلاک</th>
        <th>نام و نام خانوادگی</th>
        <th>شماره همراه</th>
        <th>نوع</th>
        <th>تاریخ شروع قرار داد</th>
        <th>تاریخ پایان قرار داد</th>
    </tr>
    </thead>
    <tbody>
    @foreach($properties as $property)
        <tr>
            <td>{{ $property->plaque }}</td>
            <td>{{ $property->full_name }}</td>
            <td>{{ $property->phone }}</td>
            <td>{{ $property->type }}</td>
            <td>{{ verta($property->started_at)->formatJalaliDate() }}</td>
            <td>{{ $property->ended_at ? verta($property->ended_at)->formatJalaliDate() : "-" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
