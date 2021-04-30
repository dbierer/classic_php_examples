<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Boolean Operations Truth Tables</title>
<style>
TD {
	width: 50px;
	text-align: center;
}
TH {
	font-weight: bold;
	width: 50px;
}
</style>
</head>
<body>
<h1>Truth Tables</h1>
<table border=1>
	<tr><th colspan=3>AND</th></tr>
	<tr><td>&nbsp;</td>	<th>0</th>						<th>1</th></tr>
	<tr><th>0</th>		<td><?php echo 0 && 0 ? "1" : "0"; ?></td>	<td><?php echo 0 && 1 ? "1" : "0"; ?></td></tr>
	<tr><th>1</th>		<td><?php echo 1 && 0 ? "1" : "0"; ?></td>	<td><?php echo 1 && 1 ? "1" : "0"; ?></td></tr>
	<tr><th colspan=3>OR</th></tr>
	<tr><td>&nbsp;</td>	<th>0</th>						<th>1</th></tr>
	<tr><th>0</th>		<td><?php echo 0 || 0 ? "1" : "0"; ?></td>	<td><?php echo 0 || 1 ? "1" : "0"; ?></td></tr>
	<tr><th>1</th>		<td><?php echo 1 || 0 ? "1" : "0"; ?></td>	<td><?php echo 1 || 1 ? "1" : "0"; ?></td></tr>
	<tr><th colspan=3>XOR</th></tr>
	<tr><td>&nbsp;</td>	<th>0</th>						<th>1</th></tr>
	<tr><th>0</th>		<td><?php echo 0 ^ 0 ? "1" : "0"; ?></td>	<td><?php echo 0 ^ 1 ? "1" : "0"; ?></td></tr>
	<tr><th>1</th>		<td><?php echo 1 ^ 0 ? "1" : "0"; ?></td>	<td><?php echo 1 ^ 1 ? "1" : "0"; ?></td></tr>
	<tr><th colspan=3>NOT</th></tr>
	<tr><td>&nbsp;</td>	<th>0</th>						<th>1</th></tr>
	<tr><th>&nbsp;</th>	<td><?php echo !0 ? "1" : "0"; ?></td>	<td><?php echo !1 ? "1" : "0"; ?></td></tr>
</table>
</body>
</html>
