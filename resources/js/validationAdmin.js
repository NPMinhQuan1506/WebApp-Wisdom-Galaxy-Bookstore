var objNameList = "/";
$(document).ready(function () {
    var avatar = $("#validatedCustomFile")
    var name = $("#name");
    var address = $("#address");
    var birth = $("#birth");
    var email = $("#email");
    var phone = $("#phone");
    var account = $("#account");
    var password = $("#passwd");
    var hiredate = $("#datepicker-autoclose");
    validateInput(name);
    validateInput(address);
    validateInput(birth);
    validateInput(email);
    validateInput(phone);
    validateInput(account);
    validateInput(password);
    validateInput(hiredate);
    validateInput(avatar);
    handleSubmit();
});

function validateInput(obj) {
    obj.change(function (e) {
        var txtData = $(this).val();
        var name = obj.attr("name");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        $.ajax({
            type: "POST",
            url: "../nhan-vien/validate",
            data: $("#frmEmployee").serialize(),
            dataType: "json",
            error: function (Xhr, json, error) {
                if(obj.next().is('.notify-exists')) {
                    var notify_data = obj.next();
                }
                else{
                    var notify_data =obj.next().next();
                }
                var errors = Xhr.responseJSON;
                if(typeof errors !== "undefined")
                {
                    var x = errors["errors"][name];
                }


                if (typeof x !== "undefined") {
                    checkIsValidClass(notify_data, "valid-feedback");
                    checkIsValidClass(obj, "is-valid");
                    obj.addClass("is-invalid");
                    notify_data.addClass("invalid-feedback");
                    notify_data.html(x);
                    // /a/b/b/
                    if(objNameList.includes(name)){
                        objNameList.replace(name+"/","");
                    }
                } else {
                    checkIsValidClass(notify_data, "invalid-feedback");
                    checkIsValidClass(obj, "is-invalid");
                    obj.addClass("is-valid");
                    notify_data.addClass("valid-feedback");
                    notify_data.html("Dữ Liệu Hợp Lệ");
                    if(!objNameList.includes(name)){
                        objNameList =  objNameList.concat(name+"/");
                    }
                }
            },
        });
    });
}
function validateSelect(){
    var valueDepartment = $( "#department option:selected" ).val();
    var valueGender = $( "#gender option:selected" ).val();
    if(valueGender == 0 || valueDepartment == 0){
         return false;
    }
    return true;
}
function handleSubmit(){
    $('#btnSave').click(function (e) {
        e.preventDefault();
        var count = (objNameList.split("/").length - 1) ;
        alert(count);
        if(count == 10  && validateSelect()){
            $( '#frmEmployee').submit();
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
              })
        }
    });
}
function checkIsValidClass(obj, classname) {
    if (obj.hasClass(classname)) {
        obj.removeClass(classname);
        return;
    }
    if (obj.hasClass(classname)) {
        obj.removeClass(classname);
        return;
    }
}

