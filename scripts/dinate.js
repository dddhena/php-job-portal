document.addEventListener('DOMContentLoaded', function () {
    const customAmountRadio = document.querySelector('input[name="amount"][value="custom"]');
    const customAmountInput = document.querySelector('input[name="custom-amount"]');
    customAmountInput.style.display = 'none';

    customAmountRadio.addEventListener('change', function () {
        customAmountInput.style.display = 'block';
        customAmountInput.focus();
    });

    const amountRadios = document.querySelectorAll('input[name="amount"]');
    amountRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (radio.value !== 'custom') {
                customAmountInput.style.display = 'none';
                customAmountInput.value = '';
            }
        });
    });
});
