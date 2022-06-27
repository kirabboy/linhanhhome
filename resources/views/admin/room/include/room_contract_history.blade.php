<div class="table-responsive table-scrollable">
    <table class="table table-head-custom">
        <thead>
            <th class="text-12 text-uppercase">#</th>
            <th class="text-12 text-uppercase">Mã</th>
            <th class="text-12 text-uppercase">Loại hợp đồng</th>
            <th class="text-12 text-uppercase">Số hợp đồng</th>
            <th class="text-12 text-uppercase">Thời gian bắt đầu</th>
            <th class="text-12 text-uppercase">Thời gian kết thúc</th>
            <th class="text-12 text-uppercase">Trạng thái</th>
        </thead>
        <tbody>
            @foreach ($contracts->get() as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ getContractType($item->type) }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->time_start)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->time_end)) }}</td>
                    <td>
                        <p class="m-0 text-12 label label-light-success" style="width:100%">
                            {{ getContractStatus($item->status) }}</p>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
