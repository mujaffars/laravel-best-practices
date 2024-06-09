<!DOCTYPE html>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('f7b43fc05d00d401d485', {
        cluster: 'ap2'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function (data) {
        if (data && data.post && data.post.title && data.post.body) {
            toastr.success('New Post Created', 'Title: ' + data.post.title + '<br>Body: ' + data.post.body, {
                timeOut: 0,
                extendedTimeOut: 0,
            });
        } else {
            console.error('Invalid data structure received:', data);
        }
    });
</script>

</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>