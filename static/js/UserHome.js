$(document).ready(function () {
    let getcookie = function (objname) {//获取指定名称的cookie的值
        let arrstr = document.cookie.split("; ");
        for (let i = 0; i < arrstr.length; i++) {
            let temp = arrstr[i].split("=");
            if (temp[0] == objname) {
                return unescape(temp[1]);
            }
        }
    };
    $('#userid').attr('value', getcookie('id'));
});

