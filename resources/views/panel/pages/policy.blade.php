@extends('layouts.panel')

@section('title', 'Policies')

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

    <x-panel.breadcrumb title="Policies" page="Policies" />

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

            <ul class="nav nav-tabs nav-primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#privacy_policy" role="tab"
                        aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                            </div>
                            <div class="tab-title">Privacy Policy</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#refund_policy" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                            </div>
                            <div class="tab-title">Refund & Refund Policy</div>
                        </div>
                    </a>
                </li>
            </ul>


            <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="privacy_policy" role="tabpanel">


                    <form action="{{ route('policies.privacy') }}" method="POST">
                        @csrf
                        @method('PATCH')


                        <label class="form-label">Privacy Policy</label>
                        <div id="privacy_editor">
                            {!! old('privacy_policy', $privacy) !!}
                        </div>

                        <input type="hidden" name="privacy_policy" id="privacy">

                        <button type="reset" class="btn btn-secondary mt-3 me-3">Reset</button>
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>

                    </form>



                </div>
                <div class="tab-pane fade" id="refund_policy" role="tabpanel">

                    <form action="{{ route('policies.refund') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label class="form-label">Refund & Return Policy</label>
                        <div id="refund_editor">
                            {!! old('refund', $refund) !!}
                        </div>

                        <input type="hidden" name="refund_policy" id="refund">

                        <button type="reset" class="btn btn-secondary mt-3 me-3">Reset</button>
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>

                    </form>

                </div>
            </div>
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

        const getPrivacy = document.getElementById('privacy');
        const getRefund = document.getElementById('refund');

        const privacy = new Quill('#privacy_editor', {
            theme: 'snow',
            placeholder: 'Enter Description',
            modules: {
                toolbar: toolbarOptions
            }
        });

        const refund = new Quill('#refund_editor', {
            theme: 'snow',
            placeholder: 'Enter Description',
            modules: {
                toolbar: toolbarOptions
            }
        });

        privacy.on('editor-change', function() {
            const delta = privacy.getSemanticHTML();
            getPrivacy.value = delta
        });

        refund.on('editor-change', function() {
            const delta = refund.getSemanticHTML();
            getRefund.value = delta
        });

        document.addEventListener('DOMContentLoaded', function() {
            getPrivacy.value = privacy.getSemanticHTML();
            getRefund.value = refund.getSemanticHTML();
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
