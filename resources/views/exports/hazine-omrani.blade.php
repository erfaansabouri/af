<table>
    <thead>
    <tr>
        <th>پلاک</th>
        <th>مبلغ هزینه عمرانی پرداخت شده</th>
        <th>مبلغ هزینه عمرانی باقی مانده بدون تخفیف و جریمه</th>
        <th>کل</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->plaque }}</td>
            <td>{{ $tenant->hazineOmranis->whereNotNull('paid_at')->sum('paid_amount') }}</td>
            <td>{{ $tenant->hazineOmranis->whereNull('paid_at')->sum('original_amount') }}</td>
            <td>{{ $tenant->hazineOmranis->sum('original_amount') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
