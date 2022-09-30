<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installer :: redirect</title>

    @if ($app_url == null || $app_url == false)
        <script>
            const urls = ["http://" + window.location.host, "https://" + window.location.host, "http://www." + window.location
                .host, "https://www." + window.location.host
            ];

            function send(counter = 0) {
                var xhttp = new XMLHttpRequest();
                var url = urls[counter] + '/themes/admin/assets/index.html';

                xhttp.open("GET", url);
                xhttp.onreadystatechange = function(oEvent) {
                    if (xhttp.readyState === 4) {
                        if (xhttp.status === 200) {
                            window.location.href = "{{ route('install.set_asset_url') }}?url=" + urls[counter];
                        } else {
                            console.log("Error", xhttp.statusText);
                            if (counter < 4) {
                                send(counter + 1);
                            } else if (counter === 3) {
                                window.location.href = "{{ route('install.fails') }}";
                            }
                        }
                    }
                };
                xhttp.send();
            }
            send(0);
        </script>
    @else
        <script>
            window.location.href = "{{ route('install.welcome', [], false) }}";
        </script>
    @endif
</head>

<body></body>

</html>
