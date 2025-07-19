<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AdminHeaderCell extends Cell
{
    private $notification;
    private $user;

    public function render():string {
        $this->notification = [
            [
                'title' => 'Driver baru',
                'timestamp' => '2 Hari'
            ],
             [
                'title' => 'Driver baru',
                'timestamp' => '2 Menit'
            ]
        ];

        $this->user = [
            'name' => 'Jhon Doe',
            'avatar' => 'https://ui-avatars.com/api/?name=Jhon+Doe',
            'title' => 'Superadmin',
            'register_at' => '24 Oktober 2024'
        ];
        return $this->view('admin_header_cell', ['notification' => $this->notification, 'user' => $this->user]);
    }
}
