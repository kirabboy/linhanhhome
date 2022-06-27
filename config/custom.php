<?php

return [
    'room' => [
        'type' => [
            1 => 'Phòng trọ',
            2 => 'Ký túc xá',
            3 => 'Kho',
        ],
        'status' => [
            0 => 'Trống',
            1 => 'Đã cọc',
            2 => 'Đã thuê',
            3 => 'Ngưng hoạt động',
        ],
    ],
    'user' => [
        'status' => [
            0 => 'Chưa kích hoạt',
            1 => 'Đã kích hoạt',
            2 => 'Đã bị khóa',
        ],
        'role' => [
            1 => 'Quản trị viên',
            2 => 'Nhân viên',
            3 => 'Khách hàng',
        ],
        'gender' => [
            1 => 'Nam',
            0 => 'Nữ',
            2 => 'Khác'
        ]
    ],
    'customer' => [
        'gender' => [
            1 => 'Nam',
            0 => 'Nữ',
            2 => 'Khác'
        ],
        'type' => [
            1 => 'Cá nhân', 
            2 => 'Tổ chức'
        ]
    ],
    'contract' => [
        'type' =>[
            1 => 'Hợp đồng thuê',
            2 => 'Hợp đồng cọc',
        ]
    ],
    'currency' => 'đ',
    'shortcut-icon' => 'public/image/logo.png',
    'role-admin' => 'Full Quyền',
    'default-image' => '/public/image/default-image.png',
];