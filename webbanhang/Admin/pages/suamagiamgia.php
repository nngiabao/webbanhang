<?php
include 'header.php';
require("ConnectDB.php");

$magiam = $_POST['magiam'];
$sql2 = "select * from magiamgia where tenmagiamgia='$magiam'";

$result = mysqli_query($con, $sql2);

?>
    <div class="main-content">
        <h1 style="background-color: purple;height: 50px;">Sửa mã giảm giá</h1>
        <div id="content-box">
                <form id="product-form" method="POST" action="xulysuamagiam.php"  enctype="multipart/form-data">
                    <div class="clear-both"></div>
                    <?php
                    while ($row2 = mysqli_fetch_array($result))
                        { 
                    ?>
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Mã giảm giá: </label>
                        <input type="text" name="name" value="<?=$magiam?>" id="magiam" readonly />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Số tiền giảm: </label>
                        <input type="text" name="price" value="<?=$row2['sotiengiam']?>" id="tiengiam" />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Ngày bắt đầu: </label>
                        <input type="date" name="ngaybatdau" min ="2020-01-01" max="2030-12-31"  id="ngaybatdau" value="<?=$row2['ngaybatdau']?>" style="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Ngày kết thúc: </label>
                        <input type="date" name="ngayketthuc" min ="2020-01-01" max="2030-12-31"  id="ngayketthuc" value="<?=$row2['ngayketthuc']?>" style="" />
                        <div class="clear-both"></div>
                    <?php }?>
                    <div style="margin-top: 20px; margin-left: 300px;">
                    <input style="color: red;" type="button" title="Sửa mã giảm giá" value="Sửa mã giảm" id ="luuma" class="luuma" />
                    </div>
                </form>
                <div class="clear-both"></div>
                
        </div>
    </div>
    
<script type="text/javascript">
    $(document).ready(function()
        {
            $('#luuma').click(function()
           {
            
                var fd = new FormData();
                var magiam = document.getElementById("magiam").value;
                var tiengiam = document.getElementById("tiengiam").value;
                
                var ngaybatdau = document.getElementById("ngaybatdau").value;
                var ngayketthuc = document.getElementById("ngayketthuc").value;
                var intngaybatdau = parseInt(ngaybatdau.slice(8,10),10);
                var intthangbatdau = parseInt(ngaybatdau.slice(5,7),10);
                var intngayketthuc = parseInt(ngayketthuc.slice(8,10),10);
                var intthangketthuc = parseInt(ngayketthuc.slice(5,7),10);
                var err = false;
                
                if(tiengiam == "")
                {
                    alert("Vui lòng nhập số tiền giảm");
                    document.getElementById("tiengiam").focus();
                    err = false;
                }
                else if(ngaybatdau == "")
                {
                    alert("Vui lòng chọn ngày bắt đầu");
                    err = false;
                }
                else if(ngayketthuc == "")
                {
                    alert("Vui lòng chọn ngày kết thúc");
                    err = false;
                }
                else if(new Date(ngayketthuc).getTime() < new Date(ngaybatdau).getTime())
                {
                    alert("Ngày kết thúc phải sau ngày bắt đầu");
                    err = false;
                }
                else
                {
                    err = true;
                }
                if(err)
                {
                    
                
                fd.append('magiam', magiam);
                fd.append('tiengiam', tiengiam);
                fd.append('ngaybatdau', ngaybatdau);
                fd.append('ngayketthuc', ngayketthuc);

                $.ajax({
                    url:"xulysuamagiam.php",
                    method:"POST",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        alert(data);
                        var act = "khuyenmai";
                        $.post("ajaxmenu.php", {act: act}, function(data)
                            {
                                $("#noidung").html(data);
                            });
                    }
                });
                }
           });    
        });
</script>
