<?php
namespace {EXTENSIONS_NAMESPACE}\{EXTENSION_NAME}\Controllers;

use DblEj\Application\IMvcWebApplication,
    DblEj\Communication\Http\Request,
    DblEj\Data\ArrayModel,
    DblEj\Mvc\ControllerBase;

class SomePage extends ControllerBase
{
	public function DefaultAction(Request $request, IMvcWebApplication $app) 
	{
		return $this->createResponseFromRequest($request, $app);
	}
    
	public function SomePage(Request $request, IMvcWebApplication $app) 
	{
        $someVal1 = "";
        $someVal2 = "";
		$dataArray = array(
				"SomeData1"=>$someVal1,
				"SomeData2"=>$someVal2
			);
		$model = new ArrayModel($dataArray);
		$response = $this->createResponseFromRequest($request, $app, $model);
		return $response;
	}
}
?>