<footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; {{ date('Y') }}
        </div>
        <div class="footer-right">
            KNIGHT WAS HERE
        </div>
    </footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

@yield('custom_js')

<script>
    // Function Add Class Active, with same URL
    var href = window.location.href
    var menu = $('.nav-item');
    menu.each((m, obj) => {
        if( $(obj).find('a').attr('href') == href )
        $(obj).addClass('active')
    })
    
    function formatRupiah(angka) {
        angka = angka.toString()
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
        return rupiah;
    }

</script>