<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function show(Request $request){

        $array = ["salom", "youtube.com", "programmer.uz", "Salohiddin", "Nuridinov", "Samtuit.uz", "lzjsdc", "hdsbjks", "skjdbcjds", "jsdnj", "jdbnjas", "ldsknkdl", "qiuyref","sldhjak","zsdhbdj", "hjbsd","kzjndjk","kzsjdnjzd",".zkjncz","kczknz","zkjdn","Hello","Men","Otabek"];

        #ProcessPodcast::dispatch($array);
        $array = array_chunk($array, 6);
        //echo $array[0][1]; die;
        $path = public_path("images");
        $count = count($array);
        $b = 20;
        for ($i=0; $i<$count; $i++) {
            $a = 34;
            for ($j=0; $j<count($array[$i]); $j++) {
                $filename = "$path/qr-$i-$j.png";
                QrCode::format("png")->size(80)->generate($array[$i][$j], $filename);

                $back1 = imagecreatefrompng(public_path("images/n14.png"));
                $front1 = imagecreatefrompng(public_path("images/qr-$i-$j.png"));
                imagealphablending($back1, true);
                imagesavealpha($back1, true);
                imagecopy($back1, $front1, 625.5, 267.5, 0, 0, 80, 80);
                imagepng($back1, "images/rasm-$i-$j.png");
                //unlink(public_path("images\qr-$i-$j.png"));
               
                $back = imagecreatefrompng(public_path("images/natija.png"));
                $front = imagecreatefrompng(public_path("images/rasm-$i-$j.png"));
                imagealphablending($back, true);
                imagesavealpha($back, true);
                imagecopy($back, $front, $a, $b, 0, 0, 100, 100);
                imagepng($back, "images/natija.png");
                $a +=160;
                // $r = getimagesize(public_path("images/rasm-$i-$j.png")); 
                // print_r($r);
                // die;
                //unlink(public_path("images\rasm-$i-$j.png"));
            }
            $b += 170;
            
        }    
            
            // if (($i>=6) && ($i<12)) {
                
            //     $a = 34;
            // }
            // if (($i>=12) && ($i<18)) {
            //     $b += 170;
            //     $a = 34;
            // }
            // if (($i>=18) && ($i<24)) {
            //     $b += 170;
            //     $a = 34;
            // }
            // if ($i>=24) {
            //     $b += 170;
            //     $a = 34;
            // }
       

    
    
    
    
        //     PRINT_R(getimagesize(public_path("back.png")));
    //     list($width, $height, $type, $attr,) = getimagesize(public_path("back.png"));

    //     $newimage = "";

    //    switch($type){
    //     case IMAGETYPE_PNG :{
    //         $newimage = \imagecreatefrompng('back.png');
    //         break;
    //     }
    //     case IMAGETYPE_JPEG :{
    //         $newimage = \imagecreatefromjpeg('back.png');
    //         break;
    //     }
    //    }

    //    echo $newimage;

    // $back = imagecreatefrompng(public_path("images/back.png"));
    // $front = imagecreatefrompng(public_path("images/qr-1.png"));
    // imagealphablending($back, true);
    // imagesavealpha($back, true);
    // imagecopy($back, $front, 0, 0, 0, 0, 90, 90);
    // imagepng($back, "images/natija.png");
    }

    public function getQrCode(){
        $array = ["youtube.com", "programmer.uz", "Salohiddin", "Nuridinov", "Samtuit.uz","salom"];

        $array = array_chunk($array, 3);
        $path = public_path("rasm");
        $count = count($array);
        $oqfonsize = getimagesize(public_path("rasm/oqfon.png"));
        $a = ($oqfonsize[1] / 2.4);
        $b = $oqfonsize[1] - ($a * 2);
        $c = $b / 3;
        for ($i=0; $i<$count; $i++) {
            $x = $oqfonsize[0] / 5;
            $y = $x * 2;
            $z = $y / 4;
            $r = $oqfonsize[0] / 10;
            for ($j=0; $j<count($array[$i]); $j++) {
                $filename = "$path/qr-$i-$j.png";
                QrCode::format("png")->size(80)->generate($array[$i][$j], $filename);
                $bluefon = imagecreatefrompng(public_path("rasm/fon.png"));
                $qrcod = imagecreatefrompng(public_path("rasm/qr-$i-$j.png"));
                imagealphablending($bluefon, true);
                imagesavealpha($bluefon, true);
                $fonsize = getimagesize(public_path("rasm/fon.png"));
                $qrsize = getimagesize(public_path("rasm/qr-$i-$j.png"));
                $width = ($fonsize[0] / 2) - ($qrsize[0] / 2);
                $height = ($fonsize[1] / 2) - ($qrsize[1] / 2);
                imagecopy($bluefon, $qrcod, $width, $height, 0, 0, $qrsize[0], $qrsize[0]);
                imagepng($bluefon, "rasm/rasm-$i-$j.png");
                //unlink(public_path("images\qr-$i-$j.png"));
                $oqfon = imagecreatefrompng(public_path("rasm/oqfon.png"));
                $rasm = imagecreatefrompng(public_path("rasm/rasm-$i-$j.png"));
                imagealphablending($oqfon, true);
                imagesavealpha($oqfon, true);
                imagecopy($oqfon, $rasm, $z, $c, 0, 0, $x, $a);
                imagepng($oqfon, "rasm/oqfon.png");
                $z = $x + $z + $r;
            }
            $c +=$a + 40;
     }
}

}