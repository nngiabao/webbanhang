<?php
require "ConnectDB.php";
$act = $_POST["act"];
$sapxep = $_POST["sapxep"];
$sort = $_POST["sort"];



$sosanpham1trang = 4;

$trang = (!empty($_POST['trang'])) ? $_POST['trang'] : 1;
settype($trang, "int");

$from = ($trang - 1) * $sosanpham1trang;

$sql2 = "SELECT * FROM  `sanpham` WHERE trangthai = '1' and id_con='$act'";//lay toan bo san phảm 
$tong = mysqli_query($con, $sql2);
$tong = $tong -> num_rows;//lấy tổng số sản phẩm
$current_page = (!empty($_POST['trang'])) ? $_POST['trang'] : 1;
//var_dump($tong);
//------------------------------------------------------
$tongTrang = ceil($tong / $sosanpham1trang);//tính tổng số trang
//var_dump($tongTrang);
//------------------------------------------------------
$sql = "Select * from sanpham inner join menucon on menucon.id_con = sanpham.id_con where sanpham.trangthai = '1' and menucon.id_con='$act' order by $sort $sapxep limit $sosanpham1trang offset $from
  ";
$rs = mysqli_query($con, $sql);


?>
<div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Mã sản phẩm</th>
                      <th>Tên</th>
                      <th>Loại</th>
                      <th>Ngày đăng bán</th>
                      <th>Số lượng đã bán</th>
                      <th>Tổng thu</th>
                    </thead>
                    <tbody>
                      <div id= "noidungthongke">
                      <?php
                        while ($row = mysqli_fetch_array($rs))
                            { 
                      ?>
                      <tr>
                        <td><?=$row["masp"]?></td>
                        <td><?=$row["tensp"]?></td>
                        <td><?=$row["tenMenucon"]?></td>
                        <td><?=$row["ngaydang"]?></td>
                        <td><?=$row["soluongdaban"]?></td>
                        <td><?=$row["tongthu"]?></td>
                      </tr>
                    <?php }?>
                      </tbody>
                      </table>
                      <?php include 'phantrangthongke.php'?>
                </div>
              </div>
            </div>
          </div>