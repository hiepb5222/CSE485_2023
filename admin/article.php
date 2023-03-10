<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../login.php");
    }
    require_once 'DB_con.php';
    $sql = "SELECT ma_bviet,tieude,ten_bhat,".'theloai.ten_tloai'.",tomtat,noidung,".'tacgia.ten_tgia'.",ngayviet,hinhanh FROM baiviet,tacgia,theloai where tacgia.ma_tgia=baiviet.ma_tgia and theloai.ma_tloai=baiviet.ma_tloai ORDER BY ngayviet DESC";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style=" height: 100%;
    margin: 0;
    padding: 0;">
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
                        <a class="nav-link" href="category.php">Th??? lo???i</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">T??c gi???</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">B??i vi???t</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Ng?????i d??ng</a>
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
                <a href="add_article.php" class="btn btn-success">Th??m m???i</a>           
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ti??u ?????</th>
                            <th scope="col">T??n b??i h??t</th>
                            <th scope="col" class="col-sm-1">T??n th??? lo???i</th>
                            <th scope="col">T??m t???t</th>
                            <th scope="col" class="col-sm-1">N???i dung</th>
                            <th scope="col">T??c gi???</th>
                            <th scope="col" class="col-sm-1">Ng??y Vi???t</th>
                            <th scope="col">H??nh ???nh</th>
                            <th class="col-sm-1">Ch???c n??ng</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count =0;
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                $count ++;
                                ?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><?php echo $row['tieude']?></td>
                            <td><?php echo $row['ten_bhat']?></td>
                            <td><?php echo $row['ten_tloai']?></td>
                            <td><?php echo $row['tomtat']?></td>
                            <td><?php echo $row['noidung']?></td>
                            <td><?php echo $row['ten_tgia']?></td>
                            <td><?php echo $row['ngayviet']?></td>
                            <td>
                                
                                <img style="width: 100px;" src="/CSE485_2023/images/songs/<?php echo $row['hinhanh'];?>">
                                <!-- <img src="/CSE485_2023/images/logo2.png"> -->
                            </td>
                            <td >
                                <a href="edit_article.php?sid=<?php echo $row['ma_bviet']?>" ><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="process_delete_article.php?sid=<?php echo $row['ma_bviet']?>" onclick="return confirm('B???n c?? mu???n x??a b???n ghi hay kh??ng?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                            <!-- <td>
                            </td> -->
                        </tr>

                                <?php
                            }
                        }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer class="footer bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px;">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
