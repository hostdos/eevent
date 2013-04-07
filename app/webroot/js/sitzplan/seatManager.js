$(document).ready(function(){
	
	var user = {
		username: 'JanitorMaster',
		clan: 'Eevent Staff'
	};
	
	var seatLayout = [
        {
            type: 'seatGroup',
            startingId: 11,
            width: 1,
            seatAmount: 24,
            x: 580,
            y: 100
        },
		{
			type: 'seatGroup',
			startingId: 21,
			width: 12,
			seatAmount: 12,
			x: 150,
			y: 100
		},

        {
            type: 'seatGroup',
            startingId: 31,
            width: 2,
            seatAmount: 24,
            x: 450,
            y: 158
        },
                {
            type: 'seatGroup',
            startingId: 41,
            width: 2,
            seatAmount: 24,
            x: 325,
            y: 158
        },
                {
            type: 'seatGroup',
            startingId: 51,
            width: 2,
            seatAmount: 24,
            x: 200,
            y: 158
        },
        {
            type: 'seatGroup',
            startingId: 61,
            width: 2,
            seatAmount: 24,
            x: 75,
            y: 158
        },

        {
            type: 'seatGroup',
            startingId: 71,
            width: 2,
            seatAmount: 24,
            x: 450,
            y: 558
        },
                {
            type: 'seatGroup',
            startingId: 81,
            width: 2,
            seatAmount: 24,
            x: 325,
            y: 558
        },
                {
            type: 'seatGroup',
            startingId: 91,
            width: 2,
            seatAmount: 24,
            x: 200,
            y: 558
        },
                {
            type: 'seatGroup',
            startingId: 101,
            width: 2,
            seatAmount: 24,
            x: 75,
            y: 558
        },
		{
			type: 'area',
			label: 'B&uuml;hne, Admin Area',
			width: 400,
			height: 100,
			x: 105,
			y: 0
		},
		{
			type: 'area',
			label: '',
			width: 610,
			height: 850,
			x: 0,
			y: 100
		},
		{
			type: 'area',
			label: 'Eingangsbereich',
			width: 610,
			height: 200,
			x: 0,
			y: 950
		},
		{
			type: 'area',
			label: 'Eingang',
			width: 100,
			height: 28,
			x: 25,
			y: 940
		},
		{
			type: 'area',
			label: 'Kassen',
			width: 80,
			height: 180,
			x: 470,
			y: 960
		},
		{
			type: 'area',
			label: 'Chillout',
			width: 350,
			height: 100,
			x: 60,
			y: 1050
		},
		{
			type: 'area',
			label: 'WCs',
			width: 40,
			height: 150,
			x: 0,
			y: 1000
		}
	];
	
	var occupiedSeats = [];
	
	var config = {
		seatSize: 25,
		seatMargin: 1
	};
	
	var seatManager = new SeatManager(
		seatLayout,
		occupiedSeats,
		config,
		user,
		$('#room'),
		$('#roomLoading'),
		'.seat:not(.occupied)'
	);
	
	function SeatManager(
		seatLayout,
		occupiedSeats,
		config,
		user,
		roomElement,
		loadingOverlayElement,
		seatElementsClass
	){
		
		initLayout(seatLayout);
		initSeats();
		
		function initLayout(seatLayout){
			for(item in seatLayout){
				var currentElement = seatLayout[item];
				if(currentElement.type == 'seatGroup'){
					addSeatGroup(currentElement);
				} else if(currentElement.type == 'area'){
					addArea(currentElement);
				}
			}
		}
		
		function addSeatGroup(seatGroup){
			var toAppend = $('<div></div>');
			toAppend.addClass('seatGroup');
			var seatGroupWidth = (config.seatSize + config.seatMargin * 2 + 2) * seatGroup.width;
			toAppend.css('width', seatGroupWidth);
			toAppend.css('left', seatGroup.x);
			toAppend.css('top', seatGroup.y);
			
			for(var i = 0; i < seatGroup.seatAmount; i++){
				var seatId = i + seatGroup.startingId;
				var seatElement = $('<div></div>');
				seatElement.addClass('seat');
				seatElement.attr('id', 'seat'+seatId);
				seatElement.attr('seatId', seatId);
				seatElement.css('width', config.seatSize);
				seatElement.css('height', config.seatSize);
				seatElement.css('margin', config.seatMargin);
				var seatLabel = $('<div></div>');
				seatLabel.addClass('seatLabel');
				seatElement.append(seatLabel);
				toAppend.append(seatElement);
			}
			
			roomElement.append(toAppend);
		}
		
		function addArea(area){
			var toAppend = $('<div></div>');
			toAppend.addClass('roomArea');
			toAppend.css('left', area.x);
			toAppend.css('top', area.y);
			toAppend.css('width', area.width);
			toAppend.css('height', area.height);
			toAppend.html(area.label);
			
			roomElement.append(toAppend);
		}
		
		function initSeats(){
			occupiedSeats = fetchSeatList();
			applySeatList();
		}
		
		function applySeatList(){
			clearSeatElements();
			for(item in occupiedSeats){
				var currentElement = occupiedSeats[item];
				var seatElement = $('#seat'+currentElement.seatId);
				
				seatElement.addClass('occupied');
				seatElement.children('.seatLabel').html(currentElement.username+'<br />'+currentElement.clan);
			}
			
			loadingOverlayElement.css('display', 'none');
			
		}
		
		function clearSeatElements(){
			$('.seat').removeClass('occupied');
		}
		
		function occupySeat(id){
			//console.log(occupiedSeats);
			removeOccupant(user.username);
			//console.log(occupiedSeats);
			var newSeat = {
				seatId: id,
				username: user.username,
				clan: user.clan
			};
			occupiedSeats.push(newSeat);
			applySeatList(occupiedSeats);
			//console.log(occupiedSeats);
		}
		
		function removeOccupant(username){
			for(item in occupiedSeats){				
				if( occupiedSeats[item].username == username){
					occupiedSeats.splice(item, 1);
					return true;
				}
			}
			return false;
		}
		
		function fetchSeatList(){
			return [ //Get this from the server
			];
		}
		
		function sendSeatList(){
			var toSend = occupiedSeats;
			//Send new seat occupant list to the server
		}
	}
	
});


















