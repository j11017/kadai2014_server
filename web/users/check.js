$(function() {
    $("form").submit(function() {
    	var displayAlert = false;
    	var alertString = "";
    	if(!$("input[name=name]").val().match(/^[0-9a-zA-Z]{2,32}$/)) {
    		displayAlert = true;
    		alertString += "名前は2文字から32文字の英数字で入力してください\n";
        }
        if(!$("input[name=pass]").val().match(/^[0-9a-zA-Z]{8,32}$/)) {
        	displayAlert = true;
    		alertString += "パスワードは8文字から32文字の英数字で入力してください\n";
        }
        if(displayAlert) {
        	alert(alertString);
        	return false;
        }
        return true;
    });
});