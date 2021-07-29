<?php include"structure/library_head.php";?>
<?php include"structure/header.php";?>
<?php include"structure/menu.php";?>

<?php
switch($_GET['act']){

  default;
	include"structure/dashboard.php";
	break;

	//gudang
	case md5("gudang");
	include"master/pg_gudang/gudang_list.php";
	break;
	case md5("gudang_add");
	include"master/pg_gudang/gudang_add.php";
	break;
	case md5("gudang_insert");
	include"master/pg_gudang/gudang_insert.php";
	break;
	case md5("gudang_edit");
	include"master/pg_gudang/gudang_edit.php";
	break;
	case md5("gudang_update");
	include"master/pg_gudang/gudang_update.php";
	break;
	case md5("gudang_delete");
	include"master/pg_gudang/gudang_delete.php";
	break;

	//user
	case md5("user");
	include"master/pg_user/user_list.php";
	break;
	case md5("user_add");
	include"master/pg_user/user_add.php";
	break;
	case md5("user_insert");
	include"master/pg_user/user_insert.php";
	break;
	case md5("user_edit");
	include"master/pg_user/user_edit.php";
	break;
	case md5("user_update");
	include"master/pg_user/user_update.php";
	break;
	case md5("user_delete");
	include"master/pg_user/user_delete.php";
	break;


	//brand
	case md5("brand");
	include"master/pg_brand/brand_list.php";
	break;
	case md5("brand_add");
	include"master/pg_brand/brand_add.php";
	break;
	case md5("brand_insert");
	include"master/pg_brand/brand_insert.php";
	break;
	case md5("brand_edit");
	include"master/pg_brand/brand_edit.php";
	break;
	case md5("brand_update");
	include"master/pg_brand/brand_update.php";
	break;
	case md5("brand_delete");
	include"master/pg_brand/brand_delete.php";
	break;

	
	//kategori
	case md5("kategori");
	include"master/pg_kategori/kategori_list.php";
	break;
	case md5("kategori_add");
	include"master/pg_kategori/kategori_add.php";
	break;
	case md5("kategori_insert");
	include"master/pg_kategori/kategori_insert.php";
	break;
	case md5("kategori_edit");
	include"master/pg_kategori/kategori_edit.php";
	break;
	case md5("kategori_update");
	include"master/pg_kategori/kategori_update.php";
	break;
	case md5("kategori_delete");
	include"master/pg_kategori/kategori_delete.php";
	break;

	
	//pola
	case md5("pola");
	include"master/pg_pola/pola_list.php";
	break;
	case md5("pola_add");
	include"master/pg_pola/pola_add.php";
	break;
	case md5("pola_insert");
	include"master/pg_pola/pola_insert.php";
	break;
	case md5("pola_edit");
	include"master/pg_pola/pola_edit.php";
	break;
	case md5("pola_update");
	include"master/pg_pola/pola_update.php";
	break;
	case md5("pola_delete");
	include"master/pg_pola/pola_delete.php";
	break;

	//model
	case md5("model");
	include"master/pg_model/model_list.php";
	break;
	case md5("model_add");
	include"master/pg_model/model_add.php";
	break;
	case md5("model_insert");
	include"master/pg_model/model_insert.php";
	break;
	case md5("model_edit");
	include"master/pg_model/model_edit.php";
	break;
	case md5("model_update");
	include"master/pg_model/model_update.php";
	break;
	case md5("model_delete");
	include"master/pg_model/model_delete.php";
	break;
	
	//produk
	case md5("produk");
	include"master/pg_produk/produk_list.php";
	break;
	case md5("produk_detail");
	include"master/pg_produk/produk_detail.php";
	break;
	case md5("produk_add");
	include"master/pg_produk/produk_add.php";
	break;
	case md5("produk_add_next");
	include"master/pg_produk/produk_add_next.php";
	break;
	case md5("produk_insert");
	include"master/pg_produk/produk_insert.php";
	break;
	case md5("produk_edit");
	include"master/pg_produk/produk_edit.php";
	break;
	case md5("produk_update");
	include"master/pg_produk/produk_update.php";
	break;
	case md5("produk_delete");
	include"master/pg_produk/produk_delete.php";
	break;
	

	//toko
	case md5("toko");
	include"master/pg_toko/toko_list.php";
	break;
	case md5("toko_add");
	include"master/pg_toko/toko_add.php";
	break;
	case md5("toko_insert");
	include"master/pg_toko/toko_insert.php";
	break;
	case md5("toko_edit");
	include"master/pg_toko/toko_edit.php";
	break;
	case md5("toko_update");
	include"master/pg_toko/toko_update.php";
	break;
	case md5("toko_delete");
	include"master/pg_toko/toko_delete.php";
	break;


	//bahan
	case md5("bahan");
	include"master/pg_bahan/bahan_list.php";
	break;
	case md5("bahan_add");
	include"master/pg_bahan/bahan_add.php";
	break;
	case md5("bahan_insert");
	include"master/pg_bahan/bahan_insert.php";
	break;
	case md5("bahan_edit");
	include"master/pg_bahan/bahan_edit.php";
	break;
	case md5("bahan_update");
	include"master/pg_bahan/bahan_update.php";
	break;
	case md5("bahan_delete");
	include"master/pg_bahan/bahan_delete.php";
	break;
	case md5("bahan_delete_item");
	include"master/pg_bahan/bahan_delete_item.php";
	break;


	//aksesoris
	case md5("aksesoris");
	include"master/pg_aksesoris/aksesoris_list.php";
	break;
	case md5("aksesoris_add");
	include"master/pg_aksesoris/aksesoris_add.php";
	break;
	case md5("aksesoris_insert");
	include"master/pg_aksesoris/aksesoris_insert.php";
	break;
	case md5("aksesoris_edit");
	include"master/pg_aksesoris/aksesoris_edit.php";
	break;
	case md5("aksesoris_update");
	include"master/pg_aksesoris/aksesoris_update.php";
	break;
	case md5("aksesoris_delete");
	include"master/pg_aksesoris/aksesoris_delete.php";
	break;


	//cmt
	case md5("cmt");
	include"master/pg_cmt/cmt_list.php";
	break;
	case md5("cmt_add");
	include"master/pg_cmt/cmt_add.php";
	break;
	case md5("cmt_insert");
	include"master/pg_cmt/cmt_insert.php";
	break;
	case md5("cmt_edit");
	include"master/pg_cmt/cmt_edit.php";
	break;
	case md5("cmt_update");
	include"master/pg_cmt/cmt_update.php";
	break;
	case md5("cmt_delete");
	include"master/pg_cmt/cmt_delete.php";
	break;


	//customer
	case md5("customer");
	include"master/pg_customer/customer_list.php";
	break;
	case md5("customer_add");
	include"master/pg_customer/customer_add.php";
	break;
	case md5("customer_insert");
	include"master/pg_customer/customer_insert.php";
	break;
	case md5("customer_edit");
	include"master/pg_customer/customer_edit.php";
	break;
	case md5("customer_update");
	include"master/pg_customer/customer_update.php";
	break;
	case md5("customer_delete");
	include"master/pg_customer/customer_delete.php";
	break;


	//vendor
	case md5("vendor");
	include"master/pg_vendor/vendor_list.php";
	break;
	case md5("vendor_add");
	include"master/pg_vendor/vendor_add.php";
	break;
	case md5("vendor_insert");
	include"master/pg_vendor/vendor_insert.php";
	break;
	case md5("vendor_edit");
	include"master/pg_vendor/vendor_edit.php";
	break;
	case md5("vendor_update");
	include"master/pg_vendor/vendor_update.php";
	break;
	case md5("vendor_delete");
	include"master/pg_vendor/vendor_delete.php";
	break;


	//potong
	case md5("potong");
	include"master/pg_potong/potong_list.php";
	break;
	case md5("potong_add");
	include"master/pg_potong/potong_add.php";
	break;
	case md5("potong_insert");
	include"master/pg_potong/potong_insert.php";
	break;
	case md5("potong_edit");
	include"master/pg_potong/potong_edit.php";
	break;
	case md5("potong_update");
	include"master/pg_potong/potong_update.php";
	break;
	case md5("potong_delete");
	include"master/pg_potong/potong_delete.php";
	break;


	//supplier_bahan
	case md5("supplier_bahan");
	include"master/pg_supplier_bahan/supplier_bahan_list.php";
	break;
	case md5("supplier_bahan_add");
	include"master/pg_supplier_bahan/supplier_bahan_add.php";
	break;
	case md5("supplier_bahan_insert");
	include"master/pg_supplier_bahan/supplier_bahan_insert.php";
	break;
	case md5("supplier_bahan_edit");
	include"master/pg_supplier_bahan/supplier_bahan_edit.php";
	break;
	case md5("supplier_bahan_update");
	include"master/pg_supplier_bahan/supplier_bahan_update.php";
	break;
	case md5("supplier_bahan_delete");
	include"master/pg_supplier_bahan/supplier_bahan_delete.php";
	break;


	//supplier_aksesoris
	case md5("supplier_aksesoris");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_list.php";
	break;
	case md5("supplier_aksesoris_add");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_add.php";
	break;
	case md5("supplier_aksesoris_insert");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_insert.php";
	break;
	case md5("supplier_aksesoris_edit");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_edit.php";
	break;
	case md5("supplier_aksesoris_update");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_update.php";
	break;
	case md5("supplier_aksesoris_delete");
	include"master/pg_supplier_aksesoris/supplier_aksesoris_delete.php";
	break;

	
	//pembelian_aksesoris
	case md5("pembelian_aksesoris");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_list.php";
	break;
	case md5("pembelian_aksesoris_detail");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_detail.php";
	break;
	case md5("pembelian_aksesoris_add");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_add.php";
	break;
	case md5("pembelian_aksesoris_insert");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_insert.php";
	break;
	case md5("pembelian_aksesoris_edit");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_edit.php";
	break;
	case md5("pembelian_aksesoris_update");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_update.php";
	break;
	case md5("pembelian_aksesoris_delete");
	include"master/pg_pembelian_aksesoris/pembelian_aksesoris_delete.php";
	break;

	
	//pembelian_bahan
	case md5("pembelian_bahan");
	include"master/pg_pembelian_bahan/pembelian_bahan_list.php";
	break;
	case md5("pembelian_bahan_detail");
	include"master/pg_pembelian_bahan/pembelian_bahan_detail.php";
	break;
	case md5("pembelian_bahan_add");
	include"master/pg_pembelian_bahan/pembelian_bahan_add.php";
	break;
	case md5("pembelian_bahan_insert");
	include"master/pg_pembelian_bahan/pembelian_bahan_insert.php";
	break;
	case md5("pembelian_bahan_edit");
	include"master/pg_pembelian_bahan/pembelian_bahan_edit.php";
	break;
	case md5("pembelian_bahan_update");
	include"master/pg_pembelian_bahan/pembelian_bahan_update.php";
	break;
	case md5("pembelian_bahan_delete");
	include"master/pg_pembelian_bahan/pembelian_bahan_delete.php";
	break;
	

	//spk_cutting
	case md5("spk_cutting");
	include"master/pg_spk_cutting/spk_cutting_list.php";
	break;
	case md5("spk_cutting_detail");
	include"master/pg_spk_cutting/spk_cutting_detail.php";
	break;
	case md5("spk_cutting_add");
	include"master/pg_spk_cutting/spk_cutting_add.php";
	break;
	case md5("spk_cutting_add_pengiriman");
	include"master/pg_spk_cutting/spk_cutting_add_pengiriman.php";
	break;
	case md5("spk_cutting_insert");
	include"master/pg_spk_cutting/spk_cutting_insert.php";
	break;
	case md5("spk_cutting_insert_pengiriman");
	include"master/pg_spk_cutting/spk_cutting_insert_pengiriman.php";
	break;
	case md5("spk_cutting_edit");
	include"master/pg_spk_cutting/spk_cutting_edit.php";
	break;
	case md5("spk_cutting_update");
	include"master/pg_spk_cutting/spk_cutting_update.php";
	break;
	case md5("spk_cutting_delete");
	include"master/pg_spk_cutting/spk_cutting_delete.php";
	break;
	case md5("spk_cutting_delete_item");
	include"master/pg_spk_cutting/spk_cutting_delete_item.php";
	break;
	

	//produksi
	case md5("produksi");
	include"master/pg_produksi/produksi_list.php";
	break;
	case md5("produksi_detail");
	include"master/pg_produksi/produksi_detail.php";
	break;
	case md5("produksi_add");
	include"master/pg_produksi/produksi_add.php";
	break;
	case md5("produksi_add_pengiriman");
	include"master/pg_produksi/produksi_add_pengiriman.php";
	break;
	case md5("produksi_add_pengiriman_bs");
	include"master/pg_produksi/produksi_add_pengiriman_bs.php";
	break;
	case md5("produksi_insert");
	include"master/pg_produksi/produksi_insert.php";
	break;
	case md5("produksi_insert_pengiriman");
	include"master/pg_produksi/produksi_insert_pengiriman.php";
	break;
	case md5("produksi_insert_pengiriman_bs");
	include"master/pg_produksi/produksi_insert_pengiriman_bs.php";
	break;
	case md5("produksi_edit");
	include"master/pg_produksi/produksi_edit.php";
	break;
	case md5("produksi_update");
	include"master/pg_produksi/produksi_update.php";
	break;
	case md5("produksi_update_jumlah");
	include"master/pg_produksi/produksi_update_jumlah.php";
	break;
	case md5("produksi_delete");
	include"master/pg_produksi/produksi_delete.php";
	break;
	

	//sablon
	case md5("sablon");
	include"master/pg_sablon/sablon_list.php";
	break;
	case md5("sablon_detail");
	include"master/pg_sablon/sablon_detail.php";
	break;
	case md5("sablon_add");
	include"master/pg_sablon/sablon_add.php";
	break;
	case md5("sablon_add_next");
	include"master/pg_sablon/sablon_add_next.php";
	break;
	case md5("sablon_add_pengiriman");
	include"master/pg_sablon/sablon_add_pengiriman.php";
	break;
	case md5("sablon_add_pengiriman_bs");
	include"master/pg_sablon/sablon_add_pengiriman_bs.php";
	break;
	case md5("sablon_insert");
	include"master/pg_sablon/sablon_insert.php";
	break;
	case md5("sablon_insert_pengiriman");
	include"master/pg_sablon/sablon_insert_pengiriman.php";
	break;
	case md5("sablon_insert_pengiriman_bs");
	include"master/pg_sablon/sablon_insert_pengiriman_bs.php";
	break;
	case md5("sablon_edit");
	include"master/pg_sablon/sablon_edit.php";
	break;
	case md5("sablon_update");
	include"master/pg_sablon/sablon_update.php";
	break;
	case md5("sablon_update_jumlah");
	include"master/pg_sablon/sablon_update_jumlah.php";
	break;
	case md5("sablon_delete");
	include"master/pg_sablon/sablon_delete.php";
	break;
	
	
	//barang_masuk
	case md5("barang_masuk");
	include"master/pg_barang_masuk/barang_masuk_list.php";
	break;
	case md5("barang_masuk_detail");
	include"master/pg_barang_masuk/barang_masuk_detail.php";
	break;
	case md5("barang_masuk_add");
	include"master/pg_barang_masuk/barang_masuk_add.php";
	break;
	case md5("barang_masuk_insert");
	include"master/pg_barang_masuk/barang_masuk_insert.php";
	break;
	case md5("barang_masuk_edit");
	include"master/pg_barang_masuk/barang_masuk_edit.php";
	break;
	case md5("barang_masuk_update");
	include"master/pg_barang_masuk/barang_masuk_update.php";
	break;
	case md5("barang_masuk_delete");
	include"master/pg_barang_masuk/barang_masuk_delete.php";
	break;
	
	
	//surat_jalan
	case md5("surat_jalan");
	include"master/pg_surat_jalan/surat_jalan_list.php";
	break;
	case md5("surat_jalan_detail");
	include"master/pg_surat_jalan/surat_jalan_detail.php";
	break;
	case md5("surat_jalan_add");
	include"master/pg_surat_jalan/surat_jalan_add.php";
	break;
	case md5("surat_jalan_insert");
	include"master/pg_surat_jalan/surat_jalan_insert.php";
	break;
	case md5("surat_jalan_edit");
	include"master/pg_surat_jalan/surat_jalan_edit.php";
	break;
	case md5("surat_jalan_update");
	include"master/pg_surat_jalan/surat_jalan_update.php";
	break;
	case md5("surat_jalan_delete");
	include"master/pg_surat_jalan/surat_jalan_delete.php";
	break;
	
	
	//surat_jalan_toko
	case md5("surat_jalan_toko");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_list.php";
	break;
	case md5("surat_jalan_toko_detail");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_detail.php";
	break;
	case md5("surat_jalan_toko_add");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_add.php";
	break;
	case md5("surat_jalan_toko_insert");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_insert.php";
	break;
	case md5("surat_jalan_toko_edit");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_edit.php";
	break;
	case md5("surat_jalan_toko_update");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_update.php";
	break;
	case md5("surat_jalan_toko_delete");
	include"master/pg_surat_jalan_toko/surat_jalan_toko_delete.php";
	break;
		

	//surat_jalan_ekspedisi
	case md5("surat_jalan_ekspedisi");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_list.php";
	break;
	case md5("surat_jalan_ekspedisi_add");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_add.php";
	break;
	case md5("surat_jalan_ekspedisi_insert");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_insert.php";
	break;
	case md5("surat_jalan_ekspedisi_edit");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_edit.php";
	break;
	case md5("surat_jalan_ekspedisi_update");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_update.php";
	break;
	case md5("surat_jalan_ekspedisi_delete");
	include"master/pg_surat_jalan_ekspedisi/surat_jalan_ekspedisi_delete.php";
	break;
	

	//penjualan
	case md5("penjualan");
	include"master/pg_penjualan/penjualan_list.php";
	break;
	case md5("penjualan_detail");
	include"master/pg_penjualan/penjualan_detail.php";
	break;
	case md5("penjualan_add");
	include"master/pg_penjualan/penjualan_add.php";
	break;
	case md5("penjualan_add_preview");
	include"master/pg_penjualan/penjualan_add_preview.php";
	break;
	case md5("penjualan_insert");
	include"master/pg_penjualan/penjualan_insert.php";
	break;
	case md5("penjualan_edit");
	include"master/pg_penjualan/penjualan_edit.php";
	break;
	case md5("penjualan_update");
	include"master/pg_penjualan/penjualan_update.php";
	break;
	case md5("penjualan_delete");
	include"master/pg_penjualan/penjualan_delete.php";
	break;
	case md5("penjualan_delete_item");
	include"master/pg_penjualan/penjualan_delete_item.php";
	break;


	//penjualan_pending
	case md5("penjualan_pending");
	include"master/pg_penjualan_pending/penjualan_pending_list.php";
	break;
	case md5("penjualan_pending_detail");
	include"master/pg_penjualan_pending/penjualan_pending_detail.php";
	break;
	case md5("penjualan_pending_add");
	include"master/pg_penjualan_pending/penjualan_pending_add.php";
	break;
	case md5("penjualan_pending_add_preview");
	include"master/pg_penjualan_pending/penjualan_pending_add_preview.php";
	break;
	case md5("penjualan_pending_insert");
	include"master/pg_penjualan_pending/penjualan_pending_insert.php";
	break;
	case md5("penjualan_pending_edit");
	include"master/pg_penjualan_pending/penjualan_pending_edit.php";
	break;
	case md5("penjualan_pending_update");
	include"master/pg_penjualan_pending/penjualan_pending_update.php";
	break;
	case md5("penjualan_pending_delete");
	include"master/pg_penjualan_pending/penjualan_pending_delete.php";
	break;
	case md5("penjualan_pending_delete_item");
	include"master/pg_penjualan_pending/penjualan_pending_delete_item.php";
	break;
	

	//penjualan_piutang
	case md5("penjualan_piutang");
	include"master/pg_penjualan_piutang/penjualan_piutang_list.php";
	break;
	case md5("penjualan_piutang_detail");
	include"master/pg_penjualan_piutang/penjualan_piutang_detail.php";
	break;
	case md5("penjualan_piutang_insert");
	include"master/pg_penjualan_piutang/penjualan_piutang_insert.php";
	break;
	case md5("penjualan_piutang_update");
	include"master/pg_penjualan_piutang/penjualan_piutang_update.php";
	break;


	//retur_bahan
	case md5("retur_bahan");
	include"master/pg_retur_bahan/retur_bahan_list.php";
	break;
	case md5("retur_bahan_detail");
	include"master/pg_retur_bahan/retur_bahan_detail.php";
	break;
	case md5("retur_bahan_add");
	include"master/pg_retur_bahan/retur_bahan_add.php";
	break;
	case md5("retur_bahan_insert");
	include"master/pg_retur_bahan/retur_bahan_insert.php";
	break;
	case md5("retur_bahan_edit");
	include"master/pg_retur_bahan/retur_bahan_edit.php";
	break;
	case md5("retur_bahan_update");
	include"master/pg_retur_bahan/retur_bahan_update.php";
	break;
	case md5("retur_bahan_delete");
	include"master/pg_retur_bahan/retur_bahan_delete.php";
	break;

	
	//retur_penjualan
	case md5("retur_penjualan");
	include"master/pg_retur_penjualan/retur_penjualan_list.php";
	break;
	case md5("retur_penjualan_detail");
	include"master/pg_retur_penjualan/retur_penjualan_detail.php";
	break;
	case md5("retur_penjualan_add");
	include"master/pg_retur_penjualan/retur_penjualan_add.php";
	break;
	case md5("retur_penjualan_insert");
	include"master/pg_retur_penjualan/retur_penjualan_insert.php";
	break;
	case md5("retur_penjualan_edit");
	include"master/pg_retur_penjualan/retur_penjualan_edit.php";
	break;
	case md5("retur_penjualan_update");
	include"master/pg_retur_penjualan/retur_penjualan_update.php";
	break;
	case md5("retur_penjualan_delete");
	include"master/pg_retur_penjualan/retur_penjualan_delete.php";
	break;
		

	//pengeluaran
	case md5("pengeluaran");
	include"master/pg_pengeluaran/pengeluaran_list.php";
	break;
	case md5("pengeluaran_add");
	include"master/pg_pengeluaran/pengeluaran_add.php";
	break;
	case md5("pengeluaran_insert");
	include"master/pg_pengeluaran/pengeluaran_insert.php";
	break;
	case md5("pengeluaran_edit");
	include"master/pg_pengeluaran/pengeluaran_edit.php";
	break;
	case md5("pengeluaran_update");
	include"master/pg_pengeluaran/pengeluaran_update.php";
	break;
	case md5("pengeluaran_delete");
	include"master/pg_pengeluaran/pengeluaran_delete.php";
	break;
		

	//potongan_merk
	case md5("potongan_merk");
	include"master/pg_potongan_merk/potongan_merk_list.php";
	break;
	case md5("potongan_merk_add");
	include"master/pg_potongan_merk/potongan_merk_add.php";
	break;
	case md5("potongan_merk_insert");
	include"master/pg_potongan_merk/potongan_merk_insert.php";
	break;
	case md5("potongan_merk_pembayaran_insert");
	include"master/pg_potongan_merk/potongan_merk_pembayaran_insert.php";
	break;
	case md5("potongan_merk_detail");
	include"master/pg_potongan_merk/potongan_merk_detail.php";
	break;
	case md5("potongan_merk_edit");
	include"master/pg_potongan_merk/potongan_merk_edit.php";
	break;
	case md5("potongan_merk_update");
	include"master/pg_potongan_merk/potongan_merk_update.php";
	break;
	case md5("potongan_merk_approve");
	include"master/pg_potongan_merk/potongan_merk_approve.php";
	break;
	case md5("potongan_merk_delete");
	include"master/pg_potongan_merk/potongan_merk_delete.php";
	break;
		

	//qc
	case md5("qc");
	include"master/pg_qc/qc_list.php";
	break;
	case md5("qc_add");
	include"master/pg_qc/qc_add.php";
	break;
	case md5("qc_insert");
	include"master/pg_qc/qc_insert.php";
	break;
	case md5("qc_edit");
	include"master/pg_qc/qc_edit.php";
	break;
	case md5("qc_update");
	include"master/pg_qc/qc_update.php";
	break;
	case md5("qc_approve");
	include"master/pg_qc/qc_approve.php";
	break;
	case md5("qc_delete");
	include"master/pg_qc/qc_delete.php";
	break;

	//qc
	case md5("qc_sablon");
	include"master/pg_qc_sablon/qc_list.php";
	break;
	case md5("qc_sablon_add");
	include"master/pg_qc_sablon/qc_add.php";
	break;
	case md5("qc_sablon_insert");
	include"master/pg_qc_sablon/qc_insert.php";
	break;
	case md5("qc_sablon_edit");
	include"master/pg_qc_sablon/qc_edit.php";
	break;
	case md5("qc_sablon_update");
	include"master/pg_qc_sablon/qc_update.php";
	break;
	case md5("qc_sablon_approve");
	include"master/pg_qc_sablon/qc_approve.php";
	break;
	case md5("qc_sablon_delete");
	include"master/pg_qc_sablon/qc_delete.php";
	break;

	//qc
	case md5("qc_cutting");
	include"master/pg_qc_cutting/qc_list.php";
	break;
	case md5("qc_cutting_add");
	include"master/pg_qc_cutting/qc_add.php";
	break;
	case md5("qc_cutting_insert");
	include"master/pg_qc_cutting/qc_insert.php";
	break;
	case md5("qc_cutting_edit");
	include"master/pg_qc_cutting/qc_edit.php";
	break;
	case md5("qc_cutting_update");
	include"master/pg_qc_cutting/qc_update.php";
	break;
	case md5("qc_cutting_approve");
	include"master/pg_qc_cutting/qc_approve.php";
	break;
	case md5("qc_cutting_delete");
	include"master/pg_qc_cutting/qc_delete.php";
	break;
	
	//penyesuaian_toko
	case md5("penyesuaian_toko");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_list.php";
	break;
	case md5("penyesuaian_toko_detail");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_detail.php";
	break;
	case md5("penyesuaian_toko_add");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_add.php";
	break;
	case md5("penyesuaian_toko_insert");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_insert.php";
	break;
	case md5("penyesuaian_toko_edit");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_edit.php";
	break;
	case md5("penyesuaian_toko_update");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_update.php";
	break;
	case md5("penyesuaian_toko_delete");
	include"master/pg_penyesuaian_toko/penyesuaian_toko_delete.php";
	break;


	//penyesuaian_gudang
	case md5("penyesuaian_gudang");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_list.php";
	break;
	case md5("penyesuaian_gudang_detail");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_detail.php";
	break;
	case md5("penyesuaian_gudang_add");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_add.php";
	break;
	case md5("penyesuaian_gudang_insert");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_insert.php";
	break;
	case md5("penyesuaian_gudang_edit");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_edit.php";
	break;
	case md5("penyesuaian_gudang_update");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_update.php";
	break;
	case md5("penyesuaian_gudang_delete");
	include"master/pg_penyesuaian_gudang/penyesuaian_gudang_delete.php";
	break;	
	

	//laporan
	case md5("laporan_stok");
	include"master/pg_laporan/laporan_stok/laporan_stok.php";
	break;
	case md5("laporan_stok_detail");
	include"master/pg_laporan/laporan_stok/laporan_stok_detail.php";
	break;
	case md5("laporan_stok_edit");
	include"master/pg_laporan/laporan_stok/laporan_stok_edit.php";
	break;
	case md5("laporan_stok_update");
	include"master/pg_laporan/laporan_stok/laporan_stok_update.php";
	break;


	//laporan
	case md5("laporan_stok_gudang");
	include"master/pg_laporan/laporan_stok_gudang/laporan_stok_gudang.php";
	break;
	case md5("laporan_stok_gudang_detail");
	include"master/pg_laporan/laporan_stok_gudang/laporan_stok_gudang_detail.php";
	break;
	case md5("laporan_stok_gudang_edit");
	include"master/pg_laporan/laporan_stok_gudang/laporan_stok_gudang_edit.php";
	break;
	case md5("laporan_stok_gudang_update");
	include"master/pg_laporan/laporan_stok_gudang/laporan_stok_gudang_update.php";
	break;


	//laporan
	case md5("laporan_stok_aksesoris");
	include"master/pg_laporan/laporan_stok_aksesoris/laporan_stok_aksesoris.php";
	break;
	case md5("laporan_stok_aksesoris_edit");
	include"master/pg_laporan/laporan_stok_aksesoris/laporan_stok_aksesoris_edit.php";
	break;
	case md5("laporan_stok_aksesoris_update");
	include"master/pg_laporan/laporan_stok_aksesoris/laporan_stok_aksesoris_update.php";
	break;
	

	//laporan
	case md5("laporan_stok_bahan");
	include"master/pg_laporan/laporan_stok_bahan/laporan_stok_bahan.php";
	break;
	case md5("laporan_stok_bahan_detail");
	include"master/pg_laporan/laporan_stok_bahan/laporan_stok_bahan_detail.php";
	break;
	case md5("laporan_stok_bahan_edit");
	include"master/pg_laporan/laporan_stok_bahan/laporan_stok_bahan_edit.php";
	break;
	case md5("laporan_stok_bahan_update");
	include"master/pg_laporan/laporan_stok_bahan/laporan_stok_bahan_update.php";
	break;	


	//laporan
	case md5("laporan_pembelian_bahan");
	include"master/pg_laporan/laporan_pembelian_bahan/laporan_pembelian_bahan.php";
	break;


	//laporan
	case md5("laporan_pembayaran_cutting");
	include"master/pg_laporan/laporan_pembayaran_cutting/laporan_pembayaran_cutting.php";
	break;
	case md5("laporan_pembayaran_cutting_approve");
	include"master/pg_laporan/laporan_pembayaran_cutting/laporan_pembayaran_cutting_approve.php";
	break;


	//laporan
	case md5("laporan_pembayaran_sablon");
	include"master/pg_laporan/laporan_pembayaran_sablon/laporan_pembayaran_sablon.php";
	break;
	case md5("laporan_pembayaran_sablon_approve");
	include"master/pg_laporan/laporan_pembayaran_sablon/laporan_pembayaran_sablon_approve.php";
	break;


	//laporan
	case md5("laporan_pembayaran_cmt_pending");
	include"master/pg_laporan/laporan_pembayaran_cmt_pending/laporan_pembayaran_cmt.php";
	break;
	case md5("laporan_pembayaran_cmt_approve");
	include"master/pg_laporan/laporan_pembayaran_cmt_pending/laporan_pembayaran_cmt_approve.php";
	break;

	//laporan
	case md5("laporan_pembayaran_cmt_lunas");
	include"master/pg_laporan/laporan_pembayaran_cmt_lunas/laporan_pembayaran_cmt.php";
	break;
	case md5("laporan_pembayaran_cmt_approve");
	include"master/pg_laporan/laporan_pembayaran_cmt_lunas/laporan_pembayaran_cmt_approve.php";
	break;


	//laporan
	case md5("laporan_pengiriman_cmt");
	include"master/pg_laporan/laporan_pengiriman_cmt/laporan_pengiriman_cmt.php";
	break;


	//laporan
	case md5("laporan_penjualan");
	include"master/pg_laporan/laporan_penjualan/laporan_penjualan.php";
	break;


	//laporan
	case md5("laporan_product_cost");
	include"master/pg_laporan/laporan_product_cost/laporan_product_cost.php";
	break;


	//laporan
	case md5("laporan_rincian_produk");
	include"master/pg_laporan/laporan_rincian_produk/laporan_rincian_produk.php";
	break;


	//laporan
	case md5("laporan_laba_rugi");
	include"master/pg_laporan/laporan_laba_rugi/laporan_laba_rugi.php";
	break;


	//laporan
	case md5("laporan_laba_rugi_nota");
	include"master/pg_laporan/laporan_laba_rugi_nota/laporan_laba_rugi_nota.php";
	break;


	//laporan
	case md5("laporan_best_seller");
	include"master/pg_laporan/laporan_best_seller/laporan_best_seller.php";
	break;


	//laporan
	case md5("laporan_settlement_harian");
	include"master/pg_laporan/laporan_settlement_harian/laporan_settlement_harian.php";
	break;

	//laporan
	case md5("laporan_retur_penjualan");
	include"master/pg_laporan/laporan_retur_penjualan/laporan_retur_penjualan.php";
	break;

	//laporan
	case md5("laporan_grafik_penjualan_bulanan");
	include"master/pg_laporan/laporan_grafik_penjualan_bulanan/laporan_grafik_penjualan_bulanan.php";
	break;

	//laporan
	case md5("laporan_grafik_penjualan_tahunan");
	include"master/pg_laporan/laporan_grafik_penjualan_tahunan/laporan_grafik_penjualan_tahunan.php";
	break;


	//Migrasi
	case md5("export");
	include"master/pg_migrasi/export_list.php";
	break;
	case md5("import");
	include"master/pg_migrasi/import_list.php";
	break;
	case md5("import_insert");
	include"master/pg_migrasi/import_insert.php";
	break;



	//ongkir
	case md5("ongkir");
	include"master/pg_ongkir/ongkir_list.php";
	break;

}
?>

<?php include"structure/footer.php";?>
<?php include"structure/library_foot.php";?>