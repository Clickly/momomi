<?php
$pluem = new classweb_bypluem;
$resultuser = $pluem->resultuser();
$web_config = $pluem->web_config();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <a class="navbar-brand" href="/">
        <img src="<?php echo $web_config['logo']; ?>" width="60" class="rounded-circle">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <?php if(empty($_SESSION['id'])){ ?>
                <a class="nav-item nav-link active" href="/login">
                    <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                </a>
                <a class="nav-item nav-link active" href="/register">
                    <i class="fas fa-user-plus"></i> สมัครสมาชิก
                </a>
            <?php }else{ ?>
                <a class="nav-item nav-link active" href="/">
                    <i class="fas fa-home"></i> หน้าหลัก
                </a>
                <a class="nav-item nav-link active" href="/shop">
                    <i class="fas fa-shopping-cart"></i> ร้านค้า
                </a>
                <a class="nav-item nav-link active" href="/topup">
                    <i class="fas fa-money-check"></i> เติมเงิน
                </a>
                <a class="nav-item nav-link active" href="/code">
                    <i class="fas fa-code"></i> เติมโค๊ด
                </a>
                <a class="nav-item nav-link active" href="/gamespin">
                    <i class="fas fa-circle-notch"></i> สุ่มของรางวัล
                </a>
                <a class="nav-item nav-link active" href="/account">
                    <i class="fas fa-user"></i> บัญชีของฉัน
                </a>
                <a class="nav-item nav-link active" href="/history_shop">
                    <i class="fas fa-history"></i> ประวัติการซื้อสินค้า
                </a>
                <a class="nav-item nav-link active" href="<?php echo $web_config['contact']; ?>" target="_blank">
                    <i class="fas fa-address-book"></i> ติดต่อฉัน
                </a>
                <a class="nav-item nav-link active logout" href="#">
                    <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                </a>
                <?php if($resultuser['class'] == "1"){ ?>
                    <a class="nav-item nav-link active" href="/backend">
                        <i class="fas fa-cog"></i> จัดการระบบ
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</nav>
<script src="../assets/js/navbar.js"></script>