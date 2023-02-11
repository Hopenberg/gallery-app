<form id="login" action="/register" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="username">Nazwa uzytkownika</label>
        <input type="username" name="username" class="form-control" id="username" placeholder="Wpisz nazwę uzytkownika" required>
    </div>
    <div class="form-group mt-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Wpisz email" required>
    </div>
    <div class="form-group mt-3">
        <label for="password">Hasło</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Wpisz hasło"
            required>
    </div>
    <div class="form-group mt-3">
        <label for="password_repeat">Powtórz hasło</label>
        <input type="password" name="password_repeat" class="form-control" id="password_repeat" placeholder="Powtórz hasło"
            required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Zarejestruj</button>
    <div class="errors mt-3 text-danger">

    </div>
</form>

<script>
    $(function() {
        $("#login").ajaxForm({
            success: function(response) {
                $.get("/api/photos/create", {},
                    function(data, textStatus, jqXHR) {
                        $('#login').parent().html(data);
                        $(document).trigger('pageChanged');
                    }
                );
            },
            error: function(response) {
                alert("Rejestracja nie powiodła się");
            }
        });
    });
</script>
