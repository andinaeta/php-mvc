$(function () {
  const site_url = $("body").data("siteurl");

  $(".js-delete").on("click", function () {
    $(".modal-title").html("Update User");
    $(".modal-footer button[type=submit]").html("Update");
    $(".modal-content form").attr("action", site_url + "/home/update");

    const id = $(this).data("id");

    $.ajax({
      url: site_url + "/home/show/" + id,
      method: "get",
      dataType: "json",
      success: (res) => {
        $("#id").val(res.id);
        $("#name").val(res.name);
        $("#email").val(res.email);
      },
    });
  });
});
