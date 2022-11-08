In the PHPExcel file "DefaultValueBinder.php", replace this line 82:
} elseif ($pValue[0] === '=' && strlen($pValue) > 1) {
with the following:
} elseif (0 === strpos($pValue, '=') && strlen($pValue) > 1) {
This will fix the "Trying to access array offset on value of type int" error. But you will also need to conduct a find and replace for curly braces throughout the PHPExcel code to address the "Array and string offset access syntax with curly braces is deprecated" error which also affects PHP ugrades to 7.4. I simply replaced them with "[" and "]" everywhere and everything is working fine again.
