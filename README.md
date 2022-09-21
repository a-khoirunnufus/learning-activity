## Instalasi

1. jalankan migrasi<br>
<pre>
php artisan migrate
</pre>

2. jalankan 2 buah seeder<br>
<pre>
php artisan db:seed --class=SessionsTableSeeder
php artisan db:seed --class=MethodsTableSeeder
</pre>

3. jalankan server<br>
<pre>
php artisan serve
</pre>
