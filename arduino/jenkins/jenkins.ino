#define LED_RED 9
#define LED_BLUE 10
#define LED_GREEN 11
#define BUZZER 6

int data = 0, fail = 0, success = 0;

void setup() {
  pinMode(LED_RED, OUTPUT);
  pinMode(LED_BLUE, OUTPUT);
  pinMode(LED_GREEN, OUTPUT);
  pinMode(BUZZER, OUTPUT);
  
  noTone(BUZZER);
   
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
  if (Serial.available() > 0) {
    data = Serial.read();
  }
  
  if (data == 48) {
    buildRunning();
  }
  
  if (data == 49) {
    buildFail();
  }
  
  if (data == 50) {
    buildSuccess();
  }
  
  if (data == 51) {
    buildUnstable();
  }
  
  if (data == 52) {
    buildAborted();
  }
}


void buildFail() {
   analogWrite(LED_BLUE, 0);
   analogWrite(LED_GREEN, 0);
   analogWrite(LED_RED, 255);
   
   if (fail == 0) {
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
