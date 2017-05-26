<?php require_once('../Controller/navigation.php'); ?>

<div class="categoryBar" >
  <ul class="toggleGroup">

    <li><a  class="toggleBtn" href="#">Country</a>
      <ul class="toggleContent">
        <?php $wineTypesNav=getCountries();
          foreach ($wineTypesNav as $wineNav):  ?>

        <li><a href="wines.php?search=<?= $wineNav['country']?>"><?= $wineNav['country'] ?></a></li>
        <?php  endforeach ?>
      </ul>
    </li>

    <li><a class="toggleBtn" href="#">Colour</a>
      <ul class="toggleContent">
        <li><a href="wines.php?search=Red">Red</a></li>
        <li><a href="wines.php?search=Rose">Rose</a></li>
        <li><a href="wines.php?search=White">White</a></li>
      </ul>
    </li>

    <li><a class="toggleBtn" href="#">Rating</a>
    <ul class="toggleContent">
      <li><a href="wines.php?search=Dry">Dry</a></li>
      <li><a href="wines.php?search=Sweet">Sweet</a></li>
      <li><a href="wines.php?search=Light">Light</a></li>
      <li><a href="wines.php?search=Full-Bodied">Full-Bodied</a></li>
    </ul>
    </li>

    <li><a class="wineBtn" href="wines.php?search=Yes">New Arrival</a></li>
  </ul>
</div>
