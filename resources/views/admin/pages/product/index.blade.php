@extends('admin.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Sản phẩm</h2>
        <a href="{{ route('get_admin.product.create') }}">Thêm mới</a>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Điện thoại ip">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Find</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products ?? [] as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <a href="" style="display: inline-block;position: relative">
                            <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px" alt="">
                        </a>
                    </td>
                    <td>
                        {{ $item->name }} <br>
                    </td>
                    <td>{{ $item->category->name ?? "[N\A]" }}</td>
                    <td>{{ number_format($item->price,0,',','.') }}đ</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ route('get_admin.product.update', $item->id) }}">Edit</a>
{{--                        <a href="javascript:;void(0)">|</a>--}}
{{--                        <a href="{{ route('get_admin.product.delete', $item->id) }}">Delete</a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
{{--    --}}
{{--    <div class="col-lg-11 col-xl-9">--}}
{{--        <section class="py-4 py-lg-5">--}}
{{--            <h3 class="display-5 mb-3">Sản phẩm</h3>--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane fade show active" role="tabpanel" id="profile">--}}
{{--                            <div class="media mb-4">--}}
{{--                                <a href="{{ route('get_admin.product.create') }}" class="btn btn-secondary">Thêm mới</a>--}}
{{--                            </div>--}}
{{--                            <!--end of avatar-->--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table">--}}
{{--                                    <tr>--}}
{{--                                        <th scope="col">#</th>--}}
{{--                                        <th scope="col">Mame</th>--}}
{{--                                        <th scope="col">Slug</th>--}}
{{--                                        <th scope="col">Price</th>--}}
{{--                                        <th scope="col">Avatar</th>--}}
{{--                                        <th scope="col">Action</th>--}}
{{--                                    </tr>--}}
{{--                                    @foreach($products ?? [] as $item)--}}
{{--                                        <tr>--}}
{{--                                            <th scope="row">{{ $item->id }}</th>--}}
{{--                                            <td>{{ $item->name }}</td>--}}
{{--                                            <td>{{ $item->slug }}</td>--}}
{{--                                            <td>{{ number_format($item->price,0,',','.') }} đ</td>--}}
{{--                                            <td>--}}
{{--                                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 40px;height: 40px" alt="">--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('get_admin.product.update', $item->id) }}" class="text-info">Edit</a>--}}
{{--                                                <a href="" class="text-danger">Delete</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                </table>--}}
{{--                                <div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-2 mt-sm-2">--}}
{{--                                    <!-- Content -->--}}
{{--                                    <p class="mb-sm-0 text-center text-sm-start">--}}
{{--                                        Hiển thị: {{ $products->firstItem() }} to {{ $products->lastItem() }} /--}}
{{--                                        Tổng {{ $products->total() }} record &nbsp;--}}
{{--                                    </p>--}}
{{--                                    <nav class="my-5" aria-label="navigation">--}}
{{--                                        {!! $products->appends($query ?? [])->links('pagination.customer') !!}--}}
{{--                                    </nav>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
@stop
