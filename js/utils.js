function nospace(e) {
	var t = new RegExp(/^[ ]+/g),
		o = e.replace(t, "");
	return o
}

function getCookie(e) {
	var t = document.cookie.match(new RegExp("(?:^|; )" + e.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"));
	return t ? decodeURIComponent(t[1]) : void 0
}

function setCookie(e, t, o) {
	o = o || {};
	var i = o.expires;
	if("number" == typeof i && i) {
		var r = new Date;
		r.setTime(r.getTime() + 1e3 * i), i = o.expires = r
	}
	i && i.toUTCString && (o.expires = i.toUTCString()), t = encodeURIComponent(t);
	var n = e + "=" + t;
	for(var c in o) {
		n += "; " + c;
		var a = o[c];
		a !== !0 && (n += "=" + a)
	}
	document.cookie = n
}

function priceFormat(e) {
	var t = e,
		o = "";
	if(e >= 0)
		do {
			var i = t % 1e3;
			parseInt(t / 1e3) % 1e3 != 0 && (0 == i ? i = "000" : 10 > i ? i = "00" + i : 100 > i && (i = "0" + i)), t = parseInt(t / 1e3), o = i + " " + o
		} while (t % 1e3 != 0);
	return o
}

function sendJson(data, url, callbackSuccess, callbackError) {
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		success: function(responseData) {
			console.log(responseData);
			var json = eval("(" + responseData + ")");
			"ok" == json.code ? (console.log("success"), console.log(json.data), null != callbackSuccess && callbackSuccess(responseData)) : (console.log("failed"), console.log(json.data), null != callbackError && callbackError(responseData))
		},
		error: function(e) {
			console.log(e), null != callbackError && callbackError(e)
		},
		dataType: "html"
	})
}
var delay = function() {
	var e = 0;
	return function(t, o) {
		clearTimeout(e), e = setTimeout(t, o)
	}
}();
$(document).ready(function() {
	$("#fronts-color input#hidden_1").val(getCookie("container_color1")), $("#fronts-color input#hidden_2").val(getCookie("container_color2")), $("#kitchens-color input#hidden_1").val(getCookie("kitchens_container_color1")), $("#kitchens-color input#hidden_2").val(getCookie("kitchens_container_color2")), $('#fronts-color input[type="submit"]').click(function() {
		setCookie("container_color1", "" + $("#fronts-color input#hidden_1").val()), setCookie("container_color2", "" + $("#fronts-color input#hidden_2").val())
	}), $('#kitchens-color input[type="submit"]').click(function() {
		setCookie("kitchens_container_color1", "" + $("#kitchens-color input#hidden_1").val()), setCookie("kitchens_container_color2", "" + $("#kitchens-color input#hidden_2").val())
	}), $("input.filter-submit").click(function() {
		var e = "?";
		return $("label.label-filter.l-check+input").each(function() {
			void 0 != $(this).attr("name") && (e += $(this).attr("name") + "=" + $(this).attr("value") + "&")
		}), $("#fronts-color, #kitchens-color").attr("action", e), $("#fronts-color, #kitchens-color").submit(), !1
	}), $("label.label-filte.r").click(function() {
		$(this).toggleClass("l-check")
	}), $(".plus").mouseup(function() {
		var e = $(this).parent().prev().val();
		e++;
		var t = parseInt($("#moduleModalPrice").text().replace(/\s+/g, ""));
		$("#TotalmoduleModalPrice").text(t * e + " руб")
	}), $(" .minus").mouseup(function() {
		var e = $(this).parent().prev().val();
		e--, 1 > e && (e = 1);
		var t = parseInt($("#moduleModalPrice").text().replace(/\s+/g, ""));
		$("#TotalmoduleModalPrice").text(t * e + " руб")
	}), $(".color_item_mod").click(function() {
		$(".color_item_mod img").css("border", "none"), $(this).find("img").css("border", "5px solid #ffc90d"), $("#hidden_1").attr("value", $(this).attr("id"))
	}), $(".color_item").mouseup(function() {
		$(".color_item img").css("border", "none"), $(this).find("img").css("border", "5px solid #ffc90d"), $("#hidden_2").attr("value", $(this).attr("id").substr(9))
	}), $(".black-over").click(function() {
		$(".black-over").fadeToggle(1e3), $("#color_up_down").click()
	}), $("#color_select").mouseup(function(e) {
		1 == e.which && $(".black-over").fadeToggle(1e3)
	}), $(".qp_item-colors .qp_item-color-item .inner,.color_item_mod,.color_item,#colors_module,#fasad_module").hover(function() {
		$(this).find(".qp_item-color-item-title").fadeIn(300);
		var e = $(this).find(".qp_item-color-item-title").width() + 10,
			t = -(e - $(this).width()) / 2,
			o = e / 2 - 8;
		$(this).find(".qp_item-color-item-title").css("left", t + "px"), $(this).find(".tr").css("left", o + "px")
	}, function() {
		$(this).find(".qp_item-color-item-title").fadeOut(300)
	}), $(".qp_size.standart-size").click(function() {
		$(this).parent().removeClass("chk"), $("input#extra-size-width").val("600"), $("input#extra-size-height").val("3000")
	}), $(".qp_size.custom-size").click(function() {
		$(this).parent().addClass("chk")
	}), $("label.label-filter").click(function() {
		$(this).toggleClass("l-check")
	}), $(window).resize(function() {
		if($(".qp_item-list-cell")) {
			var e = $(".qp_item-list-cell").width();
			$(".qp_item-list-cell .inner").css("height", 1.13 * e + "px")
		}
		if($(".tabletops_item-list-cell")) {
			var e = $(".tabletops_item-list-cell").width();
			$(".tabletops_item-list-cell .inner").css("height", 1.13 * e + "px")
		}
	}), $(window).resize()
}), $(document).ready(function() {
	$("#designer").length && $("#designer").validate({
		rules: {
			designer_popup_name: {
				required: !0
			},
			designer_popup_phone: {
				required: !0
			}
		},
		submitHandler: function(e) {
			var t = $(e).attr("action");
			$.ajax({
				type: "POST",
				url: t,
				data: $(e).serialize(),
				success: function() {
					alert("Заявка успешно отправлена.")
				}
			})
		}
	}), 
	jQuery.validator.addMethod("phonegroup", function () {
		/*var j = 0;
        $('.phone-group').each(function(i,elem) {
			if(i == 1) {
				return false;
			}
			if($(elem).val() != ''){j++;}
		});
		if(j >= 1){
		    alert ("y");
			return true;
		}
        else{
            alert ("n");
			return false;
		}*/
		p1 = $("#calculatePrice").find("input[name='calculate_price_popup_email']");
		p2 = $("#calculatePrice").find("input[name='calculate_price_popup_phone']");
		if((p1.val() == "")&&(p2.val() == "")){
			return false;
		}
        else{
			return true;
		}
    }, "Введите номер телефона или E-mail"),
	$("#calculatePrice").length && $("#calculatePrice").validate({
		rules: {
			calculate_price_popup_name: {
				required: !0
			},
			calculate_price_popup_phone: {
				phonegroup: true
			},
			calculate_price_popup_email: {
				phonegroup: true
			}
		},
		submitHandler: function(e) {
			var t = $(e).attr("action");
			$.ajax({
				url: t,
				type: "POST",
				data: new FormData($(e)[0]),
				processData: !1,
				contentType: !1,
				success: function() {
					$('#successSend_a').trigger('click');
					$('.closeModal').trigger('click');
					$('#calculatePrice').trigger('reset');
					$(e).find('#file-name').empty();
					$(e).find('.file-upload').hide();
					$(e).find('div[number="1"]').show();
				}
			})
		}
	}), 
	
	jQuery.validator.addMethod("phonegroup2", function () {
		p1 = $("#calculatePrice2").find("input[name='calculate_price_popup_email']");
		p2 = $("#calculatePrice2").find("input[name='calculate_price_popup_phone']");
		if((p1.val() == "")&&(p2.val() == "")){
			return false;
		}
        else{
			return true;
		}
    }, "Введите номер телефона или E-mail"),
	$("#calculatePrice2").length && $("#calculatePrice2").validate({
		rules: {
			calculate_price_popup_name: {
				required: !0
			},
			calculate_price_popup_phone: {
				phonegroup2: true
			},
			calculate_price_popup_email: {
				phonegroup2: true
			}
		},
		submitHandler: function(e) {
			var t = $(e).attr("action");
			$.ajax({
				url: t,
				type: "POST",
				data: new FormData($(e)[0]),
				processData: !1,
				contentType: !1,
				success: function() {
					$('#successSend_a').trigger('click');
					$('#calculatePrice2').trigger('reset');
					$(e).find('#file-name').empty();
					$(e).find('.file-upload').hide();
					$(e).find('div[number="1"]').show();
				}
			})
		}
	}), 
	$("#call-form").length && $("#call-form").validate({
		rules: {
			name: {
				required: !0
			},
			phone: {
				required: !0
			}
		},
		submitHandler: function(e) {
			var t = $(e).attr("action");
			$.ajax({
				type: "POST",
				url: t,
				data: $(e).serialize(),
				success: function() {
					$('#successSend_a').trigger('click');
					$('#closeModal').trigger('click');
					$("#call-form").trigger('reset');
				}
			})
		}
	})
	$("#call-designer").length && $("#call-designer").validate({
		rules: {
			calculate_price_popup_name: {
				required: !0
			},
			calculate_price_popup_phone: {
				required: !0
			}
		},
		submitHandler: function(e) {
			var t = $(e).attr("action");
			$.ajax({
				type: "POST",
				url: t,
				data: $(e).serialize(),
				success: function() {
					$('#successSend_a').trigger('click');
					$('.closeModal').trigger('click');
					$("#call-designer").trigger('reset');
				}
			})
		}
	})
}), $(window).load(function() {
	$(".loader").remove()
}), jQuery.extend(jQuery.validator.messages, {
	required: "Это поле необходимо заполнить",
	required2: "Одно из полей должно быть заполнено",
	remote: "Исправьте это поле чтобы продолжить",
	email: "Введите правильный email адрес.",
	url: "Введите верный URL.",
	date: "Введите правильную дату.",
	dateISO: "Введите правильную дату (ISO).",
	number: "Введите число.",
	digits: "Введите только цифры.",
	creditcard: "Введите правильный номер вашей кредитной карты.",
	equalTo: "Повторите ввод значения еще раз.",
	accept: "Пожалуйста, введите значение с правильным расширением.",
	maxlength: jQuery.validator.format("Нельзя вводить более {0} символов."),
	minlength: jQuery.validator.format("Должно быть не менее {0} символов."),
	rangelength: jQuery.validator.format("Введите от {0} до {1} символов."),
	range: jQuery.validator.format("Введите число от {0} до {1}."),
	max: jQuery.validator.format("Введите число меньше или равное {0}."),
	min: jQuery.validator.format("Введите число больше или равное {0}.")
});