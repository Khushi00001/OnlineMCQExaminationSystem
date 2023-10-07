<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<?php echo $_POST["question"];?>
<table>
<tr>
<td><?php echo $_POST["option1"];?></td>
<td><?php echo $_POST["option2"];?></td>
</tr>
<tr>
<td><?php echo $_POST["option3"];?></td>
<td><?php echo $_POST["option4"];?></td>
<tr>
<?php echo $_POST["answer"];?>
</tr>
</table>

</body>
</html>