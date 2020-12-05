<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <title>Chat</title>
</head>

<style>
    /* * {
        border: 1px solid red;
    } */

    .size-small {
        font-size: .7rem;
    }

    .size-0 {
        font-size: .9rem;
    }

    .size-1 {
        font-size: 1.2rem;
    }

    .list-none {
        list-style: none;
    }

    label {
        font-size: .8rem;
    }

    .bg-page {
        background-color: #EDFFE4;
    }

    .bg-primary-1 {
        background-color: #4CBA51;
    }

    .bg-primary-2 {
        background-color: #C394FF;
    }

    .color-primary {
        color: #155D18;
    }

    .color-primary-1 {
        color: #4CBA51;
    }

    .reset {
        margin: 0px !important;
        padding: 0px !important;
    }

    .shadow {
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
    }
</style>

<body class="bg-page">
    <nav class="col-12 reset container">
        <div class="row reset">
            <div class="col-6 reset" id="logo">
                <img src="/assets/img/logo.png" alt="">
            </div>
            <div class="col-6 p-5">
                <?php if (session()->get('role')) : ?>
                    <ul class="d-flex justify-content-end">
                        <li class="list-none d-flex justify-content-center align-items-center">
                            <a href="/dashboard" class="color-primary size-0 ml-4 font-weight-bold d-flex justify-content-end align-items-center"><span class="iconify size-1 mr-2" data-icon="fa:home"></span><span class="mt-1">Home</span></a>
                        </li>
                        <li class="list-none d-flex justify-content-center align-items-center">
                            <a href="/reservasi" class="color-primary size-0 ml-4 font-weight-bold d-flex justify-content-end align-items-center"><span class="iconify size-1 mr-2" data-icon="tabler:brand-booking" data-inline="false"></span><span class="mt-1">Reservasi</span></a>
                        </li>
                        <li class="list-none nav-item dropdown">
                            <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" class="color-primary size-0 ml-4 font-weight-bold d-flex justify-content-end align-items-center nav-link dropdown-toggle"><span class="iconify size-1 mr-2" data-icon="carbon:user-avatar-filled" data-inline="false"></span><span class="mt-1">Hallo, <?= session()->get('firstname') ?></span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/profile">Update Profile</a>
                                <a class="dropdown-item" href="/logout">LogOut</a>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>