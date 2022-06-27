<html>

<body
    style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
    <table
        style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
        <thead>
            <tr>
                <th style="text-align:left;"><img style="max-width: 150px;"
                        src="https://mevivu.com/wp-content/uploads/2016/11/logomevivumoi.png" alt="bachana tours"></th>
                <th style="text-align:right;font-weight:400;">{{ date('H:i:s d/m/Y') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="height:35px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                    <p style="font-size:14px;margin:0 0 6px 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:150px">Mã hóa đơn</span><b
                            style="color:green;font-weight:normal;margin:0">{{ $content->invoice->code }}</b></p>
                    <p style="font-size:14px;margin:0 0 6px 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:146px">Tên hóa đơn</span>
                        {{ $content->invoice->name }}</p>
                    <p style="font-size:14px;margin:0 0 0 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:146px">Giá trị</span>
                        {{ formatPrice($content->invoice->total) }}</p>
                </td>
            </tr>
            <tr>
                <td style="height:35px;"></td>
            </tr>
            <tr>
                <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px">Tòa nhà</span>
                        {{ $content->contract->room->building->name }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Phòng</span>
                        {{ $content->contract->room->name }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Tên hợp đồng</span>
                        {{ $content->contract->name }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Mã hợp đồng</span>
                        {{ $content->contract->code }}</p>
                </td>
                <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Khách hàng</span>
                        {{ $content->contract->contract_customer[0]->customer->fullname }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Số điện thoại</span>
                        {{ $content->contract->contract_customer[0]->customer->phone }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Email</span>
                        {{ $content->contract->contract_customer[0]->customer->email }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Thông tin dịch vụ cần thanh toán</td>
            </tr>
            <tr>
                <td colspan="2" style="padding:15px;">
                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                        <span style="display:block;font-size:13px;font-weight:normal;">Tiền nhà</span>
                        {{ formatPrice($content->invoice->amount_room) }} <b
                            style="font-size:12px;font-weight:300;">/tháng</b>
                    </p>
                    @foreach ($content->service_detail as $item)
                        <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                            <span
                                style="display:block;font-size:13px;font-weight:normal;">{{ formatContractService($item->type) }}</span>
                            {{ $item->type == 1 ? formatPrice($content->invoice->amount_electric) : formatPrice($content->invoice->amount_water) }}
                            <b style="font-size:12px;font-weight:300;">
                                {{ $item->end_number - $item->start_number }}{{ $item->type == 1 ? 'Kwh' : 'm3' }}</b>
                        </p>
                    @endforeach
                    @if ($content->contract->contractinfo->type_water == 1)
                        <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span
                                style="display:block;font-size:13px;font-weight:normal;">Phí nước</span>
                            {{ formatPrice($content->invoice->amount_water) }}
                            <b style="font-size:12px;font-weight:300;">{{ formatPrice($content->contract->contractinfo->price_water) }}
                                /người/tháng</b>
                        </p>
                    @endif
                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span
                            style="display:block;font-size:13px;font-weight:normal;">Phí dịch vụ</span>
                        {{ formatPrice($content->invoice->amount_service) }}
                        <b style="font-size:12px;font-weight:300;">{{ formatPrice($content->contract->contractinfo->price_service) }}
                            /người/tháng</b>
                    </p>
                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span
                            style="display:block;font-size:13px;font-weight:normal;color:red">Tổng thanh toán</span>
                        {{ formatPrice($content->invoice->total) }}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:15px;">
                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                        <span style="display:block;font-size:13px;font-weight:normal;">Ngày xuất hóa đơn</span>
                        {{ date('d/m/Y', strtotime($content->invoice->date_create)) }} 
                    </p>
                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                        <span style="display:block;font-size:13px;font-weight:normal;">Hạn thanh toán hóa đơn</span>
                        {{ date('d/m/Y', strtotime($content->invoice->date_expired)) }} 
                    </p>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                    <strong style="display:block;margin:0 0 10px 0;">Trân trọng</strong>
                    {{ $content->contract->room->building->owner }}<br>{{ $content->contract->room->building->name }}<br><br>
                    <b>Số điện thoại:</b> {{ $content->contract->room->building->owner_phone }}<br>
                    <b>Email:</b> {{ $content->contract->room->building->owner_email }}
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
