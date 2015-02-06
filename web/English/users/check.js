$(function() {
    $("form").submit(function() {
        if(!$("input[name=name]").val().match(/^[0-9a-zA-Z]{2,32}$/)
            || !$("input[name=pass]").val().match(/^[0-9a-zA-Z]{8,32}$/)) {
            alert("Error: Name is /^[0-9a-zA-Z]{2,32}$/ and password is ^[0-9a-zA-Z]{8,32}$/");
            return false;
        }
        return true;
    });
});