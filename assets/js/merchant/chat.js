
var chat = {};

chat.get_messages = function () {
    var $thisInput = $("#admin-conversation");
    var orderId = $thisInput.data("orderid");
    if (orderId) {
        $.ajax({
            url: '/shopmoni/admin/fetchconversations/' + orderId,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    $("#messages").empty();
                    $.each(data.data, function (i,n) {

                        if (n.user_id == null) {
                            $("#messages").append('<div style="margin-bottom: 12px;">'+
                                '<div><span style="color: #8c8c8c; font-size: 11px;">Posted On:    </span><span style="font-size: 11px;">'+n.created_at+'</span><span style="font-weight: bold; color: #00CC00;"> (Admin)</span></div>'+
                                '<div>'+n.reason+'</div>'+
                            '</div>');
                        } else {

                            var name = n.firstname+ " "+ n.lastname;
                            $("#messages").append('<div style="margin-bottom: 12px;">'+
                                '<div><span style="color: #8c8c8c; font-size: 11px;">Posted On:    </span><span style="font-size: 11px;">'+n.created_at+'</span><span style="font-weight: bold; "> ('+name +')</span></div>'+
                                '<div>'+n.reason+'</div>'+
                                '</div>');

                        }

                    });

                } else {
                    $('#errors_box .error').html(data.message);
                }

            }
        });
    }
}

$('#submit-admin-conversation').on('click',function(e) {
	chat.msg_contents = $('#admin-conversation').val();

    e.preventDefault();
    var $thisInput = $("#admin-conversation");
    var orderId = $thisInput.data("orderid");
    var disputeId = $thisInput.data("disputeid");
    var userId = $thisInput.data("userid");

    var comment = $thisInput.val();

    $.ajax({
        url: "/shopmoni/admin/logconversation",
        type: "post",
        data: {
            "order_id": orderId,
            "dispute_id" : disputeId,
            "user_id" : userId,
            "comment" : comment
        },
        beforeSend: function () {
            $("#submit-admin-conversation").attr("disabled", true).val("sending ...")
        },
        success: function (data) {

            var newdata = JSON.parse(data);
            if (newdata.status == "success") {
				chat.get_messages();
            } else {
                $('#errors_box .error').html(data.message);

            }
            var messDiv = $('#messages');
            var height = messDiv[0].scrollHeight;
            messDiv.scrollTop(height);

        },
        complete: function () {
            $("#submit-admin-conversation").attr("disabled", false).val('Send>>');
        }
    });


    $('#admin-conversation').val('');
	return false;
});


chat.interval = setInterval(chat.get_messages, 5000);
chat.get_messages();