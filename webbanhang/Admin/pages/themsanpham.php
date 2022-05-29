<style type="text/css">
  .selectWrapper {
    width: 150px;
    overflow: hidden;
    position: relative;
    border: 1px solid #bbb;
    border-radius: 2px;
    background:#FFFFFF url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2211%22%20height%3D%2211%22%20viewBox%3D%220%200%2011%2011%22%3E%3Cpath%20d%3D%22M4.33%208.5L0%201L8.66%201z%22%20fill%3D%22%2300AEA9%22%2F%3E%3C%2Fsvg%3E') right 13px center no-repeat;
}

.selectWrapper select {
        padding: 12px 40px 12px 20px;
        font-size: 18px;
        line-height: 18px;
        width: 100%;
        border: none;
        box-shadow: none;
        background: transparent;
        background-image: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
        -moz-appearance: none;
        text-indent: 0.01px;
        text-overflow: ellipsis;
    }
</style>
<?php
include 'header.php';
require("ConnectDB.php");

$sql = "select * from menucon where trangthai = 1";
$res = mysqli_query($con, $sql);
?>
    <div class="main-content">
        <h1 style="background-color: purple;height: 50px;">Thêm sản phẩm</h1>
        <div id="content-box">
                <form id="product-form" method="POST" action="xulythemsp.php"  enctype="multipart/form-data">
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Mã sản phẩm: </label>
                        <input style="border-radius: 4px;" type="text" name="name" value="" placeholder="SP+number" id="masp" />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">

                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Tên sản phẩm: </label>
                        <input style="border-radius: 4px;" type="text" name="name" value="" id="tensp" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Giá sản phẩm: </label>
                        <input style="border-radius: 4px;" type="text" name="price" value="" id="giasp" />
                        <div class="clear-both"></div>
                    </div>
                    
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Loại sản phẩm:</label>
                        <div>
                        <select name=" loai" style="width: 200px; height: 50px;" id="loaisp" class="selectWrapper">
                        <?php
                        //loại
                            while ($row = mysqli_fetch_array($res))
                            { 
                            ?>
                        <option id="loaisp" value="<?=$row['id_con']?>"><?=$row['tenMenucon']?>
                        </option>
                        <?php }?>
                        </select>
                        </div>
                        <div class="clear-both"></div>
                    
                    
                    <div class="wrap-field" style="margin-top: 10px; ">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Ảnh sản phẩm: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="file" id="file" accept="image/*" />
                        </div>
                        <!--anh hien thi -->
                        <div style="float: left; border: 2px solid purple;" class="preview">
                           <img scr="" id='anh' width="200" height="200">
                    </div>
                        <div class="clear-both"></div>

                    </div>

                    <div class="wrap-field" style="margin-top: 20px; ">
                        <label style="color: purple; font-weight: bold;margin-top: 10px; ">Mô tả: </label>
                        <textarea style="border-radius: 4px;" name="content" id="motasp"></textarea>
                        <div class="clear-both"></div>
                    </div>
                    <div style="margin-top: 20px; margin-left: 300px;">
                    <input style="color: red;" type="button" title="Lưu sản phẩm" value="Thêm sản phẩm" id ="luusp" class="luuspClass" />
                    </div>
                </form>
                <div class="clear-both"></div>
                
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function()
        {
            $('input[type="file"]').change(function(e){
                    $("[for=file]").html(this.files[0].name);
                    $("#anh").attr("src", URL.createObjectURL(this.files[0]));
                    $('.preview img').show();
                });
            // $('#product-form').on('submit', function(e)
            $('#luusp').click(function()
           {
                var fd = new FormData();
                //var fd = $('form#product-form').serialize()
                var files = $('#file')[0].files[0];
                var tensp = document.getElementById("tensp").value;
                var masp = document.getElementById("masp").value;
                var giasp = document.getElementById("giasp").value;
                var loaisp = document.getElementById("loaisp").value;
                var motasp = document.getElementById("motasp").value;
                if(masp == "")
                {
                    alert("Vui lòng nhập mã sản phẩm");
                    document.getElementById("masp").focus();
                }
                else if(tensp == "")
                {
                    alert("Vui lòng nhập tên sản phẩm");
                    document.getElementById("tensp").focus();
                }
                else if(giasp == "")
                {
                    alert("Vui lòng nhập giá sản phẩm");
                    document.getElementById("giasp").focus();
                }
                else if(files == undefined)
                {
                    alert("Vui lòng chọn ảnh");
                }
                else if(motasp == "")
                {
                    alert("Vui lòng nhập mô tả sản phẩm");
                    document.getElementById("motasp").focus();
                }
                else
                {

                fd.append('file', files);
                fd.append('tensp', tensp);
                fd.append('masp', masp);
                fd.append('giasp', giasp);
                fd.append('loaisp', loaisp);
                fd.append('motasp', motasp);
                // $.post("xulythemsp.php", {fd: fd}, function(data)
                // {
                //     alert(data);
                // });
                $.ajax({
                    url:"xulythemsp.php",
                    method:"POST",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        alert(data);
                        var act = "qlsanpham";
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
