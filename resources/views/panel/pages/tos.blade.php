@extends('layouts.panel')

@section('title', 'Terms of Service')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />

    <style>
        .ql-editor.ql-blank::before,
        .ql-snow .ql-picker,
        .ql-stroke,
        .ql-snow .ql-stroke {
            color: var(--bs-body-color);
            stroke: var(--bs-body-color)
        }

        .ql-toolbar.ql-snow,
        .ql-container.ql-snow {
            border: 1px solid rgb(255 255 255 / 12%);
        }
    </style>
@stop


@section('content')

    <x-panel.breadcrumb title="Terms of Service" page="Terms of Service" />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('tos.update') }}" method="POST">
                @csrf
                @method('PATCH')


                <label class="form-label">Terms of Service</label>
                <div id="tos_editor">
                    {!! old('privacy_policy', $tos) !!}
                </div>

                <input type="hidden" name="tos" id="tos">

                <button type="reset" class="btn btn-secondary mt-3 me-3">Reset</button>
                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>

            </form>

        </div>
    </div>


@stop


@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    <script>
        const toolbarOptions = [
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            ['link', 'image', 'video'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'list': 'check'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];

        const getTos = document.getElementById('tos');

        const tos = new Quill('#tos_editor', {
            theme: 'snow',
            placeholder: 'Enter Description',
            modules: {
                toolbar: toolbarOptions
            }
        });

        tos.on('editor-change', function() {
            const delta = tos.getSemanticHTML();
            getTos.value = delta
        });

        document.addEventListener('DOMContentLoaded', function() {
            getTos.value = tos.getSemanticHTML();
        });
    </script>

    @if (Session::has('success'))
        <script>
            window.onload = function() {
                pos1_default_noti();
            }

            function pos1_default_noti() {
                Lobibox.notify('default', {
                    rounded: true,
                    icon: 'bx bx-check-circle',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    size: 'mini',
                    msg: "{{ Session::get('success') }}"
                });
            }
        </script>
    @endif

@stop
