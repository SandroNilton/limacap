<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/translations/es.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>

@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '']) !!}></textarea>

<style>
    .ck-content {
      color: #595959;
      font-size: 14px;
      margin: 0 0 0 0;
      padding: 0 0 0 0;
    }

    .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-toolbar, .ck.ck-editor__top .ck-sticky-panel .ck-toolbar.ck-rounded-corners {
      border-radius: 3px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }

    .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
      border-radius: 3px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;

    }

    .ck.ck-toolbar {
      border: 1px solid #e9ebec;
    }

    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
      border-color: #e9ebec;
    }

    .ck.ck-icon {
      width: 14px;
    }

    .ck.ck-button {
      color: #595959;
    }

    .ck.ck-editor__editable_inline>:last-child {
      margin-bottom: 0.5rem;
    }

    .ck.ck-editor__editable_inline>:first-child {
      margin-top: 0.5rem;
    }

    .ck-editor__editable_inline {
      padding: 0 35px !important;
  }
</style>

<script>
CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
    toolbar: {
    items:  [ 'exportPDF','exportWord', '|', 'findAndReplace', 'selectAll', '|','bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|', 'bulletedList',
                'numberedList', 'todoList', '|', 'outdent', 'indent', '|', 'undo', 'redo', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight',
                '|', 'alignment', '|', 'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|','specialCharacters', 'horizontalLine', 'pageBreak' ],
    shouldNotGroupWhenFull: true
    },
    language: 'es',
    list: { properties: { styles: true, startIndex: true, reversed: true } },
    placeholder: 'Descripción',
    fontFamily: {
    options:  [ 'default', 'Arial, Helvetica, sans-serif', 'Courier New, Courier, monospace', 'Georgia, serif', 'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif' ],
    supportAllValues: true
    },
    fontSize: { options: [ 10, 12, 14, 'default', 18, 20, 22 ], supportAllValues: true },
    link: {
    decorators: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        toggleDownloadable: {
        mode: 'manual',
        label: 'Downloadable',
        attributes: {
            download: 'file'
        }
        }
    }
    },
    removePlugins: [
    // 'ExportPdf',
    // 'ExportWord',
    'CKBox', 'CKFinder', 'EasyImage',
    // 'Base64UploadAdapter',
    'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments', 'TrackChanges',
    'TrackChangesData', 'RevisionHistory', 'Pagination', 'WProofreader', 'MathType', 'SlashCommand', 'Template', 'DocumentOutline', 'FormatPainter', 'TableOfContents'
    ]
});
</script>
