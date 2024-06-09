<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Pusher Notification</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app">
        <h1>Laravel Pusher Notification</h1>
        <div id="notifications"></div>
    </div>

    @vite('resources/js/app.js')
    <script>
        Echo.channel('notifications')
            .listen('MessageSent', (e) => {
                console.log(e.message);
                let notificationElement = document.createElement('div');
                notificationElement.innerText = e.message;
                document.getElementById('notifications').appendChild(notificationElement);
            });
    </script>
</body>

</html>