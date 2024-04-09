$(document).ready(function(){
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // slide-up script
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

    // typing text animation script
    var typed = new Typed(".typing", {
        strings: ["Assignment", "Homework", "Editing", "Term Paper"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    var typed = new Typed(".typing-2", {
        strings: ["Assignment", "Homework", "Editing", "Term Paper"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    // owl carousel script
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplay: true,
        autoplayTimeOut: 2000,
        autoplayHoverPause: true,
        responsive: {
            0:{
                items: 1,
                nav: false
            },
            600:{
                items: 2,
                nav: false
            },
            1000:{
                items: 3,
                nav: false
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to Apply buttons
    document.querySelectorAll('.apply-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var categoryId = this.getAttribute('data-category-id');
            fetchSubcategories(categoryId);
        });
    });
});

function fetchSubcategories(categoryId) {
    // AJAX request to fetch subcategories
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle successful response
                displaySubcategories(xhr.responseText);
            } else {
                // Handle error
                console.error('Error fetching subcategories: ' + xhr.status);
            }
        }
    };
    xhr.open('GET', 'fetch_subcategories.php?category_id=' + categoryId, true);
    xhr.send();
}

function displaySubcategories(subcategories) {
    // Example: Display subcategories in a modal or any other container
    console.log(subcategories);
    // You can customize this function to display subcategories as needed
}
document.addEventListener('DOMContentLoaded', function() {
    var homeLink = document.querySelector('.has_subnav a.nav_link');
    var subnav = document.querySelector('.subnav');
    homeLink.addEventListener('click', function(event) {
      event.preventDefault();
      subnav.style.display = subnav.style.display === 'block' ? 'none' : 'block';
    });
  });
  