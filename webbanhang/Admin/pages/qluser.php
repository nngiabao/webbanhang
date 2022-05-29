<?php
require "ConnectDB.php";

$sosanpham1trang = 10;

$trang = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
settype($trang, "int");

$from = ($trang - 1) * $sosanpham1trang;

$sql = "SELECT * FROM `quyen` INNER JOIN user ON quyen.id_quyen = user.quyen where user.quyen ='3'
                or user.quyen = '4' LIMIT ".$sosanpham1trang." OFFSET ".$from;
//------------------------------------------------------
$sql2 = "SELECT * FROM  `user` where user.quyen ='3'
                or user.quyen = '4'";//lay toan bo san phảm 
$tong = mysqli_query($con, $sql2);
$tong = $tong -> num_rows;//lấy tổng số sản phẩm
$current_page = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
//var_dump($tong);
//------------------------------------------------------
$tongTrang = ceil($tong / $sosanpham1trang);//tính tổng số trang
//var_dump($tongTrang);
$rs = mysqli_query($con, $sql);
?>
<?php include "header.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Danh sách User</h4>
                  <p class="card-category">Tất cả User của khách hàng và nhân viên</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>UserName</th>
                        <th>PassWord</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Ngày lập</th>
                        <th>Trạng thái</th>
                        <th>Quyền</th>
                        <th>Cấp quyền</th>
                      </thead>
                      <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($rs))
                                                        {       
                            ?>
                        <tr>
                          <td>
                            <?= $row['username'] ?>
                          </td>
                          <td>
                            <?= $row['pass'] ?>
                          </td>
                          <td>
                            <?= $row['hoten'] ?>
                          </td>
                          <td>
                            <?= $row['email'] ?>
                          </td>
                          <td>
                            <?= $row['sodienthoai'] ?>
                          </td>
                          <td>
                            <?= $row['ngaysinh'] ?>
                          </td>
                          <td>
                                <?= $row['gioitinh'] ?>
                        </td>
                        <td>
                                <?= $row['ngaylap'] ?>
                        </td>
                        <td>
                                <?= $row['trangthai'] ?>
                        </td>
                        <td>
                                <?= $row['loaiquyen'] ?>
                        </td>
                        <td>
                                <input class="suaquyen" type="button" style="color:blue;" value="Sửa quyền" anlong ="<?=$row['username']?>" data-toggle="modal" data-target="#modal-suaquyen">
                                <div class="modal fade" id="modal-suaquyen">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div id="modalcontent"></div>
                                      </div>
                                  </div>
                                </div>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    
                  </div>
                  <?php include 'phantranguser.php'?>
                  <!--<div id="test">-->

                  </div>
                </div>
              </div>
            </div>
      </div>
      <script>
      $(document).ready(function(){
        $(".suaquyen").click(function()
            {
              var user = $(this).attr("anlong");
              $.post("suaquyen.php", {user: user}, function(data)
                {
                    $("#modalcontent").html(data);
                });  
           });
        });
    </script>
    <?php
    //include("foot.php");
    ?>