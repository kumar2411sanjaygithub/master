<?php

namespace App\Common;

class StateList
{
  public static function get_states(){
     /*$json = '{
             "AP":"Andhra Pradesh",
             "AR":"Arunachal Pradesh",
             "AS":"Assam",
             "BR":"Bihar",
             "CG":"Chhattisgarh",
             "Chandigarh":"Chandigarh",
             "DN":"Dadra and Nagar Haveli",
             "DD":"Daman and Diu",
             "DL":"Delhi",
             "GA":"Goa",
             "GJ":"Gujarat",
             "HR":"Haryana",
             "HP":"Himachal Pradesh",
             "JK":"Jammu and Kashmir",
             "JH":"Jharkhand",
             "KA":"Karnataka",
             "KL":"Kerala",
             "MP":"Madhya Pradesh",
             "MH":"Maharashtra",
             "MN":"Manipur",
             "ML":"Meghalaya",
             "MZ":"Mizoram",
             "NL":"Nagaland",
             "OR":"Orissa",
             "PB":"Punjab",
             "PY":"Pondicherry",
             "RJ":"Rajasthan",
             "SK":"Sikkim",
             "TN":"Tamil Nadu",
             "TR":"Tripura",
             "UP":"Uttar Pradesh",
             "UK":"Uttarakhand",
             "WB":"West Bengal"
       }';
       return json_decode($json);*/
       return array('AN'=>array('name'=>'Andaman and Nicobar Islands',	'code'=>'35'),
       'AD'=>array('name'=>'Andhra Pradesh',	'code'=>'37'),
       'AR'=>array('name'=>'Arunachal Pradesh',	'code'=>'12'),
       'AS'=>array('name'=>'Assam',	'code'=>'18'),
       'BR'=>array('name'=>'Bihar',	'code'=>'10'),
       'CH'=>array('name'=>'Chandigarh',	'code'=>'04'),
       'CG'=>array('name'=>'Chattisgarh',	'code'=>'22'),
       'DN'=>array('name'=>'Dadra and Nagar Haveli',	'code'=>'26'),
       'DD'=>array('name'=>'Daman and Diu',	'code'=>'25'),
       'DL'=>array('name'=>'Delhi',	'code'=>'07'),
       'GA'=>array('name'=>'Goa',	'code'=>'30'),
       'GJ'=>array('name'=>'Gujarat',	'code'=>'24'),
       'HR'=>array('name'=>'Haryana',	'code'=>'06'),
       'HP'=>array('name'=>'Himachal Pradesh',	'code'=>'02'),
       'JK'=>array('name'=>'Jammu and Kashmir',	'code'=>'01'),
       'JH'=>array('name'=>'Jharkhand',	'code'=>'20'),
       'KA'=>array('name'=>'Karnataka',	'code'=>'29'),
       'KL'=>array('name'=>'Kerala',	'code'=>'32'),
       'LD'=>array('name'=>'Lakshadweep Islands',	'code'=>'31'),
       'MP'=>array('name'=>'Madhya Pradesh',	'code'=>'23'),
       'MH'=>array('name'=>'Maharashtra',	'code'=>'27'),
       'MN'=>array('name'=>'Manipur',	'code'=>'14'),
       'ML'=>array('name'=>'Meghalaya',	'code'=>'17'),
       'MZ'=>array('name'=>'Mizoram',	'code'=>'15'),
       'NL'=>array('name'=>'Nagaland',	'code'=>'13'),
       'OD'=>array('name'=>'Odisha',	'code'=>'21'),
       'PY'=>array('name'=>'Pondicherry',	'code'=>'34'),
       'PB'=>array('name'=>'Punjab',	'code'=>'03'),
       'RJ'=>array('name'=>'Rajasthan',	'code'=>'08'),
       'SK'=>array('name'=>'Sikkim',	'code'=>'11'),
       'TN'=>array('name'=>'Tamil Nadu',	'code'=>'33'),
       'TS'=>array('name'=>'Telangana',	'code'=>'36'),
       'TR'=>array('name'=>'Tripura',	'code'=>'16'),
       'UP'=>array('name'=>'Uttar Pradesh',	'code'=>'09'),
       'UK'=>array('name'=>'Uttarakhand',	'code'=>'05'),
       'WB'=>array('name'=>'West Bengal',	'code'=>'19'));
   }

 
      public static function numberTowords($num)
      { 
            $ones = array( 
            1 => "one", 
            2 => "two", 
            3 => "three", 
            4 => "four", 
            5 => "five", 
            6 => "six", 
            7 => "seven", 
            8 => "eight", 
            9 => "nine", 
            10 => "ten", 
            11 => "eleven", 
            12 => "twelve", 
            13 => "thirteen", 
            14 => "fourteen", 
            15 => "fifteen", 
            16 => "sixteen", 
            17 => "seventeen", 
            18 => "eighteen", 
            19 => "nineteen" 
            ); 
            $tens = array( 
            1 => "ten",
            2 => "twenty", 
            3 => "thirty", 
            4 => "forty", 
            5 => "fifty", 
            6 => "sixty", 
            7 => "seventy", 
            8 => "eighty", 
            9 => "ninety" 
            ); 
            $hundreds = array( 
            "hundred", 
            "thousand", 
            "million", 
            "billion", 
            "trillion", 
            "quadrillion" 
            ); //limit t quadrillion 
            $num = number_format($num,2,".",","); 
            $num_arr = explode(".",$num); 
            $wholenum = $num_arr[0]; 
            $decnum = $num_arr[1]; 
            $whole_arr = array_reverse(explode(",",$wholenum)); 
            krsort($whole_arr); 
            $rettxt = ""; 
            foreach($whole_arr as $key => $i){ 
            if($i < 20){ 
            $rettxt .= $ones[$i]; 
            }elseif($i < 100){ 
            $rettxt .= $tens[substr($i,0,1)]; 
            $rettxt .= " ".$ones[substr($i,1,1)]; 
            }else{ 
            $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
            $rettxt .= " ".$tens[substr($i,1,1)]; 
            $rettxt .= " ".$ones[substr($i,2,1)]; 
            } 
            if($key > 0){ 
            $rettxt .= " ".$hundreds[$key]." "; 
            } 
            } 
            if($decnum > 0){ 
            $rettxt .= " and "; 
            if($decnum < 20){ 
            $rettxt .= $ones[$decnum]; 
            }elseif($decnum < 100){ 
            $rettxt .= $tens[substr($decnum,0,1)]; 
            $rettxt .= " ".$ones[substr($decnum,1,1)]; 
            } 
            } 
      return $rettxt; 
      } 

}
