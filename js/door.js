/* global AFRAME */
AFRAME.registerComponent("door", {
  init: function () {
    var door = document.getElementById("lobby");
    this.onClick = this.onClick.bind(this);
    door.addEventListener("click", this.onClick);
  },

  onClick: function (evt) {
    var id = evt.currentTarget.id;
    window.location.href = id;
  },
});
