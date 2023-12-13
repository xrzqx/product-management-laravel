@extends('app')

@section('content')
    <h1>Edit Poduk</h1>
    @if ($errors->any())
        <div class="alert alert-danger" id="failed-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Tidak berhasil </strong> menambahkan/mengubah produk
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#failed-alert").slideUp(500);
            });
        </script>
    @endif
    <form method="POST" action="{{ route('produk.update', $produk[0]->id_produk) }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Nama Produk</label>
                    <input type="text" value="{{ $produk[0]->nama_produk }}"
                        class="form-control form-control-sm nama-produk" name="nama" />
                    <div class="text-err">
                        @error('nama')
                            <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px"
                                height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
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
                    <input type="text" value="{{ $produk[0]->harga }}" class="form-control form-control-sm harga-produk"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        placeholder="input harus angka" name="harga" />
                    @error('harga')
                        <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px"
                            height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
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
                            <option value="{{ $produk[0]->kategori->id_kategori }}"selected hidden>
                                {{ $produk[0]->kategori->nama_kategori }}</option>
                            @foreach ($kategoris as $item)
                                @if ($produk[0]->kategori->id_kategori != $item->id_kategori)
                                    <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('kategori')
                        <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px"
                            height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
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
                            <option value="{{ $produk[0]->status->id_status }}" selected hidden>
                                {{ $produk[0]->status->nama_status }}</option>
                            @foreach ($status as $item)
                                @if ($produk[0]->status->id_status != $item->id_status)
                                    <option value="{{ $item->id_status }}">{{ $item->nama_status }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('status')
                        <svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px"
                            height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
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
            <button type="button" class="btn btn-secondary">
                <a href="/" style="color: white; text-decoration-line: none">back</a>
            </button>
            <input type="submit" class="btn btn-primary btn-save" value="Save changes">
        </div>
    </form>

@endsection
