$(document).ready(function(){
var TillManager = {

		total : 0,
		products : Array(),
		sellType: "",

		reset: function() {
			TillManager.enableButton('.btn-primary');
			TillManager.disableButton('.btn-inverse');
			TillManager.enableButton('.btn-success');
			$('.btn-success').hide();
			$('.btn-info').hide();
			TillManager.total = 0;
			TillManager.products = Array();
			TillManager.sellType = "";
			$("#ec").popover('hide');
			$('#tilldisplay ul').html('');
		},
		enableButton: function(button) {
			$(button).attr('disabled', false);	
		},

		disableButton: function(button) {
			$(button).attr('disabled', true);
		},

		createButton: function(data) {
			var container = $('#tillbuttons');
			var button = $('<button></button>');
			button.html(data.name + '<br />' + data.price + ' CHF');
			button.addClass("btn-primary");
			button.val(data.price);
			container.append(button);
			},

		addProduct: function() {
			var product = $(this);
			var display = $('#tilldisplay ul');
			var element = $('<li></li>');
			var price = product.html().split('<br>')[1].replace(' CHF', '');
			var name = product.html().split('<br>')[0];
			TillManager.products.push(name);
			element.attr('prod', name);
			element.attr('price', price)
			element.attr('class', 'productentry');
			element.html(product.html().replace('<br>', '<span style="float: right">'));
			display.append(element);
			$(".productentry").off('click');
			$(".productentry").click(TillManager.removeProduct);
			TillManager.isBound = true;
			TillManager.enableButton('#summarize');
			TillManager.total += parseInt(price);
		},

		removeProduct : function() {
			var name = $(this).attr('prod');
			var index = TillManager.products.indexOf(name);
			TillManager.total -= parseInt($(this).attr('price'));
			TillManager.products.splice(index, 1);	
			$(this).hide();
			if(TillManager.total === 0) {
				TillManager.disableButton('#summarize');
			}
			
		},

		summarize: function() {
			var display = $('#tilldisplay ul');
			var splitter = $('<hr>');
			var element = $('<li></li>');
			element.html('<b>Total: <span style="float:right">' + TillManager.total + ' CHF</b>')
			display.append(splitter);
			display.append(element);
			TillManager.disableButton('#summarize');
			TillManager.disableButton('.btn-primary');
			$(".productentry").off('click');
			$(".btn-success").show();
		},

		createTill: function(type) {

			var data = {action: 'get'};
			var response = this.getAjaxResponse(data);

			response.success(function(data) {
				data = JSON.parse(data);
				if(data.result === 'ok') {
					for (var i = 0; i < data.products.length; i++) {
						TillManager.createButton(data.products[i]);
					};
					TillManager.showTill(data.type);
					$('.btn-primary').click(TillManager.addProduct);
				}
			});
			
		},
		login: function(key) {
			var data = {action : 'login', key : key};
            var response = this.getAjaxResponse(data);
            
            response.success(function(data) {
            	data = JSON.parse(data);
            	if(data.result === 'ok') {
            		$('#tillselection').show();
            }
            });
            
		},

		sellProducts: function() {
			var data = {action : 'sell', products : TillManager.products, selltype : TillManager.sellType};
			var response = this.getAjaxResponse(data);

			response.success(function(data) {
				data = JSON.parse(data);
				if(data.result != "ok") {
					alert("Fehler: " + data.errormsg);
				}
			});
		},

		tillCheckin: function(type) {
			var data = {action : 'checkin', type : type}
			var response = this.getAjaxResponse(data);
			
			response.success(function(data) {
				data = JSON.parse(data);
				if(data.result === 'ok') {
					TillManager.createTill();
			}
			});
		},

		getAjaxResponse: function(data){
			return $.ajax({ url: 'webservices/TillService.php',
							data: data,
							contentType: "application/x-www-form-urlencoded;charset=UTF-8",
							type: 'post'
					});
		},

		showTill: function(type) {
			$("#tillselection").hide();
			$("#loginpanel").hide();
			$("#till").show();
		}
	};


	//HANDLERS

	$('#key').bind('keypress', function(e) {
		if(e.keyCode===13){
			var key = $('#key').val();
			TillManager.login(key);
		}
	});

	$("#tillselection .btn").click(function() {
		var type = $(this).val();
		TillManager.tillCheckin(type);
	});

	$("#summarize").click(function() {
		TillManager.summarize();
	});

	$("#ec").popover({ title: 'Zahlung OK!', content: 'Die Bestellung wurde aufgenommen, Bestellung abschliessen um die Bestellung ab zu schliessen und eine neue Bestellung zu starten', placement: 'top' });
	
	$("#ec").click(function(){
		TillManager.disableButton(".btn-success");
		TillManager.sellType="EC";
		$("#finish").show();
	});

	$("#bar").click(function(){
		TillManager.disableButton(".btn-success");
		TillManager.sellType = "bar";
		$("#in").show();
		$("#calculate").show();
		$("#finish").show();
	});

	$("#finish").click(function() {
		$("#ec").popover('hide');
		$("#out").hide();
		$("#in").hide();
		$("#calculate").hide();
		TillManager.sellProducts();
		TillManager.reset();
	});

	$("#calculate").click(function() {
		var income = $("#in").val();
		var price = TillManager.total;

		var out = parseInt(income) - parseInt(price);
		
		$("#out").html('Rückgeld: ' + out + ' CHF');
		$("#out").show();
	});

	$("#reset").click(function() {
		TillManager.reset();
	});
});