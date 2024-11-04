<?php
$pluem = new classadmin_bypluem;
$totaluser = $pluem->totaluser();
$totaltopup = $pluem->totaltopup();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4 mt-2">
            <div class="card text-center">
                <div class="card-body">
                    <h3>รายละเอียดเว็บ</h3>
                    <h5>SEVER : <?php echo $_SERVER['SERVER_NAME']; ?></h5>
                    <h5>ผู้ใช้ทั้งหมด : <?php echo $totaluser['total']; ?> คน</h5>
                    <h5>รายได้ทั้งหมด :
                    <?php
                    if(empty($totaltopup['total'])){
                        echo "0.00";
                    }else{
                        echo $totaltopup['total'];
                    }
                    ?> บาท</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <a href="/settings_user">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-users-cog"></i> จัดการผู้ใช้
                            </div>
                        </div>
                    </a>
				</div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_web">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-cog"></i> จัดการเว็บ
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_product">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-shopping-basket"></i> จัดการสินค้า
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_termgame">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-gamepad"></i> จัดการเติมไอดี-พาส
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_code">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-code"></i> จัดการโค๊ด
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_topup">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการเติมเงิน
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_product">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการซื้อสินค้า
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_termgame">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการเติมไอดี-พาส
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_random">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการสุ่มของรางวัล
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>