@extends('layouts.layout')
@section('title','Edit Profile')
@section('content')
<div class="middle-content container-xxl p-0 mb-4">
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <div class="account-settings-container layout-top-spacing">
        @include('layouts.includes.components.alert')
        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Settings</h2>
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                id="animated-underline-home-tab"
                                data-bs-toggle="tab"
                                href="#animated-underline-home" role="tab"
                                aria-controls="animated-underline-home"
                                aria-selected="true"><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-home">
                                    <path
                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                    </path>
                                    <polyline points="9 22 9 12 15 12 15 22">
                                    </polyline>
                                </svg> Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                id="animated-underline-password-tab"
                                data-bs-toggle="tab"
                                href="#animated-underline-password" role="tab"
                                aria-controls="animated-underline-password"
                                aria-selected="false" tabindex="-1"> <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11"
                                        rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg> Password </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <!-- <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> Payment Details</button> -->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active"
                    id="animated-underline-home" role="tabpanel"
                    aria-labelledby="animated-underline-home-tab">
                    <div class="row">
                        <div
                            class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form method="POST" action="/patient/update-profile"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="info">
                                    <h6 class="">General Information</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div
                                                    class="col-xl-4 col-lg-12 col-md-4">
                                                    <div
                                                        class="col-12 text-center myborder2">
                                                        <?php
                                                                                $url='/src/assets/img/default_pic.webp';
                                                                                if($data->profile_pic!=null){
                                                                                  $url=$data->profile_pic;
                                                                                }
                                                                              ?>
                                                        <label for="screen_shot"
                                                            class="drop-container">
                                                            <img id="myimage"
                                                                src="<?=$url?>"
                                                                alt="your image" />
                                                            <div
                                                                class="upload-wrapper">
                                                                <input
                                                                    type="file"
                                                                    name="file"
                                                                    id="imgInp"
                                                                    class="form-control"
                                                                    accept="image/*">
                                                                <label
                                                                    for="imgInp"
                                                                    id="uploadLabel">Upload
                                                                    picture</label>
                                                            </div>
                                                            <div
                                                                id="progress-text">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-xl-8 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="fullName">Full
                                                                        Name</label>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control mb-3"
                                                                        name="name"
                                                                        value="{{$data->name}}"
                                                                        id="fullName"
                                                                        placeholder="Full Name"
                                                                        value="Jimmy Turner">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="profession">DOB</label>
                                                                    <input
                                                                        type="date"
                                                                        class="form-control mb-3"
                                                                        name="dob"
                                                                        value="{{$data->dob}}"
                                                                        id="dob"
                                                                        placeholder="DOB">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="phone">Phone</label>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control mb-3"
                                                                        name="phone"
                                                                        value="{{$data->phone}}"
                                                                        id="phone"
                                                                        placeholder="Write your phone number here"
                                                                        value="+1 (530) 555-12121">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="email">Email</label>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control mb-3 text-dark bg-light"
                                                                        readonly
                                                                        value="{{$data->email}}"
                                                                        id="email"
                                                                        placeholder="Write your email here"
                                                                        value="Jimmy@gmail.com">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="website1">Password</label>
                                                                                    <input type="text" class="form-control mb-3"  name="password" value="" id="website1" placeholder="Password">
                                                                                </div>
                                                                            </div>                                      -->
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="website1">City</label>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control mb-3"
                                                                        name="city"
                                                                        value="{{$data->city}}"
                                                                        id="website1"
                                                                        placeholder="City">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-6">
                                                                <div
                                                                    class="form-group">
                                                                    <label
                                                                        for="website1">Gender</label>
                                                                    <select
                                                                        name="gender"
                                                                        class="form-control"
                                                                        id="">
                                                                        <option
                                                                            value="">
                                                                            Choose
                                                                        </option>
                                                                        <option
                                                                            value="Male"
                                                                            <?php if($data->gender=='Male'){ echo 'selected';}?>>
                                                                            Male
                                                                        </option>
                                                                        <option
                                                                            value="Female"
                                                                            <?php if($data->gender=='Female'){ echo 'selected';}?>>
                                                                            Female
                                                                        </option>
                                                                        <option
                                                                            value="Other"
                                                                            <?php if($data->gender=='Other'){ echo 'selected';}?>>
                                                                            Other
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-12 mt-1">
                                                                <div
                                                                    class="form-group text-end">
                                                                    <input
                                                                        type="hidden"
                                                                        name="id"
                                                                        value="{{$data->id}}"
                                                                        id="">
                                                                    <button
                                                                        class="btn btn-secondary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ////////////////////////////////////////////////  Password -->
                <div class="tab-pane fade show  mb-4"
                    id="animated-underline-password" role="tabpanel"
                    aria-labelledby="animated-underline-password-tab">
                    <div class="row">
                        <div
                            class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form method="POST"
                                action="/patient/update-password"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="info">
                                    <h6 class="m-3 p-3">Update Password</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="website1">Old
                                                            Password</label>
                                                        <input type="password"
                                                            class="form-control mb-3"
                                                            required
                                                            name="old_password"
                                                            value=""
                                                            id="website1"
                                                            placeholder="Old Password">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="website1">New
                                                            Password</label>
                                                        <input type="password"
                                                            class="form-control mb-3"
                                                            required
                                                            name="new_password"
                                                            value=""
                                                            id="website1"
                                                            placeholder="New Password">
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1 mb-4">
                                                    <div
                                                        class="form-group text-end">
                                                        <input type="hidden"
                                                            name="id"
                                                            value="{{$data->id}}"
                                                            id="">
                                                        <button
                                                            class="btn btn-secondary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Profile End AND Payment Start -->
                <div class="tab-pane fade" id="animated-underline-profile"
                    role="tabpanel"
                    aria-labelledby="animated-underline-profile-tab">
                    <div class="row">
                        <div
                            class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info payment-info">
                                <div class="info">
                                    <h6 class="">Add Payment Method</h6>
                                    <p>Changes your New <span
                                            class="text-success">Payment
                                            Method</span> Information.</p>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Card
                                                    Brand</label>
                                                <div
                                                    class="invoice-action-currency">
                                                    <div
                                                        class="dropdown selectable-dropdown cardName-select">
                                                        <a id="cardBrandDropdown"
                                                            href="javascript:void(0);"
                                                            class="dropdown-toggle"
                                                            data-bs-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false"><img
                                                                src="../src/assets/img/card-mastercard.svg"
                                                                class="flag-width"
                                                                alt="flag">
                                                            <span
                                                                class="selectable-text">Mastercard</span>
                                                            <span
                                                                class="selectable-arrow"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="feather feather-chevron-down">
                                                                    <polyline
                                                                        points="6 9 12 15 18 9">
                                                                    </polyline>
                                                                </svg></span></a>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="cardBrandDropdown">
                                                            <a class="dropdown-item"
                                                                data-img-value="../src/assets/img/card-mastercard.svg"
                                                                data-value="GBP - British Pound"
                                                                href="javascript:void(0);"><img
                                                                    src="../src/assets/img/card-mastercard.svg"
                                                                    class="flag-width"
                                                                    alt="flag">
                                                                Mastercard</a>
                                                            <a class="dropdown-item"
                                                                data-img-value="../src/assets/img/card-americanexpress.svg"
                                                                data-value="IDR - Indonesian Rupiah"
                                                                href="javascript:void(0);"><img
                                                                    src="../src/assets/img/card-americanexpress.svg"
                                                                    class="flag-width"
                                                                    alt="flag">
                                                                American
                                                                Express</a>
                                                            <a class="dropdown-item"
                                                                data-img-value="../src/assets/img/card-visa.svg"
                                                                data-value="USD - US Dollar"
                                                                href="javascript:void(0);"><img
                                                                    src="../src/assets/img/card-visa.svg"
                                                                    class="flag-width"
                                                                    alt="flag">
                                                                Visa</a>
                                                            <a class="dropdown-item"
                                                                data-img-value="../src/assets/img/card-discover.svg"
                                                                data-value="INR - Indian Rupee"
                                                                href="javascript:void(0);"><img
                                                                    src="../src/assets/img/card-discover.svg"
                                                                    class="flag-width"
                                                                    alt="flag">
                                                                Discover</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Card
                                                    Number</label>
                                                <input type="text"
                                                    class="form-control add-payment-method-input">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Holder
                                                    Name</label>
                                                <input type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label">CVV/CVV2</label>
                                                <input type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Card
                                                    Expiry</label>
                                                <input type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        class="btn btn-primary mt-4">Add</button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info payment-info">
                                <div class="info">
                                    <h6 class="">Payment Method</h6>
                                    <p>Changes to your <span
                                            class="text-success">Payment
                                            Method</span> information will take
                                        effect starting with scheduled payment
                                        and will be refelected on your next
                                        invoice.</p>
                                    <div class="list-group mt-4">
                                        <label class="list-group-item">
                                            <div class="d-flex w-100">
                                                <div class="billing-radio me-2">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="paymentMethod"
                                                            id="paymentMethod1">
                                                    </div>
                                                </div>
                                                <div class="payment-card">
                                                    <img src="../src/assets/img/card-mastercard.svg"
                                                        class="align-self-center me-3"
                                                        alt="americanexpress">
                                                </div>
                                                <div class="billing-content">
                                                    <div class="fw-bold">
                                                        Mastercard</div>
                                                    <p>XXXX XXXX XXXX 9704</p>
                                                </div>
                                                <div
                                                    class="billing-edit align-self-center ms-auto">
                                                    <button
                                                        class="btn btn-dark">Edit</button>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="list-group-item">
                                            <div class="d-flex w-100">
                                                <div class="billing-radio me-2">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="paymentMethod"
                                                            id="paymentMethod2"
                                                            checked>
                                                    </div>
                                                </div>
                                                <div class="payment-card">
                                                    <img src="../src/assets/img/card-americanexpress.svg"
                                                        class="align-self-center me-3"
                                                        alt="americanexpress">
                                                </div>
                                                <div class="billing-content">
                                                    <div class="fw-bold">
                                                        American Express</div>
                                                    <p>XXXX XXXX XXXX 310</p>
                                                </div>
                                                <div
                                                    class="billing-edit align-self-center ms-auto">
                                                    <button
                                                        class="btn btn-dark">Edit</button>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="list-group-item">
                                            <div class="d-flex w-100">
                                                <div class="billing-radio me-2">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="paymentMethod"
                                                            id="paymentMethod3">
                                                    </div>
                                                </div>
                                                <div class="payment-card">
                                                    <img src="../src/assets/img/card-visa.svg"
                                                        class="align-self-center me-3"
                                                        alt="americanexpress">
                                                </div>
                                                <div class="billing-content">
                                                    <div class="fw-bold">Visa
                                                    </div>
                                                    <p>XXXX XXXX XXXX 5264</p>
                                                </div>
                                                <div
                                                    class="billing-edit align-self-center ms-auto">
                                                    <button
                                                        class="btn btn-dark">Edit</button>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <button
                                        class="btn btn-secondary mt-4 add-payment">Add
                                        Payment Method</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-preferences"
                    role="tabpanel"
                    aria-labelledby="animated-underline-preferences-tab">
                    <div class="row">
                        <div
                            class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Choose Theme</h6>
                                    <div
                                        class="d-sm-flex justify-content-around">
                                        <div
                                            class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="flexRadioDefault"
                                                id="flexRadioDefault1" checked>
                                            <label class="form-check-label"
                                                for="flexRadioDefault1">
                                                <img class="ms-3" width="100"
                                                    height="68"
                                                    alt="settings-dark"
                                                    src="../src/assets/img/settings-light.svg">
                                            </label>
                                        </div>
                                        <div
                                            class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="flexRadioDefault"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label"
                                                for="flexRadioDefault2">
                                                <img class="ms-3" width="100"
                                                    height="68"
                                                    alt="settings-light"
                                                    src="../src/assets/img/settings-dark.svg">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Activity data</h6>
                                    <p>Download your Summary, Task and Payment
                                        History Data</p>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary">Download
                                            Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Public Profile</h6>
                                    <p>Your <span
                                            class="text-success">Profile</span>
                                        will be visible to anyone on the
                                        network.</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="publicProfile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Show my email</h6>
                                    <p>Your <span
                                            class="text-success">Email</span>
                                        will be visible to anyone on the
                                        network.</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="showMyEmail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Enable keyboard shortcuts</h6>
                                    <p>When enabled, press <code
                                            class="text-success">ctrl</code> for
                                        help</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="EnableKeyboardShortcut">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Hide left navigation</h6>
                                    <p>Sidebar will be <span
                                            class="text-success">hidden</span>
                                        by default</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="hideLeftNavigation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Advertisements</h6>
                                    <p>Display <span
                                            class="text-success">Ads</span> on
                                        your dashboard</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="advertisements">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Social Profile</h6>
                                    <p>Enable your <span
                                            class="text-success">social</span>
                                        profiles on this network</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="socialprofile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-contact"
                    role="tabpanel"
                    aria-labelledby="animated-underline-contact-tab">
                    <div class="alert alert-arrow-right alert-icon-right alert-light-warning alert-dismissible fade show mb-4"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-alert-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12" y2="16"></line>
                        </svg>
                        <strong>Warning!</strong> Please proceed with caution.
                        For any assistance - <a
                            href="javascript:void(0);">Contact Us</a>
                    </div>
                    <div class="row">
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Purge Cache</h6>
                                    <p>Remove the active resource from the cache
                                        without waiting for the predetermined
                                        cache expiry time.</p>
                                    <div class="form-group mt-4">
                                        <button
                                            class="btn btn-secondary btn-clear-purge">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Deactivate Account</h6>
                                    <p>You will not be able to receive messages,
                                        notifications for up to 24 hours.</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-success mt-1">
                                            <input class="switch-input"
                                                type="checkbox" role="switch"
                                                id="socialformprofile-custom-switch-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Delete Account</h6>
                                    <p>Once you delete the account, there is no
                                        going back. Please be certain.</p>
                                    <div class="form-group mt-4">
                                        <button
                                            class="btn btn-danger btn-delete-account">Delete
                                            my account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection