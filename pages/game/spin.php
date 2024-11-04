<?php
$pluem = new classweb_bypluem;
$history_random = $pluem->history_random();
?>
<link rel="stylesheet" type="text/css" href="../../assets/css/superwheel.css">
<script src="../../assets/js/superwheel.js"></script>
<style>
    img.show-spin {
        width: 270px;
        transform: rotate(-272deg) translate(3px, -50%);
        max-width: 200px !important;
        height: auto !important;
        padding-bottom: 120px;
    }

    @media screen and (max-width: 400px) {
        img.show-spin {
            width: 125px;
            padding-top: 30px;
        }
    }

</style>
<div class="container mt-3 text-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="superwheel"></div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-success spin-button" id="spin-pluem">สุ่มเลย 20 เครดิต</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3 text-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">วันที่-เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history_random as $row){ ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.superwheel').superWheel({
    slices: [
        {
            text: "../../assets/image/spin/5_credit.png",
            value: 'a',
            background : "#292721",
        },
        {
            text: "../../assets/image/spin/50_credit.png",
            value: 'b',
            background : "#292721",
        },
        {
            text: "../../assets/image/spin/100_credit.png",
            value: 'c',
            background : "#292721",
        },
        {
            text: "../../assets/image/spin/300_credit.png",
            value: 'd',
            background : "#262520",
        },
        {
            text: "../../assets/image/spin/500_credit.png",
            value: 'e',
            background : "#292721",
        },
        {
            text: "../../assets/image/spin/1000_credit.png",
            value: 'f',
            background : "#8E610F",
        },
        {
            text: "../../assets/image/spin/nospin.png",
            value: 'g',
            background : "#292721",
        },
    ],
        width: 600,
        frame: 1,
        type: "spin",
        text: {
            type: "image",
            color: "#C7A859",
            size: 20,
            offset: 8,
            orientation: "h",
            arc: false
        },
        line: {
            color: "#C7A859"
        },
        outer: {
            color: "#C7A859"
        },
        inner: {
            color: "#C7A859"
        },
        center: {
            width: 40,
            rotate: true,
            image: {
                url: "",
                width : 40,
            }
        },
        marker: {
            animate: "true"
        }
    });
    var tick = new Audio('https://www.22codes.com/demo/javascript/superwheel/dist/tick.mp3');
    $(document).on('click', '.spin-button', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './api/spinbypluem/spin.php?game=spin',
        }).then((res) => {
            var obj = JSON.parse(res);
            if (obj.status == "success") {
                $('.superwheel').superWheel('start', 'value', obj.spin_value);
                document.getElementById("spin-pluem").disabled = true;
                document.getElementById("spin-pluem").innerHTML = "รอสักครู่ขณะนี้วงล้อกำลังทำการสุ่ม";
                $('.superwheel').superWheel('onComplete', function() {
                    var obj = JSON.parse(res);
                    Swal.fire({
                        icon: obj.status,
                        title: obj.title,
                        text: obj.message,
                    }).then(function(){
                        window.location.reload();
                    })
                });
            }else if(obj.status == "error") {
                $('.superwheel').superWheel('start', 'value', obj.spin_value);
                document.getElementById("spin-pluem").disabled = true;
                document.getElementById("spin-pluem").innerHTML = "รอสักครู่ขณะนี้วงล้อกำลังทำการสุ่ม";
                $('.superwheel').superWheel('onComplete', function() {
                    var obj = JSON.parse(res);
                    Swal.fire({
                        icon: obj.status,
                        title: obj.title,
                        text: obj.message,
                    }).then(function(){
                        window.location.reload();
                    })
                });
            }else{
                Swal.fire({
                    icon: obj.status1,
                    title: obj.title1,
                    text: obj.message1,
                }).then(function(){
                    window.location.reload();
                })
            }
        });
    });
    $('.superwheel').superWheel('onStep', function(results) {
        if (typeof tick.currentTime !== 'undefined')
        tick.currentTime = 0;
        tick.play();
    });
</script>