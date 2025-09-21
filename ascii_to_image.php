<?php

# save the picture in the same folder as the code
# change the file picture name in $file
# please use terminal to run this code
# run code: php ascii_to_image.php

$file = "miyabi.jpg";
$output = "ascii.png";
$cols = 200;

$info = getimagesize($file);
switch ($info['mime']) {
    case 'image/jpeg': $img = imagecreatefromjpeg($file); break;
    case 'image/png': $img = imagecreatefrompng($file); break;
    case 'image/gif': $img = imagecreatefromgif($file); break;
    default: die("Unsupported type");
}

$orig_w = imagesx($img);
$orig_h = imagesy($img);

$aspectRatio = 0.55;
$new_w = $cols;
$new_h = max(1, (int)($orig_h *($new_w / $orig_w) * $aspectRatio));

$resized = imagecreatetruecolor($new_w, $new_h);
imagecopyresampled($resized, $img, 0, 0, 0, 0, $new_w, $new_h, $orig_w, $orig_h);

$chars = "@%#*+=-.";
$charsLen = strlen($chars) - 1;

# don't forget to put any of your favorite fonts in the folder with the format .ttf

$fontSize = 8;
$fontFile = __DIR__ . "/DejaVuSansMono.ttf";
$charW = 8;
$charH = 12;

$out_w = $new_w * $charW;
$out_h = $new_h * $charH;

$outImg = imagecreatetruecolor($out_w, $out_h);
$black = imagecolorallocate($outImg, 0, 0, 0);
imagefill($outImg, 0, 0, $black);

for ($y=0; $y < $new_h; $y++) {
    for ($x=0; $x < $new_w; $x++) {
        $rgb = imagecolorat($resized, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        $lum = 0.2126*$r + 0.7152*$g + 0.0722*$b;
        $norm = $lum / 255;
        $idx = (int)round((1 - $norm) * $charsLen);

        $color = imagecolorallocate($outImg, $r, $g, $b);
        $char = $chars[$idx];

        imagettftext(
            $outImg,
            $fontSize,
            0,
            $x * $charW,
            $y * $charH + $charH,
            $color,
            $fontFile,
            $char
        );
    }
}

imagepng($outImg, $output);
imagedestroy($img);
imagedestroy($resized);
imagedestroy($outImg);

echo "Save in $output\n";
