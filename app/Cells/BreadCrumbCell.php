<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class BreadCrumbCell extends Cell
{
    public $classes = "";
    public function render(): string
    {
        $current_path = explode("/", uri_string());
        $crumb = [];
        $paths = "";
        $index = 0;
        foreach($current_path as $path){
            $active = false;
            if($index == (count($current_path) - 1)){
                $active = true;
            }
            $paths .= $path;
            $crumb[] = ['url' => base_url($paths), 'label' => ucfirst($path), 'active' => $active];
            $index++;
        }
        return $this->view('bread_crumb', ['crumb' => $crumb, 'classes' => $this->classes]);
    }
}
