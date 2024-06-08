<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Submission</h1>
        <p><strong>Date of Submission:</strong> {{ $form->created_at->toDateString() }}</p>
        <p><strong>Form Reference Number:</strong> {{ $form->form_reference }}</p>
        <!-- Add more details from the form as needed -->
    </div>
</body>
</html>
