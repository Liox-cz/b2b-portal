<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/../source.xlsx');
$sheet = $spreadsheet->getActiveSheet();

// Remove header
$sheet->removeRow(1);

$description = "Nechte se unést kouzlem našich dekoračních pásů na zeď, které promění každou místnost v útulný a stylový prostor. Samolepicí dekorace na zeď jsou ideální volbou pro ty, kteří hledají jednoduchý a elegantní způsob, jak zútulnit svůj domov. Tapetové pásy jsou navrženy tak, aby byly snadno přizpůsobitelné podle vašich potřeb a vkusu. Dekorativní pásy jsou vyrobeny z kvalitních materiálů a díky české výrobě garantují vysokou kvalitu a trvanlivost.\n\nVýhodou těchto dekoračních pásů je jejich jednoduchá aplikace, kterou zvládne i laik. Materiál je vybaven silným permanentním lepidlem, které zajistí dlouhotrvající přilnavost na různých površích, jako jsou malované stěny, sádrokarton, dlaždice, lakovaný plech, PE a PP plast či dřevo. Rozměry pásu (šířka 65 cm a výška 260 cm) umožňují snadné ořezání na potřebnou výšku podle vašich požadavků, například podle výšky stropu nebo velikosti nábytku.\n\nSamolepicí dekorace na zeď jsou navíc omyvatelné jemně vlhkým hadříkem a odolné vůči jemnému poškrábání, což usnadňuje jejich údržbu. Matná povrchová úprava a hladký povrch dodávají produktu elegantní vzhled. Kvalitní tisk s minimální velikostí 720 DPI zajišťuje krásný a realistický vzhled bez chemických zápachů. Dekorační pásy jsou také zařazeny do kategorie M1 normy NF P 92 503-507, což znamená, že jsou nehořlavé a bezpečné pro použití.\n\nDekorační pásy na zeď jsou navíc kids friendly, takže jsou vhodné i pro dětské pokoje nebo pro rodiny s dětmi. Aplikace na rovné povrchy zaručuje bezproblémové použití v mnoha domácnostech.\n\nNečekejte a přidejte si kouzlo do vašeho domova s našimi Samolepicími dekoracemi na zeď. Objevte širokou škálu vzorů a barev, které zvýrazní váš osobitý styl a navodí příjemnou atmosféru.";

$xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<SHOP>
XML;

$mainImageVariant = '2b130323';

$imageVariants = [
    '3c130323',
    '4d130323',
    '5e130323',
    '6f130323',
];

foreach ($sheet->getRowIterator() as $row) {
    $rowIndex = $row->getRowIndex();
    $uuid = $sheet->getCell('A' . $rowIndex)->getValue();

    if ($uuid === null) {
        break;
    }

    $ean = $sheet->getCell('B' . $rowIndex)->getValue();
    $imgUrl = $sheet->getCell('C' . $rowIndex)->getValue();
    $imgUrlAlt1 = str_replace($mainImageVariant, $imageVariants[0], $imgUrl);
    $imgUrlAlt2 = str_replace($mainImageVariant, $imageVariants[1], $imgUrl);
    $imgUrlAlt3 = str_replace($mainImageVariant, $imageVariants[2], $imgUrl);
    $imgUrlAlt4 = str_replace($mainImageVariant, $imageVariants[3], $imgUrl);
    $categoryText = $sheet->getCell('D' . $rowIndex)->getValue();
    $productName = $sheet->getCell('E' . $rowIndex)->getValue();
    $shortDescription = $sheet->getCell('F' . $rowIndex)->getValue();

$xml .= <<<XML
  <SHOPITEM>
    <ITEM_ID>{$uuid}</ITEM_ID>
    <PRODUCTNAME>{$productName}</PRODUCTNAME>
    <PRODUCT>{$productName}</PRODUCT>
    <DESCRIPTION>{$description}</DESCRIPTION>
    <DESCRIPTION_SHORT>{$shortDescription}</DESCRIPTION_SHORT>
    <IMGURL>{$imgUrl}</IMGURL>
    <IMGURL_ALTERNATIVE>{$imgUrlAlt1}</IMGURL_ALTERNATIVE>
    <IMGURL_ALTERNATIVE>{$imgUrlAlt2}</IMGURL_ALTERNATIVE>
    <IMGURL_ALTERNATIVE>{$imgUrlAlt3}</IMGURL_ALTERNATIVE>
    <IMGURL_ALTERNATIVE>{$imgUrlAlt4}</IMGURL_ALTERNATIVE>
    <PRICE_VAT>899</PRICE_VAT>
    <MANUFACTURER>Liox</MANUFACTURER>
    <CATEGORYTEXT>{$categoryText}</CATEGORYTEXT>
    <EAN>{$ean}</EAN>
    <PARAM>
        <PARAM_NAME>Výrobce</PARAM_NAME>
        <VAL>Liox</VAL>        
    </PARAM>
    <PARAM>
        <PARAM_NAME>Samolepící</PARAM_NAME>
        <VAL>ano</VAL>        
    </PARAM>
    <PARAM>
        <PARAM_NAME>Šířka</PARAM_NAME>
        <VAL>65 cm</VAL>        
    </PARAM>
    <PARAM>
        <PARAM_NAME>Výška</PARAM_NAME>
        <VAL>260 cm</VAL>        
    </PARAM>
  </SHOPITEM>
XML;
}

$xml .= <<<XML
</SHOP>
XML;

echo $xml;
