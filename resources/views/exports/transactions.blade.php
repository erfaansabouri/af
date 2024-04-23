<table>
    <thead>
    <tr>
        <th>شناسه سیستم</th>
        <th>موضوع</th>
        <th>پلاک</th>
        <th>موبایل</th>
        <th>نام کاربر</th>
        <th>شماره سفارش</th>
        <th>وضعیت</th>
        <th>تاریخ و ساعت</th>
        <th>مبلغ اصلی</th>
        <th>مبلغ پرداختی</th>
        <th>مبلغ تخفیف</th>
        <th>مبلغ جریمه</th>
        <th>درصد تخیف</th>
        <th>درصد جریمه</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->subject }}</td>
            <td>{{ $transaction->tenant->plaque }}</td>
            <td>{{ $transaction->tenant->phone_number }}</td>
            <td>{{ $transaction->tenant->name }} - {{ $transaction->tenant->full_name }}</td>
            <td>{{ $transaction->ref_id }}</td>
            <td>پرداخت شده</td>
            <td>{{ verta($transaction->paid_at)->format('Y-m-d H:i:s') }}</td>
            <td>{{ number_format($transaction->original_amount) }}</td>
            <td>{{ number_format($transaction->amount) }}</td>
            <td>{{ number_format($transaction->discountAmount()) }}</td>
            <td>{{ number_format($transaction->penaltyAmount()) }}</td>
            <td>{{ number_format($transaction->discountPercent()) }}</td>
            <td>{{ number_format($transaction->penaltyPercent()) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
