
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
                buzzer->doTone(500, TONE_DELAY);
                runOneTime = true;
            }
        }

        void buildRunning()
        {
            led->lightWhite(200);
            led->noLight(200);
        }

        void buildUnstable()
        {
            if (runOneTime == false) {
              led->lightYellow();
              buzzer->doTone(1200, TONE_DELAY);
            }
        }

        void buildAborted()
        {
            if (runOneTime == false) {
                led->lightWhite();  
                buzzer->doTone(900, TONE_DELAY);
                runOneTime = true;
            }
        }

        void stop()
        {
            buzzer->silence();
            led->noLight();
        }

        void start()
        {
            runOneTime = false;
        }
};

