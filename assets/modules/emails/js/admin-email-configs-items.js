//<![CDATA[
$(document).ready(function () {
    $('form[name=main]').submit(function (event) {
        var action = $('select[name="action"]').val();
        if (action === 'delete') {
            if (confirm("Bạn có thật sự muốn xóa các cấu hình email này? Nếu đồng ý, tất cả dữ liệu liên quan sẽ bị xóa. Bạn sẽ không thể phục hồi lại chúng sau này!")) {
                return true;
            }
            return false;
        }
    });

    $('.delete_bootbox').on('click', function (e, confirmed) {
        var link = $(this).attr('href');
        if (!confirmed) {
            e.preventDefault();
            BootstrapDialog.confirm({
                title: 'XÁC NHẬN THÔNG TIN',
                message: 'Bạn có thật sự muốn xóa cấu hình email này? Nếu đồng ý, tất cả dữ liệu liên quan sẽ bị xóa. Bạn sẽ không thể phục hồi lại chúng sau này!',
                type: BootstrapDialog.TYPE_DANGER,
                closable: true,
                draggable: true,
                btnCancelLabel: 'Hủy bỏ',
                btnOKLabel: 'Đồng ý',
                btnOKClass: 'btn-primary',
                callback: function (result) {
                    if (result) {
                        window.location.href = link;
                    }
                }
            });
        }
    });

    var obj_fields = {
        'active': {field: "active", massage_success: "Đã bật kích hoạt cấu hình email!", massage_warning: "Đã tắt kích hoạt cấu hình email!"}
    };
    Object.keys(obj_fields).forEach(function (key) {
        $(".change-" + key).on('ifChanged', function () {
            var id = $(this).val();
            var value = 0;
            if ($(this).is(':checked')) {
                value = 1;
            }
            var form_data = obj_fields[key];
            form_data.id = id;
            form_data.value = value;

            $.ajax({
                type: "POST",
                url: base_url + 'admin/emails/configs/change-field',
                data: form_data,
                success: function (html) {
                    $("#notify").html(html);
                }
            });

            return false;
        });
    });
});
//]]>