<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\withPagination;

class AdminComponent extends Component 
{
    use withPagination;
    protected $paginationTheme ='bootstrap';

}