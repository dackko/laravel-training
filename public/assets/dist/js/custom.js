$(document).ready(() => {
  $("#dataTable").on('click', '.delete-item', function (event) {
    let uri = $(this).data('url');
    let token = $(this).data('token');
    let that = $(this);

    Swal.fire({
      title: 'Are you sure?',
      icon: 'warning',
      input: 'text',
      html: "You won't be able to revert this! <br /> Reason for remove?",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
      $.ajax({
        method: 'DELETE',
        url: uri,
        data: {_token: token, reason: result.value},
        success: function (response) {
          if (response.status === 'Success') {
            that.closest('tr').fadeOut(500);
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            );
          }
        }
      });
    });
  });
});