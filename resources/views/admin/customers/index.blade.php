@extends('layouts.admin')
@section('title', 'Danh sách Khách hàng ')
@section('pageHeader','Danh sách khách hàng ')
@section('detailHeader','danh sách')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <ul class="pagination pagination-split">
                                <li><a href="#">A</a></li>
                                <li><a href="#">B</a></li>
                                <li><a href="#">C</a></li>
                                <li><a href="#">D</a></li>
                                <li><a href="#">E</a></li>
                                <li>...</li>
                                <li><a href="#">W</a></li>
                                <li><a href="#">X</a></li>
                                <li><a href="#">Y</a></li>
                                <li><a href="#">Z</a></li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>

                        @for($i=0;$i<10;$i++)
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief"><i>Công Ty A</i></h4>

                                        <div class="left col-xs-7">
                                            <h2>Nguyễn Văn A</h2>

                                            <p><strong>Kinh doanh: </strong> đậu nành, cà rốt </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Địa chỉ:</li>
                                                <li><i class="fa fa-phone"></i> Số điện thoại #:</li>
                                            </ul>
                                        </div>
                                        <div class="right col-xs-5 text-center">
                                            <img src="{{url('/')}}/images/icon.png" alt=""
                                                 class="img-circle img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 bottom text-center">
                                        <div class="col-xs-12 col-sm-6 emphasis">
                                            <p class="ratings">
                                                <a>4.0</a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                            </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 emphasis">

                                            <button type="button" class="btn btn-primary btn-xs">
                                                <i class="fa fa-user"> </i> View Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection