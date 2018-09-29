<?php 
  include('includes/header.php');
?>
<ul class="navbar">
  <li><a href="#home">Home</a></li>
  <li><a href="#assignments">All Assignments</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Team Activities</a>
    <div class="dropdown-content">
      <a href="#">Week01</a>
      <a href="#">Week02</a>
      <a href="#">Week03</a>
    </div>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Prove</a>
    <div class="dropdown-content">
      <a href="#">Week01</a>
      <a href="#">Week02</a>
      <a href="#">Week03</a>
    </div>
  </li>
</ul>
<!-- Other stuff -->
<main>
  <article>
    <h1>About Me</h1>
    <div class="sections">
      <img class="mypics" src="russia.jpg" alt="Russia">
      <p>I'm originally from Novosibirsk, Russia. I lived there till I was 18 years old. After that I moved to the U.S.. </p>
    </div>
    <div class="sections">
      <img class="mypics" src="skydive.jpg" alt="Sky Diving">
      <p>I love to do fun things like skydiving, horseback riding, exploring new places. </p>
    </div>
    <div class="sections">
      <p><img class="mypics" src="married.jpg" alt="Wedding Day">I got married in May 2012 in Salt Lake Temple. That day was beautiful!</p>
    </div>
    <div class="sections">
      <p><img class="mypics" src="NYC.jpg" alt="NYC">My husband and I had an opportunity to live in NYC for a year and a half. We had a fun time there.</p>
    </div>
    <div class="sections">
      <p><img class="mypics" src="wedding.jpg" alt="My Family">Our family expanded a year ago. Our daughter, Scarlett, joined our family.</p>
    </div>
  </article>
</main>
<?php 
  include('includes/footer.php');
?>