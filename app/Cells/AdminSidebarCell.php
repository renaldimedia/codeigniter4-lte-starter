<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AdminSidebarCell extends Cell
{
    private $is_active;
    private $menus;
    private $current_path;

    public function mount(): void
    {
        $this->current_path = uri_string();
        $this->is_active = "install";
        $this->menus = [
            [
                'id' => 'home',
                'title' => 'Dashboard',
                'url' => '/home',
                'icon_class' => 'bi bi-speedometer',
                'child' => []
            ],
            [
                'id' => 'parent',
                'title' => 'Parent',
                'url' => '#',
                'icon_class' => 'bi bi-speedometer',
                'child' => [
                    [
                        'id' => 'child-1',
                        'title' => 'Child 1',
                        'url' => '/child-1',
                        'icon_class' => 'bi bi-speedometer',
                        'child' => []
                    ],
                    [
                        'id' => 'child-2',
                        'title' => 'Child 2',
                        'url' => '/child-2',
                        'icon_class' => 'bi bi-speedometer',
                        'child' => []
                    ]
                ]
            ]
        ];
    }

    public function render(): string
    {
        return $this->view('admin_sidebar_cell', ['is_active' => $this->is_active, 'menus' => $this->menus, 'current_path' => $this->current_path]);
    }
}
