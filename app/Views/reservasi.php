<style>
    /* *{
        border: 1px solid red;
    } */

    #bg-reservasi {
        position: absolute;
        top: 0;
        z-index: -5;
        width: 100%;
    }

    .page-link {
        border: none !important;
    }

    a,
    td,
    p,
    span,
    button {
        font-size: .82rem;
    }

    #section-to-print {
        position: relative;
        border-radius: 20px;
    }

    #btn-print {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    #action button {
        width: 4rem;
    }

    th,
    td {
        text-align: center;
    }
</style>
<section id="reservasi">
    <img src="/assets/img/bg-reservasi.png" id="bg-reservasi" alt="">
    <center>
        <div class="col-10 card shadow p-5" id="section-to-print">
            <div id="btn-print">
                <a href="" class="btn btn-success shadow badge-pill d-flex justify-content-center align-items-center" style="width: 10rem;" id="btn-print"><span class="iconify mr-2" data-icon="foundation:print" data-inline="false"></span>Print</a>
            </div>
            <center>
                <img src="/assets/img/logo-reservasi.png" width="200" id="logo-reservasi" alt="">
            </center>
            <div class="card px-4 mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top: none;">Invoice</th>
                            <th scope="col" style="border-top: none;">Nama Pasien</th>
                            <th scope="col" style="border-top: none;">Tanggal Reservasi</th>
                            <th scope="col" style="border-top: none;">Telephone</th>
                            <th scope="col" style="border-top: none;">Status</th>
                            <th scope="col" style="border-top: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = 1; ?>
                        <?php if (session()->get('role') == 'admin') : ?>
                            <?php foreach ($total_data as $data) : ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $data['name']; ?></td>
                                    <td><?= $data['created_at']; ?></td>
                                    <td><?= $data['phone']; ?></td>
                                    <td><?= $data['status']; ?></td>
                                    <td id="action">
                                        <button id="" class="btn btn-sm btn-success reset shadow detail" data-id="<?= $data['id']; ?>" data-name="<?= $data['name']; ?>" data-age="<?= $data['age']; ?>" data-phone="<?= $data['phone']; ?>" data-antrian="<?= $data['antrian']; ?>" data-status="<?= $data['status']; ?>" data-description="<?= $data['description']; ?>" data-address="<?= $data['address']; ?>" data-date="<?= $data['created_at']; ?>">
                                            <span class="mx-2">Detail</span>
                                        </button>

                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <span class="mx-2">|</span>

                                            <button id="" class="btn btn-sm btn-info reset shadow edit" data-id="<?= $data['id']; ?>" data-name="<?= $data['name']; ?>" data-age="<?= $data['age']; ?>" data-phone="<?= $data['phone']; ?>" data-antrian="<?= $data['antrian']; ?>" data-status="<?= $data['status']; ?>" data-description="<?= $data['description']; ?>" data-address="<?= $data['address']; ?>" data-date="<?= $data['created_at']; ?>">
                                                <span class="mx-2">Edit</span>
                                            </button>

                                            <span class="mx-2">|</span>

                                            <button onclick="deletePasien(<?= $data['id']; ?>)" class="btn btn-sm btn-danger reset shadow"><span class="mx-2">Hapus</span> </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (session()->get('role') == 'member') : ?>
                            <?php foreach ($data_pasien as $data) : ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $data['name']; ?></td>
                                    <td><?= $data['created_at']; ?></td>
                                    <td><?= $data['phone']; ?></td>
                                    <td><?= $data['status']; ?></td>
                                    <td id="action">
                                        <button id="" class="btn btn-sm btn-success reset shadow detail" data-id="<?= $data['id']; ?>" data-name="<?= $data['name']; ?>" data-age="<?= $data['age']; ?>" data-phone="<?= $data['phone']; ?>" data-antrian="<?= $data['antrian']; ?>" data-status="<?= $data['status']; ?>" data-description="<?= $data['description']; ?>" data-address="<?= $data['address']; ?>" data-date="<?= $data['created_at']; ?>">
                                            <span class="mx-2">Detail</span>
                                        </button>

                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <span class="mx-2">|</span>

                                            <button id="" class="btn btn-sm btn-info reset shadow edit" data-id="<?= $data['id']; ?>" data-name="<?= $data['name']; ?>" data-age="<?= $data['age']; ?>" data-phone="<?= $data['phone']; ?>" data-antrian="<?= $data['antrian']; ?>" data-status="<?= $data['status']; ?>" data-description="<?= $data['description']; ?>" data-address="<?= $data['address']; ?>" data-date="<?= $data['created_at']; ?>">
                                                <span class="mx-2">Edit</span>
                                            </button>

                                            <span class="mx-2">|</span>

                                            <button onclick="deletePasien(<?= $data['id']; ?>)" class="btn btn-sm btn-danger reset shadow"><span class="mx-2">Hapus</span> </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="mt-4 col-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Halaman <?= $current_page; ?> Dari <?= $total_page; ?> Halaman</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="mt-4 col-6">
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">

                            <?php if ($total_page > 1) : ?>
                                <?php if ($current_page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="http://localhost:8081/reservasi/index/<?= $current_page - 1; ?>"><span class="iconify" data-icon="dashicons:arrow-left-alt2" data-inline="false"></span></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($current_page == 1) : ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="http://localhost:8081/reservasi/index/<?= $current_page - 1; ?>" tabindex="-1" aria-disabled="true"><span class="iconify" data-icon="dashicons:arrow-left-alt2" data-inline="false"></span></a>
                                    </li>
                                <?php endif; ?>

                                <?php
                                $x = 1;
                                $y = ($total_page > 3) ? $current_page : 1;

                                if ($total_page <= 3) {
                                    $z = $total_page;
                                } else {
                                    $z = 3;
                                }

                                $max = $total_page - 3;

                                if ($total_page > 3 && ($total_page - $current_page) > $max) {
                                    $y = $current_page;
                                } else if ($total_page > 3 && ($total_page - $current_page) < $max) {
                                    $y = $max;
                                } else {
                                    $y = 1;
                                }
                                do { ?>
                                    <li class="page-item"><a class="page-link" href="http://localhost:8081/reservasi/index/<?= $y; ?>"><?= $y; ?></a></li>
                                <?php
                                    $y++;
                                    $x++;
                                } while ($x <= $z);
                                ?>

                                <?php if ($current_page < $total_page) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="http://localhost:8081/reservasi/index/<?= $current_page + 1; ?>"><span class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false"></span></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($current_page == $total_page) : ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="http://localhost:8081/reservasi/index/<?= $current_page + 1; ?>" tabindex="-1" aria-disabled="true"><span class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false"></span></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </center>
</section>


<!-- Modal Detail -->
<div class="modal fade" id="modaldetailpasien" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-pasien">
                <div class="modal-header">
                    <img src="/assets/img/logo-formpasien.png" alt="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row px-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Lengkap : </label>
                                <span id="nama_lengkap">Tedi Lesmana</span>
                            </div>
                            <div class="form-group">
                                <label>Usia : </label>
                                <span id="usia">23</span>
                            </div>
                            <div class="form-group">
                                <label>Nomor Antrian : </label>
                                <span id="antrian">23</span>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Reservasi : </label>
                                <span id="tanggal">23</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nomor Telepon : </label>
                                <span id="phone">0822-1937-8833</span>
                            </div>
                            <div class="form-group">
                                <label>Alamat : </label>
                                <span id="alamat">Jakarta Timur</span>
                            </div>
                            <div class="form-group">
                                <label>Status : </label>
                                <span id="status">Status</span>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Keluhan : </label>
                                <span id="deskripsi">deskripsi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success shadow badge-pill text-white px-5" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalformeditpasien" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formeditpasien">
                <div class="modal-header">
                    <img src="/assets/img/logo-formpasien.png" alt="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row px-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="e_nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="e_nama_lengkap" id="e_nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label for="e_usia">Usia</label>
                                <input type="number" class="form-control" name="e_usia" id="e_usia">
                            </div>
                            <div class="form-group">
                                <label for="e_antrian">No. Antrian</label>
                                <input type="number" class="form-control" name="e_antrian" id="e_antrian">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="e_phone">Nomor Telepon</label>
                                <input type="text" class="form-control" name="e_phone" id="e_phone">
                            </div>
                            <div class="form-group">
                                <label for="e_alamat">Alamat</label>
                                <input type="text" class="form-control" name="e_alamat" id="e_alamat">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="e_status" id="e_status">
                                    <option value="Waiting">Waiting</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="e_keluhan">Deskripsi Keluhan</label>
                            <textarea class="form-control" id="e_keluhan" name="e_keluhan" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow badge-pill text-white px-5" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn badge-pill bg-primary-1 shadow text-white px-5">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#btn-print").click(function() {
            $("#btn-print").hide();
            var printContents = document.getElementById('section-to-print').innerHTML;

            document.body.innerHTML = printContents;

            window.print();
        });
    });

    $(document).ready(function() {
        $("#detete").click(function() {
            console.log($(this).attr('class'));
        });
    });

    function deletePasien(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-3 w-25',
                cancelButton: 'btn btn-danger mx-3 w-25'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Anda Yakin?',
            text: "Ingin menghapus data ini!?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                var settings = {
                    "url": "http://localhost:8081/pasiens/" + id,
                    "method": "DELETE",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    window.location.href = 'http://localhost:8081/reservasi';
                });
            }
        });
    }

    $(document).ready(function() {
        function titleCase(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }
            return splitStr.join(' ');
        }

        $(".detail").click(function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            let age = $(this).attr('data-age');
            let phone = $(this).attr('data-phone');
            let antrian = $(this).attr('data-antrian');
            let description = $(this).attr('data-description');
            let status = $(this).attr('data-status');
            let address = $(this).attr('data-address');
            let date = $(this).attr('data-date');

            $("#nama_lengkap").html(titleCase(name));
            $("#usia").html(titleCase(age));
            $("#antrian").html(titleCase(antrian));
            $("#tanggal").html(titleCase(date));
            $("#phone").html(titleCase(phone));
            $("#alamat").html(titleCase(address));
            $("#status").html(titleCase(status));
            $("#deskripsi").html(titleCase(description));

            $('#modaldetailpasien').modal('show');
        });
    });

    $(document).ready(function() {
        $(".edit").click(function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            let age = $(this).attr('data-age');
            let phone = $(this).attr('data-phone');
            let antrian = $(this).attr('data-antrian');
            let description = $(this).attr('data-description');
            let status = $(this).attr('data-status');
            let address = $(this).attr('data-address');
            let date = $(this).attr('data-date');

            $("#e_nama_lengkap").val(name);
            $("#e_usia").val(age);
            $("#e_phone").val(phone);
            $("#e_alamat").val(address);
            $("#e_keluhan").val(description);
            $("#e_antrian").val(antrian);
            $("#e_status").val(status);

            $('#modalformeditpasien').modal('show');


            $("#formeditpasien").validate({
                debug: false,
                errorClass: "invalid-feedback",
                errorElementClass: 'is-invalid',
                validClass: "valid-feedback",
                validElementClass: 'is-valid',
                rules: {
                    e_nama_lengkap: {
                        required: true,
                    },
                    e_usia: {
                        required: true,
                    },
                    e_phone: {
                        required: true,
                    },
                    e_alamat: {
                        required: true,
                    },
                    e_keluhan: {
                        required: true,
                    },
                    e_antrian: {
                        required: true,
                    },
                    e_status: {
                        required: true,
                    }
                },
                onfocusout: false,
                errorElement: "span",
                wrapper: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                    error.addClass("error-validation");
                },
                success: function(label) {
                    label.text("Looks Good !").addClass('valid-feedback');
                    $('.invalid-feedback.valid-feedback').css('color', 'green');
                },
                highlight: function(element, errorClass, validClass) {
                    $('.invalid-feedback').css('color', 'red');
                    $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(this.settings.errorElementClass).removeClass(errorClass);
                    $(element).addClass(this.settings.validElementClass);
                    $(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
                },
                submitHandler: function() {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success mx-3 w-25',
                            cancelButton: 'btn btn-danger mx-3 w-25'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Anda Yakin?',
                        text: "Data yang anda isi sudah benar!?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let val_name = $("#e_nama_lengkap").val();
                            let val_age = $("#e_usia").val();
                            let val_phone = $("#e_phone").val();
                            let val_address = $("#e_alamat").val();
                            let val_description = $("#e_keluhan").val();
                            let val_antrian = $("#e_antrian").val();
                            let val_status = $("#e_status").val();

                            var settings = {
                                "url": "http://localhost:8081/pasiens/" + id,
                                "method": "PUT",
                                "timeout": 0,
                                "headers": {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                "data": {
                                    "name": val_name,
                                    "age": val_age,
                                    "phone": val_phone,
                                    "antrian": val_antrian,
                                    "description": val_description,
                                    "status": val_status,
                                    "address": val_address,
                                }
                            };

                            $.ajax(settings).done(function(response) {
                                $('#modalformeditpasien').modal('hide');
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success mx-3 w-25',
                                    },
                                    buttonsStyling: false
                                })

                                swalWithBootstrapButtons.fire({
                                    title: 'Data Berhasil di Update !',
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    },
                                    confirmButtonText: 'Ya',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'http://localhost:8081/reservasi';
                                    }
                                })
                            });
                        }
                    })
                },
            })
        });
    });
</script>