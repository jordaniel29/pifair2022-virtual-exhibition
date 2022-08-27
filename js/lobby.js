function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    this.closeModal();
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
      var modal = document.getElementById("myModal");
      modal.style.display = "block";
      return;
    }

    window.location.href = id;
  },
});
