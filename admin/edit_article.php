<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:../login.php");
}
?>
<?php
    require_once 'DB_con.php';
    $ma_bviet=$_GET['sid'];
    $sql = "SELECT ma_bviet,tieude,ten_bhat,".'theloai.ten_tloai'.",tomtat,noidung,".'tacgia.ten_tgia'.",ngayviet,hinhanh FROM baiviet,tacgia,theloai where tacgia.ma_tgia=baiviet.ma_tgia and theloai.ma_tloai=baiviet.ma_tloai AND ma_bviet=$ma_bviet";
    $result = mysqli_query($conn, $sql);
    $row =mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang ch???</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngo??i</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Th??? lo???i</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">T??c gi???</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">B??i vi???t</a>
                    </li>
                </ul>
                <a class="nav-link " href="process_logout.php">Logout</a>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">C???M NH???N V??? B??I H??T</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">S???a th??ng tin b??i vi???t</h3>
                <form action="process_edit_article.php" method="post" enctype="multipart/form-data">            
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text "style="width: 100px" id="lblBaiviet">M?? b??i vi???t</span>
                        <input  type="text" class="form-control" name="txtBaiviet" readonly
                        value="<?php echo $row['ma_bviet']?>" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text " style="width: 100px" id="lblTieude">Ti??u ?????</span>
                        <input type="text" class="form-control" required name="txtTieude" 
                        value="<?php echo $row['tieude']?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text " style="width: 100px" id="lblBaihat">T??n b??i h??t</span>
                        <input type="text" class="form-control" required name="txtBaihat" 
                        value="<?php echo $row['ten_bhat']?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblTheloai">T??n th??? lo???i</span>
                        <select class="form-select" aria-label="Default select example"required  name="txtTheloai"
                        value="<?php echo $row['ten_tloai']?>">
                        <?php
                        require_once 'DB_con.php';
                        $sqlTheloai = "SELECT ma_tloai, ten_tloai FROM theloai";
                        $resultTheloai = $conn->query($sqlTheloai);
                        if ($resultTheloai->num_rows > 0) {
                            while ($theloai = $resultTheloai->fetch_assoc()) {

                                $selected = ($theloai['ten_tloai'] == $row['ten_tloai']) ? 'selected' : '';
                                echo "<option value='" . $theloai['ten_tloai'] . "' $selected>" . $theloai['ten_tloai'] . "</option>";
                            
                            }
                        } else {
                            echo "kh??ng t??m th???y th??? lo???i";
                        }

                        ?>
                    </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblTomtat">T??m t???t</span>
                        <input type="text" class="form-control "required  name="txtTomtat" 
                        value="<?php echo $row['tomtat']?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblNoidung">N???i dung </span>
                        <input type="text" class="form-control"  name="txtNoidung" 
                        value="<?php echo $row['noidung']?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblTacGia">T??c gi???</span>
                        <select class="form-select" aria-label="Default select example"required name="txtTacgia"
                        value="<?php echo $row['ten_tgia']?>">
                        <?php
                        require_once 'DB_con.php';
                        $sqlTacgia = "SELECT * FROM tacgia";
                        $resultTacgia = $conn->query($sqlTacgia);
                        if ($resultTacgia->num_rows > 0) {
                            while ($tacgia = $resultTacgia->fetch_assoc()) {
                                $selected = ($tacgia['ma_tgia'] == $row['ma_tgia']) ? 'selected' : '';
                                echo "<option value='" . $tacgia['ten_tgia'] . "' $selected>" . $tacgia['ten_tgia'] . "</option>";
                            }
                        } else {
                            echo "kh??ng t??m th???y t??c gi???";
                        }

                        ?>
                    </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblNgayViet">Ng??y Vi???t</span>
                        <input type="text" class="form-control" name="txtNgayviet" 
                        value="<?php echo $row['ngayviet']?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" style="width: 100px" id="lblHinhanh">H??nh ???nh</span>
                        <input type="file" class="form-control" name="txtHinhanh" >
                    </div>
                    <div class="form-group  float-end ">
                        <input type="submit" value="L??u l???i" name="submit" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay l???i</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
