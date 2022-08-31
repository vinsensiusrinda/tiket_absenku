<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpdf
{

  public function generate($html, $file_name, $format = 'Legal', $orientation = 'L', $param = [])
  {
    ini_set("pcre.backtrack_limit", "100000000");

    // DEFAULT OPTION
    $option = ['mode' => 'utf-8', 'format' => $format, 'orientation' => $orientation];

    $option['default_font_size'] = (isset($param['font_size']) && $param['font_size'] == true) ? (int)$param['font_size'] : 9;

    if (isset($param['custom_font']) && $param['custom_font'] == true) {
      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
      $fontDirs = $defaultConfig['fontDir'];

      $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
      $fontData = $defaultFontConfig['fontdata'];
      $option['fontDir'] = array_merge($fontDirs, [
        APPPATH . 'third_party/mpdf/mpdf/ttfonts/local',
      ]);
      $option['fontdata'] = $fontData + [
        'bookman-old-style' => [
          'R' => 'BOOKOS.TTF',
          'I' => 'BOOKOSI.TTF',
        ]
      ];
      $option['default_font'] = 'bookman-old-style';
    }

    // echo  APPPATH . 'third_party/mpdf/mpdf/ttfonts/local';
    // $option = [
    //   'mode' => 'utf-8', 'format' => $format, 'orientation' => $orientation,
    // ];

    $mpdf = new \Mpdf\Mpdf($option);

    if (isset($param['show_watermark']) && $param['show_watermark'] == true) {
      $mpdf->SetWatermarkImage(
        base_url()."assets/images/logo-absenku.png",
        0.1,
        array(210, 65),
        'F'
      );
      $mpdf->showWatermarkImage = true;
    }

    if (isset($param['page_number']) && $param['page_number'] == true) {
      // $mpdf->setFooter('Hal. {PAGENO} dari {nb}');
      $app_name = base_url();
      $mpdf->setFooter('
      <table width="100%" border="0" style="border:1px solid #fff; font-size:10px;">
          <tr>
              <td width="33%" style="text-align: left;">Tanggal Cetak : {DATE d-m-Y H:i:s}</td>
              <td width="33%" align="center">' . ((isset($param["nama_company"]))?$param["nama_company"]:"") . '</td>
              <td width="33%" style="text-align: right; font-weight:bold; font-style:italic;">Hal. {PAGENO} dari {nbpg}</td>
          </tr>
      </table>');
    }
    $mpdf->WriteHTML($html);
    
    $output = 'I';
    if (isset($param['download']) && $param['download'] == true) {
      $output = 'D';
    }

    $mpdf->Output($file_name . '.pdf', $output);
  }
}
