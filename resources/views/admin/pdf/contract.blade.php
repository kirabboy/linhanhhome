<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hợp đồng</title>
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
        <p style="font-size: 28px; text-align: center;"><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
        <p style="text-align: center;">Độc lập - Tự do - Hạnh phúc</p>
        <p style="text-align: right;">...............,ngày .... tháng .... năm .......</p>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <p style="font-size: 24px;margin-bottom: 0px;"><strong>Mã hợp đồng:
                                {{ $contract->code }}</strong></p>
                    </th>
                    <th style="text-align: right;">
                        <p style="font-size: 24px"><strong></strong></p>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-borderless" style="margin-top: 30px">
            <tr>
                <td>
                    <p style="font-size: 24px;"><strong>BÊN CHO THUÊ(Bên A):</strong></p>
                </td>
                <td>
                    <p style="font-size: 24px;"><strong>BÊN THUÊ(Bên B):</strong></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Họ và tên:................................................</p>
                </td>
                <td>
                    <p>Họ và tên:................................................</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>CMND/CCCD:........................... Nơi cấp:........................ Ngày
                        cấp...........................</p>
                </td>
                <td>
                    <p>CMND/CCCD:........................... Nơi cấp:........................ Ngày
                        cấp...........................</p>
                </td>
            </tr>
        </table>



        <p style="font-size: 32px; text-align: center;"><strong>THÔNG TIN HỢP ĐỒNG</strong></p>
        <div class="col-12 font-weight-bold">
            <p><strong>Thông tin phòng: {{ $contract->room->building->name }} -
                    {{ $contract->room->floor->name }} - {{ $contract->room->name }}</strong></p>
            <p><strong>Ngày bắt đầu: {{ date('d/m/Y', strtotime($contract->time_start)) }} - Ngày kết thúc:
                    {{ date('d/m/Y', strtotime($contract->time_end)) }}
                </strong></p>
        </div>

        <table class="table table-bordered" style="margin-top: 30px">
            <thead>
                <tr>
                    <th>Dịch vụ</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Đơn vị</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Phí thuê nhà </td>
                    <td> {{ $contract->contractinfo->number_room }} </td>
                    <td>{{ number_format($contract->contractinfo->price_room) }}</td>
                    <td>tháng</td>
                    <td>{{ number_format($contract->contractinfo->number_room * $contract->contractinfo->price_room) }}
                    </td>
                </tr>
                <tr>
                    <td>Phí nước</td>
                    <td>{{ $contract->contractinfo->number_water }}
                    </td>
                    </td>
                    <td>{{ number_format($contract->contractinfo->price_water) }}</td>
                    <td>tháng</td>
                    <td>
                        {{ number_format($contract->contractinfo->number_water * $contract->contractinfo->price_water) }}
                    </td>
                </tr>
                <tr>
                    <td>Phí điện</td>
                    <td>{{ $contract->contractinfo->number_electric }}
                    </td>
                    </td>
                    <td>{{ number_format($contract->contractinfo->price_electric) }}</td>
                    <td>kWh</td>
                    <td>
                        {{ number_format($contract->contractinfo->number_electric * $contract->contractinfo->price_electric) }}
                    </td>
                </tr>
                <tr>
                    <td>Phí dịch vụ</td>
                    <td>{{ $contract->contractinfo->number_service }}
                    </td>
                    </td>
                    <td>{{ number_format($contract->contractinfo->price_service) }}</td>
                    <td>tháng</td>
                    <td>{{ number_format($contract->contractinfo->number_service * $contract->contractinfo->price_service) }}
                    </td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align:left">Tổng cộng</th>
                    <td> {{ number_format($contract->contractinfo->number_room * $contract->contractinfo->price_room + $contract->contractinfo->number_water * $contract->contractinfo->price_water + $contract->contractinfo->number_service * $contract->contractinfo->price_service + $contract->contractinfo->number_electric * $contract->contractinfo->price_electric) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td style="text-align:center">
                        <p style="font-weight: bold;">BÊN CHO THUÊ</p>
                        <small><i>(Ký họ tên)</i></small>
                    </td>
                    <td style="text-align:center">
                        <p style="font-weight: bold;">BÊN THUÊ</p>
                        <small><i>(Ký họ tên)</i></small>
                    </td>
                    
                </tr>
            </thead>
        </table>
    </div>

</body>

</html>