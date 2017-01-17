<?php

namespace {APPLICATION_NAMESPACE}\Api;

use DblEj\Communication\Ajax\AjaxResult,
    DblEj\Data\ArrayModel;

class Example
{

    /**
     * Do something and return an ajax result
     *
     * @param \DblEj\Communication\Http\ApiRequest $apiRequest The api request object which includes methods for reading the request variables and headers.
     * @param string $sourceFunctionName The name of the api call that was made by the client that resulted in this call.
     * @param \DblEj\Application\IApplication $app The running app.
     *
     * @return \DblEj\Communication\Ajax\AjaxResult
     */
    public function FirstExample(\DblEj\Communication\Http\ApiRequest $apiRequest, $sourceFunctionName, \DblEj\Application\IApplication $app)
    {
        //do something
        if ($apiRequest->IsInput("Arg1") && $apiRequest->GetInput("Arg1") == "SomeValue") //hypthetical logic
        {

        }

        $headers = $apiRequest->Get_RequestHeaders();
        if (isset($headers["some-header"]) && $args["some-arg"] == "some-value") //hypthetical logic
        {

        }

        $file = $apiRequest->GetUploadedFile("Arg2");

        //you can return an ajax result
        return new AjaxResult("Call completed!");
    }

    /**
     * Do something and return a data model
     *
     * @param \DblEj\Communication\Http\ApiRequest $apiRequest The api request object which includes methods for reading the request variables and headers.
     * @param string $sourceFunctionName The name of the api call that was made by the client that resulted in this call.
     * @param \DblEj\Application\IApplication $app The running app.
     *
     * @return \DblEj\Data\ArrayModel
     */
    public function SecondExample(\DblEj\Communication\Http\ApiRequest $apiRequest, $sourceFunctionName, \DblEj\Application\IApplication $app)
    {
        //do something
        if ($apiRequest->IsInput("Arg1") && $apiRequest->GetInput("Arg1") == "SomeValue") //hypthetical logic
        {

        }

        $headers = $apiRequest->Get_RequestHeaders();
        if (isset($headers["some-header"]) && $args["some-arg"] == "some-value") //hypthetical logic
        {

        }

        $file = $apiRequest->GetUploadedFile("Arg2");

        //you can also return a model or an array of models, or an array of arbitrary data such as this example
        return ["SomeProperty"=>"SomeValue", "AnotherProperty"=>"AnotherValue"];
    }

}