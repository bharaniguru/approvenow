<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function sendFaxWithHtml($faxNumber,$html) 
{
    /**************** Settings begin **************/
    $username = 'maisondx'; // Enter your Interfax username here
    $password = 'Westero5'; // Enter your Interfax password here
    $faxnumber = $faxNumber; // Enter your designated fax number here in the format +[country code][area code][fax number], for example: +12125554874
    $texttofax = $html; // Enter your fax contents here
    $filetype = 'TXT'; // If $texttofax is regular text, enter TXT here. If $texttofax is HTML enter HTML here
     
    /**************** Settings end ****************/
     
    $client = new SoapClient("http://ws.interfax.net/dfs.asmx?wsdl");
    $params = new stdClass(); 
    $params->Username  = $username;
    $params->Password  = $password;
    $params->FaxNumber = $faxnumber;
    $params->Data      = $texttofax;
    $params->FileType  = $filetype;
    $result = $client->Sendfax($params);
    return $result->SendfaxResult; 
}
function sendFaxWithPdf($faxNumber, $pdfPath) 
{
    /**************** Settings begin **************/
    $username          = 'maisondx';  // Insert your InterFAX username here
    $password          = 'Westero5';  // Insert your InterFAX password here
    $faxnumber         = $faxNumber;  // Enter the destination fax number here, e.g. +497116589658
    //$faxnumber         = '+18772200199';  // Enter the destination fax number here, e.g. +497116589658
    $filename          = $pdfPath; // A file in your filesystem
    $filetype          = 'PDF'; // File format; supported types are listed at 
                       // http://www.interfax.net/en/help/supported_file_types 
     
    /**************** Settings end ****************/
     
    // Open File
    if( !($fp = fopen($filename, "r"))){
        // Error opening file
        echo "Error opening file";
        exit;
    }
     
    // Read data from the file into $data
    $data = "";
    while (!feof($fp)) $data .= fread($fp,1024);
    fclose($fp);
     
     
    $client = new SoapClient("http://ws.interfax.net/dfs.asmx?WSDL");
    $params = new stdClass(); 
    $params->Username  = $username;
    $params->Password  = $password;
    $params->FaxNumber = $faxnumber;
    $params->FileData  = $data;
    $params->FileType  = $filetype;
     
    $result = $client->Sendfax($params);
    return $result->SendfaxResult; // returns the transactionID if successful
                                 // or a negative number if otherwise
}
?>