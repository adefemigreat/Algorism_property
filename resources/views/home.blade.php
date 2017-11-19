@extends('layout.main')

@section('title', "Algorism Property Listing")

@section('nav')
    <a href="{{ url('/addproperty') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add New</a>
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
    <!--Page loading and Pagination-->
    <script>

        var sta = "null";
        $(document).ready(function () {
            getcontent(1, sta);
        });

        function getcontent(page, status) {
            $.get('/api/getproperties/?page='+page,{status:status},function (data) {
                var contentpage = $('#content-page');
                var currentpage = data.current_page;
                var lastpage = data.last_page;
                var content = data.data;

                contentpage.html('');

                if(content.length < 1 && status == 'null'){

                    contentpage.html('<div class="col-md-12">' +
                        '<div class="alert alert-warning" role="alert">'+
                    'No Record Found!'+
                    '</div></div>');
                }
                else if(content.length < 1 && status != 'null'){
                    contentpage.html('<div class="col-md-12">' +
                        '<div class="alert alert-warning" role="alert">'+
                        'Your Searched content was not found' +
                        '</div></div>');
                }
                else{
                    for(i=content.length-1; i>=0;i--){

                        contentpage.append('' +
                            '<div id="mycard" style="margin-bottom: 30px" class="col-md-6">' +
                            ' <div class="card">' +
                            '<div class="card-header"><b>' +content[i].title+ '</b>' +

                            '<div style="float:right"><a class="btn btn-primary" href="{{ url('viewproperty') }}'+'/'+content[i].title+'">View Property</a>' +
                            '&nbsp;<button onclick="remove(' +content[i].id+ ')" class="btn btn-danger"><i class="fa fa-times"></i></button></div></div>' +

                            '<div class="card-body">' +
                            '<div class="row no-gutters">' +

                            '<div class="col-md-12">'+
                            '<small class="card-text">' +(content[i].description).substr(0, 200)+((content[i].description).length > 200?'...':'') + '</small><hr>'+
                            '<h5 style="color: #d2470a">&#8358;' +content[i].price+ '</h5></div></div></div>'+
                            '<div class="card-footer text-muted" style="padding: 0">'+
                            '<ul class="aux-info">'+
                            (content[i].bedroom > 0 ? '<li><i class="fa fa-bed"></i><span>'+content[i].bedroom+' Bedrooms</span></li>' : '' )+
                            (content[i].bathroom > 0 ? '<li><i class="fa fa-bath"></i><span>'+content[i].bathroom+' Bathrooms</span></li>' :'') +
                            (content[i].toilet > 0 ? '<li><i class="fa fa-tint"></i><span>'+content[i].toilet+' Toilets</span></li>' : '')+
                            '<li><i class="fa fa-building"></i><span>'+content[i].protype+'</span></li>'+
                            '</ul></div></div></div>'
                        )

                    }
                    location.hash = page;

                    setpagination(currentpage, lastpage);
                }




            }).fail(function (error) {
                swal(
                    'Oops...',
                    'Something went wrong!',
                    'error'
                )
            })
        }

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href');
            $('#pagination').html('');
            $('#content-page').html('' +
                '<div class="loader-wrapper" style="margin-left: 45%; margin-top: 10%" id="loader-1">'+
                '<div id="loader"></div>'+
                '</div>');
            getcontent(page,sta );
        });

        function setpagination(cu, last) {
            var pagecon = $('#pagination');
            if(last > 1){
                pagecon.html('' +
                    '<nav aria-label="Page navigation example">'+
                    '<ul class="pagination">'+
                    '<li class="page-item '+(cu==1?'disabled':'')+'"><a class="page-link" href="'+(cu - 1)+'">Previous</a></li>'+
                    '<li class="page-item '+(cu==last?'disabled':'')+'"><a class="page-link" href="'+(cu + 1)+'">Next</a></li>'+
                    '</ul>'+
                    '</nav>');

                for(i=last; i>=1; i--){
                    $('.pagination li:eq(0)').after('<li class="page-item '+(cu==i?'active':'')+'"><a class="page-link" href="'+i+'">'+i+'</a></li>');
                }
            }
            else{

            }
        }


        $(document).on('click', function (e) {
            if($('#searchfield').is(':focus') || $('#searchbtn').is(':focus')){

            }
            else {
                $('#search-result').html('');
            }
        });
    </script>



    <!--search engine....-->
    <script>
        $('#searchfield').keyup(function (e) {
            var searchresult = $('#search-result');

            var searchcontent = $('#searchfield').val();
            if(searchcontent != ""){
                $.get('/api/searchproperty/'+searchcontent, function (data) {
                    if(data == 0){
                        searchresult.html('' +
                            '<div class="list-group" id="searchgroup" style="position: relative; z-index: 1030">'+
                            '<a class="list-group-item list-group-item-action"><i>No Record Found..</i></a>'+
                            '</div>')
                    }
                    else{

                        searchresult.html('' +
                            '<div class="list-group" id="searchgroup" style="position: relative; z-index: 1030">'+
                            '</div>');

                        for(i = 0; i<data.length; i++){
                            $('#searchgroup').append('' +
                                '<a class="list-group-item list-group-item-action" href="{{ url('viewproperty') }}'+'/'+data[i].title+'"><span style="color:red">' +
                                ''+data[i].title+'</span><small>, '+data[i].location+' </small><i>, '+data[i].city+'</i></a>' +
                                '')
                        }
                    }
                }).fail(function (error) {

                })
            }
            else{
                searchresult.html('');

            }
        })
        
        function searchproperty() {
            var searchresult = $('#search-result');
            var searchcontent = $('#searchfield').val();

            if(searchcontent == ''){
                searchresult.html('' +
                    '<div class="list-group" id="searchgroup" style="position: relative; z-index: 1030">'+
                    '<a class="list-group-item list-group-item-action"><i>Enter a search content...</i></a>'+
                    '</div>')
            }
            else{
                $('#pagination').html('');
                $('#content-page').html('' +
                    '<div class="loader-wrapper" style="margin-left: 45%; margin-top: 10%" id="loader-1">'+
                    '<div id="loader"></div>'+
                    '</div>');
                sta = searchcontent;
                getcontent(1, sta);
            }
        }
    </script>

    <!-- delete property -->
    <script>
        function remove(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    $.post('/api/deleteproperty/'+id,function (data) {
                        swal(
                            'Deleted!',
                            'Property has been deleted.',
                            'success'
                        )
                        $('#pagination').html('');
                        $('#content-page').html('' +
                            '<div class="loader-wrapper" style="margin-left: 45%; margin-top: 10%" id="loader-1">'+
                            '<div id="loader"></div>'+
                            '</div>');
                        getcontent(1, sta);
                    }).fail(function (error) {
                        swal(
                            'Oops...',
                            'Something went wrong!',
                            'error'
                        )
                    });
                }
            })
        }
    </script>

@endsection

@section('content')

    <div style="margin-top: 50px; margin-bottom: 50px">
        <div class="row">
            <div class="col-md-8"><h5 id="pagetop">View Available Properties</h5></div>
            <div class="col-md-4" style="max-height: 40px">
                <div class="input-group">
                    <input type="text"   id="searchfield" class="form-control" placeholder="Search title, locations, city..." aria-label="Search for... ">
                    <span class="input-group-btn"><button onclick="searchproperty()" id="searchbtn" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button></span>
                </div>
                <div id="search-result">

                </div>
            </div>
        </div><hr>
        <div class="row" id="content-page">

                <div class="loader-wrapper" style="margin-left: 45%; margin-top: 10%" id="loader-1">
                    <div id="loader"></div>
                </div>
        </div>


        <div id="pagination" style="margin-bottom: 100px">

        </div>
    </div>



@endsection
