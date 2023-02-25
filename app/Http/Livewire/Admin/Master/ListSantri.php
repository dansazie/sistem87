<?php

namespace App\Http\Livewire\Admin\Master;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Santri;

class ListSantri extends AdminComponent
{
    public function render()
    {
        return view('livewire.admin.master.list-santri');
    }
}
