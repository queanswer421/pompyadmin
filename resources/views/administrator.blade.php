<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pumps Admin</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        web:
        <div id="admin">
            <Welcome />
        </div>
         <script>
           window.Laravel = <?php echo json_encode([
               'csrfToken' => csrf_token(),
                    ]); ?>
          </script>
        <script src="{{asset('/js/admin.js')}}"></script>
    </body>
</html>