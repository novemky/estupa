<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ubuntu Server-PHP Deployment</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<!-- Custom Styles -->
	<style>
		body {
			padding: 30px;
			background-color: #f8f9fa;
		}

		.form-container {
			max-width: 500px;
			margin: 0 auto;
			background-color: white;
			padding: 30px;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.submit-btn {
			background-color: #007bff;
			color: white;
			border: none;
			padding: 12px 30px;
			border-radius: 5px;
			cursor: pointer;
			width: 100%;
			font-size: 16px;
			margin-top: 20px;
		}

		.submit-btn:hover {
			background-color: #0056b3;
		}

		label {
			font-weight: bold;
		}
	</style>
</head>

<body>

	<div class="form-container">
		<h3 class="text-center mb-4">Student Information</h3>
		<!-- Form for collecting user input -->
		<form>
			<div class="mb-3">
				<label for="firstname" class="form-label">Firstname:</label>
				<input type="text" id="firstname" name="firstname" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="middlename" class="form-label">Middlename:</label>
				<input type="text" id="middlename" name="middlename" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="lastname" class="form-label">Lastname:</label>
				<input type="text" id="lastname" name="lastname" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="age" class="form-label">Age:</label>
				<input type="text" id="age" name="age" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="address" class="form-label">Address:</label>
				<input type="text" id="address" name="address" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="course" class="form-label">Course & Section:</label>
				<input type="text" id="course" name="course&section" class="form-control" required>
			</div>

			<button type="submit" class="submit-btn">Submit</button>
		</form>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>