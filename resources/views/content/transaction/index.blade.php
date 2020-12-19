
@extends('partials.body')
@section('custom_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css"    >

    <style>
      .hidden{
        display: none;
      }
      table, td {
        height: 30px !important;
      }
    </style>
@endsection
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                  <div class="row">
                    @forelse ($data->get() as $item)
                        
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-primary card-food" onclick="addCart(this, {{ $item->id }})" style="cursor: pointer;" >
                        <div class="card-header justify-content-center">
                            <h4 class="food-name" data-name="{{ $item->name }}">{{ $item->name }}</h4>
                        </div>
                        <div class="card-body">
                          <img class="card-img-top" src="{{ asset($item->file) }}" height="80" width="auto">
                            <p class="food-price text-center" data-price="{{ $item->price }}">Harga : Rp. {{ $item->price }}</p>
                        </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-12">
                          <span class="alert alert-danger">
                            Tidak Ada Makanan Yang ditemukan
                          </span>
                        </div>
                    @endforelse

                  </div>
                </div>
                <div class="col-md-4">
                    <div class="card" id="sample-login">
                        <div class="card-header justify-content-center bg-primary">
                            <h4 class="text-white">New Customer</h4>
                        </div>
                        <div class="card-body pt-">
                            <p class="text-muted text-center">Dine In <i class="fas fa-arrow-down"></i></p>
                            <h1 class="divider"></h1>
                            <div class="row" id="row-food-bill"></div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger btn-block" id="clear-cart">clear</button>
                    </div>
        
                    <div class="btn-group btn-group-md btn-block" role="group">
                        <button type="button" class="btn btn-sm btn-info" id="save-bill">Save Bill</button>
                        <a type="button" class="btn btn-sm btn-info text-white" target="_blank" id="print-bill">Print Bill</a>
                    </div>
        
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="charge-bill"><i class="fas fa-file-invoice"></i> Charge</button>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL -->
<div class="modal fade " id="charge-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
  
        <div class="modal-header">
          <h5 class="modal-title">Detail Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8" style="padding: 0 10px; border-right: 1px solid black" >
              <table class="table table-bordered table-striped" style="height: 40px;">
                <thead>
                  <tr>
                    <td>Nama</td>
                    <td>Qty</td>
                    <td>Harga</td>
                  </tr>
                </thead>
                <tbody id="body-table">
                </tbody>
              </table>
            </div>
            <div class="col-md-4">
                <h6 class="modal-title">Total Pembayaran : <span id="total-charge"></span></h6>
                <small>Masukkan Uang Pelanggan</small>
                <input type="number" min="0" id="input-duit" placeholder="ex : 10000" class="form-control">
                <span>
                  <strong>Kembalian : </strong>
                  <p id="kembalian"></p>
                </span>
            </div>
          </div>
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveButton">Save Bill</button>
        </div>
      </div>
    </div>
  </div>

<!-- END MODAL -->
@endsection                  

@section('custom_js')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
  cart = [];
  total = 0;
  const ListOrder = document.querySelector('#row-food-bill');
  const Charge = document.querySelector('#charge-bill');
  const Print = document.querySelector('#print-bill');
  const Clear = document.querySelector('#clear-cart');
  const Save = document.querySelector('#save-bill');
  const Modal = document.querySelector('#charge-modal');
  const TableOrder = document.querySelector('#body-table');
  const TotalCharge = document.querySelector('#total-charge');
  const Duit = document.querySelector('#input-duit')
  const Kembalian = document.querySelector('#kembalian')
  const Simpan = document.querySelector('#saveButton')
  
  
  const errorAlert = (text = '') => Swal.fire({icon: 'error',title: 'Something Wrong', text: text})
  const successAlert = (text = '') => Swal.fire({icon: 'success',title: 'Great !', text: text})
  const confirmAlert = () => 
    Swal.fire({
    title: 'Anda Yakin?',
    text: "Keranjang yang dikosongkan tidak dapat dikembalikan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Saya Yaqueen!',
    cancelButtonText: 'Tidak, Saya Ragu!',
    }).then((result) => {
      if (result.isConfirmed) {
        total = 0;
        cart = [];
        Charge.innerHTML = '<i class="fas fa-file-invoice"></i> Charge';
        ListOrder.innerHTML = ``;
        Swal.fire(
          'Terhapus!',
          'Keranjang Berhasil dikosongkan',
          'success'
        )
      }
  })

  Clear.addEventListener('click', () => {
    if(cart.length < 1) {
      errorAlert('Keranjang Kosong Masukkan Minimal 1 Produk')
    } else {
      confirmAlert()
    }
  })
  Save.addEventListener('click', () => {
    if(cart.length < 1) {
      errorAlert('Keranjang Kosong Masukkan Minimal 1 Produk')
    } else {
      successAlert('Transaksi Disimpan')
    }
  })
  Print.addEventListener('click', () => {
    if(cart.length < 1) {
      errorAlert('Keranjang Kosong Masukkan Minimal 1 Produk')
    } else {
      printJS({printable: cart, properties: ['name', 'qty', 'price'], type: 'json'})
    }
  })
  Charge.addEventListener('click', () => {
    if(cart.length < 1) {
      errorAlert('Keranjang Kosong Masukkan Minimal 1 Produk')
    } else {
      $('#charge-modal').modal('show')
      list = ``;
      cart.forEach(item => {
        list += `<tr><td>${item.name}</td><td>${item.qty}</td><td>${item.price}</td></tr>`
      })
      TableOrder.innerHTML = list;
      TotalCharge.innerText = 'Rp. '+formatRupiah(total);
    }
  })
  Duit.addEventListener('keyup', (element) => {
    dataDuit = element.target.value;
    if( parseInt(dataDuit) < parseInt(total) )
    {
      Kembalian.innerText = 'Duit Kurang';
      // Simpan.setAttribute('disabled',true);
      // Simpan.classList.replace("btn-primary", "btn-secondary");
    } else {
      result = parseInt(dataDuit)-parseInt(total);
      Kembalian.innerText = 'Rp. '+ result;
      // Simpan.removeAttribute('disabled');
      // Simpan.classList.replace("btn-secondary", "btn-primary");
    }
  })

  Simpan.addEventListener('click', () => {
    dataDuit = Duit.value < 1 ? 0 : Duit.value;
    if( parseInt(total) > parseInt(dataDuit) ) {
      errorAlert('Duit Pelanggan Kurang')
    } else {
      successAlert('Transaksi Disimpan Terimakasih')
    }

  })

  const itemCart = (data) => {
    if(cart.length > 0 )
    {
      sameItem = cart.some(item =>item.id === data.id);
      if (sameItem) {
          cart.map(item => {
              if(item.id === data.id) {
                item.price = parseInt(item.price) + parseInt(data.price)
                item.qty++ 
              }
          });
      } else {
        cart.push(data)
      }
    }else{
      cart.push(data)
    }
    listCart = ``;
    html = cart.map((c) => {
      listCart += `<span class="hidden food-id">${c.id}</span>
      <div class="col-md-5 food-name">${c.name}</div>
      <div class="col-md-3 food-qty">${c.qty}x</div>
      <div class="col-md-4 food-price">Rp. ${ formatRupiah(c.price) }</div>`
    })

    ListOrder.innerHTML = listCart;
    Charge.innerText = 'Rp. '+formatRupiah(total);
  }
  
  const addCart = (el, id) => {
    qty = 1
    name = el.querySelector('.food-name').getAttribute('data-name')
    price = el.querySelector('.food-price').getAttribute('data-price')
    data = {id, name, qty, price}
    total += parseInt(price)
    itemCart(data);
  }

</script>    
@endsection