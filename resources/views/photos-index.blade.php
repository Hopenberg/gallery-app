<table id="photos-index" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>L. p.</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Zdjęcie</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(function() {
        $.ajax({
            type: "GET",
            url: "/api/photos",
            success: function (response) {
                let tableRows = '';
                response.data.forEach((photo, i) => {
                    tableRows += '<tr>';
                    tableRows += `<td>${i + 1}</td>`;
                    for (const key in photo) {
                        if (Object.hasOwnProperty.call(photo, key)) {
                            const element = photo[key];
                            if (key === 'photo_location') {
                                continue;
                            }
                            else if (key === 'client_name') {
                                tableRows += `<td><a href='${photo['photo_location']}' target='_blank'>${element}</a></td>`;
                            }
                            else {
                                tableRows += `<td>${element}</td>`;
                            }
                        }
                    }
                    tableRows += '</tr>';
                });

                $("#photos-index tbody").html(tableRows);
            }
        });
    });
</script>