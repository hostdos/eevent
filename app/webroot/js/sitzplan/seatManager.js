$(document).ready(function(){
	
	var user = {
		username: 'JanitorMaster',
		clan: 'Eevent Staff'
	};
	
	var seatLayout = [
     //   {
        //very right row
        //    type: 'seatGroup',
       //     startingId: 205,
         //   width: 1,
         //   seatAmount: 24,
        //    x: 580,
        //    y: 110
       // },
		//{
		//very top row
			//type: 'seatGroup',
		//	startingId: 193,
		//	width: 12,
		//	seatAmount: 12,
		//	x: 150,
		//	y: 103
		//},
				{
        //top left group
            type: 'seatGroup',
            startingId: 1,
            width: 1,
            startingNum: 1,
			letter: 'F',
            seatAmount: 12,
            x: 104,
            y: 158
        },


		{
        //top left group
            type: 'seatGroup',
            startingId: 25,
            width: 1,
            startingNum: 2,
			letter: 'F',
            seatAmount: 12,
            x: 75,
            y: 158
        },
        {
           //bottom left group
            type: 'seatGroup',
            startingId: 37,
            startingNum: 26,
			letter: 'F',
            width: 1,
            seatAmount: 12,
            x: 75,
            y: 558
        },
        {
        //bottom left group
            type: 'seatGroup',
            startingId: 13,
            width: 1,
            startingNum: 25,
			letter: 'F',
            seatAmount: 12,
            x: 104,
            y: 558
        },
        {
        //top middle left left row
            type: 'seatGroup',
            startingId: 49,
            startingNum: 2,
			letter: 'E',
            width: 1,
            seatAmount: 12,
            x: 200,
            y: 158
        },
        {
        //top middle left right row
            type: 'seatGroup',
            startingId: 73,
            startingNum: 1,
			letter: 'E',
            width: 1,
            seatAmount: 12,
            x: 229,
            y: 158
        },
        {
        //bottom middle left left row
            type: 'seatGroup',
            startingId: 61,
            width: 1,
            startingNum: 26,
			letter: 'E',
            seatAmount: 12,
            x: 200,
            y: 558
        },
        {
        //bottom middle left right row
            type: 'seatGroup',
            startingId: 85,
            width: 1,
            startingNum: 25,
			letter: 'E',
            seatAmount: 12,
            x: 229,
            y: 558
        },
        {
        	//middle right left row
            type: 'seatGroup',
            startingId: 97,
            startingNum: 2,
			letter: 'D',
			width: 1,
            seatAmount: 12,
            x: 325,
            y: 158
        },
        {
        	//middle right right row
            type: 'seatGroup',
            startingId: 121,
            startingNum: 1,
			letter: 'D',
            width: 1,
            seatAmount: 12,
            x: 354,
            y: 158
        },
        {
        //bottom middle right left row
            type: 'seatGroup',
            startingId: 109,
            width: 1,
            startingNum: 26,
			letter: 'D',
            seatAmount: 12,
            x: 325,
            y: 558
        },
        {
        //bottom middle right right row
            type: 'seatGroup',
            startingId: 133,
            width: 1,
            startingNum: 25,
			letter: 'D',
            seatAmount: 12,
            x: 354,
            y: 558
        },
//end of middle right rows
        {
        	//right left row
            type: 'seatGroup',
            startingId: 145,
            startingNum: 2,
			letter: 'C',
			width: 1,
            seatAmount: 12,
            x: 450,
            y: 158
        },
        {
        	//right right row
            type: 'seatGroup',
            startingId: 169,
            startingNum: 1,
			letter: 'C',
            width: 1,
            seatAmount: 12,
            x: 479,
            y: 158
        },
        {
        //bottom right left row
            type: 'seatGroup',
            startingId: 157,
            width: 1,
            startingNum: 26,
			letter: 'C',
            seatAmount: 12,
            x: 450,
            y: 558
        },
        {
        //bottom right right row
            type: 'seatGroup',
            startingId: 181,
            width: 1,
            startingNum: 25,
			letter: 'C',
            seatAmount: 12,
            x: 479,
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
			label: 'Catering',
			width: 60,
			height: 160,
			x: 0,
			y: 200
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
	//set occupiedSeats list so it exists
	//var occupiedSeats = [];
	
	//sets the look of a single seat
	var config = {
		seatSize: 25,
		seatMargin: 1
	};
	
	//sets the seatManager
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
			for(items in seatLayout){
				var currentElement = seatLayout[items];
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
			var plus = 0;
			for(var i = 0; i < seatGroup.seatAmount; i++){
				var seatId = i + seatGroup.startingId;
				var letter = seatGroup.letter;
				var seatNum = i + seatGroup.startingNum;
				var seatElement = $('<div></div>');
				seatElement.addClass('seat');
				seatElement.attr('id', 'seat'+seatId);
				seatElement.attr('seatId', seatId);
				seatElement.css('width', config.seatSize);
				seatElement.css('height', config.seatSize);
				seatElement.css('margin', config.seatMargin);
				seatElement.html(letter + " " + (seatNum + plus));
				var plus = plus + 1;
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
			//occupiedSeats = fetchSeatList();
			occupiedSeats = occupiedSeats;
			applySeatList();
		}
		
		function applySeatList(){
			clearSeatElements();
			for(items in occupiedSeats){
				var currentElement = occupiedSeats[items];
				var seatElement = $('#seat'+currentElement.seatId);
				seatElement.addClass('occupied');
				seatElement.removeClass('free');
				seatElement.children('.seatLabel').html(currentElement.username+'<br />'+currentElement.clan);
			}
			
			loadingOverlayElement.css('display', 'none');
			
		}
		
		function clearSeatElements(){
			$('.seat').removeClass('occupied');
			$('.seat').addClass('free');
		}
		
		function occupySeat(id){
			console.log(occupiedSeats);
			removeOccupant(user.username);
			console.log(occupiedSeats);
			var newSeat = {
				seatId: id,
				username: user.username,
				clan: user.clan
			};
			occupiedSeats.push(newSeat);
			applySeatList(occupiedSeats);
			console.log(occupiedSeats);
		}
		
		function removeOccupant(username){
			for(items in occupiedSeats){				
				if( occupiedSeats[items].username == username){
					occupiedSeats.splice(items, 1);
					return true;
				}
			}
			return false;
		}
		
		function fetchSeatList(){

/*
		  			$.post("app/registration/getSeats", console.log(data));

                        return [ //Get this from the server
                                {
                                        seatId: 4,
                                        username: 'JanitorMaster',
                                        clan: 'Eevent Staff'
                                },
                                {
                                        seatId: 60,
                                        username: 'Dude',
                                        clan: 'DudeClan'
                                }
                        ];
*/
		}
		
		function sendSeatList(){
			var toSend = occupiedSeats;
			//Send new seat occupant list to the server
		}
		

        $('.seat.free').click(function(){
	        if(login == 1){
	        window.location = 'http://www.eevent.ch/index.php/registrations/reserveSeat/' + $(this).attr("seatid");
	        return false;
	        }
	    });

/*
               loadingOverlayElement.css('display', 'block');
               var clickedSeat = $(this);
               occupySeat(clickedSeat.attr('seatId'));
        });
*/


	}
	
});


















