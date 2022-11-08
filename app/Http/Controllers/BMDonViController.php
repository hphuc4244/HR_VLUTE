<?php

namespace App\Http\Controllers;

use App\Models\BMDonViModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class BMDonViController extends Controller
{
    public function getBMNhanSuTheoDV(Request $request, $madonvi){
        $inputFileName = public_path('exports/BM_Xuất thông tin nhân sự theo đơn vị.xlsx');
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $excel = $objReader->load($inputFileName);
        $excel->setActiveSheetIndex(0);

        $cell = $excel->getActiveSheet();
        $num_row = 4;
        $stt = 1;
        $data = BMDonViModel::DSNhanSu($madonvi);
        $cell->setCellValue('B2', $data[0]->tendonvi);
        foreach ($data as $row){
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->hoten);
            $cell->setCellValue('C' . $num_row, $row->tenchucvu);
            $cell->setCellValue('D' . $num_row, $row->chucdanh);
            $cell->setCellValue('E' . $num_row, $row->ngaysinh);
            $cell->setCellValue('F' . $num_row, $row->gioitinh);
            $cell->setCellValue('G' . $num_row, $row->quequan);
            $cell->setCellValue('H' . $num_row, $row->sodienthoai);
            $cell->setCellValue('I' . $num_row, $row->cmnd);
            $cell->setCellValue('J' . $num_row, $row->ngaycapcmnd);
            $cell->setCellValue('K' . $num_row, $row->noicapcmnd);

            $excel->getActiveSheet()->getStyle("A" . $num_row . ":K" . $num_row)->applyFromArray(
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

        $file_name = ToolsModel::fileName( "DanhSachNhanSuTheoDonVi");
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file_name.'.xlsx"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    }

    // Lấy DS kèm quyết định
//    public function getDSKemQD(Request $request, $id_khoa_thi){
//        set_time_limit(0);
//        $templateProcessor = new TemplateProcessor(public_path('docx/DSKemTheoQD.docx'));
//        $ct = BMKhoaThiModel::thongTinKhoaThiCC($id_khoa_thi);
//        $data = BMKhoaThiModel::getDSKemQD($id_khoa_thi);
//
//        $tmp_ten_khoa_thi = $ct->ten_khoa_thi;
//        $templateProcessor->setValue('ten_khoa_thi', $tmp_ten_khoa_thi);
//        $templateProcessor->setValue('ngay_thi', ToolsModel::ngay_thi($ct));
//        $templateProcessor->setValue('tong', count($data));
//        $templateProcessor->setValue('ngay_thang_nam', ToolsModel::ngayThangNam($html=false));
//
//        $templateProcessor->cloneRow('aValue', count($data));
//        for($i = 1; $i <= count($data); $i++) {
//            $item = $data[$i - 1];
//            $templateProcessor->setValue('aValue#' . $i, $i);
//            $templateProcessor->setValue('bValue#' . $i, $item->so_bao_danh);
//            $templateProcessor->setValue('cValue#' . $i, $item->ho);
//            $templateProcessor->setValue('dValue#' . $i, $item->ten);
//            $templateProcessor->setValue('eValue#' . $i, $item->ngay_sinh);
//            $templateProcessor->setValue('fValue#' . $i, $item->gioi_tinh);
//            $templateProcessor->setValue('gValue#' . $i, $item->noi_sinh);
//            $templateProcessor->setValue('hValue#' . $i, $item->cmnd);
//            $templateProcessor->setValue('iValue#' . $i, $item->dan_toc);
//            $templateProcessor->setValue('jValue#' . $i, $item->mssv);
//            if($item->id_khoa_hoc == -1)
//                $templateProcessor->setValue('kValue#' . $i, "Tự do");
//            else
//                $templateProcessor->setValue('kValue#' . $i, $item->ten_khoa_hoc);
//        }
//
//        $file_name = ToolsModel::fileName($tmp_ten_khoa_thi . " - DS kèm theo QĐ");
//        header('Content-Disposition: attachment;filename="' . $file_name.'.docx"');
//        $templateProcessor->saveAs('php://output');
//    }
//
//    // Thẻ dự thi
//    public function getPDFTheDuThi(Request $request, $id_khoa_thi){
//        $ct = BMKhoaThiModel::thongTinKhoaThiCC($id_khoa_thi);
//        $file_name = ToolsModel::fileName($ct->ten_khoa_thi . "_" . $request->input('phong') . "_Thẻ_dự_thi");
//
//        $config = ['watermark'=> '', 'margin_left' => 5, 'margin_right' => 5];
//        $pdf = mPDF::loadView('auth.export-khoa-thi.the-du-thi',
//            [
//                'dsThiSinh' => BMKhoaThiModel::theDuThi($id_khoa_thi, $request->input('phong')),
//                'ct'=> $ct
//            ], [], $config);
//
//        $pdf->getMpdf()->SetWatermarkText("");
//        $pdf->getMpdf()->SetTitle($file_name);
//        $pdf->getMpdf()->SetProtection(array('print'));
//        return $pdf->stream($file_name . ".pdf");
//    }
}
