<table>
    <thead>
    <tr>
        <th>پلاک</th>
        <th>توضیح</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->plaque }}</td>
            <td>عدم پرداخت شارژ ماه {{ $month }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
