<?php
namespace App\Helpers;
use Excel;

class ExportFile
{
	public function __construct()
	{
		// Api keys global		
	} 
	
	
	public static function csvExportFile($data)
	{  
		if(!empty($data)){
		return	Excel::create('vmd', function($excel) use ($data) {
				$excel->sheet('mySheet', function($sheet) use ($data)
			
				{ 
					$sheet->fromArray($data);
				});
			
			})->export('csv');
		}
	}
}
	
?>