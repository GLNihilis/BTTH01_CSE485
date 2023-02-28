SELECT tieude FROM baiviet INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai WHERE theloai.ten_tloai = "Nhạc trữ tình";

SELECT tieude FROM baiviet INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia WHERE tacgia.ten_tgia = "Nhacvietplus";

SELECT ten_tloai FROM theloai INNER JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai;

SELECT baiviet.ma_bviet, baiviet.tieude, ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet from baiviet INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;

SELECT ten_tloai FROM theloai INNER JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai GROUP BY baiviet.ma_tloai;