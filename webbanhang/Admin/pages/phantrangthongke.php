<script src="https://code.jquery.com/jquery-latest.js"></script>

<link href="../assets/css/admin_style.css" rel="stylesheet" />
<?php
	for($num = 1; $num <= $tongTrang; $num++)//duyet qua tong so trang r luu so trang can hien thi la num
	{ ?>
		<?php if ($current_page != $num)
			{ ?>
		<a class="page-item" href="#" anlong="<?=$num?>" id="<?=$num?>"><?=$num?></a>
	<?php } else {?>
		<strong class="current-page page-item"><?= $num ?></strong>
	<?php }?>
	<?php } ?>
	
	<script>
		$(document).ready(function(){
        $(".page-item").click(function(){
        	var page = $(this).attr("anlong");
        	var act = document.getElementById("loaisp").value;
        	var sapxep = document.getElementById("idsapxep").value;
        	var sort = document.getElementById("idsort").value;
            $.post("thongkesanpham.php", {trang: page, act: act, sapxep: sapxep, sort:sort}, function(data){
            	
              	$("#thongke").html(data);
        });
      });
        });
	</script>