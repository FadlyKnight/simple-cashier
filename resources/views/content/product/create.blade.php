
@extends('partials.body')
@section('custom_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <h2 class="section-title">Add Food</h2>
            <p class="section-lead">Semua tentang makanan.</p>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Food</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.create.post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Makanan</label>
                                    <input type="text" class="form-control " name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="dropify " name="file" data-default-file="" /> 
                                    @error('file')
                                        <div class="invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group">
                                    <label>Harga Makanan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white bg-primary">Rp. </span>
                                        </div>
                                        <input type="tel" class="form-control " name="price" value="{{ old('price') }}" id="rupiah">
                                    </div>
                                    @error('price')
                                        <div class="invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-action">
                                    <button type="submit" class="btn btn-success btn-sm">simpan</button>
                                </div>
    
                            </form>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>   
    <script>
            $('.dropify').dropify();
            
            const rupiah = document.querySelector('#rupiah')
            rupiah.addEventListener('keyup', function (e) {
                rupiah.value = formatRupiah(this.value)
            });
        
            
    </script>
          
@endsection