<?php

namespace App\Http\Controllers;

use App\Models\ThongKeModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class ThongKeController extends Controller
{
    public function dsCanBoToanTruong(Request $request)
    {
        $inputFileName = public_path('exports/ds-can-bo-toan-truong.xlsx');
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $excel = $objReader->load($inputFileName);
        $excel->setActiveSheetIndex(0);

        $dsCB = ThongKeModel::danhsachNhanVien();
        $stt = 1;
        $num_row = 5;
        $cell = $excel->getActiveSheet();

        $tongNam = 0;
        $trinhDo = [];

        ToolsModel::excel_new_row($cell, $num_row, count($dsCB) - 1);
        foreach ($dsCB as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, ToolsModel::sentenceCase($row->hoten));

            if($row->gioitinh == "Nam"){
                $tongNam++;
                $cell->setCellValue('C' . $num_row, "x");
            }
            else
                $cell->setCellValue('D' . $num_row, "x");

            $cell->setCellValue('E' . $num_row, $row->trinhdochuyenmon);
            $cell->setCellValue('F' . $num_row, $row->chucdanh);
            $cell->setCellValue('G' . $num_row, $row->loainhanvien);
            $cell->setCellValue('H' . $num_row, $row->tenchucvu);
            $cell->setCellValue('I' . $num_row, ToolsModel::sentenceCase($row->tendonvi));

            $excel->getActiveSheet()->getStyle("A" . $num_row . ":I" . $num_row)->applyFromArray(
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
            );
            $num_row++;
        }

        # Thống kê giới tính
        $num_row = $num_row + 2;
        $cell->setCellValue('C' . ($num_row), $tongNam);
        $cell->setCellValue('C' . ($num_row + 1), count($dsCB) - $tongNam);
        $cell->setCellValue('C' . ($num_row + 2), count($dsCB));

        # Thống kê học vị
        $num_row = $num_row + 5;
        $tong = 0;
        $hocVi = ThongKeModel::thongKe_HocVi();
        ToolsModel::excel_new_row($cell, $num_row, count($hocVi));
        foreach($hocVi as $item){
            $cell->setCellValue('B' . $num_row, $item->hocvi);
            $cell->setCellValue('C' . $num_row, $item->tong);
            $tong = $tong + $item->tong;
            $num_row++;
        }
        $cell->setCellValue('B' . $num_row,"TỔNG CỘNG");
        $cell->getStyle('B' . $num_row)->getFont()->setBold(true);
        $cell->setCellValue('C' . $num_row, $tong);

        # Thống kê ngạch
        $num_row = $num_row + 3;
        $tong = 0;
        $chucDanh = ThongKeModel::thongKe_ChucDanh();
        ToolsModel::excel_new_row($cell, $num_row, count($chucDanh));
        foreach($chucDanh as $item){
            $cell->setCellValue('B' . $num_row, $item->chucdanh);
            $cell->setCellValue('C' . $num_row, $item->tong);
            $tong = $tong + $item->tong;
            $num_row++;
        }
        $cell->setCellValue('B' . $num_row,"TỔNG CỘNG");
        $cell->getStyle('B' . $num_row)->getFont()->setBold(true);
        $cell->setCellValue('C' . $num_row, $tong);

        # Thống kê loại nhân viên
        $num_row = $num_row + 3;
        $tong = 0;
        $data = ThongKeModel::thongKe_LoaiNhanVien();
        ToolsModel::excel_new_row($cell, $num_row, count($data));
        foreach($data as $item){
            $cell->setCellValue('B' . $num_row, $item->loainhanvien);
            $cell->setCellValue('C' . $num_row, $item->tong);
            $tong = $tong + $item->tong;
            $num_row++;
        }
        $cell->setCellValue('B' . $num_row,"TỔNG CỘNG");
        $cell->getStyle('B' . $num_row)->getFont()->setBold(true);
        $cell->setCellValue('C' . $num_row, $tong);

        $file_name = ToolsModel::fileName("Danh sách cán bộ CCVC_NLĐ toàn Trường");
        $excel->getActiveSheet()->setTitle("Danh sách T.Trường");
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');;
    }
    //Phúc
    public function getDSCanBoChart()
    {
        $dv = new ThongKeModel();
        $chart  = $dv->thongke_Chart();
        return view('auth.thongke', compact('chart'));
    }
}
