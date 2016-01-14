#include <ArduinoJson.h>

#include <Wire.h>
#include <LiquidCrystal_I2C.h>

#define LED_RED 9
#define LED_BLUE 10
#define LED_GREEN 11
#define BUZZER 6

int fail = 0, success = 0;

String content;
char character;

LiquidCrystal_I2C lcd(0x27, 16, 2);

StaticJsonBuffer<300> jsonBuffer;

void setup() {
  pinMode(LED_RED, OUTPUT);
  pinMode(LED_BLUE, OUTPUT);
  pinMode(LED_GREEN, OUTPUT);
  pinMode(BUZZER, OUTPUT);
  
  noTone(BUZZER);
  
  lcd.begin();
   
  Serial.begin(9600);
}

/**
 * 48 (0) - buildng
 * 49 (1) - fail
 * 50 (2) - success
 * 51 (3) - unstable
 * 52 (4) - aborted
 */      
void loop() {
  
  content = "";
  
  while (Serial.available() > 0) {
    character = Serial.read();
    content.concat(character);
  }

  delay(500);  

  JsonObject& root = jsonBuffer.parseObject(content);
   
  if (!root.success())
  {
    Serial.println(content);
    delay(5000);
    return;
  }

  int buildStatus = root["id"];
  const char* message1    = root["m1"];
  const char* message2    = root["m2"];

  if (buildStatus == 0) {
    buildRunning();
  }
  
  if (buildStatus == 1) {
    buildFail(message1, message2);
  }
  
  if (buildStatus == 2) {
    buildSuccess();
  }
  
  if (buildStatus == 3) {
    buildUnstable();
  }
  
  if (buildStatus == 4) {
    buildAborted();
  }
}


void buildFail(const char* m1, const char* m2) {
   analogWrite(LED_BLUE, 0);
   analogWrite(LED_GREEN, 0);
   analogWrite(LED_RED, 255);
   
   if (fail == 0) {
     lcd.print(m1);
     lcd.setCursor(0,1);
     lcd.print(m2);
     initTone(1200);
   }
   fail = 1;
   success = 0;
}

void buildSuccess() {
   analogWrite(LED_BLUE, 255);
   analogWrite(LED_GREEN, 0);
   analogWrite(LED_RED, 0);
   
   if (success == 0) {
     initTone(300);
   }
   success = 1;
   fail = 0;
}

void buildRunning() {
     lcd.print("rodando build..");
     
      analogWrite(LED_RED, 255);
      analogWrite(LED_GREEN, 255);
      analogWrite(LED_BLUE, 255);
      delay(200);
      
      analogWrite(LED_BLUE, 0);
      analogWrite(LED_RED, 0);
      analogWrite(LED_GREEN, 0);
      delay(200);
}

void buildUnstable() {
   analogWrite(LED_BLUE, 0);
   analogWrite(LED_GREEN, 255);
   analogWrite(LED_RED, 255);
   
   if (success == 0) {
     initTone(800);
   }
   success = 1;
   fail = 0;
}

void buildAborted() {
   analogWrite(LED_BLUE, 255);
   analogWrite(LED_GREEN, 255);
   analogWrite(LED_RED, 255);
}

int initTone(int frequencia) {
    tone(BUZZER, frequencia);
    delay(500);
    tone(BUZZER, frequencia/2);
    delay(250);
    noTone(BUZZER);
}
