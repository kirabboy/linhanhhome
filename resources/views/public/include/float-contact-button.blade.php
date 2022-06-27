<div class="float-conact-button d-flex flex-column justify-content-center align-items-center">
    <a href="https://www.messenger.com/t/{{ optional($room->building)->messenger }}" target="_blank" class="shadow-lg"><i class="fab fa-facebook-messenger"></i></a>
    <a href="tel:{{ optional($room->building)->owner_phone }}" class="shadow-lg"><i class="fas fa-phone-square-alt"></i></a>
</div>