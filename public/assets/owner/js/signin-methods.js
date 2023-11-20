"use strict";
var KTAccountSettingsSigninMethods = {
    init: function () {
        var t, e;
        !(function () {
            var t = document.getElementById("kt_signin_email");
            if (t) {
                var e = document.getElementById("kt_signin_email_edit"),
                    n = document.getElementById("kt_signin_password"),
                    o = document.getElementById("kt_signin_password_edit"),
                    i = document.getElementById("kt_signin_email_button"),
                    s = document.getElementById("kt_signin_cancel"),
                    r = document.getElementById("kt_signin_password_button"),
                    a = document.getElementById("kt_password_cancel");
                i
                    .querySelector("button")
                    .addEventListener("click", function () {
                        l();
                    }),
                    s.addEventListener("click", function () {
                        l();
                    }),
                    r
                        .querySelector("button")
                        .addEventListener("click", function () {
                            d();
                        }),
                    a.addEventListener("click", function () {
                        d();
                    });
                var l = function () {
                        t.classList.toggle("d-none"),
                            i.classList.toggle("d-none"),
                            e.classList.toggle("d-none");
                    },
                    d = function () {
                        n.classList.toggle("d-none"),
                            r.classList.toggle("d-none"),
                            o.classList.toggle("d-none");
                    };
            }
        })(),
            (e = document.getElementById("kt_signin_change_email")) &&
                ((t = FormValidation.formValidation(e, {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: { message: "Email is required" },
                                emailAddress: {
                                    message:
                                        "The value is not a valid email address",
                                },
                            },
                        },
                        password: {
                            validators: {
                                notEmpty: { message: "Password is required" },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                        }),
                    },
                })),
                e
                    .querySelector("#kt_signin_submit")
                    .addEventListener("click", function (n) {
                        n.preventDefault(),
                            console.log("click"),
                            t.validate().then(function (n) {
                                "Valid" == n
                                    ? swal
                                          .fire({
                                              text: "Berhasil Mengubah Password",
                                              icon: "success",
                                              buttonsStyling: !1,
                                          })
                                          .then(function () {
                                              e.submit();
                                          })
                                    : swal.fire({
                                          text: "Gagal Mengubah Password, silahkan coba lagi.",
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "Ok!",
                                          customClass: {
                                              confirmButton:
                                                  "btn font-weight-bold btn-light-primary",
                                          },
                                      });
                            });
                    })),
            (function (t) {
                var e,
                    n = document.getElementById("kt_signin_change_password");
                n &&
                    ((e = FormValidation.formValidation(n, {
                        fields: {
                            current_password: {
                                validators: {
                                    notEmpty: {
                                        message: "Kata Sandi Saat Ini diperlukan",
                                    },
                                },
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: "Kata Sandi Baru diperlukan",
                                    },
                                    stringLength: {
                                        min: 8,
                                        message:
                                            "Kata sandi harus terdiri dari minimal 8 karakter",
                                    },
                                    // Untuk validasi karakter, huruf, dan angka
                                    // regexp: {
                                    //     regexp: /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])/,
                                    //     message: 'Password must contain at least one letter, one number, and one special character'
                                    // }
                                },
                            },
                            password_confirmation: {
                                validators: {
                                    notEmpty: {
                                        message: "Konfirmasi Kata Sandi diperlukan",
                                    },
                                    identical: {
                                        compare: function () {
                                            return n.querySelector(
                                                '[name="password"]'
                                            ).value;
                                        },
                                        message:
                                            "Kata sandi dan konfirmasinya tidak sama",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                            }),
                        },
                    })),
                    n
                        .querySelector("#kt_password_submit")
                        .addEventListener("click", function (t) {
                            t.preventDefault(),
                                console.log("click"),
                                e.validate().then(function (t) {
                                    "Valid" == t
                                        ? swal
                                              .fire({
                                                  text: "Berhasil Mengubah Password",
                                                  icon: "success",
                                                  buttonsStyling: !1,
                                                  customClass: {
                                                      confirmButton:
                                                          "btn font-weight-bold btn-light-primary",
                                                  },
                                              })
                                              .then(function () {
                                                  //   n.reset(), e.resetForm();
                                                  n.submit();
                                              })
                                        : swal.fire({
                                              text: "Gagal Mengubah Password, silahkan coba lagi.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              customClass: {
                                                  confirmButton:
                                                      "btn font-weight-bold btn-light-primary",
                                              },
                                          });
                                });
                        }));
            })();
    },
};
KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsSigninMethods.init();
});
