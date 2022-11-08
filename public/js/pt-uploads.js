(function ($) {
    $.fn.ptUploads = function(options) {
        var version = "?v=" + Math.floor(Math.random() * 10000000000)
        var url_host = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;
        var url_delete = url_host + "/api/delete/file";
        var url_put = url_host + "/api/upload/file";
        var id_parent = "#" + $(this).attr('id');
        var id_choose_file = id_parent + "-choose-file";

        var settings = $.extend({
            filename: "",
            text: "Không có tiêu đề",
            url: '',
            is_file: false,
            event_upload_error: null,
            event_upload_success: null,
        }, options);

        const template_file = "<input type='file' class='hide' id='" + id_choose_file.replace("#", '') + "' accept='*'/>";
        const template_upload = template_file + "<button class='btn btn-primary pt-item-uploads'><i style='margin-right: 5px;' class='fa fa-cloud-upload' aria-hidden='true'></i>Đính kèm tệp tin</button>";
        const template_image = "<a target='_blank' href='{url}'>{url}</a><i style='display: block; float: right; font-size: 16px;' class='fa fa-trash pt-del-file text-danger' aria-hidden='true'></i>";

        // Sự kiện chọn file
        function suKienChonFile(){
            $(id_parent + " > .pt-item-uploads").on('click', function (){
                $(id_choose_file).trigger('click');
            });
        }

        // Sự kiện tải ảnh lên
        function suKienTaiLen(){
            $(id_choose_file).change(function () {
                formData = new FormData();
                formData.append("teptin", this.files[0]);
                $.ajax({
                    url: url_put,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            settings.url = result.message;
                            settings.event_upload_success(result.message)
                            renderUI();
                        }else{
                            settings.event_upload_error(result.message);
                        }
                    },
                    xhr: function () {
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function (event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                $(id_parent + " > .pt-item-uploads").html("<i class='fa fa-cloud-upload' aria-hidden='true' style='margin-right: 10px;'></i> Đang tải lên tệp tin " + percent + "%");
                            }, true);
                        }
                        return xhr;
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        }

        // Sự kiện xóa ảnh
        function xoaFile(){

            var r = confirm("Nếu thực hiện xóa, tệp tin này sẽ không thể phục hồi lại được?\nBạn vẫn muốn xóa? ");
            if (r !== true) {
                return;
            }

            var st = false;
            $.ajax({
                url: url_delete,
                type: "POST",
                async: false,
                data: {
                    'duongdan': settings.url,
                },
                success: function (result) {
                    result = JSON.parse(result)
                    if (result.status === 200) {
                        st = true;
                        settings.url = "";
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
            return st;
        }

        // Tạo giao diện upload ảnh
        function UIUpload(){
            $(id_parent).empty();
            $(id_parent).append(template_upload);
            suKienChonFile();
            suKienTaiLen();
        }

        // Tạo giao diện hiển thị ảnh
        function UITonTaiAnh(){
            $(id_parent).empty();
            tmp = template_image.replace('{url}', settings.url);
            tmp = tmp.replace('{url}', settings.url);
            $(id_parent).append(tmp);

            $(id_parent).find("i.pt-del-file").on('click', function (){
                if(xoaFile() === false){
                    alert("Tệp tin không tồn tại hoặc thao tác xóa tệp tin thất bại");
                }
                $(id_parent).empty().append(template_upload);
                suKienChonFile();
                suKienTaiLen();
            });
        }

        // Tạo giao diện
        function renderUI(){
            if(settings.url.length > 10)
                UITonTaiAnh();
            else
                UIUpload();
        }

        renderUI();

        return {
            isFile: function (){
                return (settings.url.length > 10);
            },
            getURL: function (){
                return settings.url;
            }
        }

    };
}( jQuery ));
