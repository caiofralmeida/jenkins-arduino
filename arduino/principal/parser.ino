#define SERIAL_SPEED 9600

//int aff = 0;

/**
 * @TODO: Fatorar, melhorar parser
 */
class Parser
{
    public:
      String statusBuild, firstMessage, secondMessage;
      int bufferSize = 0;
      
      Parser()
      {
          Serial.begin(SERIAL_SPEED);
      }

      void initialize()
      {
          bufferSize    = 0;
          statusBuild   = "";
          firstMessage  = "";
          secondMessage = "";
      }
      
      void parseSerial()
      {
          while (Serial.available() > 0) {
              char character = Serial.read();
          
              if (bufferSize == 0) {
                statusBuild = String(character);
              }
      
              if (bufferSize >= 2 && bufferSize <= 17) {
                firstMessage.concat(character);
              }
      
              if (bufferSize >= 19 && bufferSize <= 34) {
                secondMessage.concat(character);
              }
      
              bufferSize++;
              delay(5);
          }
      }

      int getBuildStatus()
      {
          return statusBuild.toInt();
      }

      boolean hasData()
      {
          return bufferSize > 33;
      }
};

