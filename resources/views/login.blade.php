<form id="login" action="/login" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Wpisz email" required>
    </div>
    <div class="form-group mt-3">
        <label for="password">Hasło</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Wpisz nazwisko"
            required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Zaloguj</button>
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
                alert("Logowanie nie powiodło się");
            }
        });
    });
</script>
