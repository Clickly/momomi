$(".submit_termgame").click(function() {
    var id_item = $(this).attr("id_item");
    var name_item = $(this).attr("name_item");
    var username_tm = $("#username_tm").val();
    var password_tm = $("#password_tm").val();

    // แสดง modal ให้เลือกจำนวนสินค้าก่อน
    Swal.fire({
        title: 'เลือกจำนวนสินค้าที่จะซื้อ:',
        html: `<div class="form-group">
                    <label for="quantity">จำนวน:</label>
                    <select id="quantity" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>`,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('quantity').value // รับค่าจำนวนที่เลือก
            ]
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var quantity = result.value[0]; // รับค่าจำนวนที่เลือก
            // แสดงคำถามยืนยันการซื้อ
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่!',
                text: "คุณแน่ใจที่ต้องการซื้อสินค้า " + name_item + " จำนวน " + quantity + " ใช่หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่'
            }).then((confirmResult) => {
                if (confirmResult.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "./api/bypluemv1/termgame.php",
                        dataType: "json",
                        data: {
                            id_item: id_item,
                            username_tm: username_tm,
                            password_tm: password_tm,
                            quantity: quantity // ส่งค่าจำนวนสินค้าที่เลือก
                        },
                        success: function(data) {
                            if (data.status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ!',
                                    text: data.message,
                                }).then(function() {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: data.message,
                                });
                            }
                        }
                    });
                }
            });
        }
    });
});
