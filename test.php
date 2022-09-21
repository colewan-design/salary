<?php
include_once 'dbconnect.php';

// fetch records
$sql = "select * from customers order by id";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="style2.css">
    <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
     <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<body>
<div id="mytable">
    <h3 class="text-center bg-primary">AJAX Inline Editing HTML5 Table - Demo</h3>
    <table class="table table-bordered">
        <tr class="bg-primary">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Location</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td contenteditable="true" onfocus="changeBackground(this);" onblur="saveData(this, '<?php echo $row["id"]; ?>', 'name');"><?php echo $row['name']; ?></td>
            <td contenteditable="true" onfocus="changeBackground(this);" onblur="saveData(this, '<?php echo $row["id"]; ?>', 'email');"><?php echo $row['email']; ?></td>
            <td contenteditable="true" onfocus="changeBackground(this);" onblur="saveData(this, '<?php echo $row["id"]; ?>', 'location');"><?php echo $row['location']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
<script>
	function changeBackground(obj) {
    $(obj).removeClass("bg-success");
    $(obj).addClass("bg-danger");
}

function saveData(obj, id, column) {
    var customer = {
        id: id,
        column: column,
        value: obj.innerHTML
    }
    $.ajax({
        type: "POST",
        url: "savecustomer.php",
        data: customer,
        dataType: 'json',
        success: function(data){
            if (data) {
                $(obj).removeClass("bg-danger");
                $(obj).addClass("bg-success");
            }
        }
   });
}
</script>
</html>