<div class="chatbox chatbox--tray chatbox--empty">
    <div class="chatbox__title">
        <h5><a href="#">Chat <?=$info->shop_name ?></a></h5>
        <button class="chatbox__title__tray">
            <span></span>
        </button>
        <button class="chatbox__title__close">
            <span>
                <svg viewBox="0 0 12 12" width="12px" height="12px">
                    <line stroke="#ffffff" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                    <line stroke="#ffffff" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                </svg>
            </span>
        </button>
    </div>
    <div class="chatbox__body">

        <div id="messages" style="display:none">
        </div>

        <div class="sk-wave">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
        </div>
    </div>


    <form class="chatbox__credentials" id="chatForm" method="post">
        <div class="form-group">
            <label for="inputName">Name:</label>
            <input type="text" class="form-control" id="sender_name" name="sender_name" required>
        </div>

        <div class="form-group">
            <label for="inputEmail">Email:</label>
            <input type="email" class="form-control" id="sender_email" name="sender_email" required>
        </div>

        <input type="hidden" name="customer_id" value="<?=$user->id ?>">

        <button type="submit" class="btn btn-success btn-block" id="send">Enter Chat</button>

    </form>
    <textarea class="chatbox__message" placeholder="Write something interesting" id="messagebox"></textarea>
</div>