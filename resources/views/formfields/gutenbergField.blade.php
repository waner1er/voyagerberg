<input type="textarea"
       id="content"
       class="form-control"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       @if($row->required == 1) required @endif
       step="any"
       placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">


<script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
<link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>

<script>
    class LaravelFilemanager extends Laraberg.wordpress.element.Component {
        constructor (props) {
            super(props)
            this.state = {
                media: []
            }
        }

        getMediaType = (path) => {
            const video = ['mp4', 'm4v', 'mov', 'wmv', 'avi', 'mpg', 'ogv', '3gp', '3g2']
            const audio = ['mp3', 'm4a', 'ogg', 'wav']
            const extension = path.split('.').slice(-1).pop()
            if (video.includes(extension)) {
                return 'video'
            } else if (audio.includes(extension)) {
                return 'audio'
            } else {
                return 'image'
            }
        }

        onSelect = (url, path) => {
            this.props.value = null
            const { multiple, onSelect } = this.props
            const media = {
                url: url,
                type: this.getMediaType(path)
            }
            if (multiple) { this.state.media.push(media) }
            onSelect(multiple ? this.state.media : media)
        }

        openModal = () => {
            let type = 'file'
            if (this.props.allowedTypes.length === 1 && this.props.allowedTypes[0] === 'image') {
                type = 'image'
            }
            this.openLFM(type, this.onSelect)
        }

        openLFM = (type, cb) => {
            const routePrefix = '/laravel-filemanager'
            window.open(routePrefix + '?type=' + type, 'FileManager', 'width=900,height=600')
            window.SetUrl = function (items) {
                if (items[0]) {
                    cb(items[0].url, items[0].name)
                }
            }
        }

        render () {
            const { render } = this.props
            return render({ open: this.openModal })
        }
    }

    /**
     * désactivation du bouton de l'éditeur Gutenberg
     */

    elementRendered('.components-form-file-upload button', element => element.remove())

    /**
     * ajout de la fonctionnalité de mediaUpload
     * @param selector
     * @param callback
     * @returns {MutationObserver}
     */
    function elementRendered (selector, callback) {
        const renderedElements = []
        const observer = new MutationObserver((mutations) => {
            const elements = document.querySelectorAll(selector)
            elements.forEach(element => {
                if (!renderedElements.includes(element)) {
                    renderedElements.push(element)
                    callback(element)
                }
            })
        })
        observer.observe(document.documentElement, { childList: true, subtree: true })
        return observer
    }

    Laraberg.wordpress.hooks.addFilter(
        'editor.MediaUpload',
        'core/edit-post/components/media-upload/replace-media-upload',
        () => LaravelFilemanager
    )


    /**
     * définition d'un mediaUpload vide
     */
    const mediaUpload = ({filesList, onFileChange}) => {}

    const options = {
        height: "500px", // OK
        alignWide: true, //OK
        mediaUpload: mediaUpload, //OK
        supportsLayout: true, //OK
        colors: {
            background: '#f5f5f5',
        },
        fontSizes: [{name: 'small', size: 12}, {name: 'normal', size: 14}, {name: 'large', size: 16}, {
            name: 'huge',
            size: 18
        }], //OK
    }

    Laraberg.init('content', options);
</script>
