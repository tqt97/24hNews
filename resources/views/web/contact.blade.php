@extends('layouts.web')

@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Liên hệ</h4>
                            <h2>Gửi tin nhắn đến chúng tôi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="sidebar-item contact-form">
                                    <div class="sidebar-heading">
                                        <h2>Mẫu liên hệ</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact" action="{{ route('contact.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            value="{{ old('name') }}" placeholder="Nhập tên người dùng">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" name="phone"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ old('email') }}" placeholder="Nhập email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">

                                                        <input type="text" name="subject"
                                                            class="form-control @error('subject') is-invalid @enderror"
                                                            value="{{ old('subject') }}" placeholder="Nhập chủ đề">
                                                        @error('subject')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <textarea name="message"
                                                            class="form-control @error('message') is-invalid @enderror" id="message"
                                                             rows="5" placeholder="Nhập nội dụng">{{ old('message') }}</textarea>
                                                        @error('message')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="submit" id="form-submit"
                                                            class="main-button">Gửi</button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sidebar-item contact-information">
                                    <div class="sidebar-heading">
                                        <h2>Thông tin liên hệ</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li>
                                                <span>Điện thoại</span>
                                                <h5>+37 546 8299</h5>
                                            </li>
                                            <li>
                                                <span>Email</span>
                                                <h5>quoctuanit2018@gmail.com</h5>
                                            </li>
                                            <li>
                                                <span>Địa chỉ</span>
                                                <h5>Lê Đức Thọ, Gò Vấp, TP Hồ Chí Minh </h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
