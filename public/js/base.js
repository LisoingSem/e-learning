// Base javascript action
function translateMessage(messageKey) {
    var translations = {
        en: {
            "disable.title": "Confirmation to Disable ",
            "disable.no": "NO",
            "disable.yes": "Disabled",
            "disable.text": "<span class='text-warning'>Are you sure ? Are you wanted to disabled it ?</span>",

            "enable.title": "Confirmation to Enable ",
            "enable.no": "NO",
            "enable.yes": "Disabled",
            "enable.text": "<span class='text-info'>Are you sure ? Are you wanted to enabled it ?</span>",

            "trash.title": "Confirmation to move to Trash ",
            "trash.no": "NO",
            "trash.yes": "Trashed",
            "trash.text": "<span class='text-danger'>Are you sure ? Are you wanted to move it to trash ?</span>",

            "re-trash.title": "Confirmation to restore from Trash",
            "re-trash.no": "NO",
            "re-trash.yes": "Restore",
            "re-trash.text": "<span class='text-info'>Are you sure ? Are you wanted to move it to trash ?</span>",

            "delete.title": "Confirmation to Delete",
            "delete.no": "NO",
            "delete.yes": "Delete",
            "delete.text": "<span class='text-info'>Are you sure ? Are you wanted to delete it ?</span>",
        },
        kh: {
            "disable.title": "ការបញ្ជាក់ដើម្បីបិទ",
            "disable.no": "មិនធ្វើ",
            "disable.yes": "បិទ",
            "disable.text": "<span class='text-warning'>តើ​អ្នក​ប្រាកដ​ឬ​អត់ ? តើអ្នកចង់បិទវាទេ ?</span>",

            "enable.title": "ការបញ្ជាក់ដើម្បីបើក",
            "enable.no": "មិនធ្វើ",
            "enable.yes": "បើក",
            "enable.text": "<span class='text-info'>តើ​អ្នក​ប្រាកដ​ឬ​អត់ ? តើអ្នកចង់បើកវាទេ ?</span>",

            "trash.title": "ការបញ្ជាក់ដើម្បីផ្លាស់ទីទៅធុងសំរាម",
            "trash.no": "មិនធ្វើ",
            "trash.yes": "ផ្លាស់ទីសំរាម",
            "trash.text": "<span class='text-danger'>តើ​អ្នក​ប្រាកដ​ឬ​អត់ ? តើអ្នកចង់ផ្លាស់ទីវាទៅធុងសំរាមទេ ?</span>",

            "re.trash.title": "ការបញ្ជាក់ដើម្បីស្ដារពីធុងសំរាម",
            "re.trash.no": "មិនធ្វើ",
            "re.trash.yes": "ស្ដារឡើងវិញ",
            "re.trash.text": "<span class='text-info'>តើ​អ្នក​ប្រាកដ​ឬ​អត់ ? តើអ្នកចង់ផ្លាស់ទីវាទៅធុងសំរាមទេ ?</span>",

            "delete.title": "ការបញ្ជាក់ដើម្បីលុប",
            "delete.no": "មិនធ្វើ",
            "delete.yes": "លុប",
            "delete.text": "<span class='text-info'>តើ​អ្នក​ប្រាកដ​ឬ​អត់ ? តើអ្នកចង់លុបវាទេ?</span>",
        },
    };

    var lang = document.documentElement.lang; // Retrieve the value of the lang attribute
    var translation = translations[lang][messageKey]; // Retrieve the translated message for the detected language

    if (translation) {
        return translation;
    } else {
        return messageKey; // Return the translation key itself if translation is not available
    }
}


// function to save data from a form
function frm_submit(evt, router, is_clear_form = 1) {
    evt.preventDefault();
    // get data
    let id = $(evt.target).attr("id");
    let form = $("#" + id)[0];
    var data = new FormData(form);
    // disblle button
    let btn_save = $("#" + id).find('button[type="submit"]');
    // btn_save.attr('disabled', 'disabled');
    var spinner = document.getElementById('spinner');
    if (spinner) {
        spinner.remove();
        btn_save.prepend('<span id="spinner" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>');
    } else {
        btn_save.prepend('<span id="spinner" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>');
    }
    $.ajax({
        type: "POST",
        url: router,
        data: data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.status == 200) {
                if (is_clear_form == 1) {
                    $("#" + id)[0].reset();
                }
                $("#dataTable").DataTable().ajax.reload();
                $('#holder').empty();

                setTimeout(() => {
                    $("#createModal").modal("hide");
                    showNotifyMessage("Success", res.sms);
                    btn_save.removeAttr("disabled");
                    $("#spinner").remove();
                }, 100);
            } else {
                showNotifyMessage("error", res.sms);
            }
        },
    });
}

// function to update data from a form
function frm_update(evt, router, is_clear_form = 1, is_reload_datatable = 1) {
    evt.preventDefault();
    let id = $(evt.target).attr("id");
    let form = $("#" + id)[0];
    var data = new FormData(form);

    // disblle button
    let btn_update = $("#" + id).find('button[type="submit"]');
    // btn_update.attr('disabled', 'disabled');
    btn_update.prepend(
        '<span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;'
    );

    $.ajax({
        type: "POST",
        url: router,
        data: data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.status == 200) {
                if (is_clear_form == 1) {
                    $("#" + id)[0].reset();
                }
                if (is_reload_datatable == 1) {
                    $("#dataTable").DataTable().ajax.reload();
                }
                setTimeout(() => {
                    $("#editModal").modal("hide");
                    showNotifyMessage("Success", res.sms);
                    btn_update.removeAttr("disabled");
                    $("#spinner").remove();
                }, 100);
            } else {
                showNotifyMessage("error", res.sms);
            }
        },
    });
}

function deleteRow(obj) {
    var translatedMessage = translateMessage("delete.text");
    var translatedTitle = translateMessage("delete.title");
    var translatedYes = translateMessage("delete.yes");
    var translatedNo = translateMessage("delete.no");
    confirmDailog({
        title: translatedTitle,
        content: translatedMessage,
        yes: translatedYes,
        no: translatedNo,
        call_back: function () {
            try {
                $.ajax({
                    type: "delete",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

function removeRow(obj) {
    confirmDailog({
        title: "Confirmation",
        content: `<h4>តើអ្នកប្រាកដជាចង់លុបមែនដែរឬទេ?</h4> <br> លុបហើយមិនអាចយកមកវិញបានទេ។`,
        call_back: function () {
            try {
                $.ajax({
                    type: "post",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

function hiddenRow(obj) {
    var translatedMessage = translateMessage("disable.text");
    var translatedTitle = translateMessage("disable.title");
    var translatedYes = translateMessage("disable.yes");
    var translatedNo = translateMessage("disable.no");

    confirmDailog({
        title: translatedTitle,
        content: translatedMessage,
        yes: translatedYes,
        no: translatedNo,
        call_back: function () {
            try {
                $.ajax({
                    type: "post",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

function showRow(obj) {
    var translatedMessage = translateMessage("enable.text");
    var translatedTitle = translateMessage("enable.title");
    var translatedYes = translateMessage("enable.yes");
    var translatedNo = translateMessage("enable.no");
    confirmDailog({
        title: translatedTitle,
        content: translatedMessage,
        yes: translatedYes,
        no: translatedNo,
        call_back: function () {
            try {
                $.ajax({
                    type: "post",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

function restoreRow(obj) {
    var translatedMessage = translateMessage("re.trash.text");
    var translatedTitle = translateMessage("re.trash.title");
    var translatedYes = translateMessage("re.trash.yes");
    var translatedNo = translateMessage("re.trash.no");
    confirmDailog({
        title: translatedTitle,
        content: translatedMessage,
        yes: translatedYes,
        no: translatedNo,
        call_back: function () {
            try {
                $.ajax({
                    type: "post",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

function moveTrushRow(obj) {
    var translatedMessage = translateMessage("trash.text");
    var translatedTitle = translateMessage("trash.title");
    var translatedYes = translateMessage("trash.yes");
    var translatedNo = translateMessage("trash.no");
    confirmDailog({
        title: translatedTitle,
        content: translatedMessage,
        yes: translatedYes,
        no: translatedNo,
        call_back: function () {
            try {
                $.ajax({
                    type: "delete",
                    url: $(obj).attr("url"),
                    data: getAttributes(obj),
                    success: function (res) {
                        if (res.status == 200) {
                            showNotifyMessage("Success", res.sms);
                            if ($("#dataTable").length) {
                                $("#dataTable").DataTable().ajax.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            showNotifyMessage("error", res.sms);
                        }
                    },
                });
            } catch (error) {
                console.log(error);
            }
        },
    });
}

$("#ethumbnail").on("change", function () {
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#ethumbnail_logo").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
});

$("#thumbnail").on("change", function () {
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#thumbnail_logo").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
});

function disabledData(routeUrl) {
    $('#disableButton').addClass("active");
    if ($("#trushButton").hasClass("active")) {
        $("#trushButton").removeClass("active");
    }
    $("#dataTable")
        .DataTable()
        .ajax.url(routeUrl + "?status=0")
        .load();
}

function trushData(routeUrl) {
    $('#trushButton').addClass("active");
    if ($("#disableButton").hasClass("active")) {
        $("#disableButton").removeClass("active");
    }
    $("#dataTable")
        .DataTable()
        .ajax.url(routeUrl + "?status=trush")
        .load();
}

function refreshData(routeUrl) {
    if ($("#disableButton").hasClass("active")) {
        $("#disableButton").removeClass("active");
    }
    if ($("#trushButton").hasClass("active")) {
        $("#trushButton").removeClass("active");
    }
    $("#dataTable").DataTable().ajax.url(routeUrl).load();
}

function showImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#thumbnail_logo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#thumbnail").change(function() {
    showImage(this);
});

$("#ethumbnail").change(function() {
    showEditImage(this);
});

function showEditImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#ethumbnail_logo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function getAttributes($node) {
    var attrs = {};
    $.each($node.attributes, function (index, attribute) {
        attrs[attribute.name] = attribute.value;
    });
    return attrs;
}
