$(".submit_buyproduct").click(function() {
    var id_product = $(this).attr("id_product");
    var name_product = $(this).attr("name_product");

    // แสดง modal เพื่อให้ผู้ใช้พิมพ์จำนวนสินค้า
    Swal.fire({
        title: 'กรุณากรอกจำนวนสินค้าที่จะซื้อ',
        html: `
            <input id="quantity" class="swal2-input" type="number" min="1" value="1" placeholder="กรอกจำนวน">
        `,
        focusConfirm: false,
        preConfirm: () => {
            const quantity = document.getElementById('quantity').value;
            return quantity ? quantity : null; // ตรวจสอบว่าผู้ใช้กรอกจำนวนหรือไม่
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var quantity = result.value; // จำนวนสินค้าที่เลือก

            // แสดงคำถามยืนยันการซื้อ
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่!',
                text: "คุณแน่ใจที่ต้องการซื้อสินค้า " + name_product + " จำนวน " + quantity + " ใช่หรือไม่?",
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
                        url: "./api/bypluemv1/buyproduct.php",
                        dataType: "json",
                        data: { id_product, quantity }, // ส่ง id_product และ quantity
                        success: function(data) {
                            if (data.status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ!',
                                    text: data.message,
                                }).then(function() {
                                    window.location.href = '/history_shop';
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
