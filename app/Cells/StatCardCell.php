<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class StatCardCell extends Cell
{
    public $color;
    public $icon_class = false;
    public $icon_svg = false;
    public $title;
    public $number;
    public $is_percentage = false;
    public $url = false;
    public function render(): string
    {
        return $this->view('stat_card', ['color' => $this->color, 'icon_class' => $this->icon_class, 'title' => $this->title, 'number' => $this->number, 'is_persentage' => $this->is_percentage, 'url' => $this->url, 'icon_svg' => $this->icon_svg]);
    }
}
