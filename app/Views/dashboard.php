<style>
  #bg-home {
    position: absolute;
    top: 0;
    z-index: -5;
  }

  #bubble {
    position: absolute;
  }

  .first-circle {
    width: 24rem;
    height: 24rem;
    border-radius: 50%;
    background-image: url('/assets/img/circle.png');
    background-size: cover;
  }

  .second-circle {
    width: 12rem;
    height: 12rem;
    border-radius: 50%;
    position: absolute;

  }
</style>

<section id="home">
  <img src="/assets/img/building.png" id="bg-home" alt="">
  <div class="row reset">
    <div class="col-6"></div>
    <div class="col-6 p-5">
      <img src="/assets/img/bubble.png" id="bubble" alt="">

      <?php if (session()->get('role') == 'member') : ?>
        <div class="second-circle bg-primary-2 d-flex justify-content-center align-items-center flex-column shadow">
          <h1 class="text-white" id="antrianku">0</h1>
          <span class="text-white font-weight-bold">Nomor Antrian Kamu</span>
          <small class="text-white font-weight-bold" id="tanggal_antrian">00/00/00</small>
        </div>
      <?php endif; ?>

      <?php if (session()->get('role') == 'admin') : ?>
        <div class="second-circle bg-primary-2 d-flex justify-content-center align-items-center flex-column shadow">
          <h1 class="text-white" id="countAdmin">0</h1>
          <span class="text-white font-weight-bold">Antrian Saat Ini</span>
        </div>
      <?php endif; ?>

      <center>
        <br><br>
        <div class="first-circle d-flex justify-content-center align-items-center flex-column shadow">
          <div>
            <span class="text-white" style="font-size: 5rem;" id="now_antrian">0</span>
            <span class="text-white" style="font-size: 5rem;">/</span>
            <span class="text-white" style="font-size: 5rem;" id="all_antrian">0</span>
          </div>
          <span class="text-white font-weight-bold">Antrian Berjalan</span>
        </div>
        <br><br><br>
        <input type="number" name="count_antrian" value="0" id="count_antrian" hidden>
        <input type="number" name="antrian" value="0" id="antrian" hidden>
        <!-- <button class="btn badge-pill w-75 bg-primary-1 text-white font-weight-bold shadow" id="ambil">AMBIL ANTRIAN</button> -->
        <!-- Button trigger modal -->

        <?php if (session()->get('role') == 'member') : ?>
          <button type="button" class="btn badge-pill w-75 bg-primary-1 text-white font-weight-bold shadow" data-toggle="modal" data-target="#modalformpasien">
            BOOKING
          </button>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin') : ?>
          <button class="btn badge-pill w-75 bg-info text-white font-weight-bold shadow" id="count">ANTRIAN SELANJUTNYA</button>
          <button class="btn badge-pill w-75 bg-danger text-white font-weight-bold shadow mt-4" id="reset">RESET ANTRIAN</button>
        <?php endif; ?>

      </center>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalformpasien" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
              </div>
              <div class="form-group">
                <label for="usia">Usia</label>
                <input type="number" class="form-control" name="usia" id="usia">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" class="form-control" name="phone" id="phone">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat">
              </div>
            </div>
            <div class="form-group col-12">
              <label for="keluhan">Deskripsi Keluhan</label>
              <textarea class="form-control" id="keluhan" name="keluhan" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary shadow badge-pill text-white px-5" data-dismiss="modal">Close</button>
          <button type="submit" class="btn badge-pill bg-primary-1 shadow text-white px-5">Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var settings = {
      "url": "http://localhost:8081/antrian",
      "method": "GET",
      "timeout": 0,
    };

    $.ajax(settings).done(function(response) {
      if (!response.length == 0) {
        let current_antrian = response[0].current_antrian;
        let total_antrian = response[0].total_antrian;

        $('#now_antrian').html(current_antrian);
        $('#countAdmin').html(current_antrian);
        $('#all_antrian').html(total_antrian);
        $('#count_antrian').val(current_antrian);
        $('#antrian').val(total_antrian);

        if (parseInt(current_antrian) >= parseInt(total_antrian)) {
          $('#count').css('display', 'none');
        } else {
          $('#count').css('display', 'block');
        }
      }
    });


    var configCurrentPasien = {
      "url": "http://localhost:8081/report/get_current_report_pasien/<?= session()->get('id'); ?>",
      "method": "GET",
      "timeout": 0,
    };

    $.ajax(configCurrentPasien).done(function(response) {
      let currentAntrian = response.data.antrian;
      let date = response.data.created_at;
      $('#antrianku').html(currentAntrian);
      $('#tanggal_antrian').html(date);
    });
  });

  $(function() {
    var conn = new WebSocket('ws://localhost:8088?access_token=<?= session()->get('id') ?>');
    conn.onopen = function(e) {
      console.log("Connection established!");
    };

    conn.onmessage = function(e) {
      var data = JSON.parse(e.data)

      if ('message' in data) {
        antrianBaru(data)
      }

    };


    $("#form-pasien").validate({
      debug: false,
      errorClass: "invalid-feedback",
      errorElementClass: 'is-invalid',
      validClass: "valid-feedback",
      validElementClass: 'is-valid',
      rules: {
        nama_lengkap: {
          required: true,
        },
        usia: {
          required: true,
        },
        phone: {
          required: true,
        },
        alamat: {
          required: true,
        },
        keluhan: {
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
            var antrian = $('#antrian').val();
            if (antrian == '') {
              antrian = 1;
            } else {
              antrian++;
            }
            conn.send(antrian)
            antrianKu(antrian);
            $('#antrian').val(antrian);

            var user_id = <?= session()->get('id'); ?>;
            var nama_lengkap = $('#nama_lengkap').val();
            var usia = $('#usia').val();
            var phone = $('#phone').val();
            var alamat = $('#alamat').val();
            var keluhan = $('#keluhan').val();
            var count_antrian = $('#count_antrian').val();

            var formPasien = new FormData();
            formPasien.append("user_id", user_id);
            formPasien.append("name", nama_lengkap);
            formPasien.append("age", usia);
            formPasien.append("phone", phone);
            formPasien.append("antrian", antrian);
            formPasien.append("description", keluhan);
            formPasien.append("address", alamat);

            var configPasien = {
              "url": "http://localhost:8081/pasiens",
              "method": "POST",
              "processData": false,
              "mimeType": "multipart/form-data",
              "contentType": false,
              "data": formPasien
            };

            $.ajax(configPasien).done(function(response) {
              if (antrian > 1) {

                var settings = {
                  "url": "http://localhost:8081/antrian",
                  "method": "GET",
                  "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                  console.log('any data');
                  console.log(response);
                  var idAntrian = response[0].id;
                  var settings = {
                    "url": "http://localhost:8081/antrian/" + idAntrian,
                    "method": "PUT",
                    "timeout": 0,
                    "headers": {
                      "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": {
                      "current_antrian": count_antrian,
                      "total_antrian": antrian
                    }
                  };

                  $.ajax(settings).done(function(response) {
                    $('#modalformpasien').modal('hide');

                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success mx-3 w-25',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Nomor antrian anda telah berhasil di buat !',
                      icon: 'success',
                      confirmButtonText: 'Ya',
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    })
                  });
                });
              } else {
                console.log('no data');
                var formAntrian = new FormData();
                formAntrian.append("current_antrian", count_antrian);
                formAntrian.append("total_antrian", antrian);

                var settings = {
                  "url": "http://localhost:8081/antrian",
                  "method": "POST",
                  "timeout": 0,
                  "processData": false,
                  "mimeType": "multipart/form-data",
                  "contentType": false,
                  "data": formAntrian
                };

                $.ajax(settings).done(function(response) {
                  $('#modalformpasien').modal('hide');

                  const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success mx-3 w-25',
                    },
                    buttonsStyling: false
                  })

                  swalWithBootstrapButtons.fire({
                    title: 'Nomor antrian anda telah berhasil di buat !',
                    icon: 'success',
                    confirmButtonText: 'Ya',
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  })
                });
              }
              $('#all_antrian').html(antrian);
              $('#count').css('display', 'block');
            });
          }
        })
      },
    });

    $('#reset').on('click', function() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-3 w-25',
          cancelButton: 'btn btn-danger mx-3 w-25'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Anda Yakin?',
        text: "Ingin mereset data nomor antrian!?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          var antrian = 0;
          conn.send(antrian)
          antrianKu(antrian);
          $('#antrian').val(antrian);
          $('#count-antrian').val(antrian);
          $('#count').css('display', 'block');

          var settings = {
            "url": "http://localhost:8081/antrian",
            "method": "GET",
            "timeout": 0,
          };

          $.ajax(settings).done(function(response) {
            var idAntrian = response[0].id;

            var settings = {
              "url": "http://localhost:8081/antrian/" + idAntrian,
              "method": "DELETE",
              "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
              $('#modalformpasien').modal('hide');

              const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success mx-3 w-25',
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Nomor antrian anda telah berhasil di reset !',
                icon: 'success',
                confirmButtonText: 'Ya',
                showClass: {
                  popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                }
              })

              $('#now_antrian').html(0);
              $('#all_antrian').html(0);
              $('#countAdmin').html(0);
              $('#count_antrian').val(0);
              $('#antrian').val(0);

            });
          });

          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success mx-3 w-25',
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Nomor antrian telah berhasil di reset',
            icon: 'success',
            confirmButtonText: 'Ya',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
          })
        }
      })
    })

    $('#count').on('click', function() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-3 w-25',
          cancelButton: 'btn btn-danger mx-3 w-25'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Anda Yakin?',
        text: "Ingin memanggil nomor antrian berikutnya!?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          var count_antrian = $('#count_antrian').val();
          if (count_antrian == '') {
            count_antrian = 1;
          } else {
            count_antrian++;
          }
          conn.send(count_antrian)
          antrianBerikutnya(count_antrian);
          $('#count_antrian').val(count_antrian);

          var antrian = $('#antrian').val();

          var settings = {
            "url": "http://localhost:8081/antrian",
            "method": "GET",
            "timeout": 0,
          };

          $.ajax(settings).done(function(response) {
            console.log('antrian' + antrian);
            console.log('count antrian' + count_antrian);
            $('#now_antrian').html(count_antrian);
            $('#countAdmin').html(count_antrian);
            var idAntrian = response[0].id;
            var settings = {
              "url": "http://localhost:8081/antrian/" + idAntrian,
              "method": "PUT",
              "timeout": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              "data": {
                "current_antrian": count_antrian,
                "total_antrian": antrian
              }
            };

            $.ajax(settings).done(function(response) {

              const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success mx-3 w-25',
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'On Proses',
                html: '<h1 style="font-size: 12rem;">' + count_antrian + '</h1>',
                confirmButtonText: 'Confirm',
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                }
              })

              $('#modalformpasien').modal('hide');
            });
          });
        }
      })
    })
  })

  function antrianBaru(antrian) {
    console.log('antrian baru');
    console.log(antrian.author);
    console.log(antrian);
    html = antrian.message;
    $('#nomor').html(html);
    $('#antrian').val(antrian.message);
    $('#count').css('display', 'block');

    if (parseInt(antrian.message) == 0) {
      $('#all_antrian').html(antrian.message);
    }

    if (antrian.author == 'admin') {
      $('#now_antrian').html(antrian.message);
    } else {
      $('#all_antrian').html(antrian.message);
    }
  }

  function antrianKu(antrian) {
    console.log('antrianku');
    html = antrian;
    $('#nomor').html(html);
    $('#antrianku').html(antrian);
  }

  function antrianBerikutnya(antrian) {
    console.log('antrian berikutnya');
    if (antrian >= $('#antrian').val()) {
      $('#count').css('display', 'none');
    }
  }
</script>