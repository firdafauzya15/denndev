<aside class="main-sidebar">
   <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image"><img src="dist/img/avatar.png" class="img-circle" alt="User Image"></div>
         <div class="pull-left info"><p><?= $_SESSION['name'];?></p><a href="#"><i class="fa fa-circle text-success"></i> Online</a></div>
      </div>
      <ul class="sidebar-menu">
         <li class="header">MAIN NAVIGATION</li>
            <?php if ($_SESSION['id_level'] == '1') { // admin
            ?>
              <li class="treeview 
              <?= md5('brand')==$_GET['act'] || md5('pola')==$_GET['act'] || md5('model')==$_GET['act']|| md5('produk')==$_GET['act'] || md5('aksesoris')==$_GET['act'] || md5('bahan')==$_GET['act'] || md5('supplier_aksesoris')==$_GET['act'] || md5('supplier_bahan')==$_GET['act'] || md5('potong')==$_GET['act'] || md5('cmt')==$_GET['act'] || md5('vendor')==$_GET['act'] || md5('toko')==$_GET['act'] || md5('gudang')==$_GET['act'] || md5('customer')==$_GET['act'] || md5('user')==$_GET['act']
              || md5('brand_add')==$_GET['act'] || md5('pola_add')==$_GET['act'] || md5('model_add')==$_GET['act'] || md5('produk_add')==$_GET['act'] || md5('aksesoris_add')==$_GET['act'] ||md5('bahan_add')==$_GET['act'] || md5('supplier_aksesoris_add')==$_GET['act'] || md5('supplier_bahan_add')==$_GET['act'] || md5('potong_add')==$_GET['act'] || md5('cmt_add')==$_GET['act'] || md5('vendor_add')==$_GET['act'] || md5('toko_add')==$_GET['act'] || md5('gudang_add')==$_GET['act'] || md5('customer_add')==$_GET['act'] || md5('user_add')==$_GET['act']
              || md5('brand_edit')==$_GET['act'] || md5('pola_edit')==$_GET['act'] || md5('model_edit')==$_GET['act'] || md5('produk_edit')==$_GET['act'] || md5('aksesoris_edit')==$_GET['act'] || md5('bahan_edit')==$_GET['act'] || md5('supplier_aksesoris_edit')==$_GET['act'] || md5('supplier_bahan_edit')==$_GET['act'] || md5('potong_edit')==$_GET['act'] || md5('cmt_edit')==$_GET['act'] || md5('vendor_edit')==$_GET['act'] || md5('toko_edit')==$_GET['act'] || md5('gudang_edit')==$_GET['act'] || md5('customer_edit')==$_GET['act'] || md5('user_edit')==$_GET['act']
              ?'active':''?>">
                <a href="#"><i class="fa fa-database"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li <?= md5('brand')==$_GET['act'] || md5('brand_add')==$_GET['act'] || md5('brand_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('brand')?>"><i class="fa fa-circle-o"></i> Brand</a></li>
                  <li <?= md5('potong')==$_GET['act'] || md5('potong_add')==$_GET['act'] || md5('potong_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('potong')?>"><i class="fa fa-circle-o"></i> Tukang Potong</a></li>
                  <li <?= md5('pola')==$_GET['act'] || md5('pola_add')==$_GET['act'] || md5('pola_edit')==$_GET['act'] ?'class="active"':''?>><a href="?act=<?= md5('pola')?>"><i class="fa fa-circle-o"></i> Pola</a></li>
                  <li <?= md5('model')==$_GET['act'] || md5('model_add')==$_GET['act'] || md5('model_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('model')?>"><i class="fa fa-circle-o"></i> model</a></li>
                  <li <?= md5('produk')==$_GET['act'] || md5('produk_add')==$_GET['act'] || md5('produk_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                  <li <?= md5('aksesoris')==$_GET['act'] || md5('aksesoris_add')==$_GET['act'] || md5('aksesoris_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('aksesoris')?>"><i class="fa fa-circle-o"></i> Aksesoris</a></li>
                  <li <?= md5('supplier_aksesoris')==$_GET['act'] || md5('supplier_aksesoris_add')==$_GET['act'] || md5('supplier_aksesoris_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('supplier_aksesoris')?>"><i class="fa fa-circle-o"></i> Supplier Aksesoris</a></li>
                  <li <?= md5('bahan')==$_GET['act'] || md5('bahan_add')==$_GET['act'] || md5('bahan_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('bahan')?>"><i class="fa fa-circle-o"></i> Bahan</a></li>
                  <li <?= md5('supplier_bahan')==$_GET['act'] || md5('supplier_bahan_add')==$_GET['act'] || md5('supplier_bahan_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('supplier_bahan')?>"><i class="fa fa-circle-o"></i> Supplier Bahan</a></li>
                  <li <?= md5('vendor')==$_GET['act'] || md5('vendor_add')==$_GET['act'] || md5('vendor_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('vendor')?>"><i class="fa fa-circle-o"></i> Vendor Sablon / Bordir</a></li>
                  <li <?= md5('cmt')==$_GET['act'] || md5('cmt_add')==$_GET['act'] || md5('cmt_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('cmt')?>"><i class="fa fa-circle-o"></i> CMT</a></li>
                  <li <?= md5('toko')==$_GET['act'] || md5('toko_add')==$_GET['act'] || md5('toko_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('toko')?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                  <li <?= md5('gudang')==$_GET['act'] || md5('gudang_add')==$_GET['act'] || md5('gudang_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('gudang')?>"><i class="fa fa-circle-o"></i> Gudang</a></li>
                  <li <?= md5('customer')==$_GET['act'] || md5('customer_add')==$_GET['act']  || md5('customer_edit')==$_GET['act'] ?'class="active"':''?>><a href="?act=<?= md5('customer')?>"><i class="fa fa-circle-o"></i> Customer</a></li>
                  <li <?= md5('user')==$_GET['act'] || md5('user_add')==$_GET['act']  || md5('user_edit')==$_GET['act'] ?'class="active"':''?>><a href="?act=<?= md5('user')?>"><i class="fa fa-circle-o"></i> User</a></li>
                </ul>
              </li>
              <li class="treeview 
				  <?= md5('pembelian_aksesoris')==$_GET['act'] || md5('potongan_merk')==$_GET['act']  || md5('pembelian_bahan')==$_GET['act'] || md5('spk_cutting')==$_GET['act'] || md5('sablon')==$_GET['act'] || md5('produksi')==$_GET['act'] || md5('barang_masuk')==$_GET['act']
              || md5('pembelian_aksesoris_add')==$_GET['act'] || md5('potongan_merk_add')==$_GET['act']  || md5('pembelian_bahan_add')==$_GET['act'] || md5('spk_cutting_add')==$_GET['act'] || md5('sablon_add')==$_GET['act'] ||md5('produksi_add')==$_GET['act'] || md5('barang_masuk_add')==$_GET['act']
              || md5('pembelian_aksesoris_edit')==$_GET['act'] || md5('potongan_merk_edit')==$_GET['act'] || md5('pembelian_bahan_edit')==$_GET['act'] || md5('spk_cutting_edit')==$_GET['act'] || md5('sablon_edit')==$_GET['act'] || md5('produksi_edit')==$_GET['act'] || md5('barang_masuk_edit')==$_GET['act']
              ?'active':''?>">
                <a href="#"><i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li <?= md5('pembelian_aksesoris')==$_GET['act'] || md5('pembelian_aksesoris_add')==$_GET['act'] || md5('pembelian_aksesoris_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('pembelian_aksesoris')?>"><i class="fa fa-circle-o"></i> Pembelian Aksesoris</a></li>
                  <li <?= md5('potongan_merk')==$_GET['act'] || md5('potongan_merk_add')==$_GET['act'] || md5('potongan_merk_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('potongan_merk')?>"><i class="fa fa-circle-o"></i> Keluar Aksesoris Ke CMT</a></li>
                  <li <?= md5('pembelian_bahan')==$_GET['act'] || md5('pembelian_bahan_add')==$_GET['act'] || md5('pembelian_bahan_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                  <li <?= md5('spk_cutting')==$_GET['act'] || md5('spk_cutting_add')==$_GET['act'] || md5('spk_cutting_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('spk_cutting')?>"><i class="fa fa-circle-o"></i> SPK Cutting</a></li>
                  <li <?= md5('sablon')==$_GET['act'] || md5('sablon_add')==$_GET['act'] || md5('sablon_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('sablon')?>"><i class="fa fa-circle-o"></i> Sablon / Bordir</a></li>
                  <li <?= md5('produksi')==$_GET['act'] || md5('produksi_add')==$_GET['act'] || md5('pproduksi_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                  <li <?= md5('barang_masuk')==$_GET['act'] || md5('barang_masuk_add')==$_GET['act'] || md5('barang_masuk_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('barang_masuk')?>"><i class="fa fa-circle-o"></i> Pembelian Ekstenal</a></li>
                </ul>
              </li>


            
              <li class="treeview
				  <?= md5('surat_jalan')==$_GET['act'] || md5('surat_jalan_toko')==$_GET['act'] || md5('surat_jalan_ekspedisi')==$_GET['act']
				   || md5('surat_jalan_add')==$_GET['act'] || md5('surat_jalan_toko_add')==$_GET['act'] || md5('surat_jalan_ekspedisi_add')==$_GET['act']
           || md5('surat_jalan_edit')==$_GET['act'] || md5('surat_jalan_toko_edit')==$_GET['act'] || md5('surat_jalan_ekspedisi_edit')==$_GET['act']
              ?'active':''?>">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('surat_jalan')==$_GET['act'] || md5('surat_jalan_add')==$_GET['act'] || md5('surat_jalan_detail')==$_GET['act'] || md5('surat_jalan_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li <?= md5('surat_jalan_toko')==$_GET['act'] || md5('surat_jalan_toko_add')==$_GET['act'] || md5('surat_jalan_toko_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                  <li <?= md5('surat_jalan_ekspedisi')==$_GET['act'] || md5('surat_jalan_ekspedisi_add')==$_GET['act'] || md5('surat_jalan_ekspedisi_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('surat_jalan_ekspedisi')?>"><i class="fa fa-circle-o"></i> Surat Jalan Ekspedisi</a></li>
                </ul>
              </li>
              <li class="treeview
				  <?= md5('penjualan_add')==$_GET['act'] || md5('penjualan')==$_GET['act'] || md5('penjualan_piutang')==$_GET['act']
              ?'active':''?>">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i> <span>Penjualan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('penjualan_add')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penjualan_add')?>"><i class="fa fa-circle-o"></i> Tambah Penjualan</a></li>
                  <li <?= md5('penjualan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penjualan')?>"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
                  <li <?= md5('penjualan_piutang')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penjualan_piutang')?>"><i class="fa fa-circle-o"></i> Piutang</a></li>
                </ul>
              </li>
              <li class="treeview 
              <?= md5('penjualan_pending_add')==$_GET['act'] || md5('penjualan_pending')==$_GET['act'] ?'active':''?>">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i> <span>Penjualan Pending</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('penjualan_pending_add')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penjualan_pending_add')?>"><i class="fa fa-circle-o"></i> Tambah Penjualan</a></li>
                  <li <?= md5('penjualan_pending')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penjualan_pending')?>"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
                </ul>
              </li>
              <li class="treeview <?= md5('retur_bahan')==$_GET['act'] || md5('retur_penjualan')==$_GET['act'] ?'active':''?>">
                <a href="#">
                  <i class="fa fa-refresh"></i> <span>Retur</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('retur_bahan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('retur_bahan')?>"><i class="fa fa-circle-o"></i> Bahan</a></li>
                  <li <?= md5('retur_penjualan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('retur_penjualan')?>"><i class="fa fa-circle-o"></i> Barang dari Toko</a></li>
                </ul>
              </li>
              <li <?= md5('pengeluaran')==$_GET['act']?'class="active"':''?>>
					  <a href="?act=<?= md5('pengeluaran')?>"><i class="fa fa-money-bill"></i> <span>Ganti Rugi Vendor</span></a>
              </li>

              <li <?= md5('qc_cutting')==$_GET['act']?'class="active"':''?>>
                <a href="?act=<?= md5('qc_cutting')?>"><i class="fa fa-calendar-check"></i> <span>QC SPK Cutting</span></a>
              </li>
              <li <?= md5('qc_sablon')==$_GET['act']?'class="active"':''?>>
                <a href="?act=<?= md5('qc_sablon')?>"><i class="fa fa-calendar-check"></i> <span>QC Sablon</span></a>
              </li>
              <li <?= md5('qc')==$_GET['act']?'class="active"':''?>>
                <a href="?act=<?= md5('qc')?>"><i class="fa fa-calendar-check"></i> <span>QC CMT</span></a>
              </li>
              <li class="treeview 
              <?= md5('penyesuaian_gudang')==$_GET['act'] || md5('penyesuaian_toko')==$_GET['act'] 
              || md5('penyesuaian_gudang_add')==$_GET['act'] || md5('penyesuaian_toko_add')==$_GET['act'] 
              || md5('penyesuaian_gudang_edit')==$_GET['act'] || md5('penyesuaian_toko_edit')==$_GET['act'] 
              ?'active':''?>">
                <a href="#"><i class="fa fa-wrench"></i> <span>Penyesuaian Stok</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li <?= md5('penyesuaian_gudang')==$_GET['act'] || md5('penyesuaian_gudang_add')==$_GET['act'] || md5('penyesuaian_gudang_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penyesuaian_gudang')?>"><i class="fa fa-circle-o"></i> Gudang</a></li>
                  <li <?= md5('penyesuaian_toko')==$_GET['act'] || md5('penyesuaian_toko_add')==$_GET['act'] || md5('penyesuaian_toko_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('penyesuaian_toko')?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                </ul>
              </li>
              <li class="treeview
				  <?= md5('laporan_stok_gudang')==$_GET['act'] || md5('laporan_stok')==$_GET['act'] || md5('laporan_stok_aksesoris')==$_GET['act'] || md5('laporan_stok_bahan')==$_GET['act'] 
				  || md5('laporan_pembelian_bahan')==$_GET['act'] || md5('laporan_pembayaran_cutting')==$_GET['act'] || md5('laporan_pembayaran_sablon')==$_GET['act'] || md5('laporan_pembayaran_cmt')==$_GET['act']
				  || md5('laporan_pengiriman_cmt')==$_GET['act'] || md5('laporan_penjualan')==$_GET['act'] || md5('laporan_product_cost')==$_GET['act'] || md5('laporan_rincian_produk')==$_GET['act'] 
				  || md5('laporan_laba_rugi')==$_GET['act'] || md5('laporan_laba_rugi_nota')==$_GET['act'] || md5('laporan_best_seller')==$_GET['act'] || md5('laporan_settlement_harian')==$_GET['act'] 
				  || md5('laporan_retur_penjualan')==$_GET['act'] || md5('laporan_grafik_penjualan_bulanan')==$_GET['act'] || md5('laporan_grafik_penjualan_tahunan')==$_GET['act']
				  ?'active':''?>">
                <a href="#"><i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li <?= md5('laporan_stok_gudang')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_stok_gudang')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Gudang</a></li>
                  <li <?= md5('laporan_stok')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_stok')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Toko</a></li>
                  <li <?= md5('laporan_stok_aksesoris')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_stok_aksesoris')?>"><i class="fa fa-circle-o"></i> Data / Stok Aksesoris</a></li>
                  <li <?= md5('laporan_stok_bahan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_stok_bahan')?>"><i class="fa fa-circle-o"></i> Data / Stok Bahan</a></li>
                  <li <?= md5('laporan_pembelian_bahan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                  <li <?= md5('laporan_pembayaran_cutting')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pembayaran_cutting')?>"><i class="fa fa-circle-o"></i> Pembayaran Cutting</a></li>
                  <li <?= md5('laporan_pembayaran_sablon')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pembayaran_sablon')?>"><i class="fa fa-circle-o"></i> Pembayaran Sablon</a></li>
                  <li <?= md5('laporan_pembayaran_cmt_pending')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pembayaran_cmt_pending')?>"><i class="fa fa-circle-o"></i> Pembayaran CMT Pending</a></li>
                  <li <?= md5('laporan_pembayaran_cmt_lunas')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pembayaran_cmt_lunas')?>"><i class="fa fa-circle-o"></i> Pembayaran CMT Lunas</a></li>
                  <li <?= md5('laporan_pengiriman_cmt')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_pengiriman_cmt')?>"><i class="fa fa-circle-o"></i> Pengiriman CMT</a></li>
                  <li <?= md5('laporan_penjualan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
                  <li <?= md5('laporan_product_cost')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_product_cost')?>"><i class="fa fa-circle-o"></i> Product Cost</a></li>
                  <li <?= md5('laporan_rincian_produk')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_rincian_produk')?>"><i class="fa fa-circle-o"></i> Rincian Produk</a></li>
                  <li <?= md5('laporan_laba_rugi')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_laba_rugi')?>"><i class="fa fa-circle-o"></i> Laba Rugi Produk</a></li>
                  <li <?= md5('laporan_laba_rugi_nota')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_laba_rugi_nota')?>"><i class="fa fa-circle-o"></i> Laba Rugi Nota</a></li>
                  <li <?= md5('laporan_best_seller')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_best_seller')?>"><i class="fa fa-circle-o"></i> Best Seller</a></li>
                  <li <?= md5('laporan_settlement_harian')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_settlement_harian')?>"><i class="fa fa-circle-o"></i> Settlement Harian</a></li>
                  <li <?= md5('laporan_retur_penjualan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_retur_penjualan')?>"><i class="fa fa-circle-o"></i> Retur Penjualan</a></li>
                  <li <?= md5('laporan_grafik_penjualan_bulanan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_grafik_penjualan_bulanan')?>"><i class="fa fa-circle-o"></i> Grafik Penjualan Bulanan</a></li>
                  <li <?= md5('laporan_grafik_penjualan_tahunan')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('laporan_grafik_penjualan_tahunan')?>"><i class="fa fa-circle-o"></i> Grafik Penjualan Tahunan</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '2') {
            // kasir
            ?>
              <li class="treeview
				      <?= md5('surat_jalan')==$_GET['act'] || md5('surat_jalan_toko')==$_GET['act']
              || md5('surat_jalan_add')==$_GET['act'] || md5('surat_jalan_toko_add')==$_GET['act'] 
              || md5('surat_jalan_edit')==$_GET['act'] || md5('surat_jalan_toko_edit')==$_GET['act'] 
              ?'active':''?>">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('surat_jalan')==$_GET['act'] || md5('surat_jalan_add')==$_GET['act'] || md5('surat_jalan_detail')==$_GET['act'] || md5('surat_jalan_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li <?= md5('surat_jalan_toko')==$_GET['act'] || md5('surat_jalan_toko_add')==$_GET['act'] || md5('surat_jalan_toko_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('penjualan_add')?>"><i class="fa fa-circle-o"></i> Tambah Penjualan</a></li>
                  <li><a href="?act=<?= md5('penjualan')?>"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
                  <li><a href="?act=<?= md5('penjualan_piutang')?>"><i class="fa fa-circle-o"></i> Piutang</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-refresh"></i> <span>Retur</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('retur_penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Toko</a></li>
                  <li><a href="?act=<?= md5('laporan_settlement_harian')?>"><i class="fa fa-circle-o"></i> Settlement Harian</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '3') {
            // gudang
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('brand')?>"><i class="fa fa-circle-o"></i> Brand</a></li>
                  <li><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                </ul>
              </li>
              <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-industry"></i> Produksi CMT</a></li>
              <li><a href="?act=<?= md5('barang_masuk')?>"><i class="fa fa-industry"></i> Barang Masuk</a></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok_gudang')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Gudang</a></li>
                  <li><a href="?act=<?= md5('laporan_stok')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Toko</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '4') {
            // produksi
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('pembelian_aksesoris')?>"><i class="fa fa-circle-o"></i> Pembelian Aksesoris</a></li>
                  <li><a href="?act=<?= md5('pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                  <li><a href="?act=<?= md5('spk_cutting')?>"><i class="fa fa-circle-o"></i>SPK Cutting</a></li>
                  <li><a href="?act=<?= md5('sablon')?>"><i class="fa fa-circle-o"></i> Sablon</a></li>
                  <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '5') {
            // kantor
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('brand')==$_GET['act'] || md5('brand_add')==$_GET['act'] || md5('brand_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?php echo md5('brand')?>"><i class="fa fa-circle-o"></i> Brand</a></li>
                  <li ><a href="?act=<?= md5('pola')?>"><i class="fa fa-circle-o"></i> Pola</a></li>
                  <li><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                  <li><a href="?act=<?= md5('aksesoris')?>"><i class="fa fa-circle-o"></i> Aksesoris</a></li>
                  <li><a href="?act=<?= md5('bahan')?>"><i class="fa fa-circle-o"></i> Bahan</a></li>
                  <li><a href="?act=<?= md5('supplier_aksesoris')?>"><i class="fa fa-circle-o"></i> Supplier Aksesoris</a></li>
                  <li><a href="?act=<?= md5('supplier_bahan')?>"><i class="fa fa-circle-o"></i> Supplier Bahan</a></li>
                  <li><a href="?act=<?= md5('cmt')?>"><i class="fa fa-circle-o"></i> CMT</a></li>
                  <li><a href="?act=<?= md5('vendor')?>"><i class="fa fa-circle-o"></i> Vendor</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('pembelian_aksesoris')?>"><i class="fa fa-circle-o"></i> Pembelian Aksesoris</a></li>
                  <li><a href="?act=<?= md5('pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                  <li><a href="?act=<?= md5('spk_cutting')?>"><i class="fa fa-circle-o"></i>SPK Cutting</a></li>
                  <li><a href="?act=<?= md5('sablon')?>"><i class="fa fa-circle-o"></i> Sablon</a></li>
                  <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                  <li><a href="?act=<?= md5('barang_masuk')?>"><i class="fa fa-circle-o"></i> Barang Masuk</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok_gudang')?>"><i class="fa fa-circle-o"></i> Data / Stok Barang Gudang</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '6') {
            // okah
            ?>
              <li class="treeview 
              <?= md5('brand')==$_GET['act'] || md5('pola')==$_GET['act'] || md5('produk')==$_GET['act'] || md5('potong')==$_GET['act'] 
              || md5('brand_add')==$_GET['act'] || md5('pola_add')==$_GET['act'] || md5('produk_add')==$_GET['act']  || md5('potong_add')==$_GET['act']
              || md5('brand_edit')==$_GET['act'] || md5('pola_edit')==$_GET['act'] || md5('produk_edit')==$_GET['act'] || md5('potong_edit')==$_GET['act']
              ?'active':''?>">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li <?= md5('brand')==$_GET['act'] || md5('brand_add')==$_GET['act'] || md5('brand_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('brand')?>"><i class="fa fa-circle-o"></i> Brand</a></li>
                  <li <?= md5('pola')==$_GET['act'] || md5('pola_add')==$_GET['act'] || md5('pola_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('pola')?>"><i class="fa fa-circle-o"></i> Pola</a></li>
                  <li <?= md5('produk')==$_GET['act'] || md5('produk_add')==$_GET['act'] || md5('produk_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                  <li <?= md5('potong')==$_GET['act'] || md5('potong_add')==$_GET['act'] || md5('potong_edit')==$_GET['act']?'class="active"':''?>><a href="?act=<?= md5('potong')?>"><i class="fa fa-circle-o"></i> Tukang Potong</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('spk_cutting')?>"><i class="fa fa-circle-o"></i>SPK Cutting</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '7') {
            // vegi
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('bahan')?>"><i class="fa fa-circle-o"></i> Bahan</a></li>
                  <li><a href="?act=<?= md5('supplier_bahan')?>"><i class="fa fa-circle-o"></i> Supplier Bahan</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-refresh"></i> <span>Retur</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('retur_bahan')?>"><i class="fa fa-circle-o"></i> Bahan</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok_bahan')?>"><i class="fa fa-circle-o"></i> Data / Stok Bahan</a></li>
                  <li><a href="?act=<?= md5('laporan_pembelian_bahan')?>"><i class="fa fa-circle-o"></i> Pembelian Bahan</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '8') {
            // ani
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('vendor')?>"><i class="fa fa-circle-o"></i> Vendor</a></li>
                  <li><a href="?act=<?= md5('cmt')?>"><i class="fa fa-circle-o"></i> CMT</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li>
                <a href="?act=<?= md5('potongan_merk')?>">
                  <i class="fa fa-cut"></i> <span>Potongan Merk</span>
                </a>
              </li>
              <li>
                <a href="?act=<?= md5('qc')?>">
                  <i class="fa fa-calendar-check-o"></i> <span>QC</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_pembayaran_sablon')?>"><i class="fa fa-circle-o"></i> Pembayaran Sablon</a></li>
                  <li><a href="?act=<?= md5('laporan_pembayaran_cmt')?>"><i class="fa fa-circle-o"></i> Pembayaran CMT</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '9') {
            // nando
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('aksesoris')?>"><i class="fa fa-circle-o"></i> Aksesoris</a></li>
                  <li><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                  <li><a href="?act=<?= md5('supplier_aksesoris')?>"><i class="fa fa-circle-o"></i> Supplier Aksesoris</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('pembelian_aksesoris')?>"><i class="fa fa-circle-o"></i> Pembelian Aksesoris</a></li>
                  <li><a href="?act=<?= md5('sablon')?>"><i class="fa fa-circle-o"></i> Sablon / Bordir</a></li>
                  <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li>
                <a href="?act=<?= md5('potongan_merk')?>">
                  <i class="fa fa-cut"></i> <span>Potongan Merk</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok_aksesoris')?>"><i class="fa fa-circle-o"></i> Data / Stok Aksesoris</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '10') {
            // sari
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_pembayaran_cutting')?>"><i class="fa fa-circle-o"></i> Pembayaran Cutting</a></li>
                </ul>
              </li>
            <?php
            } else if ($_SESSION['id_level'] == '11') {
            // adi
            ?>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Setting Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('aksesoris')?>"><i class="fa fa-circle-o"></i> Aksesoris</a></li>
                  <li><a href="?act=<?= md5('produk')?>"><i class="fa fa-circle-o"></i> Produk</a></li>
                  <li><a href="?act=<?= md5('supplier_aksesoris')?>"><i class="fa fa-circle-o"></i> Supplier Aksesoris</a></li>
                  <li><a href="?act=<?= md5('vendor')?>"><i class="fa fa-circle-o"></i> Vendor</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-industry"></i> <span>Produksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('pembelian_aksesoris')?>"><i class="fa fa-circle-o"></i> Pembelian Aksesoris</a></li>
                  <li><a href="?act=<?= md5('sablon')?>"><i class="fa fa-circle-o"></i> Sablon / Bordir</a></li>
                  <li><a href="?act=<?= md5('produksi')?>"><i class="fa fa-circle-o"></i> Produksi CMT</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-truck"></i> <span>Surat Jalan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('surat_jalan')?>"><i class="fa fa-circle-o"></i> Surat Jalan ke Toko</a></li>
                  <li><a href="?act=<?= md5('surat_jalan_toko')?>"><i class="fa fa-circle-o"></i> Surat Jalan antar Toko</a></li>
                </ul>
              </li>
              <li>
                <a href="?act=<?= md5('potongan_merk')?>">
                  <i class="fa fa-cut"></i> <span>Potongan Merk</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="?act=<?= md5('laporan_stok_aksesoris')?>"><i class="fa fa-circle-o"></i> Data / Stok Aksesoris</a></li>
                  <li><a href="?act=<?= md5('laporan_pembayaran_sablon')?>"><i class="fa fa-circle-o"></i> Pembayaran Sablon</a></li>
                </ul>
              </li>
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>