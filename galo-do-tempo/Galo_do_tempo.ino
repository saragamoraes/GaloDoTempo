#include <DHT.h>
#include <WiFi.h>
#include <HTTPClient.h>


//==============================
// Wi-Fi
//==============================
const char* ssid = "VIVOFIBRA-8038";
const char* password = "AMORA262930";

//==============================
// DHT11
//==============================
#define DHTPIN 4
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

//==============================
// ThingSpeak
//==============================
String apiKey = "B6S309EA9M5OTJON";
String server = "https://api.thingspeak.com/update";


void setup() {

  Serial.begin(115200);

  dht.begin();

  WiFi.begin(ssid, password);

  Serial.print("Conectando ao WiFi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("WiFi conectado!");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {

  float temperatura = dht.readTemperature();
  float umidade = dht.readHumidity();

  if (isnan(temperatura) || isnan(umidade)) {
    Serial.println("Erro ao ler o DHT11");
    delay(5000);
    return;
  }

  Serial.print("Temperatura: ");
  Serial.print(temperatura);
  Serial.print(" °C");

  Serial.print("  Umidade: ");
  Serial.print(umidade);
  Serial.println(" %");

  if (WiFi.status() == WL_CONNECTED) {

    HTTPClient http;

    String url = server +
                 "?api_key=" + apiKey +
                 "&field1=" + String(temperatura) +
                 "&field2=" + String(umidade);

    Serial.println(url);

    http.begin(url);

    int httpCode = http.GET();

    if (httpCode > 0) {
      Serial.print("Código HTTP: ");
      Serial.println(httpCode);

      String resposta = http.getString();

      Serial.print("Resposta: ");
      Serial.println(resposta);
    }
    else {
      Serial.print("Erro HTTP: ");
      Serial.println(http.errorToString(httpCode));
    }

    http.end();
  }

  // ThingSpeak aceita atualização a cada 15 segundos
  delay(20000);
}