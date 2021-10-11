<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="#">Naufal Ahmad Riefyan</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?= base_url('assets/js/stisla.js');?>"></script>


  <!-- Template JS File -->
  <script src="<?= base_url('assets/js/scripts.js');?>"></script>
  <script src="<?= base_url('assets/js/custom.js');?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url('assets/js/page/index.js');?>"></script>

  <!-- Toastr -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Datatables -->
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
   <!-- Sweet Alert2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

   <!-- Tombol Hapus -->
   <script>
    // const flashData = $('.flash-data').data('flashdata');
    // console.log(flashData);

    // if (flashData){
    //   Swal.fire({
    //     title: 'Data Berhasil' ,
    //     text: flashData,
    //     type: 'success'
    //   });
    // }

     $('.tombol-recycle').on('click', function(e) {
        e.preventDefault();
        
        const href = $(this).attr('href');
        Swal.fire({
          title: 'Yakin Hapus Data?',
          text: "Data Akan Tersimpan Di Recycle",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus Data'
      }).then((result) => {
        
      if (result.isConfirmed) {
          
         document.location.href = href;
        
  }
})
      });


  </script>

  <!-- Tambah Data Pembelian Bahan -->
  <script>
    // Tambah Data Pembelian Bahan
    $(document).on("click", "#add_pblBahan", function(e){
      e.preventDefault();

      var kd_faktur = $('input[name="kd_faktur"]').val();
      var nama = $('input[name="nama_supplier"]').val();
      var tgl = $('input[name="tgl"]').val();
      var po_bahan = $('input[name="po_bahan"]').val();
      var jenis_bahan = $('input[name="jenis_bahan"]').val();
      var kd_bahan = $('input[name="kd_bahan"]').val();
      var qty = $('input[name="qty"]').val();
      var hrg = $('input[name="harga"]').val();
      var ktr = $('#keterangan').val();
      var date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>PembelianBahan/insert",
        type: "post",
        dataType: 'json',
        data: {
          nama_supplier: nama,
          kd_faktur: kd_faktur,
          tgl: tgl,
          po_bahan: po_bahan,
          jenis_bahan: jenis_bahan,
          kd_bahan: kd_bahan,
          qty: qty,
          harga: hrg,
          keterangan: ktr,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#pbl_bahan_table').DataTable().destroy();
            fetch_pblBahan();
            $('#modalTambah_pblBahan').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_pblBahan')[0].reset();

    });


    // Fetch Data Pembelian Bahan

    function fetch_pblBahan() {
      $.ajax({
        url: "<?= base_url();?>PembelianBahan/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#pbl_bahan_table').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "tgl" },
                { "data": "nama_supplier" },
                { "data": "kd_faktur" },
                { "data": "po_bahan" },
                { "data": "jenis_bahan" },
                { "data": "kd_bahan" },
                { "data": "qty" },
                { "data": "harga" },
                { "data": "keterangan" },
                { "render": function ( data, type, row, meta ) {
                  var a = `
                  
                  <a href="<?php echo base_url(). 'PembelianBahan/detail'; ?>/${row.id_pbl_bahan}" class="btn btn-primary" ">Detail</a>
                      
                  `;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_pblBahan();

      // Fetch Halaman Detail Pembelian Bahan

      function fetch_add_pbl_bahan() {

        var id =  <?php echo $this->uri->segment('3')?>

        $.ajax({
            url: "<?php echo base_url("PembelianBahan/add_data") ?>",
            type: "get",
            dataType: "json",
            data: {
              id: id
            },
            success: function(data) {
                // console.log(data);
                var nama_sup = "", tanggal="", kode = "", po = "", qty="", jenis_bahan="",harga="", kode_bahan="", keterangan="";
                
                for (var key in data) {
                    kode +=  data[key]['kd_faktur'];
                    nama_sup +=  data[key]['nama_supplier'];
                    tanggal +=  data[key]['tgl'];
                    po +=  data[key]['po_bahan'];
                    qty +=  data[key]['qty'];
                    jenis_bahan +=  data[key]['jenis_bahan'];
                    harga +=  data[key]['harga'];
                    kode_bahan +=  data[key]['kd_bahan'];
                    keterangan +=  data[key]['keterangan'];
                    
                }

                  $("#kd_faktur_bahan").html(kode);
                  $("#tgl_pbl_bahan").html(tanggal);
                  $("#nama_sup_bahan").html(nama_sup);
                  $("#po_bahan").html(po);
                  $("#qty_bahan").html(qty);
                  $("#jenis_bahan").html(jenis_bahan);
                  $("#harga_bahan").html(harga);
                  $("#kode_bahan").html(kode_bahan);
                  $("#ket_bahan").html(keterangan);
        }
    });
    }

    fetch_add_pbl_bahan();

    // Edit Data Bahan

    $(document).on("click", "#edit_bahan", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("PembelianBahan/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
              $('#edit_modal').modal('show');
              $("#edit_bahan_id").val(data.post.id_pbl_bahan);
              $("#edit_kode_faktur_bahan").val(data.post.kd_faktur);
              $("#edit_nama_suplier_bahan").val(data.post.nama_supplier);
              $("#edit_tgl_bahan").val(data.post.tgl);
              $("#edit_po_bahan").val(data.post.po_bahan);
              $("#edit_jenis_bahan").val(data.post.jenis_bahan);
              $("#edit_kode_bahan").val(data.post.kd_bahan);
              $("#edit_qty_bahan").val(data.post.qty);
              $("#edit_harga_bahan").val(data.post.harga);
              $("#edit_ket_bahan").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });

    // Update Pembelian Bahan

    $(document).on("click", "#update_bahan", function(e){
      e.preventDefault();

      let edit_bahan_id = $("#edit_bahan_id").val();
      let edit_kode_faktur_bahan = $("#edit_kode_faktur_bahan").val();
      let edit_nama_suplier_bahan = $("#edit_nama_suplier_bahan").val();
      let edit_tgl_bahan = $("#edit_tgl_bahan").val();
      let edit_po_bahan = $("#edit_po_bahan").val();
      let edit_jenis_bahan = $("#edit_jenis_bahan").val();
      let edit_kode_bahan = $("#edit_kode_bahan").val();
      let edit_qty_bahan = $("#edit_qty_bahan").val();
      let edit_harga_bahan = $("#edit_harga_bahan").val();
      let edit_ket_bahan = $("#edit_ket_bahan").val();

        $.ajax({
          url: "<?php echo base_url('PembelianBahan/update'); ?>",
          type: "post",
          dataType: "json",
          data: {
            edit_bahan_id: edit_bahan_id,
            edit_kode_faktur_bahan: edit_kode_faktur_bahan,
            edit_nama_suplier_bahan: edit_nama_suplier_bahan,
            edit_tgl_bahan: edit_tgl_bahan,
            edit_po_bahan: edit_po_bahan,
            edit_jenis_bahan: edit_jenis_bahan,
            edit_kode_bahan: edit_kode_bahan,
            edit_qty_bahan: edit_qty_bahan,
            edit_harga_bahan: edit_harga_bahan,
            edit_ket_bahan: edit_ket_bahan
          },
          success: function(data){
            console.log(data);
            if (data.responce == "success") {
              fetch_add_pbl_bahan();
              $('#edit_modal').modal('hide');
              toastr["success"](data.message);
            }else{
              toastr["error"](data.message);
            }
          }
        });


});
  </script>
  <!--Akhir Halaman Detail Pembelian Bahan -->

  <!-- Halaman Pembelian Aksesoris -->
  <script>
    // Add Data Pembelian Aksesoris
    $(document).on("click", "#add_pblAksesoris", function(e){
      e.preventDefault();

      let no_faktur = $('input[name="no_faktur"]').val();
      let nama = $('input[name="nama_supplier"]').val();
      let tgl = $('input[name="tgl"]').val();
      let jenis_aksesoris = $('input[name="jenis_aksesoris"]').val();
      let kd_aksesoris = $('input[name="kd_aksesoris"]').val();
      let qty = $('input[name="qty"]').val();
      let hrg = $('input[name="harga"]').val();
      let ktr = $('#ket_aksesoris').val();
      let date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>PembelianAksesoris/insert",
        type: "post",
        dataType: 'json',
        data: {
          nama_supplier: nama,
          no_faktur: no_faktur,
          tgl: tgl,
          jenis_aksesoris: jenis_aksesoris,
          kd_aksesoris: kd_aksesoris,
          qty: qty,
          harga: hrg,
          keterangan: ktr,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#pbl_aksesoris_table').DataTable().destroy();
            fetch_pblAksesoris();
            $('#modalTambah_pblAksesoris').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_pblAksesoris')[0].reset();

    });

    // Akhir Add Data Pemebelian Aksesoris

    // Fetch Data Pembelian Aksesoris
      
    function fetch_pblAksesoris() {
      $.ajax({
        url: "<?= base_url();?>PembelianAksesoris/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#pbl_aksesoris_table').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "nama_supplier" },
                { "data": "no_faktur" },
                { "data": "tgl" },
                { "data": "jenis_aksesoris" },
                { "data": "kd_aksesoris" },
                { "data": "qty" },
                { "data": "harga" },
                { "render": function ( data, type, row, meta ) {
                  var a = `<a href="<?php echo base_url(). 'PembelianAksesoris/detail'; ?>/${row.id_pbl_aksesoris}" class="btn btn-primary" ">Detail</a>`;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_pblAksesoris();

    // Akhir Fetch Data Pembelian Aksesoris

    // Function Halaman Detail Pembelian Aksesoris
    function fetch_add_pbl_aksesoris() {

        var id = <?php echo $this->uri->segment('3')?>

          $.ajax({
              url: "<?php echo base_url("PembelianAksesoris/add_data") ?>",
              type: "get",
              dataType: "json",
              data: {
                id: id
              },
             success: function(data) {
                // console.log(data);
                var nama_sup = "", tanggal="", kode = "", qty="", jenis="", harga="", kode_aksesoris="", keterangan="";
                
                for (var key in data) {
                    kode +=  data[key]['no_faktur'];
                    nama_sup +=  data[key]['nama_supplier'];
                    tanggal +=  data[key]['tgl'];                  
                    qty +=  data[key]['qty'];
                    jenis +=  data[key]['jenis_aksesoris'];
                    harga +=  data[key]['harga'];
                    kode_aksesoris +=  data[key]['kd_aksesoris'];
                    keterangan +=  data[key]['keterangan'];
                    
                }

                  $('#no_faktur').html(kode);
                  $("#tgl_pbl_aksesoris").html(tanggal);
                  $("#nama_sup_aksesoris").html(nama_sup);
                  $("#qty_aksesoris").html(qty);
                  $("#jenis_aksesoris_brg").html(jenis);
                  $("#harga_aksesoris").html(harga);
                  $("#kd_aksesoris").html(kode_aksesoris);
                  $("#ket_aksesoris").html(keterangan);
            }
            });
            }

    fetch_add_pbl_aksesoris();

    // Akhir Function Detail

    // Edit Aksesoris

    $(document).on("click", "#edit_aksesoris", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("PembelianAksesoris/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
              $('#edit_modal_aksesoris').modal('show');
              $("#edit_aksesoris_id").val(data.post.id_pbl_aksesoris);
              $("#edit_no_faktur").val(data.post.no_faktur);
              $("#edit_nama_supplier_aksesoris").val(data.post.nama_supplier);
              $("#edit_tgl_aksesoris").val(data.post.tgl);
              $("#edit_qty_aksesoris").val(data.post.qty);
              $("#edit_jenis_aksesoris").val(data.post.jenis_aksesoris);
              $("#edit_kd_aksesoris").val(data.post.kd_aksesoris);
              $("#edit_harga_aksesoris").val(data.post.harga);
              $("#edit_ket_aksesoris").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });
        // Akhir Edit Aksesoris

    // Update Aksesoris
    $(document).on("click", "#update_aksesoris", function(e){
    e.preventDefault();

    var edit_akseoris_id = $("#edit_aksesoris_id").val();
    var edit_no_faktur = $("#edit_no_faktur").val();
    var edit_nama_supplier_aksesoris = $("#edit_nama_supplier_aksesoris").val();
    var edit_tgl_aksesoris = $("#edit_tgl_aksesoris").val();
    var edit_qty_aksesoris = $("#edit_qty_aksesoris").val();
    var edit_jenis_aksesoris = $("#edit_jenis_aksesoris").val();
    var edit_kd_aksesoris = $("#edit_kd_aksesoris").val();
    var edit_harga_aksesoris = $("#edit_harga_aksesoris").val();
    var edit_ket_aksesoris = $("#edit_ket_aksesoris").val();
    let date_create = Date.now();

      $.ajax({
        url: "<?php echo base_url('PembelianAksesoris/update'); ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_akseoris_id: edit_akseoris_id,
          edit_no_faktur: edit_no_faktur,
          edit_nama_supplier_aksesoris: edit_nama_supplier_aksesoris,
          edit_tgl_aksesoris: edit_tgl_aksesoris,
          edit_qty_aksesoris: edit_qty_aksesoris,
          edit_jenis_aksesoris: edit_jenis_aksesoris,
          edit_kd_aksesoris: edit_kd_aksesoris,
          edit_harga_aksesoris: edit_harga_aksesoris,
          date_create:date_create,
          edit_ket_aksesoris: edit_ket_aksesoris
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
            fetch_add_pbl_aksesoris();
            $('#edit_modal_aksesoris').modal('hide');
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message);
          }
        }
      });


    });

  </script>
  <!-- Akhir Halaman Aksesoris -->

  <!-- Halaman Produksi -->

    <script>
    // Add Data Produksi
    $(document).on("click", "#add_produksi", function(e){
      e.preventDefault();

      var id_srp = $('input[name="id_srp"]').val();
      var po_utama = $('input[name="po_bahan_utama"]').val();
      var tgl = $('input[name="tgl"]').val();
      var po_kombinasi = $('input[name="po_bahan_kombinasi"]').val();
      var jml_bahan_utama = $('input[name="jumlah_bahan_utama"]').val();
      var jml_bahan_kombinasi = $('input[name="jumlah_kombinasi"]').val();
      var merk = $('input[name="merk"]').val();
      var model = $('input[name="model"]').val();
      var style = $('input[name="style"]').val();
      var aksesoris = $('input[name="aksesoris"]').val();
      var alamat_cutting = $('input[name="alamat_cutting"]').val();
      var jml_hasil_cuting = $('input[name="jml_hasil_cuting"]').val();
      var alamat_produksi = $('input[name="alamat_produksi"]').val();
      var biaya_cmt = $('input[name="biaya_cmt"]').val();
      var ktr = $('#ket_produksi').val();
      var date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>Produksi/insert",
        type: "post",
        dataType: 'json',
        data: {
          id_srp: id_srp,
          po_bahan_utama: po_utama,
          tgl: tgl,
          po_bahan_kombinasi: po_kombinasi,
          jumlah_bahan_utama: jml_bahan_utama,
          jumlah_kombinasi: jml_bahan_kombinasi,
          merk: merk,
          model: model,
          style: style,
          aksesoris: aksesoris,
          alamat_cutting: alamat_cutting,
          jml_hasil_cuting: jml_hasil_cuting,
          alamat_produksi: alamat_produksi,
          biaya_cmt: biaya_cmt,
          keterangan: ktr,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#table_produksi').DataTable().destroy();
            fetch_produksi();
            $('#modalTambah_produksi').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_produksi')[0].reset();

    });

    // Akhir Add Data Pemebelian Aksesoris

    // Fetch Table Produksi
    function fetch_produksi() {
      $.ajax({
        url: "<?= base_url();?>Produksi/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#table_produksi').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "id_srp" },
                { "data": "po_bahan_utama" },
                { "data": "po_bahan_kombinasi" },
                { "data": "jumlah_bahan_utama" },
                { "data": "jumlah_kombinasi" },
                { "data": "merk" },
                { "data": "model" },
                { "render": function ( data, type, row, meta ) {
                  var a = `<a href="<?php echo base_url(). 'Produksi/detail'; ?>/${row.id_produksi}" class="btn btn-primary" ">Detail</a>`;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_produksi();
    // Akhir Fetch Table Produksi

    // Fetch Detail Produksi
    function fetch_add_produksi() {

      var id = <?php echo $this->uri->segment('3')?>

      $.ajax({
          url: "<?php echo base_url("Produksi/add_data") ?>",
          type: "get",
          dataType: "json",
          data: {
            id: id
          },
        success: function(data) {
            // console.log(data);
            var srp = "", tanggal="", po_utama = "", po_kombinasi="", jml_bahan="", jml_kombinasi="", merk="", model="",style="",aksesoris="",alamat_cutting="", jml_cutting="", alamat_produksi="",biaya_cmt="", ket="";
            
            for (var key in data) {
                srp +=  data[key]['id_srp'];
                po_utama +=  data[key]['po_bahan_utama'];
                tanggal +=  data[key]['tgl'];                  
                po_kombinasi +=  data[key]['po_bahan_kombinasi'];
                jml_bahan +=  data[key]['jumlah_bahan_utama'];
                jml_kombinasi +=  data[key]['jumlah_kombinasi'];
                merk +=  data[key]['merk'];
                model +=  data[key]['model'];
                style +=  data[key]['style'];
                aksesoris +=  data[key]['aksesoris'];
                alamat_cutting +=  data[key]['alamat_cutting'];
                jml_cutting +=  data[key]['jml_hasil_cuting'];
                alamat_produksi +=  data[key]['alamat_produksi'];
                biaya_cmt +=  data[key]['biaya_cmt'];
                ket +=  data[key]['keterangan'];
                
            }

              $('#srp').html(srp);
              $("#tgl_produksi").html(tanggal);
              $("#po_bahan_kombinasi").html(po_kombinasi);
              $("#po_bahan_utama").html(po_utama);
              $("#jenis_aksesoris").html(jml_bahan);
              $("#jml_bahan_kombinasi").html(jml_kombinasi);
              $("#merk_produksi").html(merk);
              $("#model_produksi").html(model);
              $("#style_produksi").html(style);
              $("#aksesoris_produksi").html(aksesoris);
              $("#alamat_cutting").html(alamat_cutting);
              $("#hasil_cutting").html(jml_cutting);
              $("#alamat_produksi").html(alamat_produksi);
              $("#biaya_cmt").html(biaya_cmt);
              $("#ket_produksi_detail").html(ket);
        }
        });
        }

        fetch_add_produksi();

    // AKhir Fetch Detail Produksi

    // Edit Produksi

    $(document).on("click", "#edit_produksi", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("Produksi/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
              $('#edit_modal_produksi').modal('show');
              $("#edit_produksi_id").val(data.post.id_produksi);
              $("#edit_id_srp").val(data.post.id_srp);
              $("#edit_tgl_produksi").val(data.post.tgl);
              $("#edit_po_bahan_utama").val(data.post.po_bahan_utama);
              $("#edit_po_bahan_kombinasi").val(data.post.po_bahan_kombinasi);
              $("#edit_jumlah_bahan_utama").val(data.post.jumlah_bahan_utama);
              $("#edit_jumlah_kombinasi").val(data.post.jumlah_kombinasi);
              $("#edit_merk_produksi").val(data.post.merk);
              $("#edit_model_produksi").val(data.post.model);
              $("#edit_style_produksi").val(data.post.style);
              $("#edit_aksesoris_produksi").val(data.post.aksesoris);
              $("#edit_alamat_cutting").val(data.post.alamat_cutting);
              $("#edit_jml_hasil_cuting").val(data.post.jml_hasil_cuting);
              $("#edit_alamat_produksi").val(data.post.alamat_produksi);
              $("#edit_biaya_cmt").val(data.post.biaya_cmt);
              $("#edit_ket_produksi").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });

    // Akhir Edit Produksi

    // Update Produksi  
    $(document).on("click", "#update_produksi", function(e){
    e.preventDefault();

    var edit_produksi_id = $("#edit_produksi_id").val();
    var edit_id_srp = $("#edit_id_srp").val();
    var edit_tgl_produksi = $("#edit_tgl_produksi").val();
    var edit_po_bahan_utama = $("#edit_po_bahan_utama").val();
    var edit_po_bahan_kombinasi = $("#edit_po_bahan_kombinasi").val();
    var edit_jumlah_bahan_utama = $("#edit_jumlah_bahan_utama").val();
    var edit_jumlah_kombinasi = $("#edit_jumlah_kombinasi").val();
    var edit_merk_produksi = $("#edit_merk_produksi").val();
    var edit_model_produksi = $("#edit_model_produksi").val();
    var edit_style_produksi = $("#edit_style_produksi").val();
    var edit_aksesoris_produksi = $("#edit_aksesoris_produksi").val();
    var edit_alamat_cutting = $("#edit_alamat_cutting").val();
    var edit_jml_hasil_cuting = $("#edit_jml_hasil_cuting").val();
    var edit_alamat_produksi = $("#edit_alamat_produksi").val();
    var edit_biaya_cmt = $("#edit_biaya_cmt").val();
    var edit_ket_produksi = $("#edit_ket_produksi").val();
    var date_create = Date.now();

      $.ajax({
        url: "<?php echo base_url('Produksi/update'); ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_produksi_id: edit_produksi_id,
          edit_id_srp: edit_id_srp,
          edit_tgl_produksi: edit_tgl_produksi,
          edit_po_bahan_utama: edit_po_bahan_utama,
          edit_po_bahan_kombinasi: edit_po_bahan_kombinasi,
          edit_jumlah_bahan_utama: edit_jumlah_bahan_utama,
          edit_jumlah_kombinasi: edit_jumlah_kombinasi,
          edit_merk_produksi: edit_merk_produksi,
          edit_model_produksi: edit_model_produksi,
          edit_style_produksi: edit_style_produksi,
          edit_aksesoris_produksi: edit_aksesoris_produksi,
          edit_alamat_cutting: edit_alamat_cutting,
          edit_jml_hasil_cuting: edit_jml_hasil_cuting,
          edit_alamat_produksi: edit_alamat_produksi,
          edit_biaya_cmt: edit_biaya_cmt,
          date_create:date_create,
          edit_ket_produksi: edit_ket_produksi
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
            fetch_add_produksi();
            $('#edit_modal_produksi').modal('hide');
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message);
          }
        }
      });


    });

    // Akhir Update Produksi
    </script>
  <!-- Akhir Halaman Produksi -->

  <!-- Halaman Barang Masuk -->
  <script>

    // Insert Data Barang Masuk

     $(document).on("click", "#insert_brgMasuk", function(e){
      e.preventDefault();

      var tgl_brgMasuk = $('input[name="tgl_brgMasuk"]').val();
      var merk_brgMasuk = $('input[name="merk_brgMasuk"]').val();
      var style_brgMasuk = $('input[name="style_brgMasuk"]').val();
      var model_brgMasuk = $('input[name="model_brgMasuk"]').val();
      var jml_brgMasuk = $('input[name="jml_brgMasuk"]').val();
      var cmt_brgMasuk = $('input[name="cmt_brgMasuk"]').val();
      var add_ket_brgMasuk = $('#add_ket_brgMasuk').val();
      var date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>Barang_masuk/insert",
        type: "post",
        dataType: 'json',
        data: {
          tgl: tgl_brgMasuk,
          merk: merk_brgMasuk,
          style: style_brgMasuk,
          model: model_brgMasuk,
          jumlah: jml_brgMasuk,
          cmt: cmt_brgMasuk,
          keterangan: add_ket_brgMasuk,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#barang_masuk_table').DataTable().destroy();
            fetch_produksi();  
            $('#add_modal_brgMasuk').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_brgMasuk')[0].reset();

    });

    // Akhir Insert Data Barang Masuk

    // Fetch Table Barang Masuk

     function fetch_brgMasuk() {
      $.ajax({
        url: "<?= base_url();?>Barang_masuk/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#barang_masuk_table').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "tgl" },
                { "data": "merk" },
                { "data": "style" },
                { "data": "model" },
                { "data": "jumlah" },
                { "data": "cmt" },
                { "data": "keterangan"},
                { "render": function ( data, type, row, meta ) {
                  var a = `<a href="<?php echo base_url(). 'Barang_masuk/detail'; ?>/${row.id_barang_masuk}" class="btn btn-primary" ">Detail</a>`;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_brgMasuk();
  
    // AKhir Fetch Table Barang Masuk

    // Halaman Detail Barang Masuk

    function fetch_add_brgMasuk() {

    var id = <?php echo $this->uri->segment('3')?>

    $.ajax({
        url: "<?php echo base_url("Barang_masuk/add_data") ?>",
        type: "get",
        dataType: "json",
        data: {
          id: id
        },
  success: function(data) {
      // console.log(data);
      var tanggal="", merk="", model="",style="", jml_brg="", cmt="", ket="";
      
      for (var key in data) {
          tanggal +=  data[key]['tgl'];
          ket +=  data[key]['keterangan'];
          merk +=  data[key]['merk'];                  
          model +=  data[key]['model'];
          style +=  data[key]['style'];
          jml_brg +=  data[key]['jumlah'];
          cmt +=  data[key]['cmt'];
        
      }

        $('#tgl_brgMasuk').html(tanggal);
        $("#ket_brgMasuk").html(ket);
        $("#mrk_brgMasuk").html(merk);
        $("#model_brgMasuk").html(model);
        $("#style_brgMasuk").html(style);
        $("#jml_brgMasuk").html(jml_brg);
        $("#cmt_brgMasuk").html(cmt);
      
    }
    });
    }

    fetch_add_brgMasuk();

    // Akhir Halaman Detail Barang Masuk

    // Edit Barang Masuk

    $(document).on("click", "#edit_barangMasuk", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("Barang_masuk/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          // console.log(data);
          if (data.responce == "success") {
              $('#edit_modal_brgMasuk').modal('show');
              $("#edit_id_brg_masuk").val(data.post.id_barang_masuk);
              $("#edit_tgl_brgMasuk").val(data.post.tgl);
              $("#edit_merk_brgMasuk").val(data.post.merk);
              $("#edit_style_brgMasuk").val(data.post.style);
              $("#edit_model_brgMasuk").val(data.post.model);
              $("#edit_jml_brgMasuk").val(data.post.jumlah);
              $("#edit_cmt_brgMasuk").val(data.post.cmt);
              $("#edit_add_ket_brgMasuk").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });   

    // Akhir Edit Barang Masuk

    // Update Barang Masuk
    $(document).on("click", "#update_brgMasuk", function(e){
    e.preventDefault();

    var edit_id_brg_masuk = $("#edit_id_brg_masuk").val();
    var edit_tgl_brgMasuk = $("#edit_tgl_brgMasuk").val();
    var edit_merk_brgMasuk = $("#edit_merk_brgMasuk").val();
    var edit_style_brgMasuk = $("#edit_style_brgMasuk").val();
    var edit_model_brgMasuk = $("#edit_model_brgMasuk").val();
    var edit_jml_brgMasuk = $("#edit_jml_brgMasuk").val();
    var edit_cmt_brgMasuk = $("#edit_cmt_brgMasuk").val();
    var edit_add_ket_brgMasuk = $("#edit_add_ket_brgMasuk").val();
    var date_create = Date.now();

      $.ajax({
        url: "<?php echo base_url('Barang_masuk/update'); ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id_brg_masuk: edit_id_brg_masuk,
          edit_tgl_brgMasuk: edit_tgl_brgMasuk,
          edit_merk_brgMasuk: edit_merk_brgMasuk,
          edit_style_brgMasuk: edit_style_brgMasuk,
          edit_model_brgMasuk: edit_model_brgMasuk,
          edit_jml_brgMasuk: edit_jml_brgMasuk,
          edit_cmt_brgMasuk: edit_cmt_brgMasuk,
          edit_add_ket_brgMasuk: edit_add_ket_brgMasuk,
          date_create:date_create
         
        },
        success: function(data){
          console.log(data);
          if (data.responce == "success") {
            fetch_add_brgMasuk();
            $('#edit_modal_brgMasuk').modal('hide');
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message);
          }
        }
      });


    });

    // Akhir Update Barang Masuk
  </script>
  <!-- AKhir Halaman Barang Masuk -->

  <!-- Halaman  Barang Keluar -->
    <script>
      //Insert Barang Keluar
      $(document).on("click", "#insert_brgKeluar", function(e){
      e.preventDefault();

      var tgl_brgKeluar = $('input[name="tgl_brgKeluar"]').val();
      var merk_brgKeluar = $('input[name="merk_brgKeluar"]').val();
      var style_brgKeluar = $('input[name="style_brgKeluar"]').val();
      var model_brgKeluar = $('input[name="model_brgKeluar"]').val();
      var jml_barangKeluar = $('input[name="jml_barangKeluar"]').val();
      var customer_brgKeluar = $('input[name="customer_brgKeluar"]').val();
      var add_ket_brgMasuk = $('#add_ket_brgKeluar').val();
      var date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>BarangKeluar/insert",
        type: "post",
        dataType: 'json',
        data: {
          tgl: tgl_brgKeluar,
          merk: merk_brgKeluar,
          style: style_brgKeluar,
          model: model_brgKeluar,
          jumlah: jml_barangKeluar,
          customer: customer_brgKeluar,
          keterangan: add_ket_brgMasuk,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#table_brgKeluar').DataTable().destroy();
            fetch_brgKeluar();  
            $('#add_modal_brgKeluar').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_brgKeluar')[0].reset();

    });

    // Akhir Insert Barang Keluar

    // Fetch Table Barang Keluar
    function fetch_brgKeluar() {
      $.ajax({
        url: "<?= base_url();?>BarangKeluar/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#table_brgKeluar').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "tgl" },
                { "data": "merk" },
                { "data": "style" },
                { "data": "model" },
                { "data": "jumlah" },
                { "data": "customer" },
                { "data": "keterangan"},
                { "render": function ( data, type, row, meta ) {
                  var a = `<a href="<?php echo base_url(). 'BarangKeluar/detail'; ?>/${row.id_barang_keluar}" class="btn btn-primary" ">Detail</a>`;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_brgKeluar();

    // AKhir Table Barang Keluar
         
    // Halaman Detail Barang Keluar

    function fetch_add_brgKeluar() {

        var id = <?php echo $this->uri->segment('3')?>

        $.ajax({
            url: "<?php echo base_url("BarangKeluar/add_data") ?>",
            type: "get",
            dataType: "json",
            data: {
              id: id
            },
        success: function(data) {
          // console.log(data);
          var tanggal="", merk="", model="",style="", jml_brg="", cst="", ket="";
          
          for (var key in data) {
              tanggal +=  data[key]['tgl'];
              ket +=  data[key]['keterangan'];
              merk +=  data[key]['merk'];                  
              model +=  data[key]['model'];
              style +=  data[key]['style'];
              jml_brg +=  data[key]['jumlah'];
              cst +=  data[key]['customer'];
            
          }

            $('#tgl_brgKeluar').html(tanggal);
            $("#mrk_brgKeluar").html(merk);
            $("#style_brgKeluar").html(style);
            $("#model_brgKeluar").html(model);
            $("#jml_brgKeluar").html(jml_brg);
            $("#cst_brgKeluar").html(cst);
            $("#ket_brgKeluar").html(ket);
          
        }
        });
        }

    fetch_add_brgKeluar();
    // Akhir Halaman Detail Barang Keluar

    // Edit Barang Keluar
    $(document).on("click", "#edit_barangKeluar", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("BarangKeluar/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          // console.log(data);
          if (data.responce == "success") {
              $('#edit_modal_brgKeluar').modal('show');
              $("#edit_id_brg_keluar").val(data.post.id_barang_keluar);
              $("#edit_tgl_brgKeluar").val(data.post.tgl);
              $("#edit_merk_brgKeluar").val(data.post.merk);
              $("#edit_style_brgKeluar").val(data.post.style);
              $("#edit_model_brgKeluar").val(data.post.model);
              $("#edit_jml_barangKeluar").val(data.post.jumlah);
              $("#edit_customer_brgKeluar").val(data.post.customer);
              $("#edit_add_ket_brgKeluar").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });   
    // Akhir Edit Barang Keluar

    // Update Barang Keluar
      $(document).on("click", "#update_brgKeluar", function(e){
      e.preventDefault();

      var edit_id_brg_keluar = $("#edit_id_brg_keluar").val();
      var edit_tgl_brgKeluar = $("#edit_tgl_brgKeluar").val();
      var edit_merk_brgKeluar = $("#edit_merk_brgKeluar").val();
      var edit_style_brgKeluar = $("#edit_style_brgKeluar").val();
      var edit_model_brgKeluar = $("#edit_model_brgKeluar").val();
      var edit_jml_barangKeluar = $("#edit_jml_barangKeluar").val();
      var edit_customer_brgKeluar = $("#edit_customer_brgKeluar").val();
      var edit_add_ket_brgKeluar = $("#edit_add_ket_brgKeluar").val();
      var date_create = Date.now();

        $.ajax({
          url: "<?php echo base_url('BarangKeluar/update'); ?>",
          type: "post",
          dataType: "json",
          data: {
            edit_id_brg_keluar: edit_id_brg_keluar,
            edit_tgl_brgKeluar: edit_tgl_brgKeluar,
            edit_merk_brgKeluar: edit_merk_brgKeluar,
            edit_style_brgKeluar: edit_style_brgKeluar,
            edit_model_brgKeluar: edit_model_brgKeluar,
            edit_jml_barangKeluar: edit_jml_barangKeluar,
            edit_customer_brgKeluar: edit_customer_brgKeluar,
            edit_add_ket_brgKeluar: edit_add_ket_brgKeluar,
            date_create:date_create
          
          },
          success: function(data){
            console.log(data);
            if (data.responce == "success") {
              fetch_add_brgKeluar();
              $('#edit_modal_brgKeluar').modal('hide');
              toastr["success"](data.message);
            }else{
              toastr["error"](data.message);
            }
          }
        });


      });
    // Akhir Update Barang Keluar

    </script>

  <!-- Akhir Halaman Barang Keluar -->

  <!-- Halaman Penjualan -->
  <script>
    //Insert Penjualan
    $(document).on("click", "#insert_penjualan", function(e){
      e.preventDefault();

      var tgl_penjualan = $('input[name="tgl_penjualan"]').val();
      var merk_penjualan = $('input[name="merk_penjualan"]').val();
      var style_penjualan = $('input[name="style_penjualan"]').val();
      var model_penjualan = $('input[name="model_penjualan"]').val();
      var jml_penjualan = $('input[name="jml_penjualan"]').val();
      var cst_penjualan = $('input[name="cst_penjualan"]').val();
      var harga_penjualan = $('input[name="harga_penjualan"]').val();
      var disc_penjualan = $('input[name="disc_penjualan"]').val();
      var total_penjualan = $('input[name="total_penjualan"]').val();
      var byr_penjualan = $('input[name="byr_penjualan"]').val();
      var add_ket_penjualan = $('#add_ket_penjualan').val();
      var date_create = Date.now();
      
      $.ajax({
        url: "<?= base_url();?>Penjualan/insert",
        type: "post",
        dataType: 'json',
        data: {
          tgl: tgl_penjualan,
          merk: merk_penjualan,
          style: style_penjualan,
          model: model_penjualan,
          jumlah: jml_penjualan,
          customer: cst_penjualan,
          harga: harga_penjualan,
          discount: disc_penjualan,
          total: total_penjualan,
          pembayaran: byr_penjualan,
          keterangan: add_ket_penjualan,
          status: 1,
          date_create: date_create
        },
        success: function(data){
          if(data.responce == "success") {
            $('#table_penjualan').DataTable().destroy();
            fetch_penjualan();  
            $('#add_modal_penjualan').modal('hide')
            toastr["success"](data.message);
          }else{
            toastr["error"](data.message)
          }
        }
      });
      
      $('#form_penjualan')[0].reset();

    });
    // Akhir Insert Penjualan

    // Fetch Table Penjualan
    function fetch_penjualan() {
      $.ajax({
        url: "<?= base_url();?>Penjualan/fetch",
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
          if (data.responce == "success") {
        $('#table_penjualan').DataTable( {
            "data": data.posts,
            "responsive": true,
            "columns": [
                { "data": "tgl" },
                { "data": "merk" },
                { "data": "style" },
                { "data": "model" },
                { "data": "jumlah" },
                { "data": "customer" },
                { "data": "harga"},
                { "render": function ( data, type, row, meta ) {
                  var a = `<a href="<?php echo base_url(). 'Penjualan/detail'; ?>/${row.id_penjualan}" class="btn btn-primary" ">Detail</a>`;
                  return a;
                } }
            ]
     } );                
    }else{
    toastr["error"](data.message);
    }
        }
      });
    }
    fetch_penjualan();

    // AKhir Fetch Table Penjualan

    // Halaman Detail Penjualan 
      function fetch_detail_penjualan() {

      var id = <?php echo $this->uri->segment('3')?>

      $.ajax({
          url: "<?php echo base_url("Penjualan/add_data") ?>",
          type: "get",
          dataType: "json",
          data: {
            id: id
          },
      success: function(data) {
        // console.log(data);
        var tanggal="", merk="", model="",style="", jml="", cst="",harga="",disc="",total="",bayar="", ket="";
        
        for (var key in data) {
            tanggal +=  data[key]['tgl'];
            merk +=  data[key]['merk'];
            style +=  data[key]['style'];                  
            model +=  data[key]['model'];
            jml +=  data[key]['jumlah'];
            cst +=  data[key]['customer'];
            harga +=  data[key]['harga'];
            disc +=  data[key]['discount'];
            total +=  data[key]['total'];
            bayar +=  data[key]['pembayaran'];
            ket +=  data[key]['keterangan'];
          
        }

          $('#tgl_penjualan').html(tanggal);
          $("#mrk_penjualan").html(merk);
          $("#style_penjualan").html(style);
          $("#model_penjualan").html(model);
          $("#jml_penjualan").html(jml);
          $("#cst_penjualan").html(cst);
          $("#harga_penjualan").html(harga);
          $("#disc_penjualan").html(disc);
          $("#total_penjualan").html(total);
          $("#byr_penjualan").html(bayar);
          $("#ket_penjualan").html(ket);
        
      }
      });
      }

      fetch_detail_penjualan();
    // Akhir Halaman Detail Penjualan

    // Edit Penjualan
    $(document).on("click", "#edit_penjualan", function(e){
      e.preventDefault();

      var edit_id = <?php echo $this->uri->segment('3')?>

      $.ajax({
        url: "<?php echo base_url("Penjualan/edit") ?>",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id
        },
        success: function(data){
          // console.log(data);
          if (data.responce == "success") {
              $('#edit_modal_penjualan').modal('show');
              $("#edit_penjualan_id").val(data.post.id_penjualan);
              $("#edit_tgl_penjualan").val(data.post.tgl);
              $("#edit_merk_penjualan").val(data.post.merk);
              $("#edit_style_penjualan").val(data.post.style);
              $("#edit_model_penjualan").val(data.post.model);
              $("#edit_jml_penjualan").val(data.post.jumlah);
              $("#edit_cst_penjualan").val(data.post.customer);
              $("#edit_harga_penjualan").val(data.post.harga);
              $("#edit_disc_penjualan").val(data.post.discount);
              $("#edit_total_penjualan").val(data.post.total);
              $("#edit_byr_penjualan").val(data.post.pembayaran);
              $("#edit_ket_penjualan").val(data.post.keterangan);
            
            }else{
              toastr["error"](data.message);
            }
        }
      });

    });   
    // Akhir Edit Penjualan

    // Update Penjualan
    $(document).on("click", "#update_penjualan", function(e){
      e.preventDefault();

      var edit_penjualan_id = $("#edit_penjualan_id").val();
      var edit_tgl_penjualan = $("#edit_tgl_penjualan").val();
      var edit_merk_penjualan = $("#edit_merk_penjualan").val();
      var edit_style_penjualan = $("#edit_style_penjualan").val();
      var edit_model_penjualan = $("#edit_model_penjualan").val();
      var edit_jml_penjualan = $("#edit_jml_penjualan").val();
      var edit_cst_penjualan = $("#edit_cst_penjualan").val();
      var edit_harga_penjualan = $("#edit_harga_penjualan").val();
      var edit_disc_penjualan = $("#edit_disc_penjualan").val();
      var edit_total_penjualan = $("#edit_total_penjualan").val();
      var edit_byr_penjualan = $("#edit_byr_penjualan").val();
      var edit_ket_penjualan = $("#edit_ket_penjualan").val();
      var date_create = Date.now();

        $.ajax({
          url: "<?php echo base_url('Penjualan/update'); ?>",
          type: "post",
          dataType: "json",
          data: {
            edit_penjualan_id: edit_penjualan_id,
            edit_tgl_penjualan: edit_tgl_penjualan,
            edit_merk_penjualan: edit_merk_penjualan,
            edit_style_penjualan: edit_style_penjualan,
            edit_model_penjualan: edit_model_penjualan,
            edit_jml_penjualan: edit_jml_penjualan,
            edit_cst_penjualan: edit_cst_penjualan,
            edit_harga_penjualan: edit_harga_penjualan,
            edit_disc_penjualan: edit_disc_penjualan,
            edit_total_penjualan: edit_total_penjualan,
            edit_byr_penjualan: edit_byr_penjualan,
            edit_ket_penjualan: edit_ket_penjualan,
            date_create:date_create
          
          },
          success: function(data){
            console.log(data);
            if (data.responce == "success") {
              fetch_detail_penjualan();
              $('#edit_modal_penjualan').modal('hide');
              toastr["success"](data.message);
            }else{
              toastr["error"](data.message);
            }
          }
        });


      });
    // Akhir Update Penjualan
  </script>

  <!-- Akhir Halaman Penjualan -->


</body>
</html>