//Variables url declared outside this script.

var interval 			= undefined;
var lastMessageId 		= undefined;

$(function(){

	$('.sk-wave').hide();
	$('#send').prop('disabled', true);
	$('#messagebox').attr('disabled', 'disabled');

	$('#messagebox').on('keydown', function(event){

		if(event.which == 13 || event.keyCode == 13){

			send();
		}
	});

	setInterval(function(){

		$.get(baseUrl+'conversation-members', function(response){

			$('#conversations').html(response);
		})

	}, 1000*30);

});


function printBubble(bubble)
{
	html = bubble.own == 1 ? "<li class='clearfix'>" : "<li class='clearfix odd'>";
	html+= "<div class='conversation-text'>";
	html+= "<div class='ctext-wrap'><i>"+bubble.name+"</i><p>"+bubble.message+"</p></div>";
	html+= "</div>";
	html+= "</li>";

	$('.conversation-list').append(html);
}


function loadChat(conversation_id = 0)
{
	$('.conversation-list').empty();
	$('.sk-wave').show();
	data = {'conversation_id' : conversation_id};
	clearInterval(interval);

	$.post(url+'messages', data, function(response){

		console.log(response);
		$('#name').html(response.sender_name);
		$('#chat_conversation_id').val(response.conversation_id);

		$.each(response.messages, function(index, value){

			printBubble(value);

		});

		if(response.messages != undefined){

			if(response.messages.length > 0){

				lastMessageId = response.messages[response.messages.length-1].id;
			}

		}


		$('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

		refresh(conversation_id);
		$('.sk-wave').hide();

	});

	$('#send').prop('disabled', false);
	$('#messagebox').removeAttr('disabled');
	
}

function loadNewMessages(conversation_id)
{	
	data = {'conversation_id' : conversation_id, 'lastId' : lastMessageId};
	console.log('Last Message ID : '+lastMessageId);
	$.post(url+'messages', data, function(response){
		
		if(response.messages != undefined){

			if(response.messages.length > 0){

				$.each(response.messages, function(index, value){

					printBubble(value);

				});

				lastMessageId  = response.messages[response.messages.length-1].id;

				$('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);
			}


		}

	});
}



function send()
{
	clearInterval(interval);
	var conversationId 		= $('#chat_conversation_id').val();
	var message 			= $('#messagebox').val();

	data = {'conversation_id': conversationId, 'message': message};

	$('#messagebox').val('');

	$.post(url+'savemessage', data, function(response){

		lastMessageId = response.id;
		refresh(conversationId);

	});

	var bubble = {'own' : 0, 'name' : 'You', 'message' : message};
	printBubble(bubble);
	$('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);
}

function refresh(conversation_id)
{
	clearInterval(interval);

	interval = setInterval(function(){

		console.log('Load New Message Called');
		loadNewMessages(conversation_id);

	}, 1000*5);
}
