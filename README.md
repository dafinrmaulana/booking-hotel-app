<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p> -->
<img src="https://github.com/DafiNMaulana/booking-hotel-app/blob/main/public/img/ketaksaan-logo/Ketaksaan_hotel-logos_transparent.png" alt="Hotel Booking App Logo" />


<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Hotel Booking App

sebelum mengenal lebih jauh tentang aplikasi hotel booking app, mari saya perkenalkan kepada kalian apa itu laravel? sebuah framework utama pembangun aplikasi ini. menurut laravel, Laravel adalah framework aplikasi web dengan sintaks yang ekspresif dan elegan. Kami percaya pengembangan harus menjadi pengalaman yang menyenangkan dan kreatif agar benar-benar memuaskan. Laravel menghilangkan rasa sakit dari pengembangan dengan mengurangi tugas-tugas umum yang digunakan di banyak proyek web, seperti:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel dapat diakses, kuat, dan menyediakan alat yang diperlukan untuk aplikasi besar dan kuat.

aplikasi ini merupakan tugas akhir saya di sekolah, dan aplikasi ini dikembangkan oleh saya sendiri sehingga masih jauh dari kata sempurna. oleh karena itu jika anda melihat repo ini, saya harap anda bisa memberikan kritik yang membangun agar bisa membuat aplikasi menjadi lebih baik lagi di masa depan.

## Framework / Library pendukung

selama saya membangun aplikasi ini saya telah banyak menerima bantuan dari banyak framework/library pendukung agar membuat web ini menjadi lebih interaktif dan tidak terlihat membosan kan, diantara lain saya menggunakan framework/library :

- [Bootstrap](getbootstrap.com/docs/5.0/).
- [jQuery](https://jquery.com).
- [fancyBox](https://fancyapps.com/docs/ui/fancybox/).
- [dataTables](https://datatables.net/examples/styling/bootstrap4).
- [sweet alert 2](https://sweetalert2.github.io/).
- [Font Awesome](https://fontawesome.com).
- [Chart Js](https://www.chartjs.org/docs/latest/).

kenapa saya memberitahu anda ini? karena saya ingin berterimakasih kepada mereka yang telah membuat sebuah framework/library yang begitu mengagumkan sehingga bisa membantu saya membuat aplikasi ini.

<!-- Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).
 -->
### Template

ketika saya membangun aplikasi ini, saya dihapakan dengan masalah saya sendiri yaitu saya kurang bakat dalam membuat tampilan frontend yang bagus, oleh karena itu disini saya menggunakan template agar sekali lagi bisa memudahkan saya dalam mengembangkan aplikasi ini, template itu bernama :

- **[RuangAdmin](https://github.com/indrijunanda/RuangAdmin)**

terimakasih kepada mas Indri junanda yang telah membuat template yang luar biasa

## Instalasi

_dibawah ini merupakan cara pemasangan aplikasi ini ke dalam perangkat anda, silahkan simak dengan seksama agar tidak terjadi kesalahpahaman._

1. Dalam hal ini pertama tama anda harus memiliki aplikasi pendukung agar web ini bisa berjalan :
    - install ``Xampp``
    - install ``Composer``
    - minimal ``Php versi 8^``
3. Silahkan clone repositori ini atau anda bisa download project via Zip
   ```sh
   git clone https://github.com/DafiNMaulana/booking-hotel-app.git
   ```
3. Update Composer.
   - silahkan buka folder project nya dan buka terminal lalu eksekusi :
   ```sh
   composer update
   ```
4. konfigurasi file `.env`
   - karna saya menggunakan [mailtrap](mailtrap.io) maka langkah pertama sebelum anda lanjut ke langkah berikut nya adalah anda harus mendaftarkan diri anda dulu ke web mailtrap sehingga anda bisa mempunyai `mail username` dan `mail password` yang mana itu perlu ada agar bisa lanjut ke langkah selanjutnya. atau anda bisa konfigurasi email ini dengan smtp Gmail anda. untuk cara lengkap nya anda bisa lihat [tutorial nya disini](https://www.niagahoster.co.id/blog/cara-kirim-email-laravel/#1_1_Konfigurasi_Kirim_Email_Laravel_via_Gmail)
       ```sh
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=mail_username_anda
        MAIL_PASSWORD=mail_password_anda
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="ketaksaanhotelujikom@gmail.com"
        MAIL_FROM_NAME="${APP_NAME}"
       ```
5. aktifkan database lokal anda, silahkan buka XAMPP atau DBMS kesayangan anda lalu start MySQL dan Apache nya
6. konfigurasi database. silahkan anda buka localhost/phpmyadmin atau kalau anda menggunakan XAMPP anda bisa klik `admin` di bagian `module MySQL` pada aplikasi nya. lalu buatlah database bernama `data_hotel`
7. Migrate dan seeding
     ```sh
     php artisan migrate:fresh --seed
   ```
7. geneate key
     ```sh
     php artisan key:generate
   ```
8. usage
     ```sh
     php artisan serve
   ```
   - demo admin `localhost:8000/admin`
    ```sh
    username : admin
    password : 123123
   ```
   - demo guest
    ```sh
    email : test.guest@gmail.com
    password : password
   ```

<!-- Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions). -->

<!-- ## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
