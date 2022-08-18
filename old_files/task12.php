<?php
$num = 5;
function arrows(int $num):string{
    $str = '';
    for($i = 1; $i <= $num; $i++){
        $str = '<' . $str. '>';
    }
    return $str;
}

echo str_repeat('<', $num).str_repeat('>', $num);

echo '<br>';

echo arrows($num);

function sortDeliveryMethods($arr):array{
    $sortArr = [];
    foreach ($arr as $arr1){
        foreach ($arr1['customer_costs'] as $key => $value){
            $sortArr[$key][$arr1['code']] = $value;
        }
    }
    return $sortArr;
}

$deliveryMethodsArray = [
    [
        'code' => 'dhl',
        'customer_costs' => [
            22 => '1.000', 
            11 => '3.000',
        ]
    ],
    [
        'code' => 'fedex',
        'customer_costs' => [
            22 => '4.000',
            11 => '6.000',
        ]
    ]
];
$result = sortDeliveryMethods($deliveryMethodsArray);
echo '<pre>';
var_dump($result);
echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= arrows(3);?>
    <?= arrows(5);?>
</body>
</html>
<?php
return;