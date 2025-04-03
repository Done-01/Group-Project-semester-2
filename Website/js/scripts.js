function test() {
    var x = document.getElementById("toggle");
    if (x.style.display === "grid") {
        x.style.display = "none";
      } else {
        x.style.display = "grid";
      }
} 