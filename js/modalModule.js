/**
*	Скрипт работы с модальными окнами в разделе модуль, фасад
**/
//-------------Фильтр----------------->
$(document).ready(function(){
	var PAGE = $("#page").html();
	PAGE == 'modal'? $("#filtr_module").show() : $("#filtr_front").show();
	arr = jQuery.parseJSON($("#all_filtr").html());
	var i = 0;
	var check_count = 0;
	$.each(arr,  function(key, val){
		$("#filtr_all").prop("checked", false);
		$(".f_all").removeClass("l-check");
		var checked = $("#filtr_" + i).prop("checked");	
		PAGE == 'modal' ? p = val.replace(/\s+/g, '') : p = val.split(" ");
		if(checked == true){
			$("." + p).show();
			$("#filtr_" + i+"-inp").val("filtr_" + i);
			check_count ++;
		}
		else{
			$("." + p).hide();
			$("#filtr_" + i+"-inp").val("");
		}
		i++;
	})
	if(check_count == 0){
		arr = jQuery.parseJSON($("#all_filtr").html());
		$.each(arr,  function(key, val){
			PAGE == 'modal' ? p = val.replace(/\s+/g, '') : p = val.split(" ");
			$("." + p).show();
		})
	}
});
$(".filtr-check").click(function(){
	var PAGE = $("#page").html();
	arr = jQuery.parseJSON($("#all_filtr").html());
	var i = 0;
	var check_count = 0;
	$.each(arr,  function(key, val){
		$("#filtr_all").prop("checked", false);
		$(".f_all").removeClass("l-check");
		var checked = $("#filtr_" + i).prop("checked");
		PAGE == 'modal' ? p = val.replace(/\s+/g, '') : p = val.split(" ");
		if(checked == true){
			$("." + p).show();
			$("#filtr_" + i+"-inp").val("filtr_" + i);
			check_count ++;
		}
		else{
			$("." + p).hide();
			$("#filtr_" + i+"-inp").val("");
		}
		i++;
	})
	if(check_count == 0){
		var j = 0;
		$.each(arr,  function(key, val){
			PAGE == 'modal' ? p = val.replace(/\s+/g, '') : p = val.split(" ");
			$("." + p).show();
			j++;
		})
	}
})
$("#filtr_all").click(function(){
	var PAGE = $("#page").html();
	arr = jQuery.parseJSON($("#all_filtr").html());
	var i = 0;
	$.each(arr,  function(key, val){
		$("#filtr_"+i).prop("checked", false);
		$(".r").removeClass("l-check");
		PAGE == 'modal' ? p = val.replace(/\s+/g, '') : p = val.split(" ");
		$("." + p).show();
		i++;
	})
})

//---------Выбор цвета----------------->
  $(".color_item_mod").click(function(event){
	if(event.target.nodeName == 'IMG') {
		$(".color_item_mod").css("border", "none");
		var color_id = $(this).attr("id").substr(9);
		$("input[name='color_select_module']").val(color_id);
		/*var url = "<?php echo Yii::app()->createAbsoluteUrl("catalog/setKitchenModuleColor"); ?>";
		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: {module_color_id: data},
		});*/
	}
});
$(".color_item").click(function(){
	var PAGE = $("#page").html();
	if(event.target.nodeName == 'IMG') {
		$(".color_item").css("border", "none");
		$("div.milling").remove();
		var idColor = $(this).attr("id").substr(9);
		var idFront = $('#frontModalItemId').val();
		if(idColor != ""){
			$.ajax({
				type: "POST",
				url: "/catalog/frontColorPrice",
				dataType: "json",
				data: {idFront: idFront, idColor: idColor},
				success: function(data){
					if(data.price > 0){
						if(PAGE == 'modal'){
							$("input[name='color_select_front']").val(idColor);
							$("input[name='moduleFasadPrice_inp']").val(data.price);
						}
						else{
							$("#front-modal .data-price").html(data.price);
						}						
						updatefrontModalPrice();
						updatefrontModalTotalPrice();
						$.each(data.millingsFront,function(key,milling){
							keyGroup = "milling";
							if(key == 0){
								$("#frontModalOptions").append('<div class="milling"><p class="h4">Фрезеровки</p><div class="data-group" id="' + keyGroup + '"></div><hr></div>');
							}
							option_img = '<img src="../images/frez/'+ milling["id"] + '.png" width="20" height="20">';
							if(idFront <= 3){
								optionPrice = milling["price"] * 10000 - data.price;
							}else{
								optionPrice = milling["price"] - data.price;
							}
							if(optionPrice >= 0){
								$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" onClick="clickOption(this)" >'+ option_img +' <input type="text" hidden="hidden" class="data-price" value="' + optionPrice + '"><input hidden="hidden" name=options[] type="checkbox" value="' + milling["id"] + '"><span class="ch-o" style="white-space: normal;">' + milling["title"] + '</span></a>')
							}
						});
						$("#milling").find(':first-child').removeClass("btn-default").addClass("btn-success").find("input[type=checkbox]").prop("checked", true);
					}
					else{
						$("#front-modal .data-price").html(0);
						updatefrontModalPrice();
						updatefrontModalTotalPrice();
					}
				},
				error: function(jqxhr, status, errorMsg){
					alert("Ошибка обработки!");
				}
			});
			$.ajax({
				type: "POST",
				url: "/catalog/setKitchenModuleColor",
				dataType: "json",
				data: {front_color_id: idColor},
				error: function(jqxhr, status, errorMsg){
					alert("Ошибка обработки!");
				}
			});
		}
		else{
			$("input[name='moduleFasadPrice_inp']").val(0);
			updatefrontModalPrice();
			updatefrontModalTotalPrice();
		}
	}
})

//--------ФОРМИРОВАНИЕ МОДАЛЬНОГО ОКНА, РАСЧЕТ ЦЕН И ДОБАВЛЕНИЕ В КОРЗИНУ------>
$('span.plus').click(function(){
	if(parseInt($('input#frontModalItemQuantity').val())+1<100){ $('input#frontModalItemQuantity').val(parseInt($('input#frontModalItemQuantity').val())+1); updatefrontModalPrice(); updatefrontModalTotalPrice();}
});
$('span.minus').click(function(){
	if(parseInt($('input#frontModalItemQuantity').val())-1>0){$('input#frontModalItemQuantity').val(parseInt($('input#frontModalItemQuantity').val())-1); updatefrontModalPrice(); updatefrontModalTotalPrice();}
});

function openModuleModal(id_mod, title,image, price, module_price_color, elem, m_prepay, img_alt) {
	var desc = $("#module-"+id_mod+" .data-description").html();
	var front_title = $(elem).find("#front_title").html();
	$(".color_item_mod img").css("border", "none");
	$(".color_item img").css("border", "none");
	$("#frontModalItemQuantity").val(1);
	$("#frontModalItemId").val(id_mod);
	$("#moduleModalTitle").html(title);
	$("#moduleModalImage").prop("src", image);
	$("#moduleModalImage").prop("alt", img_alt);
	$("#moduleModalImage").parent().prop("href", image);
	$("#moduleModalDesc").html(desc);
	$("#moduleModalPrice").html(price + " р.");
	$("#front-modal .data-price").html(price);
	$("#frontModalOptions").html("");
	$("#fasadModalOptions").html("");
	$("#fasadModalTitle").html(front_title);
	$("#moduleModalPrice_inp").val(module_price_color);
	$("#moduleModalPricePrepay_inp").val(module_price_color * m_prepay / 100);
	
	$("#id_color_29.color_item_mod img").css("border", "5px solid rgb(255, 201, 13)");
	$("#id_color_.color_item img").css("border", "5px solid rgb(255, 201, 13)");
	
	var options = (eval("(" + $(elem).find(".data-options").html() + ")"));
	addOption(options,'frontModalOptions');
	
	$("#frontModalItemQuantity").change(function () {
		updatefrontModalTotalPrice();
	});
}

function openFrontModal(id, title, price, image, blockId, img_alt) {
	desc = $("#" + blockId).find(".data-description").html();
	$(".color_item img").css("border", "none");
	if(id <= 3){
		$("#front_width").val(0);
		$("#front_length").val(0);
		$("#wxh").show();
		p = $("#" + blockId).find(".data-nostd").html();
		$("#range").html(p);
		$("#coefficient").html(price);
		price = price * 100 * 100;
		p = jQuery.parseJSON($("#" + blockId).find(".data-nostd").html());
		$("#front_width").val(p.min_w);
		$("#front_length").val(p.min_h);
		$('#nostdW').html("от "+ p.min_w +" мм до "+ p.max_w +" мм");
		$('#nostdH').html("от "+ p.min_h +" мм до "+ p.max_h +" мм");
	}
	else{
		$("#wxh").hide();
	}

	$("#frontModalTitle").html(title);
	$("#frontModalPrice").html(price + " руб");
	$("#front-modal .data-price").html(price);
	$("#frontModalTotalPrice").html(price + " руб");
	$("#frontModalImage").prop("src", image);
	$("#frontModalImage").prop("alt", img_alt);
	$("#frontModalImage").parent().prop("href", image);
	$("#frontModalItemQuantity").val(1);
	$("#frontModalItemId").val(id);
	$("#frontModalOptions").html("");
	$("#moduleModalDesc").html(desc);

	var options = (eval("(" + $("#" + blockId).find(".data-options").html() + ")"));
	addOption(options,"frontModalOptions");

	$("#frontModalItemQuantity").change(function () {
		updatefrontModalTotalPrice();
	} );
	
}

function addOption(options, block){
	$.each(options, function (keyGroup, group) {
		var keyGroup = keyGroup;
		$("#" + block).append('<p class="h4 opt_title"></p><div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div><hr>');
		$.each(group, function (key, object) {
			if ((object["is_enabled"]) && (keyGroup != 'no_standard')) {
				if(object["price"] >= 0){
				    $(".opt_title").html(object["title"])
					$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" onClick="clickOption(this)" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="../images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
				}
			}
		});
	})
	updatefrontModalPrice();
	updatefrontModalTotalPrice();
}

function clickOption(e) {
	var thisButton = $(e);
	
	if (thisButton.hasClass("btn-default")) {
		thisButton.parent().find("input[type=checkbox]").prop("checked", false);
		thisButton.parent().find(".btn-success").removeClass("btn-success").addClass("btn-default");
		thisButton.removeClass("btn-default").addClass("btn-success").find("input[type=checkbox]").prop("checked", true);

	} else {
		thisButton.removeClass("btn-success").addClass("btn-default").find("input[type=checkbox]").prop("checked", false);
	}

	//$("#moduleModalPrice").html(priceFormat(price) + " руб");
	updatefrontModalPrice();
	updatefrontModalTotalPrice();
}

function updatefrontModalTotalPrice() {
	var PAGE = $("#page").html();
	if(PAGE == 'modal'){
		var priceModule = parseInt($("#frontModalPrice").html().replace(/ /g, ''));
		var priceFront = parseInt($("input[name='moduleFasadPrice_inp']").val());
		var fronts = (eval("(" + $(".data-fronts").html() + ")"));
		$.each(fronts, function (key, object) {
			if(object["is_enabled"]==1){
				priceFront += priceFront * object["count"];
			}
		});
		price = priceModule + priceFront;
		var quantity = $("#frontModalItemQuantity").val();
		$("#frontModalTotalPrice").html(priceFormat(price * quantity) + " руб");
		$("input[name='moduleModalPrice_inp']").val(price * quantity);	
	}else{
		var price = parseInt($("#frontModalPrice").html().replace(/ /g, ''));
		var quantity = $("#frontModalItemQuantity").val();
		$("#frontModalTotalPrice").html(priceFormat(price * quantity) + " руб");
		$("input[name='moduleModalPrice_inp']").val(price * quantity);	
	}
}

function updatefrontModalPrice() {
	var price = parseInt($("#front-modal .data-price").html().replace(/ /g, ''));

	var frontModal = $("#front-modal");
	var options = frontModal.find("input[type=checkbox]");


	$.each(options, function (key, object) {

		var $object = $(object);

		if ($object.prop("checked")) {
			price += parseInt($object.parent().find(".data-price").val());
		}
	});
	$("#frontModalPrice").html(priceFormat(price) + " руб");
}
function addToCart(url) {
	if($("#front-modal .data-price").html() > 0){
		$.ajax({
			type: "POST",
			url: '/add/' + url,
			dataType: "json",
			data: $("#front-form").serialize(),
			success: function(data){
				p = jQuery.parseJSON(data.data);
				var count  = parseInt($("#shopping-cart-quantity").text()) + parseInt(p.quantity);
				$("#shopping-cart-quantity").text(count);
				var price = parseInt($("#shopping-cart-price").text().replace(/\s+/g, '')) + parseInt(p.quantity) * parseInt(p.price);
				$("#shopping-cart-price").text(price);
				alert('Товар добавлен в корзину');
			},
			error: function(){
				alert("Ошибка при добавлении");
			}
		});
		$("#front-modal").modal('hide');
	}
	else{
		alert("Цвет не выбран не доступен для данного фасада");
	}
}

//--------------ФУНКЦИИ НЕСТАНДАРТНОГО ФАСАДА----------------->
function proverka(input) {
	ch = input.value.replace(/[^\d.]/g, '');
	pos = ch.indexOf('.');
	if(pos != -1){
		if((ch.length-pos)>2){
			ch = ch.slice(0, -1);
		}
	}
	input.value = ch; // приписываем в инпут новое значение

};
$("#front_length").blur(function(){
	p = jQuery.parseJSON($("#range").html());
	if(($("#front_length").val() > p.max_h) || ($("#front_length").val() < p.min_h)){
		alert('Значение не должно превышать '+ p.max_h +'мм и быть меньше '+ p.min_h +'mмм!');
		$("#front_length").val(p.min_h);
	}
	else{
		price = $("#front_length").val() * $("#front_width").val() * $("#coefficient").html();
		$("#frontModalPrice").html(price);
		updatefrontModalTotalPrice();
	}
})
$("#front_width").blur(function(){
	p = jQuery.parseJSON($("#range").html());
	if(($("#front_width").val() > p.max_w) || ($("#front_width").val() < p.min_w)){
		alert('Значение не должно превышать '+ p.max_w +' мм и быть меньше '+ p.min_w +'мм!');
		$("#front_width").val(p.min_w);
	}
	else{
		price = $("#front_length").val() * $("#front_width").val() * $("#coefficient").html();
		$("#frontModalPrice").html(price);
		updatefrontModalTotalPrice();
	}
});