<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trade Line Item</title>	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>	
	<div class="container">
		<div class="row">
		<h1>Data Table</h1>
			<table id="item-table" class="table table-striped">
				<thead>
					<tr>
						<th>Column1</th>
						<th>Column2</th>
						<th>Column3</th>
						<th>Column4</th>
						<th>Column5</th>
						<th>Column6</th>
						<th>Column7</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>data 1</td>
						<td>data 2</td>
						<td>data 3</td>
						<td>data 4</td>
						<td>data 5</td>
						<td>data 6</td>
						<td>data 7</td>
					</tr>
				</tbody>
			</table>				
		</div>
	</div>
<script type="text/javascript" scr="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" scr="{{ asset('js/boostrap.min.js') }}"></script>
<script type="text/javascript" scr="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">

	$(document).ready(function() {
	    $('#item-table').DataTable();
	    alert('testing')
	});

</script>

</body>
</html>