<?php
    // bai 1
    // $tong = 0;
    // for ($i=1; $i < 21; $i++) { 
    //     $tong = $tong + $i;
    // }
    // print $tong

    // bai 2
    // function veTamgiac($height) {
    //     for ($i=1; $i <= $height; $i++) { 
    //         for ($j=$height-$i; $j > 0; $j--) { 
    //             echo "_";
    //         }
    //         for ($k=1; $k <= (2 * $i - 1); $k++) { 
    //             echo "*";
    //         }
    //         echo "<br>";
    //     }
    // }
    // veTamgiac(5);

    //bai 3
    // function factorial($a) {
    //     if ($a == 1) {
    //         return 1;
    //     }
    //     return $a * factorial($a - 1);
    // }

    // $nhan = factorial(3);
    // echo $nhan;

    //bai 4
    // $kytu = "h";
    // $name = "nhhhhat";
    // $dem = 0;
    // for ($i=0; $i < strlen($name); $i++) { 
    //     if ($kytu == $name[$i]) {
    //         $dem++;
    //     }
    // }
    // echo $dem;

    //bai 5
    // function inbangNhan($number) {
    //     $tich = 0;
    //     for ($i=1; $i <= 10; $i++) { 
    //         $tich = $i * $number;
    //         echo $i . ' x ' . $number . " = " . $tich;
    //         echo "<br>";
    //     }
    // }
    // inbangNhan(9);

    //bai 6

    //bai 7
    // function ktraSoNt($number) {
    //     for ($i=2; $i < sqrt($number); $i++) { 
    //         $cout = 0;
    //         if ($number%$i==0) {
    //             $cout++;
    //         }
    //     }
    //     if($cout != 0) {
    //         echo "khong phai so nguyenn to";
    //     }
    //     else if($cout == 0){
    //         echo "la so nguyen to";
    //     }
    // }
    // ktraSoNt(20);

    //bai 8
    // $input ="ABCZXY";
        
    //     function daochuoi($input)
    //     {
    //         $len = strlen($input) -1;
    //         $output="";
    //         for($i = 0; $i <= strlen($input) -1; $i++){
    //                 $output[$i] = $input[$len];
                
    //                 $len--;
                
    //         }
    //         return $output;
    //     }
    // echo daochuoi($input);

    // bai 9
    // $arr = array(4,2,5,1);
    //     function sapxep($arr){
            
    //         for($i = 0; $i <= count($arr) - 2; $i++){
    //             for($j = $i; $j <= count($arr) -1;$j++){
                    
    //                 if($arr[$j] < $arr[$i]){
    //                     $temp = $arr[$i];
    //                     $arr[$i] = $arr[$j];
    //                     $arr[$j] = $temp;
    //                 }
    //             }
                
    //         }
    //         return $arr;
    //     } 
    //     $arrsapxep = sapxep($arr);
    //     foreach($arrsapxep as $arrcheck){
    //         echo $arrcheck;
    //     }

    //bai 10
    $input = "heIloworld";
        function checkham($input){
            $check =true;
            for($i = 0; $i <= strlen($input) - 1; $i++)
            {
                if($input[$i] >= "a" && $input[$i] <= "z")
                {
                    $check = true;
                    continue;
                }
                else{
                    $check = false;
                    break;
                }
            }
            if($check){
                echo "chuoi la chu thuong";
            }
            else
            {
                echo "Chuoi co chu hoa";
            }
        }

    echo checkham($input);
    
?>