$(function () {



    $("button.selectBtn").click(function (e) {
        if ($(".selectConentent").is(':hidden')) {
            $(".selectConentent").show();

        } else {
            $(".selectConentent").hide();
        }
        $(document).one('click', function () {
            $(".selectConentent").hide();
        });
        e.stopPropagation();
    });
    $(".selectConentent").on('click', function (e) {
        e.stopPropagation();
    })





    // ercode tab



    // 提交表单验证

});