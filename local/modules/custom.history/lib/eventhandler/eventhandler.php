<?

namespace Custom\History\EventHandler;

class EventHandler
{
    public static function onIBlockElementUpdateHandler(array $arFields, array $arCurValueNewFields)
    {
        dd($arFields);
    }
}