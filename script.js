var body = document.getElementsByTagName('body')[0];

window.onscroll = function (event) {
  var scroll = window.pageYOffset;
  if (scroll < 400) {
    body.style.backgroundColor = '#AAFFC3';
  } else if (scroll >= 400) {
    body.style.backgroundColor = '#88ECD3';
  }
};
