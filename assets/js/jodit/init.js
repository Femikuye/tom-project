var editor = new Jodit('#area_editor', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
            url: 'https://xdsoft.net/jodit/connector/index.php?action=fileUpload'
        },
        filebrowser: {
            // buttons: ['list', 'tiles', 'sort'],
            ajax: {
                url: 'https://xdsoft.net/jodit/connector/index.php'
            }
        },
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });