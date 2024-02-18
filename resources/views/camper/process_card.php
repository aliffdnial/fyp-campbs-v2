<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Payment</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" href="bankicon/card.png" />
</head>
<body>
    <script type="text/javascript">
        swal({
            title: "Payment by Card",
            text: "Payment successful. Thank You.",
            icon: "success"
        }).then(function() {
            window.location = "<?php echo route('app.booking.index'); ?>";
        });
    </script>
</body>
</html>
