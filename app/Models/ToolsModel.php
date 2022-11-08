<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPExcel_IOFactory;
use function PHPUnit\Framework\isEmpty;

class ToolsModel extends Model
{
    public static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function convertDMY($date){
        if(strtotime($date) > 0){
            return date("d/m/Y", strtotime($date));
        }
        else return "";
    }

    public static function status($code, $message)
    {
        return json_encode((object)["status" => $code, "message" => $message]);
    }

    public static function readExcel($file, $range = 'A2')
    {
        $data = [];
        if (file_exists($file)) {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $sheet->getHighestRow();
            $highestCol = $sheet->getHighestColumn();
            $data = $sheet->rangeToArray("$range:$highestCol$highestRow", null, true, false, false);;
        }
        return [
            'col' => $highestCol,
            'row' => $highestRow,
            'data' => $data
        ];
    }

    public static function excel_new_row(&$sheet, $num_rows, $total_row = 1)
    {
        $sheet->insertNewRowBefore($num_rows + 1, $total_row);
    }

    public static function excel_border(&$sheet, $num_rows)
    {
        $sheet->getActiveSheet()->getStyle($num_rows)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
    }

    public static function excel_set_value(&$sheet, $index, $value)
    {
        $sheet->setCellValue($index, $value);
    }

    public static function sentenceCase($string)
    {
        $name = trim($string);
        $name = mb_strtolower($name, 'UTF-8');
        $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
        return $name;
    }

    public static function upperCase($string)
    {
        $string = trim($string);
        return mb_strtoupper($string, 'UTF-8');
    }

    public static function chartNumber($dest)
    {
        if ($dest)
            return ord(strtolower($dest)) - 97;
        else
            return 0;
    }

    public static function fileName($text)
    {
        $full = $text . "_" . date("Y_m_d");
        return $full;
    }
}
