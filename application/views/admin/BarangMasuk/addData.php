<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header" style="background-color:#00456D;">
            <h1 style="color:white;">Advanced Forms</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Barang_masuk');?>" style="color:#ced2ed;">Barang Masuk</a></div>
              <div class="breadcrumb-item disabled" style="color:#ced2ed; font-weight: bold">Detail</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Advanced Forms</h2>
            <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

              <div class="card">
                <div class="card-header">
                    <div class="col">
                      <h4>Barang Masuk (APX0661)</h4>
                    </div>
                    
                    <div class="col"></div>
                    
                    <div class="col d-flex justify-content-around">
                          <a href="<?= base_url('Barang_masuk');?>" class="btn btn-outline-danger"><i class="fas fa-chevron-left fa-lg"></i> Kembali</a>
                          <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Selengkapnya
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item has-icon" href="" type="button" data-toggle="modal" data-target="#edit_modal_brgMasuk" id="edit_barangMasuk"><i class="fas fa-pen" ></i> Update</a>
                              <a class="dropdown-item has-icon tombol-recycle" href="<?php echo base_url(). 'Barang_masuk/recycle'; ?>/<?php echo $this->uri->segment('3')?>"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                          </div>
                    </div>
                </div>
                <!-- End Card Header -->

                <div class="card-body">
                  <!-- Row 1 -->
                  <div class="row">
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Tanggal</p>
                      </div>
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="tgl_brgMasuk">Ini Tanggal</h6>
                      </div>
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Merk</p>
                      </div>
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="mrk_brgMasuk">Ini Merek</h6>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Style</p>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="style_brgMasuk">Ini Style</h6>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Model</p>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="model_brgMasuk">Ini Model</h6>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Jumlah</p>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="jml_brgMasuk">Ini Jumlah Barang Masuk</h6>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>CMT</p>
                      </div>

                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <h6 id="cmt_brgMasuk">Ini CMT</h6>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6 col-md-3 col-lg-3 mb-5">
                        <p>Keterangan Lain</p>
                      </div>

                      <div class="col-6 col-md-6 col-lg-6 mb-5">
                      <h6 id="ket_brgMasuk">Ini Keterangan</h6>
                      </div>
                    </div>


                 <!-- End Row 1 -->
                </div>
                <!-- <div class="card">
                  <div class="card-header">
                    <div class="row"> -->
                     

                      <!-- <div class="item-top-right">
                        <div class="col-md-12 offset-md-8">
                          <a href="#" class="btn btn-secondary">Secondary</a>
                          <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              With Icon
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
                              <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another action</a>
                              <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                            </div>
                          </div>
                        </div>
                      </div> -->
                    <!-- </div>
                  </div>
                </div> -->
                
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Modal Edit Data Bahan -->

      <div class="modal fade" tabindex="-1" role="dialog" id="edit_modal_brgMasuk">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Form Input Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" action="" method="post" id="form_brgMasuk">
                <!-- Row -->
                  <div class="row ">
                    <div class="col">
                    <div class="form-group">
                      <label>Tanggal</label>
                      <input type="hidden" id="edit_id_brg_masuk" value="">
                      <input type="date" class="form-control datemask" placeholder="YYYY/MM/DD" id="edit_tgl_brgMasuk">
                      </div>
                  </div>
                  <div class="col">
                  <div class="form-group">
                      <label>Merk</label>
                      <input type="text" class="form-control" autocomplete="" id="edit_merk_brgMasuk">
                      </div>
                  </div>
                  <div class="col">
                  <div class="form-group">
                      <label>Style</label>
                      <input type="text" class="form-control" autocomplete="" id="edit_style_brgMasuk">
                      </div>
                  </div>
                </div>
                  <!-- End Row -->

                <!-- Row -->
                <div class="row ">
                    <div class="col">
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" class="form-control purchase-code" id="edit_model_brgMasuk" placeholder="ASDF-GHIJ-KLMN-OPQR">
                      </div>
                  </div>
                  <div class="col">
                  <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control invoice-input" id="edit_jml_brgMasuk">
                      </div>
                  </div>
                  <div class="col">
                  <div class="form-group">
                        <label>CMT</label>
                        <input type="text" class="form-control invoice-input" id="edit_cmt_brgMasuk">
                      </div>
                  </div>
                </div>
                <!-- End Row -->
                
              <!--Row-->
              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Keterangan Lain</label>
                        <textarea class="form-control" id="edit_add_ket_brgMasuk" rows="3"></textarea>
                    </div>
                </div>
              </div>
                </form>
            </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_brgMasuk">Save changes</button>
              </div>
            </div>
          </div>
        </div>
       
        <!-- Akhir Modal Tambah Data -->