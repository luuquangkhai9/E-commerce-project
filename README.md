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
* `template/`: Có thể chứa các file mẫu (template) cho giao diện.
* `bin/`, `env/`: Có thể chứa các file thực thi hoặc biến môi trường.
* `compose.yaml`, `compose.dev.yaml`, `compose.healthcheck.yaml`: Các file cấu hình Docker Compose để thiết lập và chạy môi trường dự án.
* `database.sql`: Chứa mã SQL để tạo cấu trúc cơ sở dữ liệu và có thể là dữ liệu mẫu.
* `Makefile`: Có thể chứa các lệnh để tự động hóa các tác vụ (build, run,...).
* `*.txt`: Các file hướng dẫn (`lệnh chạy module .txt`, `thiet lap chay du an.txt`, `docker stop docker ps.txt`) cung cấp thông tin cụ thể về cách chạy và thiết lập.
* `Tài_liệu.zip`: Tài liệu liên quan đến dự án.

## Cách cài đặt và chạy dự án

### Yêu cầu tiên quyết

1.  **Docker:** Cài đặt Docker Desktop hoặc Docker Engine.
2.  **Docker Compose:** Thường được tích hợp sẵn với Docker Desktop.

### Các bước thực hiện

1.  **Clone repository:**
    ```bash
    git clone [https://github.com/luuquangkhai9/E-commerce-project.git](https://github.com/luuquangkhai9/E-commerce-project.git)
    cd E-commerce-project
    ```
2.  **Tham khảo file hướng dẫn:**
    * Mở và đọc kỹ nội dung các file `.txt` (`thiet lap chay du an.txt`, `lệnh chạy module .txt`) để biết các bước thiết lập cụ thể, ví dụ như tạo file môi trường (`.env`), cấu hình, hoặc các lệnh đặc biệt.
3.  **Khởi chạy Docker Compose:**
    * Sử dụng file `compose.yaml` (hoặc `compose.dev.yaml` cho môi trường phát triển) để khởi chạy các container:
        ```bash
        docker-compose -f compose.yaml up -d --build
        # Hoặc
        # docker-compose -f compose.dev.yaml up -d --build
        ```
4.  **Thiết lập cơ sở dữ liệu:**
    * Bạn có thể cần phải import file `database.sql` vào container cơ sở dữ liệu (MySQL/MariaDB) được tạo bởi Docker Compose. Kiểm tra `compose.yaml` để biết tên dịch vụ database và cách kết nối.
    * Ví dụ (có thể cần điều chỉnh):
        ```bash
        docker-compose exec <tên-dịch-vụ-db> mysql -u <user> -p<password> <database_name> < database.sql
        ```
5.  **Cài đặt các dependency PHP (Nếu cần):**
    * Nếu dự án sử dụng Composer, bạn có thể cần chạy `composer install` bên trong container PHP:
        ```bash
        docker-compose exec <tên-dịch-vụ-php> composer install
        ```

## Cách sử dụng

* Sau khi khởi chạy thành công, truy cập trang web qua trình duyệt. Địa chỉ có thể là `http://localhost` hoặc một cổng cụ thể (ví dụ: `http://localhost:8000`). Hãy kiểm tra file `compose.yaml` hoặc các file hướng dẫn để biết cổng chính xác.
* Bạn có thể duyệt sản phẩm, thêm vào giỏ hàng, đăng ký/đăng nhập và thực hiện các chức năng của một trang thương mại điện tử.

## Tác giả

* *Lưu Quang Khải*
* *Hồ Nguyên Lượng*
* *Nguyễn Thị Thu Trang*
  
Nhóm sinh viên Trường Đại học Công nghệ – Đại học Quốc gia Hà Nội, thực hiện trong khuôn khổ học phần Thương mại điện tử.

## Giấy phép

Dự án này không có giấy phép được chỉ định.
