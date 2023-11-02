<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    @php
        use App\Models\Province;
        $data = Province::all();
    @endphp

    <div class="">
        <select class="form-control provinsi-dd">
            @foreach ($data as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>

    </div>
    <div class="">

        <select class="form-control regency-dd">
        </select>
    </div>
    <div class="">

        <select class="form-control district-dd">
        </select>
    </div>
    <div class="">

        <select class="form-control villages-dd">
        </select>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $('.provinsi-dd').select2()
        $('.regency-dd').select2()
        $('.district-dd').select2()
        $('.villages-dd').select2()

        $('.provinsi-dd').on('change', function() {

            var idprovinsi = this.value;
            $(".regency-dd").html('');
            $.ajax({
                url: "{{ url('fetch-regency') }}",
                type: "POST",
                data: {
                    provinsi_id: idprovinsi,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('.regency-dd').html('<option value="">Select regency</option>');
                    $.each(result.regencys, function(key, value) {
                        $(".regency-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
        $('.regency-dd').on('change', function() {

            var idregency = this.value;
            $.ajax({
                url: "{{ url('fetch-district') }}",
                type: "POST",
                data: {
                    regency_id: idregency,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('.district-dd').html('<option value="">Select district</option>');
                    $.each(result.district, function(key, value) {
                        $(".district-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
        $('.district-dd').on('change', function() {

            var iddistrict = this.value;
            $.ajax({
                url: "{{ url('fetch-village') }}",
                type: "POST",
                data: {
                    district_id: iddistrict,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('.villages-dd').html('<option value="">Select village</option>');
                    $.each(result.village, function(key, value) {
                        $(".villages-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
</body>

</html>
