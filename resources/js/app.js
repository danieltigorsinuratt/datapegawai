document.addEventListener("DOMContentLoaded", function () {

    const togglePasswordBtn = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (togglePasswordBtn && passwordInput && eyeIcon) {
        togglePasswordBtn.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("bi-eye");
                eyeIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("bi-eye-slash");
                eyeIcon.classList.add("bi-eye");
            }
        });
    }

    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const usernameInput = document.getElementById("username");
            let isValid = true;

            usernameInput.classList.remove("is-invalid");
            passwordInput.classList.remove("is-invalid");

            if (!usernameInput.value.trim()) {
                usernameInput.classList.add("is-invalid");
                isValid = false;
            }

            if (!passwordInput.value.trim()) {
                passwordInput.classList.add("is-invalid");
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    const pegawaiForm = document.getElementById("pegawaiForm");
    if (pegawaiForm) {
        pegawaiForm.addEventListener("submit", function (e) {
            const nama = document.getElementById("nama");
            const email = document.getElementById("email");
            const noHp = document.getElementById("no_hp");

            if (!nama.value.trim()) {
                alert("Nama lengkap wajib diisi!");
                nama.focus();
                e.preventDefault();
                return false;
            }

            if (email.value.trim() && !email.value.includes("@")) {
                alert("Format email tidak valid! Harus mengandung karakter @");
                email.focus();
                e.preventDefault();
                return false;
            }

            if (noHp.value.trim() && isNaN(noHp.value)) {
                alert("Nomor telepon harus berupa angka!");
                noHp.focus();
                e.preventDefault();
                return false;
            }
        });
    }

    const modalHapus = document.getElementById("modalHapus");
    if (modalHapus) {
        modalHapus.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute("data-id");
            const nama = button.getAttribute("data-nama");

            const teksNama = document.getElementById("namaPegawaiHapus");
            const tombolHapus = document.getElementById("tombolKonfirmasiHapus");

            if (teksNama && nama) {
                teksNama.textContent = nama;
            }
            if (tombolHapus && id) {
                tombolHapus.href = "../proses/delete.php?id=" + id;
            }
        });
    }

    $('#inputCari').on('keyup', function () {
        var keyword = $(this).val();

        if (keyword.length > 0) {
            $('#iconCari').removeClass('bi-search').addClass('bi-x-lg');
        } else {
            $('#iconCari').removeClass('bi-x-lg').addClass('bi-search');
        }

        $.ajax({
            url: '../proses/cari.php',
            type: 'GET',
            data: { cari: keyword },
            success: function (response) {
                $('#tabelPegawai').html(response);
            }
        });
    });

    $('#btnIconCari').on('click', function () {
        if ($('#inputCari').val().length > 0) {
            $('#inputCari').val('');
            $('#iconCari').removeClass('bi-x-lg').addClass('bi-search');

            $.ajax({
                url: '../proses/cari.php',
                type: 'GET',
                data: { cari: '' },
                success: function (response) {
                    $('#tabelPegawai').html(response);
                }
            });
        }
    });

});
