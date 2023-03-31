<?php
// $twoDimArr =  array(
//     array(1,2,3,4),
//     array(5,6,7,8),
//     array(9,8,7,6)
// );
// for ($i=0; $i < count($twoDimArr); $i++) { 
//     for ($j=0; $j < count($twoDimArr[$i]); $j++) { 
//         echo $twoDimArr[$i][$j] ;
//         echo " ";
//     }
//     echo "<br>";
// }
$threeDimArr =  array(
    array(
        array(1,2,3,4),
        array(5,6,7,8),
        array(9,8,7,6)
    ),
    array(
        array(1,2,3,4),
        array(5,6,7,8),
        array(9,8,7,6)
    ),
    array(
        array(1,2,3,4),
        array(5,6,7,8),
        array(9,8,7,6)
    ),
    array(
        array(1,2,3,4),
        array(5,6,7,8),
        array(9,8,7,6)
    ),
);
for ($i=0; $i < count($threeDimArr); $i++) { 
    for ($j=0; $j < count($threeDimArr[$i]); $j++) { 
        for ($k=0; $k < count($threeDimArr[$i][$j]); $k++){
            echo $threeDimArr[$i][$j][$k] ;
        echo " ";
        }
        echo "<br>";
    }
    echo "<br>";
}
?>