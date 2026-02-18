function validateAndProceedUrl() {
    $.ajax({
        method: 'POST',
        url: 'site/generate',
        data: { url : $('#url').val() },
        success: (json) => {
            console.log(json);
            if (json.error) {
                $('#result').html('<p style="color:red">Ошибка! ' + json.error + '</p>')
            } else {
                $('#result').html('Ура!<br>Ваша короткая ссылка: <a href="' + json.shortlink + '">'
                    + json.shortlink + '</a><br>Количество обращений: ' + json.counter
                    + '<br><img src="/site/generate-qr?l=' + json.shortlink + '" alt="qr">'
                );
            }
        }
    });
}