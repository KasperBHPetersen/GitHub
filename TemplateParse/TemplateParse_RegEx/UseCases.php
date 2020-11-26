<?php
require 'TemplateParser.php';

//Normal associated data set.
$dataArray = ['Your Profile'=>'MasterSnake37', 'Tell us about you!'=>'I\'m the biggest and the baddest snake there is!','Birthday'=>'April 24','age'=>'37', 'school'=>'Some crazy place'];

//Atempted injection in 'Your Profile'=>'Mast<script>echo $data</script>erSnake37'
$dataArray1 = ['Your Profile'=>'Mast<script>echo $data</script>erSnake37', 'Tell us about you!'=>'I\'m the biggest and the baddest snake there is!','Birthday'=>'April 24','age'=>'37', 'school'=>'Some crazy place'];

//Template using {{ and }} as open/close tags
$someTemplate = 
'<html>
<body>
<h1>{{Your Profile}}</h1>
<p>{{Tell us about you!}}:<br>
Birthday: {{Birthday}}<br>
Age: {{age}}<br>
Education: {{school}}<br> </p>
</body>
</html>
';

//Template using {<>{ and }<>} as open/close tags
$someTemplate1 = 
'<html>
<body>
<h1>{<>{Your Profile}<>}</h1>
<p>{<>{Tell us about you!}<>}:<br>
Birthday: {<>{Birthday}<>}<br>
Age: {<>{age}<>}<br>
Education: {<>{school}<>}<br> </p>
</body>
</html>
';

$templateParser = new TemplateParser($someTemplate);

echo $templateParser->parse($dataArray);
echo '<br>';

$pattern = "/[^0-9 .]+/";
echo $templateParser->parse($dataArray, $pattern);
echo '<br>';

echo $templateParser->parse($dataArray1);
echo '<br>';

$templateParser = new TemplateParser($someTemplate1,'{<>{','}<>}');
echo $templateParser->parse($dataArray);

?>