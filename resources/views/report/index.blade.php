@extends('layouts.master')
@section('title2')
    Reporte RxP por Oficina ({{ $rxpColective->first()->month->month }})
@endsection
@section('content')
<table class="table table-striped mt-4 table-sm text-center" id="table">
    <thead>
      <tr>
        <th scope="col">Oficina</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($rxpColective->unique('oficina_id') as $oficina)
        <tr>
            <td>
                {{$oficina->oficina->name}}
            </td>
            <td>
            <a type="button" class="btn btn-sm btn-outline-success" href="{{route('modify.personal.rxp', ['id'=> $oficina->month_id, 'something'=> $oficina->oficina->id])}}">
                    Modificar Estatus del Personal
                </a>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="downloadPdf({{$oficina->month_id}}, {{$oficina->oficina->id}})">
                    Reporte Pdf
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.0.10/dist/jspdf.plugin.autotable.js"></script>
    <script>
    function downloadPdf(month, oficina)
    {
        axios({
            method:'post',
            url:'/reportpdf',
            data: {
                mesId: month,
                oficinaId: oficina
              }
        })
            .then(function (response) {
                procesarPdf(response.data)
        });
    }

    function procesarPdf(value)
    {

        var head = ['Pago', 'P00', 'Nombre']

        var nameIndividual = head.concat(value.nameIndividual)

        var head = ['Individual', 'Colectivo', 'Logro']

        var nameIndividual = nameIndividual.concat(head)

        var doc = new jsPDF()

        var imgData = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCABiAL8DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/iiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiue8V+LfDHgXw/qfivxnr+k+F/DWjQi41TXNcvrfTdMsYnkSGMz3d08cSNNPLFbwR7jJcXEsUEKSTSIjZV8RQwtCtisVWpYbDYelUr4jEV6kKNChRpRc6tatVqSjTpUqcIynUqTlGEIpyk0k2a0KFfFV6OGw1GriMRiKtOhQw9CnOrXr1qs1ClRo0qalUq1ak5RhTpwjKc5yUYptpHQ0V+bXjH/gq1+yN4WvZrHTdc8ZeOXhcxvc+EfCU/wBgLqQG8u78S3fhxbhByVmtknhfGUdgQTW8L/8ABWP9kbX2uU1XVfHfgswQSzRv4k8G3NzFdtEhcW9s3hS78SuJ5QNsS3UdtEzkIZQSM/ksvH/wTjjnl0vFLghYlScG3n+A+qKUb3TzD2v1BWaa/wB5s3otdD9Uj4D+M0sEswj4Y8aPDuKml/YOOWKcZWs1gHS+vO907fVr21asm1+l1FfllqH/AAV7/ZWtLpoLXTPivqsKsQL2z8J6PDbyAMRujj1HxRZXe0j5h5ttE2DgqDkV9U/AL9sn4A/tJTzaZ8NvF7HxPbW8l5ceDfEVjLoXidLOER+dd21lcNJa6rbQeYouZtGvtRS0ypujCHQt6GQeNXhNxTm1LIuH/ELhXNc3rydPDZfhs2w31jGVFd+zwUakoLG1LJyVPCutNxTkouKbXDn3g34qcMZVVzvP+AOKMrymhFVMTj8TlWI+r4Sm7JVMZOEZ/U6d2oupiVSgpNQclJpP6korL1rW9G8N6Tf694h1XTtD0TSraS81PV9XvbfTtN0+0iGZLm8vbuSK2toUyN0ksiKCQM5IB/PLxx/wVW/ZJ8H6lPpmna74u8eyW8hilvPBfhd5tLDrjf5OoeIb7w9FeRrkhbiwF1bSFSYpnQhj73FviFwNwJToVeMeLMh4bWKUnhaebZlhsLiMVGLtOWFws5/WcTGD0nKhRqRg/jaPC4V4B4244qVqXCHCue8RPDNLE1Mqy7E4rD4VyV4xxOKhD6th5TTvCNarCU1dxTSZ+kNFfB3wb/4KP/svfGjxBZeFNM8T6v4M8SapPHaaTpnxA0qPQo9Vu5XWOG0sdXtb7VND+13EjpHbWl3qVrdXczLDawzSsqH3X44ftN/Bn9nJfDbfF7xRceGE8WnVV0GSLw/4g1tLxtFGnnUUZ9D0zUFtngGqWRC3JiMolJiDiOTbzZd4n+HWa8O4vi3L+N+F8Rwzl9WjRzHPFnWAp5dl1fEVqVChRzHE1q9OGArVq1ejTpUsY6NSpOtSUIy9pC/Tj/DXxByviDC8K47gvibD8SY+nVrZfkrybHTzHMKNClUr162X4alRnPHUaNGjWqVauEVanThRqucoqnPl98or59+B/wC1H8Ev2jJvEdv8IvF0niabwnFpc2uxy6Fr+itZxaw98mnuv9uabp/2gTPpt4p+z+b5RiHm7N6bua+MP7aX7OHwG8XL4F+J3j/+wvFP9l2esSaXbeHvEuttb2OoPOtm11Pomk6hbW80627zLazTJci3aG4aJYbiB5Oup4g8CUeHsPxbW4z4WpcLYvEPC4XiOpn2VwyPE4qNWtQlh6GayxSwVWvGvhsRRlSp15TjUoVoOKlSmo8lPgLjitn+I4UpcH8T1eJ8LQjisVw9TyLM553h8NKlRrxxFfK44Z42lRlQxOHqqrOjGDp16M1LlqQcuv8A2h/2jfht+zL4F/4Tz4k3l+LS6v00nRNF0a2jvdd8QatJDLcix0y1muLS3Ait4Jri7u7y7tbO1hQebP50ttDP5f8Asr/tufCf9rGbxHpXgux8S+G/E3he2h1LUPDvim2sI7q40e4uBaJq2m3Wl3+o2d1aw3TwW15G8lvc2s9zbAwvFNHM3xb+3t48/ZR/aU+D3wl1PVvjfefDufU7/wATeJfhhr+ofD3xxq2na9pthdL4a8Sx6nolno8WrWdhPqFpDFpurPEjNPp87WdvfWrzld//AIJe/Bj4KeAtF+JfxT8C/Fo/FjV5Eg8I67rtt4R8ReDvD/hrTrSODxFd6ZY2/iW2ttR1W5u8adfahqDRRwwR2tnbQW8bGea5/n5+K/HucfSHyXhLhfOfDrMfC6rktDMsZPDcR8OYzPsVhcRkEs2lj44Olm8s9hWVWthKuBWFy2eXVsqqUcfWqToVqleh+9R8LOBcp8AM54r4myjxBy/xNp5zXy7BwxPD3EODyPC4mhnscqhgZYyrlMcjnSdOliqeOeJzGGYUc0p1sBSpwrUYUKzvjV/wVm8OfCD4r+PfhhF8GNS8U/8ACC+Ir3w5Nr0Pju00qLULvTtkN86ae3hXUGtlgvBPa7WvJy3keYSu/wAtP04+E3jmf4nfDLwF8RbjQpfDL+OPCmieKl0Ge9XUZtLt9dsYdRtbWW+W1sVuZFtriFmkFpACWIEYxk/xheLNUv8A4o/FXxJrMIefU/iH8QNX1KBWJZ5b3xX4iuLmFO5Jaa/VQOewFf2E+Mfiv8Gv2Y/AXhS0+JfjrQfBWjaXolh4f0KHUJZZNR1SHw9p1nYtFo+i2EV3q2pm1hW2FwLCyuFthNB55jEsZb4j6M/jnxl4i574tcQcdcWZfQ4A4Wq4T+yPr+EyDJMBldLOM0zSeDliM2p4TBVqkcLl+Ap4Zzx+MqKbxEJ1XOvKMz7T6SHglwh4fZJ4VZDwPwtj6/HfE1LF/wBrfUcVn2c47M6uUZZlcMXGhlVTF42jTlisfj6mJ5MDhKbgqE4U1CjFwPdaK/LrWP8Agrr+ylpt3JbWFt8UPEEKMVF/pnhGwtrSUDGHiTW/EGk3+0+k1lC4xyte/fAj9vH9m/8AaF1mHwt4M8WXmkeMLpXax8JeM9Nbw/rGpCNHkkTSpfPvNH1S4SON5WsbDVbi/EKPObXyo5HT+k8n8cPCDP8AN6GRZN4j8I5hm2KrLD4TBUM4wvPjMRJqMKGDnOcKOMr1JNKlSw1SrUqvSnGTP50zfwV8WchyqvnmceHnFeAyrC0nXxeMr5RivZ4OhGPNOvjIQhKrhKNOOtWriadKnSX8SUT7HoqteXtnp1pdahqF3bWFhY2813e3t5PFa2lnaW8bTXFzdXM7pDb28ESPLNNK6RxRqzuyqpI/On4if8FUf2TvAmqXWj6drfir4iXNnI0M934D0CK80bzkYB0t9Y1zUtBstQjHOy70x76ylAzFcupDH6Xi7j/gngLDUMXxlxTknDdHFSnHCLNcfQw1bFyp2dRYPDSl9ZxXslKLq/V6VT2alFz5VJX+d4U4D4z45xFbC8H8MZ1xFWw0YyxX9l4GviaOEjUuqbxeJjH6vhVUcZKn9Yq0/aOMlDmadv0fqG5ubazgluru4gtbaFS81xcyxwQRIMAvLLKyxxqCQCzsByOa+L/gF+39+zn+0R4gh8H+E9e1jw74yu0d9N8L+N9Mi0W/1nyYmmnj0a7tb3U9I1C5hiSSQ2EepLqMkUcs8NnJDFLInkP/AAVm8Yjw3+yZf6Gk/lz+PfHfhHw0I1Yq8ttYz3fi256YJjDeG4ElHQiVVIIY181nni7wjhfDPinxN4azXKuLso4cyjMsdD+y8zoyoYrMMHh+ehlNfE0oYieAxGJxFTDUJxrYaVehHEU6zw1RShGf0WS+E/FeJ8SOGfDbiPK804UzbiHNsuwU/wC08uqxr4XAYyvyV81oYapOhHHYfD4enia0HRxEaFeWHnS+sU2pyh9423xc+FV74g0/wnY/EvwFfeKdVlmg03w3Y+L9AvNevpba2mvLhLXSLbUJdQmMFrbT3ExS3KxQwySOVVSa9Dr+R/8A4J8fE/4U/Br9omw+JHxe8QN4c0Hw74S8TLpN4mkavrLy+IdXgt9Fgt1tdGsb+5jzpWoavKZ3hWFPKCNIHkjVv6w/C/iTSPGXhnw74v8AD9w93oPirQtI8SaJdyW9xaSXWka5p9vqem3ElpdxQ3Vq89ndQytb3MMVxCzGOaKORWQfH/R58cafjbw3mWbYyhkWS51hM1xNFcM5fnMcyzLC5NTo4OOGzLMKNSNDFUY4vG1MZRo1JYSjQqQw8XTcpOVvrvH/AMFKngxxFl2VYSvnec5Pi8rw1Z8SY/KJZdl2JzepVxcsTl2AqwlWw1WWEwdPB1q1OOLrVqc68lUUYqN92vyu/wCCvPjBdB/Zf0zwzHLtuPHXxI8O6bJCCMyadolpqviO5cjqUiv9N0kEgYDyR56iv1Rr8B/+C03jAzeIPgZ4AilwNP0fxb4wvYQT8x1e90vRtMkcZwdg0XVljJGR5knZqX0q8+/1e8A/EPERnyVsxyzC5DRjezqf29meCyvEwXe2BxOKqSXWEJdB/ReyL+3/AB18P8PKHNSy/MsTntZ2uqf9h5djM0w832/23DYWEX/POJ8f/wDBO39ljwR+1H8SvGuk/EdteHhLwf4Oi1Zk8P6hFpdzPrmo6xZ2WmW9xdyWl4wtGsotZmaKFYpXlghImVEdH8T/AGxvhJ4K+Bf7RXxB+F3w/wBQ1XUPDPhmXQhatrU8F1qNpcar4c0nWbzT5ru3gtY7pbK51CSGGY28UvlKkc3mTRvNJ+v3/BF/wf8AYvht8ZPHkkIV/EPjTQvC1vMy4ZoPCuiy6nMEc9Y2m8WKGA4Lw/NkqMfi1+054wPj/wDaJ+NXi1H82DWfiZ4uewZWLhtMtNZutP0kKcncBptpaKuMjAAXjFf5ncd8HcMcM/Rd8Is4lkeAp8cca8U53mtfO1SazOpkOClnGHp4J1k054WVKtkmIVOSlCE2pQSlKUn/AKQ8D8XcTcSfSa8WMojnWOq8FcG8MZNldDJfap5bTzzGxyfEVMYqNmoYqNWjnVB1ItTlBOMm4xUV+l/wd/4J+fBXxR+xBdfH3x7qXjLTPHNx8PvH/jyC90/V7SHR9NtvDz+IJtAUaPPpj/a4byx0mzmvI5bvzbo3braXFqWiZPzj/ZIuPENr+098BJPC08ttrL/FbwXbRSRMyZsbzW7S01mGYoQTaXOiz6hb3yE7ZLOWeN8ozCv6A/2pynwM/wCCaVx4QizbXsHws+G/w0SPO15b3WD4f0jXgQTktLZnWp5VznHmZzgg/jr/AMExPB48W/tifDu4kj8218H6d4r8YXIwGVTYaBeabYSNnp5er6vpzqRgiQIR0wfvfE/w6yDhrxY+jR4e8MZRhcl4gnk3h/X4nzLLYSw+MxubY7PMPha+Z42cZa43DTyzHY510lViqyu3CFKMPhPDTxBz7iPwr+kfx/xLm+KznIYZxx5Q4ay7MZxr4TBZXgslr4mhl2Dpyj7uCxEMzwWCVC7pOVF2ipzqufq3/BUj9qLxD8Sfi/rHwQ0HVbm0+G3wuvo9N1PTrWZo4PEvjm3jV9X1HVFjYfaYvD9xK2iaZaTho7S6s9Rvox5l6pi9M/Yc/wCCZ3hX4yfDWw+L/wAb9S8SWmk+KhcS+CvCfhy8t9Jnm0eCd7VfEOt6hPZ3txs1GeGdtK0+0S1zYpBqM11cR30VvD+Wfx4XUl+OHxjXWBIuqj4p/EAaiJQ4kF7/AMJXq32nd5nz/wCt3Y3c4xX9h3wBbQ2+BnwbPhp7eTQB8LvAS6Q9qVMBsE8L6WsG3ZwGCACUH51lDiQCQMK+o8BuGsp+kF49+KXFvifQhxBDIpYipl3D2Z1JzwlKOIzbEYDLMNPCuUVVy/Icvwk8LDCTi6MsTiKOIxCqVuZ1PmvHPiPNfATwK8MeFPDSvLIKmeRoQzHP8tpwhi6ssPleHx+ZYiGJ5ZOlj88zDFwxM8XCSrRw9Cth6EoUWlT/AJWf23v2bdP/AGW/jneeAfD+q6hq3hXVdB0vxf4UutVaF9Wt9K1O4v7GTTtRuLWK3t7m60/U9Kv4Uuore3+0WgtJpIY5nkFfT/7RnjPxB8b/APgnR+zd8SvE09xqfiX4f/E7W/hnrOsXTvNc6hbjR9VisL+6nkzJPdXGm6FoMd9cys8t1fpPcyyNJIxPiP8AwUg+MGk/GL9qfxhfeHb2HUvDvgjT9M+Hek6jbSLLbXzeHmvLjWrm2lRmimt/+Ek1PWbe2uYmaK6tbeC4ido5ENfcniD4L6j4e/4I92y6laPFrLajonxia2mjZZbe08QeOrS30+VUPzKZPB+qWl2+4Aok8oYDaa/NcoyHA47jT6V/D3AcJR4BwXAnGuOhhcLUnWyy/C3EGVZpk6w0pSqRqqji8Djo5RU5p1PqEsR7KbpyqSf6Nm2e4zBcHfRZz/jmcZcd43jjgzBSxWJpwpZlbibIczyzNniIqMJU3VwuOwMs2hywgseqDqwjUjBLz7/gj74w0jwf4l/aL1PX72PT9D0n4aaR4t1i9mOI7TS/C2o6pNf3b88rb22oSOe56LycH4TvH8Z/ts/tYzG2E6658Y/iCUtg4aceG/C0b7ITKAW3WfhDwdp6vMVJ8yDS3YZd+fIfBPxO1/wF4a+J3hzQmECfFLwpZeDNbvFkZJ4NDg8R6R4ivbeDaME6k+jw6bdbiA2n3N5CciY1+0n/AAR5/Z+EFl4w/aO8QWP729Nz4D+HrTx/dtIZIZvF+uW+7IInukstAtLmMK6fY9ftSSkzA+b4ZPMPG7DeCfgDhPrMOHeGc14l4q4zqwU4U/qtfOsZjKrc18M8NlVapgsBiF7izDiNUZXcHb0PEhYDwXxPjP474r6vLiDiPLOHOF+D6U+Sc3iaOT4LB00ov4oYjNKVPGY7Dt8zwHDzqxspq/xl/wAFPzofh/48+EvhN4VgSy8L/Bj4PeBPAuk6ehUi1Uw3uuBpSgUPcz2Gq6a91My+ZPMGmkLPITX37+yfn4N/8Esvih8QSv2S+8U6L8XPE1nMcRu1/fRP8PdAcSDBO680iyaE8kGQBQeAfx+/bP8AGA8dftVfHfxCkpmgPxD1vQ7SXJIey8KSJ4VsmXPRGtdFiZAOApGCep/YH9rb/izf/BLf4W/DwObW+8T6P8I/DN5CuIpHvrm3T4g6+pTIba19o90swGTmXD53E1994eZvQl4ofSn8UMNCnRwHCPBPH2F4e9iowo4Wrisasm4VpULWjTisuyr6pRhBKMYS5YK0VF/C+IGVVo+Gf0YPDPFTqVcdxZxlwJic/wDbOU62JpYXB/2vxRVrczcqknmGafWqs5tylOPNJ3k2fj/+xf4PXx3+1V8CfD0kXnQf8LD0TXLuIjcr2XhSR/FN4jjBGx7bRpUbcNpDYOc4r7g/4LI+MBqvx3+HngyKXfF4P+G66jOgIIh1HxXruoPOhHZ20/RNJkYH+B4z3rif+CRnhA+IP2qJ/ETxboPAnw68UaykpAIivtWm0zwtboCejyWet6iQRzticdM14b/wUP8AGB8afth/Ge8WUSW2h63p/g+1CklYl8J6HpuiXka8kD/iaWl/I+MDzJHOASa/OML/AMY39D3NKr9zFeI/i/hMAlazrZLw1lMMdGbd7yhRzjBVYaJqM6i63t+h4n/jI/pcZbSXv4bw88JcXjm73VHOOI81lg3G32Z1spxtOSvZuFOXRo+yf2Gv+Cf/AMGvj3+zzqnxV+Kl74ystUv/ABB4osNFutB1m106x03Q9BtbS3GpG0n0u7F3dpqqasZftEr2zw20MQhRhI7fkl4Nn1XTvH/ha48JXlzHrVl4v0WTw3f25aC7XUoNZtjpF1DsbfFP9pW3kQK2VfABOK/pb8Bk/Ar/AIJaRajs+xX0X7P3iDxBEWPlSLrfxJt9R1PTWkbhhMNQ8VWUY/jXaka8qor8E/2LPBw8d/tWfAnw+8XnwD4g6Pr13FtLK9l4SMniq8VwM4RrfRZFYngBueK9/wAXvDvIMhpfRf4N4eyfB5RxlxJw5keO4kzPBU5Ucxx+acS4zIsNgauLqRkpVKuCzCOaRw9SS9pBPljJRgorwvCXxBz3Pan0l+MM/wA3xea8IcOcQZ1guHctxlSNbL8BlnDeDzvE42nhacouNOljMvllksRTTdOb96SlKUpP9Lf+CuP7TWvR61o/7NPhXVJrDS4NI0/xN8UHsZmifV73Uc3Hh/wxdPG4k/s6zs449evbR8w302o6Q8i/8S8B/Mf2GP2GvgZ8Vvhs/wAU/j/42trRPEN3qFn4Q8G2PjTSPDdxb6Zp1zLp8+v627zHUhdXWo291Hpen4tYEs7VL+4F9FqNvHbfJ3/BQsagP2yvjp/aQmE3/CRaQYPOzu/s8+FNAOmlM8eSbD7P5OONmO+a+pPgn/wSpu/jd8KfA3xU0H4/aBa2HjPQbXVm05fA15qD6Pftug1TRLi8j8VW6T3ej6lDdabdSC3gDT2zsIkUgV688bxX4n/SZ8R80q+GeH8YanCmMz7KMv4MzfiLL8ky/KspyXOFkWX4qdHNJewxlHDxjUnXwNOk6U81zOWYV06v8TyYYPhbw0+jd4d5ZS8SK/hHT4pweRZtmHGGU8P5hnWYZpmucZSs8x+Gp1ssj7fB1sRKVOnQx1SqqkMry6OAov2V/Z/Anxh8NwfAL9oXxhoPw58Uzahb/Dbx59o8F+K7W7tp7wJpt1b6rod4b3TyLSa/sM28VzPbLHDJeW0rrDCreSn6if8ABXH4nP4o8Ffsu6MCsUniTw1qXxO1S0QsqxPquk+HbTSj5bchVa612KMsNwCuvXNWf+HKniT/AKOD0P8A8N1f/wDzYV8vf8FStWQftJaX4DtZml0/4U/Cj4f+CLUEBVyNPn19pQoLAPLBrdosnJIMQTJ2V5uecHeI/hD4Q+NseLeFanBGS+JHEfBOXcO5Ks5yzNqFCVPOs6z7E4PC1Mux+Mny4HKcvhgKtfEwoTxdCVJtTdOSp+lkvF/h54s+LPgvLhXienxrnHh3w9xnmPEGcvJ8yyqtWjUybJcjw+LxNPMMBhIc2NzTHzx1LD4epXhhK0aqvDni6l39g/8AYQ8OftaeGPiB4o8V+MfEfhKy8K67pOgaT/YFnplyNQu7nT59R1T7U2oxybfscMuleUsIBYXUhkPCV/Tt4b0Ky8L+HdB8M6aGXTvDui6XoWnq23ctlpFjBp9qG2gLuEFvGDtAXOcADivzu/4JPeFodA/ZE0XWEWPzvG3jfxp4jndNpc/YtQj8JRJIRyCkfhkOqE/KJSwA3nP6V1/e30U/DXhzgvwo4S4gwOU0MNxLxjw1lma5/mqqYieIzKjjKuKzXK4VI1a06FKGFweY06UI4elRU4xi6vtJxUl/Cv0o/EbiHjHxT4ryHG5rWxPDnCPEeZZXkOVuFCGHy6thKWFyvM505U6UK1WWJxmXVKs5YirWcJSkqXJCTiyvwE/4KK/srftRfHr9o+/8U/D/AOFeqeJfBejeD/C3hnQtYh1/wjZW92tvb3OsamYbXVPEFjex+Rq+t39pI01rEZJLZmjMkPlO3790V+meLnhTknjJwpDhDiHM86yvLY5tg82qVcirYGhi69XBUcVSpYerPH4DMaLwzlivbzjGhGo61Cg41YxjOE/zjwn8Us68IOKZ8W5BluTZnmMsrxeVQpZ5RxtbC0aWMq4WpVxFKGAx2X1liVHDexhKVaVNUq9ZSpSk4Sh8HfsU/CDx/wDs/wD7H1v4W1rwxLY/FFoviD4pu/C63mlzXT+Iru61GPw/p7X9rfTaU1xeadp2hxrN/aH2eHzkSeaLypNn4hfDz/gnV+1rd/ErwRN4z+D2p6f4bn8beHJvFerXPiTwTPHZ6I+uWcmuX80Nr4luLmcQ2Bup3it4JppdpSON3YKf6rqK/POMPovcCca5P4Z5Dmmb8UUMq8Lcrp5VkmFwWKymEMxpKOVQxFfOfb5PiPb4jGRynD/WZYP6lTbqVnTp0+eKj9/wj9Jnjjg3NvEfPMtyrhmvmfibmdTNM5xWNw2aznl9VyzOdCjlHsM3w/sMPhHmuI+rwxf1yaVOgp1J8kuf83P+Cmvwp+M3xp+Dng34f/BzwXe+L7iTx9b6/wCI4bPUdD01bPTNG0TVrayWV9b1TTI5FuL/AFWKRI7dpmDWe51QBS3zv/wS/wD2R/jL8DfiP8SfG/xh8B3Pg1rnwXYeGfDL3mqeHtTe+bU9ai1LWDANE1bVGg+ypoenLI1x5G9btViMmJQn7V0V9DmngHwpnPjDlfjRj814hq8Q5PTw1LA5R9Yy3/V+nHCZdiMBh/8AZ3lcswvCeJq49cuZRX11qatSTovwMs8deKco8I8z8HMDlfD9LIM3qYirjc1+r5j/AG9Ulisww+Or2rrM1l9pww1LAu+XSf1NOF/a2qr8Mv8AgoL/AME5/HHjvx1rPxy+AunQa/e+Jil7458ALc21jqja1FCkNx4i8Nvey29nfLqkcSTarpLXEN+NT869sBf/ANoSW1l+fnh/wz/wUZ8NeFJvhB4b8L/tN6L4OkN1Znwzp/h7xnZ6TDDds7Xtnaaglkkdlp128sz3VtZ6hBp9y007yo5mlL/1oUV+bcZ/Q94O4i4uzfjHhvi3i/gDH8RSxU8+wvDWKo0sFjpY+oquY+yjy0sRhqeYVr18ZhZYjEYGpWfNTwtKK5D9F4P+lvxdw/wplPCPEPCnCfHmB4fjhoZFiuI8LVqYzAxwNP2WX+1kpVaGIqZfRtRwmJjQw+NhRXLUxVWXvn86v7J3/BKj4g6/4l0fxl+0hYQeD/BOmXNvqA8AC/tr3xR4reCQSxWGrnTZri08P6JOUUagr3r65cQGSzjs9OeYahB+2n7R/wAO7r4i/s7/ABb+G/h3TYp9S134ceIdI8M6Tb/ZrSGTV7fS5ZfDthb+a9vZ2qHUrWxgh8ySC2gG3c8Uall92qG4uIbS3nurmRIbe2hluJ5pDtSKGFGklkdjwERFZmJ6AE1+oeH3gJ4feGXBmfcHcP4bFvD8T4HFYLiTO8wr0a+dZrSxGDxGCbxGJjh6OFo0cLh8TiFhMLQwtLCUJVatV0alatiKtX804+8dOPvEnjDIuLs+xOEWI4ax2GxnDuTZfQrUMnyurQxmHxiVDDyxFXE1auKr4bDvF4mviquLrxpUqSrQo0cPSpfyWaZ/wTc/bLv9S0+xufg3faVb3t9aWlxqd74n8ENZ6dDcXEcMt/dra+Jp7lrazR2uJ1t4JpzFG4hikk2of6jfh34A0n4M/Cjw18PfBlg91p/gPwnDpWlWkYihudXvLCzeSa5lMkiQjUNd1Mz3t3JJKkbXt9NI7opLDxzwZ+1b4F/4V38O/EvxU1jT/Cninxv4T0PxpdaFouleJdct9B8PeLdTNl4S1bXJNL0/WG8OaVrQnsLay1PxFPp9lfajJcQ2c0gglWHufiJ+0p8Gvhb4ssPA3jDxTdweLb/T7bV/7D0Pwv4t8W32naPeXw0y11jW4/Cmh60ND0y4v2FtDeas1nFJIRsLKd1fnngp4X+CfgthM74k4c41lVq8QYDIsNjMz4uzvh6jjckwuYRrYzLsvdOlg8rWWV8zq/vqmEx9KdbEV8tpwjH/AGOrE+/8ZfEzxm8ZMVkvDvEXBsaNLIcfneIwmW8KZLn9XBZzisBKjhMxx6qVcZmbzGjllK9GnisDVjRw9DMak5Sf1ulI/m5sf+CeP7Y/iXxxZ33ir4OapZWXiDxXb3fiPVJfE3giZLS11XV0m1i/lSDxRNcypbw3FxcOsMUs7qhEcbyEKf1c/wCCn/wN+N3xt8LfB3wT8Fvh9f8Ai3SPD2p+Ita8QfY9W8PaZbabNb6dpek+HIGXXNY0x55HtrrWtht1mWKNCJGQyoG+1rv9rD9n+y8d6n8N5/iJZJ4q0h/EFtfxrpPiKXRYdT8K6RNrviTQ18UQ6RJ4an1/Q9IglvdT0K21WbVbRF8mW0W6Zbdvnz4H/tyaR471Xx/N4/8AFfwR0jwV4J8Ex+PpPEnhLXfiNJKdD1HV7HTbE3Nt4z8BeGbSUaXcXLaJq02mX17dXniW5sNM07SkmNzDF8Nlng94AcH8O8YeGeF8Ts2xP/EV8dh8BneZxz/hbG5ngK/BFb+3cZgqmLwuVLBZVGEMXUnmn9p4So40K0oudCcqbl9tmXi548cXcQcJeJGJ8Nsqw/8AxCzBV8dk2WyyLifB5bjqPGlFZJhMbTwmJzSWMzSU54WlDLP7NxUE69OMlCvCNVR8V/4Jb/st/Fb4BN8YfEPxf8GXPhDWfEcfhLR/Dtrc6joWpTXOmacdcvtXmR9F1LUo4UkurrS4wk80TSPb5CFUDV+Ynjv9gv8AbU8e/ETxj4vvPgnrETeMvGev+Iri4n8T+BD5P9v63d6lJJIq+KnfEQuyWRQzBV2qpIAr9zPF37a/g/V9H+H83wJuLXxtrXi/9oDwH8E9TsPEnh7xh4bk0P8A4SSK71XW7+TTtasPD2oNc6boFm17C5V7WA3NvLdpIMW0v0J44+P3wl+HOtnw74u8WCx1iKDS7vUbSx0TxFr66DZ65enTtGvvFF14e0jVLTwtZarfA22nXfiKfTIL2QN9meRUdl6sw8C/Afi3gHhfgKPiJnFHhLwyxOOxVDPcJnvDNLBZtj+MsRiM0l9dzuvlNXKsdi8NDC4mFKnl0cNLCYeryYhVJ2lDly/xu8ceFOPOJuOpeH2UVuK/EnD4HC18jxWR8SVcZleB4Qw+GyyLweS0M1pZpgcLiZ4nDSqVMwliI4rEUlOg4QvGfzP+3J8LviN4h/ZBf4NfBrwrf+LNXupPh/4VOl6XPp9pJB4a8MTWeoTXTPqV5YW4tlfw/p9o0aymVjdIFjKB2T8/P+CcH7Gnx3+Fn7RsPxB+Lfw21PwdoXh3wV4m/snUdRvtCukuPEGrfYNFhs4Y9N1S+nWRtJ1DWJjI0SRqkLKZAzqrftfL8Z/hdBp+m6tc+NNItNL1fVPGuj6fqV41xZ2E978OYtfm8cFru5git7ex8NReF9efUdVuZIdLVdOfyryUzW3n42lftB/CHWfCnjbxrZeLdnh34daemr+NLrUdB8S6NeaHpM2lHXLPVp9G1fRrHWrjTNT0cHUdIv7LT7m01a1DPp0tyUdV/SOJ/CTws4n8U+D/ABOzLjWVHOOD8DlTyPIqGd8PQyX6jw3Tr8Q4avLD1cNUx86NDD47+169WjjadOOD9ji+anhv3kvzvhrxV8T+GvDDi3w0y3g2NbKOLsdmazvPK+S59POPrvENTD8P4ijHEUsTTwMK1evgf7Jo0quDnOWM9rheWeIXs1+e3/BRL9gLxH+0BrFn8Yfg9/Z8nxEs9Jg0bxP4W1C6h02PxfYacHGlX+majctHZW+v2EDnTpYdRmt7PUNOislW8tJ9PEd/+UfgLwL/AMFFvgXcXnhj4c+Dv2ifB8N9cmS60vw74e8RX/hy4vOI2vEW3s9R8NtcOqqh1GBvMljVF+0NGqgf0WaJ+2d+zP4g0Pxn4l034p6W2h+ALbw/d+JtQu9J8R6dHBB4qaWPw82mRaho1tc+IX1ieCa1sIfD8OpzXN0nkQxu7xB4W/bT/ZtHhzSPEsPxCkvYNc1/XPC+m6Jp3hLxrqPjObxB4Zt4LvxFpUvgWy8Oz+MLO50O0ura71Q3miQQ2dtcQTSyhJ4i/wCacf8Agn4GcY8X1vEbIfGOlwBxBm9OtmeYY/hXjLIaOGzCH115Pjc2wz+tQxGGqYnMac8vx2JwuM+p4jMo1KdTDvHSxDq/o/AnjN42cIcJ0fD3PPCKrx5kOVVKOW4DA8UcIZ5WxGAn9Tjm2DyrEL6rPD4mnh8vqQzDBYfFYT63h8ulTqU66wMaCp/Hv/BPz4Ufte2PxF8XfFn9qTUfG0sF74Jfwz4R03xv4u/ta/hudQ1vStTv7qDw3DqN5DoMaW+lJBunttPuX89o1gaPcw8O/wCCkH7B3xg+JPxXu/jj8HtE/wCE4tvEmkaPaeK/DFnd2dr4g0rVNB0+DR4NQ0+1v7i1j1bTb/TLSwDQWUsmpW99DcsbSW3nSSP9iJ/jP8NrYfDAT+IjDL8ZWI+HFtPpGtwXniFI9FPiK4layn02O60iCz0Ufb72XXIdNSzjKx3BjndIm8d1r9uX9lvw/pWia1qfxRgjsPEvh+/8VaC9v4Y8ZXs+q+HNN8Qah4Xu9ZtbSz8PT3f2BNY0nVIlnlhjV7XT7rUUzp0f2o/Z8ReE/gtW8KF4W8W+I86uXYTM5cSvifPuMskXElPOalPDYj+1K2NxijhKsPqPEeAoQo4jCVaf9mZxlvvOpi8Hi5/H8PeKfjHR8Un4ncKeHkKWYYvLY8OLhrI+D85fDlTJ6c8Th/7Mo4PCN4qlNY3h3HV5VcPiqdT+0sozH3VTwuMwsfxh/Y+/Zp/bl0P4m/DvQdV0b4u/D34LaX4+0LxR440i98V3fhXw1c2GlajBqV/HJoB1q1bVW1UWSWVzBZafdfa0mC3YMJLj+lGvnbWP2sP2ftC8W6B4I1H4i2KeIPEh8LrYx22leIL7TbSXxvbpd+DrbXddsdJuND8N3nie2kS50ay1/UNNu7y2YXKQi3IlP0TX3PgV4d8F+GeS51w7whxrjONHRzKks0q47O8tzatk1ShQdHDZTTw+WwhTyrD0oxr1Y4OrH2jr1MTO6X7un8R43+IPGPiRnOT8QcWcG4Pg5VcvqyyylgcmzHK6OcU69ZVsTmtTEZjKc80xFVyoU5YunLkVCnh42b9+ZRRRX7ofiQUUUUAFFFFABRRRQAV558W/D/iXxZ8LPiP4W8HXVhY+K/EvgfxToHh291Sa4t9PtNY1jRL3TrC5vLi0gurmCCC4uEkeaC2uJIgu9YZCuw+h0VyY/B0sxwONy+vKrCjjsJiMHWnQqOlWhSxNGdCpKjVSbp1Ywm3TqJNwmlJJ2OrA4url+NwePoxpTrYLFYfF0o1oKrRlVw1aFanGrTbSqUnOCVSDaU4txb1PgNP2cPiraahqXh3TLf4cW/w78Q/Ev4BeNNeurnW9dm8VHwT8JdD+HOlD4W2dlD4Zi002ej6j4Gm1bTdbm1IQataandWEuiaXd6jd6hBl/F/9m/42fEP9ojQPiZ4Tk8CfDEaJrnhqI/F7wj458e2fxA1j4a6SUutV8C+Kvh//AGZ/whfiS41HUHultby51KOyi057e1vYrxYfLr9EKK/N8X4QcKY3BTy+tVzf6rPOMJnPLTxeHp1KNbA47Ncyw2HwVeODVfLqFLG51mOIp1suqYTMaNXEVKlDH0qk6k5/ouE8WuKcHjYZhRpZT9ahlOKyhyqYXEVKdaljcFleXYnEYyhLGOhmNerg8my/D1aOY08Vl9alh4U6+Bq04U4Q/Hrwp+wP8WvDnhT4ieH7i1+F+s+Jrnw/8W7DwH8StW+I3xV1LUk134pXFxp0viC38C3mmP4I8A6knha/vbHXtY0az1vWdUuYrDyLqFhd3svU+O/2GfihqF/c6j4Y1H4eX9n4RtP2WPDPw+8K+INQ12w0jXfAnwOgvNT8Y+GfF09hod4+m23ijxhcWurWi2UGrLLFYmW8MF3Mnl/q5RXztP6OvhtSy+GW08LmVPD0qapUpUsXQoVVGGAzTLacq0qGDpxx1aGFzOKqYjMYYzEYyplmU1cwq4ueEbq+/U+kF4i1cfPMamKy6pXqVHUqKrhK1am5Tx+WZjUjRjWxdSWBpTxOWycMPl88JQwlPMs1pYClhIYqKpfmX4A/ZH+Neh/Er4T/ABD8aax8Ntcn0z4+fHT42fE+x0bUfElrbz6r8SvDuleHfCVx4b+36JLJfnwla6dKttp2otpkdvBLBEl5cOtxM/Q+P/hz8UdG8f3HhP7L4Q1Hwb8fv2pvBfjjU/E8V5rl74yk8OeC/DGjeK08KatoZ0SPSNN0bQX+FEFiNYk8S3Vteafqlvpdvo9rqGozXC/onRXsUvBnhnBZXVyvK8ZnGDhic5w2cYuvWxix1bFy/sTA8M5rhq060FUdPOciwlTD4urGpGtDF43F4ylJRxOKw2I8ir4wcSYzM6WZZlhMoxc8PlGIynCUKWEeDo4WP9tYziTLMRRhRm4KplGd4qniMLTlCVKeFweEwlSPNhsLiMP+W2r/ALIvx28bfDrwX4F8UXHw00qz+H/w21/QbG003xN4pvZfF/jnWfHPgLxN4o1rxBrCeG9MuNI0T4haV4f8UaJLDpdre6r4Wj8RXN21zr73bWdn7F47/Z18deLv2dvi18O/D+k+EPA3xC+L+q6Rb69rF58QPG/xDuLjw3Be6Ba6hJ4g8deJ9GHiHWtWj8N2Or6bpWnR6bb6Jp8F1a2VqsERu5pPueitMP4McHYenmlNyzTETznhxcL47E4jE4SeMeWU8oxGQ4f6rjI4GGIy/EYbKMXicDSqZfUwsJUatq9KtKlQlSjEeMPF1epllRLLMPHJ+IXxNgcPh8PiqeDjmU83w+e11isHLHTw2YYfE5thMNjatPH08TONak3RqUlVrqr+XXjz9i74n6l45134meFpvhzdappfx1+DvjjwR4J8Qarr1p4Zvvht8F/As/hPwv4b1q9sPD95JpOpw395cavHBbaZqunxvvY3DTSkVwPif9hT453ek7rCX4VX/wATvE/jXxh8WNS+NWn+OPiX4B8X/DH4m+P9Ttl8QnwXb6BpV3F4i8FWvhzS9HsLLTNXmsL+81KG8vJjYwzQwxfsHRXj4/6PXh3mE8xnVo5tT/tPEY3GYiFPHUp0oY/McxqZljcww1HEYSvSw+PqVp8mGxdOCrZVGKr5PLL8bOri6nr4Lx98QMDDL4U6uVVP7NoYLCYedTBVYVZ4LLsvp5dg8BiK2HxdCrXwMKNPnxOFqTdHNJSdHN44/Bwo4Wl8BfHz9nz4/wDi/wAT/BrxP8O/FXgTWtZ+G/wl+JHgO61v4hXeu6TdR+L/AB74UsPC978Q7Gz8P6TqsN5qdzaW11tsriezt7K6uvML3NuZIq8bvf2FPiq3gbxl4W0/XvAtpqGofs7fAv8AZ38K6hHqeuCOw0HQdetfE/xw1C6P/CPiSL/hJ9XfVDoUEMcpvorpTqn9n4aNv1hor0M28D+B87zHNszzD+3K1fOI4iOJg83rulT+t8NUeFcRLDucJ141auW4TAVJVqlarWWNy3LsTGong6MI+flXjVxpkuX5VluA/sWlRyeWHlhp/wBkUFVqfVeI6vFFCNdQlCjOnTzLFY6mqNOjSovB5jmGGdNrF1Zy/MbwN+xN4o8NfH3xH4t8R6T4A8cfDvU/i0fido+pa747+Jaatolrp+mJbeE9Ii+FWnwWvw51PxB4RuEjg0bxVrV3fG10xZo4bFZDaRWv6c0UV9fwbwHw7wHhsywnD2GeHpZrmeKzXFOpHDyrOviqk6rpPEUsPRxGIo0Z1KroSxtXFYmCqzjLETTSXyfF/HHEHHGIy3FZ/iVXq5XlmGyvDKnLERoqjhacKUaiw9XEVqGHq1YU6SrRwVPC4aTpwccPBptlFFFfZHyAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAH/2Q=='
        
        doc.addImage(imgData, 'JPEG', 10, 5, 25, 20)
        doc.addImage(imgData, 'JPEG', 10, 5, 25, 20)
        doc.setFontSize(20)
        doc.text(60, 25, 'Gerencia de Procesos y Calidad de Gestión')
        doc.setLineWidth(1)
        doc.line(10, 30, 200, 30) // horizontal line
        doc.setFontSize(14)
        doc.text(60, 40, 'Resultados RxP ' + value.name + ' ' + value.mes)
        doc.setFontSize(12)
        doc.text(10, 50, 'Datos de la Oficina')
        doc.setFontSize(10)
        doc.text(10, 55, 'Dirección Comercial: ' + value.direccion)
        doc.text(10, 60, 'Gerencia Comercial: ' + value.gerencia)
        doc.text(10, 65, 'Supervisores: ')
        let row = 65;
        $.each(value.supervisores, function (index, value) {
            doc.text(35, row, value.name)
            row += 5
        })

        doc.setFontSize(12)
        doc.text(10, 80, 'Resultado Indicador Empresarial: ' + value.empresarial + '%')

        doc.text(10, 90, 'Resultado Indicadores Colectivos: ')


        doc.autoTable({
            startY: 100,
            styles: {
                halign: 'center'
            },
            head: [value.nameCollective],
            body: [value.valueCollective]
        });
        
        doc.text(10, 130, 'Resultado Indicadores Individuales: ')

        doc.autoTable({
            theme : 'grid',
            startY: 140,
            styles: {
                halign: 'center'
            },
            head: [nameIndividual],
            body: value.valueIndividual
        });

        doc.save('RxP_'+ value.name +'_'+ value.mes +'.pdf')
    }
    </script>
@endsection