@extends('admin.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thêm mới</h2>
        <a href="{{ route('get_admin.product.index') }}">Trở về</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('admin.pages.product.form_v2')
        </div>
    </div>
@stop

