<!DOCTYPE html>
<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<h2>Items Ordered</h2>

<table class="table table-striped">
<thead>
<tr>
    <th>SKU</th>
    <th>Costume Name</th>
    <th>Original Price</th>
    <th>Qty</th>
    <th>Price</th>
</tr>
</thead>
<tbody>
@foreach($mail_order['items'] as $items)

<tr>
    <td>{{$items['sku']}}</td>
    <td>{{$items['costume_name']}}</td>
    <td>$ {{number_format($items['price'], 2, '.', ',')}}</td>
    <td>{{$items['qty']}}</td>
    <td>$ {{number_format(($items['price']*$items['qty']), 2, '.', ',')}}</td>
</tr>
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Subtotal</td>
    <td>${{number_format($mail_order['subtotal'], 2, '.', ',')}}</td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Shipping</td>
    <td>${{number_format($mail_order['shipping'], 2, '.', ',')}}</td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Store Credits</td>
    <td>-${{number_format($mail_order['store_credits'], 2, '.', ',')}}</td>
</tr>
<tr>
<tr style="background: white">
    <td></td>
    <td></td>
    <td></td>
    <td>Total Paid</td>
    <td>${{number_format($mail_order['total'], 2, '.', ',')}}</td>
</tr>
</tbody>
</table>

</body>
</html>
