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

        $currentUser = auth()->user();
        

        $this->user = [
            'name' => $currentUser->full_name,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($currentUser->full_name),
            'title' => '',
            'register_at' => $currentUser->created_at
        ];
        return $this->view('admin_header_cell', ['notification' => $this->notification, 'user' => $this->user]);
    }
}
