function closeModal() {
  var modal = document.getElementById("modalHelpDesk");
  modal.style.display = "none";
  modal = document.getElementById("modalVideo");
  modal.style.display = "none";
  document.getElementById("myYoutubePlayer").src =
    document.getElementById("myYoutubePlayer").src;
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  var modal = document.getElementById("modalHelpDesk");
  if (event.target == modal) {
    this.closeModal();
    return;
  }

  modal = document.getElementById("modalVideo");
  if (event.target == modal) {
    this.closeModal();
    return;
  }
};

/* global AFRAME */
AFRAME.registerComponent("highlight-lobby", {
  init: function () {
    var buttonEls = (this.buttonEls = this.el.querySelectorAll(".menu-button"));
    this.onClick = this.onClick.bind(this);
    for (var i = 0; i < buttonEls.length; ++i) {
      buttonEls[i].addEventListener("click", this.onClick);
    }
  },

  onClick: function (evt) {
    var id = evt.currentTarget.id;

    if (id == "info-desk") {
      var modal = document.getElementById("modalHelpDesk");
      modal.style.display = "block";
      return;
    }

    if (id == "video") {
      var modal = document.getElementById("modalVideo");
      modal.style.display = "block";
      return;
    }

    window.location.href = id;
  },
});
