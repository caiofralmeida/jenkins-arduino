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
   
void loop() {

    parser->parseSerial();
    
    if (parser->hasData()) {
        writeOnLcd(parser);
    
        if (parser->getBuildStatus() == STATUS_BUILD_FAIL) {
            notifier->buildFail();
            buildRunning = false;
        }
      
        if (parser->getBuildStatus() == STATUS_BUILD_SUCCESS) {
            notifier->buildSuccess();
            buildRunning = false;
        }
      
        if (parser->getBuildStatus() == STATUS_BUILD_UNSTABLE) {
            notifier->buildUnstable();
            buildRunning = false;
        }
      
        if (parser->getBuildStatus() == STATUS_BUILD_ABORTED) {
            notifier->buildAborted();
            buildRunning = false;
        }

        if (parser->getBuildStatus() == STATUS_BUILD_RUNNING) {
            buildRunning = true;
        }

        if (parser->getBuildStatus() == STATUS_BUILD_SHUTDOWN) {
            buildRunning = false;
            notifier->stop();
        }

        parser->initializeData();
        parser->initializeBufferSize();
        notifier->start();
    }

    if (buildRunning) {
        notifier->buildRunning();
    }
}


