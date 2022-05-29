<?php
require "ConnectDB.php";

$sosanpham1trang = 10;

$trang = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
settype($trang, "int");

$from = ($trang - 1) * $sosanpham1trang;

$sql = "Select * from magiamgia where trangthai ='1' limit $sosanpham1trang offset $from ";
//------------------------------------------------------
$sql2 = "SELECT * FROM  `magiamgia` where trangthai='1'";//lay toan bo san phảm 
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
                  <h4 class="card-title ">Danh sách mã giảm giá</h4>
                  <p class="card-category">Tất cả mã giảm giá đang hoạt động</p>
                  <input type='button' style="float: right; color: blue;font-weight: bold; font-size: 13px; "class="themma" value="Thêm mã giảm giá"></div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Tên mã</th>
                        <th>Số tiền giảm</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <div class="danhsachsanpham">
                      	<?php
                            while ($row = mysqli_fetch_array($rs))
							              {	
                            ?>
                        <tr>
                          <td id="ten">
                            <?= $row['tenmagiamgia'] ?>
                          </td>
                          <td id="tiengiam">
                            <?= $row['sotiengiam'] ?>
                          </td>
                          <td id="ngaybatdau">
                            <?= $row['ngaybatdau'] ?>
                          </td>
                          <td id="ngayketthuc">
                            <?= $row['ngayketthuc'] ?>
                          </td>
                      	<td>
                      		<input type="button" value="Sửa" name="" style="color:blue;" class="suama" anlong="<?= $row['tenmagiamgia'] ?>" >
                      	</td>
                        <td>
                          <input class="xoasp" type="button" style="color:blue;" value="Xóa" anlong ="<?= $row['tenmagiamgia'] ?>">
                        </td>
                        </tr>
                        <?php }?>
                      </div>
                      </tbody>
                    </table>
                    
                  </div>
                  <?php include 'phantranggiamgia.php'?>
                  <!--<div id="test">-->

                  </div>
                </div>
              </div>
            </div>
   		</div>
      <script>
      $(document).ready(function(){
        $(".themma").click(function(){
            var act = $(this).attr("anlong");
            $.post("themmagiamgia.php", {act: act}, function(data){
              $("#noidung").html(data);

            });
            //alert(act);
        });
      });
      $(document).ready(function(){
        $(".suama").click(function(){
            var magiam = $(this).attr("anlong");
            $.post("suamagiamgia.php", {magiam: magiam}, function(data){
              $("#noidung").html(data);
            });
            //alert(act);
        });
      });
      $(document).ready(function(){
        $(".xoasp").click(function(){
            var masp = $(this).attr("anlong");
            var check = confirm("Bạn có chắc chắn xóa mã giảm "+masp+"?");

            if(check == true)
            {
                $.post("xoamagiamgia.php", {act: masp}, function(data)
                {
                  alert("Đã xóa mã giảm giá "+masp);
                  //load lai trang qlmagiam
                  var act = "khuyenmai";
                $.post("ajaxmenu.php", {act: act}, function(data)
                {
                $("#noidung").html(data);
                });
                });
            }
        });
        });
    </script>
    <?php
    //include("foot.php");
    ?>