<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Galeria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#links "
                aria-controls="links   " aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="links">
                <div class="navbar-nav">
                    <a class="nav-link" href="/api/photos/create">Dodaj Zdjęcie</a>
                    <a class="nav-link forLoggedIn" @if (!Auth::check()) style="display: none;" @endif href="/photos">Wszystkie zdjęcia</a>
                    <a class="nav-link forLoggedIn" @if (!Auth::check()) style="display: none;" @endif href="/logout">Wyloguj</a>
                    <a class="nav-link forGuest" @if (Auth::check()) style="display: none;" @endif href="/login">Zaloguj</a>
                    <a class="nav-link forGuest" @if (Auth::check()) style="display: none;" @endif href="/register">Zarejestruj</a>
                </div>
            </div>
        </div>
    </nav>

    <div id="main" class="container mt-3">
        @include('photos-add')
    </div>
</body>

</html>

<script>
    $(function() {
        $(document).on("pageChanged", function() {
            $.get("config/isUserLoggedIn", {},
                function (data, textStatus, jqXHR) {
                    if (data?.isLoggedIn) {
                        $(".forLoggedIn").show();    
                        $(".forGuest").hide();    
                    }
                    else {
                        $(".forLoggedIn").hide();    
                        $(".forGuest").show();  
                    }
                }
            );
        });
        $(document).trigger("pageChanged");

        $("#navbar #links a").on("click", function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr("href"),
                success: function(response) {
                    $("#main").html(response);
                    $(document).trigger('pageChanged');
                }
            });
        });
    });
</script>
