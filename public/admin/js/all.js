var elm = $("ul.nav-check-current>li.nav-item>a");
var url_current = window.location.href;
var url_origin   = $("meta[name='url-home']").attr("content")+'/quan-tri';

url_current = url_current.replace(url_origin, '');
// console.log('host:' + url_current);
elm.map(function(index, item) {

    if(url_current.indexOf(item.href.replace(url_origin, '')) > -1) {
        $(item).addClass("active");

    }
    // console.log(item.href.replace(url_origin, ''));
});

function closeModalRender() {
    // $('#modalFormedit').modal('hide');
    $('.model-render').remove();

}

function selectFileWithCKFinder(preview, in_value, type) {
    var url_home = $('meta[name="url-home"]').attr('content');

    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {

            finder.on('files:choose', function (evt) {

                if (type == 'MULTIPLE') {
                    var files = evt.data.files;

                    var html = '',
                        url_file;
                    var value = $(in_value).val() ? $(in_value).val() + ',' : '';
                    files.forEach(function (file, i) {
                        url_file = file.getUrl().replace(url_home, '');
                        html += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <span data-route="0" data-url="${url_file}" class="delete-image-ckfinder">
                                        <i class="fas fa-times pointer"></i>
                                    </span>
                                    <img src="${file.getUrl()}" width="100%">
                                </div>`;
                        if (i < files.length - 1) {
                            value += url_file + ',';
                        } else {
                            value += url_file;
                        }
                    });
                    $(preview).append(html);
                    $(in_value).val(value);
                } else {
                    var file = evt.data.files.first();
                    $(preview).attr('src', file.getUrl());
                    $(in_value).val(file.getUrl().replace(url_home, ''));
                }
            });
        }

    });
}

$(".form-delete").submit(function(e){
    if(!confirm('Bạn có muốn thực hiện')){
        e.preventDefault();
    }
})
$(document).on('click', '.add-image-ckfinder', function (event) {
    /* Act on the event */
    var preview = $(this).data('preview');

    var in_value = $(this).data('input');

    var type = $(this).data('type');
    selectFileWithCKFinder(preview, in_value, type);
});

