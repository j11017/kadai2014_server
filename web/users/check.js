$(function() {
    $("form").submit(function() {
        if(!$("input[name=name]").val().match(/^[0-9a-zA-Z]{2,32}$/)
            || !$("input[name=pass]").val().match(/^[0-9a-zA-Z]{8,32}$/)) {
            alert("入力エラー");
            return false;
        }
        return true;
    });
});