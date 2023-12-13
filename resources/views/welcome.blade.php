@extends('app')

@section('content')
    <h1>Produk</h1>
    <div class="row">
        <div class="col-sm-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Tambah Produk
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kategoriModalCenter">
                Tambah Kategori
            </button>
        </div>
        <div class="col-sm-4">
            <form class="d-flex" action="{{ route('produk.search') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" value="{{ request('search') }}"
                        placeholder="Search Produk Name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Berhasil </strong> {{ Session::get('success') }}
        </div>
        <script>
            $("#success-alert").fadeTo(5000, 500).slideUp(500);
        </script>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="failed-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Tidak berhasil </strong> menambahkan/mengubah data
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            $("#failed-alert").fadeTo(5000, 500).slideUp(500);
        </script>
    @endif
    <!-- Modal -->
    <div class="modal fade modal-item" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title exampleModalLabel" id="exampleModalLabel">Tambah Produk</h5>
                </div>
                <form method="POST" action="{{ route('produk.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control form-control-sm nama-produk" name="nama" />
                                <div class="text-err">
                                    @error('nama')
                                        <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false"
                                            width="16px" height="16px" viewBox="0 0 24 24"
                                            xmlns="https://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                            </path>
                                        </svg>
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control form-control-sm harga-produk"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                    placeholder="input harus angka" name="harga" />
                                @error('harga')
                                    <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false"
                                        width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                        </path>
                                    </svg>
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single col-sm-12" name="kategori" id="kategori-produk">
                                        <option value="#" disabled selected hidden>Pilih Kategori</option>
                                        @foreach ($kategoris as $item)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kategori')
                                    <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false"
                                        width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                        </path>
                                    </svg>
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Status</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single col-sm-12" name="status" id="status-produk">
                                        <option value="#" disabled selected hidden>Pilih Status</option>
                                        @foreach ($status as $item)
                                            <option value="{{ $item->id_status }}">{{ $item->nama_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                    <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false"
                                        width="16px" height="16px" viewBox="0 0 24 24"
                                        xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                        </path>
                                    </svg>
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary btn-save" value="Save changes">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade modal-item" id="kategoriModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="kategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title exampleModalLabel" id="kategoriModalLabel">Tambah Kategori</h5>
                </div>
                <form method="POST" action="{{ route('kategori.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control form-control-sm nama-produk" name="namakategori" />
                                <div class="text-err">
                                    @error('namakategori')
                                        <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false"
                                            width="16px" height="16px" viewBox="0 0 24 24"
                                            xmlns="https://www.w3.org/2000/svg">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                            </path>
                                        </svg>
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary btn-save" value="Save changes">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
            <?php $num = 0; ?>
            @foreach ($produks as $key => $item)
                <?php $num = $num + 1; ?>
                <tr>
                    <td>
                        {{ ($produks->currentPage() - 1) * $produks->perPage() + $key + 1 }}
                    </td>
                    <td>
                        {{ $item->nama_produk }}
                    </td>
                    <td>
                        {{ $item->harga }}
                    </td>
                    <td>
                        {{ $item->kategori->nama_kategori }}
                    </td>
                    <td>
                        <button type="button" style="background-color: yellow">
                            <a href="{{ route('produk.edit', $item->id_produk) }}"
                                style="color: black;text-decoration-line: none">edit</a>
                        </button>
                        <form method="post" action="{{ route('produk.destroy', $item->id_produk) }}"
                            style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" style="background-color: lightcoral"
                                onclick="return confirm('Are you sure you want to delete this post?')">hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $produks->appends(request()->input())->links() }}
@endsection
