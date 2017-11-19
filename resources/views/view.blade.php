@extends('layout.main')

@section('title', "Algorism Property Listing")

@section('nav')
    <a href="{{ url('/') }}" class="btn btn-primary btn-block"><i class="fa fa-chevron-left"></i> Back</a>
@stop

@section('customstyle')
    <style>
        ul.aux-info {
            width: 100%;
            margin: 0;
            padding: 0;
            display: block;
            background: #f4f5f4;
        }

        ol, ul {
            list-style: none;
        }
        ul.aux-info li {
            display: table-cell;
            font-size: 12px;
            padding: 10px 15px;
            vertical-align: middle;
            border-right: 1px solid #eaebec;
        }
        ul.aux-info .lastitem{
            border-right: 0;
        }
        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }
        ul.aux-info li i {
            font-size: 15px;
            margin-right: 8px;
            color: #2f3d46;
        }
    </style>
@endsection

@section('customscript')
    <script>
        $(document).ready(function (e) {
            var id = '{{ $id }}';
            var viewcon = $('#viewcon');

            $.get('/api/viewproperty/'+id,function (data) {

                $('#content-page').html('');
                if(data != ""){
                    $('#title').html(data.title);
                    $('#location').html(data.location);
                    $('#price').html(data.price);
                    $('#city').html(data.city);
                    $('#detail').html(data.description);

                    $('.aux-info').html(''+
                        (data.bedroom > 0 ? '<li><i class="fa fa-bed"></i><span>'+data.bedroom+' Bedrooms</span></li>' : '' )+
                        (data.bathroom > 0 ? '<li><i class="fa fa-bath"></i><span>'+data.bathroom+' Bathrooms</span></li>' :'') +
                        (data.toilet > 0 ? '<li><i class="fa fa-tint"></i><span>'+data.toilet+' Toilets</span></li>' : '')+
                        '<li><i class="fa fa-building"></i><span>'+data.protype+'</span></li>'
                    );
                    viewcon.show();
                }
                else{
                    $(location).attr('href','{{ url('/') }}');
                }

            }).fail(function (error) {
                swal(
                    'Oops...',
                    'Something went wrong!',
                    'error'
                )
            })
        })
    </script>
@endsection

@section('content')

    <div class="row" id="content-page">
        <div class="loader-wrapper" style="margin-left: 45%; margin-top: 10%" id="loader-1">
            <div id="loader"></div>
        </div>
    </div>

    <div style=" margin-bottom: 100px; background-color: #d9def4; padding-top: 50px; padding-bottom: 50px; display: none" id="viewcon">
        <div class="row">
            <div class="offset-2"></div>
            <div class="col-md-8">
                <div class="row" style="padding-left: 40px">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-12">
                                <h5 id="title"></h5>
                                <p><i class="fa fa-map-marker"></i>&nbsp;<span id="location"> </span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 style="color: #c30000;">&#8358; <span id="price"></span></h4>
                    </div>
                    </div><hr>
                    <div class="col-md-12" id="contents">
                        <ul class="aux-info">
                        </ul>
                        <br><br>
                        <div class="card">
                            <div class="card-header">
                                <strong>Details</strong>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Property Description</h5>
                                <p class="card-text" id="detail"></p>
                                <p><b>City:</b> <span id="city"></span> </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>



@endsection
