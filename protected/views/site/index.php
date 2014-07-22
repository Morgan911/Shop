
<div id="page">
	<div class="container">
		<div class="title">
			<h2>Добро пожаловать!</h2>
			<p>В нашем уютненьком магазинчике вы найдете все, 
			чтобы удовлетворить свои потребности и сделать подарок вашим близким!</p>
		</div>
		<?php
                foreach($categories as $category):?>
               <div class="boxA">
					<div class="box"  align="center">
                                            <img src=resized/<?php echo $category->image ?> alt="" />
				 <br/><a href="#" class="button"><?php echo $category->name ?></a>
			</div>
		</div>
                
               <?php endforeach; ?>
		</div>