<?php

$file    = $_GET["file"] ?? '';
$columns = isset($_GET['cols']) ? (int) $_GET['cols'] : 100;

if (! $file || ! file_exists($file)) {
    die('File not found. Please specify the parameter ?file=name.png');
}

$info = getimagesize($file);
$mime = $info['mime'] ?? '';
switch ($mime) {
    case 'image/jpeg':
        $img = imagecreatefromjpeg($file);
        break;
    case 'image/png':
        $img = imagecreatefrompng($file);
        break;
    case 'image/gif':
        $img = imagecreatefromgif($file);
        break;
    default:
        die("Unsupported type: $mime");
}

$orig_w = imagesx($img);
$orig_h = imagesy($img);

$aspectRatio = 0.7;
$new_w       = $columns;
$new_h       = max(1, (int) ($orig_h * ($new_w / $orig_w) * $aspectRatio));

$resized = imagecreatetruecolor($new_w, $new_h);
imagecopyresampled($resized, $img, 0, 0, 0, 0, $new_w, $new_h, $orig_w, $orig_h);

$chars    = "@%#*+=-:.";
$charsLen = strlen($chars) - 1;

header('Content-Type: text/html; charset=utf-8');
echo "<pre style='font-family: monospace; line-height: 80%; font-size: 8px; background: black;'>";

for ($y = 0; $y < $new_h; $y++) {
    $line = '';
    for ($x = 0; $x < $new_w; $x++) {
        $rgb = imagecolorat($resized, $x, $y);
        $r   = ($rgb >> 16) & 0xFF;
        $g   = ($rgb >> 8) & 0xFF;
        $b   = $rgb & 0xFF;

        $lum  = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
        $norm = $lum / 255;
        $idx  = (int) round((1 - $norm) * $charsLen);

        $color = sprintf("rgb(%d,%d,%d)", $r, $g, $b);
        $line .= "<span style='color:$color'>" . $chars[$idx] . "</span>";
    }
    echo $line . "<br>";
}
echo "</pre>";

imagedestroy($resized);
imagedestroy($img);
