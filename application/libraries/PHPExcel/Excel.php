<?php
/*
// save this file to: ExcelService.class.php

Create new folder 'libs' under your project dir, and download PHPExcel-1.8 library .zip from here..
use this clone url: git@github.com:PHPOffice/PHPExcel.git
OR https://github.com/PHPOffice/PHPExcel.
*/

define('TMP_FILES', FCPATH . "/temp/"); // temp folder where it stores the files into.

/** include PHPExcel classes */
/* I have in my project directory under the libs/ folder. */
$basePath = APPPATH . 'libraries/PHPExcel/Classes/'; // make sure path and dir's are correct.
require 'PHPExcel.php';
require 'PHPExcel/IOFactory.php';

class Excel
{

	private function generateRandomName()
	{
		$randName = substr(md5(date('m/d/y h:i:s:u')), 0, 8);
		if (file_exists(TMP_FILES . $randName . '.html')) {
			return $this->generateRandomName();
		}
		return $randName;
	}

	public function al($data)
	{
		$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		$alpha_flip = array_flip($alphabet);
		if ($data <= 25) {
			return $alphabet[$data];
		} elseif ($data > 25) {
			$dividend = ($data + 1);
			$alpha = '';
			$modulo;
			while ($dividend > 0) {
				$modulo = ($dividend - 1) % 26;
				$alpha = $alphabet[$modulo] . $alpha;
				$dividend = floor((($dividend - $modulo) / 26));
			}
			return $alpha;
		}
	}

	// public function al($arg)
	// {
	// 	$this->ci = &get_instance();
	// 	$this->ci->load->library('lib');
	// 	return $this->ci->lib->toAlp($arg);
	// }

	/* Function to generate excel file from html content using php (phpexcel 2007)*/
	public function generateExcel($content, $param = [])
	{ // $content <- html_content

		if (isset($param['file_name'])) {
			$filename = $param['file_name'];
		} else {
			$filename = $this->generateRandomName();;
		}

		if (!ini_get('date.timezone')) {
			date_default_timezone_set('GMT');
		}

		if (!is_dir(TMP_FILES)) { // check if temp folder not not exists
			mkdir(TMP_FILES, 0777); // create new temp dir for storing xlsx files.
		}

		$htmlfile = TMP_FILES . $filename . '.html'; // create new html file under temp folder
		file_put_contents($htmlfile, utf8_decode($content)); // copy the html contents into tmp created html file

		$align['center'] = ['horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER];

		$objReader = new PHPExcel_Reader_HTML; // new loader
		$objPHPExcel = $objReader->load($htmlfile); // load .html file that generated under temp folder

		// Set properties
		$objPHPExcel->getProperties()->setCreator('https://absenku.com/');
		$objPHPExcel->getProperties()->setLastModifiedBy('Absenku Profesional');
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Document");
		$objPHPExcel->getProperties()->setSubject("XLSX Report");
		$objPHPExcel->getProperties()->setDescription("XLSX report document for Office 2007");

		#START FORMATING;
		if (isset($param['paper_size'])) {
			if ($param['paper_size'] == 'FOLIO') {
				$papersize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO;
			} elseif ($param['paper_size'] == 'A4') {
				$papersize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4;
			} elseif ($param['paper_size'] == 'LEGAL') {
				$papersize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL;
			} else {
				$papersize = PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER;
			}
			$objPHPExcel->getActiveSheet()
				->getPageSetup()->setPaperSize($papersize);
		}

		if (isset($param['orientation'])) {
			if ($param['orientation'] == 'landscape') {
				$orientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE;
			} else {
				$orientation = PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT;
			}
			$objPHPExcel->getActiveSheet()
				->getPageSetup()
				->setOrientation($orientation);
		}


		if (isset($param['orientation'])) {
			$fontStyle = [
				'font' => [
					'size' => 9
				]
			];
			$objPHPExcel->getActiveSheet()
				->getStyle($objPHPExcel->getActiveSheet()->calculateWorksheetDimension())
				->applyFromArray($fontStyle);
		}

		if (isset($param['freezecolumn'])) {
			foreach($param['freezecolumn'] as $k => $v)
			{
				$objPHPExcel->getActiveSheet()->freezePane($v);
			}
		}


		if (isset($param['page_margin'])) {
			#SET MARGIN PRINT
			if (isset($param['page_margin']['top'])) {
				$objPHPExcel->getActiveSheet()
					->getPageMargins()->setTop($param['page_margin']['top']);
			}

			if (isset($param['page_margin']['right'])) {
				$objPHPExcel->getActiveSheet()
					->getPageMargins()->setRight($param['page_margin']['right']);
			}

			if (isset($param['page_margin']['left'])) {
				$objPHPExcel->getActiveSheet()
					->getPageMargins()->setLeft($param['page_margin']['left']);
			}

			if (isset($param['page_margin']['bottom'])) {
				$objPHPExcel->getActiveSheet()
					->getPageMargins()->setBottom($param['page_margin']['bottom']);
			}
		}

		$malrow = [];
		$malrow[] = 0;
		if (isset($param['pagebreak'])) {
			if ($param['pagebreak'] === true) {
				$_startrow = 1;
				$_lastrow = (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
				for ($i = $_startrow; $i <= $_lastrow; $i++) {
					$c = 'A';
					$cek = $objPHPExcel->getActiveSheet()->getCell($c . $i)->getValue();
					if ($cek === '--PAGEBREAK--') {
						#SET PAGE BREAK
						$objPHPExcel->getActiveSheet()
							->setBreak($c . $i, PHPExcel_Worksheet::BREAK_ROW);
						$objPHPExcel->getActiveSheet()->setCellValue($c . $i, '');
						$malrow[] = $i;

						// $objPHPExcel->getActiveSheet()->removeRow($i,$i);
						// echo $i.'<br>';
					}
				}
			}
		}else{
			$_lastrow = (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
			$malrow[] = $_lastrow;
		}
		// echo '<pre>' . var_export($maxrow, true) . '</pre>';
		// exit;

		#SET PRINT AREA
		// 	$objPHPExcel->getActiveSheet()
		// ->getPageSetup()
		// ->setPrintArea('A1:E5,G4:M20');

		/* simple style to make sure all cell's text have HORIZONTAL_LEFT alignment */
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			)
		);
		$cs = 0;
		$ce = $param['cLength'];

		$brs_last = $malrow[count($malrow)-1];

		if (isset($param['header'])) {
			if (count($param['header']) > 0) {
				foreach ($param['header'] as $key => $value) {
					foreach ($malrow as $r) {

						if($r != $brs_last)
						{
							// $rw = $key; //(isset($malrow)) ? (int)$malrow+(int)$key : $key;
							$rw = (int)$r + (int)$key;

							$cl = $this->al($cs) . $rw . ':' . $this->al($ce) . $rw;

							// $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rw, implode(',', $malrow));

							if (isset($value['merge'])) {
								if ($value['merge'] == true) {
									$objPHPExcel->getActiveSheet()->mergeCells($cl);
								}
							}

							if (isset($value['align'])) {
								$sh = array(
									'alignment' => $align[$value['align']],
								);

								$objPHPExcel->getActiveSheet()->getStyle($cl)->applyFromArray($sh);

							}

							$sh = array(
								'alignment' => array('vertical' => \PHPExcel_Style_Alignment::VERTICAL_TOP),
							);
							$objPHPExcel->getActiveSheet()->getStyle($cl)->applyFromArray($sh);

							$objPHPExcel->getActiveSheet()->getStyle($cl)->getAlignment()->setWrapText(true);
							$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
						}
					}
				}
			}
		}


		if (isset($param['thead'])) {
			if (count($param['thead']) > 0) {
				foreach ($param['thead'] as $key => $value) {
					foreach ($malrow as $r) {
						$rw = (int)$r + (int)$value;

						$sh = array(
							'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,),
						);
						$cl = $this->al($cs) . $rw . ':' . $this->al($ce) . $rw;
						$objPHPExcel->getActiveSheet()->getStyle($cl)->applyFromArray($sh);
						$objPHPExcel->getActiveSheet()->getStyle($cl)->getFont()->setBold(true);
						$objPHPExcel->getActiveSheet()->getStyle($cl)->getAlignment()->setWrapText(true);
					}
				}
			}
		}

		if (isset($param['tbody'])) {
			if (count($param['tbody']) > 0) {
				// unset($malrow[0]);
				// $malrow = array_reverse($malrow);
				// array_unshift($malrow, "0");
				$str = (int)$param['tbody']['start'];
				$l_rw = count($malrow);
				foreach ($malrow as $krw => $mlrw) {
					if ($l_rw > 1) {
						$start_row = ((int)$mlrw == '0') ? $str :  $str + (int)$mlrw;
						$last_row = next($malrow);

						$h_rw = $l_rw - 1;
						$ok_continue = false;
						if ($krw != $h_rw) {
							$ok_continue = true;
						}
					} else {
						$start_row = $str;//(int)$param['tbody']['start'];
						$last_row = (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
						$ok_continue = true;
					}



					if ($ok_continue === true) {
						// echo '[' . $str . '-' . $krw . ' - ' . $l_rw . '] - [' . $start_row . '-' . $last_row . ']' . '<br>';

						// $start_row = (int)$param['tbody']['start'];
						// $last_row = (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
						if(isset($param['tbody']['jarak_footer'])){
							$jarak_footer = (int)$param['tbody']['jarak_footer'];
						}else{
							$jarak_footer = 0;
						}
						for ($i = $start_row; $i <= ($last_row-$jarak_footer); $i++) {
							for ($o = $cs; $o <= $ce; $o++) {
								$bd = $this->al($o) . $i;

								// $bd = $this->al($cs).$i.':'.$this->al($ce).$i;

								$styleThinBlackBorderOutline = array(
									'borders' => array(
										'outline' => array(
											'style' => PHPExcel_Style_Border::BORDER_THIN,
											'color' => array('argb' => 'FF000000'),
										),
									),
								);
								// $objPHPExcel->getActiveSheet()->getStyle($bd)->applyFromArray($styleThinBlackBorderOutline);

								// RUN FUNCTION
								if (isset($param['tbody']['runFunction'])) {
									foreach ($param['tbody']['runFunction'] as $rk => $vk) {
										if ($rk == 'highlightlibur') {
											$vi = $objPHPExcel->getActiveSheet()->getCell($vk . $i)->getValue();

											if (strtoupper($vi) == 'LIBUR') {
												$corow = $this->al($cs) . $i . ':' . $this->al($ce) . $i;
												// $objPHPExcel->getActiveSheet()->setCellValue($vk.$i, $corow);
												// $vk.$i

												$objPHPExcel->getActiveSheet()->getStyle($corow)->applyFromArray(
													array(
														'fill' => array(
															'type' => PHPExcel_Style_Fill::FILL_SOLID,
															'color' => array('rgb' => 'FF2929')
														)
													)
												);
											}
										}
										// if(function_exists($rk))
										// {
										// 	call_user_func($rk, $objPHPExcel, $vk, $i);
										// }
									}
								}

								$objPHPExcel->getActiveSheet()->getStyle($bd)->applyFromArray($styleThinBlackBorderOutline);
								$objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							}
						}


						if (isset($param['tbody']['wrap'])) {
							foreach ($param['tbody']['wrap'] as $key => $value) {
								$cl = $value . $start_row . ':' . $value . $last_row;

								// echo '<pre>' . var_export($cl, true) . '</pre>';

								$objPHPExcel->getActiveSheet()->getStyle($cl)->getAlignment()->setWrapText(true);
								$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
							}
						}
						// exit;

						if (isset($param['tbody']['height'])) {
							for ($st = $start_row; $st <= $last_row; $st++) {
								$objPHPExcel->getActiveSheet()->getRowDimension($st)->setRowHeight($param['tbody']['height']);
								if (isset($param['tbody']['column'])) {
                                    for ($i = $cs; $i <= $ce; $i++) {
                                        $wd = strtoupper($this->al($i));

                                        if (isset($param['tbody']['column'][$wd])) {
                                            if (isset($param['tbody']['column'][$wd]['format'])) {
                                                if ($param['tbody']['column'][$wd]['format'] == 'text') {
                                                    $vl = $objPHPExcel->getActiveSheet()->getCell($wd.$st)->getValue();

                                                    if ( preg_match('/# *([^#]+)/', $vl, $newval) ){
														$objPHPExcel->getActiveSheet()->setCellValueExplicit($wd.$st, $newval[1], PHPExcel_Cell_DataType::TYPE_STRING);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
							}
						}

						for ($i = $cs; $i <= $ce; $i++) {
							$wd = strtoupper($this->al($i));

							if (isset($param['tbody']['column'][$wd])) {
								if (isset($param['tbody']['column'][$wd]['width'])) {
									$objPHPExcel->getActiveSheet()->getColumnDimension($wd)->setWidth($param['tbody']['column'][$wd]['width']);
								} else {
									$objPHPExcel->getActiveSheet()->getColumnDimension(strtoupper($wd))->setAutoSize(true);
								}
							} else {
								$objPHPExcel->getActiveSheet()->getColumnDimension(strtoupper($wd))->setAutoSize(true);
							}
						}

						if (isset($param['tbody']['column'])) {
							for ($i = $cs; $i <= $ce; $i++) {
								$wd = strtoupper($this->al($i));

								if (isset($param['tbody']['column'][$wd])) {
									if (isset($param['tbody']['column'][$wd]['align'])) {
										if ($param['tbody']['column'][$wd]['align'] == 'center') {
											$sh = array(
												'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
											);
										} elseif ($param['tbody']['column'][$wd]['align'] == 'right') {
											$sh = array(
												'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
											);
										} elseif ($param['tbody']['column'][$wd]['align'] == 'left') {
											$sh = array(
												'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT),
											);
										} elseif ($param['tbody']['column'][$wd]['align'] == 'top') {
											$sh = array(
												'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::VERTICAL_TOP),
											);
										}
										$objPHPExcel->getActiveSheet()->getStyle($wd . $start_row . ':' . $wd . $last_row)->applyFromArray($sh);
									}

								}
							}
						}

						if (isset($param['tbody']['column'])) {
							for ($i = $cs; $i <= $ce; $i++) {
								$wd = strtoupper($this->al($i));

								if (isset($param['tbody']['column'][$wd])) {
									if (isset($param['tbody']['column'][$wd]['rupiah'])) {
										// $objPHPExcel->getActiveSheet()->getStyle($wd.$start_row.':'.$wd.$last_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
										$objPHPExcel->getActiveSheet()->getStyle($wd . $start_row . ':' . $wd . $last_row)->getNumberFormat()->setFormatCode('#,##0');
									}
									if (isset($param['tbody']['column'][$wd]['persen'])) {
										$objPHPExcel->getActiveSheet()->getStyle($wd . $start_row . ':' . $wd . $last_row)->getNumberFormat()->setFormatCode('0.00');
									}
								}
							}
						}
					}
					// echo '<pre>' . var_export($malrow, true) . '</pre>';
				}
				// exit;
			}
		}


		if (isset($param['tfoot'])) {
			if (count($param['tfoot'])) {
				$last_row = (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
				$start_row = (isset($param['tfoot']['start'])) ? (int)$param['tfoot']['start'] : (int)$objPHPExcel->setActiveSheetIndex()->getHighestRow();
				for ($i = $start_row; $i <= $last_row; $i++) {
					$sh = array(
						'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,),
					);
					$cl = $this->al($cs) . $i . ':' . $this->al($ce) . $i;
					$objPHPExcel->getActiveSheet()->getStyle($cl)->applyFromArray($sh);
					$objPHPExcel->getActiveSheet()->getStyle($cl)->getFont()->setBold(true);
				}
			}
		}

		//Apply the style
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);

		#END FORMATING;

		$excelFile = TMP_FILES . $filename . '.xlsx'; // create excel file under temp folder.

		// Creates a writer to output the $objPHPExcel's content
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($excelFile); // saving the excel file

		unlink($htmlfile); // delete .html file

		if (file_exists($excelFile)) {
			$fname = $filename . '.xlsx';
			if (isset($param['download'])) {
				if ($param['download'] == true) {
					$this->downloadFile($fname);
				} else {
					return $fname;
				}
			} else {
				return $fname;
			}
		}

		return false;
	}

	/* Function to download file using php.*/
	public function downloadFile($fname = '')
	{
		$fields = array("fileName");

		if ($fname != '') {
			$file_name = $fname;
		} else {
			$file_name = $_GET['fileName'];
		}

		$fileName = TMP_FILES . $file_name;
		$fileNamePieces = explode('.', $fileName);
		if (count($fileNamePieces) > 1) {
			$fileType = array_pop($fileNamePieces);
		}

		if (file_exists($fileName) && ($fileType == 'html' || $fileType == 'xlsx')) {
			if ($fileType == 'xlsx') {
				header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Pragma: ');
				header('Cache-Control: ');
				header('Content-disposition: attachment; filename="' . $file_name . '"');
			} else {
				header('Content-Type: text/html');
			}

			readfile($fileName);
			unlink($fileName); // each asset can only be accessed once, delete after access
			exit();
		}
	}

	function highlightlibur(&$objPHPExcel, &$alp, &$row)
	{
		$value = $objPHPExcel->getActiveSheet()->getCell($alp . $row)->getValue();

		if (strtoupper($value) == 'L') {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($alp, $row, 'CEK');
			// $objPHPExcel->getActiveSheet()->getStyle($alp.$row)->applyFromArray(
			// 	array(
			// 		'fill' => array(
			// 			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			// 			'color' => array('rgb' => 'FF2929')
			// 		)
			// 	)
			// );
		}
	}
}

/*
Creator: Narain Sagar (Nine)
Created: 09-11-2015
Cheers! Thanks.
*/
