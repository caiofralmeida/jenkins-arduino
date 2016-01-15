/**
 * Classe que representa um led RGB.
 */
class RGBLed
{
    int pinRed, pinBlue, pinGreen;

    private:
      void analogWriter(int r, int g, int b, int d)
      {
          analogWrite(pinRed, r);
          analogWrite(pinGreen, g);
          analogWrite(pinBlue, b);

          if (d > 0) {
              delay(d);
          }
      }

    public:
      RGBLed(int red, int green, int blue)
      {
          pinRed   = red;
          pinGreen = green;
          pinBlue  = blue;

          pinMode(pinRed, OUTPUT);
          pinMode(pinGreen, OUTPUT);
          pinMode(pinBlue, OUTPUT);
      }

      void noLight()
      {
          analogWriter(0, 0, 0, 0);
      }
      
      void lightRed(int timeDelay = 0)
      {
          analogWriter(255, 0, 0, timeDelay);
      }

      void lightBlue(int timeDelay = 0)
      {
          analogWriter(0, 0, 255, timeDelay);
      }

      void lightWhite(int timeDelay = 0)
      {
          analogWriter(255, 255, 255, timeDelay);
      }

      void lightYellow(int timeDelay = 0)
      {
          analogWriter(255, 255, 0, timeDelay);
      }
};

