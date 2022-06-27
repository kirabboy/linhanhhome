<tr>
    <td><input type="checkbox" class="select-customer" name="customer_ids[]" checked  value="{{$customer->id}}">
    </td>
    <td>{{$customer->fullname}}</td>
    <td>{{$customer->identification_number}}</td>
    <td>{{$customer->phone}}</td>
    <td><input type="radio" id="representative{{$customer->id}}" name="is_representative" checked ="" value="{{$customer->id}}"></td>
    <td><input type="text" class="form-control" name="note{{$customer->id}}" value=""></td>
</tr>
<script>
</script>