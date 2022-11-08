(function ($) {

    Array.prototype.remove = function () {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };

    $.fn.ptUploads = function (options) {
        var version = "?v=" + Math.floor(Math.random() * 10000000000)
        var url_host = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;
        var url_delete = url_host + "/api/delete/file";
        var url_put = url_host + "/api/upload/file";
        var id_parent = "#" + $(this).attr('id');
        var id_choose_file = id_parent + "-choose-file";

        var settings = $.extend({
            filename: "",
            title: "Chọn tệp tin",
            list_file: [],
            is_file: false,
            max_size_kb: 20 * 1024,
            accept: '.pdf, .docx, .doc, .xlsx, .xls',
            event_upload_error: null,
            event_upload_success: null,
        }, options);

        const template_file = "<input type='file' class='hide' id='" + id_choose_file.replace("#", '') + "' accept='{accept}'/>";
        const template_upload = template_file + "<button style='margin-top: 10px;' class='btn btn-primary pt-item-uploads'><i style='margin-right: 5px;' class='fa fa-cloud-upload' aria-hidden='true'></i>{title} ({size})</button>";
        const template_image = "<a target='_blank' href='{url}'>{url}</a><i style='display: block; float: right; font-size: 16px; color: red;' id='pt-del-file-{index}' path='{url}' class='fa fa-trash' aria-hidden='true'></i><br>";

        // Sự kiện chọn file
        function suKienChonFile() {
            $(id_parent + " > .pt-item-uploads").on('click', function () {
                $(id_choose_file).trigger('click');
            });
        }

        // Sự kiện tải ảnh lên
        function suKienTaiLen() {
            $(id_choose_file).change(function () {
                formData = new FormData();
                formData.append("teptin", this.files[0]);

                var size = (this.files[0].size) / 1024;

                if(size > settings.max_size_kb){
                    alert("Hệ thống chỉ cho phép tải lên tệp tin có kích thước nhỏ hơn " + Math.round(settings.max_size_kb/1014) + "MB.");
                    return;
                }

                $.ajax({
                    url: url_put,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            settings.list_file.push(result.message);
                            settings.url = result.message;
                            settings.event_upload_success(result.message)
                            init();
                        } else {
                            init();
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
        function suKienXoaFile(path) {

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
                    'duongdan': path,
                },
                success: function (result) {
                    result = JSON.parse(result)
                    if (result.status === 200)
                        st = true;
                },
                error: function (error) {
                    console.log(error);
                }
            });
            return st;
        }

        function init() {
            $(id_parent).empty();
            if (settings.list_file.length > 0) {
                settings.list_file.forEach(function (item, index) {
                    tmp = template_image.replace('{url}', item);
                    tmp = tmp.replace('{url}', item);
                    tmp = tmp.replace('{url}', item);
                    tmp = tmp.replace('{index}', index);
                    $(id_parent).append(tmp);

                    $(id_parent).find("#pt-del-file-" + index).on('click', function () {
                        var path = $(this).attr('path');
                        if (suKienXoaFile(path) === false) {
                            alert("Tệp tin không tồn tại hoặc thao tác xóa tệp tin thất bại");
                        }

                        settings.list_file.remove(path);
                        init();
                    });

                });
            }
            tmp = template_upload.replace('{title}', settings.title);
            tmp = tmp.replace('{accept}', settings.accept);
            tmp = tmp.replace('{size}', "Dung lượng < " + Math.round(settings.max_size_kb/1014) + "MB");
            $(id_parent).append(tmp);
            suKienChonFile();
            suKienTaiLen();
        }

        init();

        return {
            isFile: function () {
                return settings.list_file.length > 0;
            },
            getURL: function () {
                return JSON.stringify(settings.list_file);
            }
        }

    };
}(jQuery));
