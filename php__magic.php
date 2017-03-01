<?php

class Test
{
    public $value = array();

    public function __construct(array $value = array())
    {
        $this->value=$value;
    }

    public function __set($name, $value)
    {
        $this->value[$name] = $value;
    }

    public function __get($name)
    {
        return $this->value[$name];
    }

    public function __call($methodName, $args) {
        if($args[1])
            $this->value[$methodName] = $args;
        else
            $this->value[$args[0]] = $methodName;
        return $this;
    }
}

$a = new Test(array("field"));
$a->anybody(47)->bitrix("IBLOCK_ID", "SECTION_ID", "ID");
$b = $a->value;
$a->ID = array(99 => "ID");
$c = $a->ID;
$d = $a->anybodyFunction(47, "CODE");

echo "<pre>"; print_r($b); echo "</pre>";
echo "<p>=================================</p>";
echo "<pre>"; print_r($c); echo "</pre>";
echo "<p>=================================</p>";
echo "<pre>"; print_r($d); echo "</pre>";

/*output

Array
(
    [0] => field
    [47] => anybody
    [bitrix] => Array
        (
            [0] => IBLOCK_ID
            [1] => SECTION_ID
            [2] => ID
        )

)
=================================

Array
(
    [99] => ID
)
=================================

Test Object
(
    [value] => Array
        (
            [0] => field
            [47] => anybody
            [bitrix] => Array
                (
                    [0] => IBLOCK_ID
                    [1] => SECTION_ID
                    [2] => ID
                )

            [ID] => Array
                (
                    [99] => ID
                )

            [anybodyFunction] => Array
                (
                    [0] => 47
                    [1] => CODE
                )

        )

)

*/

?>
