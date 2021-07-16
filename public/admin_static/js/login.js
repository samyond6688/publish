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
    $(".swicth-ercode").click(function (e) {
        e.preventDefault();
        $("form#login-form").hide();
        $(".ercodeSignBox").show();
        //makeCode();
    });
    $(".switch-input").click(function (e) {
        e.preventDefault();
        $("form#login-form").show();
        $(".ercodeSignBox").hide();
    });



    // 提交表单验证

});