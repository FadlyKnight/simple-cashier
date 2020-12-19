@extends('partials.body')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
            <h2 class="section-title">Food</h2>
            <p class="section-lead">Semua tentang makanan</p>
        
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Food</h4>
                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-info pull-right">tambah</a>
                    
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>Foto</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->get() as $item)
                                
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td><img src="{{ asset($item->file) }}" width="100" height="auto"></td>
                                        <td>Rp. {{$item->price}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <div>
                                            Tidak Ada Produk
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>
@endsection
