"use strict";
function ready() {
  (()=>{
    const isHome = document.querySelector('.home');
    if (isHome){
      const homeBanerCtx = document.querySelectorAll('.home-banner__ctx');
      homeBanerCtx.forEach(item => item.innerText.length > 50 ? item.classList.add('big--wrap') : null);
    }
  })();
}
document.addEventListener("DOMContentLoaded", ready);

jQuery(document).ready(function($) {
	
	$("#home-page__banner").slick({
    autoplay: true,
    autoplaySpeed: 4000
  });
});