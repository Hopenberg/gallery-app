<form id="addPhoto" action="/api/photos" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">Imię</label>
        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Wpisz imię" required>
    </div>
    <div class="form-group mt-3">
        <label for="last_name">Nazwisko</label>
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Wpisz nazwisko"
            required>
    </div>
    <div class="form-group mt-3">
        <label for="image">Zdjęcie</label>
        <input type="file" name="image" class="form-control-file" id="image" accept=".png,.jpg" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Zapisz</button>
    <div class="errors mt-3 text-danger">

    </div>
</form>

<script>
    $(function() {
        $("#addPhoto").ajaxForm({
            success: function(response) {
                alert("Plik został zapisany");
                $('#addPhoto').clearForm();
                $("#addPhoto .errors").html("");
            },
            error: function(response) {
                if (response?.responseJSON?.errors) {
                    let errorMessage = "Nie udało się zapisać pliku:";
                    for (const error in response.responseJSON.errors) {
                        if (Object.hasOwnProperty.call(response.responseJSON.errors, error)) {
                            const messages = response.responseJSON.errors[error];

                            messages.forEach(message => {
                                errorMessage += "<br>" + message;
                            });
                        }
                    }
                    $("#addPhoto .errors").html(errorMessage);
                } else {
                    $("#addPhoto .errors").html("Nie udało się zapisać pliku");
                }
            }
        });

        $("#addPhoto input[name='image']").on("change", function(e) {
            if (e.currentTarget.files[0].size > 2 * 1024 * 1024) {
                $("#addPhoto .errors").html("Rozmiar pliku jest za duzy (maksymalny rozmiar: 2 MB)");
                $(this).val("");
            }
            else {
                $("#addPhoto .errors").html("");
            }
        });
    });
</script>
