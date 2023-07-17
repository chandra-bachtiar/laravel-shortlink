
<h1 align="center">
  Laravel Shortlink
  <br>
</h1>

<h4 align="center">Buat pendek link panjang anda dengan <a href="http://laravel.com" target="_blank">Laravel</a>.</h4>

<p align="center">
  <a href="#fitur-utama">Fitur Utama</a> •
  <a href="#persiapan">Persiapan</a> •
  <a href="#cara-install">Cara Install</a> •
  <a href="#cara-penggunaan">Cara Penggunaan</a> •
  <a href="#license">Lisensi</a>
</p>

## Fitur Utama

* User Authentication
* Dashboard Managemen
* Custom URL (registered user only)
* Guest Short Url

## Persiapan

Sebelum menginstall ada beberapa persiapan yang harus dilakukan sebagai berikut :
* Install PHP versi 8.1 atau lebih
	- Jika di windows bisa menggunakan [XAMPP](https://www.apachefriends.org/download.html)
    - jika menggunakan Linux/MacOs download di [Linux/MacOs PHP](https://www.php.net/downloads.php)
* Install [Composer](https://getcomposer.org/download/)
* Install [NodeJS](https://nodejs.org/en/download) versi 18 atau lebih
* Install Mysql
	- Jika anda menggunakan Windows maka bisa skip step ini karena, XAMPP otomatis akan menginstall Mysql
    - Jika anda menggunakan Linux atau lainnya bisa download dan install [Mysql](https://www.mysql.com/downloads/) terlebih dahulu.
* Persiapkan Code Editor seperti [VSCode](https://code.visualstudio.com/download), [SublimeText](https://www.sublimetext.com/3), atau Lainnya
* Install [Git](https://git-scm.com/downloads)

## Cara Install

* Buka CMD/Terminal anda lalu ikuti langkah berikut :
    ```bash
    # Clone Repository ini
    $ git clone https://github.com/chandra-bachtiar/laravel-shortlink.git

    ```

* Masuk ke folder yang telah dibuat
 	```bash
    $ cd laravel-shortlink
    ```
    
* Install Package PHP yang diperlukan dengan command berikut
	```bash
    $ composer install
    ```
    
* Install Module Javascript yang diperlukan dengan command berikut
	```bash
    $ npm install
    ```
    
* salin .env.example ke .env dengan command berikut
	```bash
    cd .env.example .env
    ```
    
* buka file .env dan rubah pada block berikut dengan settingan database mysql anda
	```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=shortlink
    DB_USERNAME=root #your user database
    DB_PASSWORD= #your password database
    ```
    
* buat database dengan nama **shortlink**
* jalankan migration dengan command berikut 
	```bash
    $ php artisan migrate:fresh
    ```
    
* Jalankan Server php pada terminal
	```bash
    $ php artisan serve
    ```

* Buka satu terminal lagi lalu jalankan npm
	```bash
    $ npm run dev
    ```
   
* buka browser lalu buka [127.0.0.1:8000](http://127.0.0.1:8000) untuk mengecek apakah server sudah berjalan

	![be2da14393747fdfecc253ca430ed341.png](https://imgtr.ee/images/2023/07/17/be2da14393747fdfecc253ca430ed341.png)
 
* Selesai.

### Deployment 
* Build Aplikasi sebelum di deploy ke production dengan command berikut
```bash
$ npm run build
```

* aplikasi siap di deploy dengan target folder di /public

  
## Cara Penggunaan

### Guest
* akses link [127.0.0.1:8000](http://127.0.0.1:8000) (saat masa development atau url production anda)
* Tempel link panjang anda pada form input Long Url lalu klik tombol Generate Short Url

  [![55471ade2107859082ea51f1bb56488d.gif](https://imgtr.ee/images/2023/07/17/55471ade2107859082ea51f1bb56488d.gif)](https://imgtr.ee/image/jYFUr)


* Link siap disalin dan digunakan

### Register User
* Klik Register pada pojok kanan atas

	[![SWjMF.gif](https://s11.gifyu.com/images/SWjMF.gif)](https://gifyu.com/image/SWjMF)
    
* Isi semua field lalu klik register

	[![SWjMX.gif](https://s12.gifyu.com/images/SWjMX.gif)](https://gifyu.com/image/SWjMX)
    
### Tampilan Dashboard

[![SWjpA.png](https://s12.gifyu.com/images/SWjpA.png)](https://gifyu.com/image/SWjpA)

### Buat Short Link

* Klik tombol + pada pojok kiri atas yang berwarna biru

	[![SWjLI.gif](https://s12.gifyu.com/images/SWjLI.gif)](https://gifyu.com/image/SWjLI)
    
* Isi semua field lalu klik Generate Shortlink

	[![SWjLo.gif](https://s11.gifyu.com/images/SWjLo.gif)](https://gifyu.com/image/SWjLo)
    
   ** Keterangan** 
   - Long Url : Url Panjang anda
   - Custom Link : custom url pada akhir link
   - Expired : kapan link tersebut akan expired (default 7 hari dari hari pembuatan)
   
* salin dengan cara klik tombol copy url

### Edit Short Link

* Klik edit pada baris yang akan di edit
* Lalu rubah field yang akan dirubah
* Lalu klik Update

	[![SWjNd.gif](https://s11.gifyu.com/images/SWjNd.gif)](https://gifyu.com/image/SWjNd)
    
### Hapus Short Link

* Klik hapus pada baris yang akan dihapus
* Lalu klik delete untuk konfirmasi hapus

	[![SWjN8.gif](https://s11.gifyu.com/images/SWjN8.gif)](https://gifyu.com/image/SWjN8)


## License

MIT

---

> Web [chand.my.id](https://www.chand.my.id) &nbsp;&middot;&nbsp;
> GitHub [chandra-bachtiar](https://github.com/chandra-bachtiar) &nbsp;&middot;&nbsp;
> Twitter [@chaaannd](https://twitter.com/chaaannd)

