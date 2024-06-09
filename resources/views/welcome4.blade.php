<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Pusher Notification</title>
    @vite('resources/css/app.css')

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div id="app">
        <h1>Laravel Pusher Notification</h1>
        <div id="notifications"></div>
    </div>

    @vite('resources/js/app.js')

    <!-- Include Pusher script -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Include toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Pusher with your Pusher App Key and options
            var pusher = new Pusher('{{ config("broadcasting.connections.pusher.key") }}', {
                cluster: '{{ config("broadcasting.connections.pusher.options.cluster") }}',
                encrypted: true // Set to true if your Pusher app uses SSL
            });

            // Subscribe to the 'notifications' channel
            var channel = pusher.subscribe('my-channel');

            // Bind to the 'MessageSent' event
            channel.bind('MessageSent', function (data) {
                console.log(data.message);

                // Show toastr notification
                toastr.success(data.message);

                let notificationElement = document.createElement('div');
                notificationElement.innerText = data.message;
                document.getElementById('notifications').appendChild(notificationElement);
            });
        });
    </script>
</body>

</html>