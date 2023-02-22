<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Livewire\withPagination;

class ListUsers extends Component
{
    use withPagination;
    protected $paginationTheme ='bootstrap';
    public $state=[]; 
    public $user;
    public $deletedId;
    public $editModal = false;

    
    public function tambahPengguna()
    {
        $this->editModal = false;
        $this->state=[];
        $this->dispatchBrowserEvent('tambah-pengguna');
    }

    public function simpanPengguna()
    {
        $validateData=Validator::make($this->state, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'usergroup' => 'required',
        ])->validate();

        $validateData['password'] = bcrypt($validateData['password']);
        
        //dd('here');
        User::create($validateData);

        //session()->flash('message', 'Berhasil menambahkan pengguna baru');
        
        $this->dispatchBrowserEvent('simpan-pengguna', ['message'=>'Berhasil menambahkan pengguna baru']);

        return redirect()->back();
    }

    public function editPengguna($id)
    {
        $this->editModal = true;
        $this->user =User::findOrFail($id);

        $this->state = [
            'id' => $this->user->id,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'usergroup' => $this->user->usergroup,
        ];
        //dd($this->state);
        $this->dispatchBrowserEvent('tambah-pengguna');
    }

    public function simpanPerubahan()
    {
        $validateData=Validator::make($this->state, [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
            'usergroup' => 'required',
        ])->validate();
        
        if(!empty($validateData['password'])){
            $validateData['password'] = bcrypt($validateData['password']);
        }       
        
        //dd('here');
        $this->user->update($validateData);       
        
        $this->dispatchBrowserEvent('simpan-pengguna', ['message'=>'Data pengguna berhasil dirubah']);

        return redirect()->back();
    }

    public function konfirmasiHapus($id)
    {
        
        $this->deletedId = $id;

        $this->dispatchBrowserEvent('konfimasi-hapus');
    }

    public function hapusPengguna()
    {
        $pengguna =User::findOrFail($this->deletedId);       

        $pengguna->delete();

        $this->dispatchBrowserEvent('hapus-pengguna', ['message'=>'Data pengguna berhasil dihapus']);
    }
    
    public function render()
    {
        $users=User::latest()->paginate(5);

        return view('livewire.admin.user.list-users', ['users'=>$users]);
    }
}
