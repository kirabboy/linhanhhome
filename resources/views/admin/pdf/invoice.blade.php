<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hóa đơn</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .top-left {
        border: 2px solid #ccc;
        background-color: #fff;
        width: 300px;
        height: auto;
    }

    * {
        font-family: DejaVu Sans !important;
    }

    td,
    .table thead th {
        vertical-align: center;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    table {
        border-collapse: collapse;
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px;
    }

    .table thead th {
        vertical-align: center;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .table td,
    .table th {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table-borderless tbody+tbody,
    .table-borderless td,
    .table-borderless th,
    .table-borderless thead th {
        border: 0;
    }
</style>

<body>
    <div>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <p style="font-size: 24px"><strong>Tên hóa đơn: Hóa đơn hợp đồng {{ $invoice->contract->code }}
                                {{ date('m/Y') }} </strong></p>
                    </th>
                    <th style="text-align: right;">
                        <p style="font-size: 24px;margin-bottom: 0px;"><strong>Mã hóa đơn:
                                HOADON-{{ $invoice->contract->code }}-{{ date('m/Y') }}</strong></p>
                    </th>
                </tr>
            </thead>
        </table>
        <p style="font-size: 32px; text-align: center;"><strong>Thông tin hóa đơn</strong></p>
        <div class="col-12 font-weight-bold">
            <p><strong>Thông tin phòng: {{ $invoice->contract->room->building->name }} -
                    {{ $invoice->contract->room->floor->name }} - {{ $invoice->contract->room->name }}</strong></p>
            <p><strong>Tên Khách hàng: {{ $invoice->contract->customers[0]->fullname }}
                </strong></p>
            <p><strong>Hạn thanh toán: {{ date('d/m/Y', strtotime($invoice->date_expired)) }}
                </strong></p>
        </div>

        <table class="table table-bordered" style="margin-top: 30px">
            <thead>
                <tr>
                    <th>Dịch vụ</th>
                    <th>Số lượng</th>
                    <th>Tiêu thụ</th>
                    <th>Đơn giá</th>
                    <th>Đơn vị</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Phí thuê nhà </td>
                    <td> {{ $invoice->contract->contractinfo->number_room }} </td>
                    <td> {{ $invoice->contract->contractinfo->number_room }} </td>
                    <td>{{ number_format($invoice->contract->contractinfo->price_room) }}</td>
                    <td>tháng</td>
                    <td>{{ number_format($invoice->contract->contractinfo->number_room * $invoice->contract->contractinfo->price_room) }}</td>
                </tr>
                @foreach ($invoice->contract->service_detail as $item)
                <tr>
                    <td>{{ formatContractService($item->type) }}</td>
                    <td>{{ $invoice->contract->contractinfo->number_electric }}</td>
                    <td>{{ $item->end_number - $item->start_number }}</td>
                    </td>
                    <td>{{ number_format($item->type == 1 ? $invoice->contract->contractinfo->price_electric : $invoice->contract->contractinfo->price_water) }}
                    </td>
                    <td>{{ $item->type == 1 ? 'Kwh' : ($invoice->contract->contractinfo->type_water == 1 ? 'tháng' : 'm3') }}
                    </td>
                    <td>{{ number_format(($item->end_number - $item->start_number) * ($item->type == 1 ? $invoice->contract->contractinfo->price_electric : $invoice->contract->contractinfo->price_water)) }}
                    </td>
                </tr>
                @endforeach
                @if ($invoice->contract->contractinfo->type_water == 1)
                <tr>
                    <td>Phí nước</td>
                    <td>{{ $invoice->contract->contractinfo->number_water }}
                    </td>
                    <td>{{ $invoice->contract->contractinfo->number_water }}</td>
                    </td>
                    <td>{{ number_format($invoice->contract->contractinfo->price_water) }}</td>
                    <td>tháng</td>
                    <td>
                        {{ number_format($invoice->contract->contractinfo->number_water * $invoice->contract->contractinfo->price_water) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td>Phí dịch vụ</td>
                    <td>{{ $invoice->contract->contractinfo->number_service }}
                    </td>
                    <td>{{ $invoice->contract->contractinfo->number_service }}</td>
                    </td>
                    <td>{{ number_format($invoice->contract->contractinfo->price_service) }}</td>
                    <td>tháng</td>
                    <td>{{ number_format($invoice->contract->contractinfo->number_service * $invoice->contract->contractinfo->price_service) }}
                    </td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:left">Tổng cộng</th>
                    <td> {{ number_format($invoice->total) }} </td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:left">Đã thanh toán</th>
                    <td> {{ number_format($invoice->amount_paid) }} </td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:left">Còn lại</th>
                    <td> {{ number_format($invoice->amount_rest) }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>