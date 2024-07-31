<table>
    <thead>
    <tr>
        <th>پلاک</th>
        <th>تعداد اخطار</th>
        <th>مبلغ شارژ عقب افتاده</th>
        <th>مبلغ بدهی</th>
        <th>مبلغ شارژ ثابت ماهیانه</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->plaque }}</td>
            <td>{{ $tenant->warnings()->count() }}</td>
            <td>{{ $tenant->passed_due_date_amount }}</td>
            <td>{{ $tenant->debts()->notPaid()->sum('amount') }}</td>
            <td>{{ $tenant->monthly_charge_amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
