let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');
window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2) {
        modal1.style.display = "none";
        modal2.style.display = "none";
    }
}
function addToCart(productId, sanpham_id) {
  var quantity = 1;
  $.ajax({
      type: "POST",
      url: "cart_action.php?action=add&sanpham_id=" + sanpham_id,
      data: {quantity: quantity},
      success: function(response) {
          // Xử lý phản hồi từ máy chủ (nếu cần)
          alert("Product added to cart!");
      }
  });
}
