# Hướng dẫn sử dụng template

## Tạo dự án

Chạy lệnh sau để kéo dự án về

```
git clone https://github.com/Lokey2411/laravel-template.git
```

## Khởi tạo template

-   Cài đặt các dependencies

```
composer install
```

-   Link css: Huynh đài nào muốn link sang các file css thì thực hiện như sau:

### cài đặt các gói node

```
npm install
```

hoặc

```
yarn
```

### link css và js

sau đó, thêm dòng này vào cuối thẻ body trong file recources/views/layout/app.blade.php

```
    @vite(['resources/css/app.css', 'resources/js/app.js'])
```

-   Sau khi cài đặt các gói phụ thuộc xong, bật mysql lên và chỉnh sửa thông tin kết nối trong file .env . Ví dụ:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=template
    DB_USERNAME=root
    DB_PASSWORD=
-   Khởi tạo database: Tạo database trùng với DB_DATABASE(trong ví dụ là template), sau đó chạy lệnh sau:

```
php artisan migrate
```

-   Fake dữ liệu:

```
php artisan db:seed UserSeeder
```

## Chạy code

-   Đối với mọi người dùng:

```
php artisan serve
```

-   Đối với người link css
-   Mở 2 cửa sổ terminal, 1 bên chạy

```
php artisan serve
```

Bên còn lại chạy

```
npm run dev
```
