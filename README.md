### Autehntifikasi
Untuk melakukan proses login silahkan gunakan akun default berikut :<br>
Username : super<br>
Password : password<br>
<br>
Username : admin<br>
Password : password

## Fitur Fitur :

### 1. Dropdown Dinamis
Fungsi ini digunaan untuk membuat dropdown dinamis dengan data yang berasal dari database, cara penggunaan :<br>
``` <?php echo cmb_dinamis(NamaElement,NamaTabel,NamaField,PrimaryKey,DefaultValue);?>```<br>
Contoh : <br>
``` <?php echo datalist_dinamis('cmb_kelas','tbl_kelas','nama_kelas','id_kelas',5) ?>```

### 2. Datalist Dinamis
Fungsi ini digunaan untuk membuat datalist dinamis dengan data yang berasal dari database, cara penggunaan :<br>
``` <?php echo datalist_dinamis(NamaElement,NamaTabel,NamaField,DefaultValue);?>```<br>
Contoh : <br>
``` <?php echo datalist_dinamis('ListUser','tbl_users','nama_lengkap') ?>```

### 3.Select Select Dinamis
Fungsi ini digunaan untuk membuat select2 dinamis dengan data yang berasal dari database, cara penggunaan :<br>
``` <?php echo select2_dinamis(NamaElement,NamaTabel,NamaField,PlaceHolder);?>```<br>
Contoh : <br>
``` <?php echo select2_dinamis('ListUser','tbl_users','nama_lengkap','Masukan Nama Users') ?>```
