
#define TONE_DELAY 1000

/**
 * Notifica com base do resultado do build passado.
 */
class Notifier
{   
    private:
        Buzzer *buzzer;
        RGBLed *led;

    public:
        boolean runOneTime;
                
        Notifier(Buzzer* b, RGBLed* r)
        {
            buzzer = b;
            led    = r;
            lcd.begin();
            runOneTime = false;
        }
        
        void buildSuccess()
        {
            if (runOneTime == false) {
                led->lightBlue();
                buzzer->doTone(300, TONE_DELAY);
                runOneTime = true;
            }
        }

        void buildFail()
        {
            if (runOneTime == false) {
                led->lightRed();
                buzzer->doTone(1200, TONE_DELAY);
                runOneTime = true;
            }
        }

        void buildRunning()
        {
            led->lightWhite();
            delay(200);
            led->noLight();
        }

        void buildUnstable()
        {
            if (runOneTime == false) {
              led->lightYellow();
              buzzer->doTone(500, TONE_DELAY);
              runOneTime = true;
            }
        }

        void buildAborted()
        {
            if (runOneTime == false) {
              led->lightWhite();
              buzzer->doTone(900);
            }
        }
};

