<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>In hóa đơn</title>
    <style>
        * {
            font-family: DejaVu Sans !important;
        }

        .invoice {
            width: 88%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 1.5rem;
        }

        .invoice .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice .header h1 {
            font-size: 24px;
            color: #333;
        }

        .invoice .info {
            margin-bottom: 20px;
        }

        .invoice .info .row {
            display: flex;
            justify-content: space-between;
        }

        .invoice .info .row .label {
            color: #777;
        }

        .invoice .table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice .table th,
        .invoice .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .invoice .table th {
            background-color: #f5f5f5;
        }

        .invoice .total {
            margin-top: 20px;
            text-align: right;
        }

        .label {
            color: #777;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="header">
            <h1 style="font-size: 1.2rem; margin: 0;">{{ $info->ResName }}</h1>
            <div style="margin: 0.8rem;">
                <p style="font-size: 0.7rem; margin: 0;">88 Lê Duẩn, TP Vinh, Nghệ An</p>
                <p style="font-size: 0.7rem; margin: 0;">ĐT: {{ $info->Hotline1 . ' ' . $info->Hotline2}}</p>
            </div>
            <h1 style="font-size: 1.2rem; margin: 0;">HÓA ĐƠN THANH TOÁN</h1>
        </div>
        <div class="info" style="font-size: 0.6rem; width: 100%;">
            <table style="font-size: 0.6rem; width:100%">
                <tbody>
                    <tr>
                        <td>
                            <label class="label">Ngày In:</label>
                            <label class="value">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</label>
                        </td>

                        <td style="text-align: right">
                            <label class="label">Số HĐ:</label>
                            <label class="value">{{ $IdOrder }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label">Khu:</label>
                            <label class="value">{{ $order->AreaName }}</label>
                        </td>
                        <td style="text-align: right">
                            <label class="label">Bàn:</label>
                            <label class="value">{{ $order->TableName }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label">Giờ vào:</label>
                            <label class="value">{{ date_format(new DateTime($order->TimeIn), 'H:i') }}</label>
                        </td>
                        <td style="text-align: right">
                            <label class="label">Giờ ra:</label>
                            <label class="value">{{ date_format(new DateTime($order->TimeOut), 'H:i') }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label">Thu ngân:</label>
                            <label class="value">{{ $order->FullNameCreate }}</label>
                        </td>
                        <td style="text-align: right">
                            <label class="label">Khách hàng:</label>
                            <label class="value">
                                @if ($order->IdCustomer !== null && $order->IdCustomer !== '')
                                    {{ $order->FullNameCreate }}
                                @else
                                    Khách lẻ
                                @endif
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="table" style="font-size: 0.6rem;">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th style="text-align: right">Đơn giá</th>
                    <th style="text-align: center">Số lượng</th>
                    <th style="text-align: right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $TotalQuantity = 0;
                @endphp
                @foreach ($listItems as $item)
                    @php
                        $TotalQuantity += $item->Quantity;
                    @endphp
                    <tr>
                        <td>{{ $item->ItemsName }}</td>
                        <td style="text-align: right">{{ number_format($item->PriceSale, 0, '.', ',') }} ₫</td>
                        <td style="text-align: center">{{ $item->Quantity }}</td>
                        <td style="text-align: right">{{ number_format($item->Amount, 0, '.', ',') }} ₫</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="label">Tổng cộng:</td>
                    <td class="value" style="text-align: center">{{ $TotalQuantity }}</td>
                    <td class="value" style="text-align: right">{{ number_format($order->TotalAmount, 0, '.', ',') }} ₫</td>
                </tr>
            </tfoot>
        </table>
        <div class="total">
            <label class="label">Tổng tiền:</label>
            <label class="value">{{ number_format($order->TotalAmount, 0, '.', ',') }} ₫</label>
        </div>
        <div class="header">
            <p style="font-size: 0.8rem; font-style: italic; margin: 1.5rem;">Cảm ơn quý khách - Hẹn gặp lại</p>
        </div>
    </div>

</body>

</html>
