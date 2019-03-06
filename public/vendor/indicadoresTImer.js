$('#actValoresIndividuales').on('show.bs.modal', function (e) {

    var button = $(e.relatedTarget)
    var mes = button.data('mes')
    var personal = button.data('personal')
    var modal = $(this)
    $('.th').html('')
    $('.td').html('')
    $('#personal_id').val(personal)

    axios.get('/individual/' + personal + '/month/' + mes, {
            params: {
                prueba: 12345
            }
        })
        .then(function (response) {
            $.each(response.data, function (index, value) {
                $('.th').append('<td>% ' + value.indicador + '</td>')
                $('.td').append('<td><input type="number" class="form-control text-center" name="' + value.indicador + '" min="0" step=".5" value="' + value.value + '"></td>')
                $('#name').html(value.name)
                $('#rol').html(value.rol)
                $('#oficina').html(value.oficina)
                $('#p00').html(value.p00)
            });


        })
        .catch(function (value) {
            console.log(value);
        });

})