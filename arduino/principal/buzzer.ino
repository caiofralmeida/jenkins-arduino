/**
 * Classe que representa o buzzer do projeto.
 */
class Buzzer
{
    int instance;
  
    public:
        Buzzer(int i)
        {
            instance = i;
            pinMode(instance, OUTPUT);
        }

        void silence()
        {
            noTone(instance);
        }

        void doTone(int frequence, int timeDelay = 0)
        {
            tone(instance, frequence);

            if (timeDelay > 0) {
                delay(timeDelay);
                silence();
            }
        }
};

