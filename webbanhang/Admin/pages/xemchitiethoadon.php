<?php
require "ConnectDB.php";
$mahoadon = $_POST["mahoadon"];
$sql = "SELECT * FROM chitiethoadon where ma_hoadon = '$mahoadon'";
$rs = mysqli_query($con, $sql);
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Chi tiết hóa đơn</h4>
                  <p class="card-category">Chi tiết của hóa đơn <?=$mahoadon?></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Mã hóa đơn</th>
                        <th>Mã sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                      </thead>
                      <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($rs))
                                                        {       
                            ?>
                        <tr>
                          <td>
                            <?= $row['ma_hoadon'] ?>
                          </td>
                          <td>
                            <?= $row['masp'] ?>
                          </td>
                          <td>
                            <?= $row['soluong'] ?>
                          </td>
                          <td>
                            <?= $row['dongia'] ?>
                          </td>
                          <td>
                            <?= $row['thanhtien'] ?>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
      </div>