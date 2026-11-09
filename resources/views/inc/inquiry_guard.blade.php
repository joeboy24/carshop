<div class="contact_hp" aria-hidden="true">
    <label>Website</label>
    <input type="text" name="company_url" tabindex="-1" autocomplete="off">
</div>
<input type="hidden" name="opened" value="{{ \App\Support\InquiryGuard::token() }}">

@once
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.contact_form, .service_form').forEach(function (form) {
        var send = form.querySelector('.contact_send');
        var box = form.querySelector('.contact_confirm');
        var back = form.querySelector('.contact_back');
        var confirm = box ? box.querySelector('button[type="submit"]') : null;
        if (!send || !box || !back || !confirm) return;

        form.addEventListener('submit', function (event) {
            if (form.getAttribute('data-confirmed') === '1') return;
            event.preventDefault();
            send.hidden = true;
            box.hidden = false;
        });

        confirm.addEventListener('click', function () {
            form.setAttribute('data-confirmed', '1');
        });

        back.addEventListener('click', function () {
            form.removeAttribute('data-confirmed');
            box.hidden = true;
            send.hidden = false;
        });
    });
});
</script>
@endonce
