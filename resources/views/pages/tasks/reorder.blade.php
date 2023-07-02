@extends('layouts.app')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
            bis_skin_checked="1">
            <h1 class="h2">Tasks reorder</h1>

        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    \Illuminate\Support\Facades\Session::forget('success');
                @endphp
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                @php
                    \Illuminate\Support\Facades\Session::forget('success');
                @endphp
            </div>
        @endif

        <!-- Contextual classes start -->

        <div class="row" id="table-contextual">
            <div class="col-12">
                <div class="card">
                    <ul id="sortable">
                        @foreach($tasks as $key => $content)
                            <li data-priority="{{$content->priority}}" id="{{$content->id}}"
                                class="ui-state-default">
                                <i data-feather='arrow-up'></i>
                                <i data-feather='arrow-down'></i>
                                ID:{{$content->id}}- #{{$content->priority}}
                                . {{strip_tags($content->title)}}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </main>

@endsection



@section('extra_JS')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendors/orderable/jquery.orderable.js')}}"></script>
    <script>
        $(function () {
            $("#sortable").sortable(
                {
                    start: function (event, ui) {
                        $(this).attr('data-previndex', ui.item.index());
                    },
                    update: function (e, ui) {
                        ui.item.attr('data-priority', ui.item.index());
                        let prioritys = [];
                        $('#sortable').each(function () {
                            // inner scope
                            var phrase = '';
                            $(this).find('li').each(function (value) {
                                var current = $(this);
                                console.log(current.attr('id'))
                                prioritys.push({
                                    'id': current.attr('id'),
                                    'priority': current.attr('data-priority'),
                                })
                            });
                        });
                        $.ajax({
                            url: '{{route('tasks.reorder_action')}}',
                            type: 'POST',
                            data: {
                                'table': prioritys,
                                '_token':'{{csrf_token()}}'
                            },
                            success: (response) => {

                            }
                        })
                    }
                }
            );
        });

    </script>
    <!-- END: Page Vendor JS-->

@endsection

@section('extra_CSS')

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/vendors/orderable/jquery.orderable.css')}}">
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            font-size: 1.4em;
        }

        #sortable li i {
            position: absolute;
        }
    </style>

    <!-- END: Page CSS-->

@endsection
