<?php 
// Pruebas con arrays:
function filtro($n){
    // devuelve true si es par:
    return $n % 2 == 0;
}

$v1 = array();
$v2 = array(3,4,5,6,5,3,2,1,3,4,5,6,4,8,9);
$v3 = [4,5,6,7];

$v1[] = 900;
print_r($v1);

// filtrar los valores pares de $v2:
$arr2 = array_filter($v2, 'filtro');
print_r($v2);
echo "<br>";
print_r($arr2);

// Busqueda estricta o no:
$estricto = true;
if (in_array('3', $v2, $estricto) ){
    echo "existe";
} else {
    echo "no existe";
}

?>