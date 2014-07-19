<?php

$runningScript = $argv[0];

if ($argc == 4)
{
    $appType = $argv[1];
    $settingsIniFile = $argv[2];
    $outFolder = $argv[3];
    $zipOutput = isset($argv[3])?($argv[3]==1):false;

    $settings = array();
    $settingsIni = file_get_contents($settingsIniFile);
    $settingsIni = str_replace("\r\n", "\n", $settingsIni);
    $settingsIni = str_replace("\r", "\n", $settingsIni);
    $settingsArray = explode("\n",$settingsIni);
    foreach ($settingsArray as $setting)
    {
        $settingArray = explode("=",$setting);
        $settings[trim($settingArray[0])] = trim($settingArray[1]);
    }

    switch ($appType)
    {
        case "App":
            $appTemplateFolder = __DIR__.DIRECTORY_SEPARATOR."Application";
            break;
        case "WebApp":
            $appTemplateFolder = __DIR__.DIRECTORY_SEPARATOR."WebApplication";
            break;
        case "MvcWebApp":
            $appTemplateFolder = __DIR__.DIRECTORY_SEPARATOR."MvcWebApplication";
            break;
        case "ModularMvcWebApp":
            $appTemplateFolder = __DIR__.DIRECTORY_SEPARATOR."ModularMvcWebApplication";
            break;
    }

    $files = GetTokenReplacedFiles($appTemplateFolder, $settings);
    $commonfiles = GetTokenReplacedFiles(__DIR__.DIRECTORY_SEPARATOR."Common", $settings);
    
    if ($zipOutput)
    {
        if (file_exists($outFolder))
        {
            throw new \Exception("The destination file already exists");
        }
        $zipFile = new \ZipArchive();
        $zipFile->open($outFolder, \ZipArchive::CREATE);
        AddFilesToZip($files,$zipFile);
        AddFilesToZip($commonfiles,$zipFile);
    } else {
        if (!file_exists($outFolder))
        {
            mkdir($outFolder);
        }
        WriteFiles($files,$outFolder);
        WriteFiles($commonfiles,$outFolder);
    }
} elseif ($argc==3 && $argv[1]=="ini") {
    if (file_exists($argv[2]))
    {
        $lastChar = substr($argv[2], strlen($argv[2])-1);
        if ($lastChar != "/" && $lastChar != "\\")
        {
            $outFile = $argv[2].DIRECTORY_SEPARATOR."Settings.ini";
        } else {
            $outFile = $argv[2]."Settings.ini";
        }
        copy(__DIR__.DIRECTORY_SEPARATOR."Settings.ini", $outFile);
    } else {
        die("Invalid output directory: ".$argv[2]);
    }
} else {
    die("Usage:\n$runningScript <App|WebApp|MvcWebApp|ModularMvcWebApp> <ini path> <out folder>\n$runningScript ini <out folder>");
}

function GetTokenReplacedFiles($dir, $tokens)
{
    $files = array();
    $handle = opendir($dir);
    if ((substr($dir,strlen($dir)-1) != "/")
        &&
        (substr($dir,strlen($dir)-1) != "\\"))
    {
        $dir.=DIRECTORY_SEPARATOR;
    }
    if ($handle)
    {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "."  && $entry != "..")
            {
                $filePath = $dir.$entry;
                if (is_file($filePath))
                {
                    $replacedFileContents = file_get_contents($filePath);
                    foreach ($tokens as $tokenName=>$tokenValue)
                    {
                        $replacedFileContents = str_replace("{".$tokenName."}", $tokenValue, $replacedFileContents);
                    }
                    $files[$entry] = $replacedFileContents;
                }
                else if (is_dir($filePath))
                {
                    $subFiles = GetTokenReplacedFiles($filePath,$tokens);
                    $files[$entry] = $subFiles;
                }
            }
        }
    }
    return $files;
}

function WriteFiles($files, $destinationDir)
{
    if (!file_exists($destinationDir))
    {
        mkdir($destinationDir);
    }
    if ((substr($destinationDir,strlen($destinationDir)-1) != "/")
        &&
        (substr($destinationDir,strlen($destinationDir)-1) != "\\"))
    {
        $destinationDir.=DIRECTORY_SEPARATOR;
    }

    
    foreach ($files as $filename=>$filecontents)
    {
        if (is_array($filecontents))
        {
            WriteFiles($filecontents, $destinationDir.$filename);
        } else {
            file_put_contents($destinationDir.$filename, $filecontents);
        }
    }
}
function AddFilesToZip($files,\ZipArchive $zip, $parentFolderName="")
{
    if ($parentFolderName)
    {
        if ((substr($parentFolderName,strlen($parentFolderName)-1) != "/")
            &&
            (substr($parentFolderName,strlen($parentFolderName)-1) != "\\"))
        {
            $parentFolderName.=DIRECTORY_SEPARATOR;
        }    
    }
    foreach ($files as $filename=>$fileContents)
    {
        if (is_array($fileContents))
        {
            $zip->addEmptyDir($parentFolderName.$filename);
            AddFilesToZip($fileContents, $zip, $parentFolderName.$filename);
        } else {
            $zip->addFile($filename, $parentFolderName.$filename);
        }
    }
}