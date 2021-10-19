<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../../../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*include '../../src/Mike42/Escpos/Printer.php';
include  '../../src/Mike42/Escpos/PrintConnectors/WindowsPrintConnector.php';*/
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $connector = new WindowsPrintConnector("printtickets");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $img = EscposImage::load("../../../images/logoUNA.png"); 
    $printer -> bitImage($img);
    $printer -> text("      UNA SCOLARITE\n");
    $printer -> text("Bienvenu Dr. PINATIBI\n");
    // $printer -> text("Bienvénu Mr. OUATTARA\n");
    $printer -> text("Ticket: A-369\n");
    $printer -> text("Clients avant vous: 14\n");
    $printer -> text("Temps estime: 00:38min\n");
    $printer -> text("Merci de patienter SVP\n");
    $printer -> text("\n");
    $printer -> text("03/10/2021 05:37\n");
    // $printer -> graphics($img);
    $printer -> text("\n\n\n");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
