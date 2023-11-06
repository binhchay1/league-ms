function teamplatePlayer(e, t, a) {
    var n = arguments.length > 3 && void 0 !== arguments[3] && arguments[3],
        o = !(arguments.length > 4 && void 0 !== arguments[4]) || arguments[4],
        i = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : "",
        r = '<div class="tab-content wrap-content" data-text="' + e + '">\n                    <input type="hidden" name="member[' + e + '][idPlayer]" class="idPlayer clearValInput" />\n                    <div role="tabpanel" class="tab-pane active player">\n                        <div class="player-container">\n                            <div class="row">\n                                <i class="font-size-20 red-text fa fa-remove btnDeleteAthlete"></i>\n                                <div class="col-sm-1 padding-0">\n                                    <div class="player-detail-icon">';
    return n && (r += '<i data-text="' + e + '" data-id="" class="font-size-20 fa fa-id-card btnLinked" data-toggle="modal" data-target="#searchAddNewMemberModal"></i>'), r += '\n                                    </div>\n                                </div>\n                                <div class="col-sm-2 padding-0">\n                                    <div class="avatar-position">\n                                        <input name="avatar' + e + '" type="file" id="UploadAvatar' + e + '" class="UploadAvatar hidden" accept="image/*" />\n                                        <input name="member[' + e + '][fullPathHidden]" type="text" class="avatar hidden clearValInput"/>\n                                        <label for="UploadAvatar' + e + '">\n                                            <img class="img-circle img-thumbnail bgEsport" id="avatar" src="/content/images/player.png">\n                                        </label>\n                                    </div>\n                                </div>\n                                <div class="col-sm-9 info-container">\n                                    <div class="row padding-bt-5">\n                                        <div class="col-sm-6">\n                                            <input name="member[' + e + '][numberPlayer]" type="text" class="form-control numberPlayer bgEsport autoSearchPlayers1 clearValInput require" data-action="' + i + '?type=1" placeholder="' + a.number + '">\n                                        </div>\n                                        <div class="col-sm-6 pl-md-0">\n                                            <input name="member[' + e + '][namePlayer]" class="form-control namePlayer bgEsport autoSearchPlayers2 clearValInput require" data-action="' + i + '?type=2" placeholder="' + a.name + '">\n                                        </div>\n                                    </div>\n                                    <div class="row padding-bt-5">', o && (r += '<div class="col-sm-6">\n                     ' + t.position + "\n                 </div>"), r += '<div class="col-sm-' + (o ? "6" : "12") + ' pl-md-0">\n                                            ' + t.rule + '\n                                        </div>\n                                    </div>\n                                    <div class="row padding-bt-5">\n                                        <div class="col-sm-6">\n                                            <input name="member[' + e + '][fullname]" type="text" class="form-control fullname bgEsport clearValInput" placeholder="' + a.fullname + '">\n                                        </div>\n                                        <div class="col-sm-6 pl-md-0">\n                                            <input name="member[' + e + '][birthday]" type="text" class="form-control birthday bgEsport clearValInput" placeholder="' + a.birthday + '">\n                                        </div>\n                                    </div>\n                                    <div class="row">\n                                        <div class="col-sm-6">\n                                            <input name="member[' + e + '][phone]" type="text" class="form-control phone bgEsport clearValInput" placeholder="' + a.phone + '">\n                                        </div>\n                                        <div class="col-sm-6 pl-md-0">\n                                            <input name="member[' + e + '][email]" type="email" class="form-control email bgEsport clearValInput" placeholder="' + a.email + '">\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>', n && (r += '<div class="row mt-15 associate">\n                      <div class="player-detail-icon' + e + '">\n                          ' + a.txtLinked + ': \n                          <a href="javascript:void(0)" class="full-name-email"></a>\n                          <i class="lbl" style="display:none"> (' + a.txtInvite + ') </i>\n                          <i title="' + a.delLinked + '" class="red-text fa fa-remove"></i>\n                          \n                          <input class="idUser"              name="member[' + e + '][idUser]"              type="hidden">\n                          <input class="emailUser"           name="member[' + e + '][emailUser]"           type="hidden">\n                          <input class="accuracy"            name="member[' + e + '][accuracy]"            type="hidden">\n                          <input class="emailHaveNotAccount" name="member[' + e + '][emailHaveNotAccount]" type="hidden">\n                      </div>\n                  </div>\n                  <div class="hidden infoExtend">\n                       <input name="member[' + e + '][height]" />\n                       <input name="member[' + e + '][weight]" />\n                       <input name="member[' + e + '][shirt_size]" />\n                       <input name="member[' + e + '][shoe_size]" />\n                       <input name="member[' + e + '][foot]" value="1"/>\n                  </div>'), r += "</div></div>"
}

function teamplateOrganizer(e, t, a) {
    return '<div class="tab-content wrap-content" data-text="' + e + '">\n                <div role="tabpanel" class="tab-pane active player">\n                    <div class="player-container">\n                        <div class="row">\n                            <div class="col-sm-1 padding-0 wrapAction">\n                                <div class="player-detail-icon">                                    <i title="Xóa thành viên" class="font-size-20 red-text fa fa-minus-circle"></i>\n                                </div>\n                                <div class="publicInfo">\n                                    <div class="pretty p-switch p-fill">\n                                        <input name="member[' + e + '][publish]" type="checkbox" value="1" />\n                                        <div class="state p-info">\n                                            <label></label>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class="col-sm-2 padding-0">\n                                <div class="avatar-position">\n                                    <input name="member[' + e + '][avatar]" type="file" id="UploadAvatar' + e + '" class="UploadAvatar hidden" accept="image/*" multiple="true"/>\n                                    <input name="member[' + e + '][fullPathHidden]" type="text" class="hidden"/>\n                                    <label for="UploadAvatar' + e + '">\n                                        <img class="img-circle img-thumbnail" id="avatar" src="/content/images/player.png">\n                                    </label>\n                                </div>\n                            </div>\n                            <div class="col-sm-9 info-container">\n                                <div class="row padding-bt-5">\n                                    <div class="col-sm-12">\n                                        <input name="member[' + e + '][fullname]" type="text" class="form-control fullname require" placeholder="' + a.fullname + '">\n                                    </div>\n                                </div>\n                                <div class="row padding-bt-5">\n                                    <div class="col-sm-6">\n                                        <input name="member[' + e + '][role]" type="text" class="form-control role require" placeholder="' + a.role + '">\n                                    </div>\n                                    <div class="col-sm-6 pl-md-0">\n                                        <input name="member[' + e + '][birthday]" type="text" class="form-control birthday" placeholder="' + a.birthday + '">\n                                    </div>\n                                </div>\n                                <div class="row">\n                                    <div class="col-sm-6">\n                                        <input name="member[' + e + '][phone]" type="text" class="form-control" placeholder="' + a.phone + '">\n                                    </div>\n                                    <div class="col-sm-6 pl-md-0">\n                                        <input name="member[' + e + '][email]" type="text" class="form-control" placeholder="' + a.email + '">\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>'
}

function initDatePicker(e) {
    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
        a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null,
        n = {
            dateFormat: "dd-mm-yy",
            changeYear: !0,
            changeMonth: !0,
            yearRange: "-100:+10",
            showButtonPanel: !0,
            firstDay: 1,
            beforeShow: function(e, t) {
                $("body").addClass("dateTimePickerOn")
            },
            onClose: function(e, t) {
                $("body").removeClass("dateTimePickerOn")
            }
        },
        o = $.extend(n, t);
    a ? $(e).datepicker(o).datepicker("setDate", a) : $(e).datepicker(o)
}

function initDateTimePicker(e) {
    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
        a = $("html").attr("lang"),
        n = {
            format: "H:i - d/m/Y",
            step: 5,
            lang: "vi",
            value: $(e).val(),
            todayButton: !1,
            validateOnBlur: !1,
            onShow: function(e, t) {
                $("body").addClass("dateTimePickerOn"), $(".xdsoft_datetimepicker .xdsoft_time").each((function(e, t) {
                    if ($(t).hasClass("xdsoft_current")) {
                        var a = e + 1;
                        setTimeout((function() {
                            $(".xdsoft_datetimepicker .xdsoft_time_variant").attr("style", "margin-top:" + (107.5 - 35 * a) + "px"), $(".xdsoft_datetimepicker .xdsoft_scroller").attr("style", "margin-top:" + 3.39 * a + "px")
                        }), 100)
                    }
                }))
            },
            onClose: function(e, t) {
                $("body").removeClass("dateTimePickerOn")
            }
        },
        o = $.extend(n, t);
    $(e).datetimepicker(o), $.datetimepicker.setLocale(a)
}

function initToastr(e, t) {
    var a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
    toastr.options.closeButton = !a.hasOwnProperty("closeButton") || a.closeButton, toastr.options.escapeHtml = !!a.hasOwnProperty("escapeHtml") && a.escapeHtml, toastr.options.timeOut = a.hasOwnProperty("timeOut") ? a.timeOut : 1e4, toastr.options.positionClass = a.hasOwnProperty("positionClass") ? a.positionClass : "toast-bottom-right", "info" === e && toastr.info(t), "warning" === e && toastr.warning(t), "success" === e && toastr.success(t), "error" === e && toastr.error(t)
}
var croppie = null,
    inputFile = null,
    eventOfElementClicked = null;

function initTippy(e, t) {
    var a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
    a.content = t, a.arrow = !0, a.animation = "perspective", a.followCursor = !a.hasOwnProperty("followCursor") || a.followCursor, a.zIndex = a.hasOwnProperty("zIndex") ? a.zIndex : 9999, tippy(e, a)
}

function formatNumber(e) {
    var t = getNumber(e);
    if (t.length <= 3) return t;
    for (var a = "", n = 0; n < t.length; n++) t = t.replace(".", "");
    if (-1 === t.lastIndexOf(","))
        for (n = t.length; n >= 0; n--) a.length > 0 && (t.length - n - 1) % 3 == 0 && (a = "." + a), a = t.substring(n, n + 1) + a;
    else {
        var o = t.substring(0, t.lastIndexOf(",")),
            i = t.substring(t.lastIndexOf(","), t.length),
            r = 0;
        for (n = o.length; n >= 0; n--) a.length > 0 && 4 === r && (a = "." + a, r = 1), a = o.substring(n, n + 1) + a, r += 1;
        a += i
    }
    return a
}

function getNumber(e) {
    for (var t = 0, a = 0; a < e.length; a++) {
        var n = e.substring(a, a + 1);
        if (!("." === n || "," === n || n >= 0 && n <= 9)) return initToastr("error", Lang.get("messages.not_numberic")), e.substring(0, a);
        if (" " === n) return e.substring(0, a);
        if ("," === n) {
            if (t > 0) return e.substring(0, ipubl_date);
            t++
        }
    }
    return e
}

function revertMoney(e) {
    return e.replace(/\D/g, "")
}

function replaceAll(e, t, a) {
    return e.replace(new RegExp(escapeRegExp(t), "g"), a)
}

function escapeRegExp(e) {
    return e.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1")
}

function isNumeric(e) {
    return "number" == typeof e && !isNaN(e) && isFinite(e)
}

function getSettingByDevice(e) {
    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 750,
        a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1e3,
        n = $(window).width(),
        o = {};
    return o.width = t, o.height = t / e, o.widthWrap = a, o.heightWrap = a / e, n < 1045 && (o.width = 500, o.height = 500 / e, o.widthWrap = 700, o.heightWrap = 700 / e), n < 768 && (o.width = 375, o.height = 375 / e, o.widthWrap = 500, o.heightWrap = 500 / e), n < 525 && (o.width = 320, o.height = 320 / e, o.widthWrap = o.width, o.heightWrap = o.height), o
}

function copyClipboardText(e) {
    var t = navigator.userAgent;
    if (t.indexOf("iPhone") > 0 || t.indexOf("Android") > 0 || t.indexOf("Mobile") > 0 || t.indexOf("iPad") > 0) {
        $(document.body).append('<textarea id="tmp_copy" style="position:fixed;right:100vw;font-size:16px;" readonly="readonly">' + e + "</textarea>");
        var a = $("#tmp_copy")[0];
        a.select();
        var n = document.createRange();
        n.selectNodeContents(a);
        var o = window.getSelection();
        o.removeAllRanges(), o.addRange(n), a.setSelectionRange(0, 999999), document.execCommand("copy"), $(a).remove()
    } else {
        var i = document.createElement("textarea");
        i.value = e, document.body.appendChild(i), i.select(), document.execCommand("copy"), i.parentElement.removeChild(i)
    }
    initToastr("info", Lang.get("messages.copied_success"))
}

function downloadCsv(e, t) {
    for (var a = e + ".csv", n = new Uint8Array([255, 254]), o = [], i = t.length, r = 0; r < i; r++) o.push(t.charCodeAt(r));
    o = new Uint16Array(o);
    var s = new Blob([n, o], {
            type: "text/csv"
        }),
        c = jQuery("<a></a>", {
            href: window.URL.createObjectURL(s),
            download: a,
            target: "_blank"
        })[0];
    window.navigator.msSaveBlob ? (window.navigator.msSaveBlob(s, a), window.navigator.msSaveOrOpenBlob(s, a)) : window.URL && window.URL.createObjectURL ? (document.body.appendChild(c), c.click(), document.body.removeChild(c)) : window.webkitURL && window.webkitURL.createObject ? c.click() : window.open("data:text/csv;charset=utf-16;;base64," + window.Base64.encode(t), "_blank")
}

function downloadImg(e, t) {
    var a = $.base64ImageToBlob(t),
        n = $("<a></a>", {
            href: window.URL.createObjectURL(a),
            download: e,
            target: "_blank"
        })[0];
    return window.navigator.msSaveBlob ? (window.navigator.msSaveBlob(a, e), window.navigator.msSaveOrOpenBlob(a, e)) : window.URL && window.URL.createObjectURL ? (document.body.appendChild(n), n.click(), document.body.removeChild(n)) : window.webkitURL && window.webkitURL.createObject ? n.click() : window.open(t, "_blank"), !0
}

function hexToRgba(e, t) {
    e = e.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, (function(e, t, a, n) {
        return t + t + a + a + n + n
    }));
    var a, n = 1 - (parseFloat(t) + .1),
        o = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);
    return a = n >= 0 && n < .88 ? n : n < 0 ? 0 : 1, o ? "rgba(" + parseInt(o[1], 16) + "," + parseInt(o[2], 16) + "," + parseInt(o[3], 16) + "," + a + ")" : null
}

function createSlug(e) {
    return e = nonAccentVietnamese(e).replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
}

function nonAccentVietnamese(e) {
    return e = (e = (e = (e = (e = (e = (e = (e = (e = (e = e.toLowerCase()).replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")).replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")).replace(/ì|í|ị|ỉ|ĩ/g, "i")).replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")).replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")).replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y")).replace(/đ/g, "d")).replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, "")).replace(/\u02C6|\u0306|\u031B/g, "")
}

function setDateTime(e, t, a, n, o) {
    return e.setDate(t), e.setHours(+a), e.setMinutes(n), e.setSeconds(o), e
}

function hideDivExpired(e, t) {
    var a = new Date,
        n = parseInt(e);
    setDateTime(a, a.getDate(), a.getHours() + n, a.getMinutes(), a.getSeconds()), localStorage.setItem("hideDiv" + t, a.getTime())
}

function initDatatable(e) {
    var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
        a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : [],
        n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : [],
        o = $(".datatableToSearch"),
        i = o.DataTable(e);
    if (t) {
        var r = o.attr("data-column").split("|");
        $(".datatableToSearch thead tr").clone(!0).appendTo(".datatableToSearch thead"), $(".datatableToSearch thead tr:eq(1) th").each((function(e) {
            var t = e.toString(),
                o = $(this);
            if (o.removeClass("sorting").addClass("sorting_disabled").removeAttr("aria-controls").unbind("click").html(""), -1 === r.indexOf(t)) {
                var s = o.text();
                if (o.html('<input type="text" placeholder="Search ' + s + '" />'), $("input", this).on("keyup change", (function() {
                        i.column(t).search() !== this.value && i.column(t).search(this.value).draw()
                    })), -1 !== a.indexOf(e)) {
                    var c = '<div id="reportRange' + e + '" class="btn default">\n                     <i class="fa fa-calendar"></i> &nbsp;\n                     <span> </span>\n                     <b class="fa fa-angle-down"></b>\n                 </div>';
                    o.html(c);
                    var l = {
                        startDate: moment("2018-01-01").format("DD/MM/YYYY"),
                        initDays: moment("2018-01-01").format("DD/MM/YYYY") + " - " + moment().format("DD/MM/YYYY")
                    };
                    initDateRangePicker("#reportRange" + e, "left", l), $("#reportRange" + e).on("apply.daterangepicker", (function(a, n) {
                        var o = n.startDate.format("DD/MM/YYYY") + " - " + n.endDate.format("DD/MM/YYYY");
                        i.column(e).search() !== o && i.column(t).search(o).draw();
                        var r = $("#sysBtnDownload"),
                            s = r.attr("data-href") + "?dates=" + o;
                        r.attr("href", s)
                    }))
                } - 1 !== n.indexOf(e) && $("#htmlSelect").length > 0 && (o.html($("#htmlSelect").html()), $("select", this).on("keyup change", (function() {
                    i.column(t).search() !== this.value && i.column(t).search(this.value).draw()
                })), $("body").on("changed.bs.select", "select", (function(e, a, n, o) {
                    var r = $(this).val();
                    r && i.column(t).search(r).draw()
                })))
            }
        }))
    }
}

function initTimePicker(e) {
    $(e).timepicker({
        timeFormat: "hh:mm",
        showCloseButton: !0,
        showNowButton: !0,
        showDeselectButton: !0,
        beforeShow: function(e, t) {
            $(e).closest("#modalCreateEvent").length > 0 && setTimeout((function() {
                var a = $(e).offset(),
                    n = $(window).scrollTop();
                t.tpDiv.css({
                    top: a.top + $(e).outerHeight() - n,
                    left: a.left
                })
            }), 1), $("body").addClass("dateTimePickerOn")
        },
        onClose: function(e, t) {
            $("body").removeClass("dateTimePickerOn")
        }
    })
}

function initDateRangePicker(e, t) {
    var a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {},
        n = {},
        o = moment().subtract("days", 30).format("DD/MM/YYYY") + " - " + moment().format("DD/MM/YYYY"),
        i = moment().subtract("days", 29),
        r = moment();
    a.hasOwnProperty("initDays") && (o = a.initDays), a.hasOwnProperty("createdAt") && (i = moment(a.createdAt), n[Lang.get("common.daterangepicker.createdat")] = [moment(a.createdAt), moment()]), a.hasOwnProperty("startDate") && (i = moment(a.startDate)), a.hasOwnProperty("endDate") && (r = moment(a.endDate)), n[Lang.get("common.daterangepicker.today")] = [moment(), moment()], n[Lang.get("common.daterangepicker.yesterday")] = [moment().subtract("days", 1), moment().subtract("days", 1)], n[Lang.get("common.daterangepicker.last7day")] = [moment().subtract("days", 6), moment()], n[Lang.get("common.daterangepicker.last30day")] = [moment().subtract("days", 29), moment()], n[Lang.get("common.daterangepicker.thismonth")] = [moment().startOf("month"), moment().endOf("month")], n[Lang.get("common.daterangepicker.lastmonth")] = [moment().subtract("month", 1).startOf("month"), moment().subtract("month", 1).endOf("month")], n[Lang.get("common.daterangepicker.thisyear")] = [moment().startOf("year"), moment().endOf("year")], n[Lang.get("common.daterangepicker.lastyear")] = [moment().subtract("year", 1).startOf("year"), moment().subtract("year", 1).endOf("year")], $(e).daterangepicker({
        opens: t,
        startDate: i,
        endDate: r,
        dateLimit: {
            years: 100
        },
        showDropdowns: !0,
        showWeekNumbers: !1,
        timePicker: !1,
        timePickerIncrement: 1,
        timePicker12Hour: !0,
        ranges: n,
        buttonClasses: ["btn"],
        applyClass: "green",
        cancelClass: "default",
        format: "MM/DD/YYYY",
        separator: " " + Lang.get("common.daterangepicker.to") + " ",
        locale: {
            format: "DD/MM/YYYY",
            cancelLabel: Lang.get("common.daterangepicker.cancel"),
            applyLabel: Lang.get("common.daterangepicker.apply"),
            fromLabel: Lang.get("common.daterangepicker.from"),
            toLabel: Lang.get("common.daterangepicker.to"),
            customRangeLabel: Lang.get("common.daterangepicker.custom"),
            daysOfWeek: [Lang.get("common.daterangepicker.short_day.su"), Lang.get("common.daterangepicker.short_day.mo"), Lang.get("common.daterangepicker.short_day.tu"), Lang.get("common.daterangepicker.short_day.we"), Lang.get("common.daterangepicker.short_day.th"), Lang.get("common.daterangepicker.short_day.fr"), Lang.get("common.daterangepicker.short_day.sa")],
            monthNames: [Lang.get("common.daterangepicker.full_month.ja"), Lang.get("common.daterangepicker.full_month.feb"), Lang.get("common.daterangepicker.full_month.mar"), Lang.get("common.daterangepicker.full_month.apr"), Lang.get("common.daterangepicker.full_month.may"), Lang.get("common.daterangepicker.full_month.jun"), Lang.get("common.daterangepicker.full_month.jul"), Lang.get("common.daterangepicker.full_month.aug"), Lang.get("common.daterangepicker.full_month.step"), Lang.get("common.daterangepicker.full_month.oct"), Lang.get("common.daterangepicker.full_month.nov"), Lang.get("common.daterangepicker.full_month.dec")],
            firstDay: 1
        }
    }, (function(t, a) {
        var n = t.format("DD/MM/YYYY") + " - " + a.format("DD/MM/YYYY");
        $(e).find("span").html(n)
    })), $(e).find("span").html(o)
}

function isIphone() {
    return window.navigator.userAgent.indexOf("iPhone") > -1
}

function isSafari() {
    return /^((?!chrome|android).)*safari/i.test(navigator.userAgent)
}

function setWithExpiry(e, t, a) {
    var n = {
        value: t,
        expiry: (new Date).getTime() + a
    };
    localStorage.setItem(e, JSON.stringify(n))
}

function getWithExpiry(e) {
    var t = localStorage.getItem(e);
    if (!t) return null;
    var a = JSON.parse(t);
    return (new Date).getTime() > a.expiry ? (localStorage.removeItem(e), null) : a.value
}

function actionAjaxReadNotify(e) {
    var t = "/account/ajax/notifications/" + e + "/update";
    window.location.hostname.indexOf("agency.") > -1 && (t = "https://" + window.location.hostname + "/vi" + t), $.ajax({
        type: "POST",
        url: t,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(t) {
            var a = $("#AppBar #dropdown-notify .badge, #AppBar .mb-notify .badge");
            $(".notiCommonHeader .notiAccount.unread.noti" + e).removeClass("unread").addClass("read"), t.data.count > 0 ? a.text(t.data.count) : a.remove()
        },
        error: function(e) {
            initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
        }
    })
}

function swipe(e) {
    var t = e.getAttribute("src");
    window.open(t, "Image", "width=largeImage.style.width,height=largeImage.style.height,resizable=1")
}

function readURL(e, t) {
    if (e.files && e.files[0]) {
        var a = new FileReader;
        a.onload = function(e) {
            t.attr("src", e.target.result), fixExifOrientation(t)
        }, a.readAsDataURL(e.files[0])
    }
}

function fixExifOrientation(e) {
    e.on("load", (function() {
        EXIF.getData(e[0], (function() {
            switch (parseInt(EXIF.getTag(this, "Orientation"))) {
                case 2:
                    e.addClass("flip");
                    break;
                case 3:
                    e.addClass("rotate-180");
                    break;
                case 4:
                    e.addClass("flip-and-rotate-180");
                    break;
                case 5:
                    e.addClass("flip-and-rotate-270");
                    break;
                case 6:
                    e.addClass("rotate-90");
                    break;
                case 7:
                    e.addClass("flip-and-rotate-90");
                    break;
                case 8:
                    e.addClass("rotate-270")
            }
        }))
    }))
}

function tog(e) {
    return e ? "addClass" : "removeClass"
}

function delayWhenTyping(e, t) {
    var a = 0;
    return function() {
        var n = this,
            o = arguments;
        clearTimeout(a), a = setTimeout((function() {
            e.apply(n, o)
        }), t || 0)
    }
}

function showVote(e, t) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
        },
        type: "GET",
        url: t,
        data: {
            idMatch: e
        },
        success: function(e) {
            200 === e.code && (e.data.vote_enable ? $("#viewMatch .wrapVoteMatch").html(e.data.html).show() : $("#viewMatch .wrapVoteMatch").html("").hide())
        }
    })
}

function actionAjaxSaveVote(e, t, a) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
        },
        type: "POST",
        url: a,
        dataType: "JSON",
        data: e,
        contentType: !1,
        processData: !1,
        success: function(a) {
            200 === a.code && (initToastr("success", a.messages), t.addClass("active")), 422 === a.code && (localStorage.setItem("noteIdMatchVoted", e.get("idMatch")), window.location.href = a.data)
        }
    })
}

function actionAjaxFavouriteLeague(e, t, a) {
    $.get("/account/store/league-favourite/" + t + "/" + a, (function(a) {
        200 === a.code ? (e.prop("checked", 1 === t), e.closest(".league-item:not(.hvr-bob)").fadeOut()) : initToastr("error", Lang.get("messages.error")), 1 === t && swal({
            html: Lang.get("modal.title_confirm_receive_mail"),
            type: "question",
            showCancelButton: !0,
            focusCancel: !0,
            cancelButtonText: Lang.get("label.button.destroy"),
            confirmButtonText: Lang.get("label.button.accept"),
            confirmButtonColor: "#f74444",
            reverseButtons: !0
        }).then((function(e) {
            if (e.value) {
                var t = new FormData;
                t.append("id", a.data.id), $.ajax({
                    type: "POST",
                    url: "/account/update/league-favourite",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: t,
                    processData: !1,
                    contentType: !1,
                    success: function(e) {
                        200 === e.code && initToastr("success", e.messages)
                    },
                    error: function(e) {
                        initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
                    }
                })
            }
        }))
    })).fail((function() {
        initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
    }))
}

function validateEmail(e) {
    return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(e)
}

function isFunction(e) {
    return e && "[object Function]" === {}.toString.call(e)
}

function iOS() {
    var e = window.navigator.userAgent;
    if (e.indexOf("iPhone") > -1) return !0;
    if (e.indexOf("iPad") > -1) return !0;
    if (e.indexOf("Macintosh") > -1) try {
        return document.createEvent("TouchEvent"), !0
    } catch (e) {}
    return !1
}

function isUrlValid(e) {
    return !(null == e.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g))
}

function getMaxNumberRoundKnockout(e) {
    return e > 64 ? 64 : e > 32 ? 32 : e > 16 ? 16 : e > 8 ? 8 : e > 4 ? 4 : 0
}

function getRoundDuplicateOnBranchLoser(e) {
    return e > 64 ? [16, 8, 4, 2, 1] : e > 32 ? [8, 4, 2, 1] : e > 16 ? [4, 2, 1] : e > 8 ? [2, 1] : e > 4 ? [1] : []
}

function isInteger(e) {
    return "number" == typeof e && (!isNaN(e) && parseInt(Number(e)) === e && !isNaN(parseInt(e, 10)))
}

function autoSearchInput(e) {
    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : ".autoSearchCompetitor",
        a = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 3,
        n = $(t),
        o = n.attr("data-action");
    n.autocomplete({
        source: function(e, t) {
            $.getJSON(o, {
                keyword: e.term
            }, t)
        },
        minLength: a,
        select: e
    }), n.map((function(e, t) {
        $(t).data("ui-autocomplete")._renderItem = function(e, t) {
            $(".ui-autocomplete").addClass("customAutocompete").addClass("teamOption");
            var a = "<img alt='" + t.value + "' src='" + t.img_url + "'/>",
                n = "<span>" + t.value + "</span>";
            return $("<li></li>").data("item.autocomplete", t).append("<div class='ui-menu-item-wrapper'>" + a + n + "</div>").appendTo(e)
        }
    })), $(document).on("input", t, (function() {
        $(this).closest(".competitor-container").length > 0 && $(this).closest(".competitor-container").find(".clearValInput").val(null), $(this).closest(".tab-content.wrap-content").length > 0 && "" === $(this).val().trim() && ($(this).closest(".tab-content.wrap-content").find(".clearValInput").val(null), $(this).closest(".tab-content.wrap-content").find("select.role").val(1), $(this).closest(".tab-content.wrap-content").find("img").attr("src", "/content/images/player.png")), 0 === $(this).closest(".competitor-container").length && 0 === $(this).closest(".tab-content.wrap-content").length && $(this).closest("body").find(".clearValInput").val(null)
    }))
}

function getMobileOperatingSystem() {
    var e = navigator.userAgent || navigator.vendor || window.opera;
    return /windows phone/i.test(e) ? "Windows Phone" : /android/i.test(e) ? "Android" : /iPad|iPhone|iPod/.test(e) && !window.MSStream ? "iOS" : "unknown"
}

function deepLink(e) {
    var t = getMobileOperatingSystem();
    "Android" !== t && "iOS" !== t || (window.location = e)
}
$.getImage = function(e, t) {
    if (e.files && e.files[0]) {
        var a = new FileReader;
        a.onload = function(e) {
            t.bind({
                url: e.target.result
            })
        }, a.readAsDataURL(e.files[0])
    }
}, $.initCroppie = function(e, t, a, n) {
    var o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : "circle",
        i = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : {},
        r = arguments.length > 6 && void 0 !== arguments[6] && arguments[6];
    i.width = i.hasOwnProperty("width") ? i.width : 320, i.height = i.hasOwnProperty("height") ? i.height : 320, croppie = new Croppie(t, {
        viewport: {
            width: a,
            height: n,
            type: o
        },
        boundary: i,
        enableOrientation: !0,
        enableResize: r
    }), $.getImage(e.target, croppie), eventOfElementClicked = e, $("#myModalCroppie").modal("show").attr("style", "z-index:1061;display:block")
}, $.doAjax = function(e, t, a, n, o) {
    var i = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : null;
    return e.append("pathFileBefore", a ? a.attr("src").trim() : ""), $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "POST",
        url: n,
        data: e,
        processData: !1,
        contentType: !1,
        beforeSend: function() {
            t.text(Lang.get("common.btn_uploading_file"))
        },
        success: function(e) {
            if (200 === e.code) {
                if (o) {
                    var t = o.parents("form"),
                        r = t.find('input[name="id"]').val(),
                        s = $("#form-list-register-player .open-modal" + r),
                        c = o.next().find("img").attr("id");
                    o.next().val(e.fullPath), n === window.location.origin + "/upload/update/player-avatar" && s.find(".competitor-member-avatar").css("background-image", "url(" + e.fullPath + ")"), "avatar" === c && (s.find(".avatar").val(e.fullPath), t.find("input[name=oldUrlImg]").val(e.fullPath)), "cardBefore" === c && (s.find(".cardBefore").val(e.fullPath), t.find("input[name=oldCardBefore]").val(e.fullPath)), "cardAfter" === c && (s.find(".cardAfter").val(e.fullPath), t.find("input[name=oldCardAfter]").val(e.fullPath))
                }
                if (a) a.attr("src", e.fullPath ? e.fullPath : e.data.fullPath).css("opacity", 1);
                else {
                    var l = '<span class="btnDelete" data-id="' + e.data.id + '"><img src="' + e.data.fullPath + '" style="width: 135px" /></span>';
                    $("#chooseByBackground .imgThumbnail").prepend(l), chooseImg(), deleteImgUpload()
                }
                isFunction(i) && i(), initToastr("success", e.message)
            }
            if (500 === e.code) {
                var d = "";
                $.each(e.errors, (function(e, t) {
                    d += "- " + t
                })), initToastr("error", d)
            }
        },
        error: function(e) {
            405 !== e.status && initToastr("error", "Sorry, Error!")
        },
        complete: function() {
            o && o.val(null), t.text(Lang.get("modal.crop_upload_image.submit")), $("#myModalCroppie").modal("hide")
        }
    })
}, $.rotate = function() {
    $(document).on("click", ".rotate", (function() {
        croppie.rotate(parseInt($(this).data("deg")))
    }))
}, $.destroyCroppie = function() {
    $(document).on("hidden.bs.modal", "#myModalCroppie", (function(e) {
        $("#myModalCroppie select.viewportCroppie").hide(), inputFile && inputFile.val(""), setTimeout((function() {
            croppie.destroy()
        }), 100)
    }))
}, $(document).on("change", "select.viewportCroppie", (function() {
    var e = parseInt($(this).val()),
        t = document.getElementById("resizerCroppie");
    croppie.destroy(), 1 === e && (croppie = new Croppie(t, {
        viewport: {
            width: 240,
            height: 240,
            type: "circle"
        },
        boundary: {
            width: 320,
            height: 320
        },
        enableOrientation: !0,
        enableResize: !1
    })), 2 === e && (croppie = new Croppie(t, {
        viewport: {
            width: 240,
            height: 240,
            type: "square"
        },
        boundary: {
            width: 320,
            height: 320
        },
        enableOrientation: !0,
        enableResize: !1
    })), 3 === e && (croppie = new Croppie(t, {
        viewport: {
            width: 180,
            height: 240,
            type: "square"
        },
        boundary: {
            width: 320,
            height: 320
        },
        enableOrientation: !0,
        enableResize: !1
    })), $.getImage(eventOfElementClicked.target, croppie)
})), $(document).on("submit", "form", (function() {
    $("button[type=submit], input[type=submit]").attr("disabled", "disabled")
})), window.onpageshow = function(e) {
    e.persisted && ($("button[type=submit], input[type=submit]").removeAttr("disabled"), $("#loading-one-page").hide())
}, $.base64ImageToBlob = function(e) {
    for (var t = e.indexOf(";base64,"), a = e.substring(5, t), n = e.substr(t + 8), o = atob(n), i = new ArrayBuffer(o.length), r = new Uint8Array(i), s = 0; s < o.length; s++) r[s] = o.charCodeAt(s);
    return new Blob([i], {
        type: a
    })
}, Date.prototype.yyyymmdd = function() {
    var e = this.getMonth() + 1,
        t = this.getDate();
    return [this.getFullYear(), (e > 9 ? "" : "0") + e, (t > 9 ? "" : "0") + t].join("-")
}, $((function() {
    var e = new Date;
    $(".expiredForBlock").each((function(t, a) {
        var n = "hideDiv" + $(a).find(".close").attr("data-key");
        parseInt(localStorage.getItem(n)) <= e.getTime() && localStorage.removeItem(n), $(a).length > 0 && !localStorage.getItem(n) && ($(a).hasClass("modal") ? $(a).modal("show") : $(a).show())
    })), $(".advertising").each((function(t, a) {
        var n = $(a).attr("data-key"),
            o = "hideDiv" + n;
        parseInt(localStorage.getItem(o)) <= e.getTime() && localStorage.removeItem(o), localStorage.getItem(o) && $(".advertising." + n).attr("style", "display: none !important")
    }))
})), $(document).on("click", ".expiredForBlock .close, .expiredForBlock .btnClose", (function() {
    hideDivExpired($(this).attr("data-hour"), $(this).attr("data-key"))
})), $(document).keyup((function(e) {
    "Escape" === e.key && hideDivExpired($(".expiredForBlock .close").attr("data-hour"), $(".expiredForBlock .close").attr("data-key"))
})), $(document).on("click", ".closeAdvertising", (function() {
    hideDivExpired($(this).attr("data-hour"), $(this).closest(".advertising").attr("data-key")), $(this).closest(".advertising").attr("style", "display: none !important")
})), $(document).on("show.bs.modal", ".modal", (function() {
    var e = 1040 + 10 * $(".modal:visible").length;
    $(this).css("z-index", e), setTimeout((function() {
        $(".modal-backdrop").not(".modal-stack").css("z-index", e - 1).addClass("modal-stack")
    }), 0), $(window).width() < 601 && isIphone() && $(this).addClass("safari")
})), $(document).on("hide.bs.modal", ".modal", (function() {
    $(".modal:visible").length - 1 > 0 && setTimeout((function() {
        $("body").addClass("modal-open")
    }), 500)
})), $(document).on("click", ".notiCommonHeader .confirmInvite, #notifyAccount .confirmInvite", (function() {
    var e = $(this).attr("data-href");
    swal({
        html: Lang.get("label.notify_page.verify_linked"),
        type: "question",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.registration_league_page.refuse"),
        reverseButtons: !0
    }).then((function(t) {
        if (t.value || "cancel" === t.dismiss) {
            var a = 0;
            t.value && (a = 1), window.location.href = e.replace("val_accuracy", a)
        }
    }))
})), $(document).on("click", ".notiCommonHeader .confirmJoinLeague, #notifyAccount .confirmJoinLeague", (function() {
    var e = $(this).parents(".notiAccount"),
        t = JSON.parse(e.find(".idTeam").text()),
        a = JSON.parse(e.find(".idLeague").text()),
        n = JSON.parse(e.find(".content").attr("data-id"));
    swal({
        html: Lang.get("label.notify_page.verify_invite"),
        type: "question",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.registration_league_page.refuse"),
        reverseButtons: !0
    }).then((function(e) {
        if (e.value || "cancel" === e.dismiss) {
            t.id_notify = n, t.id_league = a, e.value ? t.status = 1 : t.status = 0;
            var o = t.competitor_id;
            void 0 !== t.old_team_obj && (delete t.old_team_obj.introduce, delete t.old_team_obj.member);
            var i = window.btoa(unescape(encodeURIComponent(JSON.stringify(t))));
            window.location.href = "/competitor/" + o + "/notify/" + i + "/update"
        }
    }))
})), $(document).on("click", ".notiCommonHeader .showEvent, #notifyAccount .showEvent", (function() {
    localStorage.removeItem("eventTriggerClick")
})), $(document).on("click", ".panel__menu.panel__menu--setting", (function() {
    $(".panel.has-menu").toggleClass("toggleClass")
})), $((function() {
    $(window).width() < 1200 && $(window).width() > 768 && $(".panel__menu.panel__menu--setting").trigger("click")
})), $(document).on("click", "a, button, p, div, i, h1, h2, h3, h4, h5, h6, span", (function(e) {
    var t = $(this).attr("href"),
        a = $(this).attr("target"),
        n = $(this).attr("type"),
        o = $(this).attr("onclick");
    void 0 !== t && "" !== t && "#" !== t && "javascript:void(0)" !== t && "javascript:void(0);" !== t && "javascript: void(0)" !== t && "javascript: void(0);" !== t && "javascript:;" !== t && "_blank" !== a && 0 !== t.indexOf("#") && $("#loading-one-page").show(), "submit" === n && $("#loading-one-page").show(), void 0 === o || -1 === o.indexOf("window.location") && -1 === o.indexOf("submit()") || $("#loading-one-page").show()
})), $(document).ajaxStart((function() {
    $("#loading-one-page").show()
})), $(document).ajaxSend((function(e, t, a) {
    (a.url.indexOf("term=") > -1 || a.url.match(/league\/package\/.*\/min-match/) || a.url.match(/ajax\/notifications/)) && $("#loading-one-page").hide()
})), $(document).on("click", "#loading-one-page, #loading-one-page-download-pdf, a.btnDownloadSampleExcelFile, a.cke_button, #cke_1_top a", (function(e) {
    $("#loading-one-page, #loading-one-page-download-pdf").hide()
})), $(document).ajaxStop((function() {
    $("#loading-one-page").hide(), $("button[type=submit], input[type=submit]").removeAttr("disabled")
})), $(document).on("click", ".notiCommonHeader .mark-as-read, #notifyAccount .mark-as-read", (function() {
    $.get($(this).attr("data-href"), (function(e) {
        200 === e.code ? ($(".notiCommonHeader .notiAccount").removeClass("unread").addClass("read"), $(".notiCommonHeader").prev().find(".badge").remove()) : initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
    })).fail((function() {
        initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
    }))
})), $(document).on("click", ".notiCommonHeader .promotionCodeNotification, #notifyAccount .promotionCodeNotification", (function() {
    copyClipboardText($(this).text()), toastr.remove()
})), $(document).ready((function() {
    var e = !1;
    $(".notiCommonHeader").on("scroll", (function() {
        var t = $(this),
            a = t.scrollTop() + t.innerHeight() - t[0].scrollHeight + 1,
            n = t.attr("data-href");
        if (a >= 0 && !e) {
            var o = t.attr("data-page"),
                i = $("#loading-one-page").html(),
                r = "";
            t.find("li").each((function(e, t) {
                $(t).hasClass("wrapLoading") || (r += $(t).closest("li").prop("outerHTML"))
            })), $.ajax({
                type: "GET",
                url: n,
                data: {
                    page: o
                },
                beforeSend: function() {
                    t.html(r + '<li class="wrapLoading" style="padding:50px">' + i + "</li>")
                },
                success: function(a) {
                    200 === a.code && "" !== a.data.html ? (t.attr("data-page", a.data.page), t.html(r + a.data.html)) : (e = !0, t.html(r))
                },
                error: function(e) {
                    404 === e.status && initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
                }
            })
        }
    }))
})), $(document).on("click", ".notiCommonHeader .notiAccount.unread .content a:not(.exception), #notifyAccount .notiAccount.unread .content a:not(.exception)", (function() {
    localStorage.setItem("readNotificationAccount" + $("body").attr("data-user-id"), $(this).closest(".content").attr("data-id"))
})), $(document).ready((function() {
    var e = $("body").attr("data-user-id"),
        t = localStorage.getItem("readNotificationAccount" + e);
    t && (actionAjaxReadNotify(t), localStorage.removeItem("readNotificationAccount" + e))
})), $(document).on("click", ".btnCommonDeleteItem", (function(e) {
    var t = $(this),
        a = new FormData;
    a.append("idItem", t.attr("data-id")), swal({
        html: Lang.get("label.league_option_donor_page.question"),
        type: "question",
        showCancelButton: !0,
        focusCancel: !0,
        cancelButtonText: Lang.get("label.button.destroy"),
        confirmButtonText: Lang.get("label.button.accept"),
        reverseButtons: !0
    }).then((function(e) {
        e.value && $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: t.attr("data-action"),
            data: a,
            processData: !1,
            contentType: !1,
            success: function(e) {
                200 === e.code && (t.closest("tr").remove(), initToastr("success", e.message))
            },
            error: function(e) {
                var t = e.responseJSON.errors,
                    a = "";
                $.each(t, (function(e, t) {
                    a += "- " + t + "<br/>"
                })), initToastr("error", a, {
                    timeOut: 1e4
                })
            }
        })
    }))
})), $((function() {
    initCKEditor($("textarea.ckeditorCustom"))
})), $(document).on("click", '.wrapperAccordion a[data-toggle="collapse"]', (function() {
    var e = $(this).closest(".panel-heading"),
        t = $(this).closest(".panel").find(".panel-collapse");
    e.hasClass("active") ? (e.removeClass("active"), t.removeClass("in")) : (e.addClass("active"), t.addClass("in"))
})), $(document).on("change", ".clearable", (function() {
    $(this)[tog(this.value)]("x")
})).on("mousemove", ".x", (function(e) {
    $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX")
})).on("touchstart click", ".onX", (function(e) {
    e.preventDefault(), $(this).removeClass("x onX").val("").change()
})), $(document).on("click", "#detailMatchModal .wrapVoteMatch .wrapVote a", (function() {
    var e = $(this),
        t = e.closest("#detailMatchModal"),
        a = e.attr("data-team"),
        n = t.find("#viewMatch .id-match").text().trim(),
        o = t.find(".wrapVoteMatch").attr("data-url-store");
    $("#detailMatchModal .wrapVoteMatch .wrapVote a").removeClass("active"), toastr.remove();
    var i = new FormData;
    i.append("idMatch", n), i.append("idTeam", a), i.append("currentUrl", window.location.href);
    var r = "preventSpamClickVoteMatch",
        s = getWithExpiry(r);
    s ? parseInt(s) < 10 ? (actionAjaxSaveVote(i, e, o), setWithExpiry(r, s + 1, 6e4)) : (setWithExpiry(r, s + 1, 36e5), initToastr("warning", Lang.get("messages.prevent_spam_send_invite"), {
        timeOut: 25e3
    })) : (actionAjaxSaveVote(i, e, o), setWithExpiry(r, 1, 6e4))
})), $(document).on("click", ".userRequestLinkedToPlayer:not(.requested)", (function() {
    var e = $(this),
        t = e.closest(".content").attr("data-id"),
        a = e.find(".player").text().trim(),
        n = e.find(".team").text().trim(),
        o = e.attr("data-url-player"),
        i = e.attr("data-url-competitor"),
        r = e.attr("data-url-request"),
        s = {
            data: JSON.parse(e.attr("data-send")),
            idNotify: t
        };
    actionAjaxReadNotify(t), swal({
        html: Lang.get("modal.popup_request_linked", {
            player: "<a href='" + o + "'>" + a + "</a>",
            team: "<a href='" + i + "'>" + n + "</a>"
        }),
        type: "question",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.registration_league_page.refuse"),
        reverseButtons: !0
    }).then((function(t) {
        t.value && (s.status = 1), "cancel" === t.dismiss && (s.status = 0), (t.value || "cancel" === t.dismiss) && $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
            },
            type: "GET",
            url: r,
            data: s,
            success: function(t) {
                e.addClass("requested"), 200 === t.code && initToastr("success", t.message), 404 === t.code && initToastr("error", t.message)
            },
            error: function(e) {
                initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
            }
        })
    }))
})), $(document).on("click", ".feedbakcRequestLinked", (function() {
    var e = $(this),
        t = e.closest(".content").attr("data-id"),
        a = e.find(".player").text().trim(),
        n = e.find(".team").text().trim(),
        o = e.attr("data-url-player"),
        i = e.attr("data-url-competitor"),
        r = e.attr("data-url-request"),
        s = JSON.parse(e.attr("data-account"));
    actionAjaxReadNotify(t);
    var c = new FormData;
    c.append("data", JSON.parse(e.attr("data-send"))), c.append("idNotify", t), swal({
        html: Lang.get("modal.popup_feedback_linked", {
            player: "<a href='" + o + "'>" + a + "</a>",
            team: "<a href='" + i + "'>" + n + "</a>",
            fullname: s.fullname,
            phone: s.phone,
            mail: s.mail,
            class1: s.fullname ? "" : "hidden",
            class2: s.phone ? "" : "hidden"
        }),
        type: "question",
        customClass: "managerVerifyLinked",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.registration_league_page.refuse"),
        reverseButtons: !0
    }).then((function(e) {
        e.value && c.append("status", 1), "cancel" === e.dismiss && c.append("status", 0), (e.value || "cancel" === e.dismiss) && $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
            },
            type: "POST",
            url: r,
            dataType: "JSON",
            data: c,
            contentType: !1,
            processData: !1,
            success: function(e) {
                200 === e.code && initToastr("success", e.message), 404 === e.code && initToastr("error", e.message)
            },
            error: function(e) {
                initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
            }
        })
    }))
})), $(document).on("click", ".notiCommonHeader .notiVerifyAgency, #notifyAccount .notiVerifyAgency", (function() {
    var e = $(this),
        t = e.closest(".content").attr("data-id"),
        a = e.attr("data-id");
    t && actionAjaxReadNotify(t), swal({
        html: Lang.get("modal.verify_agency_statistic"),
        type: "question",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.button.close"),
        reverseButtons: !0
    }).then((function(e) {
        e.value && $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
            },
            type: "GET",
            url: "/agency-statistic/update",
            data: {
                status: 1,
                id: a
            },
            success: function(e) {
                200 === e.code && initToastr("success", e.message), 404 === e.code && initToastr("error", e.message)
            },
            error: function(e) {
                initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
            }
        })
    }))
})), $(document).on("click", ".league-favourite input", (function() {
    var e = $(this);
    if ($("body").attr("data-user-id")) {
        var t = e.attr("data-id"),
            a = e.is(":checked") > 0 ? 1 : 2,
            n = "preventSpamClickFavourite",
            o = getWithExpiry(n);
        o ? parseInt(o) < 10 ? (actionAjaxFavouriteLeague(e, a, t), setWithExpiry(n, o + 1, 6e4)) : (setWithExpiry(n, o + 1, 36e5), initToastr("warning", Lang.get("messages.prevent_spam_send_invite"), {
            timeOut: 25e3
        })) : (actionAjaxFavouriteLeague(e, a, t), setWithExpiry(n, 1, 6e4))
    } else e.prop("checked", !1), initToastr("info", Lang.get("messages.please_login", {
        url: "/account/login"
    }))
})), $(document).on("click", ".notiCommonHeader .showMatchIsComing, #notifyAccount .showMatchIsComing", (function() {
    var e = $(this).attr("data-ids").split(",");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
        },
        type: "GET",
        url: "/account/notifications/matchs-coming",
        data: {
            ids: e
        },
        success: function(e) {
            200 === e.code && ($("#modalShowMatchsComing").modal("show"), $("#modalShowMatchsComing #content").html(e.data)), 404 === e.code && initToastr("error", e.message)
        },
        error: function(e) {
            initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
        }
    })
})), $(document).on("mouseenter", ".modal#updateMember .avatar-position label", (function() {
    $(this).parent().find(".removeCard").css("display", "inline-block")
})).on("mouseleave", ".modal#updateMember .avatar-position label", (function() {
    var e = $(this);
    setTimeout((function() {
        e.parent().find(".removeCard").hide()
    }), 3e3)
})), $(document).on("click", ".modal#updateMember .avatar-position .removeCard", (function() {
    var e = $(this);
    swal({
        html: Lang.get("messages.confirm_del_img_graphic"),
        type: "question",
        showCancelButton: !0,
        focusCancel: !0,
        cancelButtonText: Lang.get("label.button.destroy"),
        confirmButtonText: Lang.get("label.button.accept"),
        confirmButtonColor: "#f74444",
        reverseButtons: !0
    }).then((function(t) {
        if (t.value) {
            var a = new FormData;
            a.append("type", e.attr("data-type")), $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "POST",
                url: e.attr("data-action"),
                data: a,
                processData: !1,
                contentType: !1,
                success: function(t) {
                    200 === t.code && (initToastr("success", t.message), e.prev().find("img").attr("src", t.data), e.remove())
                },
                error: function(e) {
                    initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
                }
            })
        }
    }))
})), $(document).on("click", ".notiCommonHeader .registerLeague, #notifyAccount .registerLeague", (function() {
    var e = $(this);
    swal({
        title: Lang.get("modal.show_feedback.title") + ":",
        html: e.attr("data-feedback") ? e.attr("data-feedback") : "<i>" + Lang.get("modal.show_feedback.no_feedback") + "</i>",
        type: "info",
        customClass: "swalShowFeedback",
        showCancelButton: !0,
        showConfirmButton: !1,
        cancelButtonText: Lang.get("label.button.close")
    })
})), $(document).on("click", ".notiCommonHeader .confirmMatchFriendly, #notifyAccount .confirmMatchFriendly", (function() {
    var e = $(this).attr("data-href");
    swal({
        html: Lang.get("label.notify_page.verify_match_friendly"),
        type: "question",
        showCancelButton: !0,
        confirmButtonText: Lang.get("label.button.accept"),
        cancelButtonText: Lang.get("label.registration_league_page.refuse"),
        reverseButtons: !0
    }).then((function(t) {
        if (t.value || "cancel" === t.dismiss) {
            var a = 0;
            t.value && (a = 1), $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            }), $.post(e, {
                accuracy: a
            }).done((function(e) {
                200 === e.code && (a ? (initToastr("success", e.message), setTimeout((function() {
                    window.location.href = e.data.url
                }), 2e3)) : initToastr("info", e.message))
            }))
        }
    }))
})), $(document).on("click", ".downloadFileByJob:not(.notWaitingDownload)", (function() {
    toastr.remove();
    var e = $("#loading-one-page").clone();
    e.attr("id", "loading-one-page-download-pdf"), $("body #AppContent").append(e), $("#loading-one-page").remove(), $("#loading-one-page-download-pdf").show(), initToastr("info", Lang.get("messages.please_wait"), {
        timeOut: 1e6
    }), $(".downloadFileByJob").attr("disabled", "disabled").addClass("disabled-linkTaga");
    var t = [],
        a = $(this),
        n = a.attr("data-download"),
        o = parseInt(a.attr("data-count")),
        i = parseInt(a.attr("data-max"));
    try {
        t = JSON.parse(n)
    } catch (e) {
        t.push(n)
    }
    var r = t.length,
        s = 0;
    o > i ? $.get(a.attr("data-href"), (function() {
        var e = 0,
            a = setInterval((function() {
                if (++e > 120 || s >= r) return clearInterval(a), toastr.remove(), initToastr("success", Lang.get("messages.download_success_all"), {
                    timeOut: 1e8
                }), $(".downloadFileByJob").removeAttr("disabled").removeClass("disabled-linkTaga"), void $("#loading-one-page-download-pdf").hide();
                var n = t[s];
                $.get(n, (function(t) {
                    if (404 !== t.code) {
                        s++, r > 1 ? initToastr("success", Lang.get("messages.download_success_part", {
                            number: s
                        }), {
                            timeOut: 1e8
                        }) : (toastr.remove(), $("#loading-one-page-download-pdf").hide(), e = 0, $(".downloadFileByJob").removeAttr("disabled").removeClass("disabled-linkTaga"), initToastr("success", Lang.get("messages.download_success"), {
                            timeOut: 1e8
                        }), clearInterval(a));
                        var o = document.createElement("a");
                        o.href = n, o.click(), window.URL.revokeObjectURL(n), setTimeout((function() {
                            $.post({
                                url: n,
                                beforeSend: function(e) {
                                    e.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"))
                                }
                            })
                        }), 3e3)
                    }
                }))
            }), 1e4)
    })) : $.ajax({
        url: a.attr("data-href"),
        method: "GET",
        xhrFields: {
            responseType: "blob"
        },
        success: function(e, t, a) {
            toastr.remove(), $("#loading-one-page-download-pdf").hide(), $(".downloadFileByJob").removeAttr("disabled").removeClass("disabled-linkTaga"), initToastr("success", Lang.get("messages.download_success"));
            var n = a.getResponseHeader("Content-Disposition"),
                o = "";
            if (n) {
                var i = n.match(/filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/);
                i && i[1] && (o = i[1].replace(/['"]/g, ""))
            }
            var r = document.createElement("a"),
                s = window.URL.createObjectURL(e);
            r.href = s, r.download = o, r.click(), window.URL.revokeObjectURL(s)
        },
        error: function() {
            toastr.remove(), $("#loading-one-page-download-pdf").hide(), $(".downloadFileByJob").removeAttr("disabled").removeClass("disabled-linkTaga"), initToastr("error", Lang.get("messages.error_get_data_by_ajax"))
        }
    })
}));