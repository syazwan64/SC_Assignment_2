<!DOCTYPE html>
<html>
<head>
    <title>Makanan Tradisional di Malaysia</title>
    <style>
        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img class="logo" src="/cuisine/images/logo.jpg"></a>
        
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">All Malaysian Foods</a>
                    <a class="nav-item nav-link" href="#">Malay</a>
                    <a class="nav-item nav-link" href="#">Indian</a>
                    <a class="nav-item nav-link" href="#">Chinese</a>
                    <a class="nav-item nav-link" href="#" onclick="showPostForm()">Add Food</a>
                    <a class="nav-item nav-link" href="#" onclick="showUpdateForm()">Update Food</a>
                    <a class="nav-item nav-link" href="#" onclick="showDeleteForm()">Delete Food</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 id="view-collection">All Malaysian Foods</h1>
            </div>
        </div>
        <div class="row" id="card-content">
        </div>
    </div>

    <!-- POST Form -->
    <div class="container" id="post-form-container" style="display: none;">
        <form id="post-form" onsubmit="sendPostRequest(event)">
            <div class="mb-3">
                <label for="kategori" class="form-label">Category:</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Name:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="resepi" class="form-label">Ingredients:</label>
                <input type="text" class="form-control" id="resepi" name="resepi" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Image URL:</label>
                <input type="text" class="form-control" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Food</button>
        </form>
    </div>

    <!-- Update Form -->
    <div class="container" id="update-form-container" style="display: none;">
        <form id="update-form" onsubmit="sendPutRequest(event)">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Category:</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Name:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="resepi" class="form-label">Ingredients:</label>
                <input type="text" class="form-control" id="resepi" name="resepi" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Image URL:</label>
                <input type="text" class="form-control" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Food</button>
        </form>
    </div>

    <!-- Delete Form -->
    <div class="container" id="delete-form-container" style="display: none;">
        <form id="delete-form" onsubmit="sendDeleteRequest(event)">
            <div class="mb-3">
                <label for="delete-id" class="form-label">ID:</label>
                <input type="text" class="form-control" id="delete-id" name="delete-id" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete Food</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.nav-item').mouseover(function() {
                let selection=$(this).html();
                $('h1').html(selection);
                
                //GET method to view all foods
                $.ajax({
                    url: 'http://localhost/cuisine/routes/makanan.php/collectionskuih',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        category: selection
                    },
                    success: function(response) {
                        $('#card-content').empty(); // Clear the previous content
                        $('#post-form-container').hide();
                        $('#update-form-container').hide();
                        $('#delete-form-container').hide();

                        if (response.length > 0) {
                            $.each(response, function(index, collection) {
                                let html = '<div class="col-md-4"><div class="card">';
                                html += '<img class="card-img-top" src="/cuisine/images/' + collection.gambar + '">';
                                html += '<div class="card body"><h5 class="card-title">Category: ' + collection.kategori + '</h5>';
                                html += '<h5 class="card-title">Name: ' + collection.nama + '</h5>';
                                html += '<h5 class="card-title">Description: ' + collection.description + '</h5>';
                                html += '<h5 class="card-title">Ingredient: ' + collection.resepi + '</h5>';

                                $('#card-content').append(html);
                            });
                        } else {
                            $('#card-content').html('<p>No collections found.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#card-content').empty();
                        $('#post-form-container').hide();
                        $('#update-form-container').hide();
                        $('#delete-form-container').hide();
                    }
                });
            });
        });

        //POST method Form
        function showPostForm() {
            $('#post-form-container').show();
        }

        //POST method to Add Food into the database
        function sendPostRequest(event) {
            event.preventDefault();
            $('#card-content').empty();

            let form = document.getElementById('post-form');
            let formData = new FormData(form);

            let data = {};
            formData.forEach(function(value, key) {
                data[key] = value;
            });

            console.log(data);

            $.ajax({
                url: 'http://localhost/cuisine/routes/makanan.php/addfood',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    console.log(response);
                    form.reset();
                    $('#post-form-container').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        //PUT method Form
        function showUpdateForm() {
            $('#update-form-container').show();
        }

        //PUT method to Update Food into the database
        function sendPutRequest(event) {
            event.preventDefault();
            $('#card-content').empty();

            let form = document.getElementById('update-form');
            let formData = new FormData(form);

            let data = {};
            formData.forEach(function(value, key) {
                data[key] = value;
            });

            let id = data.id;

            console.log(data);

            $.ajax({
                url: 'http://localhost/cuisine/routes/makanan.php/updatefood/' + id,
                type: 'PUT',
                dataType: 'json',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    console.log(response);
                    form.reset();
                    $('#update-form-container').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        //DELETE method Form
        function showDeleteForm() {
            $('#delete-form-container').show();
        }

        //DELETE method to delete Food from the database
        function sendDeleteRequest(event) {
            event.preventDefault();
            $('#card-content').empty();

            let form = document.getElementById('delete-form');
            let formData = new FormData(form);

            let data = {};
            formData.forEach(function(value, key) {
                data[key] = value;
            });

            let id = data['delete-id'];

            console.log(data);

            $.ajax({
                url: 'http://localhost/cuisine/routes/makanan.php/deletefood/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    form.reset();
                    $('#delete-form-container').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
</body>
</html>
