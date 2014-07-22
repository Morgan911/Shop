<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="header" class="container">
	<div id="logo">
		<h1><a href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1>
	</div>
	<div id="menu">
		<ul>
			<li class="active"><a href="#" accesskey="1" title="">Главная</a></li>
			<li><a href="#" accesskey="3" title="">Корзина</a></li>
			<li><a href="#" accesskey="3" title="">Вход</a></li>
			<li><a href="#" accesskey="5" title="">Оплата и доставка</a></li>
			<li><a href="#" accesskey="5" title="">О нас</a></li>
		</ul>
	</div>
</div>
	<?php echo $content; ?>


<div id="copyright" class="container">
	<p>&copy; Andrew P. 2014</p>
</div>


</body>
</html>
