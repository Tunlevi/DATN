@extends('admin.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Đơn hàng</h2>
    </div>
{{--    <div>--}}
{{--        <form class="form-inline">--}}
{{--            <div class="form-group mb-2 mr-2">--}}
{{--                <label for="inputPassword2" class="sr-only">Tên</label>--}}
{{--                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Điện thoại ip">--}}
{{--            </div>--}}

{{--            <div class="form-group mb-2 mr-2">--}}
{{--                <label for="inputPassword2" class="sr-only">Trạng thái</label>--}}
{{--                <select name="status" id="" class="form-control">--}}
{{--                    <option value="">---</option>--}}
{{--                    @foreach($status ?? [] as $key => $item)--}}
{{--                        <option value="{{ $key }}" {{ (Request::get('status') ?? 0) == $key ? "selected" : "" }}>{{ $item['name'] }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary mb-2">Find</button>--}}
{{--        </form>--}}
{{--    </div>--}}
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Thông tin KH</th>
                <th>Tổng tiền</th>
{{--                <th>Loại đơn</th>--}}
                <th>Thanh toán</th>
                <th>Vận chuyển</th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders ?? [] as $item)
                <tr>
                    <td><a href="">#DH{{ $item->id }}</a></td>
                    <td>
                        <span>{{ $item->receiver_name }}</span> <br>
                        <span>{{ $item->receiver_phone }}</span><br>
                        <span>{{ $item->receiver_email }}</span>
                    </td>
                    <td>{{ number_format($item->total_money,0,',','.') }}đ</td>
{{--                    <td>--}}
{{--                        <span class="badge badge-{{ $item->getOrderType($item->order_type)['class'] ?? "" }}">{{ $item->getOrderType($item->order_type)['name'] ?? "" }}</span>--}}
{{--                    </td>--}}
                    <td>
                        <span class="badge badge-{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $item->getStatusShippingConfig($item->shipping_status)['class'] ?? "badge badge-light" }}">{{ $item->getStatusShippingConfig($item->shipping_status)['name'] ?? "Tạm dừng" }}</span>
                    </td>
                    <td>{{ $item->note }}</td>
                    <td>
                        <a href="{{ route('get_admin.order.update', $item->id) }}">Update</a>
                        <a href="javascript:;void(0)">|</a>
                        <a href="{{ route('get_admin.order.delete', $item->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop


{{--@extends('admin.layouts.app_backend')--}}
{{--@section('content')--}}
{{--    <style>--}}
{{--        .success {--}}
{{--            color: #155724;--}}
{{--            font-weight: bold;--}}
{{--        }--}}
{{--        .danger {--}}
{{--            color: #721c24;--}}
{{--            font-weight: bold;--}}
{{--        }--}}
{{--        .default {color: #383d41; font-weight: bold}--}}
{{--        .warning {color: #856404; font-weight: bold}--}}
{{--    </style>--}}
{{--    <div class="col-lg-11">--}}
{{--        <section class="py-4 py-lg-5">--}}
{{--            <h3 class="display-5 mb-3">Đơn hàng</h3>--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane fade show active" role="tabpanel" id="profile">--}}
{{--                            <!--end of avatar-->--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table">--}}
{{--                                    <tr>--}}
{{--                                        <th scope="col">#</th>--}}
{{--                                        <th scope="col">Người nhận</th>--}}
{{--                                        <th scope="col">Tổng tiền</th>--}}
{{--                                        <th scope="col">Số SP</th>--}}
{{--                                        <th scope="col">Ghi chú</th>--}}
{{--                                        <th scope="col">Thanh toán</th>--}}
{{--                                        <th scope="col">Vận chuyển</th>--}}
{{--                                        <th scope="col">Action</th>--}}
{{--                                    </tr>--}}
{{--                                    @foreach($orders ?? [] as $item)--}}
{{--                                        <tr>--}}
{{--                                            <th scope="row">{{ $item->id }}</th>--}}
{{--                                            <td>--}}
{{--                                                <ul>--}}
{{--                                                    <li>{{ $item->receiver_name }}</li>--}}
{{--                                                    <li>{{ $item->receiver_phone }}</li>--}}
{{--                                                    <li>{{ $item->receiver_address }}</li>--}}
{{--                                                </ul>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                {{ number_format($item->total_money,0,',','.') }} đ--}}
{{--                                                @if($item->discount)--}}
{{--                                                    <br>--}}
{{--                                                    <span>- {{ number_format($item->discount,0,',','.') }} đ</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>{{ $item->transactions_count }} SP</td>--}}
{{--                                            <td>{{ $item->note }}</td>--}}
{{--                                            <td>--}}
{{--                                                <span class="{{ $item->getStatus($item->status)['class'] ?? "" }}">{{ $item->getStatus($item->status)['name'] ?? "" }}</span>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <span class="{{ $item->getStatusShippingConfig($item->shipping_status)['class'] ?? "" }}">{{ $item->getStatusShippingConfig($item->shipping_status)['name'] ?? "" }}</span>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('get_admin.order.update', $item->id) }}">Cập nhật</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@stop--}}
