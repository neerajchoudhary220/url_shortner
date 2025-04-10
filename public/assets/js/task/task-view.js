$(document).ready(function () {
  $("#deleteBtn").on("click", function () {
    const uRL = $(this).attr("data-url");

    function deleteReq() {
      $.ajax({
        url: uRL,
        type: "GET",
        success: function (response) {
          swal(`Deleted!`, response.message, `success`);
          window.location.href = task_list_url;
        },
      });
    }

    custom.functions.deleteTask(deleteReq);
  });
});
