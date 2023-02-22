
<div>
    <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">

      <!-- Alert/Pesan -->
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-check-circle mr-1"></i>Sukses!</strong> {{session('message')}}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <button wire:click.prevent="tambahPengguna" class="btn btn-primary" ><i class="fa fa-plus-circle"></i> Tambah Pengguna</button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Grup</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->username}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->usergroup}}</td>
                                    <td>
                                        <a href="" wire:click.prevent="editPengguna({{$user->id}})"> <i class="fa fa-edit mr-2"></i></a>
                                        <a href="" wire:click.prevent="konfirmasiHapus({{$user->id}})"> <i class="fa fa-trash text-danger"></i></a>                                    
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {{ $users->links() }}
                    </div>
                </div>  
            </div>          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.Modal Utama -->
    <div class="modal fade" id="tambahPengguna" tabindex="-1"  aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <form autocomplete="off" wire:submit.prevent="{{$editModal? 'simpanPerubahan':'simpanPengguna'}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if($editModal==false)
                            <span>Tambah Pengguna Baru</span>
                        @else
                            <span>Ubah Pengguna</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                        <div class="form-group">
                            <label for="username" class="col-form-label">Nama Pengguna:</label>
                            <input type="text" wire:model.defer="state.username" class="form-control @error('username') is-invalid @enderror" id="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="usergroup" class="col-form-label">Tipe Pengguna:</label>
                            <select class="form-control @error('usergroup') is-invalid @enderror" id="usergroup" wire:model.defer="state.usergroup">
                                <option >Pilih Grup</option>
                                <option value="Admin">Admin</option>
                                <option value="Asatidz">Asatidz</option>
                                <option value="Santri">Santri</option>
                                <option value="Kepala">Kepala</option>
                                <option value="Staf">Staf</option>
                            </select>
                            @error('usergroup')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label">Konfirmasi Password:</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        @if($editModal==false)
                            <span>Simpan</span>
                        @else
                            <span>Ubah</span>
                        @endif
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- /.Modal Hapus -->
    <div class="modal fade" id="konfirmasiHapus" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin akan menghapus Pengguna : </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" wire:click.prevent="hapusPengguna" class="btn btn-primary">Ya</button>
            </div>
            </div>
        </div>
    </div>


</div>

