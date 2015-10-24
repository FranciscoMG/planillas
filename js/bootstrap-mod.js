function adaptScreen() {
  document.getElementById("homeCarousel").style.width= document.documentElement.offsetWidth + 'px';
  /*if (document.documentElement.offsetWidth > 770) {
    document.getElementById("homeCarousel").style.margin-left = calculeMargin()+ 'px';
  } */
}

function calculeMargin() {
  var addMargin= 25;
  for (var i = 771; i < document.documentElement.offsetWidth; i++) {
    if (i % 2 != 0) {
      addMargin++;
    }
  }
  return addMargin;
}
