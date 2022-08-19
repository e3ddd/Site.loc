<?php

$news1 = [
    [
        'title' => '#1 senectus senectus senectus senectus',
        'description' => 'Tristique senectus et netus et senectus malesuada fames. Commodo elit at imperdiet senectus'
    ],
    [
        'title' => '#2',
        'description' => 'Viverra at in senectustellus  senectus integer. Ut'
    ],
    [
        'title' => '#3 senectus ',
        'description' => 'Arcu odio  ut senectus  sem nulla.Lobortis scelerisque senectus fermentum dui'
    ]

];

foreach ($news1 as $article){
    array_diff($article );
}

//$word = "senectus";
//
//function cmp($a, $b) {
//    if ($a['count'] == $b['count']) {
//        return 0;
//    }
//    return ($a['count'] > $b['count']) ? -1 : 1;
//}
//
//foreach ($news1 as &$article){
//    $tmp1 = substr_count($article['description'], $word);
//    $tmp2 =  substr_count($article['title'], $word);
//    $sum =  substr_count($article['description'], $word) + substr_count($article['title'], $word);
//    if($tmp1 !== 0){
//      $article['count'] = $sum;
//    }
//}
//
//uasort($news1, 'cmp');
//
//foreach ($news1 as &$article){
//
//    echo "Number of word " . $word . " repetitions: " . $article['count'] . PHP_EOL;
//    echo $article['title'] . PHP_EOL;
//    echo $article['description'] . PHP_EOL;
//    echo PHP_EOL;
//
//}


//$news2 = [
//    [
//        'title' => '#1',
//        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In fermentum et sollicitudin ac orci phasellus. Sapien pellentesque habitant morbi tristique senectus et netus. Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Fames ac turpis egestas integer. Ultrices mi tempus imperdiet nulla malesuada. Sollicitudin ac orci phasellus egestas tellus. Pretium quam vulputate dignissim suspendisse. Nisi quis eleifend quam adipiscing. Dignissim sodales ut eu sem integer vitae justo eget. Pretium aenean pharetra magna ac. Consequat ac felis donec et odio pellentesque.'
//    ],
//    [
//        'title' => '#2',
//        'description' => 'Viverra adipiscing at in tellus integer. Ut diam quam nulla porttitor massa id neque. Lorem sed risus ultricies tristique nulla. Tempor orci eu lobortis elementum. Lobortis feugiat vivamus at augue eget. Pellentesque nec nam aliquam sem. Imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor. Tortor consequat id porta nibh. Sed odio morbi quis commodo. Morbi leo urna molestie at elementum eu. Ac orci phasellus egestas tellus. Risus at ultrices mi tempus. Tincidunt id aliquet risus feugiat in. Rhoncus aenean vel elit scelerisque mauris. Molestie nunc non blandit massa enim nec. Id velit ut tortor pretium viverra. Pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at.
//
//'
//    ],
//    [
//        'title' => '#3',
//        'description' => 'Bibendum est ultricies integer quis auctor elit sed vulputate. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. Tellus orci ac auctor augue mauris augue. Sollicitudin nibh sit amet commodo nulla facilisi nullam vehicula ipsum. Eget duis at tellus at. Nunc faucibus a pellentesque sit amet porttitor eget dolor. Odio euismod lacinia at quis risus. Tortor id aliquet lectus proin. Volutpat sed cras ornare arcu dui vivamus. Turpis egestas pretium aenean pharetra magna ac. Lorem ipsum dolor sit amet. Id diam vel quam elementum pulvinar. Netus et malesuada fames ac turpis egestas. Egestas erat imperdiet sed euismod nisi porta lorem. Metus aliquam eleifend mi in nulla posuere sollicitudin. Sagittis orci a scelerisque purus. Porta lorem mollis aliquam ut. Diam sollicitudin tempor id eu nisl. Mollis aliquam ut porttitor leo a diam. Nam at lectus urna duis convallis.'
//    ]
//];
//
//$res = [];
//
//foreach ($news1 as $idx => $article1){;
//    foreach ($news2 as $article2){
//        if($article1 === $article2){
//            $res[$idx] = $article1;
//        }
//    }
//}
//
//foreach ($res as $article){
//    echo "Article: ";
//    foreach ($article as $item){
//        echo $item . PHP_EOL;
//    }
//}

//$arr = [
//    [
//        'id' => 1,
//        'value' => 'wonderfull1',
//    ],
//    [
//        'id' => 3,
//        'value' => 'world3'
//    ],
//    [
//        'id' => 4,
//        'value' => 'world4'
//    ],
//    [
//        'id' => 5,
//        'value' => 'world5'
//    ],
//];

//$arr = array(
//    array(1,3,2,5,6),
//    array(2,4,3,1,5),
//    array(4,1,5,6,7),
//    array(6,1,3,10,7)
//);


//$rowSum = [];
//$colSum = [];
//
////$colSum  = array_fill_keys(
////    array_keys(
////        $arr[array_key_first($arr)]
////    ),
////    0
////);
////
//
//
//
//foreach ($arr as $rowId => $row){
//    $rowSum[$rowId] = array_sum($row);
//    foreach ($row as $colId => $value) {
//        if (!isset($colSum[$colId])) {
//            $colSum[$colId] = 0;
//        }
//        $colSum[$colId] += $value;
//    }
//}
//
//foreach ($arr as $rowId => $row){
//    foreach ($row as $colId => $col){
//        echo str_pad($col, 3, " ", STR_PAD_LEFT);
//        if($colId == array_key_last($row)) {
//            echo str_pad($rowSum[$rowId], 6, " ", STR_PAD_LEFT) . PHP_EOL;
//        }
//    }
//}
//
//$sum = array_sum($rowSum);
//
//echo PHP_EOL;
//
//foreach ($colSum as $col){
//    echo str_pad($col, 3, " ", STR_PAD_LEFT);
//}
//
//echo str_pad($sum, 6, " ", STR_PAD_LEFT);
//
//echo PHP_EOL;
//





//
//function foo4($item)
//{
//    $item->value = str_replace('rl', 'sh', $item->value);
//}
//
//$newArr = array_map(function ($item) {
//    $o = new stdClass();
//    $o->id = $item['id'];
//    $o->value = $item['value'];
//    return $o;
//}, $arr);
//
//
//array_walk($newArr, 'foo4');
//
//print_r($newArr);
//return;
//
//foreach ($arr as $item){
//    echo "ID: " . $item['id'] . PHP_EOL;
//    echo "Value: " . $item['value'] . PHP_EOL;
//    echo PHP_EOL;
//}



//    $newArr = array_filter($arr, function($item) {
//        return str_contains($item['value'], 'rl');
//    });
//
//function foo3($item): bool
//{
//    return str_contains('rl', $item['value']);
//}
//
//var_dump(array_filter($arr, "foo3"));
//


//$a = 'hello';

//$t = microtime(true);
//for($i=0; $i<1000000; $i++) {
//    foo2($arr);
//}
//echo round(microtime(true) - $t, 2);

//   $tmp = array_column($arr, 'id');
//
//   function foo($array)
//   {
//       sort($array);
//
//       $idx = 0;
//       foreach($array as $item){
//         $idx++;
//         if($idx != $item){
//            return $idx;
//         }
//       }
//       return $idx + 1;
//   }

//function foo2(array $arr): int
//{
//    for($idx=1; in_array($idx, $arr); $idx++);
//
//    return $idx;
//}



//    $num = foo($tmp);
//    $item = [
//        'id' => $num,
//        'value' => $a . $num
//    ];
//   $arr[] = $item;

//
//foreach ($arr as $item){
//    echo "ID: " . $item['id'] . PHP_EOL;
//    echo "Value: " . $item['value'] . PHP_EOL;
//    echo PHP_EOL;
//}


//foreach ($arr as $key => $item)
//{
//    echo "Element" . " " . $key . ":" . $item . PHP_EOL;
//}
//
//echo PHP_EOL;
//
//array_unshift($arr, $a);
//$arr[] = $b;
//
//foreach ($arr as $key => $item)
//{
//    echo "Element" . " " . $key . ":" . $item . PHP_EOL;
//}

