<?php
if (!function_exists('getContractType')) {
    function getContractType($type = 0)
    {
        if($type == 1){
            return 'Hợp đồng thuê';
        }else{
            return 'Hợp đồng cọc';
        }
    }
}
if (!function_exists('getEarnestStatus')) {
    function getEarnestStatus($status = 0)
    {
        if($status == 1){
            return 'Đang cọc';
        }else{
            return 'Không cọc';
        }
    }
}

if (!function_exists('getContractStatus')) {
    function getContractStatus($status = 0)
    {
        if($status == 0){
            return 'Chờ duyệt';
        }elseif($status == 1){
            return 'Hiệu lực';
        }elseif($status == 2){
            return 'Hết hạn';
        }elseif($status == 3){
            return 'Đã hủy';
        }
    }
}
if (!function_exists('bgStatus')) {
    function bgStatus($status = 0)
    {
        if($status == 0){
            return 'bg-danger text-light';
        }else if($status == 1){
            return 'bg-warning text-light';
        }else if($status == 2){
            return 'bg-success text-light';
        }else if($status == 3){
            return 'bg-secondary text-light';
        }
    }
}

if (!function_exists('bgStatusOutline')) {
    function bgStatusOutline($status = 0)
    {
        if($status == 0){
            return 'border border-danger bg-light text-dark';
        }else if($status == 1){
            return 'border border-warning bg-light text-dark';
        }else if($status == 2){
            return 'border border-success bg-light text-dark';
        }else if($status == 3){
            return 'border border-secondary bg-light text-dark';
        }
    }
}
if (!function_exists('badgeStatus')) {
    function badgeStatus($status = 0)
    {
        if($status == 0){
            return 'danger';
        }else if($status == 1){
            return 'warning';
        }else if($status == 2){
            return 'success';
        }else if($status == 3){
            return 'secondary';
        }
    }
}

if (!function_exists('formatColorContract')) {
    function formatColorContract($status = 0)
    {
        if($status == 0){
            return 'text-danger';
        }else if($status == 1){
            return 'text-success';
        }else if($status == 2){
            return 'text-warning';
        }else if($status == 3){
            return 'text-secondary';
        }
    }
}

if (!function_exists('roomStatus')) {
    function roomStatus($status = 0)
    {
        if($status == 0){
            return 'Trống';
        }else if($status == 1){
            return 'Đã cọc';
        }else if($status == 2){
            return 'Đã thuê';
        }else if($status == 3){
            return 'Tạm ngưng';
        }
    }
}
if (!function_exists('permissionOfRole')) {
    function permissionOfRole($data){
        $str = '';
        foreach ($data as $value){
            $str .= '<span class="badge bg-primary me-1">'.$value->name.'</span>';
        }
        return $str;
    }
}
if (!function_exists('checkRoleHasPermissions')) {
    function checkRoleHasPermissions($role, $permissionName){
        if($role->hasPermissionTo($permissionName)){
            return 'selected';
        }
    }
}
if (!function_exists('showAdminWithRolesHtml')) {
    function showAdminWithRolesHtml($data){
        $str = '';
        foreach ($data as $value){
            $str .= '<span class="badge bg-primary me-1">'.$value->name.'</span>';
        }
        return $str;
    }
}
if (!function_exists('showAdminWithRoles')) {
    function showAdminWithRoles($data){
        return $data[0]->name;
    }
}

if (!function_exists('selected')) {
    function selected($value1, $value2){
        if($value1 == $value2){
            return 'selected';
        }
        return;
    }
}

if (!function_exists('checked')) {
    function checked($value1, $value2){
        if($value1 == $value2){
            return 'checked';
        }
        return;
    }
}
if (!function_exists('checkedArray')) {
    function checkedArray($value, $array){
        if(in_array($value, $array)){
            return 'checked';
        }
        return;
    }
}
if (!function_exists('checkAdminHasRole')) {
    function checkAdminHasRole($admin, $RoleName){
        if($admin->hasRole($RoleName)){
            return 'selected';
        }
    }
}
if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 0, ',', '.');
    }
}

if (!function_exists('formatTypeRoom')) {
    function formatTypeRoom($type = 1)
    {
        if($type == 1){
            return 'Phòng trọ';
        }else if($type == 2){
            return 'Chung cư';
        }else if($type == 3){
            return 'Căn hộ mini';
        }
    }
}

if (!function_exists('formatContractService')) {
    function formatContractService($type = 1)
    {
        if($type == 1){
            return 'Công tơ điện';
        }else if($type == 2){
            return 'Công tơ nước';
        }
    }
}

if (!function_exists('formatStatusContractService')) {
    function formatStatusContractService($status = 1)
    {
        if($status == 0){
            return 'Chưa chốt';
        }else if($status == 1){
            return 'Đã chốt';
        }
    }
}
if (!function_exists('statusCommission')) {
    function statusCommission($status){
        if($status == 1){
            return '<span class="badge bg-success">Đã duyệt</span>';
        }
        return '<span class="badge bg-warning">Chưa duyệt</span>';
    }
}