

<div class="modal-content" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title text-center" id="myModalLabel">Đơn hàng #{{ \App\Util::OrderCode($order->id) }}</h4>
    </div>
    <div class="modal-body sroll">
        <div class="row">

            <div class="tracking">
                <div class="col-sm-12 col-xs-12 fix-padlr cl-center">
                    <div class="img-car">
                    </div>
                    <ul class="ul-date-car">

                        @foreach($orderStatus as $itemOrderStatus)
                            <li class="date-past @if($itemOrderStatus->id ==$order->status) active @endif">
                                <img src="{{url('/')}}{{$itemOrderStatus->image}}" class="icon-tracking" alt="" title="{{ $itemOrderStatus->name }}">
                                <div class="clear"></div>
                                @if($itemOrderStatus->id ==$order->status)
                                    <span>{{$order->updated_at->format('d-m-Y')}}</span>
                                    <div class="fix-status">{{$itemOrderStatus->name}}</div>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-12 con-tracking ">
                    <div class="col-sm-6 col-xs-12 fix-padlr">
                        {{--<p class="text-center"><i class="ic-tracking ic-xe"></i></p>--}}
                        <h2>Thông tin đặt hàng</h2>
                        <table class="table list-order table-curved">
                            <tbody>
                            <?php $total = 0; ?>
                            @foreach($productOrder as $itemProductOrder)
                                <tr class="item-product">
                                    <th><span class="code-product">{{ $itemProductOrder->code }}</span></th>
                                    <td><span class="name-product"><span>{{$itemProductOrder->title}}(#{{ $itemProductOrder->id_product }})</span></span></td>
                                    <td><span class="price-product"><span>{{number_format($itemProductOrder->price) }}</span> VNĐ </span></td>
                                    <td><span>x </span>{{ $itemProductOrder->num }}</td>
                                    <td><span class="total"> <span>{{ number_format($itemProductOrder->price) }}</span> VNĐ</span></td>
                                </tr>
                                <?php $total=$total + $itemProductOrder->price; ?>
                            @endforeach
                            <tr>
                                <th></th>
                                <td>
                                </td>
                                <td></td>
                                <td>Tổng: </td>
                                <td><span class="total">  {{number_format($total)}} VNĐ</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="clear"></div>

                        <div class="row">
                            <div class="col-md-4">
                                Thanh toán:
                            </div>
                            <div class="col-md-8">
                                <p>
                                    @if(($order->type_pay == 1)) Đã thanh toán đầy đủ @elseif($order->type_pay == 2) Đã đặt cọc @if(!empty($order->received_pay)){{number_format($order->received_pay)}} VNĐ @endif @else Chưa thanh toán @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Vận chuyển:
                            </div>
                            <div class="col-md-8">
                                <p>@if(!empty($order->type_driver)){{$order->type_driver}}@else{{old('type_driver')}}@endif</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Thông tin tài xế:
                            </div>
                            <div class="col-md-8">
                                <p>Tên: @if(!empty($order->name_driver)){{$order->name_driver}}@else{{old('name_driver')}}@endif</p>
                                <p>SĐT: @if(!empty($order->phone_driver)){{$order->phone_driver}}@else{{old('phone_driver')}}@endif</p>
                                <p>Biển số xe: @if(!empty($order->number_license_driver)){{$order->number_license_driver}}@else{{old('number_license_driver')}}@endif</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                Ghi chú:
                            </div>
                            <div class="col-md-8">

                                <p class="note-order">@if(!empty($order->note)){{$order->note}}@else Không có ghi chú @endif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-12 fix-padlr cl-center">

                    </div>
                    <div class="col-sm-4 col-xs-12 fix-padlr">
                        {{--<p class="text-center"><i class="ic-tracking ic-co"></i></p>--}}
                        <h2>Thông tin nhận hàng</h2>
                        <table class="tracking-table">
                            <tbody>
                            <tr>
                                <td><i class="ic-tracking ic-nguoidung"></i></td>
                                <td>@if(!empty($customer->name)){{$customer->name}}@endif</td>
                            </tr>
                            <tr>
                                <td><i class="ic-tracking ic-diadiem"></i></td>
                                <td>@if(!empty($customer->address)){{$customer->address}}@endif</td>
                            </tr>
                            <tr>
                                <td><i class="ic-tracking ic-dienthoai"></i></td>
                                <td>@if(!empty($customer->phone_number)){{$customer->phone_number}}@endif</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class=" row">
                    <div class="col-md-12 details-tracking ">
                        <label class="title">Chi tiết hành trình</label>
                        <div id="demo0" class="collapse in" style="padding-left: 20px;">
                            <div class="con-details-tracking">

                            @foreach($historyOrder as $itemHistoryOrder)
                                @if($itemHistoryOrder->status==0)
                                    <div class="item">
                                        <label><span>{{$itemHistoryOrder->updated_at->format('d-m-Y H:m:s')}}</span> -- <label style="width:180px; color: #666">Khởi tạo đơn hàng </label> -- Người cập nhật: {{ $itemHistoryOrder->username }} | ID: #{{ $itemHistoryOrder->userid }}</label>
                                    </div>
                                @else
                                    <div class="item">
                                        <label><span>{{$itemHistoryOrder->updated_at->format('d-m-Y H:m:s')}}</span> -- <label style="width:180px; color: #666">{{$itemHistoryOrder->name}}</label> -- Người cập nhật: {{ $itemHistoryOrder->username }} | ID: #{{ $itemHistoryOrder->userid }}</label>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>
    <div class="modal-footer">

    </div>
</div>
<script>
    $(function(){
        $(document).on("hidden.bs.modal", ".modal:not(.local-modal)", function (e) {
            //$(e.target).removeData("bs.modal").find(".modal-content").empty().html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><span class="sr-only">Loading...</span>');
            $(this).modal('hide');
            $(e.target).removeData("bs.modal").find(".modal-content").empty();

        });

    });
</script>

