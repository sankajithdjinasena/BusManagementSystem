<button id="goTopBtn" class="go-top-button" title="Click to go up">↑</button>

<style>
    .go-top-button {
  position: fixed;
  bottom: 100px;
  right: 30px;
  display: none; 
  background-color: #333;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 50%;
  font-size: 18px;
  cursor: pointer;
  z-index: 1000;
  box-shadow: 0 4px 6px rgb(0,0,0);
  transition: opacity 0.3s ease;
}
    .go-top-button:hover {
        background-color: #555;
    }

</style>

<script>
  const goTopBtn = document.getElementById("goTopBtn");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 150) {
      goTopBtn.style.display = "block";
    } else {
      goTopBtn.style.display = "none";
    }
  });

  goTopBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
</script>
