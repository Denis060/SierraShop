<?php if (isset($idslide)) : ?>
	<div class="slider-container">
		<div class="slider" id="revolutionSlider" data-plugin-revolution-slider data-plugin-options='{"startheight": 500}'>
			<ul>
				<li data-transition="fade" data-slotamount="13" data-masterspeed="300">
					<img src="public/upload/slides/<?= $slide['slide_img1'] ?>" class="img-fluid" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<div class="tp-caption sft stb visible-lg" data-x="177" data-y="100" data-speed="300" data-start="1000" data-easing="easeOutExpo"><img src="public/img/slides/slide-title-border.png" alt=""></div>
					   <div class="tp-caption top-label lfl stl" data-x="227" data-y="100" data-speed="300" data-start="500" data-easing="easeOutExpo">Chua Chan Specialty Dishes</div>
					<div class="tp-caption sft stb visible-lg" data-x="530" data-y="100" data-speed="300" data-start="1000" data-easing="easeOutExpo"><img src="public/img/slides/slide-title-border.png" alt=""></div>
					   <div class="tp-caption main-label sft stb" data-x="135" data-y="170" data-speed="300" data-start="1000" data-easing="easeOutExpo">DELICIOUS BIG PAN BANH XEO</div>
					   <div class="tp-caption bottom-label sft stb" data-x="185" data-y="240" data-speed="500" data-start="2000" data-easing="easeOutExpo"><?= $slide['slide_text1'] ?></div>
					   <div class="tp-caption blackboard-text lfb " data-x="635" data-y="300" data-speed="500" data-start="2450" data-easing="easeOutExpo" style="font-size: 37px;">Fresh and Delicious Vegetables</div>
					   <div class="tp-caption blackboard-text lfb " data-x="660" data-y="350" data-speed="500" data-start="2850" data-easing="easeOutExpo" style="font-size: 47px;">Delicious Fish Sauce</div>
					   <div class="tp-caption blackboard-text lfb " data-x="685" data-y="400" data-speed="500" data-start="3250" data-easing="easeOutExpo" style="font-size: 32px;">Big Crispy Banh Xeo :)</div>
				</li>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="1000">
					<img src="public/upload/slides/<?= $slide['slide_img2'] ?>" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="180" data-speed="900" data-start="1000" data-easing="easeOutExpo" style="font-size: 30px;">Strawberry Milk Tea</div>
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="220" data-speed="900" data-start="1200" data-easing="easeOutExpo" style="font-size: 40px;">Chocolate Milk Tea</div>
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="260" data-speed="900" data-start="1600" data-easing="easeOutExpo" style="font-size: 40px;">Green Thai Milk Tea</div>
					   <div class="tp-caption main-label sft stb" data-x="485" data-y="160" data-speed="300" data-start="900" data-easing="easeOutExpo">ALL KINDS OF MILK TEA!</div>
					<div class="tp-caption bottom-label sft stb" data-x="585" data-y="250" data-speed="500" data-start="2000" data-easing="easeOutExpo"><?= $slide['slide_text2'] ?></div>
				</li>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="1700">
					<img src="public/upload/slides/<?= $slide['slide_img3'] ?>" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="180" data-speed="900" data-start="1000" data-easing="easeOutExpo" style="font-size: 30px;">Fried Fish Balls</div>
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="220" data-speed="900" data-start="1200" data-easing="easeOutExpo" style="font-size: 40px;">Tofu</div>
					   <div class="tp-caption blackboard-text sft stb" data-x="220" data-y="260" data-speed="900" data-start="1600" data-easing="easeOutExpo" style="font-size: 40px;">Flan Cake</div>
					   <div class="tp-caption main-label sft stb" data-x="485" data-y="160" data-speed="300" data-start="900" data-easing="easeOutExpo">SNACKS!</div>
					<div class="tp-caption bottom-label sft stb" data-x="585" data-y="250" data-speed="500" data-start="2000" data-easing="easeOutExpo"><?= $slide['slide_text3'] ?></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="home-intro" id="home-intro">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					   <p>
						   SierraShop Restaurant specializes in selling specialty Banh Xeo + wild vegetables, along with many types of milk tea, soft drinks, and other delicious snacks. <em>Food and soft drinks</em>
						   <span>In addition, we also sell cosmetics, beauty products, and much more.</span>
					   </p>
				</div>
				<div class="col-md-4">
					<div class="get-started">
						   <a href="search" class="btn btn-lg btn-primary">Go to Search Page!</a>
						   <div class="learn-more">or visit <a href="<?= $aboutUrl ?>">Shop Information.</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
