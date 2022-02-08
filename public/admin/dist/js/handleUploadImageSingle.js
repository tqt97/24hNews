$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#image").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0;i < filesLength;i++) {
                var f = files[ i ];
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\"><i class=\"fa fa-trash\"></i></span>" +
                        "</span>").insertAfter("#divMainUpload");

                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        $("#image").val("");
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API");
    }
});
