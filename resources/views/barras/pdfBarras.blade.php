<!DOCTYPE html>
<html>
<head>

        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                    <th>codigo de barras</th>
                    </thead>

                    <tbody>
                    <!-- muestra de la informacion de la base de datos -->
                        @foreach ($datos as $item)
                            <tr>
                                <td>{{ $item}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </p>


</head>
<body>

</body>
</html>