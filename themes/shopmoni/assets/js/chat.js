//Variables url, avatarImgSrc and currentUser needs to be declared

var interval 				= undefined;
var lastMessageId 			= undefined;
var conversationGlobalId 	= 0;

$(function(){

	$chatbox            = $('.chatbox');
	$chatTitle          = $('.chatbox__title');
	$chatTitleClose     = $('.chatbox__title__close');
	$credentials        = $('.chatbox__credentials');

	$chatTitle.click(function(){

		$chatbox.toggleClass('chatbox--tray');
	});

	$chatTitleClose.click(function(event){

		event.stopPropagation();
		$chatbox.addClass('chatbox--closed');

	});

	$chatbox.on('transitionend', function(){

		if($chatbox.hasClass('chatbox--closed')){

			$chatbox.remove();
		}
	})

	$credentials.submit(function(event){

		$('#messages').empty();
		event.preventDefault();
		$('.loading').addClass('loading-rotate');

		$.post(url+'login', $('#chatForm').serialize(), function(response){

			conversationGlobalId = response.conversation_id;

			$.each(response.messages, function(index, value){

				printBubble(value);
			});

			if(response.messages != undefined){

				if(response.messages.length > 0){

					lastMessageId = response.messages[response.messages.length-1].id;
				}

			}
			

			refresh(response.conversation_id);

			setTimeout(function(){

				$('.sk-wave').fadeOut();
				$('#messages').fadeIn();
				$('.chatbox__body').scrollTop($('.chatbox__body')[0].scrollHeight);

				$('#send').prop('disabled', false);
				$('#messagebox').removeAttr('disabled');

			}, 2000);

		})

		$chatbox.removeClass('chatbox--empty');
	});

});


$(function(){

	$('#messagebox').attr('disabled', 'disabled');
	$('#adminmessagebox').attr('disabled', 'disabled');

	$('#messagebox').on('keydown', function(event){

		if(event.which == 13 || event.keyCode == 13){

			send();
		}
	});

});


function printBubble(bubble)
{
	html = bubble.own == 0 ? "<div class='chatbox__body__message chatbox__body__message--right'>" : "<div class='chatbox__body__message chatbox__body__message--left'>";
	html+= "<img src='"+img+"'>";
	html+= "<p>"+bubble.message+"</p>";
	html+= "</div>";

	$('#messages').append(html);
}

function loadNewMessages(conversation_id)
{	
	data = {'conversation_id' : conversation_id, 'lastId' : lastMessageId};
	console.log('Last Message ID : '+lastMessageId);
	$.post(url+'messages', data, function(response){

		if(response.messages != undefined){

			if(response.messages.length > 0){

				$.each(response.messages, function(index, value){

					console.log(value);
					printBubble(value);

				});

				lastMessageId  = response.messages[response.messages.length-1].id

				$('.chatbox__body').scrollTop($('.chatbox__body')[0].scrollHeight);
			}

		}

		

	});
}



function send()
{
	clearInterval(interval);

	var message = $('#messagebox').val();
	data = {'conversation_id': conversationGlobalId, 'message': message};

	$('#messagebox').val('');

	$.post(url+'savemessage', data, function(response){

		lastMessageId = response.id;
		refresh(conversationGlobalId);

	});

	var bubble = {'own' : 1, 'name' : 'You', 'message' : message};
	printBubble(bubble);
	$('.chatbox__body').scrollTop($('.chatbox__body')[0].scrollHeight);
}

function refresh(conversation_id)
{
	clearInterval(interval);

	interval = setInterval(function(){

		loadNewMessages(conversation_id);

	}, 1000*5);
}
