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
 * Definição dos códigos do status do build.
 */
#define STATUS_BUILD_FAIL 1
#define STATUS_BUILD_SUCCESS 2
#define STATUS_BUILD_UNSTABLE 3
#define STATUS_BUILD_ABORTED 4
#define STATUS_BUILD_RUNNING 0
#define STATUS_BUILD_SHUTDOWN 9

/**
 * @var LiquidCrystral_I2C
 */
LiquidCrystal_I2C lcd(0x27, 16, 2);


