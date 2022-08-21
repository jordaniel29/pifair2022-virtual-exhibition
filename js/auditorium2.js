// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    document.getElementById("myYoutubePlayer").src =
      document.getElementById("myYoutubePlayer").src;
    modal.style.display = "none";
  }
};

// Register aframe video component
AFRAME.registerComponent("video", {
  init: function () {
    var buttonEls = (this.buttonEls = this.el.querySelectorAll(".menu-button"));
    this.onClick = this.onClick.bind(this);
    buttonEls[0].addEventListener("click", this.onClick);
  },

  onClick: function (evt) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
  },
});
