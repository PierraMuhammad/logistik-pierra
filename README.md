# Logistik by Pierra
Sistem untuk gudang logistik dalam melakukan pencatatan keluar - masuk barang dan jumlah barang.

## Cara menggunakan
```
git clone https://github.com/PierraMuhammad/logistik-pierra.git
```

```
php artisan key:generate
composer install
```

Ganti nama DB
```
DB_DATABASE=db_logistik_pierra
```
lakukan perintah
```
php artisan migrate
```

nyalakan XAMPP dan coba jalankan web
```
php artisan serve
```

## Fitur
- Pencatatan Product Masuk
- Pencatatan Product Keluar
- Menampilkan Data Product pada Gudang
- Statistik Transaction Product