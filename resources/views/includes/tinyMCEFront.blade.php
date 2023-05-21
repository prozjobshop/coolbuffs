<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
$(document).ready(function () {
    tinymce.PluginManager.add('placeholder', function (editor) {
        editor.on('init', function () {
            var label = new Label;
            onBlur();
            tinymce.DOM.bind(label.el, 'click', onFocus);
            editor.on('focus', onFocus);
            editor.on('blur', onBlur);
            editor.on('change', onBlur);
            editor.on('setContent', onBlur);
            function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
            function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
        });
        var Label = function () {
            var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
            var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
            var contentAreaContainer = editor.getContentAreaContainer();
            tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
            this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
        }
        Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
        Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
    });
    tinymce.init({
        selector: '#description',
        height: 150,
        forced_root_block: '',
        plugins: [
            'placeholder',
            'advlist autolink lists image',
            'searchreplace visualblocks code fullscreen',
            'media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',
        relative_urls: true,
        images_upload_url: "{{ route('tinymce.image_upload.front') }}",
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
    });
    	
    	tinymce.init({
        selector: '#benefits',
        height: 150,
        forced_root_block: '',
        plugins: [
            'placeholder',
            'advlist autolink lists image',
            'searchreplace visualblocks code fullscreen',
            'media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',
        relative_urls: true,
        images_upload_url: "{{ route('tinymce.image_upload.front') }}",
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
    });
});
</script>