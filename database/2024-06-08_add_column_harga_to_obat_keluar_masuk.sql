ALTER TABLE `obat_masuk` ADD `harga_beli` INT NOT NULL DEFAULT '0' AFTER `created_date`, ADD `harga_jual` INT NOT NULL DEFAULT '0' AFTER `harga_beli`;
ALTER TABLE `obat_keluar` ADD `harga_beli` INT NOT NULL DEFAULT '0' AFTER `created_date`, ADD `harga_jual` INT NOT NULL DEFAULT '0' AFTER `harga_beli`;

update obat_masuk set harga_beli = (select harga_beli from obat where obat.kode_obat=obat_masuk.kode_obat);
update obat_masuk set harga_jual = (select harga_jual from obat where obat.kode_obat=obat_masuk.kode_obat);
update obat_keluar set harga_beli = (select harga_beli from obat where obat.kode_obat=obat_keluar.kode_obat);
update obat_keluar set harga_jual = (select harga_jual from obat where obat.kode_obat=obat_keluar.kode_obat);