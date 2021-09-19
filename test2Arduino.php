
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArduinoLED</title>
    <style type="text/css">
        body{font-size: 20px; background: lightblue;}
        .MCenter{text-align: center;}
        .btnON{width: 100px; background: rgb(22, 184, 78); border-radius: 9px; cursor: pointer;font-size: 20px; }

        .btnOFF{ width: 100px; background: rgb(198, 8, 0); border-radius: 9px; cursor: pointer;font-size: 20px;}
    </style>
</head>



        <script>
            function appelServeur(url) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("etatLED").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            }

        </script>



<body onload="appelServeur()">
  <h1 class="MCenter">Server web démpoyer sur le ESP8266</h1>
  <h2 class="MCenter">On allume et on éteind une LED</h2>
  <h3 class="MCenter">Justin</h3>

  <br><br>
<div class="MCenter">
    <button onclick="appelServeur('/LED=ON')" class="btnON">Allumer </button>
    <button onclick="appelServeur('/LED=OFF')" class="btnOFF">Eteindre </button>
</div> 
<h3 class="MCenter">Etat de la LED: <span id="etatLED"></span> </h3>
</body>
</html>



const char index_html[] PROGMEM = R"=====(


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArduinoLED</title>
    <style type="text/css">
        body{font-size: 20px; background: lightblue;}
        .MCenter{text-align: center;}
        .btnON{width: 100px; background: rgb(22, 184, 78); border-radius: 9px; cursor: pointer;font-size: 20px; }

        .btnOFF{ width: 100px; background: rgb(198, 8, 0); border-radius: 9px; cursor: pointer;font-size: 20px;}
    </style>
</head>



        <script>
            function appelServeur(url) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("etatLED").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            }

        </script>



<body onload="appelServeur()">
  <h1 class="MCenter">Server web démpoyer sur le ESP8266</h1>
  <h2 class="MCenter">On allume et on éteind une LED</h2>
  <h3 class="MCenter">Justin</h3>

  <br><br>
<div class="MCenter">
    <button onclick="appelServeur('/LED=ON')" class="btnON">Allumer </button>
    <button onclick="appelServeur('/LED=OFF')" class="btnOFF">Eteindre </button>
</div> 
<h3 class="MCenter">Etat de la LED: <span id="etatLED"></span> </h3>
</body>
</html>

)=====";





GET /aaaad1bbbbbbd2eeeefin HTTP/1.1








<!-- 
  client.println("<!DOCTYPE html> ");
  client.println("<html lang=\"en\"> ");
  client.println("<head> ");
  client.println("    <meta charset=\"UTF-8\"> ");
  client.println("    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"> ");
  client.println("    <title>ArduinoLED</title> ");
  client.println("    <style type=\"text/css\"> ");
  client.println("        body{font-size: 20px; background: lightblue;} ");
  client.println("        .MCenter{text-align: center;} ");
  client.println("        .btnON{width: 100px; background: rgb(22, 184, 78); border-radius: 9px; cursor: pointer;font-size: 20px; } ");
  client.println("");
  client.println("        .btnOFF{ width: 100px; background: rgb(198, 8, 0); border-radius: 9px; cursor: pointer;font-size: 20px;} ");
  client.println("    </style> ");
  client.println("</head> ");

  client.println("");
  client.println("        <script>");
  client.println("            function appelServeur(url) {");
  client.println("                var xhttp = new XMLHttpRequest();");
  client.println("                xhttp.onreadystatechange = function() {");
  client.println("                    if (this.readyState == 4 && this.status == 200) {");
  client.println("                        document.getElementById("etatLED").innerHTML = xhttp.responseText;");
  client.println("                    }");
  client.println("                };");
  client.println("                xhttp.open("GET", url, true);");
  client.println("                xhttp.send();");
  client.println("            }");
  client.println("");
  client.println("        </script>");
  client.println("");





  client.println("<body> ");
  client.println("  <h1 class=\"MCenter\">Server web démpoyer sur le ESP8266</h1> ");
  client.println("  <h2 class=\"MCenter\">On allume et on éteind une LED</h2> ");
  client.println("  <h3 class=\"MCenter\">Justin</h3> ");
  client.println(" ");
  client.println("  <br><br> ");
  client.println("<div class=\"MCenter\"> ");
  
  client.println("    <button onclick="appelServeur('/LED=ON')" class="btnON">Allumer </button> ");
  client.println("    <button onclick="appelServeur('/LED=OFF')" class="btnOFF">Eteindre </button> ");
  client.println("</div>  ");
  client.println("<h3 class="MCenter">Etat de la LED: <span id="etatLED"></span> </h3> ");

    if(value == HIGH) {
    client.print("Off");
  } else {
    client.print("On");
  }


  client.println("</body> ");
  client.println("</html> "); -->






















#include <ESP8266WiFi.h>
 
const char* ssid = "DESKTOP-CVTDU2T 1785";
const char* password = "juju12345";
 
int ledPin = 16; // La led de la carte
WiFiServer server(80); // port du server par défaut. Si on change, dans le lien, on sera obliger de mettre à la fin du lien /numéroPort
int value = LOW;

void setup()
{
  // initialisation de la communication série
   // Serial.begin(9600); // 9600 Ne marche pas mais 9600L marche
  Serial.begin(115200); // C'est la vites qu'il faut pour le ESP
 
  delay(100);

  // initialisation de la sortie pour la led
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH); // Il fait le contrair ici
 
  // Connexion wifi
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
 
  WiFi.begin(ssid, password);

  // connection  en cours ...
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }

  // Wifi connecter
  Serial.println("WiFi connecter");
 
  // Démmarrage du serveur.
  server.begin();
  Serial.println("Serveur demarrer !");
 
  // Affichage de l'adresse IP
  Serial.print("Utiliser cette adresse URL pour la connexion :");
  Serial.print("http://");
  Serial.print(WiFi.localIP());
  Serial.println("/");
 
}
 
void loop()
{
WiFiClient client;

 
  // Vérification si le client est connecter.
  client = server.available();
  if (!client)
  {
    return;
  }
 
  // Attendre si le client envoie des données ...
  Serial.println("Nouveau client");
  while(!client.available()){
    delay(1);
  }
 
  String request = client.readStringUntil('\r');
  Serial.println(request);
  client.flush();

 // Dans le request, on cherche /LED=ON . Si on trouve, on retoune != -1 si non, on retourne -1
  if (request.indexOf("/LED=ON") != -1)  {
    digitalWrite(ledPin, LOW); // allumer la led
    value = LOW;
  }
  if (request.indexOf("/LED=OFF") != -1)  {
    digitalWrite(ledPin, HIGH); // éteindre la led
    value = HIGH;
  }
 
  // Réponse
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println("");
  
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  client.println("<!DOCTYPE html> ");
  client.println("<html lang=\"en\"> ");
  client.println("<head> ");
  client.println("    <meta charset=\"UTF-8\"> ");
  client.println("    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"> ");
  client.println("    <title>ArduinoLED</title> ");
  client.println("    <style type=\"text/css\"> ");
  client.println("        body{font-size: 20px; background: lightblue;} ");
  client.println("        .MCenter{text-align: center;} ");
  client.println("        .btnON{width: 100px; background: rgb(22, 184, 78); border-radius: 9px; cursor: pointer;font-size: 20px; } ");
  client.println(" ");
  client.println("        .btnOFF{ width: 100px; background: rgb(198, 8, 0); border-radius: 9px; cursor: pointer;font-size: 20px;} ");
  client.println("    </style> ");
  client.println("</head> ");

  client.println("");
  client.println("        <script>");
  client.println("            function appelServeur(url) {");
  client.println("                var xhttp = new XMLHttpRequest();");
  client.println("                xhttp.onreadystatechange = function() {");
  client.println("                    if (this.readyState == 4 && this.status == 200) {");
  client.println("                        document.getElementById(\"etatLED\").innerHTML = this.responseText;");
  client.println("                    }");
  client.println("                };");
  client.println("                xhttp.open(\"GET\", url, true);");
  client.println("                xhttp.send();");
  client.println("            }");
  client.println("");
  client.println("        </script>");
  client.println("");

  
  client.println("<body> ");
  client.println("  <h1 class=\"MCenter\">Server web démpoyer sur le ESP8266</h1> ");
  client.println("  <h2 class=\"MCenter\">On allume et on éteind une LED</h2> ");
  client.println("  <h3 class=\"MCenter\">Justin</h3> ");
  client.println(" ");
  client.println("  <br><br> ");
  client.println("<div class=\"MCenter\"> ");
  
  client.println("    <button onclick=\"appelServeur('/LED=ON')\" class=\"btnON\">Allumer </button> ");
  client.println("    <button onclick=\"appelServeur('/LED=OFF')\" class=\"btnOFF\">Eteindre </button> ");
  client.println("</div>  ");
  client.println("<h3 class=\"MCenter\">Etat de la LED: <span id=\"etatLED\"></span> </h3> ");

  client.println("</body> ");
  client.println("</html> ");
 //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  delay(1);
  Serial.println("Client deconnecter");
  Serial.println("");
 
}






    client.print(String("GET /") + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n" +
                 "\r\n"
                );


// Reponse
    client.println("HTTP/1.1 200 OK");
    client.println("Content-Type: text/html");
    client.println(""); // Il ne faut pas oublier ce bloc d'en tête

    client.println("Bien récu:");
    client.print("Ticket= ");
    client.println(ticket);
    
    client.print("guichet= ");
    client.println(guichet);
    
    client.print("Numéro= ");
    client.println(numero);



    
  

  server.on("/led", []() {
  String state=server.arg("state");
  if (state == "on") digitalWrite(13, LOW);
  else if (state == "off") digitalWrite(13, HIGH);
  server.send(200, "text/plain", "Led is now " + state);
});

    


















     #include <SoftwareSerial.h>  

 #define PIN_TX  10 
 #define PIN_RX  11  
  SoftwareSerial mySerial(PIN_TX,PIN_RX);  


int smsstatus=0;
void setup() {

// when using Serial 1 connect gsm pins to pin RX1 (pin 19) and TX1 (pin 18) of Arduino Mega
// if you want to use RX2 and TX2 then you have to change all Serial1 in this code to Serial2
mySerial.begin(9600);  // the Gsm baud rate   
  Serial.begin(9600);    
}

void loop() {
  if (smsstatus==0){ // sms status here to avoid sending sms continuosly 
    Serial.println("============= debut ============");
smssend();
    Serial.println("============= debut ============");

smsstatus=1;
  }
  }

void smssend(){
mySerial.println("AT");
//Serial.write(mySerial.read()); 
delay(100);
mySerial.println("AT+CMGF=1");
delay(200);
mySerial.print("AT+CMGS=\"");
mySerial.print("+002250777762144"); // mobile number with country code
mySerial.println("\"");
delay(500);
mySerial.println("This is test message"); // Type in your text message here
delay(500);
mySerial.println((char)26); // This is to terminate the message
delay(500);


}


La caractere 26== →