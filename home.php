<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Iterplaces</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="goias-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/3.png" alt="">
         </div>
         <div class="content">
            <span>Viajens de todos os gostos</span>
            <h3>Confira já</h3>
            <a href="shop.php" class="btn">Confira</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/2.png" alt="">
         </div>
         <div class="content">
            <span>Pensou na sua viagem dos sonhos?</span>
            <h3>Ultimas atualizações</h3>
            <a href="shop.php" class="btn">Confira</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/1.png" alt="">
         </div>
         <div class="content">
            <span>Aqui tem o melhor hotel pra você</span>
            <h3>Não perca</h3>
            <a href="shop.php" class="btn">Confira</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">Categorias</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=laptop" class="swiper-slide slide">
      <img src="images/airplane.png" alt="">
      <h3>Viagens</h3>
   </a>

   <a href="category.php?category=tv" class="swiper-slide slide">
      <img src="images/accomodation.png" alt="">
      <h3>Hospedagem</h3>
   </a>

   <a href="category.php?category=camera" class="swiper-slide slide">
      <img src="images/discount.png" alt="">
      <h3>Ofertas</h3>
   </a>

   <a href="category.php?category=mouse" class="swiper-slide slide">
      <img src="images/suitcases.png" alt="">
      <h3>Pacotes</h3>
   </a>

   <a href="category.php?category=fridge" class="swiper-slide slide">
      <img src="images/travel-and-tourism.png" alt="">
      <h3>Mais</h3>
   </a>


   </div>

   

   </div>

</section>

<section class="home-products">

   <h1 class="heading">Últimas Ofertas</h1>

   <div class="swiper products-slider">

   <div class="swipr-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>R$</span><?= $fetch_product['price']; ?><span></span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="adicionar ao carrinho" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Sem produtos!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>