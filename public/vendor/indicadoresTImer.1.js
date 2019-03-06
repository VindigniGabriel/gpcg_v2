$('#actValoresIndividuales').on('show.bs.modal', function (e) {

    var button = $(e.relatedTarget)
    var mes = button.data('mes')
    var personal = button.data('personal')
    var modal = $(this)
    $('.th').html('')
    $('.td').html('')
    $('.time').html('')
    $('#tmo').val()
    $('#personal_id').val(personal)

    axios.get('/individual/' + personal + '/month/' + mes, {
            params: {
                prueba: 12345
            }
        })
        .then(function (response) {
            $.each(response.data, function (index, value) {
                $('.th').append('<td>% ' + value.indicador + '</td>')
                if (value.indicador !== 'TPA' && value.indicador !== 'HC') {
                    $('.td').append('<td><input type="number" class="form-control text-center" name="' + value.indicador + '" min="0" step=".5" value="' + value.value + '"></td>')
                } else {
                    $('.td').append('<td><input type="text" class="form-control text-center" name="' + value.indicador + '" min="0" step=".5" value="' + value.value + '" oninput="porc(this.value, this.id);" id="p' + value.indicador + '"></td>')

                    if (value.indicador === 'TPA') {
                        $('.time').append('<td><input class="form-control text-center input-' + value.indicador + '" name="p' + value.indicador + '" min="0" step=".5" value="' + value.time + '" id="' + value.indicador + '" oninput="calc(this.value, this.id);" placeholder="[mm:ss]"></td>')

                        var cleave = new Cleave('.input-' + value.indicador, {
                            time: true,
                            timePattern: ['m', 's']
                        });
                    }

                    if (value.indicador === 'HC') {
                        $('.time').append('<td><input maxHours="100" class="form-control text-center input-' + value.indicador + '" name="p' + value.indicador + '" min="0" step=".5" value="' + value.time + '" id="' + value.indicador + '" oninput="calc(this.value, this.id);" placeholder="[hhh:mm:ss]"></td>')

                        var cleave = new Cleave('.input-' + value.indicador, {
                            delimiter: ':',
                            blocks: [3, 2, 2],
                            uppercase: true
                        });
                    }

                }
                $('#name').html(value.name)
                $('#rol').html(value.rol)
                $('#oficina').html(value.oficina)
                $('#p00').html(value.p00)
                $('#tmo').val(value.tmo)
            });


        })
        .catch(function (value) {
            console.log(value);
        });

})

function porc(value, id) {

    if (id === 'pHC') {

        var b = $('#tmo').val().split(':')

        var tmo_oficina = (+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2])

        var porcentaje_hc = value * tmo_oficina / 100

        var r = new Date(porcentaje_hc * 1000).toISOString().substr(11, 8)

        var nId = id.replace("p", " ");

        $('#HC').val(r)
    }

    if (id === 'pTPA') {

        var tmo = $('#tmo').val().substr(3, 7)

        var tmo_oficina = timeToDecimal(tmo)

        console.log(tmo)
        console.log(tmo_oficina)

        if (value >= 120) {
            var suma = parseFloat(tmo_oficina - 2)
        }

        if (value < 120 && value >= 100) {
            var suma = parseFloat(tmo_oficina + 0)
        }

        if (value < 100 && value >= 85) {
            var suma = parseFloat(tmo_oficina + 1.17)
        }

        if (value < 85) {
            var suma = parseFloat(tmo_oficina + 1.18)
        }
       
        var r = new Date(suma * 1000).toISOString().substr(11, 8)

        $('#TPA').val(r)
        
    }

}

function calc(value, id) {


    if (id === 'TPA') {

        $('#p' + id).val()

        var tmo = $('#tmo').val().substr(3, 7)
        var tmo_individual = timeToDecimal(value)
        var tmo_oficina = timeToDecimal(tmo)
        var resta = parseFloat(tmo_oficina - tmo_individual)

        console.log(resta)
        if (!isNaN(resta)) {
            if (resta >= 2) {
                $('#p' + id).val('120.00')
            }

            if (resta < 2 && resta >= 0) {
                $('#p' + id).val('100.00')
            }

            if (resta < 0 && resta >= -1.17) {
                $('#p' + id).val('85.00')
            }

            if (resta < -1.17) {
                $('#p' + id).val('00.00')
            }

        }
    }


    if (id === 'HC') {

        var a = value.split(':');
        var b = $('#tmo').val().split(':');
        var tmo_individual = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
        var tmo_oficina = (+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]);
        var porcentaje_tmo = tmo_individual / tmo_oficina * 100

        console.log()

        if (!isNaN(porcentaje_tmo)) {
            $('#p' + id).val(porcentaje_tmo.toFixed(2))
        }

    }

}

function timeToDecimal(t) {
    var arr = t.split(':');
    var dec = parseInt((arr[1] / 6) * 10, 10);

    return parseFloat(parseInt(arr[0], 10) + '.' + (dec < 10 ? '0' : '') + dec);
}
