#include <Wire.h>
#include <LiquidCrystal_I2C.h>

/**
 * Definição de algumas constantes.
 */
#define LED_RED 9
#define LED_BLUE 10
#define LED_GREEN 11
#define BUZZER 6

/**
 * @var LiquidCrystral_I2C
 */
LiquidCrystal_I2C lcd(0x27, 16, 2);


