<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function ayah($surah, $ayah)
    {
        $ayah = Ayah::where('surah_id', $surah)
            ->where('ayah_number', $ayah)
            ->firstOrFail();

        $Arabic = new \I18N_Arabic('Glyphs');

        $kalimahs = "";
        foreach ($ayah->kalimahs as $k) {
            $kalimahs .= $k->text;
        }

        return $this->generateImage($Arabic->utf8Glyphs($kalimahs), strip_tags($ayah->translation->text));
    }

    private function generateImage($text1, $text2)
    {
        // Set font paths
        $fontPath1 = public_path('p3.ttf');
        $fontPath2 = public_path('roboto.ttf');

        // Set background path
        $backgroundPath = public_path('nature.jpg');

        // Load background image
        $image = imagecreatefromjpeg($backgroundPath);

        // Set text colors
        $textColor1 = imagecolorallocate($image, 255, 255, 255);
        $textColor2 = imagecolorallocate($image, 255, 255, 255);

        // Set font size
        $fontSize = 20;

        // Set padding
        $padding = 20;

        // Calculate maximum text width
        $maxTextWidth = imagesx($image) - ($padding * 2);

        // Wrap text to fit within maximum width
        $wrappedText1 = $this->wrapText($text1, $fontPath1, $fontSize, $maxTextWidth);
        $wrappedText2 = $this->wrapText($text2, $fontPath2, $fontSize, $maxTextWidth);

        // Calculate text height
        $textHeight = ($fontSize * count($wrappedText1)) + ($fontSize * count($wrappedText2)) + ($padding * 2);

        // Calculate text positions
        $textY1 = (imagesy($image) - $textHeight) / 2;

        // Write wrapped text on image
        $this->writeWrappedText($image, $fontPath1, $fontSize, $textY1, $padding, $wrappedText1, $textColor1);
        // $this->writeWrappedText($image, $fontPath2, $fontSize, $textY1 + ($fontSize * count($wrappedText1)) + $padding + ($textHeight / 4), $padding, $wrappedText2, $textColor2);

        // Output image
        // header('Content-Type: image/jpeg');
        header('Content-Type: image/jpeg; charset=utf-8');

        imagejpeg($image);

        // Destroy image resource
        imagedestroy($image);
    }

    private function wrapText($text, $fontPath, $fontSize, $maxWidth)
    {
        $wrappedText = [];
        $words = explode(' ', $text);
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine . ' ' . $word;
            $bbox = imagettfbbox($fontSize, 0, $fontPath, $testLine);

            if ($bbox[2] - $bbox[0] <= $maxWidth) {
                $currentLine = $testLine;
            } else {
                $wrappedText[] = trim($currentLine);
                $currentLine = $word;
            }
        }

        $wrappedText[] = trim($currentLine);

        return $wrappedText;
    }

    private function writeWrappedText($image, $fontPath, $fontSize, $textY, $padding, $wrappedText, $textColor)
    {
        foreach ($wrappedText as $line) {
            $textX = (imagesx($image) - (imagettfbbox($fontSize, 0, $fontPath, $line)[2] - imagettfbbox($fontSize, 0, $fontPath, $line)[0])) / 2;
            imagettftext($image, $fontSize, 0, $textX, $textY, $textColor, $fontPath, $line);
            $textY += $fontSize + 10;
        }
    }

    private function downloadFont($fontUrl)
    {
        $fontData = file_get_contents($fontUrl);
        $fontPath = sys_get_temp_dir() . '/' . basename($fontUrl);
        file_put_contents($fontPath, $fontData);
        return $fontPath;
    }
}
