
// update======
$('.btn-update').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
        title: 'Yakin Ubah data?',
        text: "Pastiin dulu data yang kamu masukin udah bener",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin Dong!'
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#update-tamu`).submit();
        }
    })
});

// batal
$('.btn-batal').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
        title: 'Yakin batal ?',
        text: "Data yang udah kamu ubah bakal ilang loh?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin banget'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = `{{ route('manage-tamu.index') }}`
        }
    })
});
