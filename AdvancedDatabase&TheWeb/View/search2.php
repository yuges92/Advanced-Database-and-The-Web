<div class="container">
    <h1>Please Search for Wine</h1>
  <form class="searchBar" action="wines.php" method="Get">



  Category: <input list="categories" id="searchBox" type="text" placeholder="categories" name="search" required="true">
  <datalist id="categories">
  <option value="Red">
  <option value="White">
  <option value="Rose">
  <option value="New Arrival">
  <option value="Dry">
  <option value="Sweet">
  <option value="Light">
  <option value="Full Bodied">
</datalist>

</input>
 Country:<input list="countries"  id="searchBox" type="text" placeholder="country" name="search" required="true">
 <datalist id="countries">
 <option value="Argentina">
 <option value="Brazil">
 <option value="Turkey">
 <option value="Germany">

 </datalist>




</input>
    <input type="submit" value="Search">
  </form>

</div>
