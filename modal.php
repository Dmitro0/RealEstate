
<div class="modalWindow" id="acceptModal">
        <div class="modal-content">
            <span class="close" onclick="acceptModal()"><img src="images/close.png"></span>
                <h2>Подтвердите ваше действие</h2>
                <form id="bookingForm" method="POST">
                    <input type="hidden" id="user" name="user" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                    <input type="hidden" id="realty-id" name="realty-id" value="">
                    <div class="button-container">
                        <div class="submit-btn" id="booking-submit-btn" onclick="accept()">Подтвердить</div>
                        <div class="cancel-btn" id="booking-cancel-btn" onclick="cancel()">Отмена</div>
                    </div>
                </form>
            </div>
        </div>
    </div>