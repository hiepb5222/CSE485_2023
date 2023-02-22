--a 
SELECT * FROM baiviet WHERE ma_tloai = "nhạc trữ tình"
--b 
SELECT * FROM baiviet WHERE ma_tgia = "nhacvietplus"
--c 
SELECT * FROM theloai 
WHERE ma_tloai NOT IN (SELECT DISTINCT ma_tloai from bai viet)
--d
SELECT ma_bviet, ten_bviet, ten_bhat, ten_tgia, ten_tloai, ngayviet
FROM baiviet, tagia, theloai
WHERE tacgia.ma_tgia = baiviet.ma_tgia AND theloai.ma_tloai = baiviet.ma_tloai
--e
SELECT ten_tloai, COUNT(*) AS Theloainhieunhat
FROM baiviet, theloai
WHERE baiviet.ma_tloai = theloai.ma_tloai
GROUP BY ten_tloai
ORDER BY Theloainhieunhat DESC
LIMIT 1;
--f
SELECT ten_tgia, COUNT(*) AS Tacgianhieubaiviet
FROM tacgia, baiviet
WHERE tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY ten_tgia
ORDER BY Tacgianhieubaiviet DESC
LIMIT 2;
--g
SELECT tieude FROM baiviet
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';
--h
SELECT tieude FROM baiviet
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%' OR tieude LIKE '%yêu%' OR tieude LIKE '%thương%' OR tieude LIKE '%anh%' OR tieude LIKE '%em%';
--i
CREATE VIEW vw_Music AS
SELECT ma_bviet, tieude, ten_bhat, baiviet.ma_tloai, tomtat, noidung, baiviet.ma_tgia, ngayviet, hinhanh, ten_tgia, ten_tloai
FROM tacgia, baiviet, theloai
WHERE tacgia.ma_tgia = baiviet.ma_tgia AND baiviet.ma_tloai = theloai.ma_tloai
-- Xem view
SELECT * FROM vw_Music
--j
CREATE PROCEDURE sp_DSBaiViet (IN input_category_name VARCHAR(255))
BEGIN
DECLARE category_id INT;
    
-- Tìm mã thể loại dựa trên tên thể loại đầu vào
SELECT ma_tloai INTO category_id FROM theloai WHERE ten_tloai = input_category_name;
    
-- Kiểm tra xem thể loại có tồn tại hay không
IF category_id IS NULL THEN
SELECT 'Thể loại không tồn tại' AS message;
ELSE
        
-- Nếu tồn tại, trả về danh sách bài viết của thể loại đó
SELECT * FROM baiviet WHERE ma_tloai = category_id;
END IF;
END

-- Gọi thủ tục
CALL sp_DSBaiViet('Tên thể loại cần tìm');
--k
ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;
CREATE TRIGGER tg_CapNhatTheLoai 
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
  UPDATE theloai SET SLBaiViet = SLBaiViet + 1 WHERE baiviet.ma_tloai = NEW.ma_tloai;
END;
--l
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0
);
