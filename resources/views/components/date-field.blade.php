@props([
    'format' => 'd.m.Y',
    'name' => '',
    'value' => '',
    'range' => "false",
    "from" => date("d.m.Y"),
    "to" =>  today()->addDay()->format("d.m.Y"),
])


@if($range === "false")
    <div class="inner-addon right-addon {{ $class ?? "" }}">
        <i class="fa"> <img src="{{asset('/media/agenda.svg')}}" width="22"></i>
        <input class="form-control x-datetimepicker" name="{{ $name ?? "" }}" value="{{ $value ?? "" }}">
    </div>
@else

    <div class="x-datetimepicker range inner-addon right-addon {{ $class ?? "" }}">
        <i class="fa fa-calendar"></i>
        <input class="form-control x-datetimepicker" name="{{ $name ?? "" }}" value="{{ $value ?? "" }}">
    </div>

@endif



@push("stackedScripts")
    @once

{{--        <link rel="stylesheet" href="/vendor/jquery-datetimepicker/jquery.datetimepicker.min.css">--}}

{{--        <script src="/vendor/jquery-datetimepicker/jquery.datetimepicker.full.min.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


        <script>

            window._initDateTimePicker = function () {

                const locale = {
                    format: 'MM/DD/YYYY',
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                }



                $('.x-datetimepicker.range input').daterangepicker({
                    locale: locale,
                    autoApply: true,
                    maxDate: moment()
                }, function(start, end, label) {

                });

            }

            $(document).ready(window._initDateTimePicker)
        </script>
    @endonce
@endpush

