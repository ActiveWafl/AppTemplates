<?php
namespace {APPLICATION_NAMESPACE}\Routers;

class ExampleUrlRewriter
implements \DblEj\Communication\Http\Routing\IUrlRewriter
{
    public function RewriteUrl($url)
    {
        if (strlen($url) > 10)
        {
            //Route /examples/1 to /ExamplePage1 and /examples/2 to /ExamplePage2
            if (substr($url, 0, 10) == "/examples/")
            {
                $exampleIndex = substr($url, 10);
                if ($exampleIndex > 0 && $exampleIndex < 3)
                {
                    $url = "/ExamplePage$exampleIndex";
                }
            }
        }
        return $url;
    }
}