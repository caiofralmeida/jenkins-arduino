RGBLed *led;
Buzzer *buzzer;
Notifier *notifier;

void setup() {
    led    = new RGBLed(LED_RED, LED_GREEN, LED_BLUE);
    buzzer = new Buzzer(BUZZER);
    buzzer->silence();
        
    notifier = new Notifier(buzzer, led);  
 
    lcd.print("Eae Samps");
  
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
    delay(1000);
    return;
  }

  int buildStatus = root["id"];
  const char* message1    = root["m1"];
  const char* message2    = root["m2"];

  if (buildStatus == 0) {   
     notifier->buildRunning();  
  }
  
  if (buildStatus == 1) {
    notifier->buildFail();
  }
  
  if (buildStatus == 2) {
    notifier->buildFail();
  }
  
  if (buildStatus == 3) {
    notifier->buildUnstable();
  }
  
  if (buildStatus == 4) {
    notifier->buildAborted();
  }
}

