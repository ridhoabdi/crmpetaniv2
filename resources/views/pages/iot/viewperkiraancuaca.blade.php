@extends('layouts.mother')

@section('container')

<div class="row">
    <div class="col-md-12">
        <p class="h3 fw-bold">Perkiraan Cuaca</p>
        <p class="lead">Silahkan tambahkan lokasi agar mendapatkan perkiraan cuaca yang sesuai dengan lokasi Anda</p>
        <script>
            (function(d, s, id) {
                if (d.getElementById(id)) {
                    if (window.__TOMORROW__) {
                        window.__TOMORROW__.renderWidget();
                    }
                    return;
                }
                const fjs = d.getElementsByTagName(s)[0];
                const js = d.createElement(s);
                js.id = id;
                js.src = "https://www.tomorrow.io/v1/widget/sdk/sdk.bundle.min.js";

                fjs.parentNode.insertBefore(js, fjs);
            })(document, 'script', 'tomorrow-sdk');
        </script>

        <div class="tomorrow"
           data-location-id="{{ $lokasisawahs->isNotEmpty() ? $lokasisawahs->first()->kabupaten_kode : '056378' }}"
           data-language="ID"
           data-unit-system="METRIC"
           data-skin="light"
           data-widget-type="upcoming"
           style="padding-bottom:22px;position:relative;">
        </div>
    </div>
</div>

@endsection