BX.ready(function () {
    BX.bind(document.querySelector('.js-user-form'), 'submit', function (event) {
        event.preventDefault();
        
        let successMessageContainer = document.querySelector('.js-form-submit-success');
        let errorMessageContainer = document.querySelector('.js-form-submit-error');
        this.querySelector('button').disabled = true;
        let formData = new FormData(this);
        BX.ajax({
            url: this.action,
            method: 'POST',
            data: formData,
            dataType: 'json',
            preparePost: false,
            onsuccess: (response) => {
                console.log(response)
                if (response.success) {
                    successMessageContainer.innerText = BX.message('SUCCESS') + response.data.ID;
                    successMessageContainer.append(document.createElement('br'));
                    successMessageContainer.append(BX.message('QR_CODE'));
                    let qrCodeImage = document.createElement('img');
                    qrCodeImage.src = response.data.img;
                    successMessageContainer.append(qrCodeImage);
                    this.remove();
                    BX.show(successMessageContainer);
                    BX.hide(errorMessageContainer);
                } else {
                    errorMessageContainer.innerHTML = BX.message('ERROR') + '<br>' + response.message;
                    BX.show(errorMessageContainer);
                    this.querySelector('button').disabled = false;
                    recaptchaCheck();
                }
            }
        })
    });

    document.cookie = 'SameSite=None'
});

function recaptchaCheck() {
    grecaptcha.execute(BX.recatpchaSiteKey, {action: 'submit'}).then(function (token) {
        document.getElementById('recaptchaResponse').value = token;
    });
}

grecaptcha.ready(function () {
    recaptchaCheck();
});
