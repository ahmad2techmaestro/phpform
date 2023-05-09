<?php
// Check if form data is set
if (!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['email'])) {
    // Form data is not set, redirect to page 1
    header('Location: index.php');
    exit();
}

// Set alert variables
$alert_class = '';
$alert_message = '';

?>

<!doctype html>
<html lang="en">

<head>
    <title>Page 2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Form Submission</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert <?php echo $alert_class; ?>" role="alert">
                        <?php echo $alert_message; ?>
                    </div>

                    <h2>Page 2: Educational Information</h2>
                    <form method="post" id="form">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="university" class="form-label">University</label>
                            <input type="text" class="form-control" id="university" name="university" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#form').submit(function(event) {
                event.preventDefault();
                var formData = {
                    name: '<?php echo htmlspecialchars($_POST['name']); ?>',
                    phone: '<?php echo htmlspecialchars($_POST['phone']); ?>',
                    email: '<?php echo htmlspecialchars($_POST['email']); ?>',
                    location: $('#location').val(),
                    age: $('#age').val(),
                    university: $('#university').val()
                };
                if (formData.location == '' || formData.age == '' || formData.university == '') {
                    $('.alert').removeClass('alert-success').addClass('alert-danger').html('Please fill out all fields.').show();
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "submit.php",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            $('.alert').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                            $('#form')[0].reset();
                        } else {
                            $('.alert').removeClass('alert-success').addClass('alert-danger').html(response.message).show();
                        }
                    },
                    error: function() {
                        $('.alert').removeClass('alert-success').addClass('alert-danger').html('Error submitting form. Please try again.').show();
                    }
                });
            });
        });
    </script>

</body>

</html>