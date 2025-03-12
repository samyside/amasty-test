$(document).ready(function() {
    $('#orderBtn').click(function() {
        const orderData = {
            pizza_type: $('#pizzaType').val(),
            size: $('#pizzaSize').val(),
            sauce: $('#sauce').val()
        };

        $.ajax({
            url: 'api.php',
            method: 'POST',
            dataType: 'json',
            data: orderData,
            success: function(response) {
                $('#result').html(`
                    <h3>Ваш заказ:</h3>
                    <p>${response.data.ingredients.pizza}</p>
                    <p>Цена: ${response.data.total_price} BYN</p>
                `);
                console.log(response.data);
            },
            error: function(xhr) {
                alert('Ошибка: ' + xhr.responseJSON.message);
            }
        });
    });
});
