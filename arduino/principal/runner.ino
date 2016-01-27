RGBLed *led;
Buzzer *buzzer;
Notifier *notifier;
Parser *parser;


String content;
char character;

String statusBuild;
String m1;
String m2;

void writeOnLcd(Parser* p) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print(p->firstMessage);
    lcd.setCursor(0, 1);
    lcd.print(p->secondMessage);
}

void setup() {
    led    = new RGBLed(LED_RED, LED_GREEN, LED_BLUE);
    buzzer = new Buzzer(BUZZER);
    buzzer->silence();
        
    notifier = new Notifier(buzzer, led);

    parser = new Parser();
 
    lcd.print("Optimus");
    lcd.setCursor(0, 1);
    lcd.print("b4cktr4ck");
}

boolean buildRunning = false;

/**
 * 48 (0) - buildng
 * 49 (1) - fail
 * 50 (2) - success
 * 51 (3) - unstable
 * 52 (4) - aborted
 */      
void loop() {
  
    parser->parseSerial();
    
    if (parser->hasData()) {
        writeOnLcd(parser);

        if (parser->getBuildStatus() == 0) {   
           notifier->buildRunning();
        }
    
        if (parser->getBuildStatus() == 1) {
            notifier->buildFail();
        }
      
        if (parser->getBuildStatus() == 2) {
            notifier->buildSuccess();
        }
      
        if (parser->getBuildStatus() == 3) {
            notifier->buildUnstable();
        }
      
        if (parser->getBuildStatus() == 4) {
            notifier->buildAborted();
        }

        if (parser->getBuildStatus() != 0) {
          parser->initialize();
          notifier->runOneTime = false;
        }
    }
}


