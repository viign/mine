<?php
$a = $_POST["a"];
$b = $_POST["b"];
$c = $_POST["c"];
$n = $_POST["o"];

$x1 = array();
$x2 = array();
$x3 = array();

$x1[] = 0;
$x2[] = 0;
$x3[] = 0;

$list_iterasi = "<table class='table table-striped table-bordered' style='text-align:center;font-size:1.08rem' border: 3px solid;>";
$list_iterasi .= "<thead>";
$list_iterasi .= "<tr>";
$list_iterasi .= "<th style='background-color: #2f3e46;color: white;'>Iterasi ke-</th>";
$list_iterasi .= "<th style='background-color: #2f3e46;color: white;'>x<sub>1</sub></th>";
$list_iterasi .= "<th style='background-color: #2f3e46;color: white;'>x<sub>2</sub></th>";
$list_iterasi .= "<th style='background-color: #2f3e46;color: white;'>x<sub>3</sub></th>";
$list_iterasi .= "</tr>";
$list_iterasi .= "</thead>";
$list_iterasi .= "<tbody>";

for($i=1; $i <= $_POST["ulangan"]; $i++){
    $x1[$i] = number_format((float)($n[0] - ($b[0] * $x2[$i - 1]) - ($c[0] * $x3[$i - 1])) / $a[0], 3, '.', '');
    $x2[$i] = number_format((float)($n[1] - ($a[1] * $x1[$i - 1]) - ($c[1] * $x3[$i - 1])) / $b[1], 3, '.', '');
    $x3[$i] = number_format((float)($n[2] - ($a[2] * $x1[$i - 1]) - ($b[2] * $x2[$i - 1])) / $c[2], 3, '.', '');
    $list_iterasi .= "<tr>";
	$list_iterasi .= "<td style='background-color: rgba(255,255,255,0.3);;color: #2f3e46;'>".$i."</td>";
	$list_iterasi .= "<td style='background-color: rgba(255,255,255,0.3);;color: #2f3e46;'>".$x1[$i]."</td>";
	$list_iterasi .= "<td style='background-color: rgba(255,255,255,0.3);;color: #2f3e46;'>".$x2[$i]."</td>";
	$list_iterasi .= "<td style='background-color: rgba(255,255,255,0.3);;color: #2f3e46;'>".$x3[$i]."</td>";
	$list_iterasi .= "</tr>";
}

$list_iterasi .= "</tbody>";
$list_iterasi .= "</table>";

$html = "";
for ($j=0;$j<count($a);$j++) {
	$html .= "<h5 style='color: #2f3e46;'>";
	$html .= $a[$j]."x<sub>1</sub>";
	if ($b[$j] >= 0) {	
		$html .= "+".$b[$j]."x<sub>2</sub>";
	}else{
		$html .= $b[$j]."x<sub>2</sub>";
	}	

	if ($c[$j] >= 0) {	
		$html .= "+".$c[$j]."x<sub>3</sub>";
	}else{
		$html .= $c[$j]."x<sub>3</sub>";
	}

	$html .= " = ".$n[$j];	
	$html .= "</h5>";	
}
$returnarray = array();
$returnarray["x1"] = $x1[$_POST["ulangan"]];
$returnarray["x2"] = $x2[$_POST["ulangan"]];
$returnarray["x3"] = $x3[$_POST["ulangan"]];
$returnarray["list_iterasi"] = $list_iterasi;
$returnarray["data"] = $html;

echo json_encode($returnarray);

?>