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

    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $ticketClient = $_GET['ticketClient'];
    $nbClientAvant = $_GET['nbClientAvant'];
    $tAttenteEstime = $_GET['tAttenteEstime'];
    $DateAndTime = $_GET['date'];

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $img = EscposImage::load("../../../images/logoUNA.png"); 
    $printer -> bitImage($img);
    $printer -> text("......UNA SCOLARITE......\n");
    $printer -> text("Bienvenu ".$nom." ".$prenom." \n");
    // $printer -> text("Bienvénu Mr. OUATTARA\n");
    $printer -> text("Ticket: ".$ticketClient."\n");
    $printer -> text("Clients avant vous: ".$nbClientAvant."\n");
    $printer -> text("Temps estime: ".$tAttenteEstime."min\n");
    $printer -> text("Merci de patienter SVP\n");
    $printer -> text("\n");
    $printer -> text($DateAndTime."\n");
    // $printer -> graphics($img);
    $printer -> text("\n\n\n");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}



/*nom
prenom
ticketClient
guichet
nbClientAvant
tAttenteEstime*/